<?php

namespace App\Livewire\Admin\Rentals;

use App\Models\Rental;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    #[Url(as: 'status')] public $statusFilter = '';

    public $selectedRental = null;

    public $actionType = null;

    public $showActionModal = false;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedStatusFilter()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset([
            'search',
            'statusFilter',
        ]);

        $this->resetPage();
    }

    public function confirmApprove($id)
    {
        $this->selectedRental = Rental::with([
            'customer',
            'equipment',
        ])->findOrFail($id);

        $this->actionType = 'approve';
        $this->showActionModal = true;
    }

    public function confirmReject($id)
    {
        $this->selectedRental = Rental::with([
            'customer',
            'equipment',
        ])->findOrFail($id);

        $this->actionType = 'reject';
        $this->showActionModal = true;
    }

    public function confirmReturn($id)
    {
        $this->selectedRental = Rental::with([
            'customer',
            'equipment',
        ])->findOrFail($id);

        $this->actionType = 'return';
        $this->showActionModal = true;
    }

    public function cancelAction()
    {
        $this->resetActionModal();
    }

    public function approveRental()
    {
        if (!$this->selectedRental) {
            return;
        }


        try {

            DB::transaction(function () {

                /*
                * Lock the rental request first.
                */
                $rental = Rental::whereKey(
                        $this->selectedRental->id
                    )
                    ->lockForUpdate()
                    ->firstOrFail();


                if ($rental->status !== 'Pending') {

                    throw new \Exception(
                        'This rental request is no longer pending.'
                    );

                }


                /*
                * Lock the equipment row.
                *
                * This also serializes simultaneous approval
                * attempts for the same equipment.
                */
                $equipment = $rental
                    ->equipment()
                    ->lockForUpdate()
                    ->firstOrFail();


                /*
                * Calculate availability specifically for
                * the requested rental period.
                */
                $availableStock =
                    $equipment->availableStockFor(
                        $rental->rent_date,
                        $rental->return_date
                    );


                if (
                    $availableStock <
                    $rental->quantity
                ) {

                    throw new \Exception(
                        "Only {$availableStock} unit(s) are available for this rental period."
                    );

                }


                /*
                * IMPORTANT:
                *
                * Do NOT decrement equipment.stock.
                *
                * stock now represents total physical
                * inventory owned by the business.
                */
                $rental->update([
                    'status' => 'Rented',
                ]);

            });


            $this->resetActionModal();


            session()->flash(
                'success',
                'Rental approved successfully.'
            );

        } catch (\Exception $e) {

            $this->addError(
                'rentalAction',
                $e->getMessage()
            );

            $this->showActionModal = false;

        }
    }

    public function rejectRental()
    {
        if (!$this->selectedRental) {
            return;
        }

        try {
            DB::transaction(function () {
                $rental = Rental::whereKey(
                    $this->selectedRental->id
                )
                    ->lockForUpdate()
                    ->firstOrFail();

                if ($rental->status !== 'Pending') {
                    throw new \Exception(
                        'This rental request is no longer pending.'
                    );
                }

                $rental->update([
                    'status' => 'Cancelled',
                ]);
            });

            $this->resetActionModal();

            session()->flash(
                'success',
                'Rental request rejected successfully.'
            );
        } catch (\Exception $e) {
            $this->addError(
                'rentalAction',
                $e->getMessage()
            );

            $this->showActionModal = false;
        }
    }

    public function returnRental()
    {
        if (!$this->selectedRental) {
            return;
        }


        try {

            DB::transaction(function () {

                $rental = Rental::whereKey(
                        $this->selectedRental->id
                    )
                    ->lockForUpdate()
                    ->firstOrFail();


                if (
                    !in_array(
                        $rental->status,
                        [
                            'Rented',
                            'Late',
                        ]
                    )
                ) {

                    throw new \Exception(
                        'Only active or late rentals can be returned.'
                    );

                }


                /*
                * No stock increment anymore.
                *
                * Once status becomes Returned,
                * this rental automatically stops
                * contributing to reserved quantity.
                */
                $rental->update([
                    'status' => 'Returned',
                ]);

            });


            $this->resetActionModal();


            session()->flash(
                'success',
                'Rental marked as returned successfully.'
            );

        } catch (\Exception $e) {

            $this->addError(
                'rentalAction',
                $e->getMessage()
            );

            $this->showActionModal = false;

        }
    }

    public function resetActionModal()
    {
        $this->reset([
            'selectedRental',
            'actionType',
            'showActionModal',
        ]);

        $this->resetValidation();
    }

    public function render()
    {
        $rentals = Rental::query()
            ->with([
                'customer',
                'equipment',
            ])

            ->when($this->search, function ($query) {
                $search = trim($this->search);

                $query->where(function ($query) use ($search) {
                    $query
                        ->whereHas('customer', function ($query) use ($search) {
                            $query->where('name', 'ilike', "%{$search}%")
                                ->orWhere('email', 'ilike', "%{$search}%");
                        })
                        ->orWhereHas('equipment', function ($query) use ($search) {
                            $query->where('name', 'ilike', "%{$search}%")
                                ->orWhere('category', 'ilike', "%{$search}%");
                        });
                });
            })

            ->when($this->statusFilter, function ($query) {
                $query->where(
                    'status',
                    $this->statusFilter
                );
            })

            ->latest()
            ->paginate(10);

        return view('livewire.admin.rentals.index', [
            'rentals' => $rentals,
        ]);
    }
}
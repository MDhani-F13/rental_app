<?php

namespace App\Livewire\Customer\Rentals;

use App\Models\Rental;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    /*
    |--------------------------------------------------------------------------
    | Filters
    |--------------------------------------------------------------------------
    */

    public $search = '';

    public $statusFilter = '';


    /*
    |--------------------------------------------------------------------------
    | Cancel Rental
    |--------------------------------------------------------------------------
    */

    public $selectedRental = null;

    public $showCancelModal = false;


    /*
    |--------------------------------------------------------------------------
    | Filter Events
    |--------------------------------------------------------------------------
    */

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


    /*
    |--------------------------------------------------------------------------
    | Cancel Confirmation
    |--------------------------------------------------------------------------
    */

    public function confirmCancel($id)
    {
        $rental = Rental::where(
                'customer_id',
                Auth::guard('customer')->id()
            )
            ->with('equipment')
            ->findOrFail($id);


        if ($rental->status !== 'Pending') {

            session()->flash(
                'error',
                'Only pending rental requests can be cancelled.'
            );

            return;
        }


        $this->selectedRental = $rental;

        $this->showCancelModal = true;
    }


    public function cancelRental()
    {
        if (!$this->selectedRental) {
            return;
        }


        try {

            DB::transaction(function () {

                /*
                 * We retrieve the rental again and lock it
                 * because the admin could approve it while
                 * the customer is looking at the modal.
                 */
                $rental = Rental::where(
                        'customer_id',
                        Auth::guard('customer')->id()
                    )
                    ->whereKey(
                        $this->selectedRental->id
                    )
                    ->lockForUpdate()
                    ->firstOrFail();


                if ($rental->status !== 'Pending') {

                    throw new \Exception(
                        'This rental request can no longer be cancelled.'
                    );

                }


                $rental->update([
                    'status' => 'Cancelled',
                ]);

            });


            $this->resetCancelModal();


            session()->flash(
                'success',
                'Rental request cancelled successfully.'
            );

        } catch (\Exception $e) {

            $this->resetCancelModal();


            session()->flash(
                'error',
                $e->getMessage()
            );

        }
    }


    public function closeCancelModal()
    {
        $this->resetCancelModal();
    }


    public function resetCancelModal()
    {
        $this->reset([
            'selectedRental',
            'showCancelModal',
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Render
    |--------------------------------------------------------------------------
    */

    public function render()
    {
        $rentals = Rental::query()

            ->with('equipment')

            /*
             * IMPORTANT:
             * customers can only see their own rentals.
             */
            ->where(
                'customer_id',
                Auth::guard('customer')->id()
            )


            /*
             * Search equipment information.
             */
            ->when(
                $this->search,
                function ($query) {

                    $search = trim(
                        $this->search
                    );


                    $query->whereHas(
                        'equipment',
                        function ($query)
                        use ($search) {

                            $query
                                ->where(
                                    'name',
                                    'ilike',
                                    "%{$search}%"
                                )

                                ->orWhere(
                                    'category',
                                    'ilike',
                                    "%{$search}%"
                                );
                        }
                    );

                }
            )


            /*
             * Status filter.
             */
            ->when(
                $this->statusFilter,
                function ($query) {

                    $query->where(
                        'status',
                        $this->statusFilter
                    );

                }
            )


            ->latest()

            ->paginate(8);


        return view(
            'livewire.customer.rentals.index',
            [
                'rentals' => $rentals,
            ]
        )
            ->layout(
                'customer.layouts.app'
            );
    }
}
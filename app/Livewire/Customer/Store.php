<?php

namespace App\Livewire\Customer;

use App\Models\Equipment;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Store extends Component
{
    use WithPagination;

    public $selectedEquipment = null;

    public $quantity = 1;

    public $rentDate = '';

    public $returnDate = '';

    public $showRentalForm = false;


    /*
    |--------------------------------------------------------------------------
    | Store Filters
    |--------------------------------------------------------------------------
    */

    public $search = '';

    public $categoryFilter = '';

    public $availabilityFilter = '';


    public function updatedSearch()
    {
        $this->resetPage();
    }


    public function updatedCategoryFilter()
    {
        $this->resetPage();
    }


    public function updatedAvailabilityFilter()
    {
        $this->resetPage();
    }


    public function clearFilters()
    {
        $this->reset([
            'search',
            'categoryFilter',
            'availabilityFilter',
        ]);

        $this->resetPage();
    }


    /*
    |--------------------------------------------------------------------------
    | Open Rental Form
    |--------------------------------------------------------------------------
    */
    public function mount()
    {
        if (
            Auth::guard('customer')->check()
            && request()->filled('rent')
        ) {
            $equipmentId = request()->integer('rent');

            if (
                Equipment::whereKey($equipmentId)->exists()
            ) {
                $this->openRentalForm(
                    $equipmentId
                );
            }
        }
    }
    
    public function rent($equipmentId)
    {
        if (!Auth::guard('customer')->check()) {

            session()->put(
                'url.intended',
                route(
                    'customer.store',
                    [
                        'rent' => $equipmentId,
                    ]
                )
            );

            return redirect()
                ->route('customer.login');
        }


        $this->openRentalForm(
            $equipmentId
        );
    }

    private function openRentalForm($equipmentId)
    {
        $this->resetValidation();

        $equipment = Equipment::findOrFail(
            $equipmentId
        );

        if ($equipment->stock <= 0) {

            session()->flash(
                'error',
                'This equipment is currently unavailable.'
            );

            return;
        }


        $this->selectedEquipment = $equipment;

        $this->quantity = 1;

        $this->rentDate = now()
            ->format('Y-m-d');

        $this->returnDate = now()
            ->addDay()
            ->format('Y-m-d');

        $this->showRentalForm = true;
    }

    /*
    |--------------------------------------------------------------------------
    | Create Rental Request
    |--------------------------------------------------------------------------
    */

    public function createRental()
    {
        if (!Auth::guard('customer')->check()) {

            return redirect()
                ->route('customer.login');
        }
        
        $this->validate([
            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],

            'rentDate' => [
                'required',
                'date',
                'after_or_equal:today',
            ],

            'returnDate' => [
                'required',
                'date',
                'after:rentDate',
            ],
        ]);


        if (!$this->selectedEquipment) {
            return;
        }


        /*
         * Reload from database so we're not using stale
         * equipment information from when the modal opened.
         */
        $equipment = Equipment::findOrFail(
            $this->selectedEquipment->id
        );


        /*
         * Calculate REAL availability for these dates.
         */
        $availableStock =
            $equipment->availableStockFor(
                $this->rentDate,
                $this->returnDate
            );


        if ($availableStock <= 0) {

            $this->addError(
                'quantity',
                'This equipment is fully booked for the selected dates.'
            );

            return;
        }


        if (
            (int) $this->quantity >
            $availableStock
        ) {

            $this->addError(
                'quantity',
                "Only {$availableStock} unit(s) are available for the selected dates."
            );

            return;
        }


        /*
         * Calculate price using latest database price.
         */
        $days = max(
            1,
            Carbon::parse($this->rentDate)
                ->diffInDays(
                    Carbon::parse(
                        $this->returnDate
                    )
                )
        );


        $totalPrice =
            $equipment->price
            * (int) $this->quantity
            * $days;


        /*
         * Pending DOES NOT reserve inventory yet.
         *
         * Availability gets enforced again when the
         * admin actually approves the request.
         */
        Rental::create([
            'customer_id' =>
                Auth::guard('customer')->id(),

            'equipment_id' =>
                $equipment->id,

            'quantity' =>
                (int) $this->quantity,

            'rent_date' =>
                $this->rentDate,

            'return_date' =>
                $this->returnDate,

            'total_price' =>
                $totalPrice,

            'status' =>
                'Pending',
        ]);


        $this->resetRentalForm();


        session()->flash(
            'success',
            'Rental request submitted successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Rental Form Helpers
    |--------------------------------------------------------------------------
    */

    public function cancelRental()
    {
        $this->resetRentalForm();
    }


    public function resetRentalForm()
    {
        $this->reset([
            'selectedEquipment',
            'quantity',
            'rentDate',
            'returnDate',
            'showRentalForm',
        ]);

        $this->resetValidation();
    }


    /*
    |--------------------------------------------------------------------------
    | Rental Calculations
    |--------------------------------------------------------------------------
    */

    public function getRentalDaysProperty()
    {
        if (
            !$this->rentDate ||
            !$this->returnDate
        ) {
            return 1;
        }


        try {

            return max(
                1,
                Carbon::parse($this->rentDate)
                    ->diffInDays(
                        Carbon::parse(
                            $this->returnDate
                        )
                    )
            );

        } catch (\Exception $e) {

            return 1;

        }
    }


    public function getEstimatedTotalProperty()
    {
        if (!$this->selectedEquipment) {
            return 0;
        }


        $quantity = max(
            1,
            (int) $this->quantity
        );


        return $this->selectedEquipment->price
            * $quantity
            * $this->rentalDays;
    }


    /*
    |--------------------------------------------------------------------------
    | Date-Based Availability
    |--------------------------------------------------------------------------
    */

    public function getAvailableQuantityProperty()
    {
        if (
            !$this->selectedEquipment ||
            !$this->rentDate ||
            !$this->returnDate
        ) {

            return $this->selectedEquipment
                ? $this->selectedEquipment->stock
                : 0;
        }


        /*
         * Invalid date combinations shouldn't cause
         * errors while the customer is editing fields.
         */
        try {

            if (
                Carbon::parse($this->returnDate)
                    ->lte(
                        Carbon::parse(
                            $this->rentDate
                        )
                    )
            ) {
                return 0;
            }


            $equipment = Equipment::find(
                $this->selectedEquipment->id
            );


            if (!$equipment) {
                return 0;
            }


            return $equipment->availableStockFor(
                $this->rentDate,
                $this->returnDate
            );

        } catch (\Exception $e) {

            return 0;

        }
    }


    /*
    |--------------------------------------------------------------------------
    | Render
    |--------------------------------------------------------------------------
    */

    public function render()
    {
        $equipment = Equipment::query()

            ->when(
                $this->search,
                function ($query) {

                    $search =
                        trim($this->search);

                    $query->where(
                        function ($query)
                        use ($search) {

                            $query
                                ->where(
                                    'name',
                                    'ilike',
                                    "%{$search}%"
                                )

                                ->orWhere(
                                    'description',
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


            ->when(
                $this->categoryFilter,
                function ($query) {

                    $query->where(
                        'category',
                        $this->categoryFilter
                    );

                }
            )


            /*
             * These filters currently mean physical
             * inventory exists, because no dates have
             * been selected at the store level.
             */
            ->when(
                $this->availabilityFilter
                    === 'available',
                function ($query) {

                    $query->where(
                        'stock',
                        '>',
                        0
                    );

                }
            )


            ->when(
                $this->availabilityFilter
                    === 'out_of_stock',
                function ($query) {

                    $query->where(
                        'stock',
                        0
                    );

                }
            )


            ->orderBy('name')

            ->paginate(9);


        $categories =
            Equipment::query()

                ->whereNotNull('category')

                ->where(
                    'category',
                    '!=',
                    ''
                )

                ->distinct()

                ->orderBy('category')

                ->pluck('category');


        return view(
            'livewire.customer.store',
            [
                'equipment' =>
                    $equipment,

                'categories' =>
                    $categories,
            ]
        )
            ->layout(
                'customer.layouts.app'
            );
    }
}
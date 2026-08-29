<?php

namespace App\Livewire\Admin\Customers;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public $selectedCustomer = null;

    public $showCustomerModal = false;


    /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    */

    public function updatedSearch()
    {
        $this->resetPage();
    }


    public function clearFilters()
    {
        $this->reset('search');

        $this->resetPage();
    }


    /*
    |--------------------------------------------------------------------------
    | Customer Details
    |--------------------------------------------------------------------------
    */

    public function viewCustomer($id)
    {
        $this->selectedCustomer = Customer::query()
            ->with([
                'rentals' => function ($query) {
                    $query
                        ->with('equipment')
                        ->latest();
                },
            ])
            ->withCount([
                'rentals',

                'rentals as pending_rentals_count' => function ($query) {
                    $query->where('status', 'Pending');
                },

                'rentals as active_rentals_count' => function ($query) {
                    $query->where('status', 'Rented');
                },

                'rentals as late_rentals_count' => function ($query) {
                    $query->where('status', 'Late');
                },

                'rentals as returned_rentals_count' => function ($query) {
                    $query->where('status', 'Returned');
                },
            ])
            ->findOrFail($id);


        $this->showCustomerModal = true;
    }


    public function closeCustomerModal()
    {
        $this->reset([
            'selectedCustomer',
            'showCustomerModal',
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Render
    |--------------------------------------------------------------------------
    */

    public function render()
    {
        $customers = Customer::query()

            ->withCount([
                'rentals',

                'rentals as pending_rentals_count' => function ($query) {
                    $query->where('status', 'Pending');
                },

                'rentals as active_rentals_count' => function ($query) {
                    $query->where('status', 'Rented');
                },

                'rentals as late_rentals_count' => function ($query) {
                    $query->where('status', 'Late');
                },
            ])

            ->when(
                $this->search,
                function ($query) {

                    $search = trim($this->search);

                    $query->where(
                        function ($query) use ($search) {

                            $query
                                ->where(
                                    'name',
                                    'ilike',
                                    "%{$search}%"
                                )

                                ->orWhere(
                                    'email',
                                    'ilike',
                                    "%{$search}%"
                                )

                                ->orWhere(
                                    'phone_number',
                                    'ilike',
                                    "%{$search}%"
                                );
                        }
                    );

                }
            )

            ->latest()

            ->paginate(10);


        return view(
            'livewire.admin.customers.index',
            [
                'customers' => $customers,
            ]
        );
    }
}
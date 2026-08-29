<?php

namespace App\Livewire\Admin;

use App\Models\Customer;
use App\Models\Equipment;
use App\Models\Rental;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        /*
        |--------------------------------------------------------------------------
        | Summary Statistics
        |--------------------------------------------------------------------------
        */

        $totalCustomers = Customer::count();

        /*
         * Number of different equipment records/types.
         */
        $totalEquipmentTypes = Equipment::count();

        /*
         * Remember:
         * equipment.stock now means TOTAL PHYSICAL UNITS OWNED.
         */
        $totalEquipmentUnits = Equipment::sum('stock');

        $pendingRentals = Rental::where(
            'status',
            'Pending'
        )->count();

        $activeRentals = Rental::where(
            'status',
            'Rented'
        )->count();

        $lateRentals = Rental::where(
            'status',
            'Late'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | Recent Rental Requests
        |--------------------------------------------------------------------------
        */

        $recentRentals = Rental::query()
            ->with([
                'customer',
                'equipment',
            ])
            ->latest()
            ->limit(8)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Most Rented Equipment
        |--------------------------------------------------------------------------
        |
        | We only count rentals that were actually approved.
        |
        | Pending:
        | request hasn't been approved yet
        |
        | Cancelled:
        | rental never happened
        |
        */

        $topEquipment = Equipment::query()

            ->withSum(
                [
                    'rentals as rented_quantity_sum' => function ($query) {
                        $query->whereIn(
                            'status',
                            [
                                'Rented',
                                'Late',
                                'Returned',
                            ]
                        );
                    },
                ],
                'quantity'
            )

            ->orderByDesc('rented_quantity_sum')

            ->limit(5)

            ->get();


        return view(
            'livewire.admin.dashboard',
            [
                'totalCustomers' =>
                    $totalCustomers,

                'totalEquipmentTypes' =>
                    $totalEquipmentTypes,

                'totalEquipmentUnits' =>
                    $totalEquipmentUnits,

                'pendingRentals' =>
                    $pendingRentals,

                'activeRentals' =>
                    $activeRentals,

                'lateRentals' =>
                    $lateRentals,

                'recentRentals' =>
                    $recentRentals,

                'topEquipment' =>
                    $topEquipment,
            ]
        );
    }
}
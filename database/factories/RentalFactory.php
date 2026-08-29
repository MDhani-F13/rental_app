<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Equipment;
use App\Models\Rental;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Rental>
 */
class RentalFactory extends Factory
{
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'equipment_id' => Equipment::factory(),

            'rent_date' => now()
                ->addDays(3)
                ->toDateString(),

            'return_date' => now()
                ->addDays(6)
                ->toDateString(),

            'status' => 'Pending',

            'quantity' => 1,

            // Recalculated after creation using
            // the selected equipment price.
            'total_price' => 0,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Rental $rental) {
            $equipment = $rental->equipment;

            if (!$equipment) {
                return;
            }

            $days = $rental->rent_date
                ->diffInDays($rental->return_date);

            $rental->updateQuietly([
                'total_price' =>
                    $equipment->price
                    * $rental->quantity
                    * max(1, $days),
            ]);
        });
    }

    public function pending(): static
    {
        return $this->state(fn () => [
            'status' => 'Pending',

            'rent_date' => now()
                ->addDays(fake()->numberBetween(2, 10))
                ->toDateString(),

            'return_date' => now()
                ->addDays(fake()->numberBetween(11, 18))
                ->toDateString(),
        ]);
    }

    public function rented(): static
    {
        return $this->state(function () {
            $rentDate = now()
                ->subDays(fake()->numberBetween(0, 2));

            return [
                'status' => 'Rented',

                'rent_date' => $rentDate->toDateString(),

                'return_date' => now()
                    ->addDays(fake()->numberBetween(2, 7))
                    ->toDateString(),
            ];
        });
    }

    public function late(): static
    {
        return $this->state(function () {
            $returnDate = now()
                ->subDays(fake()->numberBetween(1, 5));

            return [
                'status' => 'Late',

                'rent_date' => $returnDate
                    ->copy()
                    ->subDays(fake()->numberBetween(2, 7))
                    ->toDateString(),

                'return_date' => $returnDate
                    ->toDateString(),
            ];
        });
    }

    public function returned(): static
    {
        return $this->state(function () {
            $rentDate = now()
                ->subDays(fake()->numberBetween(10, 90));

            $rentalDays = fake()->numberBetween(1, 7);

            return [
                'status' => 'Returned',

                'rent_date' => $rentDate->toDateString(),

                'return_date' => $rentDate
                    ->copy()
                    ->addDays($rentalDays)
                    ->toDateString(),
            ];
        });
    }

    public function cancelled(): static
    {
        return $this->state(function () {
            $rentDate = now()
                ->subDays(fake()->numberBetween(2, 30));

            return [
                'status' => 'Cancelled',

                'rent_date' => $rentDate->toDateString(),

                'return_date' => $rentDate
                    ->copy()
                    ->addDays(fake()->numberBetween(1, 7))
                    ->toDateString(),
            ];
        });
    }
}
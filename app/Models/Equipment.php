<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable([
    'name',
    'description',
    'price',
    'stock',
    'category',
    'picture',
])]

class Equipment extends Model
{
    use HasFactory;
    
    protected $table = 'equipments';

    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class);
    }

    public function reservedQuantityFor($rentDate, $returnDate): int
    {
        return (int) $this->rentals()

            ->where(function ($query) use ($rentDate, $returnDate) {

                /*
                * Normal approved rentals.
                *
                * Existing rental overlaps requested dates when:
                *
                * existing start < requested end
                * AND
                * existing end > requested start
                */
                $query->where(function ($query) use ($rentDate, $returnDate) {
                    $query
                        ->where('status', 'Rented')
                        ->whereDate('rent_date', '<', $returnDate)
                        ->whereDate('return_date', '>', $rentDate);
                })

                /*
                * Late rentals are special.
                *
                * We no longer know exactly when the item will
                * become available because it has not been returned.
                *
                * Therefore it continues consuming inventory.
                */
                ->orWhere(function ($query) use ($returnDate) {
                    $query
                        ->where('status', 'Late')
                        ->whereDate('rent_date', '<', $returnDate);
                });

            })

            ->sum('quantity');
    }


    public function availableStockFor($rentDate, $returnDate): int
    {
        return max(
            0,
            $this->stock
                - $this->reservedQuantityFor(
                    $rentDate,
                    $returnDate
                )
        );
    }
}

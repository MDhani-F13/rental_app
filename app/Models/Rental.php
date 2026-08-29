<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rental extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'customer_id',
        'equipment_id',
        'quantity',
        'rent_date',
        'return_date',
        'total_price',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'rent_date' => 'date',
            'return_date' => 'date',
            'total_price' => 'decimal:2',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }
}
<?php

namespace App\Console\Commands;
use App\Models\Rental;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:mark-late-rentals')]
#[Description('Command description')]
class MarkLateRentals extends Command
{
    protected $signature = 'rentals:mark-late';

    protected $description = 'Mark overdue active rentals as late';

    public function handle()
    {
        $count = Rental::where('status', 'Rented')
            ->whereDate('return_date', '<', today())
            ->update([
                'status' => 'Late',
            ]);

        $this->info(
            "{$count} rental(s) marked as late."
        );

        return self::SUCCESS;
    }
}

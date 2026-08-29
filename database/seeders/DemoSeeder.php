<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Equipment;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Demo Administrator
        |--------------------------------------------------------------------------
        */

        User::updateOrCreate(
            [
                'email' => 'admin@rental.test',
            ],
            [
                'name' => 'Demo Administrator',

                'email_verified_at' => now(),

                'password' => Hash::make('password'),
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Main Demo Customer
        |--------------------------------------------------------------------------
        |
        | We keep one predictable customer account so the application can easily
        | be demonstrated without looking through randomly generated credentials.
        |
        */

        $demoCustomer = Customer::updateOrCreate(
            [
                'email' => 'customer@rental.test',
            ],
            [
                'name' => 'Demo Customer',

                'phone_number' => '081234567890',

                'address' =>
                    'Jl. Demo Rental No. 10, Surabaya',

                'password' => Hash::make('password'),
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Additional Customers
        |--------------------------------------------------------------------------
        */

        $generatedCustomers = Customer::factory()
            ->count(19)
            ->create();

        $customers = $generatedCustomers
            ->prepend($demoCustomer);


        /*
        |--------------------------------------------------------------------------
        | Equipment
        |--------------------------------------------------------------------------
        |
        | Stock represents TOTAL PHYSICAL UNITS OWNED.
        |
        | It is NOT reduced when a rental is approved and NOT restored when a
        | rental is returned. Availability is calculated from rental periods.
        |
        */

        $equipmentData = [

            [
                'name' => 'Canon EOS R6 Mark II',
                'description' =>
                    'Full-frame mirrorless camera suitable for photography and professional video production.',
                'price' => 350000,
                'stock' => 4,
                'category' => 'Camera',
            ],

            [
                'name' => 'Sony A7 IV',
                'description' =>
                    'Versatile full-frame mirrorless camera for photo and video work.',
                'price' => 325000,
                'stock' => 3,
                'category' => 'Camera',
            ],

            [
                'name' => 'Sony FE 24-70mm F2.8 GM',
                'description' =>
                    'Professional standard zoom lens suitable for events, portraits, and general photography.',
                'price' => 175000,
                'stock' => 4,
                'category' => 'Camera',
            ],

            [
                'name' => 'DJI RS 3 Gimbal',
                'description' =>
                    'Three-axis camera stabilizer for smooth handheld video production.',
                'price' => 150000,
                'stock' => 4,
                'category' => 'Camera',
            ],

            [
                'name' => 'DJI Mini 4 Pro',
                'description' =>
                    'Compact aerial camera drone suitable for photography and cinematic footage.',
                'price' => 400000,
                'stock' => 2,
                'category' => 'Camera',
            ],

            [
                'name' => 'Rode Wireless GO II',
                'description' =>
                    'Compact dual-channel wireless microphone system for interviews and video production.',
                'price' => 125000,
                'stock' => 6,
                'category' => 'Audio',
            ],

            [
                'name' => 'Shure SM58 Microphone',
                'description' =>
                    'Dynamic vocal microphone suitable for events, performances, and presentations.',
                'price' => 50000,
                'stock' => 10,
                'category' => 'Audio',
            ],

            [
                'name' => 'Zoom H6 Recorder',
                'description' =>
                    'Portable multi-track audio recorder for field recording, interviews, and production.',
                'price' => 125000,
                'stock' => 4,
                'category' => 'Audio',
            ],

            [
                'name' => 'Aputure Amaran 200d',
                'description' =>
                    'High-output daylight LED light for studio and on-location production.',
                'price' => 150000,
                'stock' => 6,
                'category' => 'Lighting',
            ],

            [
                'name' => 'Godox SL60W',
                'description' =>
                    'Continuous LED video light suitable for studio, streaming, and photography.',
                'price' => 75000,
                'stock' => 8,
                'category' => 'Lighting',
            ],

            [
                'name' => 'LED RGB Light Panel',
                'description' =>
                    'Adjustable RGB lighting panel for creative photography, video, and events.',
                'price' => 65000,
                'stock' => 8,
                'category' => 'Lighting',
            ],

            [
                'name' => 'Epson Full HD Projector',
                'description' =>
                    'Full HD projector suitable for meetings, presentations, classrooms, and events.',
                'price' => 250000,
                'stock' => 5,
                'category' => 'Event',
            ],

            [
                'name' => 'Portable PA Speaker',
                'description' =>
                    'Powered portable speaker system suitable for presentations and small events.',
                'price' => 175000,
                'stock' => 6,
                'category' => 'Event',
            ],

            [
                'name' => 'Folding Event Table',
                'description' =>
                    'Portable folding table suitable for exhibitions, meetings, and outdoor events.',
                'price' => 50000,
                'stock' => 12,
                'category' => 'Event',
            ],

            [
                'name' => 'Camping Tent 4 Person',
                'description' =>
                    'Weather-resistant four-person tent suitable for camping and outdoor activities.',
                'price' => 85000,
                'stock' => 8,
                'category' => 'Outdoor',
            ],

            [
                'name' => 'Portable Camping Chair',
                'description' =>
                    'Lightweight folding chair designed for camping and outdoor events.',
                'price' => 30000,
                'stock' => 15,
                'category' => 'Outdoor',
            ],

            [
                'name' => 'Bosch Cordless Drill',
                'description' =>
                    'Rechargeable cordless drill suitable for installation and general maintenance work.',
                'price' => 75000,
                'stock' => 7,
                'category' => 'Tools',
            ],

            [
                'name' => 'Makita Angle Grinder',
                'description' =>
                    'Electric angle grinder suitable for cutting and grinding applications.',
                'price' => 70000,
                'stock' => 5,
                'category' => 'Tools',
            ],

        ];


        $equipments = collect();

        foreach ($equipmentData as $data) {

            $equipment = Equipment::updateOrCreate(
                [
                    'name' => $data['name'],
                ],
                [
                    ...$data,

                    'picture' => null,
                ]
            );

            $equipments->push($equipment);
        }


        /*
        |--------------------------------------------------------------------------
        | Demo Customer Rental History
        |--------------------------------------------------------------------------
        */

        $canon = $equipments->firstWhere(
            'name',
            'Canon EOS R6 Mark II'
        );

        $sony = $equipments->firstWhere(
            'name',
            'Sony A7 IV'
        );

        $gimbal = $equipments->firstWhere(
            'name',
            'DJI RS 3 Gimbal'
        );

        $projector = $equipments->firstWhere(
            'name',
            'Epson Full HD Projector'
        );

        $microphone = $equipments->firstWhere(
            'name',
            'Rode Wireless GO II'
        );


        /*
        |--------------------------------------------------------------------------
        | Pending Rental
        |--------------------------------------------------------------------------
        */

        Rental::factory()
            ->pending()
            ->create([
                'customer_id' => $demoCustomer->id,
                'equipment_id' => $projector->id,
                'quantity' => 1,
            ]);


        /*
        |--------------------------------------------------------------------------
        | Currently Rented
        |--------------------------------------------------------------------------
        |
        | Canon stock = 4.
        | Only 2 units are actively reserved here, leaving 2 available for
        | overlapping rental periods.
        |
        */

        Rental::factory()
            ->create([
                'customer_id' => $demoCustomer->id,
                'equipment_id' => $canon->id,

                'status' => 'Rented',

                'rent_date' => now()
                    ->subDay()
                    ->toDateString(),

                'return_date' => now()
                    ->addDays(4)
                    ->toDateString(),

                'quantity' => 2,
            ]);


        /*
        |--------------------------------------------------------------------------
        | Late Rental
        |--------------------------------------------------------------------------
        |
        | Late equipment remains unavailable until it is actually returned.
        |
        */

        Rental::factory()
            ->create([
                'customer_id' => $demoCustomer->id,
                'equipment_id' => $sony->id,

                'status' => 'Late',

                'rent_date' => now()
                    ->subDays(8)
                    ->toDateString(),

                'return_date' => now()
                    ->subDays(2)
                    ->toDateString(),

                'quantity' => 1,
            ]);


        /*
        |--------------------------------------------------------------------------
        | Returned Rental
        |--------------------------------------------------------------------------
        */

        Rental::factory()
            ->create([
                'customer_id' => $demoCustomer->id,
                'equipment_id' => $gimbal->id,

                'status' => 'Returned',

                'rent_date' => now()
                    ->subDays(30)
                    ->toDateString(),

                'return_date' => now()
                    ->subDays(27)
                    ->toDateString(),

                'quantity' => 2,
            ]);


        /*
        |--------------------------------------------------------------------------
        | Cancelled Rental
        |--------------------------------------------------------------------------
        */

        Rental::factory()
            ->create([
                'customer_id' => $demoCustomer->id,
                'equipment_id' => $microphone->id,

                'status' => 'Cancelled',

                'rent_date' => now()
                    ->subDays(15)
                    ->toDateString(),

                'return_date' => now()
                    ->subDays(12)
                    ->toDateString(),

                'quantity' => 1,
            ]);


        /*
        |--------------------------------------------------------------------------
        | Additional Historical Rentals
        |--------------------------------------------------------------------------
        |
        | Returned and cancelled rentals don't affect current availability.
        | These primarily make the admin dashboard/customer histories feel
        | realistic.
        |
        */

        for ($i = 0; $i < 20; $i++) {

            Rental::factory()
                ->returned()
                ->create([
                    'customer_id' => $customers->random()->id,
                    'equipment_id' => $equipments->random()->id,
                    'quantity' => 1,
                ]);
        }


        for ($i = 0; $i < 8; $i++) {

            Rental::factory()
                ->cancelled()
                ->create([
                    'customer_id' => $customers->random()->id,
                    'equipment_id' => $equipments->random()->id,
                    'quantity' => 1,
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Additional Pending Requests
        |--------------------------------------------------------------------------
        |
        | Pending requests intentionally do NOT reserve equipment.
        |
        */

        for ($i = 0; $i < 6; $i++) {

            Rental::factory()
                ->pending()
                ->create([
                    'customer_id' => $customers->random()->id,
                    'equipment_id' => $equipments->random()->id,
                    'quantity' => 1,
                ]);
        }
    }
}
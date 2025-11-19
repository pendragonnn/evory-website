<?php

namespace Database\Seeders;

use App\Models\Booth;
use App\Models\Event;
use Illuminate\Database\Seeder;

class BoothSeeder extends Seeder
{
    public function run(): void
    {
        $event1 = Event::find(1);
        $event2 = Event::find(2);
        $event3 = Event::find(3);
        $event4 = Event::find(4);
        $event5 = Event::find(5);

        // Event 1 - Tech Expo
        Booth::create([
            'event_id' => $event1->id,
            'booth_code' => 'A01',
            'type' => 'Standard',
            'size' => '3x3 m',
            'price' => 1200000,
            'status' => 'available',
            'available_start_date' => $event1->start_date,
            'available_end_date' => $event1->end_date,
        ]);

        Booth::create([
            'event_id' => $event1->id,
            'booth_code' => 'A02',
            'type' => 'Premium',
            'size' => '4x3 m',
            'price' => 1800000,
            'status' => 'available',
            'available_start_date' => $event1->start_date,
            'available_end_date' => $event1->end_date,
        ]);

        // Event 2 - Fashion Week
        Booth::create([
            'event_id' => $event2->id,
            'booth_code' => 'B01',
            'type' => 'Corner',
            'size' => '3x4 m',
            'price' => 1900000,
            'status' => 'available',
            'available_start_date' => $event2->start_date,
            'available_end_date' => $event2->end_date,
        ]);

        Booth::create([
            'event_id' => $event2->id,
            'booth_code' => 'B02',
            'type' => 'Standard',
            'size' => '3x3 m',
            'price' => 1400000,
            'status' => 'available',
            'available_start_date' => $event2->start_date,
            'available_end_date' => $event2->end_date,
        ]);

        // Event 3 - Culinary Fiesta
        Booth::create([
            'event_id' => $event3->id,
            'booth_code' => 'C01',
            'type' => 'Food Stall',
            'size' => '3x3 m',
            'price' => 1600000,
            'status' => 'available',
            'available_start_date' => $event3->start_date,
            'available_end_date' => $event3->end_date,
        ]);

        Booth::create([
            'event_id' => $event3->id,
            'booth_code' => 'C02',
            'type' => 'Food Stall',
            'size' => '3x4 m',
            'price' => 2000000,
            'status' => 'available',
            'available_start_date' => $event3->start_date,
            'available_end_date' => $event3->end_date,
        ]);

        // Event 4 - Startup Summit
        Booth::create([
            'event_id' => $event4->id,
            'booth_code' => 'D01',
            'type' => 'Startup Pod',
            'size' => '2x2 m',
            'price' => 1000000,
            'status' => 'available',
            'available_start_date' => $event4->start_date,
            'available_end_date' => $event4->end_date,
        ]);

        Booth::create([
            'event_id' => $event4->id,
            'booth_code' => 'D02',
            'type' => 'Standard',
            'size' => '3x3 m',
            'price' => 1300000,
            'status' => 'available',
            'available_start_date' => $event4->start_date,
            'available_end_date' => $event4->end_date,
        ]);

        // Event 5 - Craft Expo
        Booth::create([
            'event_id' => $event5->id,
            'booth_code' => 'E01',
            'type' => 'Craft Table',
            'size' => '2x2 m',
            'price' => 900000,
            'status' => 'available',
            'available_start_date' => $event5->start_date,
            'available_end_date' => $event5->end_date,
        ]);

        Booth::create([
            'event_id' => $event5->id,
            'booth_code' => 'E02',
            'type' => 'Craft Booth',
            'size' => '3x3 m',
            'price' => 1100000,
            'status' => 'available',
            'available_start_date' => $event5->start_date,
            'available_end_date' => $event5->end_date,
        ]);
    }
}

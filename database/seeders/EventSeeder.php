<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        Event::create([
            'event_name' => 'Tech Expo 2025',
            'location' => 'Jakarta Convention Center',
            'start_date' => '2025-03-01',
            'end_date' => '2025-03-05',
            'organizer_name' => 'Eventora',
            'description' => 'A technology showcase event.',
        ]);

        Event::create([
            'event_name' => 'Fashion Week Festival',
            'location' => 'Bandung Creative Hall',
            'start_date' => '2025-04-10',
            'end_date' => '2025-04-13',
            'organizer_name' => 'IndoFashion Group',
            'description' => 'A fashion expo for designers.',
        ]);

        Event::create([
            'event_name' => 'Culinary Fiesta',
            'location' => 'Surabaya Expo Center',
            'start_date' => '2025-05-05',
            'end_date' => '2025-05-08',
            'organizer_name' => 'FoodNation',
            'description' => 'A food festival for chefs and brands.',
        ]);

        Event::create([
            'event_name' => 'Startup Summit',
            'location' => 'ICE BSD',
            'start_date' => '2025-06-01',
            'end_date' => '2025-06-04',
            'organizer_name' => 'StartupHub',
            'description' => 'A showcase event for startup founders.',
        ]);

        Event::create([
            'event_name' => 'Craft Expo 2025',
            'location' => 'Yogyakarta Expo Hall',
            'start_date' => '2025-07-12',
            'end_date' => '2025-07-15',
            'organizer_name' => 'ArtCraft Indonesia',
            'description' => 'Craft & handmade product exhibition.',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\BookingsStatus;
use Illuminate\Database\Seeder;

class BookingsStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BookingsStatus::create([
            'status' => 'pending',
        ]);
        BookingsStatus::create([
            'status' => 'paid',
        ]);
        BookingsStatus::create([
            'status' => 'ended',
        ]);
        BookingsStatus::create([
            'status' => 'cancelled',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class weekDays extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('week_days')->insert([
            [
                'name' => 'Monday',
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Tuesday',
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Wednesday',
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Thursday',
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Friday',
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Saturday',
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Sunday',
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ]
        ]);
    }
}

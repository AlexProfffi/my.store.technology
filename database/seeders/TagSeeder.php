<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Children'
            ],
            [
                'name' => 'New Release'
            ],
            [
                'name' => 'Regular'
            ],
        ];

        \DB::table('tags')->insert($data);
    }
}

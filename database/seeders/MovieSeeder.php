<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Гарри поттер'
            ],
            [
                'name' => 'Копи Царя Соломона'
            ],
        ];

        \DB::table('movies')->insert($data);
    }
}

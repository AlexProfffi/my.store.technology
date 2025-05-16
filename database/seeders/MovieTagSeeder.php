<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MovieTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$data = [
			[
				'movie_id' => 1,
				'tag_id' => 1
			],
            [
                'movie_id' => 1,
                'tag_id' => 2
            ],
			[
				'movie_id' => 2,
                'tag_id' => 3
			],
		];


		\DB::table('movie_tag')->insert($data);
    }
}

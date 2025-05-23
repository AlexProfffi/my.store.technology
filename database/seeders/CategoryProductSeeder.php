<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class CategoryProductSeeder extends Seeder
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
				'category_id' => 1,
				'product_id' => 1
			],
			[
				'category_id' => 1,
				'product_id' => 2
			],
			[
				'category_id' => 1,
				'product_id' => 3
			],
			[
				'category_id' => 1,
				'product_id' => 4
			],
            [
                'category_id' => 1,
                'product_id' => 5
            ],
            [
                'category_id' => 1,
                'product_id' => 6
            ],
            [
                'category_id' => 1,
                'product_id' => 7
            ],
            [
                'category_id' => 1,
                'product_id' => 14
            ],
            [
                'category_id' => 1,
                'product_id' => 15
            ],
			[
				'category_id' => 2,
				'product_id' => 8
			],
			[
				'category_id' => 2,
				'product_id' => 1
			],
			[
				'category_id' => 2,
				'product_id' => 9
			],
			[
				'category_id' => 2,
				'product_id' => 10
			],
			[
				'category_id' => 3,
				'product_id' => 11
			],
			[
				'category_id' => 3,
				'product_id' => 12
			],
			[
				'category_id' => 3,
				'product_id' => 13
			],
			[
				'category_id' => 3,
				'product_id' => 14
			],
		];


		\DB::table('category_product')->insert($data);

    }
}

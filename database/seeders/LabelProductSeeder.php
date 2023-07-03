<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LabelProductSeeder extends Seeder
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
				'product_id' => 1,
				'label_id' => 1
			],
			[
				'product_id' => 1,
				'label_id' => 2
			],
			[
				'product_id' => 2,
				'label_id' => 3
			],
			[
				'product_id' => 3,
				'label_id' => 1
			],
            [
                'product_id' => 3,
                'label_id' => 2
            ],
			[
				'product_id' => 4,
				'label_id' => 1
			],
			[
				'product_id' => 5,
				'label_id' => 2
			],
			[
				'product_id' => 6,
				'label_id' => 1
			],
			[
				'product_id' => 7,
				'label_id' => 1
			],
            [
                'product_id' => 7,
                'label_id' => 3
            ],
			[
				'product_id' => 8,
				'label_id' => 1
			],
            [
                'product_id' => 9,
                'label_id' => 1
            ],
		];


		\DB::table('label_product')->insert($data);
    }
}

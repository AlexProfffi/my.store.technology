<?php

namespace Database\Seeders;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
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
                'parent_id' => 1,
				'name' => 'iPhone X 256GB',
				'description' => 'Отличный продвинутый телефон с памятью на 256 gb',
				'price' => 89990,
				'image' => '/images/AllProducts/iphone_x_silver.jpg'
			],
			[
                'parent_id' => 2,
				'name' => 'HTC One S',
				'description' => 'Зачем платить за лишнее? Легендарный HTC One S',
				'price' => 12490,
				'image' => '/images/AllProducts/htc_one_s.png'
			],
			[
                'parent_id' => 3,
				'name' => 'iPhone 5SE',
				'description' => 'Отличный классический iPhone',
				'price' => 17221,
				'image' => '/images/AllProducts/iphone_5.jpg'
			],
            [
                'parent_id' => 4,
                'name' => 'Poco',
                'description' => 'Великолепный телефон!',
                'price' => 15000,
                'image' => '/images/AllProducts/poco.jpg'
            ],
            [
                'parent_id' => 5,
                'name' => 'Benson',
                'description' => 'Отличная выдержка!',
                'price' => 10000,
                'image' => '/images/AllProducts/benson.jpg'
            ],
            [
                'parent_id' => 6,
                'name' => 'Texet',
                'description' => 'На все случаи жизни телефон!',
                'price' => 19200,
                'image' => '/images/AllProducts/texet.jpg'
            ],
			[
                'parent_id' => 7,
				'name' => 'Наушники Beats Audio',
				'description' => 'Отличный звук от Dr. Dre',
				'price' => 20221,
				'image' => '/images/AllProducts/beats.jpg'
			],
			[
                'parent_id' => 8,
				'name' => 'Камера GoPro',
				'description' => 'Снимай самые яркие моменты с помощью этой камеры',
				'price' => 12000,
				'image' => '/images/AllProducts/gopro.jpg'
			],
			[
                'parent_id' => 9,
				'name' => 'Камера Panasonic HC-V770',
				'description' => 'Для серьёзной видео съемки нужна серьёзная камера. Panasonic HC-V770 для этих целей лучший выбор!',
				'price' => 27900,
				'image' => '/images/AllProducts/video_panasonic.jpg'
			],
			[
                'parent_id' => 10,
				'name' => 'Кофемашина DeLongi',
				'description' => 'Хорошее утро начинается с хорошего кофе!',
				'price' => 25200,
				'image' => '/images/AllProducts/delongi.jpg'
			],
			[
                'parent_id' => 11,
				'name' => 'Холодильник Haier',
				'description' => 'Для большой семьи большой холодильник!',
				'price' => 40200,
				'image' => '/images/AllProducts/haier.jpg'
			],
			[
                'parent_id' => 12,
				'name' => 'Блендер Moulinex',
				'description' => 'Для самых смелых идей',
				'price' => 4200,
				'image' => '/images/AllProducts/moulinex.jpg'
			],
			[
                'parent_id' => 13,
				'name' => 'Мясорубка Bosch',
				'description' => 'Любите домашние котлеты? Вам определенно стоит посмотреть на эту мясорубку!',
				'price' => 9200,
				'image' => '/images/AllProducts/bosch.jpg'
			],
            [
                'parent_id' => 14,
                'name' => 'Toren1',
                'description' => 'Любите домашние котлеты? Вам определенно стоит посмотреть на эту мясорубку!',
                'price' => 9200,
                'image' => '/images/AllProducts/bosch.jpg'
            ],
            [
                'parent_id' => 15,
                'name' => 'Toren2',
                'description' => 'Любите домашние котлеты? Вам определенно стоит посмотреть на эту мясорубку!',
                'price' => 9200,
                'image' => '/images/AllProducts/bosch.jpg'
            ],
		];


//		$count = count($data);
//
//		for($i = 0; $i < $count; $i++)
//		{
//			$data[$i]['created_at'] = Carbon::now()->format('Y-m-d H:i:s');
//			$data[$i]['updated_at'] = $data[$i]['created_at'];
////			$data[$i]['image'] = 'http://internet-shop.tmweb.ru/storage/products/iphone_x.jpg';
//		}



		\DB::table('products')->insert($data);

    }
}

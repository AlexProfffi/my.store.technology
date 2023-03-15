<?php

namespace App\Models;

use App\Services\Filterer\Filterer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use HasFactory, \Staudenmeir\EloquentEagerLimit\HasEagerLimit;


    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot',
    ];


	// ========== RELATIONSHIPS ============

    public function products() {

    	return $this->belongsToMany(Product::class);
	}


	// =========== METHODS =============


    /**
     * category->products
     *
     * @param Filterer $filterer
     * @param Category $category
     * @return Category
     */
	public function paginateCategoryWithProducts(Filterer $filterer, Category $category): Category {


		$category->setRelation('products', $category->products()

			->filters($filterer)

			->select(['id', 'name', 'price', 'image'])

			->orderBy('updated_at', 'desc')

			->with('labels')

			->paginate(6)->withQueryString());


		return $category;
	}


	public function getCategoriesDPC() {

    	$columns = [
    		'id',
			'name',
		];

    	$categories = $this
			->select($columns)
			->get();

    	return $categories;
	}


	public function getCategoriesDPCE() {

		$columns = [
			'id',
			'name',
		];

		$categories = $this
			->select($columns)
			->get();

		return $categories;
	}


}

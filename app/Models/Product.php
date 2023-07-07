<?php

namespace App\Models;


use App\Services\Filterer\Filterer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;


class Product extends Model
{
    use HasFactory, \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

	protected $guarded = [];

	protected $hidden = [
        'pivot',
        'created_at',
        'updated_at'
    ];


	// ========== RELATIONSHIPS ============

    public function categories()
	{
    	return $this->belongsToMany(Category::class);
	}

	public function labels()
	{
		return $this->belongsToMany(Label::class);
	}

    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    public function children()
    {
        return $this->hasOne(self::class, 'parent_id');
    }


	// =========== METHODS =============


	public function scopeFilters(Builder $builder, Filterer $filterer): Builder {

    	return $filterer->apply($builder);
	}


	public function firstProductCategoriesCP($category, $product) {

		$columnsProduct = [
			'id',
			'name',
			'image',
			'price',
			'description',
		];

		$columnsCategories = [
			'id',
			'name',
			'slug',
		];

		$product = $this
			->select($columnsProduct)
			->with(['categories' => function($query) use($category, $columnsCategories) {
				$query
					->select($columnsCategories)
					->where('slug', $category);
			}])
			->find($product);


		return $product;
	}


    /**
     * product->categories
     *
     * @param string $categorySlug
     * @param int $productId
     * @return Product
     */
	public function findProductWithRelations(string $categorySlug, int $productId): Product {

		return $this

			->with(['categories' => function($query) use($categorySlug) {
				$query
					->where('slug', $categorySlug);
			}])

			->find($productId);
	}


	public function paginateProductsCategoriesDP() {

		$columnsProduct = [
			'id',
			'name',
			'price',
			'image',
		];

    	$products = $this
			->select($columnsProduct)
			->orderBy('updated_at', 'desc')
            ->orderBy('id')
			->with('categories:id,name')
			->paginate(4);

    	return $products;
	}


	public function firstProductDPCE($product) {

		$columnsProduct = [
			'id',
			'name',
			'description',
			'price',
			'image',
		];

		$product = $this
			->select($columnsProduct)
			->find($product);


		return $product;
	}
}

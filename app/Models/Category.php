<?php

namespace App\Models;

use App\Services\Filterer\Filter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Staudenmeir\EloquentEagerLimit\Relations\BelongsToMany;


class Category extends Model
{
    use HasFactory, \Staudenmeir\EloquentEagerLimit\HasEagerLimit;


    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


	// ========== RELATIONSHIPS ============

    public function products() {

    	return $this->belongsToMany(Product::class);
	}


	// =========== METHODS =============

    public function initialValuesProductFilterer(array $productRequest): array {

        //$productRequest = $this->priceFromTo($productRequest);

        return $productRequest ;
    }


//    public function priceFromTo(array $productRequest): array {
//
//        $this->
//    }


    /**
     * categories->products->labels
     *
     * @return Collection
     */
    public function getCategoriesWithRelations(): Collection {

        return $this

            ->select(['id', 'name', 'slug'])

            ->with(['products' => function($query) {
                $query
                    ->select(['id', 'name', 'price', 'image'])

                    ->with('labels:id,name,class')

                    ->take(3); // package eloquent-eager-limit
            }])

            ->whereIn('slug', ['mobilnye-telefony', 'portativnaia-texnika'])

            ->get();
    }


    /**
     * category->products->labels
     *
     * @param BelongsToMany $queryProductFilter
     * @return void
     */
	public function paginateProductsWithRelations(BelongsToMany $queryProductFilter): void {

		$this->setRelation('products', $queryProductFilter

            ->orderBy('updated_at', 'desc')
            ->orderBy('id')

			->with('labels')

			->paginate(6, ['id', 'name', 'price', 'image'])
            ->withQueryString()
        );
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

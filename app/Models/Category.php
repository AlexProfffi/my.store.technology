<?php

namespace App\Models;

use App\Services\Filterer\Filterer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;


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

            ->whereIn('slug', ['mobilnye-telefony', 'portativnaya-texnika'])

            ->get();
    }


    /**
     * category->products->labels
     *
     * @param Filterer $filterer
     * @return void
     */
	public function paginateProductsWithRelations(Filterer $filterer): void {


		$this->setRelation('products', $this->products()

			->filters($filterer)

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

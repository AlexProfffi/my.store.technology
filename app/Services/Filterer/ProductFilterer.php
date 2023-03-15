<?php

namespace App\Services\Filterer;

use Illuminate\Database\Eloquent\Builder;


class ProductFilterer extends Filterer {


	protected function label_ids($requestItems) {

		$this->builder->whereHas('labels', function(Builder $query) use($requestItems) {
			$query->whereIn('id', $requestItems);
		});
	}


    protected function price_from($requestItem) {

		$this->builder->where('price', '>=', $requestItem);
	}


    protected function price_to($requestItem) {

		$this->builder->where('price', '<=', $requestItem);
	}
}

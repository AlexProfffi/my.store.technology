<?php

namespace App\Services\Filter;


class ProductFilter extends Filter {

	protected function label_ids(array $requestItems) {

		$this->builder->whereHas('labels', function($query) use($requestItems) {
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

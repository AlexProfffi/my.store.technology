<?php

namespace App\Services\Filterer;

use Illuminate\Database\Eloquent\Builder;


abstract class Filterer {

	protected Builder $builder;
    protected array $requestItems;

    public function __construct(array $requestItems) {

        $this->requestItems = $requestItems;
    }


    /**
     * Applying filters.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder): Builder {

        $this->builder = $builder;


        foreach($this->requestItems as $requestName => $requestItem) {

            if(method_exists($this, $requestName)) {

                call_user_func_array([$this, $requestName], array_filter([$requestItem]));
            }
        }

        return $this->builder;
    }


}

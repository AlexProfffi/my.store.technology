<?php

namespace App\Traits\Filter;

use Illuminate\Database\Eloquent\Builder;

trait HasFilter {

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

        $this->callRequests($this->requestItems);

        return $this->builder;
    }

    /**
     * @param array $requestItems
     * @return void
     */
    protected function callRequests(array $requestItems): void {

        foreach($requestItems as $requestName => $requestItem) {

            if(is_array($requestItem))
                $this->callRequests($requestItem);

            if(method_exists($this, $requestName)) {
                call_user_func_array([$this, $requestName], array_filter([$requestItem]));
            }
            else return;
        }
    }
}

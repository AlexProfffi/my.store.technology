<?php

namespace App\Traits\Filter;

trait StringToArrayForRequestKeys
{
    // Before validation
    protected function prepareForValidation(): void
    {
        $requestItems = $this->all();

        if(isset($requestItems[$this->prefix]))
            $requestItems = $requestItems[$this->prefix];

        // Converting the required filter values into an array.
        if(count($requestItems))
        {
            $intersectFilter =
                array_intersect_key($requestItems, array_flip($this->requestKeys ?? []));

            $mergedFilter = $requestItems;

            foreach($intersectFilter as $key => $value) {

                if(gettype($value) === 'string')
                {
                    $mergedFilter = array_merge($mergedFilter,
                    [
                        $key => explode(',', $value),
                    ]);
                }
            }

            $this->merge($this->prefix ? [$this->prefix => $mergedFilter] : $mergedFilter); // modify request
        }
    }
}

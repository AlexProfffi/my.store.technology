<?php

namespace App\Traits\Filter;

trait Prefix
{
    protected function usePrefix(array $validationRules) {

        if($this->prefix)
        {
            $newValidationRules = [];

            foreach ($validationRules as $key => $value) {
                $newValidationRules[$this->prefix . '.' . $key] = $value;
            }

            $newValidationRules[$this->prefix] = ['array'];

            return $newValidationRules;
        }
        else return $validationRules;
    }
}

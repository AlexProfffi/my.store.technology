<?php

namespace App\Http\Requests\Shop;

use Illuminate\Foundation\Http\FormRequest;


class ProductRequest extends FormRequest
{
    public function rules()
    {
		return [
			'price_from' => ['numeric', 'min:1', 'max:1000000000'],
			'price_to' => ['numeric', 'min:1', 'max:1000000000'],

			'label_ids' => ['nullable', 'array'],
			'label_ids.*' => ['exists:labels,id']
		];

    }
}

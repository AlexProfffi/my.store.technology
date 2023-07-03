<?php

namespace App\Http\Requests\Shop;

use Illuminate\Foundation\Http\FormRequest;


class CartRequest extends FormRequest
{
    public function rules()
    {
		return [
			'quantity' => ['required', 'integer', 'numeric', 'between:1,10000'],
		];

    }
}

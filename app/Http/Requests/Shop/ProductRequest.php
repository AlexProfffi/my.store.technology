<?php

namespace App\Http\Requests\Shop;

use App\Traits\Filter\Prefix;
use App\Traits\Filter\StringToArrayForRequestKeys;
use Illuminate\Foundation\Http\FormRequest;


class ProductRequest extends FormRequest
{
    use Prefix, StringToArrayForRequestKeys;

    public ?string $prefix = null;

    protected array $requestKeys = [
        'label_ids'
    ];

    public function rules()
    {
		return $this->usePrefix([
            'price_from' => ['numeric', 'min:1', 'max:1000000000'],
            'price_to' => ['numeric', 'min:1', 'max:1000000000'],
            'label_ids' => ['array'],
            'label_ids.*' => ['exists:labels,id'],
		]);
    }
}

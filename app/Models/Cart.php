<?php

namespace App\Models;

use App\Events\MyEvent;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Cart extends Model
{
    use HasFactory;

	protected $guarded = [];

    protected function data(): Attribute
    {
        return new Attribute(
            get: fn(string $value) => unserialize($value),
            set: fn(Collection $value) => serialize($value)
        );
    }

//    protected $casts = [
//        'data' => 'array'
//    ];

	protected $table = 'carts';
}


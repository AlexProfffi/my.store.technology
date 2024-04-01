<?php

namespace App\Services\Cart;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Facade;

abstract class CartStorage
{
    public static function getAuthUserStorage(): self {

        $user = auth()->user();

        $storageClassName =
            config('shopping_cart.auth_user_storage');

        return new $storageClassName($user);
    }

    public static function clearContainer(string $containerName): void {

        App::forgetInstance($containerName);
        Facade::clearResolvedInstance($containerName);
    }
}

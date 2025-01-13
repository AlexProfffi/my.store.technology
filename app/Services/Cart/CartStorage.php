<?php

namespace App\Services\Cart;

use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Facade;

abstract class CartStorage
{
    protected static User $user;

    public function __construct() {

        static::$user = auth()->user();
    }

    public static function getAuthUserStorage(): self {

        $storageClassName =
            config('shopping_cart.auth_user_storage');

        return new $storageClassName();
    }

    public static function checkUserFromSession(): bool
    {
        return
            (bool) session(auth()->getName());
    }

    public static function clearContainer(string $containerName): void {

        App::forgetInstance($containerName);
        Facade::clearResolvedInstance($containerName);
    }
}

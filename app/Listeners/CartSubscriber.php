<?php

namespace App\Listeners;

use App\Services\Cart\CartDbStorage;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

class CartSubscriber
{
    public function handleLogin(Login $event): void {

        //CartDbStorage::mergeSessionWithDb();
        CartDbStorage::transferSessionToDb();
    }

    public function handleLogout(Logout $event): void {

//        CartDbStorage::transferNullToStorage();
//        CartDbStorage::transferDbToSession();
    }

    public function subscribe(): array {

        return [
            Login::class => [
                'handleLogin',
            ],
            Logout::class => [
                'handleLogout',
            ],
        ];
    }
}

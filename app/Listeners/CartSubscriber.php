<?php

namespace App\Listeners;

use App\Events\LogoutAfter;
use App\Services\Cart\CartDbStorage;
use Illuminate\Auth\Events\Login;

class CartSubscriber
{
    public function handleLogin(Login $event): void {

        CartDbStorage::mergeSessionWithDb();
    }

    public function handleLogout(LogoutAfter $event): void {

        CartDbStorage::TransferDbToSession($event->user);
    }

    public function subscribe(): array {
        return [
            Login::class => [
                'handleLogin',
            ],
            LogoutAfter::class => [
                'handleLogout',
            ],
        ];
    }
}

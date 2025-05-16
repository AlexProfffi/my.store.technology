<?php

namespace App\Models;

use App\Traits\WithRent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use WithRent, HasFactory, Notifiable, HasRoles, HasApiTokens;

	protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
		'cart_collection' => 'array'
    ];


	// ========== RELATIONSHIPS ============

	public function cart()
	{
		return $this->hasOne(Cart::class);
	}

    public function rent(): HasOne
    {
        return $this->hasOne(Rent::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Rent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class)
            ->withTimestamps()->withPivot('days', 'instance_id');
    }
}

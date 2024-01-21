<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pilot extends Model
{
    use HasFactory;

    const STATUS_AVAILABLE = 0;
    const STATUS_FLIGHT = 1;
    const STATUS_RESERVATION = 2;

    protected $fillable = ['name', 'status'];
    public function flights(): HasMany
    {
        return $this->hasMany(Flight::class);
    }
}

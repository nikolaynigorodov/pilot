<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = ['drone', 'start_date', 'end_date', 'pilot_id', 'drone_id', 'flight_status'];

    public function pilot(): BelongsTo
    {
        return $this->belongsTo(Pilot::class);
    }

    public function drone(): BelongsTo
    {
        return $this->belongsTo(Drone::class);
    }
}

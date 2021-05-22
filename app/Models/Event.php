<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Event extends Model
{
    public function scopeGetEventsWithWorkshops($query)
    {
        return $query->with(['workshops']);
    }
    
    public function workshops()
    {
        return $this->hasMany(Workshop::class);
    }

    public function scopeGetFutureEventsWithWorkshops($query)
    {
        return $query->with(['workshops'])
            ->whereHas('workshops', function ($q) {
                $value = Carbon::now();
                return $q->where('start', '>', $value);
            });
    }
}

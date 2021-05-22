<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}

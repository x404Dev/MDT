<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    use HasFactory;

    public function charges() {
        return $this->hasMany(Charge::class);
    }

    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }
}

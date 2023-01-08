<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dossier;
use App\Models\User;

class Mandat extends Model
{
    use HasFactory;

    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }

    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }
}

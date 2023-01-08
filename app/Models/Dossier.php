<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
    use HasFactory;


    public function rapports() {
        return $this->hasMany(Rapport::class);
    }

    public function mandats() {
        return $this->hasMany(Mandat::class);
    }
}

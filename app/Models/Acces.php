<?php

namespace App\Models;

use App\Models\User;
use App\Models\Etape_modele;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Acces extends Model
{
    use HasFactory;

    public function users(){
        return $this->hasMany(User::class);
    }
      public function etapes_modeles(){
        return $this->hasMany(Etape_modele::class);
    }
}

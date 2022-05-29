<?php

namespace App\Models;

use App\Models\Procedure;
use App\Models\Etape_modele;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Procedure_modele extends Model
{
    use HasFactory;

    public function procedures(){
        return $this->hasMany(Procedure::class);
    }
    public function etape_modeles(){
        return $this->hasMany(Etape_modele::class,'id');
    }
}

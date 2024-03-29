<?php

namespace App\Models;

use App\Models\Acces;
use App\Models\Etape;
use App\Models\Procedure_modele;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etape_modele extends Model
{
    use HasFactory;
    
     public function procedures(){
        return $this->belongsToMany(Procedure_modele::class,'pivot_table_modeleprocedure_etape','etape_modele_id','procedure_modeles_id');
    }
    public function etapes(){
        return $this->hasMany(Etape::class);
    }
     public function acces(){
        return $this->belongsTo(Acces::class);
    }
}

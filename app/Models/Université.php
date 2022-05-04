<?php

namespace App\Models;

use App\Models\Faculte;
use App\Models\Entreprise;
use App\Models\Travailleur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Université extends Model
{
    use HasFactory;

    public function facultes(){
        return $this->hasMany(Faculte::class,'id');
    }
    public function travailleur(){
        return $this->belongsToMany(Travailleur::class,'pivot_table_ent_trav_univ','université_id','travailleur_id');
    }
    public function entreprises(){
        return $this->belongsToMany(Entreprise::class,'pivot_table_ent_trav_univ','université_id','entreprise_id');
    }
}

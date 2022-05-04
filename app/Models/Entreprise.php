<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;
    public function travailleur(){
        return $this->belongsToMany(Travailleur::class,'pivot_table_ent_trav_univ','entreprise_id','travailleur_id');
    }
    public function universites(){
        return $this->belongsToMany(Université::class,'pivot_table_ent_trav_univ','entreprise_id','université_id');
    }
}

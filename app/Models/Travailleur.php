<?php

namespace App\Models;

use App\Models\User;
use App\Models\Entreprise;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Travailleur extends Model
{
    use HasFactory;
    public function user(){
         return $this->belongsTo(User::class, 'id');
    }
    public function universites(){
        return $this->belongsToMany(Universite::class,'pivot_table_ent_trav_univ','travailleur_id','université_id'));
    }
    public function entreprises(){
        return $this->belongsToMany(Entreprise::class,'pivot_table_ent_trav_univ','travailleur_id','entreprise_id');
    }
}

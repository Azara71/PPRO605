<?php

namespace App\Models;

use App\Models\Faculte;
use App\Models\Etudiant;
use App\Models\Université;
use App\Models\Travailleur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faculte extends Model
{
    use HasFactory;
    public function universite(){
        return $this->belongsTo(Université::class,'id');
    }
    public function travailleurs(){
         return $this->HasMany(Travailleur::class,'pivot_table_ent_trav_fac','id');
    }
    public function etudiants(){ 
        return $this->belongsToMany(Etudiant::class,'pivot_table_etudiant_faculte');
    }
    public function jobs(){
        return $this->HasMany(Job::class,'pivot_table_ent_fac_job','id');
    }
}

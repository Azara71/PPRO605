<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    protected $fillable=[
        'num_siret',
        'nom_entreprise',
        'adresse_entreprise',
    ];
    use HasFactory;
    public function travailleur(){
        return $this->belongsToMany(Travailleur::class,'pivot_table_ent_trav_univ','entreprise_id','travailleur_id');
    }
    public function universites(){
        return $this->belongsToMany(Université::class,'pivot_table_ent_trav_univ','entreprise_id','université_id');
    }
    public function jobs(){
        return $this->HasMany(Job::class,'pivot_table_ent_trav_univ','id');
    }
}

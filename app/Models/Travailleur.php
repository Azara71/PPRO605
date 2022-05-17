<?php

namespace App\Models;

use App\Models\Job;
use App\Models\User;
use App\Models\Faculte;
use App\Models\Entreprise;
use App\Models\Université;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Travailleur extends Model

{ protected $fillable = [
    'job_id',
  
];
    use HasFactory;
    public function user(){
         return $this->HasOne(User::class, 'id','id');
    }
    public function facultes(){
        return $this->belongsToMany(Faculte::class,'pivot_table_ent_trav_fac','travailleur_id','faculte_id');
    }
    public function universites(){
        return $this->HasManyThrough(Université::class,Faculte::class);
    }
    public function entreprises(){
        return $this->belongsToMany(Entreprise::class,'pivot_table_ent_trav_fac','travailleur_id','entreprise_id');
    }
    public function job(){
        return $this->belongsTo(Job::class,'job_id');
    }
    
}

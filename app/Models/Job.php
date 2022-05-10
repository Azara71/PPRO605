<?php

namespace App\Models;

use App\Models\Faculte;
use App\Models\Entreprise;
use App\Models\Travailleur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;
    
    public function facultes(){ 
        return $this->belongsToMany(Faculte::class,'pivot_table_ent_fac_job','job_id','faculte_id');
    }
    public function entreprises(){
        return $this->belongsToMany(Entreprise::class,'pivot_table_ent_fac_job','job_id','entreprise_id');
    }
    public function travailleurs(){
        return $this->hasMany(Travailleur::class,'id');
    }

}

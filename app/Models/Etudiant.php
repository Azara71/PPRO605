<?php

namespace App\Models;

use App\Models\User;
use App\Models\Université;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etudiant extends Model

{    protected $fillable = [
    'num_etudiant',
    'annee',
  
];

    use HasFactory;
    public function user(){
          return $this->hasOne(User::class,'');
      
     
    }

    public function facultes(){ 
        return $this->belongsToMany(Faculte::class,'pivot_table_etudiant_faculte');
    }

}

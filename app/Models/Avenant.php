<?php

namespace App\Models;

use App\Models\Procedure;
use App\Models\Convention;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Avenant extends Model
{
    protected $fillable=[
        'chemin_avenant',
        'etat_avenant',
        'date_debut',
        'date_fin',
        'procedure_id',
        'convention_id',
    ];
    use HasFactory;
    public function procedure(){
        return $this->HasOne(Procedure::class,'id','procedure_id');
    }
    public function convention(){
        return $this->belongsTo(Convention::class,'id');
    }
}

<?php

namespace App\Models;

use App\Models\Etape;
use App\Models\Avenant;
use App\Models\Convention;
use App\Models\Procedure_modele;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Procedure extends Model
{
        use HasFactory;
    protected $fillable = [
        'num_etape',
        'procedure_modeles_id',
        'nombre_etapes_max',
        'created_at',
        'updated_at',
    ];

    public function convention(){
        return $this->belongsTo(Convention::class);
    }
    public function etapes(){
        return $this->belongsToMany(Etape::class,'pivot_table_etape_procedure');
    }
    public function procedure_modele(){
        return $this->belongsTo(Procedure_modele::class,'procedure_modeles_id');
    }
    public function avenant(){
        return $this->belongsTo(Avenant::class,'id');
    }
    
}

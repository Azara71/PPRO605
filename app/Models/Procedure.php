<?php

namespace App\Models;

use App\Models\Etape;
use App\Models\Convention;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Procedure extends Model
{
    use HasFactory;
    public function convention(){
        return $this->belongsTo(Convention::class);
    }
    public function etapes(){
        return $this->belongsToMany(Etape::class,'pivot_table_etape_procedure');

    }
    
}

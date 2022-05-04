<?php

namespace App\Models;

use App\Models\Procedure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etape extends Model
{
    use HasFactory;
    public function procedures(){
        return $this->belongsToMany(Procedure::class,'pivot_table_etape_procedure');

    }
}

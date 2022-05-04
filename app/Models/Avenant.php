<?php

namespace App\Models;

use App\Models\Procedure;
use App\Models\Convention;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Avenant extends Model
{
    use HasFactory;
    public function procedure(){
        return $this->belongsTo(Procedure::class,'id');
    }
    public function convention(){
        return $this->belongsTo(Convention::class,'id');
    }
}

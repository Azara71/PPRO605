<?php

namespace App\Models;

use App\Models\Faculte;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faculte extends Model
{
    use HasFactory;
    public function universite(){
        return $this->belongsTo(Faculte::class,'id');
    }
}

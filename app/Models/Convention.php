<?php

namespace App\Models;

use App\Models\Avenant;
use App\Models\Procedure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Convention extends Model
{
    use HasFactory;
    public function procedure()
    {
        return $this->hasOne(Procedure::class,'id');
    }
    public function avenants()
    {
        return $this->hasMany(Avenant::class,'id');
    }
    public function users(){ 
        return $this->belongsToMany(User::class,'pivot_table_convention_user');
    }
}

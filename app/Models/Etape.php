<?php

namespace App\Models;

use App\Models\Procedure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etape extends Model
{
    protected $fillable=[
        'description',
        'etat',
        'created_at',
        'updated_at',
        'etape_modele_id',
    ];
    use HasFactory;
    public function procedures(){
        return $this->belongsToMany(Procedure::class,'pivot_table_etape_procedure');
    }
}

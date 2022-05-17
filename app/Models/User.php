<?php

namespace App\Models;

use App\Models\Etudiant;
use App\Models\Convention;
use App\Models\Université;
use App\Models\Travailleur;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'statut',
        'password',
        'etudiant_id',
        'travailleur_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function etudiant()
    {
           return $this->belongsTo(Etudiant::class);
    }
    public function travailleur(){
        return $this->belongsTo(Travailleur::class,'travailleur_id','id');
    }
    public function conventions(){ 
        return $this->belongsToMany(Convention::class,'pivot_table_convention_user','convention_id','user_id');
    }
    public function convention(){
        return $this->belongsTo(Convention::class,'tuteur_id');
    }
    
}

<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\UserSecteur;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use ChristianKuri\LaravelFavorite\Traits\Favoriteability;


class User extends Authenticatable
{
    use HasFactory, Notifiable, Favoriteability;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'etablissement_id',
        'nom',
        'prenom',
        'email',
        'password',
        'phone',
        'nom_entreprise',
        'wilaya',
        'commune',
        'secteurs',
        'type_user',
        'exp',
        'etat',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Expired(Offre $offre = null)
    {
        $expired = true;

        //check if admin
        if(Auth::check() && Auth::user()->type_user === 'admin'){
            return false;
        }

        // check if account suspended
        if(Auth::check() && Auth::user()->etat === 'desactive'){
            return true;
        }

        // check if content creator & owner
        if(Auth::check() && (Auth::user()->type_user === 'content' || Auth::user()->type_user === 'publisher')){
            return $offre->user_id != Auth::id();
        }

        // check expiration date
        if(Auth::check()){
            $expired = Carbon::createFromFormat('Y-m-d', Auth::user()->exp)->isPast();
        }

        // check sectors
        if($offre && !$expired && Auth::check()){
            // get user sectors
            $user_sec = [];
            foreach(Auth::user()->secteur as $sec){
                $user_sec[] = $sec->id;
            }

            // get offre sectors
            $offre_sec = [];
            foreach($offre->secteur as $sec){
                $offre_sec[] = $sec->id;
            }

            if(count(array_intersect($user_sec,$offre_sec)) > 0){
                $expired = false;
            }else{
                $expired = true;
            }
        }

        return $expired;
    }

    public function offre()
    {
        return $this->hasMany(Offre::class);
    }

    public function usersecteur()
    {
        return $this->hasMany(UserSecteur::class);
    }

    public function secteur()
    {
        return $this->belongsToMany(Secteur::class, 'user_secteur');
    }

    public function etablissement()
    {
        return $this->belongsto(Etablissement::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notif extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'frequence',
        'statut',
    ];
    
    public function secteur()
    {
        return $this->belongsToMany(Secteur::class, 'notif_secteur');
    }

    public function wilaya()
    {
        return $this->hasMany(Wilaya::class);
    }

    public function keyword()
    {
        return $this->hasMany(Keyword::class);
    }
}
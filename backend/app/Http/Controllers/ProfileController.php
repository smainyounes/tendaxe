<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        // get current user offers
        $offres = Offre::where('user_id', Auth::id())->latest()->paginate(5);

        // get etablissement img
        $etab = Auth::user()->etablissement;

        $img = null;

        if($etab && $etab->category === "AUTRE"){
            $img = $etab->logo;
        }

        return view('profile', [
            'offres' => $offres,
            'logo' => $img,
        ]);
    }
}

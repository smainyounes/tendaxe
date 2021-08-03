<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Offre;
use App\Models\Secteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchOffreController extends Controller
{
    public function index(Request $request)
    {
        $expired = true;
        if(Auth::check()){
            if(Auth::user()->type_user === "content"){
                $expired = true;
                $secteurs = Secteur::all();
            }elseif(Auth::user()->type_user === "admin" || Auth::user()->type_user === "publisher"){
                $expired = false;
                $secteurs = Secteur::all();
            }else{
                $secteurs = Auth::user()->secteur;
                $expired = ((Auth::user()->etat === "desactive") || (Carbon::createFromFormat('Y-m-d', Auth::user()->exp)->isPast()));
            }
        }else{
            $secteurs = Secteur::all();
        }
        
        $user_secteur_ids = [];
        foreach($secteurs as $sec){
            $user_secteur_ids[] = $sec->id;
        }  

        if(Auth::check() && Auth::user()->type_user === "publisher"){
            $offres = Auth::user()->offre();
        }else{
            $offres = Offre::where('etat', 'active');
        }

        if($request->has('secteur')){
            for($i=0; $i< count($request->secteur); $i++){
                if(!in_array($request->secteur[$i], $user_secteur_ids)){
                    unset($request->secteur[$i]);
                }
            }
            $user_secteur_ids = $request->secteur;
        }

        $offres = $offres->whereHas('secteur', function($q) use($user_secteur_ids) {
            $q->whereIn('secteur_id', $user_secteur_ids);
        });
        
        if($request->has('keyword')){
            $offres = $offres->where('titre', 'LIKE', "%{$request->keyword}%");
        }

        if($request->has('wilaya') && $request->wilaya){
            $offres = $offres->where('wilaya', $request->wilaya);
        }

        if($request->has('statut') && $request->statut){
            $offres = $offres->where('statut', $request->statut);
        }

        if($request->has('type') && $request->type){
            $offres = $offres->where('type', $request->type);
        }

        if($request->has('pub') && $request->pub){
            switch($request->pub){
                case 'today': $offres = $offres->whereDate('date_pub', Carbon::today());
                    break;
                case 'week': $offres = $offres->whereBetween('date_pub', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    break;
                case 'month': $offres = $offres->whereBetween('date_pub', [Carbon::now()->firstOfMonth(), Carbon::now()->endOfMonth()]);
                    break;
                case '3months': $offres = $offres->whereBetween('date_pub', [Carbon::now()->subMonth(3), Carbon::now()]);
                    break;
            }
        }

        if($request->has('limit') && $request->limit){
            switch($request->limit){
                case 'today': $offres = $offres->whereDate('date_limit', Carbon::today());
                    break;
                case 'week': $offres = $offres->whereBetween('date_limit', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    break;
                case 'month': $offres = $offres->whereBetween('date_limit', [Carbon::now()->firstOfMonth(), Carbon::now()->endOfMonth()]);
                    break;
                case '3months': $offres = $offres->whereBetween('date_limit', [Carbon::now()->subMonth(3), Carbon::now()]);
                    break;
            }
        }

        $offres = $offres->latest('date_pub')->paginate(10);

        //dd($offres);

        return view('offers.search', [
            'secteurs' => $secteurs,
            'offres' => $offres,
            'expired' => $expired,
        ]);
    }

    public function detail(Request $request, $offre_id)
    {
        // get offre infos 
        if(Auth::check() && Auth::user()->type_user === "admin"){
            $offre = Offre::withTrashed()->where('id', $offre_id)->with('secteur','user')->first();
        }else{
            $offre = Offre::where('etat', 'active')->where('id', $offre_id)->with('secteur','user')->first();
        }

        if(!$offre)
            return abort(404);

        $img = null;
        $etab = null;

        if($offre->user->type_user === "content"){
            if( $offre->user->etablissement->category === "AUTRE"){
                $img = $offre->user->etablissement->logo;
            }else{
                $img = "default";
            }

            $etab = $offre->user->etablissement;
        }

        if($offre->user->type_user === "admin" || $offre->user->type_user === "publisher"){
            if( $offre->adminetab->category === "AUTRE"){
                $img = $offre->adminetab->logo;
            }else{
                $img = "default";
            }

            $etab = $offre->adminetab;
        }

        // dd($offre->journalar);

        $expired = $this->Expired($offre);
        
        return view('offers.detail',[
            'expired' => $expired,
            'offre' => $offre,
            'img' => $img,
            'etab' => $etab,
            'journal_ar' => $offre->journalar,
            'journal_fr' => $offre->journalfr,
        ]);
    }

    private function Expired(Offre $offre = null)
    {
        $expired = true;

        //check if admin
        if(Auth::check() && Auth::user()->type_user === 'admin'){
            return false;
        }

        // check if content creator & owner
        if(Auth::check() && (Auth::user()->type_user === 'content' || Auth::user()->type_user === 'publisher')){
            return $offre->user_id != Auth::id();
        }

        // check if account suspended
        if(Auth::check() && Auth::user()->etat === 'desactive'){
            return true;
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
}

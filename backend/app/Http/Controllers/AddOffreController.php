<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class AddOffreController extends Controller
{
    public function index()
    {
        if(Auth::user()->type_user === "content"){
            return view('offers.add');
        }

        if(Auth::user()->type_user === "abonné"){
            return view('offers.add2');
        }

        return abort(404);
    }

    public function store(Request $request)
    {
        if(Auth::user()->type_user === 'content'){
             // validation
            $this->validate($request, [
                'titre' => 'required|max:255',
                'description' => 'max:5000',
                'date_pub' => 'required|date',
                'date_lim' => 'required|date',
                'secteur' => 'required|array',
                'statut' => 'required|max:255',
                'wilaya_offre' => 'max:255',
                'type' => 'in:national,international',
                'prix' => 'nullable|numeric',
                'journal_ar' => 'required|numeric',
                'journal_fr' => 'required|numeric',
                'photo' => 'required_if:description,value|mimes:jpeg,jpg,png|max:10000', // max 10000kb
                'photo2' => 'required_if:description,value|mimes:jpeg,jpg,png|max:10000', // max 10000kb
                ]);
            
            // check if new jornal is sent
            if($request->journal_ar == 0){
                $id_ar = $this->AddJournal($request, "ar");
            }elseif($request->journal_ar == -1){
                $id_ar = null;
            }else{
                $id_ar = $request->journal_ar;
            }

            if($request->journal_fr == 0){
                $id_fr = $this->AddJournal($request, "fr");
            }elseif($request->journal_fr == -1){
                $id_fr = null;
            }else{
                $id_fr = $request->journal_fr;
            }

            $fileName = null;

            // upload offer img
            if ($request->hasFile('photo')) {
                $image      = $request->file('photo');
                $fileName   = time() . '.' . $image->getClientOriginalExtension();

                $img = Image::make($image->getRealPath());
                $img->resize(1200, 1200, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $img->stream(); // <-- Key point

                // dd($fileName);
                Storage::disk('local')->put('public/' . $fileName, $img);
            }

            $fileName2 = null;

            if ($request->hasFile('photo2')) {
                $image      = $request->file('photo2');
                $fileName2   = time() . '.' . $image->getClientOriginalExtension();

                $img = Image::make($image->getRealPath());
                $img->resize(1200, 1200, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $img->stream(); // <-- Key point

                // dd($fileName2);
                Storage::disk('local')->put('public/' . $fileName2, $img);
            }

            $wilaya = null;

            if($request->wilaya_offre === "Aucun"){
                $wilaya = Auth::user()->etablissement()->wilaya;
                
            }else{
                $wilaya = $request->wilaya_offre;
            }

            $offre = Offre::create([
                'user_id' => Auth::id(),
                'titre' => $request->titre,
                'statut' => $request->statut,
                'type' => $request->type,
                'wilaya' => $wilaya,
                'prix' => $request->prix,
                'description' => $request->description,
                'date_pub' => $request->date_pub,
                'date_limit' => $request->date_lim,
                'img_offre' => $fileName,
                'img_offre2' => $fileName2,
                'journalar_id' => $id_ar,
                'journalfr_id' => $id_fr,
            ]);

            $offre->secteur()->sync($request->secteur);

            return redirect()->route('rep.offers');
        }
    }

    public function edit(Request $request, $offre_id)
    {
        // get offre infos 
        $offre = Offre::where('id', $offre_id)->with('secteur','user')->first();

        if($offre->user_id != Auth::id()){
            return abort(403);
        }

        // validation
        $this->validate($request, [
            'titre' => 'required|max:255',
            'description' => 'max:5000',
            'date_pub' => 'required|date',
            'date_lim' => 'required|date',
            'secteur' => 'required|array',
            'statut' => 'required|max:255',
            'type' => 'in:national,international',
            'wilaya_offre' => 'max:255',
            'prix' => 'nullable|numeric',
            'journal_ar' => 'required|numeric',
            'journal_fr' => 'required|numeric',
            'photo' => 'required_if:description,value|mimes:jpeg,jpg,png|max:10000', // max 10000kb
            'photo2' => 'required_if:description,value|mimes:jpeg,jpg,png|max:10000', // max 10000kb
            ]);
        
        // update common infos
        $offre->titre = $request->titre;
        $offre->description = $request->description;
        $offre->date_pub = $request->date_pub;
        $offre->date_limit = $request->date_lim;
        $offre->type = $request->type;
        $offre->prix = $request->prix;
        $offre->statut = $request->statut;
        
        if($request->wilaya_offre === "Aucun"){
            $wilaya = Auth::user()->etablissement()->wilaya;
        }else{
            $offre->wilaya = $request->wilaya_offre;
        }

        // check if new jornal is sent
        if($request->journal_ar == 0){
            $id_ar = $this->AddJournal($request, "ar");
        }elseif($request->journal_ar == -1){
            $id_ar = null;
        }else{
            $id_ar = $request->journal_ar;
        }

        if($request->journal_fr == 0){
            $id_fr = $this->AddJournal($request, "fr");
        }elseif($request->journal_fr == -1){
            $id_fr = null;
        }else{
            $id_fr = $request->journal_fr;
        }

        // update journals
        $offre->journalar_id = $id_ar;
        $offre->journalfr_id = $id_fr;

        // update secteurs
        $offre->secteur()->detach();
        $offre->secteur()->sync($request->secteur);

        // update files
        $fileName = null;

        // upload offer img
        if ($request->hasFile('photo')) {
            // delete old img
            if($offre->img_offre){
                Storage::delete('public/' . $offre->img_offre);
            }

            $image      = $request->file('photo');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();
            
            $img = Image::make($image->getRealPath());
            $img->resize(1200, 1200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->stream(); // <-- Key point

            // dd($fileName);
            Storage::disk('local')->put('public/' . $fileName, $img);
            
            // update img file
            $offre->img_offre = $fileName;
        }

        $fileName2 = null;

        if ($request->hasFile('photo2')) {
            // delete old img
            if($offre->img_offre2){
                Storage::delete('public/' . $offre->img_offre2);
            }
            $image      = $request->file('photo2');
            $fileName2   = time() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->resize(1200, 1200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->stream(); // <-- Key point

            // dd($fileName2);
            Storage::disk('local')->put('public/' . $fileName2, $img);

            // update img file
            $offre->img_offre2 = $fileName2;
        }

        $offre->etat = "pending";
        $offre->save();

        return redirect()->route('rep.offers')->with('success', 'offre modifier avec succés');
    }

    private function AddJournal($request, $lang)
    {
        $fileName = null;

        if($lang === "ar"){
            $this->validate($request, [
                'nom_journal_ar' => 'required|max:100',
                'logo_journal_ar' => 'mimes:jpeg,jpg,png|max:10000',
            ]);

            // upload logo
            if ($request->hasFile('logo_journal_ar')) {
                $image      = $request->file('logo_journal_ar');
                $fileName   = time() . '.' . $image->getClientOriginalExtension();
    
                $img = Image::make($image->getRealPath());
                $img->resize(200, 200, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
    
                $img->stream(); // <-- Key point
    
                Storage::disk('local')->put('public/journal/' . $fileName, $img);
            }

            $journal = Journalar::create([
                'nom' => $request->nom_journal_ar,
                'logo' => $fileName,
            ]);

            if($journal){
                return $journal->id;
            }else{
                return back()->with('error', 'try again');
            }
            
        }

        if($lang === "fr"){
            $this->validate($request, [
                'nom_journal_fr' => 'required|max:100',
                'logo_journal_fr' => 'mimes:jpeg,jpg,png|max:10000',
            ]);

            // upload logo
            if ($request->hasFile('logo_journal_fr')) {
                $image      = $request->file('logo_journal_fr');
                $fileName   = time() . '.' . $image->getClientOriginalExtension();
    
                $img = Image::make($image->getRealPath());
                $img->resize(200, 200, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
    
                $img->stream(); // <-- Key point
    
                Storage::disk('local')->put('public/journal/' . $fileName, $img);
            }

            $journal = Journalfr::create([
                'nom' => $request->nom_journal_fr,
                'logo' => $fileName,
            ]);

            if($journal){
                return $journal->id;
            }else{
                return back()->with('error', 'try again');
            }
        }
    }

    public function destroy(Request $request)
    {
        //dd($request);
        return abort(403);
        
        $offre = Offre::find($request->offre);

        if($offre->user_id != Auth::id()){
            return abort(403);
        }

        $offre->secteur()->detach();

        $offre->delete();

        return back()->with('status', 'offre supprimer');
    }
}

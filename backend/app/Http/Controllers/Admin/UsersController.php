<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users = new User();

        if($request->has('keyword')){
            $users = $users->where('email', 'LIKE', "%{$request->keyword}%")
                    ->orWhere('nom', 'LIKE', "%{$request->keyword}%")
                    ->orWhere('prenom', 'LIKE', "%{$request->keyword}%")
                    ->orWhere('phone', 'LIKE', "%{$request->keyword}%");
        }

        if($request->has('type_user') && $request->type_user !== 'all'){

            $users = $users->orWhere('type_user', '=' , $request->type_user);
        }else{
            $users = $users->orWhere('type_user', '!=' , 'admin');
        }

        $users = $users->latest()->paginate(10);

        return view('admin.users', [
            'users' => $users,
        ]);
    }

    public function detail(User $user)
    {

        $etab = null;

        if($user->type_user === 'content' && $user->etablissement_id){
            $etab = $user->etablissement;
        }

        $secteurs = null;

        if($user->type_user === 'abonné'){
            $secteurs = $user->secteur->pluck('id')->toArray();
        }


        // dd($secteurs);

        return view('admin.userdetail', [
            'user' => $user,
            'etab' => $etab,
            'secteurs' => $secteurs,
        ]);
    }

    public function update_secteurs(Request $request, User $user)
    {
        // dd($user);

        $this->validate($request, [
            'secteur' => 'array',
        ]);

        $user->secteur()->detach();
        $user->secteur()->sync($request->secteur);

        return back()->with('success', 'secteurs changé avec succés');
    }

    public function update_exp(Request $request, User $user)
    {
        $this->validate($request, [
            'exp_choice' => 'required|in:year,autre',
            'exp_custom' => 'date',
        ]);

        if($request->exp_choice === "year"){
            if(Carbon::createFromFormat('Y-m-d', $user->exp)->isPast()){
                $user->exp = Carbon::now()->addYear();
            }else{
                $user->exp = Carbon::createFromFormat('Y-m-d', $user->exp)->addYear();
            }
        }else{
            $user->exp = $request->exp_custom;
        }

        $user->save();

        return back()->with('success', 'date exp changé avec succés');
    }

    public function update_etat(Request $request, User $user)
    {
        $this->validate($request, [
            'etat' => 'required|in:active,desactive',
        ]);

        $user->etat = $request->etat;

        $user->save();

        return back()->with('success', 'etat changé avec succés');
    }
    
    public function update_password(Request $request, User $user)
    {
        $this->validate($request, [
            'password' => 'required|confirmed',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'mot de passe changé avec succés');
    }

    public function addform()
    {
        return view('admin.add_user');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'phone' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'nom_etab' => 'max:255',
            'category' => 'required|max:255',
            'wilaya_etab' => 'required|max:255',
            'commune_etab' => 'required|max:255',
            'email_etab' => 'max:255',
            'fix' => 'max:255',
            'fax' => 'max:255',
            'logo' => 'mimes:jpeg,jpg,png|max:10000',
            ]);
            $fileName = null;

            if ($request->category === "AUTRE" && $request->hasFile('logo')) {
                $image      = $request->file('logo');
                $fileName   = time() . '.' . $image->getClientOriginalExtension();

                $img = Image::make($image->getRealPath());
                $img->resize(150, 150);

                $img->stream(); // <-- Key point

                // dd($fileName);
                Storage::disk('local')->put('public/logo/' . $fileName, $img);
            }

            if($request->category !== "AUTRE"){
                // $nom_etab = "$request->category $request->commune_etab de la wilaya $request->wilaya_etab"; 

                $nom_etab = $request->category;
                if($request->commune_etab !== "Aucun")
                    $nom_etab .= " $request->commune_etab";
                
                if($request->wilaya_etab !== "Aucun")
                    $nom_etab .= " de la wilaya $request->wilaya_etab";

            }

        $etab = Etablissement::create([
            'nom_etablissement' => ($request->category === "AUTRE") ? $request->nom_etab : $nom_etab,
            'category' => $request->category,
            'wilaya' => ($request->wilaya_etab !== "Aucun") ? $request->wilaya_etab : null,
            'commune' => ($request->commune_etab !== "Aucun") ? $request->commune_etab : null,
            'email' => $request->email_etab,
            'fix' => $request->fix,
            'fax' => $request->fax,
            'logo' => $fileName,
        ]);
        
        if(!$etab){
            return back()->with('status', 'erreur, Veuillez réessayer');
        }

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'etablissement_id' => $etab->id,
            'type_user' => 'content',
            'etat' => 'active',
        ]);

        if(!$user){
            $etab->delete();
            return back()->with('status', 'erreur, Veuillez réessayer');
        }

        return redirect()->route('admin.users')->with('success', 'representant a été bien ajouté');
    }
}
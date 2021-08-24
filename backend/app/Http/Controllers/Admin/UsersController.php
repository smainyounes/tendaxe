<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Notif;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request, [
            'keyword' => 'max:255',
            'type_user' => 'in:all,content,abonné',
        ]);
        $users = User::where([
            ['type_user', '<>' , 'admin'],
            ['type_user', '<>' , 'publisher'],
        ]);

        if($request->type_user && $request->type_user !== 'all'){
            $users = $users->where([
                ['type_user', '<>' , 'admin'],
                ['type_user', '<>' , 'publisher'],
                ['type_user', $request->type_user],
            ]);
        }

        if($request->keyword){
            $users = $users->where('email', 'LIKE', "%{$request->keyword}%")
                    ->orWhere('nom', 'LIKE', "%{$request->keyword}%")
                    ->orWhere('prenom', 'LIKE', "%{$request->keyword}%")
                    ->orWhere('phone', 'LIKE', "%{$request->keyword}%");
        }

        $users = $users->latest()->paginate(10);

        session()->flashInput($request->input());

        return view('admin.users', [
            'users' => $users,
        ]);
    }

    public function detail(User $user)
    {

        $etab = null;

        if($user->type_user === 'admin'){
            return abort(403);
        }

        if($user->type_user === 'content' && $user->etablissement_id){
            $etab = $user->etablissement;
        }

        $date_debut = date('Y-m-d');

        if($user->type_user === 'abonné'){
            $a = $user->abonnement->last();
            if(!Carbon::createFromFormat('Y-m-d', $a->date_fin)->isPast()){
                $date_debut = $a->date_fin;
            }
        }

        return view('admin.userdetail', [
            'user' => $user,
            'etab' => $etab,
            'date_debut' => $date_debut,
            'notif' => $user->notif,
        ]);
    }

    public function update_details(User $user, Request $request)
    {
        $this->validate($request, [
            'nom' => 'nullable|max:255',
            'prenom' => 'nullable|max:255',
            'nom_entreprise' => 'nullable|max:255',
            'phone' => 'nullable|max:255|unique:users',
            'wilaya' => 'nullable|max:255',
            'email' => 'nullable|email|max:255|unique:users',
            ]);
        
        if($request->nom)
            $user->nom = $request->nom;
        
        if($request->prenom)
            $user->prenom = $request->prenom;
        
        if($request->email)
            $user->email = $request->email;
        
        if($request->phone)
            $user->phone = $request->phone;
        
        if($request->wilaya)
            $user->wilaya = $request->wilaya;
        
        if($request->nom_entreprise)
            $user->nom_entreprise = $request->nom_entreprise;

        $user->save();

        return back()->with('success', 'les infos de l\'utilisateur ont été changé avec succès');
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

    public function EditNotif(Request $request, Notif $notif)
    {
        $this->validate($request, [
            'frequence' => 'required|in:none,everyday,weekly',
            'keyword' => 'nullable|string|max:255',
            'secteur' => 'nullable|array',
            'wilaya' => 'nullable|array',
            'statut' => 'nullable|array',
        ]);

        // start editing
        $notif->frequence = $request->frequence;
        
        if($request->statut){
            $statuts = $notif->statut()->whereIn('statuts.statut', $request->statut)->pluck('statut');
            if($statuts){
                $statuts = array_diff($request->statut, $statuts->all());
            }
            $data = [];
            foreach($statuts as $statut){
                $data[] = ['statut' => $statut];
            }

            if($data){
                $notif->statut()->createMany($data);
            }
        }
        
        if($request->wilaya){
            $wilayas = $notif->wilaya()->whereIn('wilayas.wilaya', $request->wilaya)->pluck('wilaya');
            if($wilayas){
                $wilayas = array_diff($request->wilaya, $wilayas->all());
            }
            $data = [];
            foreach($wilayas as $wilaya){
                $data[] = ['wilaya' => $wilaya];
            }

            if($data){
                $notif->wilaya()->createMany($data);
            }
        }

        if($request->keyword){
            $notif->keyword()->updateOrCreate(['keyword' => $request->keyword], ['keyword' => $request->keyword]);
        }

        if($request->secteur){
            $existing_id = $notif->secteur()->whereIn('secteurs.id', $request->secteur)->pluck('secteur_id');
            if($existing_id){
                $notif->secteur()->attach(array_diff($request->secteur, $existing_id->all()));
            }else{
                $notif->secteur()->attach($request->secteur);
            }
        }

        $notif->save();

        return back()->with('success', 'données enregistrer avec succés');
    }

    public function deleteSecteur(User $user, $id)
    {
        if($user->notif->secteur()->detach($id)){
            return 'success';
        }else{
            return 'error';
        }
    }
}

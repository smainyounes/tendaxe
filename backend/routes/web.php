<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FavoritController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddOffreController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OffreController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\SearchOffreController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SettingsController;
use App\Http\Controllers\Admin\AbonnementController;
use App\Http\Controllers\Auth\PasswordResetController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/test', function () {
//     return base_path();
// });

Route::get('/test', function () {
    return view('user.notif');
});

Route::get('/documents', function () {
    return view('docs');
})->name('docs');

// email verification
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// password reset
Route::get('/forgot-password',[PasswordResetController::class, 'GetPasswordLinkForm'])->name('password.request')->middleware('guest');
Route::post('/forgot-password',[PasswordResetController::class, 'GetPasswordLink'])->name('password.email')->middleware('guest');

Route::get('/reset-password/{token}',[PasswordResetController::class, 'PasswordResetForm'])->middleware('guest')->name('password.reset');
Route::post('/reset-password',[PasswordResetController::class, 'PasswordReset'])->middleware('guest')->name('password.update');


Route::get('/suspended', function () {
    return view('suspended');
})->name('suspended');

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/help',function () {
    return view('help');
})->name('help');

Route::get('/search',[SearchOffreController::class, 'index'])->name('search')->middleware('EmailVerified');

Route::middleware(['auth', 'EmailVerified'])->group(function () {
    Route::get('/add',[AddOffreController::class, 'index'])->name('offre.add');
    Route::post('/add',[AddOffreController::class, 'store']);

    // Route::delete('/offre',[AddOffreController::class, 'destroy'])->name('offre.destroy');

    Route::get('/settings/profile',[ProfileController::class, 'index'])->name('profile');
    Route::get('/settings/abonnement',[ProfileController::class, 'abonnement'])->name('abonnement');
    Route::get('/settings/notification',[ProfileController::class, 'notif'])->name('notification');
    Route::get('/settings/offres',[AddOffreController::class, 'mesoffres'])->name('user.offers');

    Route::post('/pack',[SettingsController::class, 'DemandeAbonnement'])->name('user.pack.add');
    Route::post('/chang_pswd',[SettingsController::class, 'EditPassword'])->name('user.password');
    Route::post('/chang_email',[SettingsController::class, 'editemail'])->name('user.email');
    Route::post('/chang_phone',[SettingsController::class, 'editphone'])->name('user.phone');

    Route::post('/favories/{offre}',[FavoritController::class, 'toggle'])->name('favorit.toggle');
    Route::get('/favories',[FavoritController::class, 'index'])->name('offre.favorit');

    Route::post('/settings/notif/',[SettingsController::class, 'Editnotif'])->name('user.notif');
    Route::delete('/settings/notif/wilaya/{wilaya}',[SettingsController::class, 'deleteWilaya'])->name('user.notif.wilaya');
    Route::delete('/settings/notif/sect/{secteur}',[SettingsController::class, 'deleteSecteur'])->name('user.notif.secteur');
    Route::delete('/settings/notif/keyword/{keyword}',[SettingsController::class, 'deleteKeyword'])->name('user.notif.keyword');
    Route::delete('/settings/notif/statut/{statut}',[SettingsController::class, 'deletestatut'])->name('user.notif.statut');


});

Route::middleware(['guest'])->group(function () {
    Route::get('/login',[LoginController::class, 'index'])->name('login');
    Route::post('/login',[LoginController::class, 'store']);

    Route::get('/register',[RegisterController::class, 'index'])->name('register');
    // Route::get('/register/{choice}',[RegisterController::class, 'index']);
    Route::post('/register',[RegisterController::class, 'store']);
});


Route::get('/detail/{offre_id}',[SearchOffreController::class, 'detail'])->name('detail')->middleware('EmailVerified');


// adminpanel (both admin & publisher can access those routes)
Route::group(['prefix' => 'admin',  'middleware' => 'adminpanel'], function()
{
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::post('/logout',[LogoutController::class, 'index'])->name('admin.logout');  
    
    Route::get('/offers',[OffreController::class, 'index'])->name('admin.offers');
    
    Route::get('/offers/add',[OffreController::class, 'addform'])->name('admin.offers.add');
    Route::post('/offers/add',[OffreController::class, 'store']);
    
    Route::delete('/offre',[OffreController::class, 'destroy'])->name('admin.offre.destroy');

    Route::get('/offers/edit/{offer}',[OffreController::class, 'editform'])->name('admin.offers.edit');
    Route::post('/offers/edit/{offer}',[OffreController::class, 'edit']);

    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('admin.settings');
    Route::post('/settings',[SettingsController::class, 'EditPassword']);

});

Route::group(['prefix' => 'admin',  'middleware' => 'admin'], function() {
    Route::get('/users',[UsersController::class, 'index'])->name('admin.users');

    Route::post('/users/etat/{user}',[UsersController::class, 'update_etat'])->name('admin.user.etat');
    Route::post('/users/password/{user}',[UsersController::class, 'update_password'])->name('admin.user.password');
    Route::post('/users/detail/{user}',[UsersController::class, 'update_details'])->name('admin.user.details');
    Route::delete('/abonnement',[AbonnementController::class, 'destroy'])->name('admin.abonnement.destroy');
    Route::post('/abonnement/add/{user}',[AbonnementController::class, 'store'])->name('admin.abonnement.store');
    Route::post('/abonnement/edit',[AbonnementController::class, 'edit'])->name('admin.abonnement.edit');
   
    Route::get('/abonnement/{abonnement}',[AbonnementController::class, 'detail'])->name('admin.abonnement.detail');


    Route::get('/users/add',[UsersController::class, 'addform'])->name('admin.user.add');
    Route::post('/users/add',[UsersController::class, 'store']);

    Route::get('/users/{user}',[UsersController::class, 'detail'])->name('admin.users.detail');

    Route::get('/admins',[AdminController::class, 'index'])->name('admin.admins');
    Route::get('/admins/add', function () {
        return view('admin.add_admin');
    })->name('admin.admins.add');
    Route::post('/admins/add',[AdminController::class, 'store']);

    Route::get('/offers/trash',[OffreController::class, 'trashed'])->name('admin.trash');
    Route::post('/offers/restore',[OffreController::class, 'restore'])->name('admin.offre.restore');

    Route::get('/offers/pending',[OffreController::class, 'pending'])->name('admin.pending');
    Route::post('/offers/accept',[OffreController::class, 'accept'])->name('admin.offre.accept');

    Route::post('/admin/notif/{notif}',[UsersController::class, 'Editnotif'])->name('admin.notif');
    Route::delete('/notif/sect/{user}/{secteur}',[UsersController::class, 'deleteSecteur'])->name('admin.notif.secteur');

});

Route::group(['prefix' => 'representant',  'middleware' => 'ContentCreator'], function()
{
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('rep.dashboard');
    
    Route::get('/offers',[OffreController::class, 'index'])->name('rep.offers');
    
    Route::get('/offers/add',[OffreController::class, 'addform'])->name('rep.offers.add');
    Route::post('/offers/add',[AddOffreController::class, 'store']);
    
    Route::get('/offers/edit/{offer}',[OffreController::class, 'editform'])->name('rep.offers.edit');
    Route::post('/offers/edit/{offer}',[AddOffreController::class, 'edit']);

    Route::delete('/offre',[OffreController::class, 'destroy'])->name('rep.offre.destroy');

    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('rep.settings');
    Route::post('/settings',[SettingsController::class, 'EditPassword']);

});

Route::post('/logout',[LogoutController::class, 'index'])->name('logout')->middleware('auth');
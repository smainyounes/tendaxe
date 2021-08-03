<?php

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

Route::get('/suspended', function () {
    return view('suspended');
})->name('suspended');

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/help',function () {
    return view('help');
})->name('help');

Route::get('/search',[SearchOffreController::class, 'index'])->name('search');

Route::middleware(['auth'])->group(function () {
    Route::get('/add',[AddOffreController::class, 'index'])->name('offre.add');
    Route::post('/add',[AddOffreController::class, 'store']);

    // Route::delete('/offre',[AddOffreController::class, 'destroy'])->name('offre.destroy');

    Route::get('/profile',[ProfileController::class, 'index'])->name('profile');

    Route::post('/chang_pswd',[SettingsController::class, 'EditPassword'])->name('user.password');

    Route::post('/favorit/{offre}',[FavoritController::class, 'toggle'])->name('favorit.toggle');
    Route::get('/favorit',[FavoritController::class, 'index'])->name('offre.favorit');

});

Route::middleware(['guest'])->group(function () {
    Route::get('/login',[LoginController::class, 'index'])->name('login');
    Route::post('/login',[LoginController::class, 'store']);

    Route::get('/register',[RegisterController::class, 'index'])->name('register');
    // Route::get('/register/{choice}',[RegisterController::class, 'index']);
    Route::post('/register',[RegisterController::class, 'store']);
});


Route::get('/detail/{offre_id}',[SearchOffreController::class, 'detail'])->name('detail');


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

    Route::post('/users/secteur/{user}',[UsersController::class, 'update_secteurs'])->name('admin.user.secteurs');
    Route::post('/users/exp/{user}',[UsersController::class, 'update_exp'])->name('admin.user.exp');
    Route::post('/users/etat/{user}',[UsersController::class, 'update_etat'])->name('admin.user.etat');
    Route::post('/users/password/{user}',[UsersController::class, 'update_password'])->name('admin.user.password');
    
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
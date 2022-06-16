<?php

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\CPUBrandController;
use App\Http\Controllers\CPUController;
use App\Http\Controllers\GlassController;
use App\Http\Controllers\ModelBrandController;
use App\Http\Controllers\ModelMaterialController;
use App\Http\Controllers\OSController;
use App\Http\Controllers\ScreenMaterialController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\SmartphoneController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UrlController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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


Route::get('/', function () {
    $smartphones = DB::table('Smartphones')->select('Smartphone')->where("Available", 1)->get();
    return view('welcome', ['smartphones'=> ($smartphones)]);
});

// Route::get('/redirect', function () {
//     $smartphones = DB::table('Smartphones')->select('Smartphone')->where("Available", 1)->get();
//     return view('welcome', ['smartphones'=> ($smartphones)]);
// });

Route::controller(UrlController::class)->group(function() {
    $smartphones = DB::table('Smartphones')->select('Smartphone')->where("Available", 1)->get();
    Route::get('/redirect', 'redirect');
});

Route::get('/modelbrand-manage', function () {
    $modelbrand = DB::table('modelbrand')->select('idModelBrand', 'Brand', 'Available')->get();
    return view('pages.brand', ['modelbrand'=> ($modelbrand)]);
});

Route::get('/cpu-manage', function () {
    $cpubrand = DB::table('cpubrand')->select('*')->get();
    $cpu = DB::table('CPU')->select('CPU.idCPU', 'CPU.CPUModel', 'CPU.Score', 'CPU.Speed', 'CPUBrand.CPUBrand', 'CPU.Available')->join('CPUBrand', 'CPU.idCPUBrand', '=' , 'CPUBrand.idCPUBrand')->get();
    return view('pages.cpu', ['cpu'=> ($cpu), 'cpubrand'=>($cpubrand)]);
});

Route::get('/glass-manage', function () {
    $glass = DB::table('glass')->select('idGlass', 'Glass', 'Score', 'available')->get();
    return view('pages.glass', ['glass'=> ($glass)]);
});

Route::get('/model-manage', function () {
    $os = DB::table('os')->select('idOS', 'os', 'osversion')->get();
    $identi = DB::table('model')->select('Serie')->get();
    $modelmaterial = DB::table('modelmaterial')->select('*')->get();
    $glass = DB::table('glass')->select('idGlass', 'Glass', 'Score', 'available')->get();
    $cpu = DB::table('CPU')->select('CPU.idCPU', 'CPU.CPUModel', 'Available')->where('Available', '=', '1')->get();
    $modelbrand = DB::table('modelbrand')->select('idModelBrand', 'Brand', 'Available')->where('Available', '=', '1')->get();
    $screen = DB::table('ScreenMaterial')->select('*')->get();
    $model = DB::table('Smartphones')->select('idModel', 'Smartphone', 'YEAR', 'ScreenSize', 'PixelDensity', 'BatteryPower', 'RAM', 'ResolutionX', 'ResolutionY', 'FrontMainCamera', 'BackMainCamera', 'Weight', 'Waterproof', 'RefreshRate', 'OS', 'CPUBrand', 'CPUModel', 'Score', 'Material', 'Glass', 'STATUS', 'Available')->get();
    return view('pages.model', ['model'=> ($model), 'os'=> ($os), 'modelmaterial'=> ($modelmaterial), 'glass'=> ($glass), 'cpu'=> ($cpu), 'modelbrand'=> ($modelbrand), 'screen'=> ($screen), 'identi'=>$identi]);
});

Route::get('/modelmaterial-manage', function () {
    $modelmaterial = DB::table('modelmaterial')->select('*')->get();
    return view('pages.material', ['modelmaterial'=> ($modelmaterial)]);
});

Route::get('/os-manage', function () {
    $os = DB::table('os')->select('idOS', 'OS', 'OSVersion', 'Score', 'Available')->get();
    return view('pages.os', ['os'=> ($os)]);
});

Route::get('/cpubrand-manage', function () {
    $cpubrand = DB::table('cpubrand')->select('*')->get();
    return view('pages.cpu-brand', ['cpubrand'=> ($cpubrand)]);
});

Route::get('/screenmaterial-manage', function () {
    $screen = DB::table('ScreenMaterial')->select('*')->get();
    return view('pages.screen', ['screen'=> ($screen)]);
});

Route::get('/login-google', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/google-callback', function (Request $log) {
    $user = Socialite::driver('google')->user();

    $userExists = User::where('external_id', $user->id)->where('external_auth', 'google')->first();

    if ($userExists) {
        Auth::login($userExists);
        $save = array(
            "name"=>$user->name,
            "email"=>$user->email,
            "avatar"=>$user->avatar,
        );

        session('user', $save);
        $log->session()->put('user', $save);
    } else {
        $userNew = User::create([
            'name'=>$user->name,
            'email'=>$user->email,
            'avatar'=>$user->avatar,
            'external_id'=>$user->id,
            'external_auth'=>'google',
        ]);

        Auth::login($userNew);
        $save = array(
            "name"=>$user->name,
            "email"=>$user->email,
            "avatar"=>$user->avatar,
            "id"=>$user->id
        );

        session()->put('user', $save);
    }
    return redirect('/');
    
    // dd($user);
    // $user->token
});

Route::controller(UsersController::class)->group(function() {
    Route::get('/user', 'index');
    Route::post('/store-user', 'store');
});


Route::controller(CPUBrandController::class)->group(function() {
    Route::get('/cpubrand', 'index');
    Route::get('/cpubrand/{id}', 'show');
});

Route::controller(CPUController::class)->group(function() {
    Route::get('/cpu', 'index');
    Route::get('/cpu/{id}', 'show');
    Route::post('/store-cpu', 'store');
    Route::post('/update-cpu', 'update');
    Route::post('/delete-cpu', 'delete');
});

Route::controller(GlassController::class)->group(function() {
    Route::get('/glass', 'index');
    Route::get('/glass/{id}', 'show');
    Route::post('/store-glass', 'store');
    Route::post('/update-glass', 'update');
    Route::post('/delete-glass', 'delete');
});

Route::controller(ModelBrandController::class)->group(function() {
    Route::get('/modelbrand', 'index');
    Route::get('/modelbrand/{id}', 'show');
    Route::post('/store-modelbrand', 'store');
    Route::post('/update-modelbrand', 'update');
    Route::post('/delete-modelbrand', 'delete');
});

Route::controller(ModelMaterialController::class)->group(function() {
    Route::get('/modelmaterial', 'index');
    Route::get('/modelmaterial/{id}', 'show');
});

Route::controller(OSController::class)->group(function() {
    Route::get('/os', 'index');
    Route::get('/os/{id}', 'show');
    Route::post('/store-os', 'store');
    Route::post('/update-os', 'update');
    Route::post('/delete-os', 'delete');
});

Route::controller(ScreenMaterialController::class)->group(function() {
    Route::get('/screenmaterial', 'index');
    Route::get('/screenmaterial/{id}', 'show');
});

Route::controller(ModelController::class)->group(function() {
    Route::get('/model', 'index');
    Route::get('/model/{id}', 'show');
    Route::post('/store-model', 'store');
    Route::post('/update-model', 'update');
    Route::post('/delete-model', 'delete');
});

Route::controller(SmartphoneController::class)->group(function() {

    Route::get('/phone', 'index');
    Route::get('/phone/{id}', 'show');
    Route::get('/compare/{id1}/{id2}', 'compare', function() {
        
    });
    // Route::get('/compare/{id1}/{id2}', 'compare')->name('compare');
});

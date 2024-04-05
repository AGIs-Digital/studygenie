<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
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
    return view('index');
})->name('home')->middleware('check.tutorial');

Route::get('/get-latest-ai-response', [FrontController::class, 'getLatestAIResponse'])->name('getLatestAIResponse');

Route::group(['middleware' => ['auth']], function () {

Route::get('/tools', [FrontController::class, 'toolsPage']);

Route::get('/Bildung', function () {
    return view('Bildung');
});

Route::get('/Karriere', function () {
    return view('Karriere');
});

Route::get('/profile', function () {
    return view('profile');
})->name('profile');


Route::get('/archive', [FrontController::class, 'getArchive']);

Route::get('/GenieCheck', function () {
    return view('Bildung.GenieCheck');
});

Route::get('/TextAnalyse', function () {
    return view('Bildung.TextAnalyse');
});

Route::get('/TextInspiration', function () {
    if((auth()->user()->subscription_name == 'gold' || auth()->user()->subscription_name == 'diamant')){
        return view('Bildung.TextInspiration');
    }
    return abort(404);
});

Route::get('/BewerbeGenie', function () {
    if((auth()->user()->subscription_name == 'gold' || auth()->user()->subscription_name == 'diamant')){
        return view('Karriere.BewerbeGenie');
    }

    return abort(404);
});

Route::get('/Motivationsschreiben', function () {
    if((auth()->user()->subscription_name == 'gold' || auth()->user()->subscription_name == 'diamant')){
        return view('Karriere.Motivationsschreiben');
    }
    return abort(404);
});

Route::get('/GenieAutor', function () {
    if((auth()->user()->subscription_name == 'gold' || auth()->user()->subscription_name == 'diamant')){
    return view('Bildung.GenieAutor');
    }
    return abort(404);
});

Route::get('/JobMatch', function () {
    return view('Karriere.JobMatch');
});

Route::get('/JobInsider', function () {
    return view('Karriere.JobInsider');
});

Route::get('/Lebenslauf', function () {
    if((auth()->user()->subscription_name == 'gold' || auth()->user()->subscription_name == 'diamant')){
        return view('Karriere.Lebenslauf');
    }
    return abort(404);
});

Route::post('Motivationsschreibenprocess', [FrontController::class, 'Motivationsschreibenprocess'])->name('Motivationsschreibenprocess');

Route::get('GenieTutor', [FrontController::class, 'GenieTutor']);
Route::post('/GenieTutor-one', [FrontController::class, 'GenieTutorFirst'])->name('GenieTutor');
Route::post('GenieTutor-user', [FrontController::class, 'GenieTutorUser'])->name('GenieTutoruser');

Route::get('/KarriereMentor', [FrontController::class, 'KarriereMentor']);
Route::post('/KarriereMentor-one', [FrontController::class, 'KarriereMentorFirst'])->name('KarriereMentor');
Route::post('KarriereMentor-user', [FrontController::class, 'KarriereMentorUser'])->name('KarriereMentoruser');

Route::post('TextInspirationprocess', [FrontController::class, 'TextInspirationprocess'])->name('TextInspirationprocess');
Route::post('TextAnalyseprocess', [FrontController::class, 'TextAnalyseprocess'])->name('TextAnalyseprocess');
Route::post('JobMatchprocess', [FrontController::class, 'JobMatchprocess'])->name('JobMatchprocess');

Route::get('JobInsiderprocess', [FrontController::class, 'JobInsiderprocess'])->name('JobInsiderprocess');

Route::post('savedata', [FrontController::class, 'saveData'])->name('save.data');

Route::post('GenieCheckprocess', [FrontController::class, 'GenieCheckprocess'])->name('GenieCheckprocess');

Route::get('/KarriereGenie', function () {
    return view('Karriere.KarriereGenie');
});

});

Route::post('/postLogin', [FrontController::class, 'postLogin']);
Route::post('/postRegistration', [FrontController::class, 'postRegistration']);
Route::post('/register', [UserController::class, 'register'])->name('register.post');

Route::get('/impressum', function () {
    return view('impressum');
});

Route::get('/agb', function () {
    return view('agb');
});

Route::get('/datenschutz', function () {
    return view('datenschutz');
});


Route::get('paypal', [FrontController::class, 'paypalindex'])->name('paypal');
Route::get('paypal/payment/{name}', [FrontController::class, 'payment'])->name('paypal.payment');

Route::get('stripe/payment/{name}', [FrontController::class, 'stripePayment'])->name('stripe.payment');
Route::get('stripe/payment/success', [FrontController::class, 'StripeSuccess'])->name('stripe.success');

Route::get('paypal/payment/success', [FrontController::class, 'paymentSuccess'])->name('paypal.payment.success');
Route::get('paypal/payment/cancel', [FrontController::class, 'paymentCancel'])->name('paypal.payment/cancel');
Route::post('change-password', [FrontController::class, 'updateUserPassword'])->name('change.password');

Auth::routes();
Route::delete('/archive/{id}', [FrontController::class, 'deleteArchive'])->name('archive.delete');
Route::delete('/user/delete', [FrontController::class, 'delete'])->name('user.delete');
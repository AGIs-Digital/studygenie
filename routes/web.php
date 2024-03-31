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

Route::get('/written', function () {
    return view('written');
});

Route::get('/profile', function () {
    return view('profile');
})->name('profile');


Route::get('/archive', [FrontController::class, 'getArchive']);

Route::get('/genie-check', function () {
    return view('Bildung.geniecheck');
});

Route::get('/genie-brain', function () {
    if((auth()->user()->subscription_name == 'gold' || auth()->user()->subscription_name == 'diamant')){
        return view('Bildung.geniebrain');
    }

    return abort(404);

});

Route::get('/BewerbeGenie', function () {
    if((auth()->user()->subscription_name == 'gold' || auth()->user()->subscription_name == 'diamant')){
        return view('Karriere.BewerbeGenie');
    }

    return abort(404);

});

Route::get('/motivationsschreiben', function () {
    if((auth()->user()->subscription_name == 'gold' || auth()->user()->subscription_name == 'diamant')){
        return view('Karriere.motivationsschreiben');
    }

    return abort(404);

});

Route::get('/lebenslauf', function () {
    if((auth()->user()->subscription_name == 'gold' || auth()->user()->subscription_name == 'diamant')){
        return view('Karriere.lebenslauf');
    }

    return abort(404);

});

Route::post('motivationprocess', [FrontController::class, 'genieMotivationProcess'])->name('motivation.process');

Route::get('GenieTutor', [FrontController::class, 'GenieTutor']);
Route::post('/GenieTutor-one', [FrontController::class, 'GenieTutorFirst'])->name('genie.firstreqeust');

Route::post('GenieTutor-user', [FrontController::class, 'GenieTutorUser'])->name('GenieTutoruser');

Route::post('geniebrainprocess', [FrontController::class, 'genieBrainProcess'])->name('geniebrainprocess');

Route::post('JobNavigatorprocess', [FrontController::class, 'JobNavigatorProcess'])->name('JobNavigatorprocess');




Route::post('savedata', [FrontController::class, 'saveData'])->name('save.data');

Route::get('/genie-interview', [FrontController::class, 'genieInterview']);

Route::post('/genie-interview-one', [FrontController::class, 'genieInterviewFirst'])->name('genie.first');
Route::get('/JobNavigator', function () {
    return view('Karriere.JobNavigator');
});

Route::get('/JobMatch', function () {
    return view('Karriere.JobMatch');
});

Route::get('/JobInsider', function () {
    return view('Karriere.JobInsider');
});





});

Route::post('post-login', [FrontController::class, 'postLogin'])->name('login.post');
Route::post('post-registration', [FrontController::class, 'postRegistration'])->name('register.post');
Route::post('/testGpt', [FrontController::class, 'index'])->name('processForm');

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
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArchiveController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MotivationController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\CVController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Hier können Sie Web-Routen für Ihre Anwendung registrieren. Diese
| Routen werden von RouteServiceProvider in einer Gruppe geladen, die
| das "web" Middleware-Gruppe enthält. Jetzt erstellen Sie etwas Tolles!
|
*/

// Public view routes
Route::view('impressum', 'impressum');
Route::view('agb', 'agb');
Route::view('datenschutz', 'datenschutz');

Route::get('/', function () {
    return view('index');
})->name('home')->middleware('check.tutorial');

// Routes for AI Conversations
    Route::middleware('auth:sanctum')->prefix('conversation')->group(function () {
    Route::post('/create', [ConversationController::class, 'create']);
    Route::get('/init/{toolIdentifier}', [ConversationController::class, 'get'])->name('conversation.get');
    Route::post('/{id}/message', [ConversationController::class, 'askAi'])->name('conversation.askAi');
    Route::post('/{conversation}/archive', [ConversationController::class, 'archive'])->name('conversation.archive');
});

// Routes which require authentication
Route::group(['middleware' => ['auth']], function () {
    // View Routes
    Route::view('tools', 'tools');
    Route::view('bildung', 'bildung');
    Route::view('karriere', 'karriere');
    Route::view('profile', 'profile')->name('profil');
    Route::view('geniecheck', 'bildung.genie_check');
    Route::view('textanalyse', 'bildung.text_analyse');
    Route::view('karrieregenie', 'karriere.karriere_genie');
    Route::view('job_match', 'karriere.job_match');
    Route::view('jobinsider', 'karriere.job_insider');

    // Archive routes: Route them all to Archive Controller. Make them only available to atuhenticated users
    Route::resource('archive', ArchiveController::class)->except(['create', 'store']);

    // Post routes
    Route::post('cv-preview', [CVController::class, 'cvPreview']);
    Route::post('download-pdf', [CVController::class, 'downloadPDF']);
    Route::post('motivation-preview', [App\Http\Controllers\MotivationController::class, 'motivationPreview']);
    Route::post('download-motivation-pdf', [MotivationController::class, 'downloadPDF'])->name('download-motivation-pdf');
    Route::post('motivationsschreibenprocess', [FrontController::class, 'Motivationsschreibenprocess'])
        ->name('Motivationsschreibenprocess');

    Route::post('textinspirationprocess', [FrontController::class, 'TextInspirationprocess'])->name('TextInspirationprocess');
    Route::post('textanalyseprocess', [FrontController::class, 'TextAnalyseprocess'])->name('textanalyseprocess');
    Route::post('jobmatchprocess', [FrontController::class, 'JobMatchprocess'])->name('JobMatchprocess');
    Route::post('jobinsiderprocess', [FrontController::class, 'JobInsiderprocess'])->name('JobInsiderprocess');
    Route::post('geniecheckprocess', [FrontController::class, 'GenieCheckprocess'])->name('GenieCheckprocess');

    Route::delete('user/delete', [UserController::class, 'destroy'])->name('user.delete');
});

// Routes which require diamant subscription
Route::middleware(['auth', 'check.subscription.expiry', 'check.subscription:diamant'])->group(function () {
    Route::view('karrierementor', 'karriere.karriere_mentor');
    Route::view('genietutor', 'bildung.genie_tutor');
});

// Routes which require gold or diamant subscription
Route::middleware(['auth', 'check.subscription.expiry', 'check.subscription:gold,diamant'])->group(function () {
    Route::view('motivationsschreiben', 'karriere.motivationsschreiben');
    Route::view('textinspiration', 'bildung.text_inspiration');
    Route::view('bewerbegenie', 'karriere.bewerbe_genie');
    Route::view('genieautor', 'bildung.genie_autor');
    Route::view('lebenslauf', 'karriere.lebenslauf');
});

Route::post('/postLogin', [FrontController::class, 'postLogin']);
Route::post('/postRegistration', [FrontController::class, 'postRegistration']);
Route::post('/register', [UserController::class, 'register'])
    ->name('register.post');

Route::get('paypal', [FrontController::class, 'paypalindex'])
    ->name('paypal');
Route::get('paypal/payment/{name}', [FrontController::class, 'payment'])
    ->name('paypal.payment');

Route::get('stripe/payment/{name}', [FrontController::class, 'stripePayment'])
    ->name('stripe.payment');
Route::get('stripe/payment/success', [FrontController::class, 'StripeSuccess'])
    ->name('stripe.success');

Route::get('paypal/payment/success', [FrontController::class, 'paymentSuccess'])
    ->name('paypal.payment.success');
Route::get('paypal/payment/cancel', [FrontController::class, 'paymentCancel'])
    ->name('paypal.payment/cancel');
Route::post('change-password', [FrontController::class, 'changePassword'])
    ->name('change.password');

Auth::routes();

// Weiterleitung zur Anmeldeseite des Anbieters fr Google und Facebook
Route::get('login/{provider}', [LoginController::class, 'redirectToProvider']);
Route::get('auth/callback/{provider}', [LoginController::class, 'handleProviderCallback']);

Route::post('/update-tutorial-status', function () {
    $user = Auth::user();
    $user->tutorial_shown = 1;
    $user->save();

    return response()->json(['status' => 'success']);
});

// PayPal Checkout routes
Route::get('/setup-plans', [PayPalController::class, 'setupPlans'])->name('paypal.setupPlans');
Route::post('/create-subscription', [PayPalController::class, 'createSubscription'])->name('paypal.createSubscription');
Route::get('/update-subscription', [PayPalController::class, 'updateSubscription'])->name('paypal.updateSubscription');

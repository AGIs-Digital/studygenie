<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArchiveController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PayPalController;

use App\Http\Controllers\Karriere\MentorController;
use App\Http\Controllers\Karriere\LebenslaufController;
use App\Http\Controllers\Karriere\JobInsiderController;
use App\Http\Controllers\Karriere\JobMatchController;
use App\Http\Controllers\Karriere\MotivationController;

use App\Http\Controllers\Bildung\GenieCheckController;
use App\Http\Controllers\Bildung\TextInspirationController;
use App\Http\Controllers\Bildung\TextAnalysisController;

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

### PUBLIC VIEW ROUTES ###
Route::view('impressum', 'impressum')->name('impressum');
Route::view('agb', 'agb')->name('agb');
Route::view('datenschutz', 'datenschutz')->name('datenschutz');

Route::get('/', function () {
    return view('index');
})->name('home')->middleware('check.tutorial'); // not sure what the check.tutorial does here on a public route... (FL)

### CONVERSATION ROUTES ###
Route::middleware('auth:sanctum')->prefix('conversation')->group(function () {
    Route::post('/create', [ConversationController::class, 'create']);
    Route::get('/init/{toolIdentifier}', [ConversationController::class, 'get'])->name('conversation.get');
    Route::post('/{id}/message', [ConversationController::class, 'askAi'])->name('conversation.askAi');
    Route::post('/{conversation}/archive', [ConversationController::class, 'archive'])->name('conversation.archive');
});

### AUTHENTICATED ROUTES ###
Route::group(['middleware' => ['auth']], function () {
    // View routes
    Route::view('tools', 'tools');
    Route::get('profile', [UserController::class, 'show'])->name('profil');

    // Resources
    // Route::resource('user', UserController::class)->except('show');
    Route::resource('archive', ArchiveController::class)->except(['create', 'store']);

    ### SINGLE OPERATION ROUTES ###
    Route::post('/update-tutorial-status', function () { // What does this route do? (FL)
        $user = Auth::user();
        $user->tutorial_shown = 1;
        $user->save();

        return response()->json(['status' => 'success']);
    });

    ### BILDUNG ROUTES
    Route::view('bildung', 'bildung')->name('bildung');
    Route::prefix('bildung')->name('bildung.')->group(function () {

        Route::get('geniecheck', [GenieCheckController::class, 'create'])->name('geniecheck.create');
        Route::resource('geniecheck', GenieCheckController::class)->except(['index', 'create', 'show', 'edit', 'update', 'destroy']);

        // Bildung Routes which require diamant subscription
        Route::middleware(['check.subscription.expiry', 'check.subscription:diamant'])->group(function () {
            Route::view('genietutor', 'bildung.genie_tutor')->name('genietutor.create');
        });

        // Bildung Routes which require gold or diamant subscription
        Route::middleware(['auth', 'check.subscription.expiry', 'check.subscription:gold,diamant'])->group(function () {

            Route::view('genieautor', 'bildung.genie_autor')->name('genieautor');

            Route::get('textinspiration', [TextInspirationController::class, 'create'])->name('textinspiration');
            Route::resource('textinspiration', TextInspirationController::class)->except(['index', 'create', 'show', 'edit', 'update', 'destroy']);

            Route::get('textanalyse', [TextAnalysisController::class, 'create'])->name('textanalysis');
            Route::resource('textanalysis', TextAnalysisController::class)->except(['index', 'create', 'show', 'edit', 'update', 'destroy']);
        });
    });

    ### KARRIERE ROUTES
    Route::prefix('karriere')->name('karriere.')->group(function () {
        Route::view('/', 'karriere')->name('index');

        // Karriere-Mentor routes - only available to users with a diamant subscription
        Route::middleware(['check.subscription.expiry', 'check.subscription:diamant'])->group(function () {
            Route::get('mentor', [MentorController::class, 'create'])->name('mentor');
            Route::resource('mentor', MentorController::class)->except(['index', 'create', 'show', 'edit', 'update', 'destroy']);
        });

        // Routes which require gold or diamant subscription
        Route::middleware(['check.subscription.expiry', 'check.subscription:gold,diamant'])->group(function () {
            // BewerbeGenie routes - only available to users with a gold or diamant subscription
            Route::view('bewerbegenie', 'karriere.bewerbe_genie')->name('bewerbegenie');

            // Lebenslauf routes
            Route::get('lebenslauf', [LebenslaufController::class, 'create'])->name('lebenslauf');
            Route::prefix('lebenslauf')->name('lebenslauf.')->group(function () {
                Route::post('preview', [LebenslaufController::class, 'preview'])->name('preview');
                Route::post('download', [LebenslaufController::class, 'download'])->name('download');
            });

            // Motivational letter routes
            Route::get('motivationsschreiben', [MotivationController::class, 'create'])->name('motivation');
            Route::prefix('motivation')->name('motivation.')->group(function () {

                Route::post('preview', [MotivationController::class, 'preview']);
                Route::post('generate', [MotivationController::class, 'generate'])->name('generate');
                Route::post('download-pdf', [MotivationController::class, 'downloadPDF'])->name('download-pdf');
            });
        });

        Route::view('karrieregenie', 'karriere.karriere_genie')->name('karrieregenie');

        ### JOB MATCH ROUTES
        Route::get('jobmatch', [JobMatchController::class, 'create'])->name('jobmatch');
        Route::resource('jobmatch', JobMatchController::class)->except(['index', 'create', 'show', 'edit', 'update', 'destroy']);


        ### JOB INSIDER ROUTES
        Route::get('jobinsider', [JobInsiderController::class, 'create'])->name('jobinsider');
        Route::resource('jobinsider', JobInsiderController::class)->except(['index', 'create', 'show', 'edit', 'update', 'destroy']);
    });
});

### PAYPAL ROUTES ###
Route::prefix('paypal')->name('paypal.')->group(function () {
    Route::view('/', 'paypal')->name('paypal');

    Route::get('payment/{name}', [PayPalController::class, 'payment'])->name('payment');

    Route::prefix('payment')->name('payment.')->group(function () {
        Route::get('success', [PayPalController::class, 'paymentSuccess'])->name('success');
        Route::get('cancel', [PayPalController::class, 'paymentCancel'])->name('cancel');
    });
});

// PayPal Checkout routes
Route::get('/setup-plans', [PayPalController::class, 'setupPlans'])->name('paypal.setupPlans');
Route::post('/create-subscription', [PayPalController::class, 'createSubscription'])->name('paypal.createSubscription');
Route::get('/update-subscription', [PayPalController::class, 'updateSubscription'])->name('paypal.updateSubscription');

### USER ROUTES ###
Route::post('/postLogin', [FrontController::class, 'postLogin']);
Route::post('/postRegistration', [FrontController::class, 'postRegistration']);
Route::post('/register', [UserController::class, 'register'])->name('register.post');
Route::post('change-password', [FrontController::class, 'changePassword'])->name('change.password');

Route::prefix('user')->name('user.')->group(function () {
    Route::delete('{user}/delete', [UserController::class, 'destroy'])->name('destroy');
});

Auth::routes();

### SOCIALITE ROUTES ###
Route::get('login/{provider}', [LoginController::class, 'redirectToProvider']);
Route::get('auth/callback/{provider}', [LoginController::class, 'handleProviderCallback']);


// Route for showing the password reset form
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');

// Route for sending the password reset link
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

// Route for showing the password reset form with the token
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

// Route for resetting the password
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

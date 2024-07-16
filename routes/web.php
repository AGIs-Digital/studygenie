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

Route::post('/processOpenAIRequest/{toolIdentifier}', [FrontController::class, 'processOpenAIRequest'])
    ->name('processOpenAIRequest');

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('conversation')->group(function () {
        // The /create route is a POST request to create a new conversation
        Route::post('/create', [ConversationController::class, 'create']);

        // The /{toolIdentifier} route is a GET request to get a conversation by its tool identifier
        Route::get('/init/{toolIdentifier}', [ConversationController::class, 'get'])->name('conversation.get');

        // The /{id}/message route is a POST request to add a message to a conversation
        Route::post('/{id}/message', [ConversationController::class, 'askAi'])->name('conversation.askAi');

        Route::post('/{conversation}/archive', [ConversationController::class, 'archive'])->name('conversation.archive');
    });
});


Route::get('/', function () {
    return view('index');
})->name('home')->middleware('check.tutorial');

Route::get('/get-latest-ai-response', [FrontController::class, 'getLatestAIResponse'])
    ->name('getLatestAIResponse');

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

    Route::get('/GenieCheck', function () {
        return view('Bildung.GenieCheck');
    });

    Route::get('/TextAnalyse', function () {
        return view('Bildung.TextAnalyse');
    });

    Route::get('/TextInspiration', function () {
        if(auth()->check() && (auth()->user()->subscription_name == 'gold' || auth()->user()->subscription_name == 'diamant')){
            return view('Bildung.TextInspiration');
        }
        return abort(404);
    })->middleware('auth');

    Route::get('/BewerbeGenie', function () {
        if((auth()->user()->subscription_name == 'gold' || auth()->user()->subscription_name == 'diamant')){
            return view('Karriere.BewerbeGenie');
        }
        return abort(404);
    });

    Route::get('/GenieAutor', function () {
        if(auth()->check() && (auth()->user()->subscription_name == 'gold' || auth()->user()->subscription_name == 'diamant')){
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

    Route::post('cv-preview', [App\Http\Controllers\CVController::class, 'cvPreview']);
    Route::post('download-pdf', [App\Http\Controllers\CVController::class, 'downloadPDF']);

    Route::get('/Motivationsschreiben', function () {
        if((auth()->user()->subscription_name == 'gold' || auth()->user()->subscription_name == 'diamant')){
            return view('Karriere.Motivationsschreiben');
        }
        return abort(404);
    });

    Route::post('motivation-preview', [App\Http\Controllers\MotivationController::class, 'motivationPreview']);
    Route::post('download-motivation-pdf', [MotivationController::class, 'downloadPDF'])->name('download-motivation-pdf');

    Route::post('Motivationsschreibenprocess', [FrontController::class, 'Motivationsschreibenprocess'])
        ->name('Motivationsschreibenprocess');   

    Route::get('genieTutor', [FrontController::class, 'genieTutor']);

    Route::get('/KarriereMentor', [FrontController::class, 'KarriereMentor']);
    Route::post('/KarriereMentor-one', [FrontController::class, 'KarriereMentorFirst'])
        ->name('KarriereMentor');
    Route::post('KarriereMentor-user', [FrontController::class, 'KarriereMentorUser'])
        ->name('KarriereMentoruser');

    Route::post('TextInspirationprocess', [FrontController::class, 'TextInspirationprocess'])
        ->name('TextInspirationprocess');

    Route::post('TextAnalyseprocess', [FrontController::class, 'TextAnalyseprocess'])
        ->name('TextAnalyseprocess');

    Route::post('JobMatchprocess', [FrontController::class, 'JobMatchprocess'])
        ->name('JobMatchprocess');

    Route::post('JobInsiderprocess', [FrontController::class, 'JobInsiderprocess'])
        ->name('JobInsiderprocess');

    Route::post('savedata', [FrontController::class, 'saveData'])
        ->name('save.data');

    Route::post('GenieCheckprocess', [FrontController::class, 'GenieCheckprocess'])
        ->name('GenieCheckprocess');

    Route::get('/KarriereGenie', function () {
        return view('Karriere.KarriereGenie');
    });

});

Route::post('/postLogin', [FrontController::class, 'postLogin']);
Route::post('/postRegistration', [FrontController::class, 'postRegistration']);
Route::post('/register', [UserController::class, 'register'])
    ->name('register.post');

Route::get('/impressum', function () {
    return view('impressum');
});

Route::get('/agb', function () {
    return view('agb');
});

Route::get('/datenschutz', function () {
    return view('datenschutz');
});

Route::get('paypal', [FrontController::class, 'paypalindex'])
    ->name('paypal');
Route::get('paypal/payment/{name}', [FrontController::class, 'payment'])
    ->name('paypal.payment');

/* Route::get('stripe/payment/{name}', [FrontController::class, 'stripePayment'])
    ->name('stripe.payment');
Route::get('stripe/payment/success', [FrontController::class, 'StripeSuccess'])
    ->name('stripe.success'); */

Route::get('paypal/payment/success', [FrontController::class, 'paymentSuccess'])
    ->name('paypal.payment.success');
Route::get('paypal/payment/cancel', [FrontController::class, 'paymentCancel'])
    ->name('paypal.payment/cancel');
Route::post('change-password', [FrontController::class, 'changePassword'])
    ->name('change.password');

Auth::routes();

Route::delete('/user/delete', [FrontController::class, 'delete'])
    ->name('user.delete');

// Archive routes: Route them all to Archive Controller. Make them only available to atuhenticated users
Route::middleware('auth')->group(function () {
    Route::get('/archive', [ArchiveController::class, 'index'])->name('archive.index');
    Route::get('/archive/{archive}', [ArchiveController::class, 'show'])->name('archive.show');
    Route::get('/archive/{archive}/edit', [ArchiveController::class, 'edit'])->name('archive.edit');
    Route::put('/archive/{archive}', [ArchiveController::class, 'update'])->name('archive.update');
    Route::delete('/archive/{archive}', [ArchiveController::class, 'destroy'])->name('archive.destroy');
});

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
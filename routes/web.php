<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArchiveController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\Karriere\MentorController;
use App\Http\Controllers\Karriere\LebenslaufController;
use App\Http\Controllers\Karriere\JobInsiderController;
use App\Http\Controllers\Karriere\JobMatchController;
use App\Http\Controllers\Karriere\MotivationController;
use App\Http\Controllers\Bildung\GenieCheckController;
use App\Http\Controllers\Bildung\TextInspirationController;
use App\Http\Controllers\Bildung\TextAnalysisController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AdminFeedbackController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\Bildung\GenieTutorController;
use App\Http\Controllers\WebhookController;

### PUBLIC VIEW ROUTES ###
Route::view('impressum', 'impressum')->name('impressum');
Route::view('agb', 'agb')->name('agb');
Route::view('datenschutz', 'datenschutz')->name('datenschutz');

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/home', function () {
    return view('home');
})->name('dashboard');

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
    Route::view('tools', 'tools')->name('tools');
    Route::get('profile', [UserController::class, 'show'])->name('profile');

    // Resources
    Route::resource('archive', ArchiveController::class)->except(['create', 'store']);

    ### BILDUNG ROUTES ###
    Route::view('bildung', 'bildung')->name('bildung');
    Route::prefix('bildung')->name('bildung.')->group(function () {
        Route::get('geniecheck', [GenieCheckController::class, 'create'])->name('geniecheck.create');
        Route::resource('geniecheck', GenieCheckController::class)->except(['index', 'create', 'show', 'edit', 'update', 'destroy']);

        // bildung Routes which require diamant subscription
        Route::middleware(['check.subscription.expiry', 'check.subscription:diamant'])->group(function () {
            Route::get('genie_tutor', [GenieTutorController::class, 'create'])->name('genie_tutor.create');
            Route::post('genie_tutor', [GenieTutorController::class, 'store'])->name('genie_tutor.store');
        });

        // bildung Routes which require gold or diamant subscription
        Route::middleware(['auth', 'check.subscription.expiry', 'check.subscription:gold,diamant'])->group(function () {
            Route::view('texte', 'bildung.texte')->name('texte');
            Route::get('textinspiration', [TextInspirationController::class, 'create'])->name('textinspiration');
            Route::resource('textinspiration', TextInspirationController::class)->except(['index', 'create', 'show', 'edit', 'update', 'destroy']);
            Route::get('textanalyse', [TextAnalysisController::class, 'create'])->name('textanalysis');
            Route::resource('textanalysis', TextAnalysisController::class)->except(['index', 'create', 'show', 'edit', 'update', 'destroy']);
        });
    });

    ### KARRIERE ROUTES ###
    Route::prefix('karriere')->name('karriere.')->group(function () {
        Route::view('/', 'karriere')->name('index');

        // Karriere-Mentor routes - only available to users with a diamant subscription
        Route::middleware(['check.subscription.expiry', 'check.subscription:diamant'])->group(function () {
            Route::get('mentor', [MentorController::class, 'create'])->name('mentor');
            Route::resource('mentor', MentorController::class)->except(['index', 'create', 'show', 'edit', 'update', 'destroy']);
        });

        // Routes which require gold or diamant subscription
        Route::middleware(['check.subscription.expiry', 'check.subscription:gold,diamant'])->group(function () {
            // bewerbung routes - only available to users with a gold or diamant subscription
            Route::view('bewerbung', 'karriere.bewerbung')->name('bewerbung');

            // Lebenslauf routes
            Route::get('lebenslauf', [LebenslaufController::class, 'create'])->name('lebenslauf');
            Route::prefix('lebenslauf')->name('lebenslauf.')->group(function () {
                Route::post('preview', [LebenslaufController::class, 'preview'])->name('preview');
                Route::post('download', [LebenslaufController::class, 'download'])->name('download');
            });

            // Motivational letter routes
            Route::get('motivationsschreiben', [MotivationController::class, 'create'])->name('motivation');
            Route::prefix('motivation')->name('motivation.')->group(function () {
                Route::post('preview', [MotivationController::class, 'preview'])->name('preview');
                Route::post('generate', [MotivationController::class, 'generate'])->name('generate');
                Route::post('download-pdf', [MotivationController::class, 'downloadPDF'])->name('download-pdf');
            });
        });

        Route::view('berufe', 'karriere.berufe')->name('berufe');

        ### JOB MATCH ROUTES ###
        Route::get('jobmatch', [JobMatchController::class, 'create'])->name('jobmatch');
        Route::resource('jobmatch', JobMatchController::class)->except(['index', 'create', 'show', 'edit', 'update', 'destroy']);

        ### JOB INSIDER ROUTES ###
        Route::get('jobinsider', [JobInsiderController::class, 'create'])->name('jobinsider');
        Route::resource('jobinsider', JobInsiderController::class)->except(['index', 'create', 'show', 'edit', 'update', 'destroy']);
    });
});

### USER ROUTES ###
Route::post('/postLogin', [LoginController::class, 'postLogin'])->middleware('throttle:5,1')->name('login.post');
Route::post('/postRegistration', [RegisterController::class, 'postRegistration'])->name('register.post');
Route::post('change-password', [FrontController::class, 'changePassword'])->name('change.password');

Route::prefix('user')->name('user.')->group(function () {
    Route::delete('{user}/delete', [UserController::class, 'destroy'])->name('destroy');
});

Auth::routes();

### SOCIALITE ROUTES ###
Route::get('login/{provider}', [LoginController::class, 'redirectToProvider']);
Route::get('auth/callback/{provider}', [LoginController::class, 'handleProviderCallback']);

// Route for sending the password reset link
Route::post('password/email', [ResetPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

### ADMIN ROUTES ###
Route::get('/admin/feedbacks', [AdminFeedbackController::class, 'index'])->name('admin.feedbacks.index')->middleware('admin');
Route::delete('/admin/feedbacks/{id}', [AdminFeedbackController::class, 'destroy'])->name('admin.feedbacks.destroy')->middleware('admin');

// Route for showing the password reset form
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Route for resetting the password
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::post('subscriptions/update', [SubscriptionController::class, 'updateSubscription'])->name('subscriptions.update');

Route::get('auth/google/redirect', [LoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::post('/webhook/paypal', [WebhookController::class, 'handle']);

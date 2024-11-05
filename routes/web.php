<?php

use App\Http\Controllers\AdminFeedbackController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Bildung\GenieCheckController;
use App\Http\Controllers\Bildung\TextAnalysisController;
use App\Http\Controllers\Bildung\TextInspirationController;
use App\Http\Controllers\Bildung\TutorController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Karriere\JobInsiderController;
use App\Http\Controllers\Karriere\JobMatchController;
use App\Http\Controllers\Karriere\LebenslaufController;
use App\Http\Controllers\Karriere\MentorController;
use App\Http\Controllers\Karriere\MotivationController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\PayPalSandboxTestController;
use App\Http\Controllers\PayPalWebhookController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

### PUBLIC ROUTES ###
Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/home', function () {
    return view('home');
})->name('dashboard');

Route::view('impressum', 'impressum')->name('impressum');
Route::view('agb', 'agb')->name('agb');
Route::view('datenschutz', 'datenschutz')->name('datenschutz');

### AUTH ROUTES ###
Auth::routes();

Route::post('/postLogin', [LoginController::class, 'postLogin'])
    ->middleware('throttle:5,1')
    ->name('login.post');
    
Route::post('/postRegistration', [RegisterController::class, 'postRegistration'])
    ->name('register.post');

Route::post('change-password', [FrontController::class, 'changePassword'])
    ->name('change.password');

Route::post('password/email', [ResetPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('password/reset', [ResetPasswordController::class, 'reset'])
    ->name('password.update');

### SOCIALITE ROUTES ###
Route::get('login/{provider}', [LoginController::class, 'redirectToProvider']);
Route::get('auth/callback/{provider}', [LoginController::class, 'handleProviderCallback']);

Route::get('auth/google/redirect', [LoginController::class, 'redirectToGoogle'])
    ->name('google.redirect');
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

### AUTHENTICATED ROUTES ###
Route::group(['middleware' => ['auth']], function () {
    Route::view('tools', 'tools')->name('tools');
    Route::get('profile', [UserController::class, 'show'])->name('profile');
    
    Route::resource('archive', ArchiveController::class)
        ->except(['create', 'store']);

    ### CONVERSATION ROUTES ###
    Route::middleware('auth:sanctum')->prefix('conversation')->group(function () {
        Route::post('/create', [ConversationController::class, 'create']);
        Route::get('/init/{toolIdentifier}', [ConversationController::class, 'get'])
            ->name('conversation.get');
        Route::post('/{id}/message', [ConversationController::class, 'askAi'])
            ->name('conversation.askAi');
        Route::post('/{conversation}/archive', [ConversationController::class, 'archive'])
            ->name('conversation.archive');
    });

    ### BILDUNG ROUTES ###
    Route::view('bildung', 'bildung')->name('bildung');
    Route::prefix('bildung')->name('bildung.')->group(function () {
        Route::get('geniecheck', [GenieCheckController::class, 'create'])
            ->name('geniecheck.create');
        Route::resource('geniecheck', GenieCheckController::class)
            ->except(['index', 'create', 'show', 'edit', 'update', 'destroy']);

        // Diamant subscription routes
        Route::middleware(['check.subscription.expiry', 'check.subscription:Diamant'])->group(function () {
            Route::get('tutor', [TutorController::class, 'create'])
                ->name('tutor.create');
            Route::post('tutor', [TutorController::class, 'store'])
                ->name('tutor.store');
        });

        // Gold or Diamant subscription routes
        Route::middleware(['check.subscription.expiry', 'check.subscription:Gold,Diamant'])->group(function () {
            Route::view('texte', 'bildung.texte')->name('texte');
            Route::get('textinspiration', [TextInspirationController::class, 'create'])
                ->name('textinspiration');
            Route::resource('textinspiration', TextInspirationController::class)
                ->except(['index', 'create', 'show', 'edit', 'update', 'destroy']);
            Route::get('textanalyse', [TextAnalysisController::class, 'create'])
                ->name('textanalysis');
            Route::resource('textanalysis', TextAnalysisController::class)
                ->except(['index', 'create', 'show', 'edit', 'update', 'destroy']);
        });
    });

    ### KARRIERE ROUTES ###
    Route::prefix('karriere')->name('karriere.')->group(function () {
        Route::view('/', 'karriere')->name('index');
        Route::view('berufe', 'karriere.berufe')->name('berufe');

        // Diamant subscription routes
        Route::middleware(['check.subscription.expiry', 'check.subscription:Diamant'])->group(function () {
            Route::get('mentor', [MentorController::class, 'create'])
                ->name('mentor');
            Route::resource('mentor', MentorController::class)
                ->except(['index', 'create', 'show', 'edit', 'update', 'destroy']);
        });

        // Gold or Diamant subscription routes
        Route::middleware(['check.subscription.expiry', 'check.subscription:Gold,Diamant'])->group(function () {
            Route::view('bewerbung', 'karriere.bewerbung')->name('bewerbung');

            // Lebenslauf routes
            Route::get('lebenslauf', [LebenslaufController::class, 'create'])
                ->name('lebenslauf');
            Route::prefix('lebenslauf')->name('lebenslauf.')->group(function () {
                Route::post('preview', [LebenslaufController::class, 'preview'])
                    ->name('preview');
                Route::post('download', [LebenslaufController::class, 'download'])
                    ->name('download');
            });

            // Motivation routes
            Route::get('motivationsschreiben', [MotivationController::class, 'create'])
                ->name('motivation');
            Route::prefix('motivation')->name('motivation.')->group(function () {
                Route::post('preview', [MotivationController::class, 'preview'])
                    ->name('preview');
                Route::post('generate', [MotivationController::class, 'generate'])
                    ->name('generate');
                Route::post('download-pdf', [MotivationController::class, 'downloadPDF'])
                    ->name('download-pdf');
            });
        });

        // Job routes
        Route::get('jobmatch', [JobMatchController::class, 'create'])
            ->name('jobmatch');
        Route::resource('jobmatch', JobMatchController::class)
            ->except(['index', 'create', 'show', 'edit', 'update', 'destroy']);

        Route::get('jobinsider', [JobInsiderController::class, 'create'])
            ->name('jobinsider');
        Route::resource('jobinsider', JobInsiderController::class)
            ->except(['index', 'create', 'show', 'edit', 'update', 'destroy']);
    });
});

### USER ROUTES ###
Route::prefix('user')->name('user.')->group(function () {
    Route::delete('{user}/delete', [UserController::class, 'destroy'])
        ->name('destroy');
});

### ADMIN ROUTES ###
Route::middleware('admin')->group(function () {
    Route::get('/admin/feedbacks', [AdminFeedbackController::class, 'index'])
        ->name('admin.feedbacks.index');
    Route::delete('/admin/feedbacks/{id}', [AdminFeedbackController::class, 'destroy'])
        ->name('admin.feedbacks.destroy');
});

### SUBSCRIPTION & PAYMENT ROUTES ###
Route::post('subscriptions/update', [SubscriptionController::class, 'updateSubscription'])
    ->name('subscriptions.update');

Route::post('subscriptions/cancel', [SubscriptionController::class, 'cancelSubscription'])
    ->name('subscriptions.cancel')
    ->middleware('auth');

Route::get('/subscription/expired', function () {
    return view('subscription.expired');
})->name('subscription.expired');

Route::post('/webhook/paypal', [WebhookController::class, 'handle']);

Route::post('paypal/webhook', [PayPalWebhookController::class, 'handleWebhook'])
    ->name('paypal.webhook')
    ->middleware('api');

// Test routes for non-production environments
if (config('services.paypal.mode') !== 'live') {
    Route::get('/paypal/test-webhook', [PayPalSandboxTestController::class, 'simulateWebhook'])
        ->middleware('auth')
        ->name('test.paypal.webhook');
}

### FEEDBACK ROUTES ###
Route::post('/feedback', [FeedbackController::class, 'store'])
    ->name('feedback.store');

### TOOL ACCESS ROUTES ###
Route::middleware(['auth', 'tool.access'])->group(function () {
    Route::get('/bildung/tutor', [TutorController::class, 'index'])
        ->name('bildung.tutor');
    Route::get('/bildung/textanalyse', [TextAnalyseController::class, 'index'])
        ->name('bildung.textanalyse');
});

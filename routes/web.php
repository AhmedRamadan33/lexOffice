<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\CaseSessionController;
use App\Http\Controllers\CaseTypeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientPortal\AuthController as ClientAuthController;
use App\Http\Controllers\ClientPortal\PortalController;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PracticeAreaController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\SuccessStoryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/lang/{locale}', LocaleController::class)->name('locale.update');

Route::get('/', [PublicController::class, 'home'])->name('public.home');
Route::get('/about', [PublicController::class, 'about'])->name('public.about');
Route::get('/services', [PublicController::class, 'services'])->name('public.services');
Route::get('/team', [PublicController::class, 'team'])->name('public.team');
Route::get('/team/{user}', [PublicController::class, 'teamShow'])->name('public.team.show');
Route::get('/success-stories', [PublicController::class, 'stories'])->name('public.stories');
Route::get('/success-stories/{story}', [PublicController::class, 'storyShow'])->name('public.stories.show');
Route::get('/contact', [PublicController::class, 'contact'])->name('public.contact');
Route::post('/contact', [PublicController::class, 'contactStore'])->name('public.contact.store');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::middleware('guest:client')->group(function () {
    Route::get('/client-portal', [ClientAuthController::class, 'create'])->name('public.client-portal');
    Route::post('/client-portal', [ClientAuthController::class, 'store'])->name('public.client-portal.store');
});

Route::middleware('auth:client')->prefix('portal')->name('portal.')->group(function () {
    Route::post('/logout', [ClientAuthController::class, 'destroy'])->name('logout');
    Route::get('/', [PortalController::class, 'dashboard'])->name('dashboard');
    Route::get('/cases', [PortalController::class, 'cases'])->name('cases.index');
    Route::get('/cases/{case}', [PortalController::class, 'caseShow'])->name('cases.show');
    Route::get('/invoices', [PortalController::class, 'invoices'])->name('invoices.index');
    Route::get('/invoices/{invoice}', [PortalController::class, 'invoiceShow'])->name('invoices.show');
    Route::get('/documents', [PortalController::class, 'documents'])->name('documents.index');
    Route::get('/profile', [PortalController::class, 'profile'])->name('profile.edit');
    Route::put('/profile/password', [PortalController::class, 'updatePassword'])->name('profile.password');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::get('/admin', DashboardController::class)->name('dashboard');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead'])->name('notifications.read-all');

    Route::middleware('can:manage-clients')->group(function () {
        Route::resource('clients', ClientController::class);
    });

    Route::middleware('can:manage-cases')->group(function () {
        Route::resource('cases', CaseController::class);
        Route::get('/sessions', [CaseSessionController::class, 'indexAll'])->name('sessions.index');
        Route::resource('cases.sessions', CaseSessionController::class)
            ->parameters(['sessions' => 'session'])
            ->except(['index', 'show']);
        Route::resource('courts', CourtController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('case-types', CaseTypeController::class)
            ->parameters(['case-types' => 'case_type'])
            ->only(['index', 'store', 'update', 'destroy']);
    });

    Route::middleware('can:manage-tasks')->group(function () {
        Route::resource('tasks', TaskController::class)->except('show');
    });

    Route::middleware('can:manage-invoices')->group(function () {
        Route::resource('invoices', InvoiceController::class);
        Route::post('/invoices/{invoice}/payments', [PaymentController::class, 'store'])->name('invoices.payments.store');
        Route::delete('/payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');
    });

    Route::middleware('can:manage-expenses')->group(function () {
        Route::resource('expenses', ExpenseController::class)->except('show');
    });

    Route::middleware('can:manage-users')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class)->except('show');
    });

    Route::middleware('can:manage-branches')->group(function () {
        Route::resource('branches', BranchController::class)->except('show');
    });

    Route::middleware('can:view-activity-log')->group(function () {
        Route::get('/activity-log', [ActivityLogController::class, 'index'])->name('activity-log.index');
    });

    Route::middleware('can:manage-settings')->prefix('cms')->group(function () {
        Route::get('/site-settings', [SiteSettingController::class, 'edit'])->name('site-settings.edit');
        Route::put('/site-settings', [SiteSettingController::class, 'update'])->name('site-settings.update');

        Route::resource('practice-areas', PracticeAreaController::class)->except('show');
        Route::resource('testimonials', TestimonialController::class)->except('show');
        Route::resource('success-stories', SuccessStoryController::class)->except('show');

        Route::resource('contact-messages', ContactMessageController::class)->only(['index', 'destroy']);
        Route::patch('/contact-messages/{contact_message}/read', [ContactMessageController::class, 'markRead'])->name('contact-messages.read');
    });

    Route::post('/documents/{type}/{id}', [DocumentController::class, 'store'])
        ->whereIn('type', ['client', 'case'])
        ->name('documents.store');
    Route::patch('/documents/{media}/toggle-visibility', [DocumentController::class, 'toggleVisibility'])->name('documents.toggle-visibility');
    Route::delete('/documents/{media}', [DocumentController::class, 'destroy'])->name('documents.destroy');
});

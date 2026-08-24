<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\CaseSessionController;
use App\Http\Controllers\CaseTypeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/lang/{locale}', LocaleController::class)->name('locale.update');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::get('/', DashboardController::class)->name('dashboard');

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

    Route::post('/documents/{type}/{id}', [DocumentController::class, 'store'])
        ->whereIn('type', ['client', 'case'])
        ->name('documents.store');
    Route::delete('/documents/{media}', [DocumentController::class, 'destroy'])->name('documents.destroy');
});

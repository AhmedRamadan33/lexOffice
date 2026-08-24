<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\V1\ActivityLogController;
use App\Http\Controllers\Api\V1\BranchController;
use App\Http\Controllers\Api\V1\CaseController;
use App\Http\Controllers\Api\V1\CaseSessionController;
use App\Http\Controllers\Api\V1\CaseTypeController;
use App\Http\Controllers\Api\V1\ClientController;
use App\Http\Controllers\Api\V1\CourtController;
use App\Http\Controllers\Api\V1\DocumentController;
use App\Http\Controllers\Api\V1\ExpenseController;
use App\Http\Controllers\Api\V1\InvoiceController;
use App\Http\Controllers\Api\V1\NotificationController;
use App\Http\Controllers\Api\V1\PaymentController;
use App\Http\Controllers\Api\V1\RoleController;
use App\Http\Controllers\Api\V1\TaskController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::get('/notifications', [NotificationController::class, 'index'])->name('api.notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markRead'])->name('api.notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead'])->name('api.notifications.read-all');

    Route::prefix('v1')->group(function () {
        Route::apiResource('clients', ClientController::class)
            ->names('api.clients')
            ->middleware('can:manage-clients');

        Route::middleware('can:manage-cases')->group(function () {
            Route::apiResource('cases', CaseController::class)->names('api.cases');
            Route::apiResource('cases.sessions', CaseSessionController::class)
                ->parameters(['sessions' => 'session'])
                ->names('api.cases.sessions')
                ->except(['show']);
            Route::apiResource('courts', CourtController::class)->names('api.courts');
            Route::apiResource('case-types', CaseTypeController::class)
                ->parameters(['case-types' => 'case_type'])
                ->names('api.case-types');
        });

        Route::middleware('can:manage-invoices')->group(function () {
            Route::apiResource('invoices', InvoiceController::class)->names('api.invoices');
            Route::post('/invoices/{invoice}/payments', [PaymentController::class, 'store'])->name('api.invoices.payments.store');
            Route::delete('/payments/{payment}', [PaymentController::class, 'destroy'])->name('api.payments.destroy');
        });

        Route::apiResource('expenses', ExpenseController::class)
            ->names('api.expenses')
            ->middleware('can:manage-expenses');

        Route::apiResource('tasks', TaskController::class)
            ->names('api.tasks')
            ->middleware('can:manage-tasks');

        Route::middleware('can:manage-users')->group(function () {
            Route::apiResource('users', UserController::class)->names('api.users');
            Route::apiResource('roles', RoleController::class)->names('api.roles');
        });

        Route::apiResource('branches', BranchController::class)
            ->names('api.branches')
            ->middleware('can:manage-branches');

        Route::get('/activity-log', [ActivityLogController::class, 'index'])
            ->name('api.activity-log.index')
            ->middleware('can:view-activity-log');

        Route::post('/documents/{type}/{id}', [DocumentController::class, 'store'])
            ->whereIn('type', ['client', 'case'])
            ->name('api.documents.store');
        Route::delete('/documents/{media}', [DocumentController::class, 'destroy'])->name('api.documents.destroy');
    });
});

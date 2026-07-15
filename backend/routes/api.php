<?php

use App\Http\Controllers\Api\V1\Admin\AdminUsersController;
use App\Http\Controllers\Api\V1\Admin\ShowUserController;
use App\Http\Controllers\Api\V1\Admin\AdminZoneController;
use App\Http\Controllers\Api\V1\Admin\AssignRolePermissionsController;
use App\Http\Controllers\Api\V1\Admin\CreateRoleController;
use App\Http\Controllers\Api\V1\Admin\UpdateRoleController;
use App\Http\Controllers\Api\V1\Admin\AssignUserRolesController;
use App\Http\Controllers\Api\V1\Admin\RemoveUserRolesController;
use App\Http\Controllers\Api\V1\Admin\CreateUserController;
use App\Http\Controllers\Api\V1\Admin\UpdateUserController;
use App\Http\Controllers\Api\V1\Admin\UpdateUserStatusController;
use App\Http\Controllers\Api\V1\Admin\GrantUserPermissionController;
use App\Http\Controllers\Api\V1\Auth\CurrentUserController;
use App\Http\Controllers\Api\V1\Auth\IssueAccessTokenController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\LogoutController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Auth\RequestPasswordResetController;
use App\Http\Controllers\Api\V1\Auth\ResetPasswordController;
use App\Http\Controllers\Api\V1\Student\StudentZoneController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {
    Route::post('register', RegisterController::class);

    Route::middleware('throttle:6,1')->group(function (): void {
        Route::post('password/forgot', RequestPasswordResetController::class);
        Route::post('password/reset', ResetPasswordController::class)->name("password.reset");
    });

    /** Stateless Sanctum PAT (Postman / scripts) — no session, no CSRF. */
    Route::post('access-token', IssueAccessTokenController::class)->middleware('throttle:10,1');

    Route::middleware(['auth:sanctum', 'account.active'])->group(function (): void {
        Route::get('me', CurrentUserController::class);
        Route::post('logout', LogoutController::class);

        Route::middleware('role:student')->prefix('student')->group(function (): void {
            Route::get('/', StudentZoneController::class)->name('api.v1.student.zone');
        });

        Route::middleware('role:admin,editor,super-admin')->prefix('admin')->group(function (): void {
            Route::get('/', AdminZoneController::class)->name('api.v1.admin.zone');

            Route::middleware(['role:admin,super-admin', 'permission:users.manage'])->group(function (): void {
                Route::get('users', AdminUsersController::class)->name('api.v1.admin.users');
                Route::get('users/{user}', ShowUserController::class)->name('api.v1.admin.users.show');
                Route::post('users', CreateUserController::class)->name('api.v1.admin.users.store');
                Route::put('users/{user}', UpdateUserController::class)->name('api.v1.admin.users.update');
                Route::patch('users/{user}/status', UpdateUserStatusController::class)->name('api.v1.admin.users.status');
                Route::put('users/{user}/roles', AssignUserRolesController::class)->name('api.v1.admin.users.roles');
                Route::delete('users/{user}/roles', RemoveUserRolesController::class)->name('api.v1.admin.users.roles.remove');
                Route::put('users/{user}/permissions', GrantUserPermissionController::class)->name('api.v1.admin.users.permissions');
                Route::post('roles', CreateRoleController::class)->name('api.v1.admin.roles.store');
                Route::put('roles/{role}', UpdateRoleController::class)->name('api.v1.admin.roles.update');
                Route::put('roles/{role}/permissions', AssignRolePermissionsController::class)->name('api.v1.admin.roles.permissions');
            });
        });
    });

    Route::middleware('web')->group(function (): void {
        Route::post('login', LoginController::class);
    });
});

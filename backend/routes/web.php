<?php

use App\Application\IdentityAccess\Actions\LogoutUserAction;
use App\Domain\IdentityAccess\Services\PostLoginRedirectResolver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

if (app()->environment('local')) {
    Route::view('/register', 'auth.register')->name('register');
    Route::view('/login', 'auth.login')->name('login');

    Route::middleware(['auth', 'account.active'])->group(function (): void {

        Route::get('/dashboard', function (Request $request, PostLoginRedirectResolver $resolver) {
            return redirect()->to($resolver->pathFor($request->user()));
        })->name('dashboard');

        Route::middleware('role:student')->group(function (): void {
            Route::view('/user', 'user.index')->name('user.dashboard');
        });

        Route::middleware('role:admin,editor,super-admin')->group(function (): void {
            Route::view('/admin', 'admin.index')->name('admin.dashboard');
        });
    });

    Route::post('/logout', function (Request $request, LogoutUserAction $logout) {
        $logout->execute($request);

        return redirect('/');
    })->middleware(['auth', 'account.active'])->name('logout');
}

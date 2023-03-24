<?php
use Illuminate\Support\Facades\Route;
use \App\Blog\Controllers\AuthController;

Route::prefix("blog")
    ->name("blog.")
    ->middleware(['web'])
    ->group(function(){
        Route::get("logout", [AuthController::class, 'logout'])->name("logout");
        Route::middleware(['guest'])
            ->group(function(){
                Route::get("login", [AuthController::class, 'showFormLogin'])->name("login");
                Route::post("login", [AuthController::class, 'authenticate']);
            });

        Route::middleware(['auth'])
            ->group(function(){
                Route::get("/", function(){
                    echo 'Blog of '. \Illuminate\Support\Facades\Auth::user()->email;
                })->name("dashboard");
            });
});
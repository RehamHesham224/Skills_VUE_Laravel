<?php

use App\Http\Controllers\SkillController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth:sanctum','admin'])->group(function(){
    Route::apiResource('skills',SkillController::class);
    Route::post('logout',[UserController::class,'logout']);
    Route::get('user',[UserController::class,'user']);
});
Route::post('login',[UserController::class,'login'])->name('login');

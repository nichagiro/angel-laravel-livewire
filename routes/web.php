<?php

use App\Http\Controllers\ShowBlogController;
use App\Http\Livewire\Blogs\IndexBlogsLivewire;
use App\Http\Livewire\Contact\CorreoQRLivewire;
use App\Http\Livewire\Helpers\HelpersLaravelLivewire;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('blogs', IndexBlogsLivewire::class)->name('post')->middleware('auth_cord');

Route::get('contacto', CorreoQRLivewire::class)->name('contact')->middleware('invitado');

Route::get('blog/{id}', [ShowBlogController::class, 'visualizar'])->name('blog');

Route::get('ayudantes', HelpersLaravelLivewire::class)->name('helper')->middleware('auth_cord');;






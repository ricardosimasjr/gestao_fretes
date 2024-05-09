<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransportadorController;
use App\Http\Controllers\CotacaoController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    //Home

    Route::get('/home', [HomeController::class, 'home'])->name('home');
    
    //Transportadores

    Route::get('/transportadores', [TransportadorController::class, 'list'])->name('transportador.list');
    Route::get('/transportadores/create', [TransportadorController::class, 'create'])->name('transportador.create');
    Route::post('/transportadores/store', [TransportadorController::class, 'store'])->name('transportador.store');
    Route::get('/transportadores/show/{transportador}', [TransportadorController::class, 'show'])->name('transportador.show');
    Route::get('/transportadores/edit/{transportador}', [TransportadorController::class, 'edit'])->name('transportador.edit');
    Route::put('/transportadores/update/{transportador}', [TransportadorController::class, 'update'])->name('transportador.update');
    Route::delete('/transportadores/delete/{transportador}', [TransportadorController::class, 'destroy'])->name('transportador.destroy');

    //Cotações

    Route::get('/cotacoes', [CotacaoController::class, 'list'])-> name('cotacoes.list');
    Route::get('/cotacoes/create', [CotacaoController::class, 'create'])-> name('cotacoes.create');


});

require __DIR__.'/auth.php';

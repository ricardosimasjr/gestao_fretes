<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransportadorController;
use App\Http\Controllers\CotacaoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('home');

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

    Route::any('/logoff', [LoginController::class, 'logout'])->name('user.logout');

    //Cotações

    Route::get('/cotacoes', [CotacaoController::class, 'list'])-> name('cotacoes.list');
    Route::any('/cotacoes/create', [CotacaoController::class, 'create'])-> name('cotacoes.create');

    //Pedidos

    Route::get('/pedidos', [PedidoController::class, 'list'])-> name('pedidos.list');
    Route::any('/pedidos/create', [PedidoController::class, 'create'])-> name('pedidos.create');
    Route::post('/pedidos/store', [PedidoController::class, 'store'])-> name('pedidos.store');
    Route::get('/pedidos/show', [PedidoController::class, 'show'])-> name('pedidos.show');
    Route::get('/pedidos/edit', [PedidoController::class, 'edit'])-> name('pedidos.edit');
    Route::put('/pedidos/update', [PedidoController::class, 'update'])-> name('pedidos.update');
    Route::delete('/pedidos/destroy', [PedidoController::class, 'destroy'])-> name('pedidos.destroy');

    //Notas

    Route::get('/notas', [NotaController::class, 'list'])-> name('notas.list');
    Route::any('/notas/create', [NotaController::class, 'create'])-> name('notas.create');
    Route::post('/notas/store', [NotaController::class, 'store'])-> name('notas.store');
    Route::get('/notas/show', [NotaController::class, 'show'])-> name('notas.show');
    Route::get('/notas/edit', [NotaController::class, 'edit'])-> name('notas.edit');
    Route::put('/notas/update', [NotaController::class, 'update'])-> name('notas.update');
    Route::delete('/notas/destroy', [NotaController::class, 'destroy'])-> name('notas.destroy');

});

require __DIR__.'/auth.php';

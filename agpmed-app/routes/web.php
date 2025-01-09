<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransportadorController;
use App\Http\Controllers\CotacaoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\NotaRomaneioController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\RomaneioController;
use App\Http\Controllers\StatusController;
use App\Models\NotaRomaneio;
use App\Models\Status;
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
    Route::post('/cotacoes/store', [CotacaoController::class, 'store'])-> name('cotacoes.store');
    Route::get('/cotacoes/show/{cotacao}', [CotacaoController::class, 'show'])-> name('cotacoes.show');
    Route::get('/cotacoes/winner/{cotacao}', [CotacaoController::class, 'winner'])-> name('cotacoes.winner');
    Route::any('/cotacoes/destroy/{cotacao}', [CotacaoController::class, 'destroy'])-> name('cotacoes.destroy');

    //Pedidos

    Route::get('/pedidos', [PedidoController::class, 'list'])-> name('pedidos.list');
    Route::any('/pedidos/create', [PedidoController::class, 'create'])-> name('pedidos.create');
    Route::post('/pedidos/store', [PedidoController::class, 'store'])-> name('pedidos.store');
    Route::get('/pedidos/show/{pedido}', [PedidoController::class, 'show'])-> name('pedidos.show');
    Route::get('/pedidos/showcomprovante/{pedido}', [PedidoController::class, 'showComprovante'])-> name('pedidos.showComprovante');
    Route::any('/pedidos/edit/{pedido}', [PedidoController::class, 'edit'])-> name('pedidos.edit');
    Route::any('/pedidos/editnota/{pedido}', [PedidoController::class, 'editnota'])-> name('pedidos.editnota');
    Route::put('/pedidos/update', [PedidoController::class, 'update'])-> name('pedidos.update');
    Route::any('/pedidos/updatenota/{pedido}', [PedidoController::class, 'updateNota'])-> name('pedidos.updatenota');
    Route::any('/pedidos/destroy/{pedido}', [PedidoController::class, 'destroy'])-> name('pedidos.destroy');

    //Notas

    Route::get('/notas', [NotaController::class, 'list'])-> name('notas.list');
    Route::any('/notas/create', [NotaController::class, 'create'])-> name('notas.create');
    Route::any('/notasromaneio/create', [NotaController::class, 'createromaneio'])-> name('notas.createromaneio');
    Route::post('/notas/store', [NotaController::class, 'store'])-> name('notas.store');
    Route::post('/notas/storeromaneio', [NotaController::class, 'storeromaneio'])-> name('notas.storeromaneio');
    Route::get('/notas/show/{nota}', [NotaController::class, 'show'])-> name('notas.show');
    Route::get('/notas/edit', [NotaController::class, 'edit'])-> name('notas.edit');
    Route::put('/notas/update', [NotaController::class, 'update'])-> name('notas.update');
    Route::delete('/notas/destroy', [NotaController::class, 'destroy'])-> name('notas.destroy');

    //Status

    Route::get('/status', [StatusController::class, 'list'])-> name('status.list');
    Route::any('/status/create', [StatusController::class, 'create'])-> name('status.create');
    Route::post('/status/store', [StatusController::class, 'store'])-> name('status.store');
    Route::get('/status/show/{status}', [StatusController::class, 'show'])-> name('status.show');
    Route::get('/status/edit/{status}', [StatusController::class, 'edit'])-> name('status.edit');
    Route::put('/status/update/{status}', [StatusController::class, 'update'])-> name('status.update');
    Route::any('/status/destroy/{status}', [StatusController::class, 'destroy'])-> name('status.destroy');

    //Romaneios

    Route::get('/romaneios', [RomaneioController::class, 'list'])-> name('romaneios.list');
    Route::any('/romaneios/create', [RomaneioController::class, 'create'])-> name('romaneios.create');
    Route::post('/romaneios/store', [RomaneioController::class, 'store'])-> name('romaneios.store');
    Route::get('/romaneios/show/{romaneio}', [RomaneioController::class, 'show'])-> name('romaneios.show');
    Route::get('/romaneios/edit/{romaneio}', [RomaneioController::class, 'edit'])-> name('romaneios.edit');
    Route::put('/romaneios/update/{romaneio}', [RomaneioController::class, 'update'])-> name('romaneios.update');
    Route::any('/romaneios/destroy/{romaneio}', [RomaneioController::class, 'destroy'])-> name('romaneios.destroy');




    // //Notas Romaneios

    // Route::get('/notasromaneios', [NotaRomaneioController::class, 'list'])-> name('notaromaneio.list');
    // Route::any('/notasromaneios/create', [NotaRomaneioController::class, 'create'])-> name('notaromaneio.create');
    // Route::post('/notasromaneios/store', [NotaRomaneioController::class, 'store'])-> name('notaromaneio.store');
    // Route::get('/notasromaneios/show/{notaromaneio}', [NotaRomaneioController::class, 'show'])-> name('notaromaneio.show');
    // Route::get('/notasromaneios/edit/{notaromaneio}', [NotaRomaneioController::class, 'edit'])-> name('notaromaneio.edit');
    // Route::put('/notasromaneios/update/{notaromaneio}', [NotaRomaneioController::class, 'update'])-> name('notaromaneio.update');
    // Route::any('/notasromaneios/destroy/{notaromaneio}', [NotaRomaneioController::class, 'destroy'])-> name('notaromaneio.destroy');

});






require __DIR__.'/auth.php';

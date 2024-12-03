@extends('layouts/base')

@section('title')
    Lista de Romaneios
@endsection

@section('content')
    <div class="container mb-4">
        <div class="row">
            <div class="col-6">
                <h3>Romaneios</h3>
            </div>
            <div class="col-6 text-end">
                <a class="btn btn-success" href="{{ route('pedidos.create') }}">Novo Romaneio</a>
            </div>
        </div>
        <div class="accordion collapsed mt-3" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        Pesquisar
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form action="{{ route('romaneios.list') }}">

                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <label class="form-label" for="transportadora">Transportadora</label>
                                    <input class="form-control" type="text" name="transportadora" id="transportadora"
                                        value="">
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label class="form-label" for="usuario">Responsável</label>
                                    <input class="form-control" type="text" name="usuario" id="usuario"
                                        value="">
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <label class="form-label" for="dtini">Data Inicial</label>
                                    <input class="form-control" type="date" name="dtini" id="dtini"
                                        value="">
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <label class="form-label" for="dtfin">Data Final</label>
                                    <input class="form-control" type="date" name="dtfin" id="dtfin"
                                        value="">
                                </div>
                                <div class="col-md-4 col-sm-12 mt-2 pt-4">
                                    <button class="btn btn-info btn-sm" type="submit">Pesquisar</button>
                                    <a class="btn btn-warning btn-sm" href="{{ route('pedidos.list') }}">Limpar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <table class="table table-striped table-responsive table-hover table-sm">
            <thead>
                <tr>
                    <th scope="col">Data</th>
                    <th scope="col">Previsão</th>
                    <th scope="col">Pedido</th>
                    <th scope="col">Cliente</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ()
                    <tr>
                        <td class="col-1">
                            {{ \Carbon\Carbon::parse($pedido->datapedido)->tz('America/Sao_Paulo')->format('d/m/Y') }}
                        </td>
                        <td class="col-1">
                            @if ($pedido->dt_prev_entrega == null)
                                -
                            @else
                                {{ \Carbon\Carbon::parse($pedido->dt_prev_entrega)->tz('America/Sao_Paulo')->format('d/m/Y') }}
                            @endif
                        </td>
                        <td class="col-1">{{ $pedido->codigopedido }}</td>
                        <td class="col-9">{{ $pedido->nomecliente }}
                            @if ($pedido->bonificado == 0)
                                <img src="" width="20">
                            @else
                                <img src="{{ Vite::asset('resources/images/bonif.svg') }}" width="20">
                            @endif
                            @if ($pedido->nr_nota == null)
                                <img src="" width="20">
                            @else
                                <img src="{{ Vite::asset('resources/images/nfe.svg') }}" width="20">
                            @endif
                            @if ($pedido->comprovantes == null)
                                <img src="" width="20">
                            @else
                                <a href="{{ route('pedidos.showComprovante', ['pedido' => $pedido->id])}}" target="_blank"><img
                                        src="{{ Vite::asset('resources/images/file.svg') }}" width="20"></a>
                            @endif
                            @if ($pedido->status_id != null)
                                <span class="badge rounded-pill text-bg-secondary">{{$pedido->status->status}}</span>
                            @endif
                        </td>
                        <td><a href="{{ route('pedidos.show', ['pedido' => $pedido->id]) }}"><img
                                    src="{{ Vite::asset('resources/images/eye.svg') }}" width="20"></a></td>
                        <td><a href="{{ route('pedidos.edit', ['pedido' => $pedido->id]) }}"><img
                                    src="{{ Vite::asset('resources/images/edit.svg') }}" width="20"></a></td>
                        <td><a href="{{ route('pedidos.destroy', ['pedido' => $pedido->id]) }}"><img
                                    src="{{ Vite::asset('resources/images/trash.svg') }}" width="20"></a></td>
                        <td><a href="{{ route('cotacoes.create', ['pedido' => $pedido->id]) }}"><img
                                    src="{{ Vite::asset('resources/images/cash.svg') }}" width="20"></a></td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>
    <div class="container">
        <div class="row">

        </div>
    </div>
@endsection

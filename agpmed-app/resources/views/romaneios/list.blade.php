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
                <a class="btn btn-success" href="{{ route('romaneios.create') }}">Novo Romaneio</a>
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
                                    <input class="form-control" type="text" name="usuario" id="usuario" value="">
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <label class="form-label" for="dtini">Data Inicial</label>
                                    <input class="form-control" type="date" name="dtini" id="dtini" value="">
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <label class="form-label" for="dtfin">Data Final</label>
                                    <input class="form-control" type="date" name="dtfin" id="dtfin" value="">
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
                    <th scope="col">ID</th>
                    <th scope="col">Transportadora</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @isset($romaneios)
                    @foreach ($romaneios as $romaneio)
                        <tr>
                            <td class="col-1">
                                {{ \Carbon\Carbon::parse($romaneio->data)->tz('America/Sao_Paulo')->format('d/m/Y') }}
                            </td>
                            <td class="col-1">{{ $romaneio->id }}</td>
                            <td class="col-3">{{ $romaneio->transportador->nome }}</td>
                            <td class="col-9">{{ $romaneio->status->status }}</td>
                            <td><a href="{{ route('romaneios.show', ['romaneio' => $romaneio->id]) }}"><img
                                        src="{{ Vite::asset('resources/images/eye.svg') }}" width="20"></a></td>
                            <td><a href="{{ route('romaneios.edit', ['romaneio' => $romaneio->id]) }}"><img
                                        src="{{ Vite::asset('resources/images/edit.svg') }}" width="20"></a></td>
                            <td><a href="{{ route('romaneios.destroy', ['romaneio' => $romaneio->id]) }}"><img
                                        src="{{ Vite::asset('resources/images/trash.svg') }}" width="20"></a></td>
                            <td><a href="{{ route('romaneios.create', ['romaneio' => $romaneio->id]) }}"><img
                                        src="{{ Vite::asset('resources/images/cash.svg') }}" width="20"></a></td>
                        </tr>
                    @endforeach
                @endisset
            </tbody>
        </table>
    </div>
    <div class="container">
        <div class="row">

        </div>
    </div>
@endsection

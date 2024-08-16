@extends('layouts/base')

@section('title')
    Lista de Transportadoras
@endsection

@section('content')
    <div class="container mb-4">
        <div class="row">
            <div class="col-6">
                <h3>Cadastro de Transportadoras</h3>
            </div>
            <div class="col-6 text-end">
                <a class="btn btn-success" href="{{ route('transportador.create') }}">Nova Transportadora</a>
            </div>
        </div>
    </div>
    <hr>
    <div class="accordion accordion-flush mb-3" id="pedidoList">
        @foreach ($transportadores as $transportadora)
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapse{{ $transportadora->id }}" aria-expanded="false"
                        aria-controls="flush-collapse{{ $transportadora->id }}">
                        <div class="container">
                            <div class="row">
                                <div class="row">
                                    <div class="col-6">
                                        <b>{{ $transportadora->id }}</b> - <b>{{ $transportadora->nome }}</b>

                                    </div>
                                    <div class="col-2">

                                    </div>
                                    <div class="col-4 text-end">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </button>
                </h2>
                <div id="flush-collapse{{ $transportadora->id }}" class="accordion-collapse collapse" data-bs-parent="pedidoList">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-4 mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        Contato
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title text-center">-</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        Representante
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title text-center">

                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        Data do Pedido
                                    </div>
                                    <div class="card-body text-center">
                                        <h5 class="card-title">-</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <div class="col-4 mb-3">
                                    <div class="card">
                                        <div class="card-header">
                                            Peso do Pedido
                                        </div>
                                        <div class="card-body text-center">
                                            <h5 class="card-title">-</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

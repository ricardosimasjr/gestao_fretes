@extends('layouts/base')

@section('title')
    Lista de Pedidos
@endsection

@section('content')
    <div class="container mb-4">
        <div class="row">
            <div class="col-6">
                <h3>Pedido de Venda</h3>
            </div>
            <div class="col-6 text-end">
                <a class="btn btn-success" href="{{ route('pedidos.create') }}">Novo Pedido</a>
            </div>
        </div>
    </div>
    <hr>
    <div class="accordion accordion-flush mb-3" id="pedidoList">
        @foreach ($pedidos as $pedido)
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapse{{ $pedido->id }}" aria-expanded="false"
                        aria-controls="flush-collapse{{ $pedido->id }}">
                        <div class="container">
                            <div class="row">
                                <div class="row">
                                    <div class="col-6">
                                        <b>{{ $pedido->codigopedido }}</b> - </b>{{ $pedido->nomecliente }}
                                    </div>
                                    <div class="col-2">
                                        {{ $pedido->ufcliente }}
                                    </div>
                                    <div class="col-4 text-end">
                                        <span class="badge text-bg-primary rounded-pill">{{ $pedido->id }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </button>
                </h2>
                <div id="flush-collapse{{ $pedido->id }}" class="accordion-collapse collapse" data-bs-parent="pedidoList">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-4 mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        Vendedor
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title text-center">{{ $pedido->vendedorpedido }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        Representante
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title text-center">@if ($pedido->representantepedido == null)
                                            -
                                        @else
                                            {{$pedido->representantepedido}}
                                        @endif</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        Data do Pedido
                                    </div>
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ $pedido->datapedido }}</h5>
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
                                            <h5 class="card-title">{{ $pedido->peso }}Kg</h5>
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
    <div class="container">
        <div class="row">
            Rodapé
        </div>
    </div>
@endsection

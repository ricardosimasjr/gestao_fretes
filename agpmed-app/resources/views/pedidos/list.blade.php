@extends('layouts/base')

@section('title')
    Lista de Pedidos
@endsection

@section('content')
    
    <div class="accordion accordion-flush" id="pedidoList">
        @foreach ($pedidos as $pedido)
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapse{{$pedido->id}}" aria-expanded="false" aria-controls="flush-collapse{{$pedido->id}}">
                        <b>{{ $pedido->codigopedido}}z</b> - {{ $pedido->nomecliente}} - {{ $pedido->ufcliente}}
                    </button>
                </h2>
                <div id="flush-collapse{{$pedido->id}}" class="accordion-collapse collapse" data-bs-parent="pedidoList">
                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the
                        <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                </div>
            </div> 
        @endforeach
    </div>
@endsection

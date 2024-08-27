@extends('layouts/base')

@section('title')
    Detalhe Pedido
@endsection

@section('content')
    <div class="row mb-3">
        <div class="col-6">
            <h3>Detalhe do Pedido</h3>
        </div>
        <div class="col-6 text-end">
            <a class="btn btn-success" href="{{ route('pedidos.list') }}">Voltar</a>

        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-2 mb-3">
            <label for="codigopedido" class="form-label">Pedido</label>
            <input type="text" class="form-control" id="codigopedido" name="codigopedido"
                value="{{ $pedidos->codigopedido }}">
        </div>
        <div class="col-3 mb-3">
            <label for="cpfcnpj" class="form-label">Cpf/Cnpj</label>
            <input type="text" class="form-control" id="cpfcnpj" name="cpfcnpj" value="{{ $pedidos->cpfcnpj }}">
        </div>
        <div class="col-6 mb-3">
            <label for="nomecliente" class="form-label">Cliente</label>
            <input type="text" class="form-control" id="nomecliente" name="nomecliente"
                value="{{ $pedidos->nomecliente }}">
        </div>
        <div class="col-1 mb-3">
            <label for="ufcliente" class="form-label">UF</label>
            <input type="text" class="form-control" id="ufcliente" name="ufcliente" value="{{ $pedidos->ufcliente }}">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-2 mb-3">
            <label for="datapedido" class="form-label">Data Pedido</label>
            <input type="date" class="form-control" id="datapedido" name="datapedido" value="{{ $pedidos->datapedido }}">
        </div>
        <div class="col-4 mb-6">
            <label for="vendedorpedido" class="form-label">Vendedor</label>
            <input type="text" class="form-control" id="vendedorpedido" name="vendedorpedido"
                value="{{ $pedidos->vendedorpedido }}">
        </div>
        <div class="col-4 mb-6">
            <label for="representantepedido" class="form-label">Representante</label>
            <input type="text" class="form-control" id="representantepedido" name="representantepedido"
                value="@if (isset($pedidos->representantepedido)) {{ $pedidos->representantepedido }} @endif">
        </div>
        <div class="col-2 mb-6">
            <label for="volumes" class="form-label">Volumes</label>
            <div class="input-group">
                <input type="number" class="form-control" id="volumes" name="volumes" value="{{ $pedidos->volumes }}">
                <div class="input-group-text">Cx(s)</div>
            </div>

        </div>
        <div class="col-2">
            <label class="form-label" for="valor">Valor</label>
            <div class="input-group">
                <div class="input-group-text">R$</div>
                <input type="text" class="form-control" id="valor" name="valor"
                    value="@if (isset($pedido->valor)) {{ number_format($pedidos->valor, 2, ',', '.') }} @endif">

            </div>
        </div>
        <div class="col-2">
            <label class="form-label" for="peso">Peso</label>
            <div class="input-group">
                <input type="text" class="form-control" id="peso" name="peso" value="{{ $pedidos->peso }}">
                <div class="input-group-text">Kg</div>
            </div>
        </div>
    </div>
    <hr>
    <span>
        <h4><b>Cotações</b></h4>
    </span>
    <hr>
    <div class="row">
        <table class="table table-striped table-responsive table-hover table-sm">
            <thead>
                <tr>
                    <th scope="col">Data</th>

                    <th scope="col">Transportadora</th>
                    <th scope="col">Valor</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos->cotacao as $cotacao)
                    <tr>
                        <td class="col-1">
                            {{ \Carbon\Carbon::parse($cotacao->dataCotacao)->tz('America/Sao_Paulo')->format('d/m/Y') }}
                        </td>

                        <td class="col-9">{{ $cotacao->transportador->nome }}</td>
                        <td class="col-2">{{ "R$" . number_format($cotacao->valor, 2, ',', '.') }}</td>
                        <td><a href="{{ route('pedidos.show', ['pedido' => $pedidos->id]) }}"><img
                                    src="{{ Vite::asset('resources/images/eye.svg') }}" width="20"></a></td>
                        <td><a href="{{ route('cotacoes.destroy', ['cotacao' => $cotacao->id]) }}"><img
                                    src="{{ Vite::asset('resources/images/trash.svg') }}" width="20"></a></td>

                        @if ($cotacao->winner == 1)
                            <td><a href="{{ route('cotacoes.winner', ['cotacao' => $cotacao->id]) }}"><img
                                        style="fill: green" src="{{ Vite::asset('resources/images/winner_green.svg') }}"
                                        width="20"></a></td>
                        @else
                            <td><a href="{{ route('cotacoes.winner', ['cotacao' => $cotacao->id]) }}"><img
                                        style="fill: green" src="{{ Vite::asset('resources/images/looser.svg') }}"
                                        width="20"></a></td>
                        @endif

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

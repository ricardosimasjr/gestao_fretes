@extends('layouts/base')

@section('title')
    Nova Cotação
@endsection

@section('content')
    <form class="row row-cols-lg-auto g-3 align-items-center mb-4" action="" method="POST">
        @csrf
        <div class="col-md-6">
            <input type="text" class="form-control" id="pedido" name="pedido" placeholder="Pedido de Venda">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-success" id="search" name="search">Buscar</button>
        </div>
    </form>


    <form action="" method="post">
        @csrf
        <div class="row">
            <div class="col-2 mb-3">
                <label for="pedido" class="form-label">Pedido</label>
                <input type="text" class="form-control" id="pedido" name="pedido" value="@if (isset($codigoPedido)){{$codigoPedido}}@endif">
            </div>
            <div class="col-2 mb-3">
                <label for="cpf_cnpj" class="form-label">Cpf/Cnpj</label>
                <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" value="">
            </div>
            <div class="col-6 mb-3">
                <label for="cliente" class="form-label">Cliente</label>
                <input type="text" class="form-control" id="cliente" name="cliente" value="">
            </div>
            <div class="col-2 mb-3">
                <label for="dataPedido" class="form-label">Data Pedido</label>
                <input type="text" class="form-control" id="dataPedido" name="dataPedido" value="{{ \Carbon\Carbon::parse($dataEmissao)->format('d-m-Y')}}">
            </div>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>
@endsection

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
                <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" value="@if (isset($cpf_cnpj)){{$cpf_cnpj}}@endif">
            </div>
            <div class="col-7 mb-3">
                <label for="cliente" class="form-label">Cliente</label>
                <input type="text" class="form-control" id="cliente" name="cliente" value="@if (isset($nomePessoa)){{$nomePessoa}}@endif">
            </div>
            <div class="col-1 mb-3">
                <label for="uf" class="form-label">UF</label>
                <input type="text" class="form-control" id="uf" name="uf" value="@if (isset($ufPessoa)){{$ufPessoa}}@endif">
            </div>
        </div>
        <div class="row">
            <div class="col-2 mb-3">
                <label for="dataPedido" class="form-label">Data Pedido</label>
                <input type="date" class="form-control" id="dataPedido" name="dataPedido" value="@if (isset($dataPedido)){{$dataPedido}}@endif">
            </div>
            <div class="col-4 mb-6">
                <label for="vendedor" class="form-label">Vendedor</label>
                <input type="text" class="form-control" id="vendedor" name="vendedor" value="@if (isset($vendedor)){{$vendedor}}@endif">
            </div>
            <div class="col-4 mb-6">
                <label for="representante" class="form-label">Representante</label>
                <input type="text" class="form-control" id="representante" name="representante" value="@if (isset($representante)){{$representante}}@endif">
            </div>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>
@endsection

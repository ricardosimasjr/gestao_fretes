@extends('layouts/base')

@section('title')
    Novo pedido
@endsection

@section('content')
    <div class="row mb-3">
        <div class="col-6">
            <h3>Novo Pedido</h3>
        </div>
        <div class="col-6 text-end">
            <a class="btn btn-success" href="{{ route('pedidos.list') }}">Voltar</a>
        </div>
    </div>
    <hr>
    <form class="row row-cols-lg-auto g-3 align-items-center mb-4" action="" method="POST">
        @csrf
        <div class="col-md-6">
            <input type="text" class="form-control" id="pedido" name="pedido" placeholder="Pedido de Venda">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-success" id="search" name="search">Buscar</button>
        </div>
    </form>


    <form action="{{ route('pedidos.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-2 mb-3">
                <label for="codigopedido" class="form-label">Pedido</label>
                <input type="text" class="form-control" id="codigopedido" name="codigopedido"
                    value="@if (isset($codigoPedido)) {{ $codigoPedido }} @endif">
            </div>
            <div class="col-2 mb-3">
                <label for="pedido_compra" class="form-label">Pedido de Compra</label>
                <input type="text" class="form-control" id="pedido_compra" name="pedido_compra"
                    value="@if (isset($pedido_compra)) {{ $pedido_compra }} @endif">
            </div>
            <div class="col-2 mb-3">
                <label for="cpfcnpj" class="form-label">Cpf/Cnpj</label>
                <input type="text" class="form-control" id="cpfcnpj" name="cpfcnpj"
                    value="@if (isset($cpf_cnpj)) {{ $cpf_cnpj }} @endif">
            </div>
            <div class="col-5 mb-3">
                <label for="nomecliente" class="form-label">Cliente</label>
                <input type="text" class="form-control" id="nomecliente" name="nomecliente"
                    value="@if (isset($nomePessoa)) {{ $nomePessoa }} @endif">
            </div>
            <div class="col-1 mb-3">
                <label for="ufcliente" class="form-label">UF</label>
                <input type="text" class="form-control" id="ufcliente" name="ufcliente"
                    value="@if (isset($ufPessoa)) {{ $ufPessoa }} @endif">
            </div>
        </div>
        <div class="row">
            <div class="col-2 mb-3">
                <label for="datapedido" class="form-label">Data Pedido</label>
                <input type="date" class="form-control" id="datapedido" name="datapedido"
                    value="@if(isset($dataPedido)){{$dataPedido}}@endif">
            </div>
            <div class="col-4 mb-6">
                <label for="vendedorpedido" class="form-label">Vendedor</label>
                <input type="text" class="form-control" id="vendedorpedido" name="vendedorpedido"
                    value="@if (isset($vendedor)) {{ $vendedor }} @endif">
            </div>
            <div class="col-4 mb-6">
                <label for="representantepedido" class="form-label">Representante</label>
                <input type="text" class="form-control" id="representantepedido" name="representantepedido"
                    value="@if (isset($representante)) {{ $representante }} @endif">
            </div>
            <div class="col-2 mb-6">
                <label for="volumes" class="form-label">Volumes</label>
                <input type="number" class="form-control" id="volumes" name="volumes" value="">
            </div>
            <div class="col-2">
                <label class="form-label" for="peso">Peso</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="peso" name="peso">
                    <div class="input-group-text">Kg</div>
                </div>
            </div>
            <div class="col-2">
                <label class="form-label" for="valor">Valor</label>
                <div class="input-group">
                    <div class="input-group-text">R$</div>
                    <input type="text" class="form-control" id="valor" name="valor"
                        value="@if (isset($valorTotalPedido)) {{ number_format($valorTotalPedido, 2, ',', '.') }} @endif">

                </div>
            </div>
            <div class="col-auto">
                <label class="form-label" for="status">Tipo do Frete</label>
                <select class="form-select mb-3" id="tipo_frete" name="tipo_frete" style="background-color: antiquewhite" required>
                    <option selected value="">Selecione</option>
                    <option  value="CIF">CIF</option>
                    <option  value="FOB">FOB</option>
                </select>
            </div>
            <div class="col-auto">
                <label class="form-label" for="bonificado">Bonificação</label>
                <select class="form-select mb-3" id="bonificado" name="bonificado" style="background-color: antiquewhite" required>
                    <option selected value="">Selecione</option>
                    <option  value="1">SIM</option>
                    <option  value="0">NÃO</option>
                </select>
            </div>

        </div>
        <div class="row">
            <div class="mb-3 mt-3">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>

    <script type="text/javascript">
        function id(el) {
            return document.getElementById(el);
        }
        window.onload = function() {
            id('peso').onkeyup = function() {
                var v = this.value,
                    integer = v.split(',')[0];


                v = v.replace(/\D/, "");
                v = v.replace(/^[0]+/, "");

                if (v.length <= 3 || !integer) {
                    if (v.length === 1) v = '0,00' + v;
                    if (v.length === 2) v = '0,0' + v;
                    if (v.length === 3) v = '0,' + v;
                } else {
                    v = v.replace(/^(\d{1,})(\d{3})$/, "$1,$2");
                }

                this.value = v;
            }
        };
    </script>
@endsection

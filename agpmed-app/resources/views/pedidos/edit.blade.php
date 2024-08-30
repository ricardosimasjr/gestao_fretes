@extends('layouts/base')

@section('title')
    Edição de pedido
@endsection

@section('content')
    <div class="row mb-3">
        <div class="col-6">
            <h3>Edita Pedido</h3>
        </div>
        <div class="col-6 text-end">
            <a class="btn btn-success" href="{{ route('pedidos.list') }}">Voltar</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-auto">
            <form class="form-group" action="{{ route('pedidos.updatenota', ['pedido' => $pedido]) }}" method="POST">
                @csrf
                <input type="text" name="codigopedido" id="codigopedido" value="{{ $pedido->codigopedido }}" hidden>
                <input type="text" name="id" id="id" value="{{ $pedido->id }}" hidden>
                <button class="btn btn-outline-secondary mb-2" type="submit">Importa NF-e</button>
            </form>
        </div>
    </div>
    <hr>
    <form action="{{ route('pedidos.update', ['pedido' => $pedido->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-2 mb-3">
                <label for="codigopedido" class="form-label">Pedido</label>
                <input type="text" class="form-control" id="codigopedido" name="codigopedido"
                    value="{{ old('pedido', $pedido->codigopedido) }}">
            </div>
            <div class="col-2 mb-3">
                <label for="nota" class="form-label">NF-e</label>
                <input type="text" class="form-control" id="nota" name="nota"
                    value="{{ old('nr_nota', $pedido->nr_nota) }}">
            </div>
            <div class="col-2 mb-3">
                <label for="cpfcnpj" class="form-label">CPF/CNPJ</label>
                <input type="text" class="form-control" id="cpfcnpj" name="cpfcnpj"
                    value="{{ old('cpfcnpj', $pedido->cpfcnpj) }}">
            </div>
            <div class="col-6 mb-3">
                <label for="nomecliente" class="form-label">Cliente</label>
                <input type="text" class="form-control" id="nomecliente" name="nomecliente"
                    value="{{ old('cliente', $pedido->nomecliente) }}">
            </div>

        </div>
        <div class="row">
            <div class="col-1 mb-3">
                <label for="ufcliente" class="form-label">UF</label>
                <input type="text" class="form-control" id="ufcliente" name="ufcliente"
                    value="{{ old('ufcliente', $pedido->ufcliente) }}">
            </div>
            <div class="col-2 mb-3">
                <label for="datapedido" class="form-label">Data Pedido</label>
                <input type="date" class="form-control" id="datapedido" name="datapedido"
                    value="{{ old('datapedido', $pedido->datapedido) }}">
            </div>
            <div class="col-4 mb-6">
                <label for="vendedorpedido" class="form-label">Vendedor</label>
                <input type="text" class="form-control" id="vendedorpedido" name="vendedorpedido"
                    value="{{ old('vendedorpedido', $pedido->vendedorpedido) }}">
            </div>
            <div class="col-4 mb-6">
                <label for="representantepedido" class="form-label">Representante</label>
                <input type="text" class="form-control" id="representantepedido" name="representantepedido"
                    value="{{ old('representantepedido', $pedido->representantepedido) }}">
            </div>
            <div class="col-1 mb-6">
                <label for="volumes" class="form-label">Volumes</label>
                <input type="number" class="form-control" id="volumes" name="volumes"
                    value="{{ old('volumes', $pedido->volumes) }}">
            </div>
            <div class="col-2">
                <label class="form-label" for="peso">Peso</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="peso" name="peso"
                        value="{{ old('peso', $pedido->peso) }}">
                    <div class="input-group-text">Kg</div>
                </div>
            </div>
            <div class="col-2">
                <label class="form-label" for="valor">Valor</label>
                <div class="input-group">
                    <div class="input-group-text">R$</div>
                    <input type="text" class="form-control" id="valor" name="valor"
                        value="{{ old('valor', number_format($pedido->valor, 2, ',', '.')) }}">
                </div>
            </div>
            <div class="col-auto">
                <label class="form-label" for="status">Status do Pedido</label>
                <select class="form-select mb-3" id="status" name="status" style="background-color: antiquewhite">
                    <option selected value="{{ $pedido->status->id }}">{{ $pedido->status->status }}</option>
                    @foreach ($statusCollection as $status)
                        <option value="{{ old('id', $status->id) }}">{{ old('status', $status->status) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <label class="form-label" for="tipo_frete">Tipo Frete</label>
                <select class="form-select mb-3" id="tipo_frete" name="tipo_frete"
                    style="background-color: antiquewhite">
                    <option selected value="{{ $pedido->tipo_frete }}">{{ $pedido->tipo_frete }}</option>
                    <option value="CIF">CIF</option>
                    <option value="FOB">FOB</option>

                </select>
            </div>
            <div class="col-auto">
                <label class="form-label" for="bonificado">Bonificação</label>
                <select class="form-select mb-3" id="bonificado" name="bonificado"
                    style="background-color: antiquewhite" required>
                    @if ($pedido->bonificado == 1)
                        <option selected value="{{ old('bonificado', $pedido->bonificado) }}">SIM</option>
                    @else
                        <option selected value="{{ old('bonificado', $pedido->bonificado) }}">NÃO</option>
                    @endif
                    <option value="1">SIM</option>
                    <option value="0">NÃO</option>
                </select>
            </div>
            <div class="col-auto">
                <div class="mb-3">
                    <label class="form-label" for="comprovantes">comprovantes de Entrega</label>
                    <input class="form-control" type="file" id="comprovantes" name="comprovantes"
                        placeholder="Upload de Arquivos">
                </div>
            </div>
            <div class="col-2 mb-3">
                <input type="text" class="form-control" id="id" name="id"
                    value="{{ old('id', $pedido->id) }}" hidden>
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

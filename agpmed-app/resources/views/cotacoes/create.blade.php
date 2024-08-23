@extends('layouts/base')

@section('title')
    Nova Cotação
@endsection

@section('content')
    <div class="row mb-3">
        <div class="col-6">
            <h3>Nova Cotação</h3>
        </div>
        <div class="col-6 text-end">
            <a class="btn btn-success" href="{{ route('pedidos.list') }}">Voltar</a>
        </div>
    </div>
    <hr>
    <div class="container">
        <form action="{{ route('cotacoes.store')}}" method="post">
            @csrf
            <div class="row">
                <select class="form-select mb-3" aria-label="Default select example" id="idTransportadora" name="idTransportadora">
                    <option selected value="">Selecione a tranportadora</option>
                    @foreach ($transportadoras as $transportadora)
                        <option value="{{ $transportadora->id }}">{{ $transportadora->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-2 mb-3">
                    <label for="dataCotacao" class="form-label">Data Cotação</label>
                    <input type="date" class="form-control" id="dataCotacao" name="dataCotacao"
                        value="{{ date('Y-m-d') }}">
                </div>
                <div class="col-2 mb-3">
                    <input type="text" class="form-control" id="pedido_id" name="pedido_id" value="{{ $_GET['pedido'] }}"
                        hidden>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-2">
                    <label class="form-label" for="valor">Valor</label>
                    <div class="input-group">
                        <div class="input-group-text">R$</div>
                        <input type="text" class="form-control" id="valor" name="valor" id="valor" value="" />
                    </div>
                </div>
            </div>
            <script></script>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script>
        $(function() { //ready
            $("#valor").maskMoney({
                thousands: ".",
                decimal: ","
            });
        });
    </script>
@endsection

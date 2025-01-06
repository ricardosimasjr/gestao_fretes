@extends('layouts/base')

@section('title')
    Novo pedido
@endsection

@section('content')
    <div class="row mb-3">
        <div class="col-6">
            <h3>Novo Romaneio</h3>
        </div>
        <div class="col-6 text-end">
            <a class="btn btn-success" href="{{ route('romaneios.list') }}">Voltar</a>
        </div>
    </div>
    <hr>

    <form action="{{ route('romaneios.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-6 mb-3">
                <label for="transportadora" class="form-label">Transportadora</label>
                <input type="text" class="form-control" id="transportadora" name="transportadora">
            </div>
            <div class="col-2 mb-3">
                <label for="dataromaneio" class="form-label">Data Romaneio</label>
                <input type="date" class="form-control" id="dataromaneio" name="dataromaneio"
                    value="{{ $today }}">
            </div>
        </div>
        <div class="row">
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
        </div>
        <div class="row">
            <div class="mb-3 mt-3">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            <div>
                <select class="select2" name="state">
                    <option value="AL">Alabama</option>
                    ...
                    <option value="WY">Wyoming</option>
                </select>
            </div>
        </div>
    </form>
    <script>
        $(function () {
            $('.select2').select2({
                theme: 'bootstrap-5'
            });
        });
    </script>
@endsection

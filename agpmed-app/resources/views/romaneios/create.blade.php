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
                <label for="transportadores" class="form-label">Transportadores</label>
                <select class="form-select select2" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    @foreach ($transportadoras as $transportador)
                    <option value="{{$transportador->id}}">{{$transportador->nome}}</option>
                    @endforeach
                  </select>
            </div>
            <div class="col-2 mb-3">
                <label for="dataromaneio" class="form-label">Data Romaneio</label>
                <input type="date" class="form-control" id="dataromaneio" name="dataromaneio"
                    value="{{ $today }}">
            </div>
        </div>
        <div class="row">
            <div class="mb-3 mt-3">
                <button type="submit" class="btn btn-primary">Salvar</button>
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

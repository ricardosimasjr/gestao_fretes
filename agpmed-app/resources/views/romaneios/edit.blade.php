@extends('layouts/base')

@section('title')
    Novo pedido
@endsection

@section('content')
    <div class="row mb-3">
        <div class="col-6">
            <h3>Edição do Romaneio</h3>
        </div>
        <div class="col-6 text-end">
            <a class="btn btn-success" href="{{ route('romaneios.list') }}">Voltar</a>
        </div>
    </div>
    <hr>

    <form action="{{ route('romaneios.update', ['romaneio' => $romaneio->id]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-8 mb-3">
                <label for="transportador_id" class="form-label">Transportadores</label>
                <select class="form-select select2" aria-label="Default select example" id="transportador_id"
                    name="transportador_id" required>
                    <option value="{{$transportadora->id}}" selected>{{$transportadora->nome}}</option>
                    @foreach ($transportadoras as $transportador)
                        <option value="{{ $transportador->id }}">{{ $transportador->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2 mb-3">
                <label for="data" class="form-label">Data Romaneio</label>
                <input type="date" class="form-control" id="data" name="data" value="{{ old('data', $romaneio->data) }}">
            </div>
            <div class="col-2 mb-3">
                <label for="datahoracoleta" class="form-label">Data/Hora Coleta</label>
                <input type="datetime" class="form-control" id="datahoracoleta" name="datahoracoleta">
            </div>

            <div>
                <input type="text" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->id }}"
                    hidden>
                <input type="text" class="form-control" id="status_id" name="status_id" value="1"
                    hidden>
            </div>
        </div>
        <div class="row">
            <div class="col-6 mb-3">
                <label for="motorista" class="form-label">Motorista/Ajudante</label>
                <input type="text" class="form-control" id="motorista" name="motorista" value="{{old('motorista', $romaneio->motorista)}}">
            </div>
            <div class="col-3 mb-3">
                <label for="tipo_ident" class="form-label">Tipo Documento</label>
                <select class="form-select select2" id="tipo_ident" name="tipo_ident">
                    <option value="{{old('tipo_ident', $romaneio->tipo_ident)}}" selected>{{old('tipo_ident', $romaneio->tipo_ident)}}</option>
                    <option value="CPF">CPF - Cadastro de Pessoa Física</option>
                    <option value="CNH">CNH - Carteira Nacional de Habilitação</option>
                    <option value="ID">ID - Carteira de Identidade</option>
                    <option value="CTPS">CTPS - Carteira de Trabalho</option>
                </select>
            </div>
            <div class="col-3 mb-3">
                <label for="identificacao" class="form-label">Nº Documento</label>
                <input type="text" class="form-control" id="identificacao" name="identificacao" value="{{old('identificacao', $romaneio->identificacao)}}">
            </div>
            <div class="col-12 mb-3">
                <label for="obs" class="form-label">Observações</label>
                <textarea type="text" class="form-control" id="obs" name="obs" rows="3">{{old('obs', $romaneio->obs)}}</textarea>
            </div>
            <div class="mb-3 mt-3">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>
    <script>
        $(function() {
            $('.select2').select2({
                theme: 'bootstrap-5'
            });
        });
    </script>
@endsection

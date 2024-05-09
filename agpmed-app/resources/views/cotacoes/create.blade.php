@extends('layouts/base')

@section('title')
    Nova Cotação
@endsection

@section('content')
    <form action="" method="post">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome Transportadora</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome da Transportadora">
        </div>
        <div class="mb-3">
          <label for="user" class="form-label">Nome Usuário</label>
          <input type="text" class="form-control" id="user" name="user" value="{{ Auth::user()->name}}" >
      </div>
          <select class="mb-3 form-select" aria-label="Default select example">
            <option selected>Selecione</option>
            @foreach ($transportadores as $transportador)
            <option value="{{ $transportador->id }}">{{ $transportador->nome}}</option>
            @endforeach
          </select>
          <div class="mb-3">
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
    </form>
@endsection

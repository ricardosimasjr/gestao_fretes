@extends('layouts/base')

@section('title')
    Nova Transportadora
@endsection

@section('content')
    <form action="{{ route('transportador.store')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome Transportadora</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome da Transportadora">
          </div>
          <div class="mb-3">
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
    </form>
@endsection

@extends('layouts/base')

@section('title')
    Lista de Cotações
@endsection

@section('content')
<div class="card">
    <h5 class="card-header">Featured</h5>
    <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="{{ route('transportador.create') }}" class="btn btn-primary">Nova Transportadora</a>
    </div>
    @foreach ($cotacoes as $cotacao)
        <div class="card">
            <h3 class="card-header">#{{ $cotacao->id }} - {{ $cotacao->transportador->nome}}</h3>
            <div class="card-body">
                <h5 class="card-text">{{ $cotacao->user->name }}</h5>
            </div>
        </div>
    @endforeach
</div>
@endsection
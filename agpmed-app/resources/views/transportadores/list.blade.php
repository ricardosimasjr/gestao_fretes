@extends('layouts/base')

@section('title')
    Lista de Transportadoras
@endsection

@section('content')
<div class="card">
    <h5 class="card-header">Featured</h5>
    <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="{{ route('transportador.create') }}" class="btn btn-primary">Nova Transportadora</a>
    </div>
</div>
@endsection

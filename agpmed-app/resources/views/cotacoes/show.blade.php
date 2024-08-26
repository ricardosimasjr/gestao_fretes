@extends('layouts/base')

@section('title')
    Lista de Cotações
@endsection

@section('content')
<div class="card">
    <span>{{ $cotacoes}}</span>
</div>
@endsection

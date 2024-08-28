@extends('layouts/base')

@section('title')
    Novo Status
@endsection

@section('content')
    <div class="row mb-3">
        <div class="col-6">
            <h3>Novo Status</h3>
        </div>
        <div class="col-6 text-end">
            <a class="btn btn-success" href="{{ route('status.list') }}">Voltar</a>
        </div>
    </div>
    <hr>
    @if (session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Erro!</strong> Status Já cadastrado.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form action="{{ route('status.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-2 mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="">
            </div>
        </div>
        <div class="row">
            <div class="mb-3 mt-3">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>
@endsection

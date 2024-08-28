@extends('layouts/base')

@section('title')
    Status Edição
@endsection

@section('content')
    <div class="row mb-3">
        <div class="col-6">
            <h3>Edição de Status</h3>
        </div>
        <div class="col-6 text-end">
            <a class="btn btn-success" href="{{ route('status.list') }}">Voltar</a>
        </div>
    </div>
    <hr>

    <form action="{{route('status.update', ['status' => $status->id])}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-4 mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status"
                    value="{{old('status', $status->status)}}">
            </div>
        </div>
        <div class="row">
            <div class="mb-3 mt-3">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>
@endsection

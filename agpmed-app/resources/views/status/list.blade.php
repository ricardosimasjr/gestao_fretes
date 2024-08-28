@extends('layouts/base')

@section('title')
    Lista de Pedidos
@endsection

@section('content')
    <div class="container mb-4">
        <div class="row">
            <div class="col-6">
                <h3>Status</h3>
            </div>
            <div class="col-6 text-end">
                <a class="btn btn-success" href="{{ route('status.create') }}">Novo Status</a>
            </div>
        </div>
        <div class="accordion mt-3" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        Pesquisar
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form action="{{ route('status.list') }}">

                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <label class="form-label" for="status">Status</label>
                                    <input class="form-control" type="text" name="status" id="status"
                                        value="">
                                </div>
                                <div class="col-md-4 col-sm-12 mt-2 pt-4">
                                    <button class="btn btn-info btn-sm" type="submit">Pesquisar</button>
                                    <a class="btn btn-warning btn-sm" href="{{ route('status.list') }}">Limpar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire('Pronto!', "{{session('success')}}", 'success')
            })
        </script>
    @endif
    <div class="row">
        <table class="table table-striped table-responsive table-hover table-sm">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($status as $sts)
                    <tr>
                        <td class="col-1">{{ $sts->id}}</td>
                        <td class="col-10">{{ $sts->status}}</td>


                        <td><a href="{{ route('status.show', ['status' => $sts->id]) }}"><img
                                    src="{{ Vite::asset('resources/images/eye.svg') }}" width="20"></a></td>
                        <td><a href="{{ route('status.edit', ['status' => $sts->id]) }}"><img
                                    src="{{ Vite::asset('resources/images/edit.svg') }}" width="20"></a></td>
                        <td><a onclick="return confirm('Tem certeza que deseja apagar o registro?')" href="{{ route('status.destroy', ['status' => $sts->id]) }}"><img
                                    src="{{ Vite::asset('resources/images/trash.svg') }}" width="20"></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="container">
        <div class="row">
            {{ $status->links() }}
        </div>
    </div>
@endsection

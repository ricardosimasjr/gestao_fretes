@extends('layouts/base')

@section('title')
    Lista de Pedidos
@endsection

@section('content')
    <div class="container mb-4">
        <div class="row">
            <div class="col-6">
                <h3>Pedido de Venda</h3>
            </div>
            <div class="col-6 text-end">
                <a class="btn btn-success" href="{{ route('pedidos.create') }}">Novo Pedido</a>
                <a class="btn btn-primary" href="{{ route('pedidos.updatenota')}}">Atualizar</a>
            </div>
        </div>
        <div class="card mt-3 mb-4 border-ligth shadow">
            <div class="card-header d-flex justify-content-between">
                <span> Pesquisar</span>
            </div>

            <div class="card-body">
                <form action="{{ route('pedidos.list')}}">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <label class="form-label" for="cliente">Cliente</label>
                            <input class="form-control" type="text" name="cliente" id="cliente" value="">
                        </div>
                        <div class="col-md-6 col-sm-12 mt-2 pt-4">
                            <button class="btn btn-info btn-sm" type="submit">Pesquisar</button>
                            <a class="btn btn-warning btn-sm" href="{{ route('pedidos.list')}}">Limpar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Data</th>
                <th scope="col">Pedido</th>
                <th scope="col">Cliente</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pedidos as $pedido)
              <tr>
                <td>{{ \Carbon\Carbon::parse($pedido->datapedido)->tz('America/Sao_Paulo')->format('d/m/Y') }}</td>
                <td>{{$pedido->codigopedido}}</td>
                <td>{{$pedido->nomecliente}}</td>
                <td><a class="btn btn-info btn-sm" href="{{route('pedidos.show', ['pedido' => $pedido->id])}}">Exibir</a></td>
                <td><a class="btn btn-warning btn-sm" href="{{route('pedidos.edit', ['pedido' => $pedido->id])}}">Editar</a></td>
                <td><a class="btn btn-danger btn-sm" href="{{route('pedidos.destroy', ['pedido' => $pedido->id])}}">Excluir</a></td>
                <td><a class="btn btn-success btn-sm" href="{{route('cotacoes.create', ['pedido' => $pedido->id])}}">Cotar</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>
    <div class="container">
        <div class="row">
            {{$pedidos->links()}}
        </div>
    </div>
@endsection

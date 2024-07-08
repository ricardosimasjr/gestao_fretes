@extends('layouts/base')

@section('title')
    Lista de Notas
@endsection

@section('content')
    <div class="container mb-4">
        <div class="row">
            <div class="col-6">
                <h3>Notas Fiscais Emitidas</h3>
            </div>
            <div class="col-6 text-end">
                <a class="btn btn-success" href="{{ route('notas.create') }}">Nova Nota</a>
            </div>
        </div>
    </div>
    <hr>
    <div class="accordion accordion-flush" id="pedidoList">
        @foreach ($notas as $nfe)
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapse{{$nfe->id}}" aria-expanded="false"
                        aria-controls="flush-collapse{{$nfe->nfe}}">
                        <b>{{$nfe->nfe}}</b> - {{$nfe->razaosocial}} - {{$nfe->ufcliente}}
                    </button>
                </h2>
                <div id="flush-collapse{{ $nfe->id }}" class="accordion-collapse collapse" data-bs-parent="pedidoList">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-4 mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        Vendedor
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title text-center">{{$nfe->vendedor}}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        Representante
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title text-center">@if ($nfe->representante == null)
                                            -
                                        @else
                                            {{$nfe->representante}}
                                        @endif</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        Data do NF-e
                                    </div>
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{$nfe->emissao}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <div class="col-4 mb-3">
                                    <div class="card">
                                        <div class="card-header">
                                            Peso da NF-e
                                        </div>
                                        <div class="card-body text-center">
                                            <h5 class="card-title">{{ $nfe->peso }}Kg</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

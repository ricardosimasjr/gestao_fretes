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

                        <div class="container">
                            <div class="row">
                                <div class="row">
                                    <div class="col-6">
                                        <b>{{$nfe->nfe}}</b> - {{$nfe->razaosocial}} - {{$nfe->ufcliente}}
                                    </div>
                                    <div class="col-2">
                                        {{ $nfe->ufcliente }}
                                    </div>
                                    <div class="col-4 text-end">
                                        <span class="badge text-bg-warning rounded-pill">{{ $nfe->status }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                        Emissão NF-e
                                    </div>
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ \Carbon\Carbon::parse($nfe->emissao)->tz('America/Sao_Paulo')->format('d/m/Y')}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        Transportadora
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title text-center">@if ($nfe->transportadora == null)
                                            -
                                        @else
                                            {{$nfe->transportadora}}
                                        @endif</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        Volumes
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title text-center">@if ($nfe->volumes == null)
                                            -
                                        @else
                                            {{$nfe->volumes}}
                                        @endif</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        Tipo Frete
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title text-center">@if ($nfe->tpfrete == null)
                                            -
                                        @else
                                            {{$nfe->tpfrete}}
                                        @endif</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        Previsão Entrega
                                    </div>
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ \Carbon\Carbon::parse($nfe->previsaoentrega)->tz('America/Sao_Paulo')->format('d/m/Y')}}</h5>
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

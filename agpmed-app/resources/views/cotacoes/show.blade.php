@extends('layouts/base')

@section('title')
    Lista de Cotações
@endsection

@section('content')
    <div class="row mb-3">
        <div class="col-6">
            <h3>Nova Cotação</h3>
        </div>
        <div class="col-6 text-end">
            <a class="btn btn-success" href="{{ route('pedidos.list') }}">Voltar</a>
        </div>
    </div>
    <hr>
    <div class="container">
            <div class="row">
                <div class="col-12 mb-3 ">
                    <label class="form-label" for="transportadora">Transportadora</label>
                    <input type="text" class="form-control" id="transportadora" name="transportadora" value="{{$cotacao->transportador->nome}}" disabled />
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <label class="form-label" for="codcotacao">Cod. Cotação</label>
                    <input type="text" class="form-control" id="codcotacao" name="codcotacao" value="{{$cotacao->codcotacao}}" disabled/>
                </div>
                <div class="col-2 mb-3">
                    <label for="dataCotacao" class="form-label">Data Cotação</label>
                    <input type="date" class="form-control" id="dataCotacao" name="dataCotacao"
                        value="{{$cotacao->dataCotacao}}" disabled>
                </div>
                <div class="col-2 mb-3">
                    <label for="dt_previsao_entrega" class="form-label">Prev. Entrega</label>
                    <input type="date" class="form-control" id="dt_previsao_entrega" name="dt_previsao_entrega"
                        value="{{$cotacao->dt_previsao_entrega}}" disabled>
                </div>
            </div>
            <div class="row mb-3">

            </div>
            <div class="row mb-3">
                <div class="col-2">
                    <label class="form-label" for="valor">Valor</label>
                    <div class="input-group">
                        <div class="input-group-text">R$</div>
                        <input type="text" class="form-control" id="valor" name="valor" id="valor"
                            value="{{number_format($cotacao->valor, 2, ',', '.')}}" disabled />
                    </div>
                </div>
                <div class="col-2">
                    <label class="form-label" for="vlr_desconto">Desconto</label>
                    <div class="input-group">
                        <div class="input-group-text">R$</div>
                        <input type="text" class="form-control" id="vlr_desconto" name="vlr_desconto" value="{{number_format($cotacao->vlr_desconto, 2, ',', '.')}}" disabled />
                    </div>
                </div>
                <div class="col-2 mb-3">
                    <input type="text" class="form-control" id="pedido_id" name="pedido_id" value=""
                        hidden>
                </div>
            </div>
            <div class="row mb-3">
                <div class=" col-3 mb-3 ms-1 form-check form-switch mt-4">
                    <input class="form-check-input" type="checkbox" role="switch" id="tx_dificulty" @if ($cotacao->tx_dificulty == 1)
                        checked
                    @endif disabled>
                    <label class="form-check-label" for="tx_dificulty" id="tx_dificulty">Taxa de Dificuldade (TDE)</label>
                </div>
            </div>
            <div class="col-12 mb-12">
                <label for="obs" class="form-label">Observações</label>
                <textarea class="form-control" name="obs" id="obs" cols="1" rows="3" disabled>{{$cotacao->obs}}</textarea>
            </div>

    </div>


@endsection

@extends('layouts/base')

@section('title')
    Nova Cotação
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
        <form action="{{ route('cotacoes.store') }}" method="post">
            @csrf
            <div class="row">
                <select class="form-select mb-3" aria-label="Default select example" id="transportador_id"
                    name="transportador_id" required>
                    <option selected value="">Selecione a tranportadora</option>
                    @foreach ($transportadoras as $transportadora)
                        <option value="{{ $transportadora->id }}">{{ $transportadora->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-2">
                    <label class="form-label" for="codcotacao">Cod. Cotação</label>
                    <input type="text" class="form-control" id="codcotacao" name="codcotacao" value="" />
                </div>
                <div class="col-2 mb-3">
                    <label for="dataCotacao" class="form-label">Data Cotação</label>
                    <input type="date" class="form-control" id="dataCotacao" name="dataCotacao"
                        value="{{ date('Y-m-d') }}">
                </div>
                <div class="col-2 mb-3">
                    <label for="dt_previsao_entrega" class="form-label">Prev. Entrega</label>
                    <input type="date" class="form-control" id="dt_previsao_entrega" name="dt_previsao_entrega"
                        value="">
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
                            value="" />
                    </div>
                </div>
                <div class="col-2">
                    <label class="form-label" for="vlr_desconto">Desconto</label>
                    <div class="input-group">
                        <div class="input-group-text">R$</div>
                        <input type="text" class="form-control" id="vlr_desconto" name="vlr_desconto" value="" />
                    </div>
                </div>
                <div class="col-2 mb-3">
                    <input type="text" class="form-control" id="pedido_id" name="pedido_id" value="{{ $_GET['pedido'] }}"
                        hidden>
                </div>
            </div>
            <div class="row mb-3">
                <div class=" col-3 mb-3 ms-1 form-check form-switch mt-4">
                    <input class="form-check-input" type="checkbox" role="switch" id="tx_dificulty" name="tx_dificulty">
                    <label class="form-check-label" for="tx_dificulty" >Taxa de Dificuldade (TDE)</label>
                </div>
            </div>
            <div class="col-12 mb-12">
                <label for="obs" class="form-label">Observações</label>
                <textarea class="form-control" name="obs" id="obs" cols="1" rows="5"></textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary mt-3">Salvar</button>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script>
        $(function() { //ready
            $("#valor").maskMoney({
                thousands: ".",
                decimal: ","
            });
        });
        $(function() { //ready
            $("#vlr_desconto").maskMoney({
                thousands: ".",
                decimal: ","
            });
        });
    </script>
@endsection

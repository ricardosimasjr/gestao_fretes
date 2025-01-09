@extends('layouts/base')

@section('title')
    Novo pedido
@endsection

@section('content')
    <div class="row mb-3">
        <div class="col-6">
            <h3>Visualização do Romaneio</h3>
        </div>
        <div class="col-6 text-end">
            <a class="btn btn-success" href="{{ route('romaneios.list') }}">Voltar</a>
        </div>
    </div>
    <hr>

    <div class="accordion collapsed mt-3" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    Dados do Romaneio
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="{{ route('romaneios.update', ['romaneio' => $romaneio->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-8 mb-3">
                                <label for="transportador_id" class="form-label">Transportadores</label>
                                <select class="form-select select2" aria-label="Default select example"
                                    id="transportador_id" name="transportador_id" required>
                                    <option value="{{ $transportadora->id }}" selected>{{ $transportadora->nome }}</option>
                                    @foreach ($transportadoras as $transportador)
                                        <option value="{{ $transportador->id }}">{{ $transportador->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2 mb-3">
                                <label for="data" class="form-label">Data Romaneio</label>
                                <input type="date" class="form-control" id="data" name="data"
                                    value="{{ old('data', $romaneio->data) }}">
                            </div>
                            <div class="col-2 mb-3">
                                <label for="datahoracoleta" class="form-label">Data/Hora Coleta</label>
                                <input type="datetime" class="form-control" id="datahoracoleta" name="datahoracoleta">
                            </div>

                            <div>
                                <input type="text" class="form-control" id="user_id" name="user_id"
                                    value="{{ Auth::user()->id }}" hidden>
                                <input type="text" class="form-control" id="status_id" name="status_id" value="1"
                                    hidden>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="motorista" class="form-label">Motorista/Ajudante</label>
                                <input type="text" class="form-control" id="motorista" name="motorista"
                                    value="{{ old('motorista', $romaneio->motorista) }}">
                            </div>
                            <div class="col-3 mb-3">
                                <label for="tipo_ident" class="form-label">Tipo Documento</label>
                                <select class="form-select select2" id="tipo_ident" name="tipo_ident">
                                    <option value="{{ old('tipo_ident', $romaneio->tipo_ident) }}" selected>
                                        {{ old('tipo_ident', $romaneio->tipo_ident) }}</option>
                                    <option value="CPF">CPF - Cadastro de Pessoa Física</option>
                                    <option value="CNH">CNH - Carteira Nacional de Habilitação</option>
                                    <option value="ID">ID - Carteira de Identidade</option>
                                    <option value="CTPS">CTPS - Carteira de Trabalho</option>
                                </select>
                            </div>
                            <div class="col-3 mb-3">
                                <label for="identificacao" class="form-label">Nº Documento</label>
                                <input type="text" class="form-control" id="identificacao" name="identificacao"
                                    value="{{ old('identificacao', $romaneio->identificacao) }}">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="obs" class="form-label">Observações</label>
                                <textarea type="text" class="form-control" id="obs" name="obs" rows="3">{{ old('obs', $romaneio->obs) }}</textarea>
                            </div>
                            <div class="mb-3 mt-3">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <hr class="mt-3">

    <div class="row mb-3">
        <div class="col-6">
            <h3>Notas do Romaneio</h3>
        </div>

        <div class="row">
            <table class="table table-striped table-responsive table-hover table-sm">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Emissão</th>
                        <th scope="col">NF-e</th>
                        <th scope="col">Razão Social</th>
                        <th scope="col">Cidade</th>
                        <th scope="col">UF</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Volumes</th>
                        <th scope="col">Peso</th>
                        <th scope="col">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($notas)
                        @foreach ($notas as $nota)
                            <tr>
                                <td class="col text-center">
                                    {{ \Carbon\Carbon::parse($nota->emissao)->tz('America/Sao_Paulo')->format('d/m/Y') }}
                                </td>
                                <td class="col text-center">{{ $nota->nfe }}</td>
                                <td class="col">{{ $nota->razaosocial }}</td>
                                <td class="col">{{ $nota->municipio }}</td>
                                <td class="col text-center">{{ $nota->ufcliente }}</td>
                                <td class="col text-center">{{ $nota->tpfrete }}</td>
                                <td class="col text-end">{{ $nota->volumes }}</td>
                                <td class="col text-end">{{ number_format($nota->peso, 2, ',', '.') . "Kg" }}</td>
                                <td class="col text-end">{{ 'R$' . number_format($nota->vnota, 2, ',', '.') }}</td>

                            </tr>
                        @endforeach
                    @endisset
                </tbody>
            </table>
        </div>

        <hr>
        <div class="row">
            <div class="mb-3">
                <a class="btn btn-success" href="{{ route('notas.createromaneio', ['romaneio' => $romaneio->id]) }}">Incluir NF-e</a>
            </div>
        </div>
    </div>


    <script>
        $(function() {
            $('.select2').select2({
                theme: 'bootstrap-5'
            });
        });
    </script>
@endsection

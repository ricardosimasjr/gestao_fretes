@extends('layouts/base')

@section('title')
    Nova NF-e
@endsection

@section('content')
    <div class="row">
        <form class="row row-cols-lg-auto g-3 align-items-center mb-4" action=""
            method="POST">
            @csrf
            <div class="col-md-6">
                <input type="text" class="form-control" id="nota" name="nota" placeholder="NF-e">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success" id="search" name="search">Buscar</button>
            </div>
        </form>

    </div>
    <hr>

    <form action="{{ route('notas.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-2 mb-3">
                <label for="nfe" class="form-label">NF-e</label>
                <input type="text" class="form-control" id="nfe" name="nfe"
                    value="@if(isset($nota)){{$nota}}@endif" readonly>
            </div>
            <div class="col-3 mb-3">
                <label for="cpfcnpj" class="form-label">Cpf/Cnpj</label>
                <input type="text" class="form-control" id="cpfcnpj" name="cpfcnpj"
                    value="@if(isset($cpfcnpj)){{$cpfcnpj}}@endif">
            </div>
            <div class="col-6 mb-3">
                <label for="razaosocial" class="form-label">Cliente</label>
                <input type="text" class="form-control" id="razaosocial" name="razaosocial"
                    value="@if(isset($razaosocial)){{$razaosocial}}@endif">
            </div>
            <div class="col-1 mb-3">
                <label for="ufcliente" class="form-label">UF</label>
                <input type="text" class="form-control" id="ufcliente" name="ufcliente"
                    value="@if(isset($uf)){{$uf}}@endif">
            </div>
        </div>
        <div class="row">
            <div class="col-2 mb-3">
                <label for="emissao" class="form-label">Emissão Nota</label>
                <input type="date" class="form-control" id="emissao" name="emissao"
                    value="@if(isset($emissao)){{$emissao}}@endif">
            </div>
            <div class="col-2 mb-6">
                <label for="vendedor" class="form-label">Vendedor</label>
                <input type="text" class="form-control" id="vendedor" name="vendedor"
                    value="@if(isset($vendedor)){{$vendedor}}@endif">
            </div>
            <div class="col-2 mb-6">
                <label for="representante" class="form-label">Representante</label>
                <input type="text" class="form-control" id="representante" name="representante"
                    value="@if(isset($representante)){{$representante}}@endif">
            </div>
            <div class="col-2 mb-6">
                <label for="volumes" class="form-label">Volumes</label>
                <input type="text" class="form-control" id="volumes" name="volumes"
                    value="@if(isset($volumes)){{$volumes}}@endif">
            </div>
            <div class="col-4 mb-6">
                <label for="transportadora" class="form-label">Transportadora</label>
                <input type="text" class="form-control" id="transportadora" name="transportadora"
                    value="@if(isset($transportadora)){{$transportadora}}@endif">
            </div>
            <div class="col-2">
                <label class="form-label" for="peso">Peso</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="peso" name="peso"
                        value="@if(isset($peso)){{$peso}}@endif">
                    <div class="input-group-text">Kg</div>
                </div>
            </div>
            <div class="col-2 mb-6">
                <label for="tpfrete" class="form-label">Tipo Frete</label>
                <input type="text" class="form-control" id="tpfrete" name="tpfrete"
                    value="@if(isset($modfrete)){{$modfrete}}@endif">
            </div>
            <div class="col-2">
                <label class="form-label" for="vfrete">Valor Frete Destacado</label>
                <div class="input-group">
                    <div class="input-group-text">R$</div>
                    <input type="text" class="form-control" id="vfrete" name="vfrete" value="@if(isset($valorfrete)){{number_format($valorfrete, 2, ',', '.')}}@endif">
                </div>
            </div>
            <div class="col-2">
                <label class="form-label" for="vfretePago">Valor Frete Pago</label>
                <div class="input-group">
                    <div class="input-group-text">R$</div>
                    <input type="text" class="form-control" id="vfretePago" name="vfretePago"
                        onKeyPress="return(moeda(this,'.',',',event))">
                </div>
            </div>
            <div class="col-2">
                <label class="form-label" for="vnota">Valor Nota</label>
                <div class="input-group">
                    <div class="input-group-text">R$</div>
                    <input type="text" class="form-control" id="vnota" name="vnota"
                        value="@if (isset($valornota)) {{ number_format($valornota, 2, ',', '.') }} @endif">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 mt-3">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>

    <script type="text/javascript">
        function id(el) {
            return document.getElementById(el);
        }

        window.onload = function() {
            id('peso').onkeyup = function() {
                var v = this.value,
                    integer = v.split(',')[0];


                v = v.replace(/\D/, "");
                v = v.replace(/^[0]+/, "");

                if (v.length <= 3 || !integer) {
                    if (v.length === 1) v = '0,00' + v;
                    if (v.length === 2) v = '0,0' + v;
                    if (v.length === 3) v = '0,' + v;
                } else {
                    v = v.replace(/^(\d{1,})(\d{3})$/, "$1,$2");
                }

                this.value = v;
            }
        };
    </script>
    <script language="javascript">
        function moeda(a, e, r, t) {
            let n = "",
                h = j = 0,
                u = tamanho2 = 0,
                l = ajd2 = "",
                o = window.Event ? t.which : t.keyCode;
            if (13 == o || 8 == o)
                return !0;
            if (n = String.fromCharCode(o),
                -1 == "0123456789".indexOf(n))
                return !1;
            for (u = a.value.length,
                h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
            ;
            for (l = ""; h < u; h++)
                -
                1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
            if (l += n,
                0 == (u = l.length) && (a.value = ""),
                1 == u && (a.value = "0" + r + "0" + l),
                2 == u && (a.value = "0" + r + l),
                u > 2) {
                for (ajd2 = "",
                    j = 0,
                    h = u - 3; h >= 0; h--)
                    3 == j && (ajd2 += e,
                        j = 0),
                    ajd2 += l.charAt(h),
                    j++;
                for (a.value = "",
                    tamanho2 = ajd2.length,
                    h = tamanho2 - 1; h >= 0; h--)
                    a.value += ajd2.charAt(h);
                a.value += r + l.substr(u - 2, u)
            }
            return !1
        }
    </script>
@endsection

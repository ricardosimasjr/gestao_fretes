<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Services\ErpNomus\Endpoints\Notas;
use App\Services\ErpNomus\ErpNomusService;
use Illuminate\Http\Request;
use Termwind\Components\Dd;

class NotaController extends Controller
{
    public function list()
    {
        $notas = Nota::get();
        return view('notas.list', ['notas' => $notas]);
    }

    public function create(Request $request)
    {
        $nota = $request->request->filter('nota');



        if ($nota == '') {
            return view('notas.create');
        } else {

            //GET Notas - API Nomus

            $serviceNotas = new ErpNomusService();
            $return = $serviceNotas
                ->notas()
                ->get($nota);
            $json = $return->json();

            $xml = simplexml_load_string($json[0]['xml']);


            //Dados da NF-e

            $usuarioNota = $json[0]['usuario'];
            $nNF = $xml->NFe->infNFe->ide->nNF;
            $dhEmi = $json[0]['dataProcessamento'];
            $dateFormat = \DateTime::createFromFormat('d/m/Y', $dhEmi);
            $emissao = $dateFormat->format('Y-m-d');
            $modfrete = "";
            if ($xml->NFe->infNFe->transp->modFrete == 0) {
                $modfrete = "CIF";
            } else {
                $modfrete = "FOB";
            };
            $transportadora = $xml->NFe->infNFe->transp->transporta->xNome;
            $qVol = $xml->NFe->infNFe->transp->vol->qVol;
            $pesoB = $xml->NFe->infNFe->transp->vol->pesoB;
            $vTotal = $xml->NFe->infNFe->total->ICMSTot->vNF;
            $vTotalFormat = floatval($vTotal);
            $vTotalFrete = $xml->NFe->infNFe->total->ICMSTot->vFrete;
            $vTotalFreteFormat = floatval($vTotalFrete);

            //Dados do Cliente

            if (isset($xml->NFe->infNFe->dest->CNPJ)) {
                $cnpj = $xml->NFe->infNFe->dest->CNPJ;
                $cpfPontuado = preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $cnpj);
                $cpfCnpj = $cpfPontuado;
            } else {
                $cpf = $xml->NFe->infNFe->dest->CPF;
                $cpfPontuado = preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
                $cpfCnpj = $cpfPontuado;
            }

            $razaoSocial = $xml->NFe->infNFe->dest->xNome;
            $uf = $xml->NFe->infNFe->dest->enderDest->UF;
            $municipio = $xml->NFe->infNFe->dest->enderDest->xMun;


            if (strlen($cpfCnpj) == 14) {
                #Informações do Cliente
                $serviceClientes = new ErpNomusService();
                $return = $serviceClientes
                    ->clientes()
                    ->getCpf($cpfCnpj);
                $clienteNota = $return->json();
            } else {
                $serviceClientes = new ErpNomusService();
                $return = $serviceClientes
                    ->clientes()
                    ->getCnpj($cpfCnpj);
                $clienteNota = $return->json();
            }

            // Informaçoes  do representante
            if (isset($clienteNota[0]['representantes'])) {
                $representante = $clienteNota[0]['representantes'];
                $representanteObj = $representante[0]['nome'];
            } else {
                $representanteObj = "-";
            }
        }

        return view('notas.create', [
            'nota' => $nNF,
            'emissao' => $emissao,
            'cpfcnpj' => $cpfCnpj,
            'razaosocial' => $razaoSocial,
            'municipio' => $municipio,
            'uf' => $uf,
            'representante' => $representanteObj,
            'transportadora' => $transportadora,
            'volumes' => $qVol,
            'peso' => $pesoB,
            'vendedor' => $usuarioNota,
            'valornota' => $vTotalFormat,
            'valorfrete' => $vTotalFreteFormat,
            'modfrete' => $modfrete,
        ]);
    }

    public function createromaneio(Request $request)
    {

        $romaneio = $request->romaneio;

        $nota = $request->request->filter('nota');



        if ($nota == '') {
            return view('notas.create');
        } else {

            //GET Notas - API Nomus

            $serviceNotas = new ErpNomusService();
            $return = $serviceNotas
                ->notas()
                ->get($nota);
            $json = $return->json();

            $xml = simplexml_load_string($json[0]['xml']);

            ds($xml);
            //Dados da NF-e

            $usuarioNota = $json[0]['usuario'];
            $nNF = $xml->NFe->infNFe->ide->nNF;
            $dhEmi = $json[0]['dataProcessamento'];
            $dateFormat = \DateTime::createFromFormat('d/m/Y', $dhEmi);
            $emissao = $dateFormat->format('Y-m-d');
            $modfrete = "";
            if ($xml->NFe->infNFe->transp->modFrete == 0) {
                $modfrete = "CIF";
            } else {
                $modfrete = "FOB";
            };
            $transportadora = $xml->NFe->infNFe->transp->transporta->xNome;
            $qVol = $xml->NFe->infNFe->transp->vol->qVol;
            $pesoB = $xml->NFe->infNFe->transp->vol->pesoB;
            $vTotal = $xml->NFe->infNFe->total->ICMSTot->vNF;
            $vTotalFormat = floatval($vTotal);
            $vTotalFrete = $xml->NFe->infNFe->total->ICMSTot->vFrete;
            $vTotalFreteFormat = floatval($vTotalFrete);

            //Dados do Cliente

            if (isset($xml->NFe->infNFe->dest->CNPJ)) {
                $cnpj = $xml->NFe->infNFe->dest->CNPJ;
                $cpfPontuado = preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $cnpj);
                $cpfCnpj = $cpfPontuado;
            } else {
                $cpf = $xml->NFe->infNFe->dest->CPF;
                $cpfPontuado = preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
                $cpfCnpj = $cpfPontuado;
            }

            $razaoSocial = $xml->NFe->infNFe->dest->xNome;
            $uf = $xml->NFe->infNFe->dest->enderDest->UF;
            $municipio = $xml->NFe->infNFe->dest->enderDest->xMun;


            if (strlen($cpfCnpj) == 14) {
                #Informações do Cliente
                $serviceClientes = new ErpNomusService();
                $return = $serviceClientes
                    ->clientes()
                    ->getCpf($cpfCnpj);
                $clienteNota = $return->json();
            } else {
                $serviceClientes = new ErpNomusService();
                $return = $serviceClientes
                    ->clientes()
                    ->getCnpj($cpfCnpj);
                $clienteNota = $return->json();
            }

            // Informaçoes  do representante
            if (isset($clienteNota[0]['representantes'])) {
                $representante = $clienteNota[0]['representantes'];
                $representanteObj = $representante[0]['nome'];
            } else {
                $representanteObj = "-";
            }
        }

        return view('notas.createromaneio', [
            'nota' => $nNF,
            'emissao' => $emissao,
            'cpfcnpj' => $cpfCnpj,
            'razaosocial' => $razaoSocial,
            'municipio' => $municipio,
            'uf' => $uf,
            'representante' => $representanteObj,
            'transportadora' => $transportadora,
            'volumes' => $qVol,
            'peso' => $pesoB,
            'vendedor' => $usuarioNota,
            'valornota' => $vTotalFormat,
            'valorfrete' => $vTotalFreteFormat,
            'modfrete' => $modfrete,
            'romaneio' => $romaneio,
        ]);
    }

    public function store(Request $request)
    {


        if ($request->canhoto != "") {
            $file = $request->canhoto;
            $file->store('public/canhotos');
            $hash = $file->hashName();
        }
        else{
            $file = "";
            $hash = "";
        }



        $nota = new Nota();
        $nota->nfe = $request->nfe;
        $nota->cpfcnpj = $request->cpfcnpj;
        $nota->razaosocial = $request->razaosocial;
        $nota->municipio = $request->municipio;
        $nota->ufcliente = $request->ufcliente;
        $nota->emissao = $request->emissao;
        $nota->vendedor = $request->vendedor;
        $nota->representante = $request->representante;
        $nota->volumes = $request->volumes;
        $nota->peso = $request->peso;
        $nota->previsaoentrega = $request->prevEntrega;

        $freteForm = $request->vfrete;
        $vFreteFormat = str_replace([".", ","], ["", "."], $freteForm);
        $nota->vfrete = $vFreteFormat;


        $freteCobradoForm = $request->vfreteCotado;
        $vFreteCobradoFormat = str_replace([".", ","], ["", "."], $freteCobradoForm);
        $nota->vfretecotado = $vFreteCobradoFormat;

        $vNotaForm = $request->vnota;
        $vNotaFormat = str_replace([".", ","], ["", "."], $vNotaForm);


        $nota->vnota = $vNotaFormat;
        $nota->canhoto = $hash;
        $nota->transportadora = $request->transportadora;
        $nota->tpfrete = $request->tpfrete;
        $nota->status = "AGUARDANDO COLETA";

        try {
            $nota->save();
            return redirect()->route('notas.list');
        } catch (\Throwable $th) {

            var_dump($th);
            $erno = $th->getCode();

            if($erno == "23000")
            {

                return "Nota já cadastrada!". $th;
            }

        }








    }

    public function storeromaneio(Request $request)
    {


        if ($request->canhoto != "") {
            $file = $request->canhoto;
            $file->store('public/canhotos');
            $hash = $file->hashName();
        }
        else{
            $file = "";
            $hash = "";
        }



        $nota = new Nota();
        $nota->nfe = $request->nfe;
        $nota->cpfcnpj = $request->cpfcnpj;
        $nota->razaosocial = $request->razaosocial;
        $nota->municipio = strtoupper($request->municipio);
        $nota->ufcliente = $request->ufcliente;
        $nota->emissao = $request->emissao;
        $nota->vendedor = $request->vendedor;
        $nota->representante = $request->representante;
        $nota->volumes = $request->volumes;
        $nota->peso = $request->peso;
        $nota->previsaoentrega = $request->prevEntrega;
        $nota->romaneio_id = $request->romaneio_id;

        $freteForm = $request->vfrete;
        $vFreteFormat = str_replace([".", ","], ["", "."], $freteForm);
        $nota->vfrete = $vFreteFormat;


        $freteCobradoForm = $request->vfreteCotado;
        $vFreteCobradoFormat = str_replace([".", ","], ["", "."], $freteCobradoForm);
        $nota->vfretecotado = $vFreteCobradoFormat;

        $vNotaForm = $request->vnota;
        $vNotaFormat = str_replace([".", ","], ["", "."], $vNotaForm);


        $nota->vnota = $vNotaFormat;
        $nota->canhoto = $hash;
        $nota->transportadora = $request->transportadora;
        $nota->tpfrete = $request->tpfrete;
        $nota->status = "AGUARDANDO COLETA";

        try {
            $nota->save();
            return redirect()->route('notas.list');
        } catch (\Throwable $th) {

            var_dump($th);
            $erno = $th->getCode();

            if($erno == "23000")
            {

                return "Nota já cadastrada!". $th;
            }

        }








    }
}

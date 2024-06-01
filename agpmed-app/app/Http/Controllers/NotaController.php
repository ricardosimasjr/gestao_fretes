<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Services\ErpNomus\ErpNomusService;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    public function list()
    {
        $pedidos = Pedido::get();
        return view('pedidos.list', ['pedidos' => $pedidos]);
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

            $nNF = $xml->NFe->infNFe->ide->nNF;
            $dhEmi = $xml->NFe->infNFe->ide->dhEmi;
            $tpFrete = $xml->NFe->infNFe->transp->modFrete;
            $transportadora = $xml->NFe->infNFe->transp->transporta->xNome;
            $qVol = $xml->NFe->infNFe->transp->vol->qVol;
            $pesoB = $xml->NFe->infNFe->transp->vol->pesoB;
            $vTotal = $xml->NFe->infNFe->total->ICMSTot->vNF;

    

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

            $razaoSocial = $xml->NFe->infNFe->dest->nNome;
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

            $cliente = $clienteNota[0]['representantes'];

            ds($cliente);

        }

        return view('notas.create', [
            'nota' => $nNF,
            'emissao' => $dhEmi,
            'cpfcnpj' => $cpfCnpj,
            'razaosocial' => $razaoSocial,
            'municipio' => $municipio,
            'uf' => $uf,
            'volumes' => $qVol,
            'peso' => $pesoB,

        ]);

    }
}

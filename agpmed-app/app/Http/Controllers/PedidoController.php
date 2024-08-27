<?php

namespace App\Http\Controllers;

use App\Models\Cotacao;
use App\Models\Pedido;
use App\Models\Transportador;
use App\Services\ErpNomus\ErpNomusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LaraDumps\LaraDumps\Livewire\Attributes\Ds;
use PhpParser\Node\Stmt\TryCatch;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;

use function Pest\Laravel\get;

class PedidoController extends Controller
{
    public function list(Request $request)
    {
        $pedidos = Pedido::when($request->has('cliente'), function ($whenQuery) use ($request) {
            $whenQuery->where('nomecliente', 'like', '%' . $request->cliente . '%');
        })
            ->with('cotacao')
            ->paginate(5)
            ->withQueryString();




        return view('pedidos.list', [
            'pedidos' => $pedidos,
            'cliente' => $request->cliente

        ]);
    }

    public function create(Request $request)
    {
        $pedido = $request->request->filter('pedido');

        if ($pedido == '') {
            return view('pedidos.create');
        } else {
            //GET Pedido de Vendas - API Nomus

            $servicePedidos = new ErpNomusService();
            $return = $servicePedidos
                ->pedidos()
                ->get($pedido);
            $json = $return->json();



            if (isset($json[0]))  # Caso o Request tenha um retorno válido
            {
                # Informações do Pedido
                $dadosPedido = $json[0];
                $codigoPedido = $json[0]['codigoPedido'];
                $dataEmissao = $json[0]['dataEmissao'];
                $idPessoaCliente = $json[0]['idPessoaCliente'];
                $idPessoaVendedor = $json[0]['idPessoaVendedor'];
                $dateFormat = \DateTime::createFromFormat('d/m/Y',$dataEmissao);
                $dataPedido = $dateFormat->format('Y-m-d');

                if (isset($json[0]['parcelas'])) {
                    $parcelas = $json[0]['parcelas'];
                    $totalPedido = 0;
                    foreach ($parcelas as $parcela) {
                        $valor = (str_replace('.', '', $parcela['valorParcela']));
                        $valorFinal = floatval(str_replace(',', '.', $valor));
                        $totalPedido += $valorFinal;
                    };
                    $valorTotalPedido = $totalPedido;
                }
                else
                {
                    $valorTotalPedido = 0;
                }
                # -------------------------------------------------------------------------------

                #Informações do Cliente

                $serviceClientes = new ErpNomusService();
                $return = $serviceClientes
                    ->clientes()
                    ->get($idPessoaCliente);
                $clientePedido = $return->json();

                $nomePessoa = $clientePedido['razaoSocial'];
                $ufPessoa = $clientePedido['uf'];

                if (isset($clientePedido['grupoPessoa'])) {
                    $grupoPessoa = $clientePedido['grupoPessoa'];
                } else {
                    $grupoPessoa = '';
                }


                if (isset($clientePedido['cnpj'])) {
                    $cpf_cnpj = $clientePedido['cnpj'];
                } else {
                    $cpf_cnpj = $clientePedido['cpf'];
                }

                # -------------------------------------------------------------------------------

                # Informações do Vendedor

                $serviceVendedor = new ErpNomusService();
                $return = $serviceVendedor
                    ->pessoas()
                    ->get($idPessoaVendedor);
                $vendedorPedido = $return->json();

                $vendedor = $vendedorPedido['nome'];

                # Informações do Representante


                if (isset($dadosPedido['idPessoaRepresentante'])) {
                    $idPessoaRepresentante = $dadosPedido['idPessoaRepresentante'];
                    $serviceRepresentante = new ErpNomusService();
                    $return = $serviceRepresentante
                        ->pessoas()
                        ->get($idPessoaRepresentante);
                    $representantePedido = $return->json();
                    $representante = $representantePedido['nome'];
                } else {
                    $representante = '';
                }

                # Retorno da Função
                //dd($dataPedido);
                return view('pedidos.create', [
                    'codigoPedido' => $codigoPedido,
                    'dataPedido' => $dataPedido,
                    'idPessoaCliente' => $idPessoaCliente,
                    'idPessoaVendedor' => $idPessoaVendedor,
                    'nomePessoa' => $nomePessoa,
                    'cpf_cnpj' => $cpf_cnpj,
                    'ufPessoa' => $ufPessoa,
                    'vendedor' => $vendedor,
                    'representante' => $representante,
                    'valorTotalPedido' => $valorTotalPedido
                ]);
            } else # Caso o Request tenha um retorno nulo
            {
                return view('pedidos.create');
            }


            //-----------------------------------------------------


        }
    }

    public function store(Request $request)
    {



        $peso = $request->request->get('peso');
        //dd($peso);

        if($peso == null)
        {
            $peso = 0;
        }
        else
        {
            $pesoBruto = str_replace(',', '.', $peso);
            $request->request->set('peso', $pesoBruto);
        }



        $valor = $request->request->get('valor');
        $valorFinal = str_replace('.', '', $valor);
        $valorFinalFormat = str_replace(',', '.', $valorFinal);
        $request->request->set('valor', $valorFinalFormat);
        //dd($request);

        try {
            $pedido = Pedido::create($request->all());
            $pedido->save();
            return redirect(route('pedidos.list'));
        } catch (\Throwable $th) {

            var_dump($th);
            $erno = $th->getCode();

            if ($erno == "23000") {

                return "Pedido já cadastrado!" . $th;
            }
        }
    }

    public function show(Pedido $pedido)
    {
        $pedido = Pedido::with('cotacao.transportador')
        ->find($pedido->id);

        return view('pedidos.show', ['pedidos' => $pedido]);
    }

    public function updateNota()
    {
        $pedidos = Pedido::get('codigopedido');

        ds($pedidos);
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->destroy($pedido->id);
        return redirect(route('pedidos.list'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cotacao;
use App\Models\Pedido;
use App\Models\Status;
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
            ->with('status')
            ->when($request->filled('vendedor'), function ($whenQuery) use ($request) {
                $whenQuery->where('vendedorpedido', 'like', '%' . $request->vendedor . '%');
            })
            ->when($request->filled('dtini'), function ($whenQuery) use ($request) {
                $whenQuery->where('datapedido', '>=', \Carbon\Carbon::parse($request->dtini)->format('Y-m-d'));
            })
            ->when($request->filled('dtfin'), function ($whenQuery) use ($request) {
                $whenQuery->where('datapedido', '<=', \Carbon\Carbon::parse($request->dtfin)->format('Y-m-d'));
            })
            ->paginate(5)
            ->withQueryString();


        return view('pedidos.list', [
            'pedidos' => $pedidos,
            'cliente' => $request->cliente,
            'vendedor' =>$request->vendedor,
            'dtini' => $request->dtini,
            'dtfin' => $request->dtfin,

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
                $dateFormat = \DateTime::createFromFormat('d/m/Y', $dataEmissao);
                $dataPedido = $dateFormat->format('Y-m-d');

                if(isset($json[0]['pedidoCompraCliente']))
                {
                    $pedido_compra = $json[0]['pedidoCompraCliente'];
                }
                else
                {
                    $pedido_compra = null;
                }



                if (isset($json[0]['parcelas'])) {
                    $parcelas = $json[0]['parcelas'];
                    $totalPedido = 0;
                    foreach ($parcelas as $parcela) {
                        $valor = (str_replace('.', '', $parcela['valorParcela']));
                        $valorFinal = floatval(str_replace(',', '.', $valor));
                        $totalPedido += $valorFinal;
                    };
                    $valorTotalPedido = $totalPedido;
                } else {
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
                    'valorTotalPedido' => $valorTotalPedido,
                    'pedido_compra' => $pedido_compra,
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


        if ($peso == null) {
            $peso = 0;
        } else {
            $pesoBruto = str_replace(',', '.', $peso);
            $request->request->set('peso', $pesoBruto);
        }



        $valor = $request->request->get('valor');
        $valorFinal = str_replace('.', '', $valor);
        $valorFinalFormat = str_replace(',', '.', $valorFinal);
        $request->request->set('valor', $valorFinalFormat);
        $request->request->set('status_id', 1);
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

    public function showComprovante(Pedido $pedido)
    {
        $pedido = Pedido::with('cotacao.transportador')
            ->find($pedido->id);

        return view('pedidos.showcomprovante', ['pedidos' => $pedido]);
    }

    public function edit(Pedido $pedido, Request $request)
    {


        $status = Status::get()->all();

        return view('pedidos.edit', [
            'pedido' => $pedido,
            'statusCollection' => $status,
        ]);
    }

    public function update(Request $request, Pedido $pedido)
    {
        $file = $request->file('comprovantes');


        $pedidoOriginal = Pedido::with('status')->find($request->id);

        if($file)
        {
            $comprovante = $file->store('comprovantes');
        }
        else
        {
            $comprovante = null;
        }

        $valor = $request->valor;
        $valor = (str_replace('.', '', $valor));
        $valorFinal = floatval(str_replace(',', '.', $valor));

        $status = intval($request->status);


        try {
            $pedidoOriginal->updateOrFail([
                'codigopedido' => $request->codigopedido,
                'nr_nota' => $request->nota,
                'cpfcnpj' => $request->cpfcnpj,
                'nomecliente' => $request->nomecliente,
                'ufcliente' => $request->ufcliente,
                'datapedido' => $request->datapedido,
                'vendedorpedido' => $request->vendedorpedido,
                'representantepedido' => $request->representantepedido,
                'volumes' => $request->volumes,
                'peso' => $request->peso,
                'valor' => $valorFinal,
                'status_id' => $status,
                'comprovantes' => $comprovante,
                'tipo_frete' => $request->tipo_frete,
            ]);


            return redirect(route('pedidos.list'));
        } catch (\Throwable $e) {
            dd($e);
        }
    }

    public function updateNota(Request $request, Pedido $ped)
    {
        $pedido = $request->codigopedido;
        if ($pedido == '') {
            return view('pedidos.create');
        } else {
            //GET Pedido de Vendas - API Nomus

            $servicePedidos = new ErpNomusService();
            $return = $servicePedidos
                ->pedidos()
                ->get($pedido);
            $json = $return->json();

            if ($json[0]['nfes']) {
                $nfe = $json[0]['nfes'][0]['numero'];
            } else {
                $nfe = null;
            }

            $id = $request->id;

            $pedidoOriginal = Pedido::find($id);



            //dd($pedidoOriginal);
            $pedidoOriginal->updateOrFail([
                'nr_nota' => $nfe,
            ]);

            return redirect(route('pedidos.edit', ['pedido' => $id]));
        }
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->destroy($pedido->id);
        return redirect(route('pedidos.list'));
    }
}

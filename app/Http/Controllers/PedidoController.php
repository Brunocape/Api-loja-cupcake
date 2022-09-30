<?php
//php artisan make:controller PedidoController

namespace App\Http\Controllers;

use App\Models\PedidoModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PedidoController extends Controller
{
//***********************************************
    public function Cadastrar(Request $request)
    {           

        $erros = $this->ValidarRequest($request);
        if($erros != ""){
            return $erros;
            exit;
        }

        $pedidoModel = new PedidoModel();    
        try {
            $pedidoModel->FromRequest($request);
            $pedidoModel->Salvar($request);

            $retorno = [
                'status' => 'Ok',
                'mensagem' => 'Cadastrado com sucesso',
                'Pedido' => $pedidoModel->ToArray(),
            ];
            return response()->json($retorno, 200); 

        } catch (\Throwable $th) {
            $retorno = [
                'status' => 'Erro',
                'mensagem' => $th->getMessage(),
            ];
            return response()->json($retorno, 413); 
        }
    }

//***********************************************
  public function ValidarRequest(Request $request)
  {
    $request = json_decode($request->input('pedido'));   
    $inputs = [
           'vlr_bruto' => $request->vlr_bruto,
           'vlr_liquido' => $request->vlr_liquido,
           'perc_desconto' => $request->perc_desconto,
           'vlr_desconto' => $request->vlr_desconto,
           'vlr_frete' => $request->vlr_frete,
           'cliente_id' => $request->cliente_id,
    ];
    $validator = Validator::make($inputs, [
           'vlr_bruto' => 'required',
           'vlr_liquido' => 'required',
           'perc_desconto' => 'required',
           'vlr_desconto' => 'required',
           'vlr_frete' => 'required',
           'cliente_id' => 'required',
    ],
    [
           'vlr_bruto.required' => 'O campo vlr_bruto é obrigatorio!',
           'vlr_liquido.required' => 'O campo vlr_liquido é obrigatorio!',
           'perc_desconto.required' => 'O campo perc_desconto é obrigatorio!',
           'vlr_desconto.required' => 'O campo vlr_desconto é obrigatorio!',
           'vlr_frete.required' => 'O campo vlr_frete é obrigatorio!',
           'cliente_id.required' => 'O campo cliente_id é obrigatorio!',
    ]);

    if ($validator->fails()) {
       $errors = $validator->errors();
       return $errors->first();
    }
    return "";
  }
//***********************************************
    public function Atualizar(Request $request)
    {

        $erros = $this->ValidarRequest($request);
        if($erros != ""){
            return $erros;
            exit;
        }

        $PedidoModel = new PedidoModel();    

        try {

            $PedidoModel->FromRequest($request);
            $PedidoModel->Atualizar();
            $retorno = [
                'status' => 'Ok',
                'mensagem' => 'Atualizado com sucesso',
                'Pedido' => $PedidoModel->ToArray(),
            ];
            return response()->json($retorno, 200); 

        } catch (\Throwable $th) {
            $retorno = [
                'status' => 'Erro',
                'mensagem' => $th->getMessage(),
            ];
            return response()->json($retorno, 413); 
        }
    }
//***********************************************
    public function Apagar(Request $request)
    {

        $PedidoModel = new PedidoModel();    
        $PedidoModel->GetById($request->idPedido);
        try {
            $PedidoModel->Apagar();
            $retorno = [
                'status' => 'Ok',
                'mensagem' => 'Deletado com sucesso',
            ];
            return response()->json($retorno, 200); 

        } catch (\Throwable $th) {
            $retorno = [
                'status' => 'Erro',
                'mensagem' => $th->getMessage(),
            ];
            return response()->json($retorno, 413); 
        }
    }


    public function buscarTodos()
    {
        $PedidoModel = new PedidoModel();  
        try {
            $dados = $PedidoModel->GetAll();
            $retorno = [
                'status' => 'Ok',
                'mensagem' => 'Consulta realizada com sucesso',
                'pedidos' => $dados
            ];
            return response()->json($retorno, 200); 
        } catch (\Throwable $th) {
            $retorno = [
                'status' => 'Erro',
                'mensagem' => $th->getMessage(),
            ];
            return response()->json($retorno, 413); 
        }
    }
public function buscarPorClienteId(Request $request)
{
    $PedidoModel = new PedidoModel();  
    
    try {
        $retorno = [
            'status' => 'Ok',
            'mensagem' => 'Consulta realizada com sucesso',
            'dados' => $PedidoModel->GetByClienteId($request->cliente_idPedido),
        ];
        return response()->json($retorno, 200); 

    } catch (\Throwable $th) {
        $retorno = [
            'status' => 'Erro',
            'mensagem' => $th->getMessage(),
        ];
        return response()->json($retorno, 413); 
    }
}
}



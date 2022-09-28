<?php
//php artisan make:controller ItemCarinhoController

namespace App\Http\Controllers;

use App\Models\ItemCarinhoModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemCarinhoController extends Controller
{
//***********************************************
    public function Cadastrar(Request $request)
    {

        $erros = $this->ValidarRequest($request);
        if($erros != ""){
            return $erros;
            exit;
        }

        $ItemCarinhoModel = new ItemCarinhoModel();    

        try {

            $ItemCarinhoModel->FromRequest($request);
            $ItemCarinhoModel->Salvar();
            $retorno = [
                'status' => 'Ok',
                'mensagem' => 'Cadastrado com sucesso',
                'ItemCarinho' => $ItemCarinhoModel->ToArray(),
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
    $inputs = [
           'qtde' => $request->qtdeItemCarinho,
           'usuario_id' => $request->usuario_idItemCarinho,
           'item_id' => $request->item_idItemCarinho,
    ];
    $validator = Validator::make($inputs, [
           'qtde' => 'required',
           'usuario_id' => 'required',
           'item_id' => 'required',
    ],
    [
           'qtde.required' => 'O campo qtde é obrigatorio!',
           'usuario_id.required' => 'O campo usuario_id é obrigatorio!',
           'item_id.required' => 'O campo item_id é obrigatorio!',
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

        $ItemCarinhoModel = new ItemCarinhoModel();    

        try {

            $$ItemCarinhoModel->FromRequest($request);
            $usuarioModel->Atualizar();
            $retorno = [
                'status' => 'Ok',
                'mensagem' => 'Atualizado com sucesso',
                'ItemCarinho' => $ItemCarinhoModel->ToArray(),
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

        $ItemCarinhoModel = new ItemCarinhoModel();    
        $ItemCarinhoModel->GetById($request->idItemCarinho);
        try {
            $ItemCarinhoModel->Apagar();
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

    //*********************************************** */

    public function buscarPorUserId(Request $request)
    {
        $ItemCarinhoModel = new ItemCarinhoModel();  
        try {
            $dados = $ItemCarinhoModel->GetByUserId($request->idUsuario);
            $retorno = [
                'status' => 'Ok',
                'mensagem' => 'Consulta realizada com sucesso',
                'itens_carinho' => $dados
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
    
public function BuscarPorId(Request $request)
{
    $ItemCarinhoModel = new ItemCarinhoModel();  
    
    try {

        $ItemCarinhoModel->GetById($request->idItemCarinho);
        $retorno = [
            'status' => 'Ok',
            'mensagem' => 'Consulta realizada com sucesso',
            'dados' => $ItemCarinhoModel->ToArray(),
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

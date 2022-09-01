<?php
//php artisan make:controller ItemController

namespace App\Http\Controllers;

use App\Models\ItemModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
//***********************************************
    public function Cadastrar(Request $request)
    {

        $erros = $this->ValidarRequest($request);
        if($erros != ""){
            return $erros;
            exit;
        }

        $ItemModel = new ItemModel();    

        try {

            $ItemModel->FromRequest($request);
            $ItemModel->Salvar();
            $retorno = [
                'status' => 'Ok',
                'mensagem' => 'Cadastrado com sucesso',
                'Item' => $ItemModel->ToArray(),
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
           'categoria_id' => $request->categoria_idItem,
           'tipo' => $request->tipoItem,
           'perco' => $request->percoItem,
           'descricao' => $request->descricaoItem,
    ];
    $validator = Validator::make($inputs, [
           'categoria_id' => 'required',
           'tipo' => 'required',
           'perco' => 'required',
           'descricao' => 'required',
    ],
    [
           'categoria_id.required' => 'O campo categoria_id é obrigatorio!',
           'tipo.required' => 'O campo tipo é obrigatorio!',
           'perco.required' => 'O campo perco é obrigatorio!',
           'descricao.required' => 'O campo descricao é obrigatorio!',
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

        $ItemModel = new ItemModel();    

        try {

            $$ItemModel->FromRequest($request);
            $usuarioModel->Atualizar();
            $retorno = [
                'status' => 'Ok',
                'mensagem' => 'Atualizado com sucesso',
                'Item' => $ItemModel->ToArray(),
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

        $ItemModel = new ItemModel();    
        $ItemModel->GetById($request->idItem);
        try {
            $ItemModel->Apagar();
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

    public function buscarPorCat(Request $request)
    {
        $ItemModel = new ItemModel();  
        try {
            $dados = $ItemModel->GetBayCat($request->categoria_idItem);
            $retorno = [
                'status' => 'Ok',
                'mensagem' => 'Consulta realizada com sucesso',
                'Itens' => $dados
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
    $ItemModel = new ItemModel();  
    
    try {

        $ItemModel->GetById($request->idItem);
        $retorno = [
            'status' => 'Ok',
            'mensagem' => 'Consulta realizada com sucesso',
            'dados' => $ItemModel->ToArray(),
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

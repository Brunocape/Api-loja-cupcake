<?php
//php artisan make:controller ImagemController

namespace App\Http\Controllers;

use App\Models\ImagemModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImagemController extends Controller
{
//***********************************************
    public function Cadastrar(Request $request)
    {

        $erros = $this->ValidarRequest($request);
        if($erros != ""){
            return $erros;
            exit;
        }

        $ImagemModel = new ImagemModel();    

        try {

            $ImagemModel->FromRequest($request);
            $ImagemModel->Salvar();
            $retorno = [
                'status' => 'Ok',
                'mensagem' => 'Cadastrado com sucesso',
                'Imagem' => $ImagemModel->ToArray(),
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
           'item_id' => $request->item_idImagem,
           'path' => $request->pathImagem,
    ];
    $validator = Validator::make($inputs, [
           'item_id' => 'required',
           'path' => 'required',
    ],
    [
           'item_id.required' => 'O campo item_id é obrigatorio!',
           'path.required' => 'O campo path é obrigatorio!',
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

        $ImagemModel = new ImagemModel();    

        try {

            $$ImagemModel->FromRequest($request);
            $usuarioModel->Atualizar();
            $retorno = [
                'status' => 'Ok',
                'mensagem' => 'Atualizado com sucesso',
                'Imagem' => $ImagemModel->ToArray(),
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

        $ImagemModel = new ImagemModel();    
        $ImagemModel->GetById($request->idImagem);
        try {
            $ImagemModel->Apagar();
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
        $ImagemModel = new ImagemModel();  
        try {
            $dados = $ImagemModel->GetAll();
            $retorno = [
                'status' => 'Ok',
                'mensagem' => 'Consulta realizada com sucesso',
                'imagens' => $dados
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
    $ImagemModel = new ImagemModel();  
    
    try {

        $ImagemModel->GetById($request->idImagem);
        $retorno = [
            'status' => 'Ok',
            'mensagem' => 'Consulta realizada com sucesso',
            'dados' => $ImagemModel->ToArray(),
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

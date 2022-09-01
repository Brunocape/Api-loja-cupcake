<?php
//php artisan make:controller ImagemHomeController

namespace App\Http\Controllers;

use App\Models\ImagemHomeModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImagemHomeController extends Controller
{
//***********************************************
    public function Cadastrar(Request $request)
    {

        $erros = $this->ValidarRequest($request);
        if($erros != ""){
            return $erros;
            exit;
        }

        $ImagemHomeModel = new ImagemHomeModel();    

        try {

            $ImagemHomeModel->FromRequest($request);
            $ImagemHomeModel->Salvar();
            $retorno = [
                'status' => 'Ok',
                'mensagem' => 'Cadastrado com sucesso',
                'ImagemHome' => $ImagemHomeModel->ToArray(),
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
           'pos_y' => $request->pos_yImagemHome,
           'pos_x' => $request->pos_xImagemHome,
           'ordenacao' => $request->ordenacaoImagemHome,
           'url' => $request->urlImagemHome,
    ];
    $validator = Validator::make($inputs, [
           'pos_y' => 'required',
           'pos_x' => 'required',
           'ordenacao' => 'required',
           'url' => 'required',
    ],
    [
           'pos_y.required' => 'O campo pos_y é obrigatorio!',
           'pos_x.required' => 'O campo pos_x é obrigatorio!',
           'ordenacao.required' => 'O campo ordenacao é obrigatorio!',
           'url.required' => 'O campo url é obrigatorio!',
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

        $ImagemHomeModel = new ImagemHomeModel();    

        try {

            $$ImagemHomeModel->FromRequest($request);
            $usuarioModel->Atualizar();
            $retorno = [
                'status' => 'Ok',
                'mensagem' => 'Atualizado com sucesso',
                'ImagemHome' => $ImagemHomeModel->ToArray(),
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

        $ImagemHomeModel = new ImagemHomeModel();    
        $ImagemHomeModel->GetById($request->idImagemHome);
        try {
            $ImagemHomeModel->Apagar();
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
        $ImagemHomeModel = new ImagemHomeModel();  
        try {
            $dados = $ImagemHomeModel->GetAll();
            $retorno = [
                'status' => 'Ok',
                'mensagem' => 'Consulta realizada com sucesso',
                'imagens_home' => $dados
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

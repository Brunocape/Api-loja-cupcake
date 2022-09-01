<?php
//php artisan make:controller CategoriaController

namespace App\Http\Controllers;

use App\Models\CategoriaModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
//***********************************************
    public function Cadastrar(Request $request)
    {

        $erros = $this->ValidarRequest($request);
        if($erros != ""){
            return $erros;
            exit;
        }

        $CategoriaModel = new CategoriaModel();    

        try {

            $CategoriaModel->FromRequest($request);
            $CategoriaModel->Salvar();
            $retorno = [
                'status' => 'Ok',
                'mensagem' => 'Cadastrado com sucesso',
                'Categoria' => $CategoriaModel->ToArray(),
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
           'peso' => $request->pesoCategoria,
           'icon' => $request->iconCategoria,
           'descricao' => $request->descricaoCategoria,
    ];
    $validator = Validator::make($inputs, [
           'peso' => 'required',
           'icon' => 'required',
           'descricao' => 'required',
    ],
    [
           'peso.required' => 'O campo peso é obrigatorio!',
           'icon.required' => 'O campo icon é obrigatorio!',
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

        $CategoriaModel = new CategoriaModel();    

        try {

            $$CategoriaModel->FromRequest($request);
            $usuarioModel->Atualizar();
            $retorno = [
                'status' => 'Ok',
                'mensagem' => 'Atualizado com sucesso',
                'Categoria' => $CategoriaModel->ToArray(),
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

        $CategoriaModel = new CategoriaModel();    
        $CategoriaModel->GetById($request->idCategoria);
        try {
            $CategoriaModel->Apagar();
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
        $CategoriaModel = new CategoriaModel();  
        try {
            $dados = $CategoriaModel->GetAll();
            $retorno = [
                'status' => 'Ok',
                'mensagem' => 'Consulta realizada com sucesso',
                'Categorias' => $dados
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
    $CategoriaModel = new CategoriaModel();  
    
    try {

        $CategoriaModel->GetById($request->idCategoria);
        $retorno = [
            'status' => 'Ok',
            'mensagem' => 'Consulta realizada com sucesso',
            'dados' => $CategoriaModel->ToArray(),
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

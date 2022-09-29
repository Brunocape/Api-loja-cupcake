<?php
//php artisan make:controller CupomController

namespace App\Http\Controllers;

use App\Models\CupomModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CupomController extends Controller
{
//***********************************************
    public function Cadastrar(Request $request)
    {

        $erros = $this->ValidarRequest($request);
        if($erros != ""){
            return $erros;
            exit;
        }

        $CupomModel = new CupomModel();    

        try {

            $CupomModel->FromRequest($request);
            $CupomModel->Salvar();
            $retorno = [
                'status' => 'Ok',
                'mensagem' => 'Cadastrado com sucesso',
                'Cupom' => $CupomModel->ToArray(),
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
           'percentual' => $request->percentualCupom,
           'descricao' => $request->descricaoCupom,
    ];
    $validator = Validator::make($inputs, [
           'percentual' => 'required',
           'descricao' => 'required',
    ],
    [
           'percentual.required' => 'O campo percentual é obrigatorio!',
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

        $CupomModel = new CupomModel();    

        try {

            $$CupomModel->FromRequest($request);
            $CupomModel->Atualizar();
            $retorno = [
                'status' => 'Ok',
                'mensagem' => 'Atualizado com sucesso',
                'Cupom' => $CupomModel->ToArray(),
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

        $CupomModel = new CupomModel();    
        $CupomModel->GetById($request->idCupom);
        try {
            $CupomModel->Apagar();
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
        $CupomModel = new CupomModel();  
        try {
            $dados = $CupomModel->GetAll();
            $retorno = [
                'status' => 'Ok',
                'mensagem' => 'Consulta realizada com sucesso',
                'cupons' => $dados
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
public function BuscarPorDesc(Request $request)
{
    $CupomModel = new CupomModel();  
    try {
        $dados = ($CupomModel->GetByDesc($request->descricaoCupom));

        if(count($dados) == 0){
            $retorno = [
                'status' => 'Erro',
                'mensagem' => 'Cupom não encontrado',
            ];
            return response()->json($retorno, 400); 
        }else
        if($dados[0]->usado == 1){
            $retorno = [
                'status' => 'Erro',
                'mensagem' => 'Cupom ja utilizado',
            ];
            return response()->json($retorno, 400); 
        }else{
            $retorno = [
                'status' => 'Ok',
                'mensagem' => 'Consulta realizada com sucesso',
                'dados' => $dados[0],
            ];
            return response()->json($retorno, 200); 
        }

    } catch (\Throwable $th) {
        $retorno = [
            'status' => 'Erro',
            'mensagem' => $th->getMessage(),
        ];
        return response()->json($retorno, 413); 
    }
}
}


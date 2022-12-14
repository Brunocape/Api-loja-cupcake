<?php

namespace App\Http\Controllers;

use App\Models\UsuarioModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    public function Logar(Request $request)
    {
        try {
            $usuarioModel = new UsuarioModel();
            $usuarioModel->Logar($request);
            $retorno = [
                'status' => 'Ok',
                'mensagem' => 'Logado com sucesso',
                'user' => $usuarioModel->ToArray(),
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

//*************************************************** */
    public function Cadastrar(Request $request)
    {

        $erros = $this->ValidarRequest($request);
        if($erros != ""){
             $retorno = [
                'status' => 'Erro',
                'mensagem' => $erros,
           ];
           return response()->json($retorno, 413); 
           exit;
        }

        $usuarioModel = new UsuarioModel();    

        try {

            $usuarioModel->FromRequest($request);
            $usuarioModel->Salvar();
            $retorno = [
                'status' => 'Ok',
                'mensagem' => 'Cadastrado com sucesso',
                'user' => $usuarioModel->ToArray(),
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
         'senha' => $request->senhaUsuario,
         'email' => $request->emailUsuario,
         'nome' => $request->nomeUsuario,
  ];
  $validator = Validator::make($inputs, [
         'senha' => 'required',
         'email' => 'required|unique:usuarios',
         'nome' => 'required',
  ],
  [
         'senha.required' => 'O campo senha ?? obrigatorio!',
         'email.required' => 'O campo email ?? obrigatorio!',
         'email.unique' => 'Email ja cadastrado!',
         'nome.required' => 'O campo nome ?? obrigatorio!',
  ]);

  if ($validator->fails()) {
     $errors = $validator->errors();
     return $errors->first();
  }
  return "";
}

//*************************************************** */

function EnviarEmail(Request $request)
{
    if ($request->emailUsuario == null || $request->emailUsuario == "") {
        $retorno = [
            'status' => 'Erro',
            'mensagem' => 'Email n??o informado',
        ];
        return response()->json($retorno, 400); 
    }
    $usuarioModel = new UsuarioModel();
    $usuarioModel->GetByEmail($request->emailUsuario);
    $usuarioModel->SendEmail();
    $usuarioModel->Atualizar();
    $retorno = [
        'status' => 'Ok',
        'mensagem' => 'Email enviado com sucesso',
    ];
    return response()->json($retorno, 200);
}

//*************************************************** */

function AlterarSenha(Request $request)
{
    if ($request->emailUsuario == null || $request->emailUsuario == "") {
        $retorno = [
            'status' => 'Erro',
            'mensagem' => 'Email n??o informado',
        ];
        return response()->json($retorno, 400); 
    }   
    if ($request->senhaUsuario == null || $request->senhaUsuario == "") {
        $retorno = [
            'status' => 'Erro',
            'mensagem' => 'Nova senha n??o invalida',
        ];
        return response()->json($retorno, 400); 
    } 
    
    $usuarioModel = new UsuarioModel();
    $usuarioModel->GetByEmail($request->emailUsuario);
    if ($usuarioModel->codigo_valid != $request->codigo_validUsuario) {
        $retorno = [
            'status' => 'Erro',
            'mensagem' => 'C??digo informado n??o confere!',
        ];
        return response()->json($retorno, 400); 
    }
    $usuarioModel->senha = password_hash($request->senhaUsuario, PASSWORD_DEFAULT); 
    $usuarioModel->Atualizar();
    $retorno = [
        'status' => 'Ok',
        'mensagem' => 'Senha Aterada com sucesso!',
    ];
    return response()->json($retorno, 200);
}

//*************************************************** */

public function AtivarUsuario(Request $request)
{
    if ($request->emailUsuario == null || $request->emailUsuario == "") {
        $retorno = [
            'status' => 'Erro',
            'mensagem' => 'Email n??o informado',
        ];
        return response()->json($retorno, 400); 
    }    
    
    $usuarioModel = new UsuarioModel();
    $usuarioModel->GetByEmail($request->emailUsuario);
    if ($usuarioModel->codigo_valid != $request->codigo_validUsuario) {
        $retorno = [
            'status' => 'Erro',
            'mensagem' => 'C??digo informado n??o confere!',
        ];
        return response()->json($retorno, 400); 
    }
    $usuarioModel->ativo = 1; 
    $usuarioModel->Atualizar();
    $retorno = [
        'status' => 'Ok',
        'mensagem' => 'Seu usuario foi ativado no sistema.',
    ];
    return response()->json($retorno, 200);
}

//*************************************************** */

public function BuscarPorId(Request $request)
{
    $usuarioModel = new UsuarioModel();  
    
    try {

        $usuario = $usuarioModel->GetById($request->idUsuario);
        if(count($usuario)==0){
            throw new Exception("Usuario n??o localizado no banco de dados", 1);
            
        }

        $retorno = [
            'status' => 'Ok',
            'mensagem' => 'Consulta realizada com sucesso!',
            'dados' => $usuario,
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

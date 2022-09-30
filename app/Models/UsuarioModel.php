<?php

namespace App\Models;

use App\Mail\SendCodigoMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UsuarioModel extends Model
{
    public $codigo_valid;
    public $dt_alteracao;
    public $dt_criacao;
    public $token;
    public $ativo;
    public $senha;
    public $email;
    public $nome;
    public $id;
      use HasFactory;
 
  //*********************************** */
    /*funcao fromFormRequest*/
    public function FromRequest(Request $request)
    {
        if ($request->idUsuario != null || $request->idUsuario != "") {
            $this->id = $request->idUsuario;
        }
        $this->nome = $request->nomeUsuario;
        $this->email = $request->emailUsuario;
        $this->senha = password_hash($request->senhaUsuario, PASSWORD_DEFAULT);  
        $this->token = Str::random(150);
    }
  //*********************************** */
    public function SendEmail()
    {
        $this->codigo_valid = rand(100000,999999);
        $cupom = Str::random(5)."10off";
        $CupomModel = new CupomModel();
        $CupomModel->descricao = $cupom;
        $CupomModel->percentual = 10;
        $CupomModel->Salvar();
        Mail::to([$this->email])->send(new SendCodigoMail($this->codigo_valid, $cupom));
    }
  //*********************************** */
    /*funcao Save*/
    public function Salvar()
    {
        
        $this->SendEmail();
        $this->id = DB::table('usuarios')->insertGetId(
            [
                'nome' => $this->nome,
                'email' => $this->email,
                'senha' => $this->senha,
                'token' => $this->token,
                'ativo' => 0,
                'codigo_valid' => $this->codigo_valid
            ]
        );        
    }
  //*********************************** */
    /*funcao Update*/
    public function Atualizar()
    {
        DB::update(
            "update usuarios set 
                 nome = '{$this->nome}',
                 email = '{$this->email}',
                 senha = '{$this->senha}',
                 ativo = {$this->ativo},
                 token = '{$this->token}',
                 codigo_valid = {$this->codigo_valid}
                  where 
                 id = ?",
            [
                $this->id
            ]
        );
    }
  //*********************************** */
    /*funcao Delete*/
    public function Apagar()
    {
        DB::Delete(
            'delete from usuarios
                  where 
                 id = ?',
            [
                $this->id
            ]
        );
    }
  //*********************************** */
    /*funcao getbyid*/
    public function GetById($id)
    {
        return     DB::select(
            "SELECT * FROM `usuarios` WHERE id = ?  LIMIT 1 ",
            [$id]
        );

    }
  //*********************************** */
    public function GetByEmail($email)
    {
        $dados =     DB::select(
            "SELECT * FROM `usuarios` WHERE email = ?  LIMIT 1 ",
            [$email]
        );
        if (count($dados) > 0) {
            $this->id = $dados[0]->id;
            $this->nome = $dados[0]->nome;
            $this->email = $dados[0]->email;
            $this->senha = $dados[0]->senha;
            $this->ativo = $dados[0]->ativo;
            $this->token = $dados[0]->token;
            $this->codigo_valid = $dados[0]->codigo_valid;
            $this->dt_criacao = $dados[0]->dt_criacao;
            $this->dt_alteracao = $dados[0]->dt_alteracao;
        }
    }
  //*********************************** */

    public function Logar(Request $request)
    {
        $input = [
            'email' => $request->emailUsuario,
            'senha' => $request->senhaUsuario,
        ];

        $validator = Validator::make(
            $input,
            [
                'email' => 'required|email',
                'senha' => 'required|min:6'
            ],[
                'email.required' => ' O campo email e obrigatorio',
                'email.email' => ' O campo email deve conter um email valido',
                'senha.required' => ' O campo senha e obrigatorio',
                'senha.min' => ' O campo senha deve conter no minimo 6 caracteres',
            ]);

        if ($validator->fails()) {
            throw new Exception($validator->errors()->first());
        }

        $user =   DB::select('SELECT * FROM `usuarios` WHERE email = ?  LIMIT 1 ', [$request->emailUsuario]);

        if (count($user) == 0) {
            throw new Exception("Email não cadastrado");
        }    

        if ($user[0]->ativo == 0) {
            Mail::to([$user[0]->email])->send(new SendCodigoMail($user[0]->codigo_valid,""));
            throw new Exception("Este usuario não esta ativo");
        } 

        if (!password_verify($request->senhaUsuario, $user[0]->senha)) {    
               throw new Exception('senha invalida');    
        } else{
            $this->id = $user[0]->id;
            $this->nome = $user[0]->nome;
            $this->email = $user[0]->email;
            $this->senha = $user[0]->senha;
            $this->ativo = $user[0]->ativo;
            $this->token = $user[0]->token;
            $this->dt_criacao = $user[0]->dt_criacao;
            $this->dt_alteracao = $user[0]->dt_alteracao;
        }
        
    }

    //*********************************** */

    public function ToArray()
    {
        $retorno = [
            'ativo'  =>  $this->ativo,
            'email'  =>  $this->email,
            'nome'  =>  $this->nome,
            'id'  =>  $this->id,
            'dt_criacao'  =>  $this->dt_criacao,
            'dt_alteracao'  =>  $this->dt_alteracao,
            'senha'  =>  $this->senha,
            'token'  =>  $this->token,
        ];

        return $retorno;
    }

  
}

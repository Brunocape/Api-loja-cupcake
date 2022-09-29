<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CupomModel extends Model
 {
   /*propriedades da classe*/

   public $usuario_id;
   public $usado;
   public $percentual;
   public $descricao;
   public $id;
     use HasFactory;



   /*funcao Salvar*/
   public function Salvar()
   {
          $this->id = DB::table('cupons')->insertGetId(
              [
                      'percentual' => $this->percentual,
                      'descricao' => $this->descricao,
              ]);
    }


   /*funcao atualizar*/
   public function Atualizar()
   {
          DB::update("update cupons set 
                    usuario_id = {$this->usuario_id},
                    usado = {$this->usado},
                    percentual = {$this->percentual},
                    descricao = '{$this->descricao}'
                     where 
                    id = ?"
                    ,[
                    $this->id
                    ]);
     }

   /*funcao Apagar*/
   public function Apagar()
   {
          DB::Delete('delete from usuarios
                     where 
                    id = ?'
                    ,[
                    $this->id
                    ]);
   }


   /*funcao getbyid*/
   public function GetByDesc($desc)
   {

      return    DB::select("select * from cupons
              Where descricao = ? ",
              [$desc]);

   }

  public function ToArray()
    {
        $retorno = [
                      'usuario_id' => $this->usuario_id,
                      'usado' => $this->usado,
                      'percentual' => $this->percentual,
                      'descricao' => $this->descricao,
                      'id' => $this->id,
        ];

        return $retorno;
    }



   /*funcao fromRequest*/
    public function FromRequest(Request $request)
    {
       if ($request->idCupom != null || $request->idCupom != "") {
            $this->id = $request->idCupom;
        }
             $this->percentual = $request->percentualCupom;
             $this->descricao = $request->descricaoCupom;
    }

   public function GetAll()
   {
      return  DB::select("select * from cupons");
   }
}

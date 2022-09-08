<?php

//php artisan make:model CategoriaModel

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoriaModel extends Model
 {
   /*propriedades da classe*/

   public $peso;
   public $icon;
   public $descricao;
   public $id;
     use HasFactory;



   /*funcao Salvar*/
   public function Salvar()
   {
          $this->id = DB::table('Categorias')->insertGetId(
              [
                      'peso' => $this->peso,
                      'icon' => $this->icon,
                      'descricao' => $this->descricao,
              ]);
    }


   /*funcao atualizar*/
   public function Atualizar()
   {
          DB::update("update Categorias set 
                    peso = {$this->peso}
                    icon = {$this->icon},
                    descricao = {$this->descricao},
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
   public function GetById($id)
   {
      return    DB::select("select * from Categorias
              Where id = ?",
              [$id]);
   }

  public function ToArray()
    {
        $retorno = [
                      'peso' => $this->peso,
                      'icon' => $this->icon,
                      'descricao' => $this->descricao,
                      'id' => $this->id,
        ];

        return $retorno;
    }



   /*funcao fromRequest*/
    public function FromRequest(Request $request)
    {
       if ($request->idCategoria != null || $request->idCategoria != "") {
            $this->id = $request->idCategoria;
        }
             $this->peso = $request->pesoCategoria;
             $this->icon = $request->iconCategoria;
             $this->descricao = $request->descricaoCategoria;
    }

   public function GetAll()
   {
      return  DB::select("select * from Categorias");
   }
}

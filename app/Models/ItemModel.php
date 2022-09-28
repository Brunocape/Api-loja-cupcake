<?php

//php artisan make:model ItemModel

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ItemModel extends Model
 {
   /*propriedades da classe*/

   public $categoria_id;
   public $tipo;
   public $perco;
   public $descricao;
   public $id;
   public $imagens;
     use HasFactory;



   /*funcao Salvar*/
   public function Salvar()
   {
          $this->id = DB::table('Itens')->insertGetId(
              [
                      'categoria_id' => $this->categoria_id,
                      'tipo' => $this->tipo,
                      'perco' => $this->perco,
                      'descricao' => $this->descricao,
              ]);
    }


   /*funcao atualizar*/
   public function Atualizar()
   {
          DB::update("update Itens set 
                    categoria_id = {$this->categoria_id}
                    tipo = {$this->tipo},
                    perco = {$this->perco},
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
    $item = DB::select("select * from Itens
              Where id = ?",
              [$id]);
      $imagem = new ImagemModel();
      $item[0]->imagens = $imagem->GetByItemId($item[0]->id);
      return $item[0];        
   }

  public function ToArray()
    {
        $retorno = [
                      'categoria_id' => $this->categoria_id,
                      'tipo' => $this->tipo,
                      'perco' => $this->perco,
                      'descricao' => $this->descricao,
                      'id' => $this->id,
        ];

        return $retorno;
    }



   /*funcao fromRequest*/
    public function FromRequest(Request $request)
    {
       if ($request->idItem != null || $request->idItem != "") {
            $this->id = $request->idItem;
        }
             $this->categoria_id = $request->categoria_idItem;
             $this->tipo = $request->tipoItem;
             $this->perco = $request->percoItem;
             $this->descricao = $request->descricaoItem;
    }

   public function GetBayCat($cat_id)
   {
      $itens =  DB::select("select * from Itens where categoria_id = ?",[$cat_id]);
      $imagem = new ImagemModel();
      foreach($itens as $item){
        $item->imagens = $imagem->GetByItemId($item->id);
      }

      return $itens;
   }
}

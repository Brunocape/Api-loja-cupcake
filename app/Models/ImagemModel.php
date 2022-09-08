<?php

//php artisan make:model ImagemModel

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ImagemModel extends Model
 {
   /*propriedades da classe*/

   public $item_id;
   public $path;
   public $id;
     use HasFactory;



   /*funcao Salvar*/
   public function Salvar()
   {
          $this->id = DB::table('imagens')->insertGetId(
              [
                      'item_id' => $this->item_id,
                      'path' => $this->path,
              ]);
    }


   /*funcao atualizar*/
   public function Atualizar()
   {
          DB::update("update imagens set 
                    item_id = {$this->item_id}
                    path = {$this->path},
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
    return   DB::select("select * from imagens
              Where id = ?",
              [$id]);
   }

  public function ToArray()
    {
        $retorno = [
                      'item_id' => $this->item_id,
                      'path' => $this->path,
                      'id' => $this->id,
        ];

        return $retorno;
    }



   /*funcao fromRequest*/
    public function FromRequest(Request $request)
    {
       if ($request->idImagem != null || $request->idImagem != "") {
            $this->id = $request->idImagem;
        }
             $this->item_id = $request->item_idImagem;
             $this->path = $request->pathImagem;
    }

   public function GetByItemId($item_id)
   {
      return  DB::select("select * from imagens where item_id = ?",[$item_id]);
   }
}

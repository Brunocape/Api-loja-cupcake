<?php

//php artisan make:model ItemCarinhoModel

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ItemCarinhoModel extends Model
 {
   /*propriedades da classe*/

   public $id;
   public $dt_alteracao;
   public $qtde;
   public $usuario_id;
   public $item_id;
   public $item;
     use HasFactory;



   /*funcao Salvar*/
   public function Salvar()
   {
          $this->id = DB::table('itens_carinho')->insertGetId(
              [
                      'dt_alteracao' => $this->dt_alteracao,
                      'qtde' => $this->qtde,
                      'usuario_id' => $this->usuario_id,
                      'item_id' => $this->item_id,
              ]);
    }


   /*funcao atualizar*/
   public function Atualizar()
   {
          DB::update("update itens_carinho set 
                    dt_alteracao = {$this->dt_alteracao},
                    qtde = {$this->qtde},
                    usuario_id = {$this->usuario_id},
                    item_id = {$this->item_id},
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

   public function GetByUserId($User_id)
   {
      $itens_car =     DB::select("select * from itens_carinho
              Where usuario_id = ?",
              [$User_id]);
        $itemModel = new ItemModel();      
        foreach($itens_car as $item_car){
         $item_car->item = $itemModel->GetById($item_car->item_id);
        }
    return  $itens_car;  
   }


   /*funcao getbyid*/
   public function GetById($id)
   {
      $dados =     DB::select("select * from itens_carinho
              Where id = ?",
              [$id]);
          if(count($dados)>0){
              $this->id = $dados[0]['id'];
              $this->dt_alteracao = $dados[0]['dt_alteracao'];
              $this->qtde = $dados[0]['qtde'];
              $this->usuario_id = $dados[0]['usuario_id'];
              $this->item_id = $dados[0]['item_id'];
          }
   }

  public function ToArray()
    {
        $retorno = [
                      'id' => $this->id,
                      'dt_alteracao' => $this->dt_alteracao,
                      'qtde' => $this->qtde,
                      'usuario_id' => $this->usuario_id,
                      'item_id' => $this->item_id,
        ];

        return $retorno;
    }



   /*funcao fromRequest*/
    public function FromRequest(Request $request)
    {
       if ($request->idItemCarinho != null || $request->idItemCarinho != "") {
            $this->id = $request->idItemCarinho;
        }
             $this->qtde = $request->qtdeItemCarinho;
             $this->usuario_id = $request->usuario_idItemCarinho;
             $this->item_id = $request->item_idItemCarinho;
    }

   public function GetAll()
   {
      return  DB::select("select * from itens_carinho");
   }
}

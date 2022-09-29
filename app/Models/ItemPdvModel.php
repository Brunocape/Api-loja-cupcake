<?php

//php artisan make:model ItemPdvModel

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ItemPdvModel extends Model
 {
   /*propriedades da classe*/

   public $dt_insercao;
   public $vlr_liquido;
   public $vlr_desconto;
   public $item_id;
   public $vlr_total;
   public $vlr_unit;
   public $qtde;
   public $pdv_id;
   public $id;
     use HasFactory;



   /*funcao Salvar*/
   public function Salvar()
   {
          $this->id = DB::table('itens_pdv')->insertGetId(
              [
                      'vlr_liquido' => $this->vlr_liquido,
                      'vlr_desconto' => $this->vlr_desconto,
                      'vlr_total' => $this->vlr_total,
                      'item_id' => $this->item_id,
                      'vlr_unit' => $this->vlr_unit,
                      'qtde' => $this->qtde,
                      'pdv_id' => $this->pdv_id,
              ]);
    }


   /*funcao atualizar*/
   public function Atualizar()
   {
          DB::update("update itens_pdv set 
                    dt_insercao = {$this->dt_insercao}
                    vlr_liquido = {$this->vlr_liquido},
                    vlr_desconto = {$this->vlr_desconto},
                    item_id = {$this->item_id},
                    vlr_total = {$this->vlr_total},
                    vlr_unit = {$this->vlr_unit},
                    qtde = {$this->qtde},
                    pdv_id = {$this->pdv_id},
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
   public function GetByPdv_Id($pdv_id)
   {

      return    DB::select("select * from itens_pdv
              Where pdv_id = ?",
              [$pdv_id]);

   }

  public function ToArray()
    {
        $retorno = [
                      'dt_insercao' => $this->dt_insercao,
                      'vlr_liquido' => $this->vlr_liquido,
                      'vlr_desconto' => $this->vlr_desconto,
                      'item_id' => $this->item_id,
                      'vlr_total' => $this->vlr_total,
                      'vlr_unit' => $this->vlr_unit,
                      'qtde' => $this->qtde,
                      'pdv_id' => $this->pdv_id,
                      'id' => $this->id,
        ];

        return $retorno;
    }



   /*funcao fromRequest*/
    public function FromRequest($request)
    { 
       if ($request->id != null || $request->id != "") {
            $this->id = $request->id;
        }
             $this->vlr_liquido = $request->vlr_liquido;
             $this->vlr_desconto = $request->vlr_desconto;
             $this->vlr_total = $request->vlr_total;
             $this->item_id = $request->item_id;
             $this->vlr_unit = $request->vlr_unit;
             $this->qtde = $request->qtde;
    }

   public function GetAll()
   {
      return  DB::select("select * from itens_pdv");
   }
}



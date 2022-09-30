<?php

//php artisan make:model PedidoModel

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PedidoModel extends Model
 {
   /*propriedades da classe*/

   public $dt_alteracao;
   public $dt_insercao;
   public $status;
   public $vlr_bruto;
   public $vlr_liquido;
   public $perc_desconto;
   public $vlr_desconto;
   public $cupom_id;
   public $vlr_frete;
   public $cliente_id;
   public $id;
     use HasFactory;



   /*funcao Salvar*/
   public function Salvar($request)
   {
    $request = json_decode($request->input('pedido')); 
          $this->id = DB::table('pedidos')->insertGetId(
              [
                      'dt_alteracao' => $this->dt_alteracao,
                      'dt_insercao' => $this->dt_insercao,
                      'status' => $this->status,
                      'vlr_bruto' => $this->vlr_bruto,
                      'vlr_liquido' => $this->vlr_liquido,
                      'perc_desconto' => $this->perc_desconto,
                      'vlr_desconto' => $this->vlr_desconto,
                      'cupom_id' => $this->cupom_id,
                      'vlr_frete' => $this->vlr_frete,
                      'cliente_id' => $this->cliente_id,
              ]);
              
              for ($i = 0; $i < count($request->itens_pdv); $i++) {
                    $item_pdv = new ItemPdvModel();
                    $item_pdv->FromRequest($request->itens_pdv[$i]);
                    $item_pdv->pdv_id = $this->id;
                    $item_pdv->Salvar();
              } 

             $carrinho = DB::select("select * from itens_carinho where usuario_id = ?", [$this->cliente_id]);
             $itemCarrinho = new ItemCarinhoModel(); 
              foreach ($carrinho as $item) {
                $itemCarrinho->GetById($item->id);
                $itemCarrinho->Apagar();
              }
    }


   /*funcao atualizar*/
   public function Atualizar()
   {
          DB::update("update pedidos set 
                    dt_alteracao = {$this->dt_alteracao}
                    dt_insercao = {$this->dt_insercao},
                    status = {$this->status},
                    vlr_bruto = {$this->vlr_bruto},
                    vlr_liquido = {$this->vlr_liquido},
                    perc_desconto = {$this->perc_desconto},
                    vlr_desconto = {$this->vlr_desconto},
                    vlr_frete = {$this->vlr_frete},
                    cliente_id = {$this->cliente_id},
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
   public function GetByClienteId($cli_id)
   {

      $pdv =    DB::select("select * from pedidos
              Where cliente_id = ?",
              [$cli_id]);

       for ($p=0; $p < count($pdv); $p++) { 
        $item_pdv = new ItemPdvModel();
        $pdv[$p]->itens_pdv =  $item_pdv->GetByPdv_id($pdv[$p]->id);   
       }      
          
       return $pdv; 
   }

  public function ToArray()
    {
        $retorno = [
                      'dt_alteracao' => $this->dt_alteracao,
                      'dt_insercao' => $this->dt_insercao,
                      'status' => $this->status,
                      'vlr_bruto' => $this->vlr_bruto,
                      'vlr_liquido' => $this->vlr_liquido,
                      'perc_desconto' => $this->perc_desconto,
                      'vlr_desconto' => $this->vlr_desconto,
                      'vlr_frete' => $this->vlr_frete,
                      'cliente_id' => $this->cliente_id,
                      'id' => $this->id,
        ];

        return $retorno;
    }



   /*funcao fromRequest*/
    public function FromRequest(Request $request)
    {
        $request1 = json_decode($request->input('pedido')); 

       if ($request1->id != null || $request1->id!= "") {
            $this->id = $request1->id;
        }

        if($request1->cupomDiscont != null && $request1->cupomDiscont != ""){
            $cupom = new CupomModel();
            $c = ($cupom->GetByDesc($request1->cupomDiscont))[0];
            $cupom->id =$c->id;
            $cupom->usado = true;
            $cupom->usuario_id = $request1->cliente_id;
            $cupom->descricao =$c->descricao;
            $cupom->percentual =$c->percentual;
            $cupom->Atualizar();
            $this->cupom_id = $cupom->id;
        }
             $this->vlr_bruto = $request1->vlr_bruto;
             $this->vlr_liquido = $request1->vlr_liquido;
             $this->perc_desconto = $request1->perc_desconto;
             $this->vlr_desconto = $request1->vlr_desconto;
             $this->vlr_frete = $request1->vlr_frete;
             $this->cliente_id = $request1->cliente_id;
             $this->status = $request1->status;
    }

   public function GetAll()
   {
      return  DB::select("select * from pedidos");
   }


}



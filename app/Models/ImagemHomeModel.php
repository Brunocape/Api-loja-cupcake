<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ImagemHomeModel extends Model
 {
   /*propriedades da classe*/

   public $pos_y;
   public $pos_x;
   public $ordenacao;
   public $url;
   public $id;
     use HasFactory;



   /*funcao Salvar*/
   public function Salvar()
   {
          $this->id = DB::table('imagens_home')->insertGetId(
              [
                      'pos_y' => $this->pos_y,
                      'pos_x' => $this->pos_x,
                      'ordenacao' => $this->ordenacao,
                      'url' => $this->url,
              ]);
    }


   /*funcao atualizar*/
   public function Atualizar()
   {
          DB::update("update imagens_home set 
                    pos_y = {$this->pos_y}
                    pos_x = {$this->pos_x},
                    ordenacao = {$this->ordenacao},
                    url = {$this->url},
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
      $dados =     DB::select("select * from imagens_home
              Where id = ?",
              [$id]);
          if(count($dados)>0){
              $this->pos_y = $dados[0]['pos_y'];
              $this->pos_x = $dados[0]['pos_x'];
              $this->ordenacao = $dados[0]['ordenacao'];
              $this->url = $dados[0]['url'];
              $this->id = $dados[0]['id'];
          }
   }


   public function GetAll()
   {
      return  DB::select("select * from imagens_home order by ordenacao");
   }


  public function ToArray()
    {
        $retorno = [
                      'pos_y' => $this->pos_y,
                      'pos_x' => $this->pos_x,
                      'ordenacao' => $this->ordenacao,
                      'url' => $this->url,
                      'id' => $this->id,
        ];

        return $retorno;
    }



   /*funcao fromRequest*/
    public function FromRequest(Request $request)
    {
       if ($request->idImagemHome != null || $request->idImagemHome != "") {
            $this->id = $request->idImagemHome;
        }
             $this->pos_y = $request->pos_yImagemHome;
             $this->pos_x = $request->pos_xImagemHome;
             $this->ordenacao = $request->ordenacaoImagemHome;
             $this->url = $request->urlImagemHome;
    }
}




























<?php

namespace App\Model;
use Exception;
use PDO;
class Tablet
{
    private PDO $db;
        public function __construct($db){
        $this->db=$db;
    }
    //CRUD database
    public function showAll(){
            $tabletList=[];
    $query="SELECT * FROM tablet";
        try {
            $stmt=$this->db->prepare($query);
            $stmt->execute();
            while ($product=$stmt->fetch()){
                $tabletList[]=$product;
            }
            $stmt->closeCursor();
            return $tabletList;
        }catch (Exception $e){
            echo $e->getMessage();
            return null;
        }
    }
}
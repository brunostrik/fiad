<?php
    require_once "DB.php";

    class Categoria{
        public $id;
        public $nome;
        public $icone;
        
        function Insert(){

        }
        function Update(){

        }
        static function Delete($id){

        }
        static function Load($id){
            $sql = "SELECT * FROM categoria WHERE id = '$id' LIMIT 1";
            $res = DB::QueryOne($sql,"Categoria");
            return $res;
        }
        static function SelectAll(){
            $sql = "SELECT * FROM categoria";
            $res = DB::Query($sql,"Categoria");
            return $res;
        }
    }
?>
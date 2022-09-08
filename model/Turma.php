<?php
    require_once "DB.php";

    class Turma{
        public $turma;
        public $coordenador;
        public $email_coordenador;
        public $ano;
        
        function Insert(){

        }
        function Update(){

        }
        static function Delete($id){

        }
        static function Load($turma){
            $sql = "SELECT * FROM turma WHERE turma = '$turma' LIMIT 1";
            $res = DB::QueryOne($sql,"Turma");
            return $res;
        }
        static function SelectAtivas(){
            $sql = "SELECT * FROM turma WHERE ativo = '1'";
            $res = DB::Query($sql,"Turma");
            return $res;
        }
        static function SelectInativas(){
            $sql = "SELECT * FROM turma WHERE ativo = '0'";
            $res = DB::Query($sql,"Turma");
            return $res;
        }
    }
?>
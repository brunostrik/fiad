<?php
    require_once "DB.php";

    class Professor{
        public $siape;
        public $nome;
        public $area;
        public $email;
        public $senha;
        public $admin;

        function Insert(){

        }
        function Update(){

        }
        static function Delete($siape){

        }
        static function Load($siape){
            $sql = "SELECT * FROM professor WHERE siape = '$siape' LIMIT 1";
            $res = DB::QueryOne($sql,"Professor");
            return $res;
        }
        static function SelectAll(){
            $sql = "SELECT * FROM professor ORDER BY nome ASC";
            $res = DB::Query($sql,"Professor");
            return $res;
        }
        static function Login($email, $senha){
            $sql = "SELECT * FROM professor WHERE email = '$email' AND senha = '$senha' LIMIT 1";
            $res = DB::QueryOne($sql,"Professor");
            return $res;
        }
        static function Existe($email){
            $sql = "SELECT * FROM professor WHERE email = '$email' LIMIT 1";
            $res = DB::QueryOne($sql,"Professor");
            return $res;
        }
        static function SelectByEmail($email){
            $sql = "SELECT * FROM professor WHERE email = '$email' LIMIT 1";
            $res = DB::QueryOne($sql,"Professor");
            return $res;
        }
        static function TrocaSenha($siape, $novaSenhaMD5){
            $sql = "UPDATE professor SET senha = '$novaSenhaMD5' WHERE siape = '$siape'";
            $res = DB::NonQuery($sql);
            return $res;
        }
        static function ChecaSenha($siape, $senha){
            $sql = "SELECT * FROM professor WHERE siape = '$siape' AND senha = '$senha' LIMIT 1";
            $res = DB::QueryOne($sql,"Professor");
            return $res;
        }
    }

?>
<?php
    require_once "DB.php";

    class Reset{
        public $siape;
        public $matricula;
        public $email;
        public $chave;
        public $utilizado;
        public $quando;
    
        function Insert(){
            $sql = "INSERT INTO reset (siape, matricula, email, chave, utilizado) VALUES ('@1', '@2', '@3', '@4', '@5')";
            $sql = str_replace("@1", $this->siape, $sql);
            $sql = str_replace("@2", $this->matricula, $sql);
            $sql = str_replace("@3", $this->email, $sql);
            $sql = str_replace("@4", $this->chave, $sql);
            $sql = str_replace("@5", $this->utilizado, $sql);
            DB::NonQuery($sql);
        }

        static function SelectByChave($chave){
            $sql = "SELECT * FROM reset WHERE chave = '$chave' AND utilizado = '0'";
            $res = DB::QueryOne($sql,"Reset");
            return $res;
        }

        static function Queimar($chave){
            $sql = "DELETE FROM reset WHERE chave = '$chave'";
            DB::Delete($sql);
            return true;
        }
    }

?>
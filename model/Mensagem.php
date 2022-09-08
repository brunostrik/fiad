<?php
    require_once "DB.php";

    class Mensagem{
        public $id;
        public $data;
        public $aluno;
        public $professor;
        public $mensagem;
    
        function Insert(){
            $sql = "INSERT INTO mensagem (data, aluno, professor, mensagem) VALUES ('@1', '@2', '@3', '@4')";
            $sql = str_replace("@1", $this->data, $sql);
            $sql = str_replace("@2", $this->aluno, $sql);
            $sql = str_replace("@3", $this->professor, $sql);
            $sql = str_replace("@4", $this->mensagem, $sql);
            DB::NonQuery($sql);
        }
    }

?>
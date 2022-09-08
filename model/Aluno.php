<?php
    require_once "DB.php";

    class Aluno{
        public $matricula;
        public $nome;
        public $turma;
        public $email;
        public $senha;
        public $cidade;
        public $telefone;
        public $nascimento;
        public $pai;
        public $telefone_familiar;
        public $mãe;
        public $endereco;
        public $cpf;
        public $rg;
        public $origem;
        public $destino;

        function Insert(){

        }
        function Update(){

        }
        static function Delete($id){

        }
        static function Load($matricula){
            $sql = "SELECT * FROM aluno WHERE matricula = '$matricula' LIMIT 1";
            $res = DB::QueryOne($sql,"Aluno");
            return $res;
        }
        function SelectAll(){

        }
        static function SelectAllByTurma($turma){
            $sql = "SELECT * FROM aluno WHERE turma = '$turma' AND destino != 'SAIU' ORDER BY nome ASC";
            return DB::Query($sql,"Aluno");
        }
        static function Login($email, $senha){
            $sql = "SELECT * FROM aluno WHERE email = '$email' AND senha = '$senha' LIMIT 1";
            $res = DB::QueryOne($sql,"Aluno");
            return $res;
        }
        static function SelectByEmail($email){
            $sql = "SELECT * FROM aluno WHERE email = '$email' LIMIT 1";
            $res = DB::QueryOne($sql,"Aluno");
            return $res;
        }
        static function TrocaSenha($matricula, $novaSenhaMD5){
            $sql = "UPDATE aluno SET senha = '$novaSenhaMD5' WHERE matricula = '$matricula'";
            $res = DB::NonQuery($sql);
            return $res;
        }
        static function ChecaSenha($matricula, $senha){
            $sql = "SELECT * FROM aluno WHERE matricula = '$matricula' AND senha = '$senha' LIMIT 1";
            $res = DB::QueryOne($sql,"Aluno");
            return $res;
        }
    }

?>
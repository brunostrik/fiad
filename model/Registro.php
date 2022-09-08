<?php
    require_once "DB.php";

    class Registro{
        public $id;
        public $texto;
        public $professor;
        public $aluno;
        public $data;
        public $sigiloso;
		public $categoria;
		public $anexo;

        function Insert(){
            $sql = "INSERT INTO registro (texto, professor, aluno, data, sigiloso) VALUES ('@1','@2','@3','@4','@5')";
            $sql = str_replace("@1", $this->texto, $sql);
            $sql = str_replace("@2", $this->professor, $sql);           
            $sql = str_replace("@3", $this->aluno, $sql);
            $sql = str_replace("@4", $this->data, $sql);
            $sql = str_replace("@5", $this->sigiloso, $sql);
            $this->id = DB::NonQuery($sql);
            return $this->id;
        }
        
        function Update(){

        }
        static function Delete($id){
			$sql = "DELETE FROM registro WHERE id = '$id'";
			DB::Delete($sql);
        }
        static function Load($id){
            $sql = "SELECT * FROM registro WHERE id = '$id'";
            $res = DB::QueryOne($sql,"Registro");
            return $res;
        }
        function SelectAll(){

        }
        static function SelectByMatriculaAdmin($matricula){
            $sql = "SELECT * FROM registro WHERE aluno = '$matricula' AND sigiloso <= 1 ORDER BY data DESC";
            $res = DB::Query($sql,"Aluno");
            return $res;
        }
        static function SelectByMatriculaSuperAdmin($matricula){
            $sql = "SELECT * FROM registro WHERE aluno = '$matricula' ORDER BY data DESC";
            $res = DB::Query($sql,"Aluno");
            return $res;
        }
        static function SelectByMatricula($matricula){
            $sql = "SELECT * FROM registro WHERE aluno = '$matricula' AND sigiloso = '0' ORDER BY data DESC";
            $res = DB::Query($sql,"Aluno");
            return $res;
        }
        static function SelectNormalByMatricula($matricula){ //provavelmente duplicado
            $sql = "SELECT * FROM registro WHERE aluno = '$matricula' AND sigiloso = '0' ORDER BY data DESC";
            $res = DB::Query($sql,"Aluno");
            return $res;
        }
        static function CountByMatricula($matricula){          
            $sql = "SELECT COUNT(id) as total FROM registro WHERE aluno = '$matricula'";
            $res = DB::QueryOneAnonymous($sql);
            return $res;
        }
    }

?>
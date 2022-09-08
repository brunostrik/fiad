<?php
    require_once "DB.php";

    class Encaminhamento{
        public $id;
        public $registro;
        public $data;
        public $remetente;
        public $destinatario;
        public $resolvido;
        public $assunto;

        function Insert(){
            $sql = "INSERT INTO encaminhamento (registro, data, remetente, destinatario, resolvido, assunto) VALUES ('@1', '@2', '@3', '@4', '@5', '@6')";
            $sql = str_replace("@1", $this->registro, $sql);
            $sql = str_replace("@2", $this->data, $sql);
            $sql = str_replace("@3", $this->remetente, $sql);
            $sql = str_replace("@4", $this->destinatario, $sql);
            $sql = str_replace("@5", $this->resolvido, $sql);
            $sql = str_replace("@6", $this->assunto, $sql);
            DB::NonQuery($sql);
        }
        function Update(){

        }
        static function Delete($id){

        }
        static function Load($id){
            $sql = "SELECT * FROM encaminhamento WHERE id = '$id'";
            $res = DB::QueryOne($sql,"Encaminhamento");
            return $res;
        }
        function SelectAll(){

        }
        static function SelectByRegistro($idRegistro){
            $sql = "SELECT * FROM encaminhamento WHERE registro = '$idRegistro' ORDER BY data ASC";
            $res = DB::Query($sql,"Encaminhamento");
            return $res;
        }
        static function SelectRecebidosDTO($siapeProf){
            $sql = "SELECT
                    e.id AS idEncaminhamento,
                    e.data AS dataEncaminhamento,
                    rem.siape AS siapeRemetente, 
                    rem.nome AS nomeRemetente,
                    des.siape AS siapeDestinatario,
                    des.nome AS nomeDestinatario,
                    e.assunto AS assunto,
                    r.id AS idRegistro,
                    r.data AS dataRegistro,
                    a.matricula AS matriculaAluno,
                    a.nome AS nomeAluno,
                    e.resolvido AS resolvido
                FROM
                    encaminhamento e
                    JOIN professor rem ON e.remetente = rem.siape
                    JOIN professor des ON e.destinatario = des.siape
                    JOIN registro r ON e.registro = r.id
                    JOIN aluno a ON r.aluno = a.matricula
                WHERE
                    e.destinatario = '$siapeProf' AND
                    e.resolvido = 0
                ORDER BY
                    e.data DESC 
                    ";
            $res = DB::QueryAnonymous($sql);
            return $res;
        }
        static function SelectEnviadosDTO($siapeProf){
            $sql = "SELECT
                    e.id AS idEncaminhamento,
                    e.data AS dataEncaminhamento,
                    rem.siape AS siapeRemetente, 
                    rem.nome AS nomeRemetente,
                    des.siape AS siapeDestinatario,
                    des.nome AS nomeDestinatario,
                    e.assunto AS assunto,
                    r.id AS idRegistro,
                    r.data AS dataRegistro,
                    a.matricula AS matriculaAluno,
                    a.nome AS nomeAluno,
                    e.resolvido AS resolvido
                FROM
                    encaminhamento e
                    JOIN professor rem ON e.remetente = rem.siape
                    JOIN professor des ON e.destinatario = des.siape
                    JOIN registro r ON e.registro = r.id
                    JOIN aluno a ON r.aluno = a.matricula
                WHERE
                    e.remetente = '$siapeProf' AND
                    e.resolvido = 0
                ORDER BY
                    e.data DESC 
                    ";
            $res = DB::QueryAnonymous($sql);
            return $res;
        }
        static function SelectDTOByRegistro($idRegistro){
            $sql = "SELECT
                        e.id As idEncaminhamento,
                        e.registro As idRegistro,
                        e.data AS data,
                        e.remetente AS idRemetente,
                        r.nome AS nomeRemetente,
                        e.destinatario AS idDestinatario,
                        d.nome AS nomeDestinatario,
                        e.resolvido AS resolvido,
                        e.assunto AS assunto
                    FROM
                        encaminhamento e
                        JOIN professor r ON r.siape = e.remetente
                        JOIN professor d ON d.siape = e.destinatario
                    WHERE
                        e.registro = '$idRegistro'
                    ORDER BY    
                        e.data DESC";
            $res = DB::QueryAnonymous($sql);
            return $res;
        }
        function Resolver(){
            $sql = "UPDATE encaminhamento SET resolvido = '1' WHERE id = '$this->id'";
            DB::NonQuery($sql);
        }
    }

?>
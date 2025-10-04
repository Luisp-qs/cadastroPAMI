<?php
class Aluno{
    private $LuisId;
    private $LuisRm;
    private $LuisNome;
    private $LuisEmail;
    private $LuisCpf;
    private $LuisPdo;

    public function conectar(){
        $dns    = "mysql:dbname=EtimPwiiAluno;host=localhost";
        $dbUser = "root";
        $dbPass = "";

        try {
            $this->LuisPdo = new PDO($dns, $dbUser, $dbPass);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getId(){
        return $this->LuisId;
    }
    public function getRm(){
        return $this->LuisRm;
    }
    public function getNome(){
        return $this->LuisNome;
    }
    public function getEmail(){
        return $this->LuisEmail;
    }
    public function getCpf(){
        return $this->LuisCpf;
    }

    public function setRm($rm){
        $this->LuisRm = $rm ;
    }
    public function setNome($nome){
        $this->LuisNome = $nome ;
    }
    public function setEmail($email){
        $this->LuisEmail = $email ;
    }
    public function setCpf($cpf){
        $this->LuisCpf = $cpf ;
    }

    public function cadastrar($rm, $nome, $email, $cpf){

        $sql = "INSERT INTO aluno set rm = :r, nome = :n, email = :e, cpf = :c";
        
        $sql = $this->LuisPdo->prepare($sql);

        $sql-> bindValue(":r", $rm);
        $sql-> bindValue(":n", $nome);
        $sql-> bindValue(":e", $email);
        $sql-> bindValue(":c", $cpf);

        return $sql->execute();
    }

    public function consultar($email){
        $sql = "SELECT * FROM aluno WHERE email = :e";
        $sql = $this->LuisPdo->prepare($sql);
        $sql-> bindValue(":e", $email);
        $sql->execute();

        return $sql->rowCount() > 0;
        
    }

}


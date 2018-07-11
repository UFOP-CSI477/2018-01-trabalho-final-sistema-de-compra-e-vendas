<?php

namespace controller;

use model\Usuario;
use model\Database;

class UsuarioController
{
    protected $db = null;

    public function __construct()
    {
        $this->db = Database::getInstance()->getDB();
    }

    public function add($user)
    {
        $sql = "INSERT INTO usuarios(id_tipo_endereco,id_estado,email,nome,sobrenome,sexo,nascimento,cpf,cep,nome_rua,numero,complemento,bairro,cidade,ponto_referencia,telefone1,telefone2,password,created_at) VALUES (:id_tipo_endereco,:id_estado,:email,:nome,:sobrenome,:sexo,:nascimento,:cpf,:cep,:nome_rua,:numero,:complemento,:bairro,:cidade,:ponto_referencia,:telefone1,:telefone2,:password,NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_tipo_endereco',$user->tipo_endereco );
        $stmt->bindParam(':id_estado',$user->id_estado);
        $stmt->bindParam(':email',$user->email);
        $stmt->bindParam(':nome',$user->nome);
        $stmt->bindParam(':sobrenome',$user->sobrenome);
        $stmt->bindParam(':sexo',$user->sexo);
        $stmt->bindParam(':nascimento',$user->nascimento);
        $stmt->bindParam(':cpf',$user->cpf);
        $stmt->bindParam(':cep',$user->cep);
        $stmt->bindParam(':nome_rua',$user->nome_rua);
        $stmt->bindParam(':numero',$user->numero);
        $stmt->bindParam(':complemento',$user->complemento);
        $stmt->bindParam(':bairro',$user->bairro);
        $stmt->bindParam(':cidade',$user->cidade);
        $stmt->bindParam(':ponto_referencia',$user->ponto_referencia);
        $stmt->bindParam(':telefone1',$user->telefone1);
        $stmt->bindParam(':telefone2',$user->telefone2);
        $stmt->bindParam(':password',$user->password);
        $result = $stmt->execute();
        if($result) return true;
        else return false;
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if(count($result) > 0)
        {
            foreach($result as $row)
            {
                return $row;
            }
        }else return null;
    }

}
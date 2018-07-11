<?php

namespace controller;

use model\Database;
use model\Pergunta;

class PerguntaController
{
    protected $db = null;

    public function __construct()
    {
        $this->db = Database::getInstance()->getDB();
    }

    public function add($post)
    {
        $sql = "INSERT INTO perguntas (id_produto, id_cliente, pergunta, created_at) VALUES (:id_produto,:id_cliente,:pergunta,NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_produto',$post['id_produto']);
        $stmt->bindParam(':id_cliente',$post['id_cliente']);
        $stmt->bindParam(':pergunta',$post['pergunta']);
        $result = $stmt->execute();
        if($result)
            return true;
        else return false;
    }

    public function responderComentario($id_pergunta,$resposta)
    {
        $sql = "UPDATE perguntas SET resposta = :resposta WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':resposta',$resposta);
        $stmt->bindParam(':id',$id_pergunta);
        $result = $stmt->execute();
        if($result)
        {
            return true;
        }else return false;
    }

    public function getAll($id_produto)
    {
        $sql = "SELECT * FROM perguntas WHERE id_produto = :id_produto";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_produto',$id_produto);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if(count($result) > 0)
        {
            return $result;
        }else return null;
    }
}
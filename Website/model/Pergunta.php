<?php

namespace model;

use model\Database;

class Pergunta
{
    protected $db = null;
    private $id_produto;
    private $id_cliente;
    private $pergunta;
    private $resposta;

    public function __construct()
    {
        $this->db = Database::getInstance()->getDB();
    }

    public function getIdProduto()
    {
        return $this->id_produto;
    }

    public function setIdProduto($id_produto)
    {
        $this->id_produto = $id_produto;
    }

    public function getIdCliente()
    {
        return $this->id_cliente;
    }

    public function setIdCliente($id_cliente)
    {
        $this->id_cliente = $id_cliente;
    }

    public function getPergunta()
    {
        return $this->pergunta;
    }

    public function setPergunta($pergunta)
    {
        $this->pergunta = $pergunta;
    }

    public function getResposta()
    {
        return $this->resposta;
    }

    public function setResposta($resposta)
    {
        $this->resposta = $resposta;
    }


}
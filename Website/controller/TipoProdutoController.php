<?php

namespace controller;

use model\Database;
use model\TipoProduto;

class TipoProdutoController
{
    protected $db = null;

    public function __construct()
    {
        $this->db = Database::getInstance()->getDB();
    }

    public function getAll($categoria)
    {
        $sql = "SELECT * FROM tipos_produto WHERE categoria = :categoria ORDER BY tipo ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':categoria',$categoria);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if(count($result) > 0)
        {
            return $result;
        }else return null;
    }
}
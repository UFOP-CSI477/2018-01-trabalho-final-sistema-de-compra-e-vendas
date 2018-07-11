<?php

namespace controller;

use model\Database;
use model\Estado;

class EstadoController
{
    protected $db = null;

    public function __construct()
    {
        $this->db = Database::getInstance()->getDB();
    }

    public function add($estado)
    {
        $sql = "INSERT INTO estados(sigla,nome,created_at) FROM estados VALUES (:sigla,:nome,NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':sigla',$estado->getSigla());
        $stmt->bindParam(':estado',$estado->getEstado());
        $result = $stmt->execute();

        if($result) return true;
        else return false;
    }

    public function remove($id)
    {
        $sql = "REMOVE FROM 'estados' WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id',$id);
        $result = $stmt->execute();
        if ($result) return true;
        else return false;
    }

    public function get($id)
    {
      $sql = "SELECT * FROM estados WHERE id = :id";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(':id',$id);
      $stmt->execute();
      $result = $stmt->fetchAll();

      if(count($result) > 0)
          foreach($result as $row)
          {
              return $row;
          }

      return null;
    }

    public function getAll()
    {
        $sql = "SELECT *FROM estados";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0) return $result;
        else return null;
    }

    public function showAll()
    {
        $estados = $this->getAll();

    }

    public function getEstado($id)
    {
        $sql = "SELECT * FROM estados WHERE id = :id";
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

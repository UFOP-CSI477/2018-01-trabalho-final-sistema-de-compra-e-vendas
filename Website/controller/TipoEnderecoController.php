<?php

namespace controller;

use model\Database;
use model\TipoEndereco;

class TipoEnderecoController
{
  protected $db = null;

  public function __construct()
  {
    $this->db = Database::getInstance()->getDB();
  }
  
  public function getAll()
  {
    $sql = "SELECT * FROM tipos_endereco";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if(count($result) > 0) return $result;
    else return null;
  }
}

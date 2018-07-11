<?php

namespace model;

class Estado
{
    private $id;
    private $sigla;
    private $nome;
    private $created_at;
    private $updated_at;

    public function __construct()
    {
        $this->id = null;
        $this->sigla = null;
        $this->nome = null;
        $this->created_at = null;
        $this->updated_at = null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getSigla()
    {
      return $this->sigla;
    }

    public function setSigla($sigla)
    {
      $this->sigla = $sigla;
    }

    public function setCreatedAt($created_at)
    {
      $this->created_at = $created_at;
    }

    public function getCreatedAt()
    {
      return $this->created_at;
    }

    public function setUpdatedAt($updated_at)
    {
      $this->updated_at = $updated_at;
    }

    public function getUpdatedAt()
    {
      return $this->updated_at;
    }

}

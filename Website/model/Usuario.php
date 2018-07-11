<?php

namespace model;

use model\Database;
use PDO;

class Usuario
{
  private $id;
  public $tipo_endereco;
  public $id_estado;
  public $email;
  public $nome;
  public $sobrenome;
  public $sexo;
  public $nascimento;
  public $cpf;
  public $cep;
  public $nome_rua;
  public $numero;
  public $complemento;
  public $bairro;
  public $cidade;
  public $ponto_referencia;
  public $telefone1;
  public $telefone2;
  public $password;

    public function __construct()
    {
        $this->id = null;
        $this->tipo_endereco = null;
        $this->id_estado = null;
        $this->email = null;
        $this->nome = null;
        $this->sobrenome = null;
        $this->sexo = null;
        $this->nascimento = null;
        $this->cpf = null;
        $this->cep = null;
        $this->nome_rua = null;
        $this->numero = null;
        $this->complemento = null;
        $this->bairro = null;
        $this->cidade = null;
        $this->ponto_referencia = null;
        $this->telefone1 = null;
        $this->telefone2 = null;
        $this->password = null;
    }

    public function getID()
    {
      return $this->id;
    }

    public function setID($id)
    {
      $this->id = $id;
    }

    public function getTipoEndereco()
    {
      return $this->tipo_endereco;
    }

    public function setTipoEndereco($tipo_endereco)
    {
      $this->tipo_endereco = $tipo_endereco;
    }

    public function getIdEstado()
    {
        return $this->id_estado;
    }

    public function setIdEstado($id_estado)
    {
        $this->id_estado = $id_estado;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    public function setSobrenome($sobrenome)
    {
        $this->sobrenome = $sobrenome;
    }

    public function getSexo()
    {
        return $this->sexo;
    }

    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    public function getNascimento()
    {
        return $this->nascimento;
    }

    public function setNascimento($nascimento)
    {
        $this->nascimento = $nascimento;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    public function getNomeRua()
    {
        return $this->nome_rua;
    }

    public function setNomeRua($nome_rua)
    {
        $this->nome_rua = $nome_rua;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function getComplemento()
    {
        return $this->complemento;
    }

    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    public function getPontoReferencia()
    {
        return $this->ponto_referencia;
    }

    public function setPontoReferencia($ponto_referencia)
    {
        $this->ponto_referencia = $ponto_referencia;
    }

    public function getTelefone1()
    {
        return $this->telefone1;
    }

    public function setTelefone1($telefone1)
    {
        $this->telefone1 = $telefone1;
    }

    public function getTelefone2()
    {
        return $this->telefone2;
    }

    public function setTelefone2($telefone2)
    {
        $this->telefone2 = $telefone2;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }


}

 ?>

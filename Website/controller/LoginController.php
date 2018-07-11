<?php

namespace controller;

include_once ('model/Database.php');

use model\Database;

class LoginController
{
    protected $db = null;

    public function __construct()
    {
        $this->db = Database::getInstance()->getDB();
    }

    public function login($email,$password)
    {
        session_start();
        if(!isset($_SESSION['email']))
        {
            $sql = "SELECT id,nome,sobrenome,email,password FROM usuarios WHERE email = '".$email."' AND password = '".$password."'";
            $result = $this->db->query($sql);

            if(count($result) == 1)
            {
                foreach($result as $row)
                {
                    session_start();
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['nome'] = $row['nome'];
                    $_SESSION['id'] =  $row['id'];
                    return true;
                }
            }
            else return false;
        }else return false;
    }

    public function logout()
    {
        if(isset($_SESSION['email']))
        {
            session_unset();
            session_destroy();
            echo "<script>alert('Deslogado com sucesso!')</script>";
        }
    }

    public function isLogged()
    {
        if(isset($_SESSION['email']))
        {
            return true;
        }else false;
    }

    public function viewEntrar()
    {
        include_once('view/auth/entrar.php');
    }

    public function viewCadastrar()
    {
        include_once('view/auth/cadastrar.php');
    }
}
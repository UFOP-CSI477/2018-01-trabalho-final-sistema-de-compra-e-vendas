<?php

namespace controller;

use model\Database;
use model\Produto;

class ProdutoController
{
    protected $db = null;

    public function __construct()
    {
        $this->db = Database::getInstance()->getDB();
    }

    public function add($post)
    {
        session_start();

        if(!isset($post['quantidade']))
        {
            $sql = "INSERT INTO produtos (id_vendedor,id_tipo_produto,nome,descricao,parcelas,desconto,preco,created_at) VALUES (:id_vendedor,:id_tipo_produto,:nome,:descricao,:parcelas,:desconto,:preco,NOW())";
        }else
        {
            $sql = "INSERT INTO produtos (id_vendedor,id_tipo_produto,nome,descricao,parcelas,desconto,preco,quantidade,created_at) VALUES (:id_vendedor,:id_tipo_produto,:nome,:descricao,:parcelas,:desconto,:preco,:quantidade,NOW())";
        }

        if(strcmp($post['accparcelas'],"nao")== 0) $post['parcelas'] = 0;
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_vendedor',$_SESSION['id']);
        $stmt->bindParam(':id_tipo_produto',$post['id_tipo_produto']);
        $stmt->bindParam(':nome',$post['nome']);
        $stmt->bindParam(':descricao',$post['descricao']);
        $stmt->bindParam(':parcelas',$post['parcelas']);
        $stmt->bindParam(':desconto',$post['desconto']);
        $stmt->bindParam(':preco',$post['preco']);
         if(isset($post['quantidade']))
         {
             $stmt->bindParam(':quantidade', $post['quantidade']);
         }

        $result = $stmt->execute();
        if($result) return true;
        else return false;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM produtos";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0)
            return $result;
        else return null;
    }

    public function listarVendas()
    {
        $rows = $this->getAll();
        include_once('view/listar/produtos.php');
    }

    public function validarPhotos($fotos)
    {
        if(count($fotos['name']) < 0 || count($fotos['name']) > 10)
            return false;

        $name     = $fotos['name'];
        $tmp_name = $fotos['tmp_name'];
        $sizes    = $fotos['size'];
        $maxSize = 1024*1024*2;

        $allowedExts = array(".gif", ".jpeg", ".jpg", ".png", ".bmp");
        for($i = 0; $i < count($fotos['name']); $i++)
        {
            $ext = strtolower(substr($name[$i],-4));
            if(!in_array($ext,$allowedExts))
                return false;

            if($maxSize < $sizes[$i])
                return false;
        }

        return true;
    }

    public function insertPhoto($fotos)
    {
        if(!$this->validarPhotos($fotos))
            return false;

        $sql = "SELECT MAX(id) FROM produtos";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();

        $id_produto = $result[0]['MAX(id)'];

        $name     = $fotos['name'];
        date_default_timezone_set('America/Sao_Paulo');

        $dir = "storage/";

        if(!file_exists($dir))
            mkdir($dir,777);

        $dir = $dir . $_SESSION['id'] . '/';

        if(!file_exists($dir))
            mkdir($dir,777);

        $dir = $dir . $id_produto . '/';

        if(!file_exists($dir))
            mkdir($dir,777);

        for($i = 0; $i < count($fotos['name']); $i++)
        {
            $ext = strtolower(substr($name[$i],-4));

            $new_name = date("Y.m.d-H.i.s") . "-" . $i . $ext;
            $destino = $dir . "/" . $new_name;

            move_uploaded_file($fotos['tmp_name'][$i], $destino);
        }

        return true;
    }

    public function addVenda()
    {
        if($this->validarPhotos($_FILES['image']))
        {
            if ($this->add($_POST))
            {
                $this->insertPhoto($_FILES['image']); // adiciona as imagens ao banco de dados
                return true;
            }
        }
        return false;
    }

    public function getFotos($id_produto,$id_vendedor)
    {
        $path = "storage\\". $id_vendedor . '\\' . $id_produto. '\\';
        $url_imgs = array();
        if(is_dir($path))
        {
            $dir = dir($path);
            $img = glob($path."*.{gif,jpeg,jpg,png,bmp}", GLOB_BRACE);

            foreach ($img as $img)
            {
                array_push($url_imgs,$img);
            }

            $dir->close();
        }
        return $url_imgs;
    }

    public function getProdutoByID($id)
    {
        $produtos = $this->getAll();
        foreach ($produtos as $row)
        {
            if($row['id'] == $id)
                return $row;
        }

        return null;
    }

    public function viewDescricao($id)
    {
        $perguntaController = new PerguntaController();
        $userController = new UsuarioController();
        $produto = $this->getProdutoByID($id);
        $vendedor = $userController->getById($produto['id_vendedor']);
        $perguntas = $perguntaController->getAll($id);
        $fotos_url = $this->getFotos($id,$produto['id_vendedor']);
        include_once ('view/vendas/descricao.php');
    }

    public function getByQuery($query)
    {
        $sql = "SELECT * FROM produtos WHERE nome LIKE '%". $query."%'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0)
            return $result;
        else return null;
    }
}

?>



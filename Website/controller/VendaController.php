<?php

namespace controller;

use model\Database;

class VendaController
{
    protected $db = null;

    public function __construct()
    {
        $this->db = Database::getInstance()->getDB();
    }

    public function viewEscolherTipoAnuncio()
    {
        include_once('view/vendas/tipoAnuncio.php');
    }

    public function addCarrinho($post)
    {
        $produtoController = new ProdutoController();
        $produto = $produtoController->getProdutoByID($post['id_produto']);
        $qtd = $this->getProductCountCart($post['id_cliente'],$post['id_vendedor'],$post['id_produto']);

        if($qtd > 0)
        {
            $novaQtd = $qtd+$post['quantidade'];
            if($novaQtd > $produto['quantidade']) return false;
            $sql = "UPDATE vendas SET quantidade = :quantidade, updated_at = NOW() WHERE (id_cliente = :id_cliente) AND (id_vendedor = :id_vendedor) AND (id_produto = :id_produto)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':quantidade',$novaQtd);
            $stmt->bindParam(':id_cliente',$post['id_cliente']);
            $stmt->bindParam(':id_vendedor',$post['id_vendedor']);
            $stmt->bindParam(':id_produto',$post['id_produto']);
            $result = $stmt->execute();
            if($result) {
                return true;
            }
            return false;
        }else
        {
            $sql = "INSERT INTO vendas (id_vendedor,id_cliente,id_produto,status,quantidade,created_at) VALUES (:id_vendedor,:id_cliente,:id_produto,:status,:quantidade,NOW())";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_vendedor',$post['id_vendedor']);
            $stmt->bindParam(':id_cliente',$post['id_cliente']);
            $stmt->bindParam(':id_produto',$post['id_produto']);
            $stmt->bindParam(':status',$post['status']);
            $stmt->bindParam(':quantidade',$post['quantidade']);
            $result = $stmt->execute();
            if($result) {
                return true;
            }
            return false;
        }


    }

    public function removeCarrinho($id_produto,$id_cliente)
    {
        $sql = "UPDATE vendas SET status = 'CA' WHERE (id_cliente = :id_cliente) AND (id_produto = :id_produto)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_cliente',$id_cliente);
        $stmt->bindParam(':id_produto',$id_produto);
        $result = $stmt->execute();
        if($result)
            return true;
        return false;
    }

    public function limparCarrinho($id_cliente)
    {
        $sql = "UPDATE vendas SET status = 'CA' WHERE id_cliente = :id_cliente";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_cliente',$id_cliente);
        $result = $stmt->execute();
        if($result)
            return true;
        return false;
    }

    public function finalizarVenda($id_cliente)
    {
        $produtoController = new ProdutoController();
        $produtosCarrinho = $this->getCartProducts($id_cliente);
        $status = "VE";
        foreach($produtosCarrinho as $produto)
        {
            $prod_tmp = $produtoController->getProdutoByID($produto['produto_id']);
            $novaQtd = $prod_tmp['quantidade'] - $produto['venda_quantidade'];

            if($novaQtd >= 0)
            {
                $sql = "UPDATE produtos SET quantidade = :quantidade, updated_at = NOW() WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':quantidade', $novaQtd);
                $stmt->bindParam(':id', $produto['produto_id']);
                $stmt->execute();

                $sql = "UPDATE vendas SET status = :status, updated_at = NOW() WHERE (status = 'RE') AND (id_cliente = :id_cliente) AND (id_vendedor = :id_vendedor) AND (id_produto = :id_produto)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':status', $status);
                $stmt->bindParam(':id_cliente', $_SESSION['id']);
                $stmt->bindParam(':id_vendedor', $produto['produto_id_vendedor']);
                $stmt->bindParam(':id_produto', $produto['produto_id']);
                $stmt->execute();
            }
        }
    }

    public function getCountCart($id_cliente)
    {
        $sql = "SELECT * FROM vendas";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $qtd = 0;

        foreach($result as $row)
        {
            if($row['id_cliente'] == $id_cliente && $row['status'] == "RE")
            {
                $qtd += $row['quantidade'];
            }
        }

        return $qtd;
    }

    public function getProductCountCart($id_cliente,$id_vendedor,$id_produto)
    {
        $sql = "SELECT * FROM vendas WHERE status = 'RE' AND id_cliente = :id_cliente AND id_vendedor = :id_vendedor AND id_produto = :id_produto";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_cliente',$id_cliente);
        $stmt->bindParam(':id_vendedor',$id_vendedor);
        $stmt->bindParam(':id_produto',$id_produto);
        $stmt->execute();
        $result = $stmt->fetchAll();

        foreach($result as $row)
        {
            return $row['quantidade'];
        }

        return 0;
    }

    public function viewCarrinho()
    {
        include_once ('view/vendas/carrinho.php');
    }

    public function getCartProducts($id_cliente)
    {
        $sql = "SELECT p.id as produto_id,
               p.id_vendedor as produto_id_vendedor,
               p.nome as produto_nome,
               p.descricao as produto_descricao,
               p.preco as produto_preco,
               v.quantidade as venda_quantidade,
               p.desconto as produto_quantidade,
               p.parcelas as produto_parcelas
               FROM produtos as p INNER JOIN vendas as v ON (v.id_produto = p.id AND v.id_cliente = :id_cliente AND v.status = 'RE');";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_cliente',$id_cliente);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0)
        {
            return $result;
        }else return null;
    }

    public function getQuantVendidos($id_produto)
    {
        $sql = "SELECT * FROM vendas WHERE (id_produto = :id_produto) AND status = 'VE'";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_produto',$id_produto);
        $result = $stmt->execute();
        $result = $stmt->fetchAll();
        $quantidade = 0;

        if(count($result) > 0)
        {
            foreach($result as $row)
            {
                $quantidade += $row['quantidade'];
            }

            return $quantidade;
        }

        return 0;
    }
}
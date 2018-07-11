<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <title>Carrinho de Compras</title>
    <?php include_once('view/templates/links.php'); ?>
</head>
<body>
<div class="header">
    <?php include_once('view/templates/cabecalho.php'); ?>
</div>
<div class="section">
    <?php
    use controller\VendaController;
    use controller\ProdutoController;
    use controller\UsuarioController;
    $vendaController = new VendaController();
    $produtoController = new ProdutoController();
    $usuarioController = new UsuarioController();
    $total = 0;
    $carrinho = $vendaController->getCartProducts($_SESSION['id']);
    ?>
    <br>
    <div class="container">
        <div class="carrinho-box">
            <div class="carrinho-box-title">
                <div class="row col-md-12">
                    <div class="col-md-6 carrinho-box-title-field" align="center">
                        Produtos
                    </div>

                    <div class="col-md-2 carrinho-box-title-field" align="center">
                        Quantidade
                    </div>

                    <div class="col-md-2 carrinho-box-title-field" align="center">
                        Unitario
                    </div>

                    <div class="col-md-2 carrinho-box-title-field" align="center">
                        Total
                    </div>
                </div>
            </div>

        <?php foreach($carrinho as $row): ?>
        <div class="carrinho-produto">
            <?php
            $url_fotos = $produtoController->getFotos($row['produto_id'],$row['produto_id_vendedor']);
            $user = $usuarioController->getById($row['produto_id_vendedor']);
            ?>
            <div class="row col-md-12" align="center">
                <div class="col-md-2" align="center">
                    <img src="<?= $url_fotos[0]?>" style="height: 80px; width: auto"/>
                </div>
                <div class="col-md-4" align="left">
                    <div class="row">
                    <span class="overflow-custom" style="max-width: 100%;"><?= $row['produto_nome'] ?></span>
                    </div>
                    <div class="row">
                        <span>Vendido e entregue por <?= $user['nome'] ?></span>
                    </div>
                </div>
                <div class="col-md-2" align="center">
                    <div style="float: left; padding-left: 20%">
                        <span> <?= $row['venda_quantidade'] ?></span>
                    </div>
                    <div style="float: right; padding-right: 20%">
                        <div class="row">
                            <a href="#">Atualizar</a>
                        </div>
                        <div class="row">
                            <a href="router.php?op=19&&cliente=<?= $_SESSION['id'] ?>&&produto=<?= $row['produto_id']?>">Excluir</a>
                        </div>
                    </div>


                </div>
                <div class="col-md-2" align="center">
                    <span> R$ <?= number_format($row['produto_preco'],2,",",".") ?></span>
                </div>
                <div class="col-md-2" align="center">
                    <span> R$ <?= number_format($row['venda_quantidade']*$row['produto_preco'], 2, ",", "."); ?></span>
                </div>
            </div>
        </div>
        <?php
            $total += ($row['produto_preco']*$row['venda_quantidade']);
            endforeach;
        ?>
    </div>
        <div class="carrinho-total">
            <div class="row col-md-12">
                <div class="col-md-10" align="right">
                    TOTAL
                </div>
                <div class="col-md-2" align="left">
                    <span>R$ <?= number_format($total,2,",","." ); ?></span>
                </div>
            </div>
        </div>
        <div class="carrinho-options">
            <div class="row col-md-12">
                <div class="col-md-6" align="right">
                    <a href="router.php?op=18">Limpar Carrinho</a>
                </div>
                <div class="col-md-6" align="left">
                    <a href="router.php?op=20">Finalizar Pedido</a>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="footer">
    <?php include_once('view/templates/rodape.php'); ?>
</div>
<?php include_once('view/templates/scripts.php'); ?>
</body>
</html>

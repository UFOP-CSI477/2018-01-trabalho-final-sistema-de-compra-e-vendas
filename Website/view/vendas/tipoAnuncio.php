<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Escolha o tipo de Produto/Serviço!</title>
    <?php include_once('view/templates/links.php'); ?>
    <script>
        $(document).ready(function()
        {
            $("#headerSecondary").hide();
        });
    </script>
</head>
<body>

    <div class="header">
        <?php include_once('view/templates/cabecalho.php'); ?>
    </div>

    <div class="section">
        <div class="container" align="center">
            <strong><label style="color: #009540;font-size: 35px">Escolha o que você deseja anunciar</label></strong>
        </div>
        <br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-2" align="center">
                <a href="router.php?op=5"><img src="../../imgs/veiculos.png"></a>
                <br><br>
                <label>Veículos</label>
            </div>
            <div class="col-md-2" align="center">
                <a href="router.php?op=6"><img src="../../imgs/imoveis.png"></a>
                <br><br>
                <label>Imóveis</label>
            </div>
            <div class="col-md-2" align="center">
                <a href="router.php?op=7"><img src="../../imgs/servicos.png"></a>
                <br><br>
                <label>Serviços</label>
            </div>
            <div class="col-md-2" align="center">
                <a href="router.php?op=8"><img src="../../imgs/produtos.png"></a>
                <br><br>
                <label>Produtos e outros</label>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

    <div class="footer"">
    <?php include_once('view/templates/rodape.php'); ?>
    </div>


<?php include_once('view/templates/scripts.php'); ?>
</body>
</html>
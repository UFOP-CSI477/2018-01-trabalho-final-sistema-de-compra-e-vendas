<?php

use controller\LoginController;
use controller\ProdutoController;

$produtoController = new ProdutoController();
$loginController = new LoginController();

?>

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
            $("#optParcelas").hide();
            $("#precoAviso").hide();
            $("#descontoAviso").hide();
        });

        function validar()
        {
            if(isNaN($("#preco").val() ))
            {
                $("#precoAviso").show();
                return false;
            }else
            {
                $("#precoAviso").hide();
            }

            if( parseInt($("#desconto").val()) >= 100 || isNaN($("#desconto").val()) || parseInt($("#desconto").val()) < 0)
            {
                $("#descontoAviso").show();
                return false;
            }else
            {
                $("#descontoAviso").hide();
            }

            return true;
        }

        function showParcelas()
        {
            $("#optParcelas").show();
        }

        function hideParcelas()
        {
            $("#optParcelas").hide();
        }
        </script>
</head>
<body>

<div class="header">
    <?php include_once('view/templates/cabecalho.php'); ?>
</div>

<div class="section">
    <br>
    <div class="container" align="center">
        <strong><label style="color: #009540;font-size: 35px">Preencha os campos da sua venda</label></strong>
    </div>
    <br>
    <div class="row">
        <?php
        if($_SESSION['categoria'] == 1)
        {
            echo "<div class=\"col-md-2\" align=\"center\">
               <img src=\"../../imgs/veiculos.png\">
                <br><br>
                <label>Veículos</label>
                </div>";
        }else if($_SESSION['categoria'] == 2)
        {
            echo "<div class=\"col-md-2\" align=\"center\">
                <img src=\"../../imgs/imoveis.png\">
                <br><br>
                <label>Imóveis</label>
            </div>";
        }else if($_SESSION['categoria'] == 3)
        {
            echo "<div class=\"col-md-2\" align=\"center\">
                <img src=\"../../imgs/servicos.png\">
                <br><br>
                <label>Serviços</label>
            </div>";
        }else
        {
            echo " <div class=\"col-md-2\" align=\"center\">
                <img src=\"../../imgs/produtos.png\">
                <br><br>
                <label>Produtos e outros</label>
            </div>";
        }
        ?>
        <div class="col-md-9" align="left">
            <label>* Campos obrigatórios</label>

            <form action="router.php?op=10" method="post" class="form-control" enctype = "multipart/form-data">
                <div class="form-group">
                    <label><b>* Tipo</b></label>
                    <select name="id_tipo_produto" class="form-control" required>

                        <?php
                        use controller\TipoProdutoController;
                        $tipoProdutoController = new TipoProdutoController();
                        session_start();
                        $rows = $tipoProdutoController->getAll($_SESSION['categoria']);
                        foreach($rows as $row)
                        {
                            echo "<option value=\" ". $row['id'] ." \"> ".utf8_encode($row['tipo'])." </option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label><b>* Nome</b></label>
                    <input type="text" name="nome" placeholder="Digite o nome do produto/serviço" class="form-control" required>
                </div>
                <div class="form-group">
                    <label><b>* Descricao</b></label>
                    <textarea name="descricao" placeholder="Digite a descrição do produto/serviço" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label><b>* Preco</b></label>
                    <input type="text" name="preco" id="preco" placeholder="Digite o preco do produto/serviço" class="form-control" required>
                </div>
                <div class="alert alert-danger" id="precoAviso">
                    <p>Preço incorreto.</p>
                </div>
                <div class="form-group">
                    <label><b>Desconto</b></label>
                    <label><i>Lembrete: Os clientes sempre estão buscando bons descontos ;)</i></label>
                    <input type="text" name="desconto" id="desconto" placeholder="Digite um desconto entre 0 e 100" class="form-control">
                </div>
                <div class="alert alert-danger" id="descontoAviso">
                    <p>Desconto incorreto. Esse desconto representa a quantidade em porcentagens de 1 a 99% de desconto que o produto pode possuir.</p>
                </div>
                <div class="form-group" id="parcelas">
                    <label><b>Aceita Parcelamento no Cartão?</b></label><br>
                    <input type="radio" name="accparcelas" value="sim" onclick="showParcelas()" required><label>Sim</label>
                    <input type="radio" name="accparcelas" value="nao" onclick="hideParcelas()" required><label>Nao</label>
                    <br>
                    <div id="optParcelas">
                        <label><b>* Selecione o numero de parcelas</b></label>
                        <br>
                        <select name="parcelas" class="form-control">
                            <?php for($x=1;$x<=12;$x++): ?>
                            <option value="<?= $x ?>"><?=$x?>x parcela(s)</option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
                <?php
                if($_SESSION['categoria'] == 4):
                    ?>
                    <div class="form-group">
                        <label><b>* Quantidade</b></label>
                        <select name="quantidade" class="form-control" required>
                            <?php for($x=1;$x<100;$x++): ?>
                                <option value="<?=$x?>"><?=$x?></option>
                            <?php endfor ?>
                        </select>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label><b>* Selecione até 10 imagens do que está vendendo</b></label>
                    <input type = "file" name = "image[]" class="form-control" accept=".gif,.jpeg,.jpg,.png,.bmp" multiple required/>
                </div>
                <br>
                <div align="center">
                    <input type="submit" class="btn btn-success" value="CONFIRMAR" onclick="return validar()">
                </div>
            </form>
        </div>
    </div>
    </section>
</div>

<div class="footer"">
<?php include_once('view/templates/rodape.php'); ?>
</div>


<?php include_once('view/templates/scripts.php'); ?>
</body>
</html>
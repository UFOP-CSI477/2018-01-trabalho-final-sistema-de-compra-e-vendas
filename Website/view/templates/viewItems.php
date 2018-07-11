<?php
    include_once ('controller/ProdutoController.php');
    include_once ('controller/UsuarioController.php');
    include_once ('controller/EstadoController.php');
    include_once ('controller/VendaController.php');
    use controller\ProdutoController;
    use controller\UsuarioController;
    use controller\EstadoController;
    use controller\VendaController;

    $vendaController = new VendaController();
    $userController = new UsuarioController();
    $produtoController = new ProdutoController();
    $estadoController = new EstadoController();

    if(!isset($_GET['query']))
        $rows = $produtoController->getAll();
    else $rows = $produtoController->getByQuery($_GET['query']);

?>
<br>
<div class="container">
    <div class="section">
    <div id="buscaInfo">
        <?php if(isset($_GET['query'])){?>
        <h6><strong>Voce buscou por: </strong><em><?= $_GET['query'] ?></em></h6>
        <hr>
        <?php } ?>
    </div>

    <div class="searchOpt">
        <div class="row col-md-12 vsync">

            <div class="col-md-2" align="center">
                <i class="fas fa-list vsync"> Listar por: </i>
            </div>

            <div class="col-md-2" align="center">
                <select class="selectOption" name="buscaPor">
                    <option value="1">Preço Crescente</option>
                    <option value="2">Preço Decrescente</option>
                    <option value="3">Mais avaliados</option>
                    <option value="4">Maior recentes</option>
                    <option value="5">Descontos</option>
                </select>
            </div>

            <div class="col-md-2" align="center">
                <select class="selectOption" name="quantidade">
                    <option value="30">30 itens por página</option>
                    <option value="50">50 itens por página</option>
                    <option value="100">100 itens por página</option>
                </select>
            </div>

            <div class="col-md-6 skipPage" align="right">
                <a href="#" id="primeira">Primeira</a>
                <a href="#" id="anterior">< Anterior</a>
                <a href="#" id="1st">[1]</a>
                <a href="#" id="2nd">2</a>
                <a href="#" id="3rd">3</a>
                <a href="#" id="4th">4</a>
                <a href="#" id="5th">5</a>
                <a href="#" id="proxima">Próxima ></a>
                <a href="#" id="ultima">Última</a>
            </div>

        </div>
    </div>

    <br>

    <?php

    if(count($rows > 0))
        foreach($rows as $row):
            if($row['quantidade'] == 0) continue;
            ?>

            <div class="produto">
                <div class="row col-md-12 vsync">
                    <div class="col-md-3">
                        <?php
                        $user = $userController->getById($row['id_vendedor']);
                        $estado = $estadoController->getEstado($user['id_estado']);
                        $nome_estado = $estado['nome'];
                        $valor = ($row['desconto'] == 0)? sprintf("%.2f",$row['preco']): sprintf("%.2f",($row['preco'] - ($row['preco']*($row['desconto'])/100)));
                        $parcelas = ($row['parcelas'] == 0)? $row['preco']: sprintf("%.2f",$row['preco']/$row['parcelas']);
                        $fotos_url = $produtoController->getFotos($row['id'],$row['id_vendedor']);
                        echo "<img src=\"".$fotos_url[0]."\">";
                        ?>
                    </div>
                    <div class="col-md-6" align="center">
                        <div class="row" align="left">
                            <p class="produto-title"><?= $row['nome'] ?></p>
                        </div>
                        <div class="row" align="left">
                            <p class="descricao overflow-custom"><?= $row['descricao'] ?></p>
                            <div align="center" class="local">
                                <p><?= $user['cidade'].", ".$nome_estado.", ".$user['cep'] ?></p>
                            </div>
                        </div>
                        <div class="row status">
                            <div class="col-md-6 vendidos" align="left">
                                <p><?= $vendaController->getQuantVendidos($row['id']) ?> vendidos</p>
                            </div>
                            <div class="col-md-6">
                                <div class="row classificacao">
                                    <p>Classificação do vendedor</p>
                                </div>
                                <div class="row" style="padding-top: 10px">
                                    <div class="stars">
                                        <div style="background-color: #009540;width: <?= ($user['avaliacaoPositiva']/($user['avaliacaoPositiva']+$user['avaliacaoNegativa']))*100?>% ;border-radius: 10px;">
                                            <p><img src="imgs/star.png" style="min-height: 27px;max-height: 27px;max-width: 140px;min-width: 140px;"/> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" align="center">
                        <div class="preco">
                            <div class="row desconto">
                                <?php if($row['desconto'] > 0) { ?>
                                    <p class="desconto">R$ <?= number_format($row['preco'],2,",",".") ?></p>
                                <?php } else { ?>
                                    <p class="desconto"></p>
                                <?php }?>
                            </div>
                            <div class="row">
                                <p class="valor">R$ <?= number_format($valor,2,",",".") ?></p>
                                <?php
                                if($row['desconto'] > 0) {
                                    ?>
                                    <p class="percentDesconto" align="right"><?= $row['desconto'] ?>% OFF</p>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <?php if($row['parcelas'] > 0) { ?>
                                    <p class="cartao"><i class="fas fa-credit-card">&#160 <?= $row['parcelas'] ?>x R$ <?= number_format($parcelas,2,",",".") ?></i></p>
                                <?php }else{ ?>
                                    <p class="cartao"></p>
                                <?php }?>
                            </div>
                            <div class="row">
                                <?php $form_id = "pushCart".$row['id']; ?>
                                <form method="post" action="router.php?op=16" id="<?= $form_id ?>">
                                    <input type="hidden" name="url" value="/"/>
                                    <input type="hidden" name="id_vendedor" value="<?= $row['id_vendedor'] ?>"/>
                                    <input type="hidden" name="id_cliente" value="<?= $_SESSION['id']?>"/>
                                    <input type="hidden" name="id_produto" value="<?= $row['id'] ?>"/>
                                    <input type="hidden" name="status" value="RE"/>
                                    <input type="hidden" name="quantidade" value="1"/>
                                </form>
                                <?php
                                if(isset($_SESSION))
                                {
                                    if($_SESSION['id'] != $row['id_vendedor']){
                                ?>
                                <a class="comprar-btn" onclick="document.getElementById('<?= $form_id ?>').submit();" style="color: white"><i class="fas fa-shopping-cart"></i>&#160COMPRAR</a>
                                <?php }} ?>
                            </div>
                            <div class="row" style="padding-top: 5px">
                                <a class="comprar-btn" href="router.php?op=12&&id=<?= $row['id'] ?>"><i class="fas fa-plus"></i>&#160DETALHES</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>

        <?php endforeach; ?>
    </div>
    <div class="container">

        <div class="searchOpt">
            <div class="row col-md-12 vsync">

                <div class="col-md-2" align="center">
                    <i class="fas fa-list vsync"> Listar por: </i>
                </div>

                <div class="col-md-2" align="center">
                    <select class="selectOption" name="buscaPor">
                        <option value="1">Preço Crescente</option>
                        <option value="2">Preço Decrescente</option>
                        <option value="3">Mais avaliados</option>
                        <option value="4">Maior recentes</option>
                        <option value="5">Descontos</option>
                    </select>
                </div>

                <div class="col-md-2" align="center">
                    <select class="selectOption" name="quantidade">
                        <option value="30">30 itens por página</option>
                        <option value="50">50 itens por página</option>
                        <option value="100">100 itens por página</option>
                    </select>
                </div>

                <div class="col-md-6 skipPage" align="right">
                    <a href="#" id="primeira">Primeira</a>
                    <a href="#" id="anterior">< Anterior</a>
                    <a href="#" id="1st">[1]</a>
                    <a href="#" id="2nd">2</a>
                    <a href="#" id="3rd">3</a>
                    <a href="#" id="4th">4</a>
                    <a href="#" id="5th">5</a>
                    <a href="#" id="proxima">Próxima ></a>
                    <a href="#" id="ultima">Última</a>
                </div>

            </div>
        </div>
    </div>
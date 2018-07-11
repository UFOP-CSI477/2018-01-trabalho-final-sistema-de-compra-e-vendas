<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <title>Mercado Online</title>
    <?php include_once('view/templates/links.php'); ?>
    <script>
        function trocarImagem(imagem)
        {
            $("#img_principal").attr("src",imagem);
        }
    </script>
</head>
<body>
<div class="header">
    <?php
    use controller\VendaController;
    $vendaController = new VendaController();
    include_once('view/templates/cabecalho.php');

    ?>
</div>
<div class="section">
    <br>
    <div style="padding-left: 3%">
        <label class="view-produto-title"><?= $produto['nome']?></label>
        <br>
        <label style="font-size: 13px">por <a class="view-link-vendedor" href="#"><?= $vendedor['nome'] ?></a></label>
    </div>
    <br>
    <div align="center">
        <div class="row view-descricao-fotos">
            <div class="view-fotos">
                <div class="view-icones-fotos">
                    <?php
                    $img_view_url = $fotos_url[0];
                    $x=1;
                    while($x <= 5 && $x <= count($fotos_url))
                    {
                        $fotos_url[$x-1] = str_replace("\\","/",$fotos_url[$x-1]);
                    ?>
                    <a href="#" id="foto<?= $x ?>"><button onclick="trocarImagem('<?= '/'.$fotos_url[$x-1].'/' ?>//')" style="background-image: url('<?= '/'.$fotos_url[$x-1].'/' ?>')"></button></a>
                    <?php $x++; }?>
                </div>
                <div class="view-icones-fotos">
                    <?php while($x <= 10 && $x <= count($fotos_url)) {
                        $fotos_url[$x-1] = str_replace("\\","/",$fotos_url[$x-1]);
                    ?>
                    <a href="#" id="foto<?= $x ?>"><button  onclick="trocarImagem('<?= '/'.$fotos_url[$x-1].'/' ?>')" style="background-image: url('<?= '/'.$fotos_url[$x-1].'/' ?>')"></button></a>
                    <?php $x++; } ?>
                </div>
                <div style="height: 400px">
                    <img id="img_principal" src="<?= '/'.$img_view_url.'/' ?>" style="max-width: 80%;height: 400px"/>
                </div>
            </div>

            <div class="view-precos">
                <div class="view-precos-avaliacoes">
                    <div>
                        <p class="vendidos"><?= $vendaController->getQuantVendidos($produto['id']) ?> vendido(s)</p>
                    </div>
                    <br>

                    <div>
                        <?php if($produto['desconto'] > 0) { ?>
                            <label class="desconto" style="font-size: 20px">R$ <?= $produto['preco'] ?></label>
                        <?php }else { ?>
                         <label class="desconto" style="font-size: 20px"></label>
                       <?php }?>
                    </div>
                    <div>
                        <?php if($produto['desconto'] > 0) { ?>
                            <label style="font-size: 60px">R$ <?= number_format(($produto['preco']-($produto['preco']*($produto['desconto']/100))),2,",",".") ?> </label>
                            <label style="color: #009540;font-size: 15px;">OFF %<?= $produto['desconto']?></label>
                        <?php } else{ ?>
                            <label class="valor">R$ <?= number_format($produto['preco'],2,",",".") ?></label>
                        <?php } ?>
                    </div>
                    <div>
                        <?php if($produto['parcelas'] > 0) { ?>
                            <p class="cartao" style="font-size: 20px;color: #009540"><i class="fas fa-credit-card">&#160 <?= $produto['parcelas'] ?>x R$ <?= number_format(($produto['preco']/$produto['parcelas']), 2, ',', '.'); ?></i></p>
                        <?php }else{ ?>
                            <p class="cartao"></p>
                        <?php }?>
                    </div>
                </div>
                    <?php if($produto['quantidade'] > 0) { ?>
                    <div class="view-precos-quantidade">
                        <label>Quantidade</label>
                        <select name="quantidade" id="quantidade">
                            <?php for($x=1;$x<=$produto['quantidade']; $x++): ?>
                            <option value="<?= $x ?>"><?= $x ?></option>
                            <?php endfor ?>
                        </select>
                    </div>
                    <?php } else { ?>
                    <div class="view-precos-quantidade">
                    </div>
                    <?php } ?>

                    <div style="width: 30%;padding-top: 10px">
                        <?php if(isset($_SESSION))
                        {
                        if($_SESSION['id'] != $produto['id_vendedor']){
                        ?>
                            <form method="post" action="router.php?op=21" id="comprarAgora">
                                <input type="hidden" name="url" value="/"/>
                                <input type="hidden" name="id_vendedor" value="<?= $produto['id_vendedor'] ?>"/>
                                <input type="hidden" name="id_cliente" value="<?= $_SESSION['id']?>"/>
                                <input type="hidden" name="id_produto" value="<?= $produto['id'] ?>"/>
                                <input type="hidden" name="status" value="RE"/>
                                <input type="hidden" name="quantidade" value="1" />
                            </form>

                       <a onclick="document.getElementById('comprarAgora').submit();"><button class="view-descricao-comprar-btn"> Comprar Agora </button></a>
                        <?php }} ?>
                    </div>

                    <?php if(isset($_SESSION))
                    {
                    if($_SESSION['id'] != $produto['id_vendedor']){
                    ?>
                    <div style="width: 30%;padding-top: 10px">
                        <form method="post" action="router.php?op=16" id="pushCart">
                            <input type="hidden" name="url" value="/"/>
                            <input type="hidden" name="id_vendedor" value="<?= $produto['id_vendedor'] ?>"/>
                            <input type="hidden" name="id_cliente" value="<?= $_SESSION['id']?>"/>
                            <input type="hidden" name="id_produto" value="<?= $produto['id'] ?>"/>
                            <input type="hidden" name="status" value="RE"/>
                            <input type="hidden" name="quantidade" value="1" />
                        </form>

                    </div>
                        <div style="width: 30%;padding-top: 10px">
                            <a onclick="document.getElementById('pushCart').submit();"><button class="view-descricao-comprar-btn-reverse"> Adicionar ao carrinho </button></a>
                        </div>
                    <?php }} ?>
                    </div>

        </div>
    </div>
    <br>
    <div align="center">
        <div class="view-descricao-box">
            <div class="row">
                <label style="font-weight: bold;font-size: 35px;padding-left: 10px">Descrição</label>
            </div>
            <div class="row">
                <p class="view-descricao-text" align="justify"><?= $produto['descricao'] ?></p>
            </div>
        </div>
    </div>
    <div align="center">
        <div class="view-descricao-box">
            <div class="row">
                <label style="font-weight: bold;font-size: 35px;padding-left: 10px">Avaliações</label>
            </div>
            <div class="row">

            </div>
        </div>
    </div>
    <div align="center">
        <div class="view-descricao-box">
            <div class="row">
                <label style="font-weight: bold;font-size: 35px;padding-left: 10px">Perguntas e Respostas</label>
            </div>
            <div class="row">
                <?php if($produto['id_vendedor'] != $_SESSION['id']){ ?>
                <label style="padding-left: 10px;font-size: 25px"> Pergunte à <label style="color: #009540;font-weight: bold"><?= $vendedor['nome'] ?></label></label>
                <?php }else { ?>
                <label style="padding-left: 10px;font-size: 25px"> Perguntas sobre o seu produto :) </label>
                <?php } ?>
            </div>
                <form name="pergunta" method="post" action="router.php?op=13" style="padding-left: 10px">
                <div class="row">
                    <input type="hidden" name="id_produto" value="<?= $produto['id'] ?>"/>
                    <input type="hidden" name="id_vendedor" value="<?= $produto['id_vendedor'] ?>"/>
                    <input type="hidden" name="id_cliente" value="<?= $_SESSION['id'] ?>"/>
                    <?php if($produto['id_vendedor'] != $_SESSION['id']){ ?>
                    <textarea type="text" class="pergunta-input" rows="1" columns="50" name="pergunta" required></textarea> &#160
                    <input type="submit" class="pergunta-submit" value="Perguntar" >
                    <?php } ?>
                </div>
                </form>

                <?php
                if(count($perguntas) > 0)
                foreach($perguntas as $pergunta){
                    ?>
                    <div class="col-md-12" style="padding-top: 10px">
                        <div class="row" align="left">
                            <label class="pergunta-vendedor"><i class="far fa-comment-alt"></i>&#160<?= $pergunta['pergunta'] ?></label>
                        </div>
                        <div class="row" align="left">
                           <div class="resposta-vendedor">
                               <?php
                                if(isset($_SESSION['id']))
                                {
                                    if($_SESSION['id'] == $produto['id_vendedor'] && !isset($pergunta['resposta'])){ // aparecer input para vendedor responder
                                ?>
                                    <form method="post" action="router.php?op=14">
                                        <div class="row">
                                            <input type="hidden" name="id_pergunta" value="<?= $pergunta['id'] ?>"/>
                                            <input type="hidden" name="id_produto" value="<?= $produto['id'] ?>"/>
                                            <input type="hidden" name="id_vendedor" value="<?= $produto['id_vendedor'] ?>"/>
                                            <input type="hidden" name="id_cliente" value="<?= $_SESSION['id'] ?>"/>
                                            <textarea type="text" class="pergunta-input" rows="1" columns="50" name="resposta" required></textarea> &#160
                                            <input type="submit" class="pergunta-submit" value="Responder" />
                                        </div>
                                    </form>
                                    <?php
                                    }else // exibir a resposta do vendedor
                                        {
                                    ?>
                                          <div class="row">
                                                  <label class="resposta-vendedor"><?= $pergunta['resposta'] ?></label>
                                          </div>
                                     <?php
                                        }
                                }else{
                                    ?>
                               <div class="row">
                                   <label class="resposta-vendedor"><?= $pergunta['resposta'] ?></label>
                               </div>
                               <?php }?>
                           </div>
                        </div>
                    </div>
                <?php } ?>
            <br>
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
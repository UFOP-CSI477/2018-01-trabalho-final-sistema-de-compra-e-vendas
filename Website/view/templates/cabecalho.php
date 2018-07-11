<script>
    $(document).ready(function()
    {
        <?php
            if(!isset($_SESSION))
                session_start();
        $dir = $_SERVER['DOCUMENT_ROOT'];
        include_once ($dir."/controller/LoginController.php");
        include_once ($dir."/controller/VendaController.php");
        use controller\LoginController;
        use controller\VendaController;
        $loginController = new LoginController();
        $vendaController = new VendaController();
        if($loginController->isLogged()){ ?>
        $("#entrar").text("Logout");
        <?php }else { ?>
        $("#entrar").text("Entrar");
        $("#dadosPessoais").hide();
        $("#meusPedidos").hide();
        $("#minhasVendas").hide();
        $("#welcome").hide();
        <?php } ?>

    });
</script>

<div class="headerPrimary" id="headerPrimary">
    <div class="row vsync">
        <div class="col-md-9">
            <a href="/" style="padding-left: 10px;"><img src="imgs/ecommerce2.png" width="81px" height="35px"></a>
        </div>
        <div class="col-md-1">
            <div class="row vsync" id="welcome">
                <i class="fa fa-user" style="color: white"><label style="font-family: 'Calibri';font-size: 15px">&#160OLÁ,&#160<?= strtoupper($_SESSION['nome']) ?>!</label></i>
            </div>
        </div>
        <div class="col-md-1">
            <div class="dropdown vsync">
                <button class="dropbtn">Menu</button>
                <div class="dropdown-content">
                    <a href="router.php?op=4" id="anuncie">Anuncie um Produto/Serviço</a>
                    <a href="#" id="dadosPessoais">Dados pessoais</a>
                    <a href="#" id="meusPedidos">Meus pedidos</a>
                    <a href="#" id="minhasVendas">Minhas vendas</a>
                    <a href="router.php?op=1" id="entrar">Entrar</a>
                </div>
            </div>
        </div>
        <div class="col-md-1">
            <div class="vsync">
                <div class="row" align="center">
                <a href="router.php?op=17" id="carrinho" class="textTop1"><i class="fas fa-shopping-cart"></i></a>&#160
                <?php if(isset($_SESSION)){ ?>
                    <label class="marketQtd"><?= $vendaController->getCountCart($_SESSION['id']) ?></label>
                <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="headerSecundary " id="headerSecondary">
    <div class="row vsync">
        <div class="col-md-12">
            <form action="router.php?op=15" method="post">
                <div class="box">
                    <div align="center" style="padding-right: 10px">
                        <a href="#" class="icone"><i class="fa fa-search"></i></a>
                        <input type="text" id="search" placeholder="O que você procura?" class="searchtxt" accesskey="enter" name="query">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
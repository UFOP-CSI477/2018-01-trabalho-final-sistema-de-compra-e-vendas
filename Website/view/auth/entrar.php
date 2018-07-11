<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Entrar</title>
    <?php include_once('view/templates/links.php'); ?>
    <script>
        $(document).ready(function()
        {
            $("#headerSecondary").hide();
            $("#carrinho").hide();
            $("#entrar").hide();
        });
    </script>
</head>
<body>
    <div class="header">
        <?php include_once('view/templates/cabecalho.php'); ?>
    </div>
    <div class="section">
        <div class="container">
            <br><br><br>
            <div class="row">
                <div class="col-md-6">
                    <form action="router.php?op=2" method="post" class="form-horizontal">
                        <strong><label style="font-size: 20px;color: #009540">Ja sou cliente</label></strong>
                        <br><br>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label>Login</label>
                                <input type="text" name="email" placeholder="Digite o email" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Senha</label>
                                <input type="password" name="password" placeholder="Digite a senha" class="form-control" required>
                            </div>
                            <u><a href="#" style="color: dimgrey"> Esqueci minha senha</a></u>
                            <br><br>
                            <input type="submit" class="btn btn-success" value="ACESSAR CONTA" style="width: 300px">
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form action="router.php?op=3" method="post" class="form-horizontal">
                        <strong><label style="font-size: 20px;color: #009540">Criar conta</label></strong>
                        <br><br>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label>Login</label>
                                <input type="text" name="email" placeholder="Informe seu e-mail" class="form-control" required>
                            </div>

                            <input type="submit" class="btn btn-success" value="PROSSEGUIR" style="width: 300px">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="footer"">
        <?php include_once('view/templates/rodape.php'); ?>
    </div>


    <?php include_once('view/templates/scripts.php'); ?>
</body>
</html>
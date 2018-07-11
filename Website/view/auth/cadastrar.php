<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Entrar</title>
    <?php
    use controller\EstadoController;
    use controller\TipoEnderecoController;
    include_once('view/templates/links.php'); ?>
    <script>
        $(document).ready(function()
        {
            $("#headerSecondary").hide();
            $("#carrinho").hide();
            $("#entrar").hide();
            $("#cpfAviso").hide();
            $("#cepAviso").hide();
        });

        function validar()
        {
            if(isNaN($("#cpf").val()) || $("#cpf").val().length != 11)
            {
                $("#cpfAviso").show();
                return false;
            }else
            {
                $("#cpfAviso").hide();
            }

            return true;
        }
    </script>
</head>
<body>
    <div class="header">
        <?php include_once('view/templates/cabecalho.php'); ?>
    </div>
    <div class="container section">
        <br>
        <h2 align="center" style="color: #009540"><strong>Cadastrar</strong></h2>
        <br>
        <h5>* Campos obrigatórios.</h5>
        <form action="../../router.php?op=9" method="post" class="form-horizontal">

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>*Nome</label>
                        <input type="text" name="nome" class="form-control" placeholder="Digite o nome">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>*Sobrenome</label>
                        <input type="text" name="sobrenome" class="form-control" placeholder="Digite o sobrenome">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>*Sexo</label><br>
                        <input type="radio" name="sexo" value="M"> Masculino
                        <input type="radio" name="sexo" value="F"> Feminino<br>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label>*Data nascimento</label>
                        <div class="row col-md-12">
                            <input type="date" name="nascimento" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>*CPF</label>
                        <input type="text" name="cpf" class="form-control" id="cpf" placeholder="Digite o CPF">
                        <div id="cpfAviso">
                            <br><p class="alert alert-danger">CPF Inválido!</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>*CEP</label>
                        <input type="text" name="cep" class="form-control" placeholder="Digite o CEP">
                        <div id="cepAviso">
                            <br><p class="alert alert-danger">CEP Inválido!</p>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">
                    <label>Tipo de Endereço</label><br>
                    <select name="id_tipo_endereco" type="text" class="form-control">
                        <option class="form-control" value="0"> Selecione </option>

                        <?php
                        $tiposEnderecoController =  new TipoEnderecoController();
                        $result = $tiposEnderecoController->getAll();
                        foreach($result as $row)
                        {
                            echo "<option class=\"form-control\" value=\"". $row['id'] ."\">". utf8_decode($row['tipo']) ."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>*Rua</label>
                    <input type="text" name="nome_rua" placeholder="Digite a rua" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>*Numero</label><br>
                    <input type="text" name="numero" placeholder="Digite o numero" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label>Complemento</label><br>
                    <input type="text" name="complemento" placeholder="Digite o complemento" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>*Bairro</label><br>
                    <input type="text" name="bairro" placeholder="Digite o bairro" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Estado</label><br>
                    <select name="id_estado" type="text" class="form-control" for="id_estado">
                        <option class="form-control" value="0"> Selecione </option>

                        <?php
                        $estadosController =  new EstadoController();
                        $result = $estadosController->getAll();
                        foreach($result as $row)
                        {
                            echo "<option class=\"form-control\" value=\"". $row['id'] ."\">". utf8_encode($row['nome']) ."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>*Cidade</label>
                    <input type="text" name="cidade" placeholder="Digite a cidade" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Ponto de Referencia</label>
                    <input type="text" name="ponto_referencia" placeholder="Digite um ponto de referencia" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>*Seu telefone</label>
                    <input type="text" name="telefone1" placeholder="Digite seu telefone" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Outro telefone</label>
                    <input type="text" name="telefone2" placeholder="Digite outro telefone" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label>*E-mail</label>
                    <input type="email" name="email" placeholder="Digite seu email" value="<?= $_POST['email'] ?>" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label>*Senha </label>
                    <input type="password" name="senha1" placeholder="Digite sua senha" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label>*Confirmar senha </label>
                    <input type="password" name="senha2" placeholder="Confirme sua senha" class="form-control">
                </div>
            </div>
            <div align="right">
                <input class="btn btn-success" style="width: 250px" type="submit" value="CONTINUAR" onclick="return validar()">
            </div>

        </form>
    </div>
    <br>
    <div class="footer"">
        <?php include_once('view/templates/rodape.php'); ?>
    </div>

    <?php include_once('view/templates/scripts.php'); ?>
</body>
</html>
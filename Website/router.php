<?php

include_once ('model/Database.php');
include_once ('model/Estado.php');
include_once ('model/Opiniao.php');
include_once ('model/Pergunta.php');
include_once ('model/Produto.php');
include_once ('model/TipoProduto.php');
include_once ('model/TipoEndereco.php');
include_once ('model/Usuario.php');
include_once ('controller/EstadoController.php');
include_once ('controller/LoginController.php');
include_once ('controller/OpiniaoController.php');
include_once ('controller/PerguntaController.php');
include_once ('controller/ProdutoController.php');
include_once ('controller/TipoEnderecoController.php');
include_once ('controller/TipoProdutoController.php');
include_once ('controller/UsuarioController.php');
include_once ('controller/VendaController.php');
include_once ('utils/Functions.php');

use model\Database;
use model\Estado;
use model\Opiniao;
use model\Pergunta;
use model\Produto;
use model\TipoProduto;
use model\TipoEndereco;
use model\Usuario;
use controller\EstadoController;
use controller\LoginController;
use controller\OpiniaoController;
use controller\PerguntaController;
use controller\ProdutoController;
use controller\TipoEnderecoController;
use controller\TipoProdutoController;
use controller\UsuarioController;
use controller\VendaController;
use utils\Functions;

$op = $_GET['op'];

if(!isset($_SESSION))
    session_start();
$loginController = new LoginController();
$vendaController = new VendaController();
$produtoController = new ProdutoController();
$perguntaController = new PerguntaController();

switch($op) {
    case 1:
        if (!$loginController->isLogged()) {
            $loginController->viewEntrar();
        } else {
            $loginController->logout();
            Functions::redir("/");
        }
        break;

    case 2:
        if ($loginController->login($_POST['email'], $_POST['password'])) {
            echo "<script> alert('Logado com sucesso!'); </script>";
            Functions::redir('/');
        } else {
            echo "<script> alert('Falha ao logar!'); </script>";
            Functions::redir('router.php?op=1');
        }
        break;

    case 3:
        $loginController->viewCadastrar();
        break;

    case 4:
        if ($loginController->isLogged())
            $vendaController->viewEscolherTipoAnuncio();
        else {
            echo "<script> alert('Efetue login para anunciar, é rapido e facil! :)') </script>";
            Functions::redir('router.php?op=1');
        }
        break;

    case 5:
        $_SESSION['categoria'] = "1";
        include_once('view/vendas/novaVenda.php');
        break;

    case 6:
        $_SESSION['categoria'] = "2";
        include_once('view/vendas/novaVenda.php');
        break;

    case 7:
        $_SESSION['categoria'] = "3";
        include_once('view/vendas/novaVenda.php');
        break;

    case 8:
        $_SESSION['categoria'] = "4";
        include_once('view/vendas/novaVenda.php');
        break;

    case 9:
        $user = new Usuario;
        $user->setTipoEndereco($_POST['id_tipo_endereco']);
        $user->setIdEstado($_POST['id_estado']);
        $user->setEmail($_POST['email']);
        $user->setNome($_POST['nome']);
        $user->setSobrenome($_POST['sobrenome']);
        $user->setSexo($_POST['sexo']);
        $user->setNascimento($_POST['nascimento']);
        $user->setCpf($_POST['cpf']);
        $user->setCep($_POST['cep']);
        $user->setNomeRua($_POST['nome_rua']);
        $user->setNumero($_POST['numero']);

        if (isset($_POST['complemento']))
            $user->setComplemento($_POST['complemento']);

        $user->setBairro($_POST['bairro']);
        $user->setCidade($_POST['cidade']);

        if (isset($_POST['ponto_referencia']))
            $user->setPontoReferencia($_POST['ponto_referencia']);

        $user->setTelefone1($_POST['telefone1']);
        if (isset($_POST['telefone2']))
            $user->setTelefone2($_POST['telefone2']);

        $user->setPassword($_POST['senha1']);

        $userController = new UsuarioController();
        if ($userController->add($user)) {
            echo "<script> alert('Cadastrado com sucesso!') </script>";
        } else {
            echo "<script> alert('Falha ao cadastrar!') </script>";
        }
        Functions::redir("index.php");
        break;

    case 10:
        if ($produtoController->addVenda()) {
            echo "<script> alert('Venda cadastrada com sucesso!') </script>";
            Functions::redir("index.php");
        } else {
            echo "<script> alert('Falha ao cadastrar venda!') </script>";
            Functions::redir('router.php?op=4');
        }
        break;

    case 11:
        if ($produtoController->insertPhoto($_FILES['image']))
            echo "<script> alert('Arquivo(s) adicionado(s) com sucesso!'); </script>";
        else echo "<script> alert('Erro ao adicionar arquivo(s). É permitido adicionar até 10 arquivos de imagens, sendo o tamanho máximo 2mb.'); </script>";
        Functions::redir('/');
        break;

    case 12:
        $id_produto = $_GET['id'];
        $perguntas = $perguntaController->getAll($id_produto);
        $produtoController->viewDescricao($id_produto);
        break;

    case 13:
        if(isset($_SESSION['id'])) // adicionar pergunta
        {
            if($_SESSION['id'] == $_POST['id_vendedor'])
            {
                Functions::redir("router.php?op=12&&id=" .$_POST['id_produto']);
                break;
            }
            $result = $perguntaController->add($_POST);
            if ($result) {
                echo "<script> alert('Comentário postado com sucesso!') </script>";
                Functions::redir("router.php?op=12&&id=" .$_POST['id_produto']);
            } else {
                echo "<script> alert('Erro ao postar comentário!') </script>";
                Functions::redir("router.php?op=12&&id=" . $_POST['id_produto']);
            }
        }else {
            echo "<script> alert('É necessário efetuar login para postar comentários!') </script>";
            Functions::redir("router.php?op=1");
        }
        break;

    case 14: // resposta do comentario
        if(isset($_SESSION['id']))
        {
            if($_SESSION['id'] != $_POST['id_vendedor']) // so o vendedor q pode responder
            {
                Functions::redir("router.php?op=12&&id=" . $_POST['id_produto']);
                break;
            }
            $result = $perguntaController->responderComentario($_POST['id_pergunta'],$_POST['resposta']);
            if ($result) {
                echo "<script> alert('Resposta postado com sucesso!') </script>";
                Functions::redir("router.php?op=12&&id=" .$_POST['id_produto']);
            } else {
                echo "<script> alert('Erro ao responder comentário!') </script>";
                Functions::redir("router.php?op=12&&id=" . $_POST['id_produto']);
            }
        }else {
            Functions::redir("router.php?op=1");
        }
        break;

    case 15: //buscas
        $url = "index.php?query=".$_POST['query'];
        Functions::redir($url);
        break;

    case 16: //adicionar no carrinho
        if($_SESSION['id'] != $_POST['id_vendedor'])
        {
            $result = $vendaController->addCarrinho($_POST);
            if ($result) {
                echo "<script> alert('Inserido com sucesso ao carrinho de compras!') </script>";
            } else {
                echo "<script> alert('Erro ao adicionar no carrinho!') </script>";
            }
            Functions::redir($_POST['url']);
        }Functions::redir('/');
        break;

    case 17: //carrinho de compras
        $vendaController->viewCarrinho();
        break;

    case 18:
        $vendaController->limparCarrinho($_SESSION['id']);
        Functions::redir('/');
        break;

    case 19:
        $id_cliente = $_GET['cliente'];
        $id_produto = $_GET['produto'];
        $vendaController->removeCarrinho($id_produto,$id_cliente);
        Functions::redir('router.php?op=17');
        break;

    case 20:
        $vendaController->finalizarVenda($_SESSION['id']);
        Functions::redir('/');
        break;

    case 21:
        if($_SESSION['id'] != $_POST['id_vendedor'])
        {
            $result = $vendaController->addCarrinho($_POST);
            if ($result) {
                Functions::redir('router.php?op=17');
            } else {
                echo "<script> alert('Erro ao adicionar no carrinho!') </script>";
                Functions::redir($_POST['url']);
            }
        }Functions::redir('/');
        break;
}
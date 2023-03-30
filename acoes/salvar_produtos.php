<?php
session_start();

require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . './acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "./classes/produtos.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "./controllers/produto.controller.php");

$produto = new Produtos();

if (isset($_POST) && isset($_POST['id']) && !empty($_POST['id'])) {
    $id         = intval( addslashes(filter_input(INPUT_POST, 'id')));
    $nome       = addslashes(filter_input(INPUT_POST, 'nome'));
    $descricao    = addslashes(filter_input(INPUT_POST, 'descricao'));
    $qtde_estoque   = addslashes(filter_input(INPUT_POST, 'qtde_estoque'));
    $codigo_barras   = addslashes(filter_input(INPUT_POST, 'codigo_barras'));
    $ativo   = addslashes(filter_input(INPUT_POST, 'ativo'));
    var_dump($descricao);

    if (empty($nome) || empty($descricao)) {
        $_SESSION['mensagem'] = "Obrigatório informar Nome e Descrição2";
        $_SESSION['sucesso'] = false;
        header('Location:../public/cad_produto.php?key=' . $id);
        die();
    }
    $produto->setId($id);
    $produto->setNome($nome);
    $produto->setDescricao($descricao);
    $produto->setQtde_estoque($qtde_estoque);
    $produto->setCodigoBarras($codigo_barras);
    $produto->setAtivo($ativo);



    $controller = new ProdutoController();
    $resultado = $controller->atualizarproduto($produto);

    if ($resultado) {
        $_SESSION['mensagem'] = "Atualizado com sucesso";
        $_SESSION['sucesso'] = true;
    } else {
        $_SESSION['mensagem'] = "Erro ao atualizar";
        $_SESSION['sucesso'] = false;
    }
    header('Location:../public/cad_produto.php');
} else {

    $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : null;
    $qtde_estoque = isset($_POST['qtde_estoque']) ? $_POST['qtde_estoque'] : null;
    $codigo_barras = isset($_POST['codigo_barras']) ? $_POST['codigo_barras'] : null;
    $ativo= true;

    if ($nome && $descricao) {

        $produto->setNome($nome);
        $produto->setDescricao($descricao);
        $produto->setQtde_estoque($qtde_estoque);
        $produto->setCodigoBarras($codigo_barras);
        $produto->setAtivo($ativo);

        $dao = new ProdutoController();
        $resultado = $dao->criarProduto($produto);
        if ($resultado) {
            $_SESSION['mensagem'] = "Criado com sucesso";
            $_SESSION['sucesso'] = true;
        } else {
            $_SESSION['mensagem'] = "Erro ao criar";
            $_SESSION['sucesso'] = false;
        }
    } else {
        $_SESSION['mensagem'] = "Obrigatório informar Nome e Descrição";
        $_SESSION['sucesso'] = false;
    }
    header('Location:../public/cad_produto.php');
}

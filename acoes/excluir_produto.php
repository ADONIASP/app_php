<?php
session_start();

require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "./classes/produtos.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "./controllers/produto.controller.php");

$produto = new Produtos();

if (isset($_GET) && isset($_GET['key'])) {
    $id = filter_input(INPUT_GET, 'key');
    $controller = new ProdutoController();
    $cliente = $controller->buscarPorId($id);



$resultado = $controller->removeProduto($id);

if ($resultado) {
    $_SESSION['mensagem'] = "Removido com sucesso";
    $_SESSION['sucesso'] = true;
} else {
    $_SESSION['mensagem'] = "Erro ao remover";
    $_SESSION['sucesso'] = false;

}
}
header('Location:../public/home.produtos.php');

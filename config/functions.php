<?php
include_once 'config.php';

date_default_timezone_set('America/Sao_Paulo');

function connectDb() {
    $dns = "mysql:host=" . HOST . ";dbname=" . DBNAME;
    $opcoes = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    try {
        $conexao = new PDO($dns, USER, PASS, $opcoes);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexao;
    } catch (PDOException $ex) {
        echo 'Erro ao conectar ao banco: ' . $ex->getMessage();
    }    
}

function verificaSessao() {
    if (!isset($_SESSION) || !isset($_SESSION['usuario_email'])) {
        $_SESSION['mensagem'] = "Você deve se autenticar.";
        header("Location:../public/index.php");
    }
}
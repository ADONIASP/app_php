<?php

class Produtos {
    private $id;
    private $nome;
    private $descricao;
    private $codigo_barras;
    private $qtde_estoque;
    private $ativo;

    public function setid($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setCodigoBarras($codigo_barras) {
        $this->codigo_barras = $codigo_barras;
    }

    public function getCodigoBarras() {
        return $this->codigo_barras;
    }

    
    public function setQtde_estoque($qtde_estoque) {
        $this->qtde_estoque = $qtde_estoque;
    }

    public function getQtde_estoque() {
        return $this->qtde_estoque;
    }
    
    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    public function getAtivo() {
        return $this->ativo;
    }
}
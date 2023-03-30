<?php

class Cliente {
    private $id;
    private $nome;
    private $cpf_cnpj;
    private $telefone;

    public function setId($id) {
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

    public function setCpfCnpj($cpfCnpj) {
        $this->cpf_cnpj = $cpfCnpj;
    }

    public function getCpfCnpj() {
        return $this->cpf_cnpj;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function getTelefone() {
        return $this->telefone;
    }
}
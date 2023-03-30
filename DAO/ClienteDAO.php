<?php
require_once(str_replace('\\', '/', dirname(__FILE__, 2)). '/config/functions.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) .'/classes/cliente.class.php');

class ClienteDAO
{

    public function buscarTodos()
    {
        $pdo = connectDb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM clientes;");
            $stmt->execute();
            $cliente = new Cliente();
            $retorno = array();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $cliente->setId($rs->id);
                $cliente->setNome(($rs->nome));
                $cliente->setCpfCnpj($rs->cpf_cnpj);
                $cliente->setTelefone($rs->telefone);
                $retorno[] = clone $cliente;
            }
            return $retorno;
        } catch (PDOException $ex) {
            echo "Erro ao buscar cliente: " . $ex->getMessage();
            die();
        }
    }

    public function buscarUm($id)
    {
        $pdo = connectDb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM clientes WHERE id = :id;");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $cliente = new Cliente();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $cliente->setId($rs->id);
                $cliente->setNome(($rs->nome));
                $cliente->setCpfCnpj($rs->cpf_cnpj);
                $cliente->setTelefone($rs->telefone);
            }
            return $cliente;
        } catch (PDOException $ex) {
            echo "Erro ao buscar cliente: " . $ex->getMessage();
            die();
        }
    }

    public function removeCliente($id)
    {
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare('DELETE FROM clientes WHERE id = :id');
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
            }
            return $stmt->rowCount();
        } catch (PDOException $ex) {
            echo "Erro ao excluir cliente: " . $ex->getMessage();
            $pdo->rollBack();
            die();
        }
    }

    public function inserirCliente(Cliente $cliente)
    {
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("INSERT INTO clientes (nome, cpf_cnpj, telefone) VALUES (:nome, :cpf, :tel)");
            $stmt->bindValue(":nome", $cliente->getNome());
            $stmt->bindValue(":cpf", $cliente->getCpfCnpj());
            $stmt->bindValue(":tel", $cliente->getTelefone());
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
                return TRUE;
            }
            return FALSE;
        } catch (PDOException $ex) {
            echo "Erro ao inserir cliente: " . $ex->getMessage();
            $pdo->rollBack();
            die();
        }
    }

    public function atualizaCliente(Cliente $cliente)
    {
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("UPDATE clientes SET nome = :nome, cpf_cnpj = :cpf, telefone = :tel WHERE id = :id");
            $stmt->bindValue(":nome", $cliente->getNome());
            $stmt->bindValue(":cpf", $cliente->getCpfCnpj());
            $stmt->bindValue(":tel", $cliente->getTelefone());
            $stmt->bindValue(":id", $cliente->getId());
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
                return TRUE;
            }
            return FALSE;
        } catch (PDOException $ex) {
            $pdo->rollBack();
            echo "Erro ao atualizar cliente: " . $ex->getMessage();
            die();
        }
    }
}

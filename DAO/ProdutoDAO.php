<?php
require_once(str_replace('\\', '/', dirname(__FILE__, 2)). '/config/functions.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) .'/classes/produtos.class.php');

class ProdutoDAO
{

    public function buscarTodos()
    {
        $pdo = connectDb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM produtos;");
            $stmt->execute();
            $produto = new Produtos();
            $retorno = array();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $produto->setId($rs->id);
                $produto->setNome(($rs->nome));
                $produto->setDescricao($rs->descricao);
                $produto->setCodigoBarras($rs->codigo_barras);
                $produto->setQtde_estoque($rs->qtde_estoque);

                $retorno[] = clone $produto;
            }
            return $retorno;
        } catch (PDOException $ex) {
            echo "Erro ao buscar produto: " . $ex->getMessage();
            die();
        }
    }

    public function buscarUm($id)
    {
        $pdo = connectDb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id;");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $produto = new Produtos();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $produto->setId($rs->id);
                $produto->setNome(($rs->nome));
                $produto->setDescricao($rs->descricao);
                $produto->setCodigoBarras($rs->codigo_barras);
                $produto->setQtde_estoque($rs->qtde_estoque);
                $produto->setAtivo($rs->ativo);
                
              
            }
            return $produto;
        } catch (PDOException $ex) {
            echo "Erro ao buscar produto: " . $ex->getMessage();
            die();
        }
    }

    public function removeProduto($id)
    {
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare('DELETE FROM produtos WHERE id = :id');
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
            }
            return $stmt->rowCount();
        } catch (PDOException $ex) {
            echo "Erro ao excluir produto: " . $ex->getMessage();
            $pdo->rollBack();
            die();
        }
    }

    public function inserirProduto(Produtos $produto)
    {
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("INSERT INTO produtos (nome, descricao, codigo_barras, qtde_estoque, ativo) VALUES (:nome, :descricao,:codigo_barras,:qtde_estoque,:ativo)");
            $stmt->bindValue(":nome", $produto->getNome());
            $stmt->bindValue(":descricao", $produto->getDescricao());
            $stmt->bindValue(":codigo_barras", $produto->getcodigoBarras());
            $stmt->bindValue(":qtde_estoque", $produto->getqtde_estoque());
            $stmt->bindValue(":ativo", $produto->getAtivo());
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
                return TRUE;
            }
            return FALSE;
        } catch (PDOException $ex) {
            echo "Erro ao inserir produto: " . $ex->getMessage();
            $pdo->rollBack();
            die();
        }
    }

    public function atualizaproduto(Produtos $produto)
    {
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("UPDATE produtos SET nome = :nome, descricao = :descricao,codigo_barras = :codigo_barras, qtde_estoque = :qtde_estoque WHERE id = :id");
            $stmt->bindValue(":nome", $produto->getNome());
            $stmt->bindValue(":descricao", $produto->getDescricao());
            $stmt->bindValue(":codigo_barras", $produto->getcodigoBarras());
            $stmt->bindValue(":qtde_estoque", $produto->getqtde_estoque());
            $stmt->bindValue(":id", $produto->getId());
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
                return TRUE;
            }
            return FALSE;
        } catch (PDOException $ex) {
            $pdo->rollBack();
            echo "Erro ao atualizar produto: " . $ex->getMessage();
            die();
        }
    }
}
<?php

require_once '../config/functions.php';
require_once '../classes/login.class.php';

class LoginDAO
{

    public function buscaUsuarioPorEmail(string $email)
    {
        $pdo = connectDb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM login WHERE email = ?");
            $stmt->bindValue(1, $email);
            $stmt->execute();
            if ($stmt->rowCount()) {
                $obj = new Login();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $obj->setId($rs->id);
                    $obj->setEmail($rs->email);
                    $obj->setSenha($rs->senha);
                    $obj->setAtivo($rs->ativo);
                    $result = clone $obj;
                }
                return $result;
            } else {
                return NULL;
            }
        } catch (PDOException $ex) {
            echo "Erro: " + $ex->getMessage();
            die();
        }
    }
}

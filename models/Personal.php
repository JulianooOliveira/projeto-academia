<?php
require_once __DIR__ . '/../config/banco.php';

class Personal
{
    public static function listarTodos()
    {
        $conn = Banco::getConn();
        $res = $conn->query("SELECT * FROM personais");
        $dados = [];

        while ($row = $res->fetch_assoc()) {
            $dados[] = $row;
        }

        return $dados;
    }

    public static function criar($nome, $email)
    {
        $conn = Banco::getConn();
        $stmt = $conn->prepare("INSERT INTO personais (nome, email) VALUES (?, ?)");
        if (!$stmt) {
            error_log("Erro prepare(): " . $conn->error);
            return false;
        }
        $stmt->bind_param("ss", $nome, $email);
        return $stmt->execute();
    }



    public static function buscarPorId($id)
    {
        $conn = Banco::getConn();
        $res = $conn->query("SELECT * FROM personais WHERE id = $id");
        return $res->fetch_assoc();
    }

    public static function atualizar($id, $nome, $email)
    {
        $conn = Banco::getConn();
        $stmt = $conn->prepare("UPDATE personais SET nome = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $nome, $email, $id);
        return $stmt->execute();
    }


    public static function apagar($id)
    {
        $conn = Banco::getConn();
        return $conn->query("DELETE FROM personais WHERE id = $id");
    }


}

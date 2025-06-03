<?php
require_once __DIR__ . '/../config/banco.php';

class Exercicio {

    public static function listarTodos() {
        $banco = Banco::getConn();
        $sql = "SELECT e.*, p.nome AS nome_personal 
                FROM exercicios e 
                LEFT JOIN personais p ON e.personal_id = p.id";
        $res = $banco->query($sql);
        $dados = [];

        while ($row = $res->fetch_assoc()) {
            $dados[] = $row;
        }

        return $dados;
    }

    public static function buscarPorId($id) {
        $banco = Banco::getConn();
        $sql = "SELECT * FROM exercicios WHERE id = $id";
        $res = $banco->query($sql);
        return $res->fetch_assoc();
    }

    public static function criar($nome, $descricao, $personalId) {
        $banco = Banco::getConn();
        $sql = "INSERT INTO exercicios (nome_exercicio, descricao, personal_id) VALUES ('$nome', '$descricao', $personalId)";
        return $banco->query($sql);
    }

    public static function atualizar($id, $nome, $descricao, $personalId) {
        $banco = Banco::getConn();
        $sql = "UPDATE exercicios SET nome_exercicio = '$nome', descricao = '$descricao', personal_id = $personalId WHERE id = $id";
        return $banco->query($sql);
    }

    public static function apagar($id) {
        $banco = Banco::getConn();
        $sql = "DELETE FROM exercicios WHERE id = $id";
        return $banco->query($sql);
    }
}

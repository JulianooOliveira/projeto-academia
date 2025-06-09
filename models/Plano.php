<?php
require_once __DIR__ . '/../config/banco.php';

class Plano
{

    public static function listarComExercicios()
    {
        $banco = Banco::getConn();
        $sqlPlanos = "SELECT * FROM planos";
        $resPlanos = $banco->query($sqlPlanos);
        $planos = [];

        while ($plano = $resPlanos->fetch_assoc()) {
            $id = $plano['id'];

            $sqlEx = "SELECT e.nome_exercicio 
                  FROM plano_exercicios pe
                  JOIN exercicios e ON pe.exercicio_id = e.id
                  WHERE pe.plano_id = $id";

            $resEx = $banco->query($sqlEx);
            $atividades = [];

            while ($ex = $resEx->fetch_assoc()) {
                $atividades[] = $ex['nome_exercicio'];
            }

            $plano['atividades'] = $atividades;
            $planos[] = $plano;
        }

        return $planos;
    }

    public static function criar($nome, $valor, $exercicios = [])
    {
        $banco = Banco::getConn();
        $sql = "INSERT INTO planos (nome_plano, valor) VALUES (?, ?)";
        $stmt = $banco->prepare($sql);
        $stmt->bind_param("sd", $nome, $valor);

        if ($stmt->execute()) {
            $planoId = $banco->insert_id;

            // Só insere se houver exercícios
            foreach ($exercicios as $ex) {
                $banco->query("INSERT INTO plano_exercicios (plano_id, exercicio_id) VALUES ($planoId, $ex)");
            }
        }
    }


    public static function buscarPorId($id)
    {
        $banco = Banco::getConn();
        $sql = "SELECT * FROM planos WHERE id = $id";
        $res = $banco->query($sql);
        return $res->fetch_assoc();
    }

    public static function buscarExercicios($planoId)
    {
        $banco = Banco::getConn();
        $res = $banco->query("SELECT exercicio_id FROM plano_exercicios WHERE plano_id = $planoId");
        $exercicios = [];

        while ($row = $res->fetch_assoc()) {
            $exercicios[] = $row['exercicio_id'];
        }

        return $exercicios;
    }

    public static function editar($id)
    {
        session_start();

        if (!is_numeric($id)) {
            header('Location: /prova-php/planos');
            exit;
        }

        $plano = Plano::buscarPorId($id);
        $todosExercicios = Exercicio::listarTodos();
        $exerciciosPlano = Plano::buscarExercicios($id);
        require __DIR__ . '/../views/planos-editar.php';
    }

    public static function atualizar($id, $nome, $valor, $exercicios = [])
    {
        $banco = Banco::getConn();
        $banco->query("UPDATE planos SET nome_plano = '$nome', valor = $valor WHERE id = $id");

        // Remove antigos e insere os novos
        $banco->query("DELETE FROM plano_exercicios WHERE plano_id = $id");
        foreach ($exercicios as $ex) {
            $banco->query("INSERT INTO plano_exercicios (plano_id, exercicio_id) VALUES ($id, $ex)");
        }
    }

    public static function apagar($id)
    {
        $banco = Banco::getConn();
        $banco->query("DELETE FROM plano_exercicios WHERE plano_id = $id");
        return $banco->query("DELETE FROM planos WHERE id = $id");
    }
}

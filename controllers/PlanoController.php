<?php
require_once __DIR__ . '/../models/Plano.php';
require_once __DIR__ . '/../models/Exercicio.php';

class PlanoController {

    public static function verPlanos() {
        session_start();
        if (!isset($_SESSION['id-usuario'])) {
            header('Location: login');
            exit;
        }

        $planos = Plano::listarComExercicios();
        require __DIR__ . '/../views/planos.php';
    }

    public static function novo() {
        session_start();
        $exercicios = Exercicio::listarTodos();
        require __DIR__ . '/../views/planos-criar.php';
    }

    public static function criar() {
        session_start();
        $nome = $_POST['nome_plano'] ?? '';
        $valor = $_POST['valor'] ?? 0;
        $atividades = $_POST['exercicios'] ?? [];

        Plano::criar($nome, $valor, $atividades);
        header('Location: ../planos');
    }

    public static function editar($id) {
        session_start();
        $plano = Plano::buscarPorId($id);
        $todosExercicios = Exercicio::listarTodos();
        $exerciciosPlano = Plano::buscarExercicios($id);
        require __DIR__ . '/../views/planos-editar.php';
    }

    public static function atualizar() {
        session_start();
        $id = $_POST['id'];
        $nome = $_POST['nome_plano'];
        $valor = $_POST['valor'];
        $atividades = $_POST['exercicios'] ?? [];

        Plano::atualizar($id, $nome, $valor, $atividades);
        header('Location: ../../planos');
    }

    public static function apagar($id) {
        session_start();
        Plano::apagar($id);
        header('Location: ../../planos');
    }
}

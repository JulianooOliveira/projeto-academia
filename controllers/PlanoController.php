<?php
require_once __DIR__ . '/../models/Plano.php';
require_once __DIR__ . '/../models/Exercicio.php';

class PlanoController
{

    public static function verPlanos()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $planos = Plano::listarComExercicios();
        require __DIR__ . '/../views/planos.php';
    }



    public static function novo()
    {
        session_start();
        $exercicios = Exercicio::listarTodos(); // mesmo que sejam opcionais
        require __DIR__ . '/../views/planos-criar.php';
    }

    public static function criar()
    {
        session_start();

        $nome = trim($_POST['nome_plano'] ?? '');
        $valor = floatval($_POST['valor'] ?? 0);
        $atividades = $_POST['exercicios'] ?? [];

        if ($nome === '' || $valor <= 0) {
            $erro = "Nome e valor do plano são obrigatórios.";
            $exercicios = Exercicio::listarTodos();
            require __DIR__ . '/../views/planos-criar.php';
            return;
        }

        Plano::criar($nome, $valor, $atividades);
        header('Location: /prova-php/planos');
    }


    public static function editar($id)
    {
        session_start();
        if (!isset($_SESSION['id-usuario'])) {
            header('Location: /prova-php/login');
            exit;
        }

        $plano = Plano::buscarPorId($id);
        $todosExercicios = Exercicio::listarTodos();
        $exerciciosPlano = Plano::buscarExercicios($id);
        require __DIR__ . '/../views/planos-editar.php';
    }

    public static function atualizar()
    {
        session_start();
        $id = $_POST['id'];
        $nome = $_POST['nome_plano'];
        $valor = $_POST['valor'];
        $atividades = $_POST['exercicios'] ?? [];

        Plano::atualizar($id, $nome, $valor, $atividades);
        header('Location: /prova-php/planos');
    }

    public static function apagar($id)
    {
        session_start();
        if (!isset($_SESSION['id-usuario'])) {
            header('Location: /prova-php/login');
            exit;
        }

        Plano::apagar($id);
        header('Location: ../../planos');
    }
}

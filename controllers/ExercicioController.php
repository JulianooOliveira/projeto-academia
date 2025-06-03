<?php
require_once __DIR__ . '/../models/Exercicio.php';

class ExercicioController {
    
    public static function index() {
        session_start();
        if (!isset($_SESSION['id-usuario'])) {
            header('Location: login');
            exit;
        }

        // Aqui futuramente pode carregar exercícios do banco
        require __DIR__ . '/../views/exercicios.php';
    }

    public static function novo() {
        session_start();
        if (!isset($_SESSION['id-usuario'])) {
            header('Location: login');
            exit;
        }

        require __DIR__ . '/../views/exercicios-criar.php';
    }

    public static function criarExercicio() {
        session_start();
        if (!isset($_SESSION['id-usuario'])) {
            header('Location: login');
            exit;
        }

        // Lógica de salvar exercício aqui depois
        header("Location: ../exercicios");
    }

    public static function editarExercicio($id) {
        session_start();
        if (!isset($_SESSION['id-usuario'])) {
            header('Location: login');
            exit;
        }

        // Buscar dados do exercício por ID
        require __DIR__ . '/../views/exercicios-editar.php';
    }

    public static function atualizarExercicio() {
        session_start();
        if (!isset($_SESSION['id-usuario'])) {
            header('Location: login');
            exit;
        }

        // Atualizar exercício aqui
        header('Location: ../../exercicios');
    }

    public static function apagar($id) {
        session_start();
        if (!isset($_SESSION['id-usuario'])) {
            header('Location: login');
            exit;
        }

        // Apagar exercício aqui
        header('Location: ../../exercicios');
    }
}

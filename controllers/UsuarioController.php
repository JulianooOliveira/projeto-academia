<?php
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController
{

    public static function index()
    {
        session_start();
        if (!isset($_SESSION['id-usuario'])) {
            header('Location: /prova-php/login');
            exit;
        }

        $usuarios = Usuario::listarTodos();
        require __DIR__ . '/../views/usuarios.php';
    }

    public static function novo()
    {
        session_start();
        if (!isset($_SESSION['id-usuario'])) {
            header('Location: /prova-php/login');
            exit;
        }

        require __DIR__ . '/../views/usuarios-criar.php';
    }

    public static function criar()
    {
        session_start();
        if (!isset($_SESSION['id-usuario'])) {
            header('Location: /prova-php/login');
            exit;
        }

        $nome = trim($_POST['nome_usuario']);
        $email = trim($_POST['email']);
        $senha = $_POST['senha'];

        if ($nome === '' || $email === '' || $senha === '') {
            $erro = "Todos os campos são obrigatórios.";
            require __DIR__ . '/../views/usuarios-criar.php';
            return;
        }

        Usuario::criar($nome, $email, $senha);
        header('Location: ../usuarios');
    }

    public static function editar($id)
    {
        session_start();
        if (!isset($_SESSION['id-usuario'])) {
            header('Location: /prova-php/login');
            exit;
        }

        $usuario = Usuario::buscarPorId($id);
        require __DIR__ . '/../views/usuarios-editar.php';
    }

    public static function atualizar()
    {
        session_start();
        if (!isset($_SESSION['id-usuario'])) {
            header('Location: /prova-php/login');
            exit;
        }

        $id = $_POST['id'];
        $nome = trim($_POST['nome_usuario']);
        $email = trim($_POST['email']);
        $senha = $_POST['senha'] ?? null;

        Usuario::atualizar($id, $nome, $email, $senha);
        header('Location: ../../usuarios');
    }

    public static function apagar($id)
    {
        session_start();
        if (!isset($_SESSION['id-usuario'])) {
            header('Location: /prova-php/login');
            exit;
        }

        Usuario::apagar($id);
        header('Location: ../../usuarios');
    }
}

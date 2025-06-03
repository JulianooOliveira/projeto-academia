<?php
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController {

    public static function index() {
        session_start();
        $usuarios = Usuario::listarTodos();
        require __DIR__ . '/../views/usuarios.php';
    }

    public static function novo() {
        session_start();
        require __DIR__ . '/../views/usuarios-criar.php';
    }

    public static function criar() {
        session_start();
        $nome = $_POST['nome_usuario'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        Usuario::criar($nome, $email, $senha);
        header('Location: ../usuarios');
    }

    public static function editar($id) {
        session_start();
        $usuario = Usuario::buscarPorId($id);
        require __DIR__ . '/../views/usuarios-editar.php';
    }

    public static function atualizar() {
        session_start();
        $id = $_POST['id'];
        $nome = $_POST['nome_usuario'];
        $email = $_POST['email'];
        $senha = $_POST['senha'] ?? null;

        Usuario::atualizar($id, $nome, $email, $senha);
        header('Location: ../../usuarios');
    }

    public static function apagar($id) {
        session_start();
        Usuario::apagar($id);
        header('Location: ../../usuarios');
    }
}

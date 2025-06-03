<?php

require_once __DIR__ . '/../models/Usuario.php';

class HomeController
{
    public static function login()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $usuario_formulario = $_POST['username'] ?? null;
            $senha_formulario = $_POST['password'] ?? null;

            if ($usuario_formulario && $senha_formulario) {
                $resp = Usuario::authenticate($usuario_formulario, $senha_formulario);
                if ($resp) {
                    header("Location: exercicios");
                    exit;
                } else {
                    $error = "Usuário ou senha inválidos.";
                }
            } else {
                $error = "Preencha todos os campos.";
            }
        }

        include __DIR__ . '/../views/login.php';
    }

    public static function apagarUsuarioLogado()
    {
        session_start();

        if (isset($_SESSION['id-usuario'])) {
            $id = $_SESSION['id-usuario'];

            require_once __DIR__ . '/../models/Usuario.php';
            Usuario::apagar($id);

            session_unset();
            session_destroy();
        }

        header('Location: login');
        exit;
    }

    public static function logout()
    {
        session_start();
        session_unset();
        session_destroy();

        header('Location: login');
        exit;
    }
}

<?php
require_once __DIR__ . '/../models/Personal.php';

class PersonalController
{
    public static function index()
    {
        session_start();

        $personais = Personal::listarTodos();
        require __DIR__ . '/../views/personais.php';
    }

    public static function novo()
    {
        session_start();
        require __DIR__ . '/../views/personais-criar.php';
    }


    public static function criar()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome'] ?? '');
            $email = trim($_POST['email'] ?? '');

            if ($nome === '' || $email === '') {
                $erro = "Todos os campos são obrigatórios.";
                require __DIR__ . '/../views/personais-criar.php';
                return;
            }

            $sucesso = Personal::criar($nome, $email);

            if ($sucesso) {
                header('Location: /prova-php/personais');
                exit;
            } else {
                $erro = "Erro ao salvar no banco de dados.";
                require __DIR__ . '/../views/personais-criar.php';
            }
        } else {
            header('Location: /prova-php/personais');
            exit;
        }
    }




    public static function editar($id)
    {
        session_start();

        if (!is_numeric($id)) {
            header('Location: ../../personais');
            exit;
        }

        $personal = Personal::buscarPorId($id);
        require __DIR__ . '/../views/personais-editar.php';
    }


    public static function atualizar()
    {
        session_start();
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        Personal::atualizar($id, $nome, $email);
        header('Location: /prova-php/personais');
        exit;
    }



    public static function apagar($id)
    {
        session_start();
        Personal::apagar($id);
        header('Location: /prova-php/personais');
        exit;
    }


}

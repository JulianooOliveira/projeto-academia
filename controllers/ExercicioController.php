<?php
require_once __DIR__ . '/../models/Exercicio.php';
require_once __DIR__ . '/../models/Personal.php';

class ExercicioController
{
    public static function index()
    {
        session_start();
        require __DIR__ . '/../views/exercicios.php';
    }

    public static function novo()
    {
        session_start();
        if (!isset($_SESSION['id-usuario'])) {
            header('Location: login');
            exit;
        }

        require __DIR__ . '/../views/exercicios-criar.php';
    }

    public static function criarExercicio()
    {
        session_start();
        if (!isset($_SESSION['id-usuario'])) {
            header('Location: login');
            exit;
        }

        $nome = trim($_POST['nome_exercicio'] ?? '');
        $descricao = trim($_POST['descricao'] ?? '');
        $personalId = trim($_POST['personal_id'] ?? '');
        $imagem = $_FILES['imagem'] ?? null;

        if ($nome === '' || $descricao === '' || $personalId === '' || !$imagem || $imagem['error'] !== 0) {
            $erro = "Todos os campos são obrigatórios, incluindo a imagem.";
            $f = [
                'nome_exercicio' => $nome,
                'descricao' => $descricao,
                'personal_id' => $personalId
            ];
            require __DIR__ . '/../views/exercicios-criar.php';
            return;
        }

        $personal = Personal::buscarPorId($personalId);
        if (!$personal) {
            $erro = "O Personal informado não existe.";
            $f = [
                'nome_exercicio' => $nome,
                'descricao' => $descricao,
                'personal_id' => $personalId
            ];
            require __DIR__ . '/../views/exercicios-criar.php';
            return;
        }

        $nomeImagem = uniqid() . '_' . basename($imagem['name']);
        $destino = __DIR__ . '/../assets/img/exercicios/' . $nomeImagem;

        if (!move_uploaded_file($imagem['tmp_name'], $destino)) {
            $erro = "Erro ao salvar a imagem.";
            $f = [
                'nome_exercicio' => $nome,
                'descricao' => $descricao,
                'personal_id' => $personalId
            ];
            require __DIR__ . '/../views/exercicios-criar.php';
            return;
        }

        Exercicio::criar($nome, $descricao, $personalId, $nomeImagem);
        header("Location: ../exercicios");
        exit;
    }

    public static function editarExercicio($id)
    {
        session_start();

        if (!is_numeric($id)) {
            header('Location: ../../exercicios');
            exit;
        }

        $f = Exercicio::buscarPorId($id);
        require __DIR__ . '/../views/exercicios-editar.php';
    }

    public static function atualizarExercicio()
    {
        session_start();

        $id = $_POST['id'];
        $nome = $_POST['nome_exercicio'];
        $descricao = $_POST['descricao'];
        $personal_id = $_POST['personal_id'];

        $exercicio = Exercicio::buscarPorId($id);
        $imagemAtual = $exercicio['imagem'] ?? null;
        $imagemNova = $imagemAtual;

        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $nomeImagem = uniqid() . '_' . basename($_FILES['imagem']['name']);
            $caminhoDestino = __DIR__ . '/../assets/img/exercicios/' . $nomeImagem;

            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoDestino)) {
                $imagemNova = $nomeImagem;

                if ($imagemAtual && file_exists(__DIR__ . '/../assets/img/exercicios/' . $imagemAtual)) {
                    unlink(__DIR__ . '/../assets/img/exercicios/' . $imagemAtual);
                }
            }
        }

        Exercicio::atualizar($id, $nome, $descricao, $personal_id, $imagemNova);
        header('Location: /prova-php/exercicios');
        exit;
    }

    public static function apagar($id)
    {
        session_start();
        if (!isset($_SESSION['id-usuario'])) {
            header('Location: login');
            exit;
        }

        Exercicio::apagar($id);
        header('Location: ../../exercicios');
        exit;
    }
}

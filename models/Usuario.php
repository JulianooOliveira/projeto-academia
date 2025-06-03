<?php
require_once __DIR__ . '/../config/banco.php';

class Usuario
{
    // Autentica usuário - Login
    public static function authenticate($username, $password)
    {
        $conn = Banco::getConn();
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nome_usuario = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows <= 0) {
            return false;
        }

        $usuario = $res->fetch_object();
        if (password_verify($password, $usuario->senha)) {
            $_SESSION['usuario'] = $usuario->nome_usuario;
            $_SESSION['id-usuario'] = $usuario->id;
            return true;
        }

        return false;
    }

    public static function listarTodos()
    {
        $conn = Banco::getConn();
        $res = $conn->query("SELECT * FROM usuarios");
        $usuarios = [];

        while ($row = $res->fetch_assoc()) {
            $usuarios[] = $row;
        }

        return $usuarios;
    }

    public static function buscarPorId($id)
    {
        $conn = Banco::getConn();
        $res = $conn->query("SELECT * FROM usuarios WHERE id = $id");
        return $res->fetch_assoc();
    }

    public static function criar($nome, $email, $senha)
    {
        $conn = Banco::getConn();
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO usuarios (nome_usuario, email, senha) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome, $email, $hash);
        return $stmt->execute();
    }

    public static function atualizar($id, $nome, $email, $senha = null)
    {
        $conn = Banco::getConn();

        if ($senha) {
            $hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE usuarios SET nome_usuario = ?, email = ?, senha = ? WHERE id = ?");
            $stmt->bind_param("sssi", $nome, $email, $hash, $id);
        } else {
            $stmt = $conn->prepare("UPDATE usuarios SET nome_usuario = ?, email = ? WHERE id = ?");
            $stmt->bind_param("ssi", $nome, $email, $id);
        }

        return $stmt->execute();
    }

    public static function apagar($id)
    {
        $conn = Banco::getConn();
        return $conn->query("DELETE FROM usuarios WHERE id = $id");
    }
}

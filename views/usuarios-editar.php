<?php require __DIR__ . '/layout/header.php'; ?>

<h2>Editar Usuário</h2>

<form action="atualizar" method="post">
    <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

    <label>Nome de Usuário</label>
    <input type="text" name="nome_usuario" value="<?= htmlspecialchars($usuario['nome_usuario']) ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>

    <label>Nova Senha (deixe em branco para manter a atual)</label>
    <input type="password" name="senha">

    <button type="submit" class="btn btn-primary">Atualizar</button>
    <a href="../../usuarios">Cancelar</a>
</form>

<?php require __DIR__ . '/layout/footer.php'; ?>

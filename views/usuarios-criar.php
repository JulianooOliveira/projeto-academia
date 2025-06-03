<?php require __DIR__ . '/layout/header.php'; ?>

<h2>Novo Usuário</h2>

<form action="criar" method="post">
    <label>Nome de Usuário</label>
    <input type="text" name="nome_usuario" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Senha</label>
    <input type="password" name="senha" required>

    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="../usuarios">Cancelar</a>
</form>

<?php require __DIR__ . '/layout/footer.php'; ?>

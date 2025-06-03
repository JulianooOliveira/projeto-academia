<?php require __DIR__ . '/layout/header.php'; ?>

<h2>Usuários</h2>

<a href="usuarios/novo" class="btn btn-primary">Novo Usuário</a>
<br><br>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome de Usuário</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $u): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['nome_usuario']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td>
                    <a href="usuarios/editar/<?= $u['id'] ?>" class="btn btn-secondary">Editar</a>
                    <a href="usuarios/apagar/<?= $u['id'] ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja apagar?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require __DIR__ . '/layout/footer.php'; ?>

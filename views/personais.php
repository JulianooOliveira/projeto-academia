<?php require __DIR__ . '/layout/header.php'; ?>

<h2>Lista de Personais</h2>

<?php if (isset($_SESSION['id-usuario'])): ?>
    <a href="/prova-php/personais/novo" class="btn btn-primary">Novo Personal</a>
    <br><br>
<?php endif; ?>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <?php if (isset($_SESSION['id-usuario'])): ?>
                <th>Ações</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($personais as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= htmlspecialchars($p['nome']) ?></td>
                <td><?= htmlspecialchars($p['email']) ?></td>
                <?php if (isset($_SESSION['id-usuario'])): ?>
                    <td>
                        <a href="personais/editar/<?= $p['id'] ?>" class="btn btn-secondary">Editar</a>
                        <a href="personais/apagar/<?= $p['id'] ?>" class="btn btn-danger"
                            onclick="return confirm('Tem certeza que deseja apagar?')">Excluir</a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require __DIR__ . '/layout/footer.php'; ?>
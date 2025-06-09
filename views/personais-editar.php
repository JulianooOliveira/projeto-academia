<?php require __DIR__ . '/layout/header.php'; ?>

<h2>Editar Personal</h2>

<form action="/prova-php/personais/atualizar" method="post">
    <input type="hidden" name="id" value="<?= $personal['id'] ?>">

    <label>Nome</label>
    <input type="text" name="nome" value="<?= htmlspecialchars($personal['nome']) ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($personal['email']) ?>" required>

    <button type="submit" class="btn btn-primary">Atualizar</button>
    <a href="/prova-php/personais">Cancelar</a>
</form>

<?php require __DIR__ . '/layout/footer.php'; ?>
<?php require __DIR__ . '/layout/header.php'; ?>

<h2>Novo Personal</h2>

<?php if (isset($erro)): ?>
    <p class="text-danger"><?= $erro ?></p>
<?php endif; ?>


<form action="/prova-php/personais/criar" method="post">
    <label>Nome</label>
    <input type="text" name="nome" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="/prova-php/personais">Cancelar</a>
</form>

<?php require __DIR__ . '/layout/footer.php'; ?>
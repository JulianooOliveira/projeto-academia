<?php require __DIR__ . '/layout/header.php'; ?>

<h2>Editar Exercício</h2>

<form action="editar" method="post">
    <input type="hidden" name="id" value="<?= $f['id'] ?>">

    <label>Nome do Exercício</label>
    <input type="text" name="nome_exercicio" value="<?= $f['nome_exercicio'] ?? '' ?>" required>

    <label>Descrição</label>
    <textarea name="descricao" rows="4"><?= $f['descricao'] ?? '' ?></textarea>

    <label>Personal Responsável (ID)</label>
    <input type="number" name="personal_id" value="<?= $f['personal_id'] ?? '' ?>">

    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="../exercicios">Cancelar</a>
</form>

<?php require __DIR__ . '/layout/footer.php'; ?>

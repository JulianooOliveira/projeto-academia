<?php require __DIR__ . '/layout/header.php'; ?>

<h2>Novo Exercício</h2>

<form action="criar" method="post">
    <label>Nome do Exercício</label>
    <input type="text" name="nome_exercicio" required>

    <label>Descrição</label>
    <textarea name="descricao" rows="4"></textarea>

    <label>Personal Responsável (ID)</label>
    <input type="number" name="personal_id">

    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="../exercicios">Cancelar</a>
</form>

<?php require __DIR__ . '/layout/footer.php'; ?>

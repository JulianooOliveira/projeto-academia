<?php require __DIR__ . '/layout/header.php'; ?>

<h2>Novo Plano</h2>

<form action="criar" method="post">
    <label>Nome do Plano</label>
    <input type="text" name="nome_plano" required>

    <label>Valor (R$)</label>
    <input type="number" step="0.01" name="valor" required>

    <label>Exercícios Inclusos</label>
    <div style="margin-bottom: 1rem;">
        <?php foreach ($exercicios as $ex): ?>
            <div>
                <input type="checkbox" name="exercicios[]" value="<?= $ex['id'] ?>">
                <?= htmlspecialchars($ex['nome_exercicio']) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="../planos">Cancelar</a>
</form>

<?php require __DIR__ . '/layout/footer.php'; ?>

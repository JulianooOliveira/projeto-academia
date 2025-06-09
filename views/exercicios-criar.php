<?php
require __DIR__ . '/layout/header.php';
require_once __DIR__ . '/../models/Personal.php';

if (!isset($f)) {
    $f = [];
}
?>

<h2>Novo Exercício</h2>

<?php if (isset($erro)): ?>
    <div class="alert alert-danger" role="alert">
        <?= htmlspecialchars($erro) ?>
    </div>
<?php endif; ?>

<form action="criar" method="post" enctype="multipart/form-data">
    <label>Nome do Exercício</label>
    <input type="text" name="nome_exercicio" value="<?= htmlspecialchars($f['nome_exercicio'] ?? '') ?>" required>

    <label>Descrição</label>
    <textarea name="descricao" rows="4"><?= htmlspecialchars($f['descricao'] ?? '') ?></textarea>

    <label>Personal</label>
    <select name="personal_id" required class="form-select">
        <option value="">Selecione</option>
        <?php foreach (Personal::listarTodos() as $p): ?>
            <option value="<?= $p['id'] ?>" <?= (isset($f['personal_id']) && $f['personal_id'] == $p['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($p['nome']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Imagem do Exercício</label>
    <input type="file" name="imagem" accept="image/*" required class="form-control">

    <br><br>
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="/prova-php/exercicios" class="btn btn-secondary">Cancelar</a>
</form>

<?php require __DIR__ . '/layout/footer.php'; ?>

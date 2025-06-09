<?php require __DIR__ . '/layout/header.php'; ?>
<?php require_once __DIR__ . '/../models/Personal.php'; ?>

<h2>Editar Exercício</h2>

<form action="/prova-php/exercicios/atualizar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= htmlspecialchars($f['id']) ?>">

    <label>Nome do Exercício</label>
    <input type="text" name="nome_exercicio" value="<?= htmlspecialchars($f['nome_exercicio']) ?>" required>

    <label>Descrição</label>
    <textarea name="descricao" rows="4" required><?= htmlspecialchars($f['descricao']) ?></textarea>

    <label>Personal</label>
    <select name="personal_id" required>
        <option value="">Selecione</option>
        <?php foreach (Personal::listarTodos() as $p): ?>
            <option value="<?= $p['id'] ?>" <?= $f['personal_id'] == $p['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($p['nome']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Imagem Atual</label><br>
    <?php if (!empty($f['imagem'])): ?>
        <img src="/prova-php/assets/img/exercicios/<?= htmlspecialchars($f['imagem']) ?>" alt="Imagem atual"
            style="max-width: 200px;"><br>
    <?php else: ?>
        <p>Nenhuma imagem cadastrada.</p>
    <?php endif; ?>
    <br>
    <label>Nova Imagem (opcional)</label>
    <input type="file" name="imagem" accept="image/*">

    <br><br>
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="/prova-php/exercicios" class="btn btn-secondary">Cancelar</a>
</form>

<?php require __DIR__ . '/layout/footer.php'; ?>
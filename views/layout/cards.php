<?php

function cardExercicio($id, $nome, $descricao, $personal) {
?>
    <div class="card">
        <img src="assets/img/exercicios/img-<?= $id ?>.jpg" class="card-img-top" alt="Exercício">
        <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($nome) ?></h5>
            <p class="card-text">Descrição: <?= htmlspecialchars($descricao) ?></p>
            <p class="card-text">Personal: <?= htmlspecialchars($personal) ?></p>
            <a href="exercicios/editar/<?= $id ?>" class="btn btn-secondary">Editar</a>
            <a href="exercicios/apagar/<?= $id ?>" class="btn btn-danger">Excluir</a>
        </div>
    </div>
<?php
}

function cardPlano($id, $nome_plano, $valor, $atividades = []) {
?>
    <div class="card">
        <img src="assets/img/planos/plano-<?= $id ?>.jpg" class="card-img-top" alt="Plano">
        <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($nome_plano) ?> - R$ <?= number_format($valor, 2, ',', '.') ?></h5>
            <p class="card-text"><strong>Atividades incluídas:</strong></p>
            <ul>
                <?php foreach ($atividades as $atividade): ?>
                    <li><?= htmlspecialchars($atividade) ?></li>
                <?php endforeach; ?>
            </ul>
            <a href="planos/editar/<?= $id ?>" class="btn btn-secondary">Editar</a>
            <a href="planos/apagar/<?= $id ?>" class="btn btn-danger">Excluir</a>
        </div>
    </div>
<?php
}
?>

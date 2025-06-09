<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function cardExercicio($id, $nome, $descricao, $personal, $imagem = '')
{

    ?>
    <div class="card">
        <img src="assets/img/exercicios/<?= htmlspecialchars($imagem) ?>" class="card-img-top" alt="Exercício">
        <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($nome) ?></h5>
            <p class="card-text">Descrição: <?= htmlspecialchars(mb_strimwidth($descricao, 0, 30, '...')) ?></p>
            <p class="card-text">Personal: <?= htmlspecialchars($personal) ?></p>

            <!-- Botões visíveis apenas se logado -->
            <?php if (isset($_SESSION['id-usuario'])): ?>
                <a href="exercicios/editar/<?= $id ?>" class="btn btn-secondary">Editar</a>
                <a href="exercicios/apagar/<?= $id ?>" class="btn btn-danger"
                    onclick="return confirm('Deseja excluir este exercício?')">Excluir</a>
            <?php endif; ?>

            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalExercicio<?= $id ?>">Ver mais</button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalExercicio<?= $id ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= htmlspecialchars($nome) ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <img src="assets/img/exercicios/<?= htmlspecialchars($imagem) ?>" class="img-fluid mb-3" alt="Imagem">
                    <p><strong>Personal:</strong> <?= htmlspecialchars($personal) ?></p>
                    <p><?= nl2br(htmlspecialchars($descricao)) ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php
}



function cardPlano($id, $nome_plano, $valor, $atividades = [])
{
    ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($nome_plano) ?>
                <br><br>
                R$ <?= number_format($valor, 2, ',', '.') ?>
            </h5>
            <ul>
                <?php foreach ($atividades as $atividade): ?>
                    <li><?= htmlspecialchars($atividade) ?></li>
                <?php endforeach; ?>
            </ul>

            <?php if (isset($_SESSION['id-usuario'])): ?>
                <a href="planos/editar/<?= $id ?>" class="btn btn-secondary">Editar</a>
                <a href="planos/apagar/<?= $id ?>" class="btn btn-danger"
                    onclick="return confirm('Deseja excluir este plano?')">Excluir</a>
            <?php endif; ?>
        </div>
    </div>
    <?php
}

function cardPersonal($id, $nome, $email)
{
    ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($nome) ?></h5>
            <p class="card-text">Email: <?= htmlspecialchars($email) ?></p>

            <?php if (isset($_SESSION['id-usuario'])): ?>
                <a href="personais/editar/<?= $id ?>" class="btn btn-secondary">Editar</a>
                <a href="personais/apagar/<?= $id ?>" class="btn btn-danger"
                    onclick="return confirm('Deseja excluir este personal?')">Excluir</a>
            <?php endif; ?>
        </div>
    </div>
    <?php
}


?>
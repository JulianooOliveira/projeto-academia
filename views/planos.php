<?php require __DIR__ . '/layout/header.php'; ?>
<?php require __DIR__ . '/layout/cards.php'; ?>
<?php require_once __DIR__ . '/../models/Plano.php'; ?>

<h2>Planos da Academia</h2>

<?php if (isset($_SESSION['id-usuario'])): ?>
    <a href="/prova-php/planos/novo" class="btn btn-primary">Novo Plano</a>
<?php endif; ?>

<br><br>

<div class="cards-container">
    <?php foreach ($planos as $plano): ?>
        <?php
        cardPlano(
            $plano['id'],
            $plano['nome_plano'],
            $plano['valor'],
            $plano['atividades']
        );
        ?>
    <?php endforeach; ?>
</div>

<?php require __DIR__ . '/layout/footer.php'; ?>

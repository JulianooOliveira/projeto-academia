<?php
require __DIR__ . '/layout/header.php';
require __DIR__ . '/layout/cards.php';
require_once __DIR__ . '/../models/Plano.php';

$planos = Plano::listarComExercicios();
?>

<h2>Planos da Academia</h2>

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

<?php
require __DIR__ . '/layout/header.php';
require __DIR__ . '/layout/cards.php';
require_once __DIR__ . '/../models/Exercicio.php';

$exercicios = Exercicio::listarTodos();
?>

<h2>Exercícios</h2>

<a href="exercicios/novo" class="btn btn-primary">Novo Exercício</a>
<br><br>

<div class="cards-container">
    <?php foreach ($exercicios as $ex): ?>
        <?php
            cardExercicio(
                $ex['id'],
                $ex['nome_exercicio'],
                $ex['descricao'],
                $ex['nome_personal'] ?? 'N/A'
            );
        ?>
    <?php endforeach; ?>
</div>

<?php require __DIR__ . '/layout/footer.php'; ?>

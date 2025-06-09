<?php
require __DIR__ . '/layout/header.php';
require __DIR__ . '/layout/cards.php';
require_once __DIR__ . '/../models/Exercicio.php';

$exercicios = Exercicio::listarTodos();
?>

<?php if (isset($_SESSION['id-usuario'])): ?>
    <a href="/prova-php/exercicios/novo" class="btn btn-primary mb-3">Novo Exercício</a>
<?php endif; ?>

<h2>Exercícios</h2>

<div class="cards-container">
    <?php foreach ($exercicios as $ex): ?>
        <?php
        cardExercicio(
            $ex['id'],
            $ex['nome_exercicio'],
            $ex['descricao'],
            $ex['nome_personal'],
            $ex['imagem']
        );

        ?>
    <?php endforeach; ?>
</div>

<?php require __DIR__ . '/layout/footer.php'; ?>
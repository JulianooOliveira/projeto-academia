<?php

$url = $_GET['url'] ?? null;
$url = explode("/", $url);
$pagina = $url[0] ?? '';

if (isset($url[1])) {
    $pagina = "{$url[0]}/{$url[1]}";
}

require __DIR__ . '/controllers/HomeController.php';
require __DIR__ . '/controllers/ExercicioController.php';
require __DIR__ . '/controllers/PlanoController.php';
require __DIR__ . '/controllers/PersonalController.php';
require __DIR__ . '/controllers/UsuarioController.php';

match ($pagina) {
    'login' => HomeController::login(),
    'logout' => HomeController::logout(),
    'apagar-usuario' => HomeController::apagarUsuarioLogado(),

    'exercicios' => ExercicioController::index(),
    'exercicios/novo' => ExercicioController::novo(),
    'exercicios/criar' => ExercicioController::criarExercicio(),
    'exercicios/editar' => ExercicioController::editarExercicio($url[2]),
    'exercicios/atualizar' => ExercicioController::atualizarExercicio(),
    'exercicios/apagar' => ExercicioController::apagar($url[2]),

    'planos' => PlanoController::verPlanos(),
    'planos/novo' => PlanoController::novo(),
    'planos/criar' => PlanoController::criar(),
    'planos/editar' => PlanoController::editar($url[2]),
    'planos/atualizar' => PlanoController::atualizar(),
    'planos/apagar' => PlanoController::apagar($url[2]),

    'usuarios' => UsuarioController::index(),
    'usuarios/novo' => UsuarioController::novo(),
    'usuarios/criar' => UsuarioController::criar(),
    'usuarios/editar' => UsuarioController::editar($url[2]),
    'usuarios/atualizar' => UsuarioController::atualizar(),
    'usuarios/apagar' => UsuarioController::apagar($url[2]),


    'personais' => PersonalController::index(),
    'personais/criar' => PersonalController::criar(),
    'personais/novo' => PersonalController::novo(),
    'personais/editar' => PersonalController::editar($url[2]),
    'personais/atualizar' => PersonalController::atualizar(),
    'personais/apagar' => PersonalController::apagar($url[2]),




    default => ExercicioController::index(),
};

exit;

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Sistema de Gerenciamento</title>
    <link rel="stylesheet" href="/prova-php/assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header class="bg-primary text-white p-3 mb-4 rounded d-flex justify-content-between align-items-center">
        <a href="/prova-php/">
            <img src="/prova-php/assets/img/profile/prof-3.jpg" alt="Usuário" width="50" class="rounded-circle">
        </a>

        <nav>
            <ul class="nav">
                <li class="nav-item"><a href="/prova-php/exercicios" class="nav-link text-white">Exercícios</a></li>
                <li class="nav-item"><a href="/prova-php/planos" class="nav-link text-white">Planos</a></li>
                <li class="nav-item"><a href="/prova-php/personais" class="nav-link text-white">Personais</a></li>

                <?php if (isset($_SESSION['id-usuario'])): ?>
                    <li class="nav-item"><a href="/prova-php/usuarios" class="nav-link text-white">Usuários</a></li>
                    <li class="nav-item"><a href="/prova-php/logout" class="nav-link text-white">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a href="/prova-php/login" class="nav-link text-white">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <div class="container">

<?php
session_start();
session_destroy();
header('Location: /prova-php/login');
exit;
<?php
require_once __DIR__ . '/../config/banco.php';

class Servico {

    public static function buscarServicos() {
        $banco = Banco::getConn();
        $res = $banco->query("");
        // return algo;
    }

    public static function buscarServicosDeUmFornecedor($idFornecedor) {
        $banco = Banco::getConn();
        $res = $banco->query("");
        // return algo;
    }
    
}
?>
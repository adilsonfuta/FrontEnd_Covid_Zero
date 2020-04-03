<?php

header('Content-Type:application/json');

require_once 'autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    acaoUsuario::listarSms();
}
elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

    acaoUsuario::verifyActionPost();
}
elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {

    #acaoUsuario::atualizarDados();
}
elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

    #acaoUsuario::deletarDados();
}


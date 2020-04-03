<?php

header('Content-Type:application/json');

require_once 'autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    profissionaisSaude::listarProfissionais();
}
elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

    profissionaisSaude::createAcountProssionaisSaude();
}
elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {

    profissionaisSaude::editProfissionalsaude();
}
elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

    profissionaisSaude::deletarProfissionalSaude();
}
<?php

header('Content-Type:application/json');


require_once 'autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    dados::dadosGetMethod();
}
elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

    dados::dadosPostMethod();
}
elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {

    dados::dadosPutMethod();
}
elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

    dados::dadosDeleteMethod();
}

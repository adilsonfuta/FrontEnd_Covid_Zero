<?php
	
	header('Content-Type:application/json');

	require_once 'autoload.php';

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {

		usuarios::showDados();
	}
	elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

		usuarios::insertDados();
	}
	elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {

		usuarios::atualizarDados();
	}
	elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

		usuarios::deletarDados();
	}




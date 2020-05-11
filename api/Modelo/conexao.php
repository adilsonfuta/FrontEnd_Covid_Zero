<?php


class conexao{


	public static function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=covid-zero","root","");

		return $link;
	}
}


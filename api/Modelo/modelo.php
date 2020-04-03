<?php


class modelo{


	public static function addArtistModelo($tabela,$nome){

		$stmt = conexao::conectar()->Prepare("INSERT INTO $tabela(nome) VALUES(:nome)");

		$stmt->BindParam(":nome",$nome, PDO::PARAM_STR);

		if($stmt->execute()){

			return "Feito";
		}
		else{

			return "Error";
		}
	}

	//API

	public static function getAllDadosModelo($tabela){

		$stmt = conexao::conectar()->Prepare("SELECT * FROM $tabela ORDER BY id DESC");

		$stmt->execute();

		return $stmt->fetchAll();
	}

	public static function getDadosIdModelo($tabela,$id){

		$stmt = conexao::conectar()->Prepare("SELECT * FROM $tabela WHERE id =:id");

		$stmt->BindParam(":id",$id, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();
	}
	public static function getDadosProfissaoModelo($tabela,$profissao){

		$stmt = conexao::conectar()->Prepare("SELECT * FROM $tabela WHERE profissao =:profissao");

		$stmt->BindParam(":profissao",$profissao, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();

	}

	//Api Cadastro
	public static function VerificarModelo($tabela,$dados){

		$stmt = conexao::conectar()->Prepare("SELECT * FROM $tabela WHERE telefone =:telefone");

		$stmt->BindParam(":telefone",$dados, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();
	}

	public static function cadastroUserModelo($tabela,$dados){


		$stmt = conexao::conectar()->Prepare("INSERT INTO $tabela(telefone, senha) VALUES(:telefone, :senha)");

		$stmt->BindParam(":telefone",$dados["telefone"], PDO::PARAM_INT);
		$stmt->BindParam(":senha",$dados["senha"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "Feito";
		}
		else{

			return "Error";
		}
	}

	public static function cadastrarProfissionalSaude($tabela,$dados){

		$stmt = conexao::conectar()->Prepare("INSERT INTO $tabela(nome, profissao, telefone) VALUES(:nome, :profissao, :telefone)");

		$stmt->BindParam(":nome",$dados["nome"], PDO::PARAM_STR);
		$stmt->BindParam(":profissao",$dados["profissao"], PDO::PARAM_STR);
		$stmt->BindParam(":telefone",$dados["telefone"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "Feito";
		}
		else{

			return "Error";
		}
	}

	public static function updateTelefoneSenhaModelo($tabela,$dados,$id){

		$stmt = conexao::conectar()->Prepare("UPDATE $tabela SET telefone =:telefone, senha =:senha WHERE id =:id");

		$stmt->BindParam(":telefone",urldecode($dados["telefone"]), PDO::PARAM_STR);
		$stmt->BindParam(":senha",urldecode($dados["senha"]), PDO::PARAM_STR);
		$stmt->BindParam(":id",$id, PDO::PARAM_INT);

		if($stmt->execute()){

			return "Feito";
		}
	}

	public static function updateTelefoneModelo($tabela,$dados,$id){

		$stmt = conexao::conectar()->Prepare("UPDATE $tabela SET telefone =:telefone  WHERE id =:id");

		$stmt->BindParam(":telefone",urldecode($dados["telefone"]), PDO::PARAM_STR);

		$stmt->BindParam(":id",$id, PDO::PARAM_INT);

		if($stmt->execute()){

			return "Feito";
		}
	}

	public static function updateSenhaModelo($tabela,$dados,$id){

		$stmt = conexao::conectar()->Prepare("UPDATE $tabela SET senha =:senha  WHERE id =:id");

		$stmt->BindParam(":senha",urldecode($dados["senha"]), PDO::PARAM_STR);

		$stmt->BindParam(":id",$id, PDO::PARAM_INT);

		if($stmt->execute()){

			return "Feito";
		}
	}

	public static function deletarDadosModelo($tabela,$id){

		$stmt = conexao::conectar()->Prepare("DELETE  FROM $tabela WHERE id =:id");

		$stmt->BindParam(":id",$id, PDO::PARAM_INT);

		if($stmt->execute()){

			return "Feito";
		}
	}

	//Dados Estatistica

	public static function allDadosModelo($tabela){

		$stmt = conexao::conectar()->Prepare("SELECT * FROM $tabela");

		$stmt->execute();

		return $stmt->fetchAll();
	}

	public static function showDadosProvinciaMunicipio($tabela,$dados){

		$stmt = conexao::conectar()->Prepare("SELECT * FROM $tabela WHERE provincia =:provincia and municipio =:municipio ORDER BY id DESC");

		$stmt->BindParam(":provincia",$dados["provincia"], PDO::PARAM_STR);
		$stmt->BindParam(":municipio",$dados["municipio"], PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();
	}

	public static function showDadosProvincia($tabela,$dados){

		$stmt = conexao::conectar()->Prepare("SELECT * FROM $tabela WHERE provincia =:provincia  ORDER BY id DESC");

		$stmt->BindParam(":provincia",$dados, PDO::PARAM_STR);
		
		$stmt->execute();

		return $stmt->fetchAll();
	}

	public static function postDadosModelo($tabela, $dados){

		$stmt = conexao::conectar()->Prepare("INSERT INTO $tabela(suspeitos, negativos, positivos, mortes, recuperados, quarentena, provincia, municipio) VALUES(:suspeitos, :negativos, :positivos, :mortes, :recuperados, :quarentena, :provincia, :municipio)");

		$stmt->BindParam(":suspeitos",$dados["suspeitos"], PDO::PARAM_INT);
		$stmt->BindParam(":negativos",$dados["negativos"], PDO::PARAM_INT);
		$stmt->BindParam(":positivos",$dados["positivos"], PDO::PARAM_INT);
		$stmt->BindParam(":mortes",$dados["mortes"], PDO::PARAM_INT);
		$stmt->BindParam(":recuperados",$dados["recuperados"], PDO::PARAM_INT);
		$stmt->BindParam(":quarentena",$dados["quarentena"], PDO::PARAM_INT);
		$stmt->BindParam(":provincia",$dados["provincia"], PDO::PARAM_STR);
		$stmt->BindParam(":municipio",$dados["municipio"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "Feito";
		}
		else{

			return "Error";
		}

	}

	#Editar Dados

	public static function dadosUpdateSuspeitos($tabela,$dados,$id){

		$stmt = conexao::conectar()->Prepare("UPDATE $tabela SET suspeitos =:suspeitos  WHERE id =:id");

		$stmt->BindParam(":suspeitos",$dados, PDO::PARAM_INT);

		$stmt->BindParam(":id",$id, PDO::PARAM_INT);

		if($stmt->execute()){

			return "Feito";
		}
	}

	public static function dadosUpdateNegativos($tabela,$dados,$id){

		$stmt = conexao::conectar()->Prepare("UPDATE $tabela SET negativos =:negativos  WHERE id =:id");

		$stmt->BindParam(":negativos",$dados, PDO::PARAM_INT);

		$stmt->BindParam(":id",$id, PDO::PARAM_INT);

		if($stmt->execute()){

			return "Feito";
		}
	}

	public static function dadosUpdatePositivos($tabela,$dados,$id){

		$stmt = conexao::conectar()->Prepare("UPDATE $tabela SET positivos =:positivos  WHERE id =:id");

		$stmt->BindParam(":positivos",$dados, PDO::PARAM_INT);

		$stmt->BindParam(":id",$id, PDO::PARAM_INT);

		if($stmt->execute()){

			return "Feito";
		}
	}

	public static function dadosUpdateMortes($tabela,$dados,$id){

		$stmt = conexao::conectar()->Prepare("UPDATE $tabela SET mortes =:mortes  WHERE id =:id");

		$stmt->BindParam(":mortes",$dados, PDO::PARAM_INT);

		$stmt->BindParam(":id",$id, PDO::PARAM_INT);

		if($stmt->execute()){

			return "Feito";
		}
	}

	public static function dadosUpdateRecuperados($tabela,$dados,$id){

		$stmt = conexao::conectar()->Prepare("UPDATE $tabela SET recuperados =:recuperados  WHERE id =:id");

		$stmt->BindParam(":recuperados",$dados, PDO::PARAM_INT);

		$stmt->BindParam(":id",$id, PDO::PARAM_INT);

		if($stmt->execute()){

			return "Feito";
		}
	}

	public static function dadosUpdateQuarentena($tabela,$dados,$id){

		$stmt = conexao::conectar()->Prepare("UPDATE $tabela SET quarentena =:quarentena  WHERE id =:id");

		$stmt->BindParam(":quarentena",$dados, PDO::PARAM_INT);

		$stmt->BindParam(":id",$id, PDO::PARAM_INT);

		if($stmt->execute()){

			return "Feito";
		}
	}

	public static function dadosUpdateProvincia($tabela,$dados,$id){

		$stmt = conexao::conectar()->Prepare("UPDATE $tabela SET provincia =:provincia  WHERE id =:id");

		$stmt->BindParam(":provincia",$dados, PDO::PARAM_STR);

		$stmt->BindParam(":id",$id, PDO::PARAM_INT);

		if($stmt->execute()){

			return "Feito";
		}
	}

	public static function dadosUpdateMunicipio($tabela,$dados,$id){

		$stmt = conexao::conectar()->Prepare("UPDATE $tabela SET municipio =:municipio  WHERE id =:id");

		$stmt->BindParam(":municipio",$dados, PDO::PARAM_STR);

		$stmt->BindParam(":id",$id, PDO::PARAM_INT);

		if($stmt->execute()){

			return "Feito";
		}
	}

	//Update dados PS

	public static function dadosUpdateNomePS($tabela,$dados,$id){

		$stmt = conexao::conectar()->Prepare("UPDATE $tabela SET nome =:nome  WHERE id =:id");

		$stmt->BindParam(":nome",$dados, PDO::PARAM_STR);

		$stmt->BindParam(":id",$id, PDO::PARAM_INT);

		if($stmt->execute()){

			return "Feito";
		}
	}

	public static function dadosUpdateProfissaoPS($tabela,$dados,$id){

		$stmt = conexao::conectar()->Prepare("UPDATE $tabela SET profissao =:profissao  WHERE id =:id");

		$stmt->BindParam(":profissao",$dados, PDO::PARAM_STR);

		$stmt->BindParam(":id",$id, PDO::PARAM_INT);

		if($stmt->execute()){

			return "Feito";
		}
	}

	public static function dadosUpdateTelefonePS($tabela,$dados,$id){

		$stmt = conexao::conectar()->Prepare("UPDATE $tabela SET telefone =:telefone  WHERE id =:id");

		$stmt->BindParam(":telefone",$dados, PDO::PARAM_INT);

		$stmt->BindParam(":id",$id, PDO::PARAM_INT);

		if($stmt->execute()){

			return "Feito";
		}
	}
}
<?php

class usuarios{


	public static function showDados(){

		if (isset($_GET["id"]) && !empty($_GET["id"])) {

			$id = $_GET["id"];
			
			if(!empty($id)){

				$getDadosId = modelo::getDadosIdModelo("usuarios",$id);

				if (!empty($getDadosId)) {
					
					$retorno = array();

					$newValue = array(

						'id' => $getDadosId["id"],
						'telefone' => $getDadosId["telefone"]
					);

					array_push($retorno, $newValue);
					

					exit(json_encode($retorno));
				}
				else{

					$retorno = array('status' => 'Erro', 'message' => 'O dado requisitado nao existe');

					exit(json_encode($retorno));
				}
			}
		}
		else{


			//Show All Dados

			$getAllDados = modelo::getAllDadosModelo("usuarios");

			if (!empty($getAllDados)) {
				
				$retorno = array();

				foreach ($getAllDados as $key => $value) {
					
					$newValue = array(

						'id' => $value["id"],
						'telefone' => $value["telefone"]
					);

					array_push($retorno, $newValue);
				}

				exit(json_encode($retorno));
			}
			else{

				$retorno = array('status' => 'Erro', 'message' => 'Sem dados na tabela');

				exit(json_encode($retorno));
			}
		}
	}

	public static function insertDados(){


		if (isset($_POST["telefone"]) && isset($_POST["senha"])) {
			
			$telefone = $_POST["telefone"];

			$senha = crypt($_POST["senha"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			//Dados Cadastro

			$dados = array(

				'telefone' => $telefone,
				'senha' => $senha
			);

			//Verificar Dados Existente

			$Verificar = modelo::VerificarModelo("usuarios",$dados["telefone"]);

			if (empty($Verificar)){
				
				$cadastro = modelo::cadastroUserModelo("usuarios",$dados);

				if ($cadastro == "Feito") {

					
					$retorno = array('Status' => 'Sucesso', 'Messagem' => 'Usuário cadastro com sucesso');

					exit(json_encode($retorno));
				}
				else{


					$retorno = array('Status' => 'Erro', 'Messagem' => 'Erro ao cadastrar usuário');

					exit(json_encode($retorno));
				}
			}
			else{

				//Dados Já existe

				$retorno = array('Status' => 'Info', 'Messagem' => 'O usuário já existe no sistema');

				exit(json_encode($retorno));
			}
		}
	}

	public static function atualizarDados(){

		if (isset($_GET["id"]) && !empty($_GET["id"]) && $_GET["id"] >0){

			$id = $_GET["id"];
		
			$get = file_get_contents('php://input');

		    $dadosArray = explode("&", $get);

		    $editDados = array();

		    foreach ($dadosArray as $data) {
		    	
		    	$data = explode("=", $data);

		    	$editDados[$data[0]] = $data[1];
		    }

		    //Editar Telefone e Senha
		    if (isset($editDados['telefone']) && isset($editDados['senha'])) {
		    	
		    	$updateTelefoneSenha = modelo::updateTelefoneSenhaModelo("usuarios",$editDados,$id);

		    	if ($updateTelefoneSenha == "Feito") {
					
					//Usuário Deletado com sucesso

					$retorno = array(

						'Status' => "Info",
						'Mensagem' => "Dados actualizados com sucesso."
					);

					exit(json_encode($retorno));
				}
				else{

					//Erro ao Deletar usuário
					$retorno = array(

						'Status' => "Info",
						'Mensagem' => "Erro ao actualizar dados. Por favor contacte o adminstrador do sistema."
					);

					exit(json_encode($retorno));
				}
		    }
		    //Editar Apenas o Telefone
		    elseif (isset($editDados['telefone']) && !isset($editDados['senha'])) {
		    	
		    	$updateTelefone = modelo::updateTelefoneModelo("usuarios",$editDados,$id);

		    	if ($updateTelefone == "Feito") {
					
					//Usuário Deletado com sucesso

					$retorno = array(

						'Status' => "Info",
						'Mensagem' => "Telefone actualizado com sucesso."
					);

					exit(json_encode($retorno));
				}
				else{

					//Erro ao Deletar usuário
					$retorno = array(

						'Status' => "Info",
						'Mensagem' => "Erro ao actualizar telefone. Por favor contacte o adminstrador do sistema."
					);

					exit(json_encode($retorno));
				}
		    }
		    //Editar Apenas a Senha
		    elseif (isset($editDados['senha']) && !isset($editDados['telefone'])) {
		    	
		    	$updateSenha = modelo::updateSenhaModelo("usuarios",$editDados,$id);

		    	if ($updateSenha == "Feito") {
					
					//Usuário Deletado com sucesso

					$retorno = array(

						'Status' => "Info",
						'Mensagem' => "Senha actualizada com sucesso."
					);

					exit(json_encode($retorno));
				}
				else{

					//Erro ao Deletar usuário
					$retorno = array(

						'Status' => "Info",
						'Mensagem' => "Erro ao actualizar senha. Por favor contacte o adminstrador do sistema."
					);

					exit(json_encode($retorno));
				}
		    }
		}
		else{

			$retorno = array(

				'Status' => "Info",
				'Mensagem' => "Erro ao editar, verifica os dados."
			);

			exit(json_encode($retorno));
		}
	}

	public static function deletarDados(){

		if (isset($_GET["id"]) && !empty($_GET["id"])) {
			
			$id  = $_GET["id"];

			//Validar o Id --> Id tem que ser maior que zero
			if ($id > 0) {
				
				$deletarDados = modelo::deletarDadosModelo("usuarios",$id);


				if ($deletarDados == "Feito") {
					
					//Usuário Deletado com sucesso

					$retorno = array(

						'Status' => "Info",
						'Mensagem' => "Usuário eliminado com sucesso."
					);

					exit(json_encode($retorno));
				}
				else{

					//Erro ao Deletar usuário
					$retorno = array(

						'Status' => "Info",
						'Mensagem' => "Erro ao eliminar usuário. Por favor contacte o adminstrador do sistema."
					);

					exit(json_encode($retorno));
				}
			}
		}
		else{

			//Erro ao Deletar usuário
			$retorno = array(

				'Status' => "Erro",
				'Mensagem' => "Erro ao eliminar usuário. Por favor verifique os dados inseridos."
			);

			exit(json_encode($retorno));
		}
	}
}
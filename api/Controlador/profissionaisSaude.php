<?php


class profissionaisSaude{


    public static function listarProfissionais(){

        if (isset($_GET["ref"]) && !empty($_GET["ref"])) {

			$profissao = $_GET["ref"];
			
            $getDadosId = modelo::getDadosProfissaoModelo("profissionais_saude",$profissao);

            if (!empty($getDadosId)) {
                
                $retorno = array();

                foreach ($getDadosId as $key => $value) {
                    
                    $newValue = array(

                        'id' => $value["id"],
                        'Nome' => $value["nome"],
                        'Profissão' => $value["profissao"],
                        'Telefone' => $value["telefone"]
                    );

                    array_push($retorno, $newValue);
                }

                exit(json_encode($retorno));
                
            }
            else{

                $retorno = array('status' => 'Info', 'message' => 'Sem profissionais de saude registrados com esta categoria');

                exit(json_encode($retorno));
            }

		}
		else{


			//Show All Dados

			$getAllDados = modelo::getAllDadosModelo("profissionais_saude");

			if (!empty($getAllDados)) {
				
				$retorno = array();

				foreach ($getAllDados as $key => $value) {
					
					$newValue = array(

						'id' => $value["id"],
                        'Nome' => $value["nome"],
                        'Profissão' => $value["profissao"],
                        'Telefone' => $value["telefone"]
					);

					array_push($retorno, $newValue);
				}

				exit(json_encode($retorno));
			}
			else{

				$retorno = array('status' => 'Erro', 'message' => 'Sem prefissionais de saúde registrados');

				exit(json_encode($retorno));
			}
        }
     
    }

    public static function createAcountProssionaisSaude(){

        $nome = $_POST["nome"];
        $profissao = $_POST["profissao"];
        $telefone = $_POST["telefone"];

        if(isset($nome) && isset($profissao) && isset($telefone)){

            //Cadastrar Profissional de Saúde

            $tabela = "profissionais_saude";

            $dadosCadastro = array(

                'nome' => $nome,
                'profissao' => $profissao,
                'telefone' => $telefone
            );

            $cadastrar = modelo::cadastrarProfissionalSaude($tabela,$dadosCadastro);

            if($cadastrar == "Feito"){

                //Cadastrado com sucesso

                $mensagem = "Profissional de Saúde cadastrado com sucesso";

                $retorno = array(
                    'status' => 'Info', 
                    'message' =>  $mensagem
                );

				exit(json_encode($retorno));
            }
            else{

                //Erro Ao Cardastrar 
                $mensagem = "Erro a cadastrar profissional de saúde. Por favor contacte o admistrador do sistema";

                $retorno = array(
                    'status' => 'Erro', 
                    'message' =>  $mensagem
                );

				exit(json_encode($retorno));

            }
        }
        else{

            //Erro Ao Cardastrar 
            $mensagem = "Insira os dados para realizar cadastro";

            $retorno = array(
                'status' => 'Info', 
                'message' =>  $mensagem
            );

            exit(json_encode($retorno));

        }
    }
    public static function editProfissionalsaude(){

        if(isset($_GET["ref"]) && !empty($_GET["ref"]) && $_GET["ref"] > 0){

            $id = $_GET["ref"];

            $get = file_get_contents('php://input');

            $dadosArray = explode("&", $get);

		    $editDados = array();

		    foreach ($dadosArray as $data) {
		    	
		    	$data = explode("=", $data);

		    	$editDados[$data[0]] = $data[1];
            }

            //Tabela
            $tabela = "profissionais_saude";

            $editar = "";

            if(isset($editDados["nome"])){

                //Editar Suspeitos

                $editar = modelo::dadosUpdateNomePS($tabela,urldecode($editDados["nome"]),$id);
            }
            if(isset($editDados["profissao"])){

                //Editar negativos

                $editar = modelo::dadosUpdateProfissaoPS($tabela,urldecode($editDados["profissao"]),$id);
            }
            if(isset($editDados["telefone"])){

                //Editar positivos

                $editar = modelo::dadosUpdateTelefonePS($tabela,urldecode($editDados["telefone"]),$id);
            }

            if($editar == "Feito"){

                //Registro Editado com sucesso

                $retorno = array(

                    'Status' => "info",
                    'Mensagem' => "Registro(s) editado(s) com sucesso."
                );

                exit(json_encode($retorno));
            }
            else{

                //Erro ao editar Registro
                $retorno = array(

                    'Status' => "info",
                    'Mensagem' => "Erro ao editar registro(s). Por favor contacte o admistrador do sistema."
                );

                exit(json_encode($retorno));
            }
            
        }
        else{

            //Erro Dados -> Parametro Id em falta
            $mensagem = "Erro ao editar o registro. Por favor verifique os dados inseridos";
                
            $retorno = array(
               'status' => 'Erro',
               'mensagem' => $mensagem
            );

           exit(json_encode($retorno));
   
        }
    }
    public static function deletarProfissionalSaude(){

		if (isset($_GET["ref"]) && !empty($_GET["ref"])) {
			
			$id  = $_GET["ref"];

			//Validar o Id --> Id tem que ser maior que zero
			if ($id > 0) {
				
				$deletarDados = modelo::deletarDadosModelo("profissionais_saude",$id);


				if ($deletarDados == "Feito") {
					
					//Usuário Deletado com sucesso

					$retorno = array(

						'Status' => "Info",
						'Mensagem' => "Profissional de saúde eliminado com sucesso."
					);

					exit(json_encode($retorno));
				}
				else{

					//Erro ao Deletar usuário
					$retorno = array(

						'Status' => "Info",
						'Mensagem' => "Erro ao eliminar profissional de saúde. Por favor contacte o adminstrador do sistema."
					);

					exit(json_encode($retorno));
				}
			}
		}
		else{

			//Erro ao Deletar usuário
			$retorno = array(

				'Status' => "Erro",
				'Mensagem' => "Erro ao eliminar profissional de saúde. Por favor verifique os dados inseridos."
			);

			exit(json_encode($retorno));
		}
	}
}
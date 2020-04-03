<?php


class dados{

    #GET METHOD

    public static function dadosGetMethod(){

        if (isset($_GET["provincia"]) && !empty($_GET["provincia"])) {

            //Mostar Dados de uma provincia específica

            $provincia = $_GET["provincia"];

            $provinciaDados = explode("/",$provincia);

            $dados = array();

            //Tabela
            $tabela = "dados";

            if(isset($provinciaDados[1])){

                //Caso Haja uma Provincia e Municipio -> Mostrar dados de Provincia e Municipio

                $dados = array(

                    'provincia' => $provinciaDados[0],
                    'municipio' => $provinciaDados[1]
                );

                $dadosProvinciaMunicipio = modelo::showDadosProvinciaMunicipio($tabela,$dados);

                //Validando o retorno dos dados

                if(!empty($dadosProvinciaMunicipio)){

                    $suspeitos = 0;
                    $negativos = 0;
                    $positivos = 0;
                    $recuperados = 0;
                    $mortes = 0;
                    $quarentena = 0;

                    $retorno = array();

                    foreach($dadosProvinciaMunicipio as $row => $value){

                        $suspeitos += $value["suspeitos"];
                        $negativos += $value["negativos"];
                        $positivos += $value["positivos"];
                        $recuperados += $value["recuperados"];
                        $mortes += $value["mortes"];
                        $quarentena += $value["quarentena"];
                    }

                    $retorno = array(

                        'info' => 'Dados da província de '.ucwords($dados["provincia"]).' no município de '.$dados["municipio"],
                        'suspeitos' => $suspeitos,
                        'negativos' => $negativos,
                        'positivos' => $positivos,
                        'recuperados' => $recuperados,
                        'mortes' => $mortes,
                        'quarentena' => $quarentena
                    );

                    exit(json_encode($retorno));

                }
                else{

                    $mensagem = 'Não existem dados da provincia de '.ucwords($dados["provincia"]).' no município de '.$dados["municipio"];

                    $retorno = array(

                        'status' => "Info",
                        "mensagem" => $mensagem

                    );

                    exit(json_encode($retorno));
                }


            }
            else{

                //Mostrar dados de Uma Provincia
                $dados = array(
                    'provincia' => $provinciaDados[0],
                );

                $dadosProvincia = modelo::showDadosProvincia($tabela,$dados["provincia"]);

                //Validando o retorno dos dados

                if(!empty($dadosProvincia)){

                    $suspeitos = 0;
                    $negativos = 0;
                    $positivos = 0;
                    $recuperados = 0;
                    $mortes = 0;
                    $quarentena = 0;

                    $retorno = array();

                    foreach($dadosProvincia as $row => $value){

                        $suspeitos += $value["suspeitos"];
                        $negativos += $value["negativos"];
                        $positivos += $value["positivos"];
                        $recuperados += $value["recuperados"];
                        $mortes += $value["mortes"];
                        $quarentena += $value["quarentena"];
                    }

                    $retorno = array(

                        'info' => 'Dados da província de '.ucwords($dados["provincia"]),
                        'suspeitos' => $suspeitos,
                        'negativos' => $negativos,
                        'positivos' => $positivos,
                        'recuperados' => $recuperados,
                        'mortes' => $mortes,
                        'quarentena' => $quarentena
                    );

                    exit(json_encode($retorno));

                }
                else{

                    $mensagem = 'Não existem dados na provincia de '.ucwords($dados["provincia"]);

                    $retorno = array(

                        'status' => "Info",
                        "mensagem" => $mensagem

                    );

                    exit(json_encode($retorno));
                }
            }
        }
        else{


            //Mostar Dados de todas as provincias

            $tabela = "dados";

            $allDados = modelo::allDadosModelo($tabela);

            if($allDados){


                $suspeitos = 0;
                $negativos = 0;
                $positivos = 0;
                $recuperados = 0;
                $mortes = 0;
                $quarentena = 0;

                foreach($allDados as $row => $value){

                    $suspeitos += $value["suspeitos"];
                    $negativos += $value["negativos"];
                    $positivos += $value["positivos"];
                    $recuperados += $value["recuperados"];
                    $mortes += $value["mortes"];
                    $quarentena += $value["quarentena"];
                }

                $retorno = array(

                    'info' => 'Todos os Dados',
                    'suspeitos' => $suspeitos,
                    'negativos' => $negativos,
                    'positivos' => $positivos,
                    'recuperados' => $recuperados,
                    'mortes' => $mortes,
                    'quarentena' => $quarentena
                );

                exit(json_encode($retorno));
            }
            else{

                $mensagem = "Não existem dados registrados";
                
                $retorno = array(

                    'status' => 'info',
                    'mensagem' => $mensagem
                );

                exit(json_encode($retorno));
            }
        }

    }

    #POST METHOD
    public static function dadosPostMethod(){

        $suspeitos = isset($_POST["suspeitos"]) ? $_POST["suspeitos"] : 0;
        $negativos = isset($_POST["negativos"]) ? $_POST["negativos"] : 0;
        $positivos = isset($_POST["positivos"]) ? $_POST["positivos"] : 0;
        $recuperados = isset($_POST["recuperados"]) ? $_POST["recuperados"] : 0;
        $mortes = isset($_POST["mortes"]) ? $_POST["mortes"] : 0;
        $quarentena = isset($_POST["quarentena"]) ? $_POST["quarentena"] : 0;
        $provincia = $_POST["provincia"];
        $municipio = $_POST["municipio"];


        if(!empty($provincia) && !empty($municipio)){

            //Validação dos Dados
            if($suspeitos >= 0 && $negativos >= 0 && $positivos >= 0 && $recuperados >= 0 && $mortes >= 0 && $quarentena >= 0){

                $tabela = "dados";

                $dados = array(

                    'suspeitos' => $suspeitos,
                    'negativos' => $negativos,
                    'positivos' => $positivos,
                    'recuperados' => $recuperados,
                    'mortes' => $mortes,
                    'quarentena' => $quarentena,
                    'provincia' => $provincia,
                    'municipio' => $municipio
                );

                //Adicionar Dados

                $postDados = modelo::postDadosModelo($tabela,$dados);

                if($postDados == "Feito"){

                    //Dados adicionado com sucesso

                    $mensagem = "Dados inseridos com sucesso!";
                
                    $retorno = array(

                        'status' => 'info',
                        'mensagem' => $mensagem
                    );

                    exit(json_encode($retorno));

                }
                else{

                    //Dados adicionado com sucesso

                    $mensagem = "Erro ao adicionar dados. Por favor contacte o admistrador do sistema.";
                
                    $retorno = array(

                        'status' => 'info',
                        'mensagem' => $mensagem
                    );

                    exit(json_encode($retorno));

                }

            }
            else{

                //Erro Dados introduzidos n permitidos
                $mensagem = "Erro ao adicionar dados. Alguns dados inseridos não são permitidos.";
                
                $retorno = array(

                    'status' => 'info',
                    'mensagem' => $mensagem
                );

                exit(json_encode($retorno));
            }

        }
        else{
            
           //Erro Dados introduzidos n permitidos
           $mensagem = "Erro ao adicionar dados. Insira a Província e o município.";
                
           $retorno = array(
               'status' => 'info',
               'mensagem' => $mensagem
           );

           exit(json_encode($retorno));
        }
    }

    #PUT METHOD

    public static function dadosPutMethod(){

        if(isset($_GET["id"]) && !empty($_GET["id"]) && $_GET["id"] > 0){

            $id = $_GET["id"];

            $get = file_get_contents('php://input');

            $dadosArray = explode("&", $get);

		    $editDados = array();

		    foreach ($dadosArray as $data) {
		    	
		    	$data = explode("=", $data);

		    	$editDados[$data[0]] = $data[1];
            }

            //Tabela
            $tabela = "dados";

            $editar = "";

            if(isset($editDados["suspeitos"])){

                //Editar Suspeitos

                $editar = modelo::dadosUpdateSuspeitos($tabela,urldecode($editDados["suspeitos"]),$id);
            }
            if(isset($editDados["negativos"])){

                //Editar negativos

                $editar = modelo::dadosUpdateNegativos($tabela,urldecode($editDados["negativos"]),$id);
            }
            if(isset($editDados["positivos"])){

                //Editar positivos

                $editar = modelo::dadosUpdatePositivos($tabela,urldecode($editDados["positivos"]),$id);
            }
            if(isset($editDados["mortes"])){

                //Editar mortes

                $editar = modelo::dadosUpdateMortes($tabela,urldecode($editDados["mortes"]),$id);
            }
            if(isset($editDados["recuperados"])){

                //Editar recuperados

                $editar = modelo::dadosUpdateRecuperados($tabela,urldecode($editDados["recuperados"]),$id);
            }
            if(isset($editDados["quarentena"])){

                //Editar quarentena

                $editar = modelo::dadosUpdateQuarentena($tabela,urldecode($editDados["quarentena"]),$id);
            }
            if(isset($editDados["provincia"])){

                //Editar provincia

                $editar = modelo::dadosUpdateProvincia($tabela,urldecode($editDados["provincia"]),$id);
            }
            if(isset($editDados["municipio"])){

                //Editar municipio

                $editar = modelo::dadosUpdateMunicipio($tabela,urldecode($editDados["municipio"]),$id);
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

    #Delete Method

    public static function dadosDeleteMethod(){

        if(isset($_GET["id"]) && !empty($_GET["id"])){

            $id  = $_GET["id"];

			//Validar o Id --> Id tem que ser maior que zero
			if ($id > 0) {
				
				$deletarDados = modelo::deletarDadosModelo("dados",$id);


				if ($deletarDados == "Feito") {
					
					//UsuáRegistrorio Deletado com sucesso

					$retorno = array(

						'Status' => "info",
						'Mensagem' => "Registro eliminado com sucesso."
					);

					exit(json_encode($retorno));
				}
				else{

					//Erro ao Deletar registro
					$retorno = array(

						'Status' => "Info",
						'Mensagem' => "Erro ao eliminar registro. Por favor contacte o adminstrador do sistema."
					);

					exit(json_encode($retorno));
				}
			}

        }
        else{

            //Erro Dados -> Parametro Id em falta
           $mensagem = "Erro ao eliminar o registro. Por favor verifique os dados inseridos";
                
           $retorno = array(
               'status' => 'Erro',
               'mensagem' => $mensagem
           );

           exit(json_encode($retorno));
        }
    }
}
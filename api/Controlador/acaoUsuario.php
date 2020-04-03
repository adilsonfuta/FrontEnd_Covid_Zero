<?php

class acaoUsuario{

    //Verificar Accao do Usuario

    public static function verifyActionPost(){

        if(isset($_GET["action"]) && !empty($_GET["action"])){


            if($_GET["action"] == "login"){

                //Fazer Login -> Entrar na App
                acaoUsuario::makeLogin();
            }
            elseif($_GET["action"] == "sendSms"){

                //Enviar Sms a um profissional de saúde
                acaoUsuario::sendSms();
            }
        }
        else{

            //Acão não especificada

            $retorno = array(

                'Status' => "Erro",
                'Mensagem' => "Acção não específicada"
            );

            exit(json_encode($retorno));

        }
    }

    //Login
    public static function makeLogin(){

        if(isset($_POST["telefone"]) && isset($_POST["senha"])){

            $telefone = $_POST["telefone"];
            $senha = $_POST["senha"];

            if(!empty($telefone) && !empty($senha)){

                $tabela = "usuarios";

                $senhaEncriptada = crypt($senha, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $dadosLogin = array(

                    'telefone' => $telefone,
                    'senha' => $senhaEncriptada
                );

                //Verificar Dados

                $logar = actionUserModelo::loginUserModelo($tabela,$dadosLogin);

                if(!empty($logar)){

                    if($logar["senha"] == $senhaEncriptada){

                        //User Logado
                        $retorno = array(

                            'Status' => "Sucesso",
                            'idUser' => $logar["id"],
                            'Mensagem' => "Login efectuado com sucesso"
                        );
            
                        exit(json_encode($retorno));
                    }
                    else{

                        //Dados de usuario incorretos
    
                        $retorno = array(
    
                            'Status' => "Erro",
                            'Mensagem' => "Os dados inseridos estão incorretos"
                        );
            
                        exit(json_encode($retorno));
    
                    }
                }
                else{

                    //Dados de usuario incorretos

                    $retorno = array(

                        'Status' => "Erro",
                        'Mensagem' => "Os dados inseridos estão incorretos"
                    );
        
                    exit(json_encode($retorno));

                }
            }
        }

    }

    public static function sendSms(){
        
        if(isset($_POST["userId"]) && isset($_POST["psId"]) && isset($_POST["sms"]) && isset($_POST["de"])){

            $id_user = $_POST["userId"];
            $id_ps = $_POST["psId"];
            $sms = $_POST["sms"];
            $de = $_POST["de"];

            if(!empty($id_user) && !empty($id_ps) && !empty($sms) && !empty($de)){

                $dados = array(

                    'de' => $de,
                    'userId' => $id_user,
                    'psId' => $id_ps,
                    'sms' => $sms
                );

                $tabela = "chat_sms";

                $enviarSms = actionUserModelo::sendSmsModelo($tabela,$dados);

                exit(json_encode($enviarSms));
            }
            else{

                //Dados de usuario incorretos
        
                $retorno = array(
        
                    'Status' => "Info",
                    'Mensagem' => "Os campos não podem estar vazios"
                );
    
                exit(json_encode($retorno));
            }
        }
        else{

            //Dados de usuario incorretos
    
            $retorno = array(
    
                'Status' => "Info",
                'Mensagem' => "Verifique os dados inseridos"
            );

            exit(json_encode($retorno));
        }
    }

    public static function listarSms(){

        //LIstar Mensagem do usuário com um respectivo Profissional de saúde

        $get = explode("/",$_GET["action"]);

        if(isset($get[1]) && isset($get[2])){

            $userId = $get[1];

            $psId = $get[2];

            if($userId > 0 && $psId > 0){

                //Listar Mensagens

                $tabela = "chat_sms";

                $mensagens = actionUserModelo::smsUserPsAll($tabela,$userId,$psId);
                
                if(!empty($mensagens)){

                    $retorno = array();

                    foreach ($mensagens as $key => $value) {
                        
                        if($value["de"] == $userId){

                            $newValue = array(

                                'userId' => $value["userId"],
                                'sms' => $value["sms"]
                            ); 
                        }
                        else{

                            $newValue = array(

                                'de' => $value["de"],
                                'mensagem' => $value["sms"]
                            );    
                        }
                        array_push($retorno, $newValue);
                    }

                    exit(json_encode($retorno));
                }
                else{

                    $retorno = array(

                        'status' => 'info',
                        'mensagem' => 'sem mensagens'
                    ); 

                    exit(json_encode($retorno));
                }
            }
            else{


            }
        }
        else{

            //Dados de usuario incorretos
    
            $retorno = array(
    
                'Status' => "Erro",
                'Mensagem' => "Paramêtros em falta. POr favor contacte o administrador do sistema"
            );

            exit(json_encode($retorno));
        }
    }
}
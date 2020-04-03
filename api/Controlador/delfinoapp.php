<?php


class delfinoapp{
	
	/*
	 1.reduceLyrics -> Reduzir tamanho de uma String, pegando as primeiras string definidas
	 2.dataFormat -> fomatar uma data 
	*/
	
	
	public static function reduceLyrics($tring,$tamanho){
		
		#Reduzir tamanho das strings -> Pegar as primeiras letras de uma string
				
		$newString = substr($tring,0,$tamanho);

		if(strlen($tring) > $tamanho){

			$newString .= "...";
		}
		
		return $newString;
	}
	
	public static function dataFormat($data){
		
		$newData = date('d/m/Y', strtotime($data));
				
		$newData .= "  ".date('H:i', strtotime($data));
		
		return $newData;
		
	}

	public static function singleImgs($file){
		
		
	    $arquivo=$file;
		
		$nome1 = '';

		#Atribuir diretorio
	 	$diretorio="App/Controlador/files/";
		
		
		$permitir_tipos  = array(

			'image/jpg', 
			'image/jpeg',
			'image/png'
		);

		#Pegar a extenção do arquivo
		$tipos_file = $arquivo['type'];

		if (in_array( $tipos_file, $permitir_tipos ) ) {

			#Atribuir um novo nome ao aqruivo
			$explode = explode("/", $tipos_file);
			$extencao = end($explode);

			$novo_nome=md5(time()).'.'.$extencao;

			#Diretorio do arquivo
			$destino=$diretorio;

			#Mover o arquivo para o diretorio
	 		$move_files = move_uploaded_file($arquivo["tmp_name"], $destino.$novo_nome);


	 		if($move_files){
				
				$nome1 = $novo_nome;
			}
			else{

				$nome1 = "Erro";
			}
		}

	 	return $nome1;
	}
	
	public static function multipleImgs($file){
		
		
	    $arquivo=$file;
		
		$nome1 = '';

		#Atribuir diretorio
	 	$diretorio="App/Controlador/files/";
		
		
		$permitir_tipos  = array(

			'audio/mp3', 
			'audio/mp4',
			'audio/m4a'
		);

		#Pegar a extenção do arquivo
		$tipos_file = $arquivo['type'];

		if (in_array( $tipos_file, $permitir_tipos ) ) {

			#Atribuir um novo nome ao aqruivo
			$explode = explode("/", $tipos_file);
			$extencao = end($explode);

			$novo_nome=md5(time()).'.'.$extencao;

			#Diretorio do arquivo
			$destino=$diretorio;

			#Mover o arquivo para o diretorio
	 		$move_files = move_uploaded_file($arquivo["tmp_name"], $destino.$novo_nome);


	 		if($move_files){
				
				$nome1 = $novo_nome;
			}
			else{

				$nome1 = "Erro";
			}
		}

	 	return $nome1;
	}


	public static function ulploadAllImg($img){
		
		$arquivo=$img;
		
		$nome1 = '';
		$nome2 = '';
		$nome3 = '';
		$nome4 = '';
		$nome5 = '';


		#Atribuir diretorio
	 	$diretorio="App/Vista/Admin/imagens/upload/bloguer/";
		$permitir_tipos  = array(

			'image/jpeg', 
			'image/jpg',
			'image/png',
		);

	 	for ($contador=0; $contador < 12; $contador++) { 


	 		if ($contador < 12) {

	 			#Pegar a extenção do arquivo
				$tipos_imagens   = $arquivo[$contador]['type'];

				if (in_array( $tipos_imagens, $permitir_tipos ) ) {

					#Atribuir um novo nome ao aqruivo
					$novo_nome=md5(time()).'.jpg';

					#Diretorio do arquivo
					$destino=$diretorio.$arquivo[$contador]['name'];

					#Mover o arquivo para o diretorio
			 		$move_files = move_uploaded_file($arquivo[$contador]["tmp_name"], $destino.$novo_nome);


			 		if($move_files){
						
						if ($contador == 0) {

							$nome1 = $diretorio.$arquivo[$contador]['name'].$novo_nome;

						}

						elseif ($contador == 1) {

							$nome2 = $diretorio.$arquivo[$contador]['name'].$novo_nome;;

						}
						elseif ($contador == 2) {

							$nome3 = $diretorio.$arquivo[$contador]['name'].$novo_nome;
						}

						elseif ($contador == 3) {

							$nome4 = $diretorio.$arquivo[$contador]['name'].$novo_nome;

						}
						elseif ($contador == 4) {

							$nome5 = $diretorio.$arquivo[$contador]['name'].$novo_nome;

						}
					}

				}
	 		}
	 	}

	 	$allImgs = array(

	 		"img1" => isset($nome1) ? $nome1 : "404Image.png",

	 		"img2" => isset($nome2) ? $nome2 : "404Image.png",

	 		"img3" => isset($nome3) ? $nome3 : "404Image.png",

	 		"img4" => isset($nome4) ? $nome4 : "404Image.png",

	 		"img5" => isset($nome5) ? $nome5 : "404Image.png"
	 	);

	 	return $allImgs;
	}
}
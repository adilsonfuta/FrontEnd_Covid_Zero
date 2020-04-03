<?php


class actionUserModelo{

    public static function loginUserModelo($tabela, $dados){

        $stmt = conexao::conectar()->Prepare("SELECT * FROM $tabela WHERE telefone =:telefone");

        $stmt->BindParam(":telefone",$dados["telefone"], PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetch();

    }

    public static function sendSmsModelo($tabela,$dados){

        $stmt = conexao::conectar()->Prepare("INSERT INTO $tabela(de, userId, psId, sms) VALUES(:de, :userId, :psId, :sms)");

        $stmt->BindParam(":de",$dados["de"], PDO::PARAM_STR);
        $stmt->BindParam(":userId",$dados["userId"], PDO::PARAM_INT);
        $stmt->BindParam(":psId",$dados["psId"], PDO::PARAM_INT);
        $stmt->BindParam(":sms",$dados["sms"], PDO::PARAM_STR);

		if($stmt->execute()){

            return "Feito";
        }
    }

    public static function smsUserPsAll($tabela,$userId,$psId){

        $stmt = conexao::conectar()->Prepare("SELECT * FROM $tabela WHERE userId =:userId and psId =:psId");

        $stmt->BindParam(":userId",$userId, PDO::PARAM_INT);
        $stmt->BindParam(":psId",$psId, PDO::PARAM_INT);

        $stmt->execute();
        
        return $stmt->fetchAll();
    }
}
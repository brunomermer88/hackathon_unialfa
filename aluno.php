<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'Connection.php';
require_once 'Transacao.php';

require_once 'Logger.php';
require_once 'LoggerTXT.php';

require_once 'models/Record.php';
require_once 'models/Imc.php';
require_once 'models/Aluno.php';

try
{

    extract($_POST);

    if($action == "cadastrar"){

        Transacao::open('arquivoConfigBase');
        Transacao::setLogger(new LoggerTXT('logs/log.txt'));
        
        $aluno = new Aluno();
        if($codigoAluno){
            $aluno = new Aluno($codigoAluno);
        }

        $aluno->altura = $altura;
        $aluno->nome = $nomeAluno;
        $aluno->cpf = $cpf;
        $aluno->dataNascimento = $dataNascimento;
        
        $aluno->store();

        Transacao::close();

    }
    
    Transacao::close();

}
catch(Exception $e){

    Transacao::rollback();
    print $e->getMessage();

}

?>
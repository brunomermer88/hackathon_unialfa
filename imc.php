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

    if($action){

        Transacao::open('arquivoConfigBase');
        Transacao::setLogger(new LoggerTXT('logs/log.txt'));
        
        $aluno = new Aluno($codigoAluno);
        $aluno->altura = 1.90;

        $imc = new Imc();
        $imc->peso = $peso;
        $imc->imc = $peso / ($aluno->altura*$aluno->altura);
        $imc->idAluno = $aluno->id;
        $imc->store();

        Transacao::close();

    }

}
catch(Exception $e){

    Transacao::rollback();
    print $e->getMessage();

}
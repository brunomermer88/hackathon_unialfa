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

    Transacao::open('arquivoConfigBase');
    Transacao::setLogger(new LoggerTXT('logs/log.txt'));
    
    $aluno = new Aluno();
    $aluno->altura = 1.90;
    $aluno->nome = "Gael Sena";
    $aluno->cpf = "111.222.333-44";
    $aluno->dataNascimento = "1988-08-15";
    $aluno->store();

    Transacao::close();

}
catch(Exception $e){

    Transacao::rollback();
    print $e->getMessage();

}

?>
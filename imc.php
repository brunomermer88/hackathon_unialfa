<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'Connection.php';
require_once 'Transacao.php';


require_once 'Logger.php';
require_once 'LoggerTXT.php';

require_once 'Record.php';
require_once 'Pessoa.php';
require_once 'Estudante.php';
require_once 'Professor.php';
require_once 'Aluno.php';

try
{

    $params = extract($_REQUEST);

    if($cadastrar){

        print_r($params);
        return;

        Transacao::open('arquivoConfigBase');

        Transacao::setLogger(new LoggerTXT('log.txt'));

        $pessoa = new Aluno();
        $pessoa->nome = "Bruno";
        $pessoa->cpf = "333333333";
        $pessoa->dataNascimento = "1988-08-15";
        $pessoa->store();

        

        Transacao::close();

    }

}
catch(Exception $e){

    Transacao::rollback();
    print $e->getMessage();

}
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
        
        $aluno = new Aluno($codigoAluno);
        
        $imc = new Imc();
        $imc->peso = $peso;
        $imc->imc = $peso / ($aluno->altura*$aluno->altura);
        $imc->idAluno = $aluno->id;
        $imc->store();

        Transacao::close();

    }

    if($action == "cadastro"){

        Transacao::open('arquivoConfigBase');
        Transacao::setLogger(new LoggerTXT('logs/log.txt'));

        $aluno = new Aluno($codigoAluno);
        $aluno = json_encode(array("nome"=>$aluno->nome,"codigoAluno"=>$aluno->id,"altura"=>$aluno->altura));
        echo $aluno;
        return;

        Transacao::close();

    }

    if($action == "lista"){

        Transacao::open('arquivoConfigBase');
        Transacao::setLogger(new LoggerTXT('logs/log.txt'));

        $aluno = new Aluno();
        echo json_encode($aluno->tabelaListaAlunos());
        return;

        Transacao::close();

    }

    if($action == "listaImcPorAluno"){

        Transacao::open('arquivoConfigBase');
        Transacao::setLogger(new LoggerTXT('logs/log.txt'));

        $imc = new Imc();
        echo json_encode($imc->tabelaListaImcs($codigoAluno));
        return;

        Transacao::close();

    }


}
catch(Exception $e){

    Transacao::rollback();
    print $e->getMessage();

}
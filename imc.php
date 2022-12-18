<?php
include 'controllers/checkSession.php';
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'Connection.php';
require_once 'Transacao.php';

require_once 'Logger.php';
require_once 'LoggerTXT.php';

require_once 'models/Record.php';
require_once 'models/Imc.php';
require_once 'models/Usuario.php';

try
{

    extract($_POST);

    if($action == "cadastrar"){

        Transacao::open('arquivoConfigBase');
        Transacao::setLogger(new LoggerTXT('logs/log.txt'));
        
        $aluno = new Usuario($codigoAluno);

        $imc = new Imc();
        $imc->peso = $peso;
        $imc->imc = $peso / ($aluno->altura*$aluno->altura);
        $imc->idAluno = $aluno->id;
        $imc->idProfessor = $_SESSION['codUsuario'];

        $imc->store();

        Transacao::close();

    }

    if($action == "cadastro"){

        Transacao::open('arquivoConfigBase');
        Transacao::setLogger(new LoggerTXT('logs/log.txt'));

        $aluno = new Usuario($codigoAluno);

        $dataUsuario = str_replace("/", "-", $aluno->data_nascimento);
        $dataBanco =  date('d-m-Y', strtotime($dataUsuario));

        $aluno = json_encode(array("nome"=>$aluno->nome,"codigoAluno"=>$aluno->id,"altura"=>$aluno->altura,"cpf"=>$aluno->cpf,"dataNascimento"=>$dataBanco,"tipo"=>$aluno->tipo));
        echo $aluno;
        return;

        Transacao::close();

    }

    if($action == "lista"){

        Transacao::open('arquivoConfigBase');
        Transacao::setLogger(new LoggerTXT('logs/log.txt'));

        $aluno = new Usuario();
        echo json_encode($aluno->tabelaListaUsuarios());
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
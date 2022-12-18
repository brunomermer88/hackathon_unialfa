<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'Connection.php';
require_once 'Transacao.php';

require_once 'Logger.php';
require_once 'LoggerTXT.php';

require_once 'models/Record.php';
require_once 'models/Usuario.php';


try
{

    extract($_POST);

    if($action == "autenticar"){

        Transacao::open('arquivoConfigBase');
        Transacao::setLogger(new LoggerTXT('logs/log.txt'));
        
        $aluno = new Usuario();
        $aluno->email = $login;
        $aluno->password = $senha;

        $usuarioRetornado = $aluno->findUserWithWhere();

        if($usuarioRetornado){
            
            $_SESSION['codUsuario'] = $usuarioRetornado[$aluno->getCampoID()];
            $_SESSION['tipo'] = $usuarioRetornado['tipo'];
            echo true;
            return;
        }

        echo false;
        return;

        Transacao::close();

    }
    
    Transacao::close();

}
catch(Exception $e){

    Transacao::rollback();
    print $e->getMessage();

}

?>
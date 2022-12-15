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

    Transacao::open('arquivoConfigBase');

    Transacao::setLogger(new LoggerTXT('log.txt'));

    /* Atualiza pessoa com o id 4 */
    /* $pessoa = new Pessoa(4);
    $pessoa->nome = "Vanessa Sena";
    $pessoa->telefone = "041 11111111";
    $pessoa->email = "bmermer@gmail.com";
    $pessoa->data_nascimento = "1111-11-11";
    $pessoa->store(); */

    $pessoa = new Aluno();
    $pessoa->nome = "Bruno";
    $pessoa->cpf = "333333333";
    $pessoa->dataNascimento = "1988-08-15";
    $pessoa->store();

    /* $estudante = new Estudante(7);
    $estudante->matricula = "1201100175";
    $estudante->ira = 24;
    $estudante->store(); */

    /* Cria professor */
    /* $professor = new Professor();
    $professor->pessoa_id = $pessoa->id;
    $professor->especialidade = "PHP OO";
    $professor->salario = 5000;
    $professor->store(); */

    /* deleta professor conforme id passado no construtor */
    // $professor = new Professor(1);
    // $professor->delete();

    Transacao::close();

}
catch(Exception $e){

    Transacao::rollback();
    print $e->getMessage();

}
<?php

class Usuario extends Record {
    const TABLENAME = 'tbl_usuarios';
    const CAMPO_ID = 'id';


    public function tabelaListaUsuarios(){

        $alunos = parent::loadAll();

        $tabela = "";
        $tabela .= '<table style="text-align:center;margin:0 auto;">';
        $tabela .= '<tr><th style="border:1px solid gray;">Cód.</th><th style="border:1px solid gray;">Nome</th></tr>';

        foreach($alunos as $aluno){
            $tabela .= "<tr><td><a href='cadastraIMCAluno.php?codigoAluno={$aluno['id']}'>{$aluno['id']}</a></td><td>{$aluno['nome']}</td></tr>";
        }

        $tabela .= "</table>";

        return $tabela;
    }

}
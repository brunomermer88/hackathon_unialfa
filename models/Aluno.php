<?php

class Aluno extends Record {
    const TABLENAME = 'tbl_alunos';
    const CAMPO_ID = 'id';


    public function tabelaListaAlunos(){

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
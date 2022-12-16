<?php

class Imc extends Record {
    const TABLENAME = 'tbl_imcs_cadastrados';
    const CAMPO_ID = 'id';

    public function tabelaListaImcs($codigoAluno){

        // monta a instrucao SELECT
        $sql = "SELECT * FROM ".self::TABLENAME." WHERE idAluno = $codigoAluno";
        $alunos = null;
        // obtem transcao ativa
        if($conn = Transacao::get())
        {
            // cria mensagem de log e executa a consulta
            Transacao::log($sql);
            $result = $conn->query($sql);
            // se retornou algum dado
            if($result)
            {
                // retorna os dados em forma de objeto
                $alunos = $result->fetchAll(PDO::FETCH_ASSOC);

            }

        }
        else
        {
            throw new Exception('Não há transação ativa!');
        }


        if(count($alunos) == 0){
            $tabela = "";
            $tabela .= '<table style="text-align:center;margin:0 auto;">';
            $tabela .= '<tr><th style="border:1px solid gray;">IMC por aluno</th></tr>';
            $tabela .= '<tr><td style="border:1px solid gray;">Sem registro</td></tr>';
            $tabela .= "</table>";
            return $tabela;
        }

        $tabela = "";
        $tabela .= '<table style="text-align:center;margin:0 auto;">';
        $tabela .= '<tr><th style="border:1px solid gray;" colspan="5">IMC por aluno</th></tr>';
        $tabela .= '<tr><th style="border:1px solid gray;">Data</th>';
        $tabela .= '<th style="border:1px solid gray;">Cód. Aluno</th>';
        $tabela .= '<th style="border:1px solid gray;">Cód. Professor</th>';
        $tabela .= '<th style="border:1px solid gray;">Imc</th>';
        $tabela .= '<th style="border:1px solid gray;">Peso</th></tr>';

        foreach($alunos as $aluno){
            $tabela .= "<tr><td>{$aluno['dataCadastro']}</td>";
            $tabela .= "<td>{$aluno['idAluno']}</td>";
            $tabela .= "<td>{$aluno['idProfessor']}</td>";
            $tabela .= "<td>{$aluno['imc']}</td>";
            $tabela .= "<td>{$aluno['peso']}</td>";
            $tabela .= "</tr>";
        }

        $tabela .= "</table>";

        return $tabela;

    }

}
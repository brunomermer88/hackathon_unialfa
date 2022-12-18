<?php



?>

<!DOCTYPE html>
<html>
<head>
<title>Cadastrar / Atualizar - Aluno - Professor</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <style>

        body,*{
            font-family:verdana;
            font-size:12px;
        }

        #dadosGerais {
            width:auto;
            max-width:800px;
            border:1px solid gray;
            margin:0 auto;
            padding:4px;
        }

        #dadosCadastroIMC {
            width:auto;
            max-width:800px;
            border:1px solid gray;
            margin:0 auto;
            padding:4px;
            text-align:center;
        }

        #dadosCadastroIMC label {
            margin-right: 4px;
        }

        #lista {
            width:auto;
            max-width:800px;
            border:1px solid gray;
            margin:0 auto;
            padding:4px;
            text-align:center;
        }

        #listaImcPorAluno {
            width:auto;
            max-width:800px;
            border:1px solid blue;
            margin:0 auto;
            padding:4px;
            text-align:center;
        }

    </style>


    <script>

        $(document).ready(function(){

            var paramCodigoAluno = <?php echo $_GET['codigoAluno'] ?? 0; ?>;

            if(paramCodigoAluno)
                $("#cadastrar").val("Atualizar");
            

            $.post(window.location.origin+"/imc.php", {action: 'lista'}, function(data, status){
                var textoTratado = data.replaceAll("cadastraIMCAluno", "cadastralAlunoProfessor");
               $("#lista").html(textoTratado);
            },"json");

            $.post(window.location.origin+"/imc.php", {action: 'cadastro', codigoAluno: paramCodigoAluno}, function(data, status){
                if(paramCodigoAluno){
                    var pessoa = data;
                    //console.log(pessoa);
                    $("#nomeAluno").val(pessoa.nome);
                    $("#codigoAluno").val(pessoa.codigoAluno);
                    $("#alturaAluno").val(pessoa.altura);
                    $("#cpfAluno").val(pessoa.cpf);
                    $("#dataNascimento").val(pessoa.dataNascimento);
                    $('select[name=tipoCadastro]').val(data.tipo);
                }
            },"json");

            // Cadastrar ou atualizar
            $("#cadastrar").click(function(){

                var codigoAluno = $("#codigoAluno").val();
                var aluno = $("#nomeAluno").val();
                var cpf = $("#cpfAluno").val();
                var dataNascimento = $("#dataNascimento").val();
                var alturaAluno = $("#alturaAluno").val();
                var tipo = $("#tipoCadastro").val();

                $.post(window.location.origin+"/aluno.php", 
                {action: 'cadastrar', 
                codigoAluno: codigoAluno,
                nomeAluno: aluno,
                cpf: cpf,
                dataNascimento: dataNascimento,
                altura: alturaAluno,
                tipo: tipo
                }, 
                function(data, status){
                    window.location.reload();
                });

            });

            $("#novo").click(function(){
                window.location.replace(window.location.origin+window.location.pathname);
            });

        });

    </script>

</head>

<body>

    <div id="dadosGerais">
        <form method="POST" action="">
            <p>ID: <input type="text" id="codigoAluno" disabled /></p>
            <p>Aluno: <input type="text" id="nomeAluno" /></p>
            <p>CPF: <input type="text" id="cpfAluno" /></p>
            <p>Data nascimento: <input type="text" id="dataNascimento" /></p>
            <p>Altura: <input type="text" id="alturaAluno" /></p>
            <p>Tipo: 
                <select name="tipoCadastro" id="tipoCadastro">
                    <option value="Aluno">Aluno</option>
                    <option value="Professor">Professor</option>
                </select>
            </p>
            <input type="button" value="Cadastrar" id="cadastrar" />
            <input type="button" value="Novo usuário" id="novo" />
            
        </form>
    </div>

    <div>
    <br />
    <div id="lista">

    </div>
    <br />

</body>

</html>
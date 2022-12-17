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
                console.log(data);
               $("#lista").html(textoTratado);
            },"json");

            $.post(window.location.origin+"/imc.php", {action: 'cadastro', codigoAluno: paramCodigoAluno}, function(data, status){
                var pessoa = data;
                $("#nomeAluno").val(pessoa.nome);
                $("#codigoAluno").val(pessoa.codigoAluno);
                $("#alturaAluno").val(pessoa.altura);
            },"json");

            // Cadastrar ou atualizar
            $("#cadastrar").click(function(){
                var codigoAluno = $("#codigoAluno").val();
                var aluno = $("#nomeAluno").val();
                var cpf = $("#cpfAluno").val();
                var dataNascimento = $("#dataNascimento").val();
                var alturaAluno = $("#alturaAluno").val();

                $.post(window.location.origin+"/aluno.php", 
                {action: 'cadastrar', 
                codigoAluno: codigoAluno,
                nomeAluno: aluno,
                cpf: cpf,
                dataNascimento: dataNascimento,
                altura: alturaAluno
                }, 
                function(data, status){
                    window.location.reload();
                });

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
            <input type="button" value="Cadastrar" id="cadastrar" />
        </form>
    </div>

    <div>
    <br />
    <div id="lista">

    </div>
    <br />

</body>

</html>
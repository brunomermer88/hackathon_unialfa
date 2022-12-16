<?php



?>

<!DOCTYPE html>
<html>
<head>
<title>IMC por aluno</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <style>

        body,*{
            font-family:verdana;
            font-size:12px;
        }

        #dadosGeraisAluno {
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

        #listaAlunos {
            width:auto;
            max-width:800px;
            border:1px solid gray;
            margin:0 auto;
            padding:4px;
            text-align:center;
        }

    </style>


    <script>

        $(document).ready(function(){

            $.post(window.location.origin+"/imc.php", {action: 'lista'}, function(data, status){
                alert(data);
               //$("#listaAlunos").val(data);
               $("#listaAlunos").html(data);
            },"json");

            $.post(window.location.origin+"/imc.php", {action: 'cadastro', codigoAluno: 1}, function(data, status){
                var pessoa = data;
                $("#nomeAluno").val(pessoa.nome);
                $("#codigoAluno").val(pessoa.codigoAluno);
                $("#alturaAluno").val(pessoa.altura);

            },"json");

            // Cadastrar peso
            $("#cadastrarPeso").click(function(){
                var valorPeso = $("#peso").val();
                $.post(window.location.origin+"/imc.php", {action: 'cadastrar', peso: valorPeso, codigoAluno: 1}, function(data, status){
                    alert("Data: " + data + "\nStatus: " + status);
                });
            });

        });

    </script>

</head>

<body>

    <div id="dadosGeraisAluno">
        <p>ID: <input type="text" id="codigoAluno" disabled /></p>
        <p>Aluno: <input type="text" id="nomeAluno" disabled /></p>
        <p>Altura: <input type="text" id="alturaAluno" disabled /></p>
    </div>

    <div>
    <br />
    <div id="listaAlunos">

    </div>
    <br />
    <div id="dadosCadastroIMC">
        <form method="POST">
            <label>Peso</label><input type="text" name="peso" id="peso" />
            <input type="button" value="Cadastrar" id="cadastrarPeso" />
        </form>
    </div>

</body>

</html>
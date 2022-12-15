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


    </style>


    <script>

        $(document).ready(function(){

            // Cadastrar peso
            var valorPeso = $("#peso").val();
            $("#cadastrarPeso").click(function(){
                $.post(window.location.origin+"/imc.php?cadastrar=1", {peso: valorPeso}, function(data, status){
                    alert("Data: " + data + "\nStatus: " + status);
                });
            });


        });

    </script>

</head>

<body>

    <div id="dadosGeraisAluno">
        <p>ID:  </p>
        <p>Aluno: </p>
        <p>Altura: </p>
    </div>

    <div>
    <br />
    <div id="dadosCadastroIMC">
        <form method="POST">
            <label>Peso</label><input type="text" name="peso" id="peso" />
            <input type="button" value="Cadastrar" id="cadastrarPeso" />
        </form>
    </div>

</body>

</html>
<?php 
include 'controllers/checkSession.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>hackton.unialfa</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<style>

h1,p,a {
    text-align:center;
    color:black;
    font-family:verdana;
    font-size:14px;
    text-decoration:none;
    padding:4px;
}

a {
    font-size:18px;
    border:1px solid gray;
    padding:4px;
}

</style>

</head>
<body>

<h1>hackton.unialfa</h1>

<p><a href="views/cadastralAlunoProfessor.php">Usuarios</a> | <a href="views/cadastraIMCAluno.php">IMC</a> | <a href="controllers/logout.php">sair</a></p>

</body>
</html>
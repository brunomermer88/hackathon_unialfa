<?php
// Definimos o nome do arquivo que será exportado  
$arquivo = "rel_excel_".date('His').".xls";  

// Configurações header para forçar o download  
header('Content-Encoding: UTF-8');
header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment;filename="'.$arquivo.'"');
header('Cache-Control: max-age=0');
// Se for o IE9, isso talvez seja necessário
header('Cache-Control: max-age=1');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<meta charset="UTF-8">

</script>
</head>       
<body>
<?php
$arquivoIncluir = $_GET['fileName']; 
include "../arquivosTemporarios/{$arquivoIncluir}"; ?>
</body>
</html>



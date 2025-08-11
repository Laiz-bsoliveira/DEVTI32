<?php

$nome = "";
$sobrenome = "";
$idade=null;

// ACONTECE APÓS CLICAR NO AÇÃO
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome = $_POST['txtnome'];
    $sobrenome = $_POST['txtsobrenome'];
    $idade = $_POST['txtidade'];
}

echo("Nome: $nome<br>");
echo("Sobrenome: $sobrenome<br>");
echo("Idade: $idade<br>");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORMULARIO</title>
</head>
<body>
    <!-- FORMULARIO USA ACTION PARA CHAMAR UM SCRIPT PHP E O MÉTODO DE ENVIO -->
    <form class="formulario" action="formulario.php" method="post">
        <label>NOME</label>
        <br>
        <input type="text" name="txtnome" placeholder="Insira seu nome">
        <br>
        <br>
        <label>SOBRENOME</label>
        <br>
        <input type="text" name="txtsobrenome">
        <br>
        <br>
        <label>IDADE</label>
        <br>
        <input type="number" name="txtidade" placeholder="Somente números">
        <br>
        <br>
        <!-- BORA PRA ACTION -->
        <input type="submit" value="Ação">
    </form>
    
</body>
</html>
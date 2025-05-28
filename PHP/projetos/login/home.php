<?php 
session_start();
// $nome= $_SESSION['nomeusuario']
if (isset($_SESSION['nomeusuario'])){
    $nomeusuario = $_SESSION['nomeusuario'];
}
else{ 
 echo"<script>window.alert('LOGIN OU SENHA INCORRETOS');</script>";
 echo"<script>windows.location.href='login.php';</script>;" ;  
 
 //Header('Location: login.php');
}


 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>HOMEPAGE</title>
</head>
<body>
    <h1>BEM-VINDO <?php echo ($_SESSION['nomeusuario']) ?> </h1>

    <form action='logout.php'>
    <input type='submit' value='SAIR'>
</form>
</body>
</html>


<?php
session_start();
// VERIFICANDO SE A VARIÁVEL DE SESSÃO VEIO PREENCHIDA.
// SE NÃO VOLTA PRA LOGIN
if(isset($_SESSION['nomeusuario'])){
    $nomeusuario = $_SESSION['nomeusuario'];
}
else{
    echo"<script>window.alert('NÃO LOGADO MEU BOM');</script>";
    echo"<script>window.location.href='login.php';</script>";

}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME PAGE</title>
</head>
<body>
    <h1>BEM VINDO <?php echo($_SESSION['nomeusuario'])?></h1>
    
    <form action='logout.php'><input type='submit' value='SAIR'></form>

</body>
</html>
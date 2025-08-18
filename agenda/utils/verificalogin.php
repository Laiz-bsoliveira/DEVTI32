<?php 
session_start();
 
if (isset($_SESSION['idfuncionario'])){
    $idfuncionario = $_SESSION['idfuncionario'];

}
else{
    echo "<script>alert('Você não está logado!');</script>";
    echo "<script>window.location.href='login.php';</script>";
}
?>
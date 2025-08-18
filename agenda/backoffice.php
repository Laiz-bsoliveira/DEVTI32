<?php
// CONEXÃO COM O BANCO
include("utils/conectadb.php");
 
// INICIA VARIAVEIS DE SESSÃO
session_start();

if(isset($_SESSION['idfuncionario'])) {
$idfuncionario = $_SESSION['idfuncionario'];

$sql = "SELECT FUN_NOME FROM funcionarios WHERE FUN_ID = $idfuncionario";
 
$enviaquery = mysqli_query ($link, $sql);
 
 
$nomeusuario = mysqli_fetch_array ( $enviaquery ) [0];
}
else{
       echo("<script>window.alert('VOCE NAO TEM ACESSO A ESTA PAGINA');</script>");
        echo ("<script>window.location.href='login.php';</script>");
}
 
 

 
?> 
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- APONTA OS CSS ENVOLVIDOS -->
    <link rel="stylesheet" href="css/global.css">
    <title>BACKOFFICE</title>
</head>
<body>
    <div class="global">
        <div class="topo">

                 <!-- AQUI VAI TRAZER O NOME DO USUARIO LOGADO -->
                 <h1>BEM VINDO <?php echo strtoupper($nomeusuario)?> </h1>

                 <!-- BOTÃO DE ENCERRAMENTO DE SESSÃO -->
                 <div class="logout" method='post'>
                 <a href='logout.php'><a href=backoffice.php>
                   <button type="submit" class="btn-sair">🚪SAIR</button>
                   </a>
                  <!-- <input type="submit" value='SAIR'> -->
                 </div>
                 </div>

                 <div class='menus'>
                 <!-- OS CARDS DE MENU -->
               <div class="menu2">
                    <a href="servico_cadastra.php"><img src ='icons/th2.png' width="200" height="200"></a>
                      <label>Cadastrar Serviços</label>
                </div>
                <div class="menu1">
                    <a href="servico_lista.php"><img src ='icons/add9.png' width="200" height="200"></a>
                    <label>Lista Serviços</label>

                </div>
                <div class="menu3">
                    <a href="funcionario_cadastra.php"><img src ='icons/business.png' width="200" height="200"></a>
                    <label>Cadastrar Funcionários/Usuários</label>
                </div>

                <div class="menu4">
                    <a href="funcionario_lista.php"><img src ='icons/group1.png' width="200" height="200"></a>
                    <label>Funcionários e Usuários</label>
                </div>

                  <div class="menu6">
                    <a href="cliente_cadastra.php"><img src ='icons/add9.png' width="200" height="200"></a>
                    <label>Cadastrar Clientes</label>
                </div>

                <div class="menu5">
                    <a href="cliente_lista.php"><img src ='icons/th.png' width="200" height="200"></a>
                    <label>Listar Clientes</label>
                </div>

              
            </div>
    </div>
</html>
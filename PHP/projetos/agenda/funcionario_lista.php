<?php
//CONEÇÃO COM O BANCO
include("utils/conectadb.php");
include("utils/verificalogin.php");

//TRAZ A LISTA DE FUNCIONÁRIOS DO BANCO
$sqlfun = "SELECT * FROM funcionarios";
$enviaquery = mysqli_query($link, $sqlfun);

$sqlusu = "SELECT * FROM usuarios";
$enviaquery2 = mysqli_query($link, $sqlusu);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/lista.css">

    <title>LISTA FUNCIONÁRIOS</title>
</head>
<body>
    
 <div class='global'>
   <div class='tabela'>
    <a href=backoffice.php>
    <button type="submit" class="btn-sair">🚪 Sair</button>
    </a>
       <!--g src="img/voltar.png" alt="Voltar" class="voltar"> -->
    <table>
        <tr>
            <th>ID FUNCIONARIO</th>
            <th>NOME</th>
            <th>CPF</th>
            <th>CARGO</th>
            <th>CONTATO</th>
            <th>STATUS</th>
            <!-- DADOS DO USUARIO-->
            <th>LOGIN</th>
        </tr>
        <!-- INICIO PHP -->
        <?php
        while ($tbl = mysqli_fetch_array($enviaquery)){
            while ($tbl2 = mysqli_fetch_array($enviaquery)){
        ?>
        <tr>
            <td><?=$tbl[0]?></td> <!-- COLETA CODIGO DO FUN [0]-->
            <td><?=$tbl[1]?></td> <!-- COLETA NOME DO FUN [1]-->
            <td><?=$tbl[2]?></td> <!-- COLETA CPF DO FUN [2]-->
            <td><?=$tbl[3]?></td> <!-- COLETA CONTATO DO FUN [3]-->
            <td><?=$tbl[4]?></td> <!-- COLETA STATUS DO FUN [1]-->
            <td><?=$tbl[5]?></td> <!-- COLETA STATUS DO FUN [1]-->
            <!-- NOME USUARIO DO FUNCIONARIO -->
            <td><?=$tbl2[1]?></td> <!-- COLETA LOGIN DO USUARIO [1]-->
        </tr>
        <?php
        }
     }
        ?>
        </table>
  </div>

 </div>
</body>
</html>
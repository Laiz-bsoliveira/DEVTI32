<?php

// LOCALIZAÇÃO DO SERVIDOR DE BANCO
$servidor = "localhost";
// NOME DA BASE
$banco = "login";
// USUARIO DO BANCO
$usuario = "root";
// SENHA DO BANCO
$senha = "";

// RECURSO PARA CONEXÃO DO BANCO.
$link = mysqli_connect($servidor, $usuario, $senha, $banco);


?>
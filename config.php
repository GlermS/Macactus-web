<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$db = 'cadastro';

$con = mysqli_connect($dbhost,$dbuser,$dbpass);
if ($con){
    #echo("Conectado ");
}
if (!$con)
  {
  die('Erro de conexão: ' . mysqli_error());
  }

$sql = "USE ".$db."";
if ($con->query($sql) === TRUE) {
    #echo "Banco de dados encontrado ";
  } else {
    echo "Erro ao encontrar banco de dados: " . $con->error;
  }

?>
<?php
$dbhost = 'br814.hostgator.com.br';
$dbuser = 'macact56_root';
$dbpass = 'KingKonge2micos';
$db = 'macact56_macdev';

$link = mysqli_connect($dbhost,$dbuser,$dbpass);
if ($link){
    echo("Conectado ");
}
if (!$link)
  {
  die('Erro de conexão: ' . mysqli_error());
  }

$sql = "USE ".$db."";
if ($link->query($sql) === TRUE) {
    echo "Banco de dados encontrado ";
  } else {
    echo "Erro ao encontrar banco de dados: " . $link->error;
  }

?>
<?
$Mode=$_COOKIE["Mode"];  
$fio=$_COOKIE["fio"];  
$iduser=$_COOKIE["iduser"];  
$idmerch=$_COOKIE["idmerch"];  

$dblocation = "localhost";
$dbname = "perfume";
$dbuser = "root";
$dbpasswd = "";


$dbcnx = mysqli_connect($dblocation,$dbuser,$dbpasswd,$dbname);

    if(!$dbcnx)
    {
    ?>
    <meta charset="utf-8">
    <?
      echo 'Невозможно соединиться с БД';
      exit;
	}


?>

	<?
require "option.php";//файл с параметрами подключения к БД

$idmerch=$_GET['idmerch'];
mysqli_query($dbcnx,"INSERT INTO wishlist  (idmerch, iduser) VALUES($idmerch, $iduser)");

?>
 <script language="javascript">
 location.href='sale1.php';
 </script>

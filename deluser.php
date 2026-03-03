	<?
require "option.php";//файл с параметрами подключения к БД

$Arr=$_POST['Arr'];
$id=$Arr[0];
mysqli_query($dbcnx,"DELETE FROM user  WHERE iduser=$id");

?>
 <script language="javascript">
 location.href='user.php';
 </script>

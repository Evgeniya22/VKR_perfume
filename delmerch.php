	<?
require "option.php";//файл с параметрами подключения к БД

$Arr=$_POST['ArrMerch'];
$id=$Arr[0];
mysqli_query($dbcnx,"DELETE FROM merch  WHERE idmerch=$id");

?>
 <script language="javascript">
 location.href='merch.php';
 </script>

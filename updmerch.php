<?
require "option.php";//файл с параметрами подключения к БД

$step=$_REQUEST["step"];
if ($step==1)
{
setcookie ('file', '');
}
if ($step==3)
setcookie ( 'file', basename($_FILES["file"]["name"]));



$file=$_COOKIE["file"];


if ($step==2)
{
$upd=$_REQUEST["upd"];

$merch =  $_POST["merch"];
$idbrand =  $_POST["idbrand"];
$idsex =  $_POST["idsex"];
$idseasonality =  $_POST["idseasonality"];
$idcapacity =  $_POST["idcapacity"];
$idcategory =  $_POST["idcategory"];
$price =  $_POST["price"];
$annotation =  $_POST["annotation"];

if ($upd==1)
     $id=$_REQUEST["id"];	
	
	if ($price<=0) 
	{
	?>
<meta charset="utf-8">
		<script language="javascript">
		alert("Не верный ввод!");
		history.back();
		</script>

	<?
		exit();
	}	
//выполнение запроса на редактирование или добавление данных	
if ($upd==1)
  {  
	 mysqli_query($dbcnx,"UPDATE merch set merch='$merch', idcapacity='$idcapacity', idseasonality='$idseasonality', idsex='$idsex', idbrand='$idbrand', idcategory='$idcategory', price='$price', annotation='$annotation' WHERE idmerch=$id");
	 ?>
	 <script language="javascript">
	 location.href='merch.php?filter=0';
	 </script>
	 <?
  }  else
  {//формирование SQL-запроса на добавление данных
	 mysqli_query($dbcnx,"INSERT INTO merch (merch, idcategory, price, annotation, idcapacity, idseasonality, idsex, idbrand) VALUES ('$merch', '$idcategory', '$price', '$annotation', '$idcapacity', '$idseasonality', '$idsex', '$idbrand')");

	?>
	 <script language="javascript">
	 location.href='merch.php?filter=0';
	 </script>
	 <?
  }


}

if ($step==3)
{


$uploaddir = 'upload/';
$uploadfile = $uploaddir . basename($_FILES["file"]["name"]);


//phpinfo(32);
if ($_FILES['file']['size'] > 104857600)
{
?>
	 <script language="javascript">
	 alert ('Слишком большой файл!');
	 </script>
<?
}
else
if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) 
    echo "Файл корректен и был успешно загружен.\n";
 else 
    echo "Возможная атака с помощью файловой загрузки!\n";
?>
	 <script language="javascript">
	 history.back();
	 </script>
<?
	
}
?>


<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Магазин парфюмерии</title>

 		<!-- Google font -->
 		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

 		<!-- Bootstrap -->
 		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

 		<!-- Slick -->
 		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
 		<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

 		<!-- nouislider -->
 		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

 		<!-- Font Awesome Icon -->
 		<link rel="stylesheet" href="css/font-awesome.min.css">

 		<!-- Custom stlylesheet -->
 		<link type="text/css" rel="stylesheet" href="css/style.css"/>

 		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
 		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
 		<!--[if lt IE 9]>
 		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
 		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
 		<![endif]-->

    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> 778833</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i>perfume@ya.ru</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> г.Москва ул. Кропоткина 44</a></li>
					</ul>
					<ul class="header-links pull-right">
 <?
 	if ($Mode!="")
						{
 ?>
						<li><a href="#"><i class="fa fa-user-o"></i> <? echo $fio." ($Mode)";?></a></li>

<?
						}
						?>                        
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="index.php" class="logo">
									<img src="./img/logo.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->



						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">


								

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li><a href="index.php">На главную</a></li>
						<li><a href="user.php">Пользователи</a></li>
						<li><a href="category.php">Категории</a></li>
						<li class="active"><a href="merch.php">Товары</a></li>
						<li><a href="sale.php">Заказы</a></li>
						<li><a href="stats.php">Статистика</a></li>
						<li ><a href="index.php?step=2">Выход</a></li>                            
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->

		

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
                
<?
$upd=$_REQUEST["upd"];
if ($upd==1)
{
$Arr=$_REQUEST["ArrMerch"];

$r=mysqli_query($dbcnx,"select * from merch where idmerch="."$Arr[0]");
$f=mysqli_fetch_array($r);//считывание текующей записи
?>
<h3 class="breadcrumb-header">Редактирование товара (<? echo $f["merch"];?>)</h3>

<?
}
else
{
?>
<h3 class="breadcrumb-header">Добавление товара</h3>
<?
}
?>


<p>&nbsp;</p>
<form name="form2" method="post"  enctype="multipart/form-data" >
				  <table width="622" border="0">

                    <tr>
                      <td width="67"><font color="#000000" >   Товар: </font> </td>
                      <td ><input   name="merch"   type="text"  value="<? if ($upd==1) echo "$f[merch]"; else echo(""); ?>" size="40" ></td>
                    </tr>  	          
<tr> 
 <td><font color="#000000" >   Категория: </font></td>
        <td width="305">
        

        <select name="idcategory"  style="height:22; width:auto" >
  <?
$d=mysqli_query($dbcnx, "select * from category");

for ($i=0;$i<mysqli_num_rows($d);$i++)
  {
    $m=mysqli_fetch_array($d);
	echo "<option value=".$m["idcategory"];
	if (($upd==1)&&    ($m["idcategory"]==$f["idcategory"]))
	 echo " selected=selected";
	echo ">".$m["category"];
	echo "</option>";	 		
  }
  
?>
					  
</select></td>
</tr>      
                   
<tr> 
 <td><font color="#000000" >   Брэнд: </font></td>
        <td width="305">
        

        <select name="idbrand"  style="height:22; width:auto" >
  <?
$d=mysqli_query($dbcnx, "select * from brand");

for ($i=0;$i<mysqli_num_rows($d);$i++)
  {
    $m=mysqli_fetch_array($d);
	echo "<option value=".$m["idbrand"];
	if (($upd==1)&&    ($m["idbrand"]==$f["idbrand"]))
	 echo " selected=selected";
	echo ">".$m["brand"];
	echo "</option>";	 		
  }
  
?>
					  
</select></td>
</tr>

<tr> 
 <td><font color="#000000" >   Пол: </font></td>
        <td width="305">
        

        <select name="idsex"  style="height:22; width:auto" >
  <?
$d=mysqli_query($dbcnx, "select * from sex");

for ($i=0;$i<mysqli_num_rows($d);$i++)
  {
    $m=mysqli_fetch_array($d);
	echo "<option value=".$m["idsex"];
	if (($upd==1)&&    ($m["idsex"]==$f["idsex"]))
	 echo " selected=selected";
	echo ">".$m["sex"];
	echo "</option>";	 		
  }
  
?>
					  
</select></td>
</tr>

<tr> 
 <td><font color="#000000" >   Сезонность: </font></td>
        <td width="305">
        

        <select name="idseasonality"  style="height:22; width:auto" >
  <?
$d=mysqli_query($dbcnx, "select * from seasonality");

for ($i=0;$i<mysqli_num_rows($d);$i++)
  {
    $m=mysqli_fetch_array($d);
	echo "<option value=".$m["idseasonality"];
	if (($upd==1)&&    ($m["idseasonality"]==$f["idseasonality"]))
	 echo " selected=selected";
	echo ">".$m["seasonality"];
	echo "</option>";	 		
  }
  
?>
					  
</select></td>
</tr>

<tr> 
 <td><font color="#000000" >   Объём: </font></td>
        <td width="305">
        

        <select name="idcapacity"  style="height:22; width:auto" >
  <?
$d=mysqli_query($dbcnx, "select * from capacity");

for ($i=0;$i<mysqli_num_rows($d);$i++)
  {
    $m=mysqli_fetch_array($d);
	echo "<option value=".$m["idcapacity"];
	if (($upd==1)&&    ($m["idcapacity"]==$f["idcapacity"]))
	 echo " selected=selected";
	echo ">".$m["capacity"];
	echo "</option>";	 		
  }
  
?>
					  
</select></td>
</tr>
                                      
                    <tr>
                      <td><font color="#000000" > Цена: </font> </td>
                      <td><input   name="price"  value="<? if ($upd==1) echo "$f[price]"; else echo(""); ?>"   type=number min=1 ></td>
                    </tr>  			  
                       

                    

		            <tr>
                      <td><font color="#000000" >  Описание: </font> </td>
                      <td><textarea name="annotation"><? if ($upd==1) echo "$f[annotation]"; else echo(""); ?></textarea></td>
                    </tr>                      
                  </table>
				<br>
				<input  type="button"  name="button"   onclick="this.form.action='updmerch.php?step=2&upd=<? echo"$upd";?>&id=<? echo"$Arr[0]";?>'; this.form.submit();"   value="OK" width="500">
				<input  type="button"  name="button"  onClick="javascript:history.back();"  value="Отмена">

		</form>		

		    </div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

	
    

		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>

	</body>
</html>
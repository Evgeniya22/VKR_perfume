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
$id=$_REQUEST["id"];	

$file =  $_COOKIE["file"];
if ($file==NULL)
$file="";

	

  {//формирование SQL-запроса на добавление данных
	 mysqli_query($dbcnx,"UPDATE merch set file='$file' WHERE idmerch=$id");
	
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
if (!(move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) )
    echo "Возможная атака с помощью файловой загрузки!\n";
?>
	 <script language="javascript">
	 history.back();
	 </script>
<?
exit();	
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
								<a href="#" class="logo">
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
						<li  class="active"><a href="merch.php">Товары</a></li>
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
$Arr=$_REQUEST["ArrMerch"];

$r=mysqli_query($dbcnx,"select * from merch where idmerch="."$Arr[0]");
$f=mysqli_fetch_array($r);//считывание текующей записи
?>
<h3 class="breadcrumb-header">Редактирование файла с фотографией товара (<? echo $f["merch"];?>)</h3>




<p>&nbsp;</p>
<form name="form2" method="post"  enctype="multipart/form-data" >
				  <table width="622" border="0">
                    <tr >
                      <td><font color="#000000" >Фото:  </font></td>
                      <td> 
							<table>
                            <tr>
						<td>
						<input name="file" type="file" size="19" />  
                       </td>
                       <td>
                      <input type="button"  name="button"  value="Загрузить" onClick="this.form.action='updfile.php?step=3'; this.form.submit();">
                      </td>
                      </tr>
                      	</table>
                      </td>
                    </tr> 
               
                  </table>
				<br>
				<input  type="button"  name="button"   onclick="this.form.action='updfile.php?step=2&upd=<? echo"$upd";?>&id=<? echo"$Arr[0]";?>'; this.form.submit();"   value="OK" width="500">
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

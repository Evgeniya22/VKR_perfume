<?
require "option.php";//файл с параметрами подключения к БД
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

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form>


								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

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
						<li><a href="merch.php">Товары</a></li>
						<li><a href="sale.php">Заказы</a></li>
						<li class="active"><a href="stats.php">Статистика</a></li>				
						<li ><a href="index.php?step=2"> 
Выход</a></li>                            
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->

	

<?
$step=$_REQUEST["step"];

$filter=$_GET["filter"];//считывание параметра фильтра
	

if ($filter)
{
$date1=$_POST["date1"];;   
$date2=$_POST["date2"];
}
else
{
$date1=(date("Y")-1)."-".date("m")."-".date("d");   
$date2=date("Y")."-".date("m")."-".date("d");  
}

 
?>	

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
      
     		<div align="right">	       	

<form name="form2"  method="post" >
<font color="#000000"  size="+1">Период: </font>	
                 <input name="date1" type="date"  value="<?  echo($date1); ?>">
                 <input name="date2" type="date"  value="<?   echo($date2); ?>">

				<br>
				<input  type="button"  name="button1"  onclick="this.form.action='stats.php?filter=1'; this.form.submit();"   value="Фильтр">
				<input  type="button"  name="button2"  onclick="this.form.action='stats.php?filter=0'; this.form.submit();"   value="Очистить">
           <br>        

</form>
     </div>       
<?
$s="SELECT merch.idmerch, merch.merch, category.category, price, (select avg(mark) from response where response.idmerch=merch.idmerch and dateresponse>='$date1' and dateresponse<='$date2') as avgmark FROM merch INNER JOIN category ON category.idcategory = merch.idcategory order by avgmark DESC";
$r=mysqli_query($dbcnx,$s);
?>



<h3 class="breadcrumb-header">Рейтинг заказанной продукции</h3>

        
              
  <table WIDTH=100% border=1 cellspacing=0 cellpadding=3>
									<tr>
                             
		<td ><h5>Товар</h5></td>
		<td ><h5>Категория</h5></td>
		<td ><h5>Цена</h5></td>
		<td ><h5>Средняя оценка</h5></td> 		  				
			</tr>
        
        
      <?
		 


			for ($i=0;$i<mysqli_num_rows($r);$i++)//вывод данных в цикле по количеству записей
			  {
				$f=mysqli_fetch_array($r);//считывание текующей записи				
				echo "<tr>";

		
				echo "
				<td> $f[merch]</td>
				<td> $f[category]</td>
				<td> $f[price]</td>
				<td> $f[avgmark]</td>
				</tr>";

			  }		 
		?>
      
  </table> 




				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

	
    



















		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
                
<h3 class="breadcrumb-header">Отчет о прибыли за период</h3>
<form name="form2"  method="post"  >
 
 <?
$s="select COALESCE(SUM(countmerch*price), 0) as sumorder from detail, sale, merch where   detail.idmerch=merch.idmerch  and sale.idsale=detail.idsale and datesale>='$date1' and datesale<='$date2' and status like 'Заказ'";
$r=mysqli_query($dbcnx,$s);
$f=mysqli_fetch_array($r);//считывание текующей записи
$sumorder=$f[sumorder];

$s="select COALESCE(SUM(countmerch*price), 0) as sumsale from detail, sale, merch where   detail.idmerch=merch.idmerch  and sale.idsale=detail.idsale and datesale>='$date1' and datesale<='$date2' and status like 'Продано'";
$r=mysqli_query($dbcnx,$s);
$f=mysqli_fetch_array($r);//считывание текующей записи
$sumsale=$f[sumsale];

$s="select COALESCE(COUNT(iddetail), 0) as countorder from detail, sale, merch where   detail.idmerch=merch.idmerch  and sale.idsale=detail.idsale and datesale>='$date1' and datesale<='$date2' and status like 'Заказ'";
$r=mysqli_query($dbcnx,$s);
$f=mysqli_fetch_array($r);//считывание текующей записи
$countorder=$f[countorder];

$s="select COALESCE(COUNT(iddetail), 0)  as countsale from detail, sale, merch where   detail.idmerch=merch.idmerch  and sale.idsale=detail.idsale and datesale>='$date1' and datesale<='$date2' and status like 'Продано'";
$r=mysqli_query($dbcnx,$s);
$f=mysqli_fetch_array($r);//считывание текующей записи
$countsale=$f[countsale];
?>
         


               
               
              
              
  <table WIDTH=100% border=1 cellspacing=0 cellpadding=3>
									<tr>
                             
		<td ><h5>Сумма заказов</h5></td>
		<td ><h5>Количество заказов</h5></td>
		<td ><h5>Сумма продаж</h5></td>
		<td ><h5>Количество продаж</h5></td> 			  				
			</tr>
        
        
      <?
		 


			for ($i=0;$i<mysqli_num_rows($r);$i++)//вывод данных в цикле по количеству записей
			  {
				$f=mysqli_fetch_array($r);//считывание текующей записи				
				echo "<tr>";

		
				echo "
				<td> $sumorder</td>
				<td> $countorder</td>
				<td> $sumsale</td>
				<td> $countsale</td>
				</tr>";

			  }		 
		?>
      
  </table> 

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

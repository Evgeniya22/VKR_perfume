<?
require "option.php";//файл с параметрами подключения к БД
?>

<?
$step=$_REQUEST["step"];
if ($step==2)
{
$upd=$_REQUEST["upd"];

$surname =  $_POST["surname"];
$firstname =  $_POST["firstname"];
$patronymic =  $_POST["patronymic"];
$mail =  $_POST["mail"];
$login =  $_POST["login"];
$password =  $_POST["password"];
$reppassword =  $_POST["reppassword"];
$permission = "Покупатель";



$error=0;
//формируем сообщение об ошибке
if ( (trim($surname)=="") or (trim($login)=="")  or (trim($password)=="") ) 
$error=1;

if (trim($surname)=="")
$alert=$alert."Введите фамилию<br>";

if (trim($login)=="")
$alert=$alert."Введите поле логин! <br>";

if (trim($password)=="")
$alert=$alert."Введите пароль! <br>";


$SET_user=mysqli_query($dbcnx,"select * from user where login='$login'");
$COUNT_user=mysqli_num_rows($SET_user);

if ($COUNT_user!=0)
{
	$error=1;
	$alert=$alert."Пользователь с таким логином уже существует! <br>";
} 


if ( ( strpos($mail, "@")==0)  or ( strpos($mail, ".")==0) )
{
	$error=1;
	$alert=$alert."Введите корректный адрес электронной почты! <br>";
}

$SET_user=mysqli_query($dbcnx,"select * from user where mail='$mail'");
$COUNT_user=mysqli_num_rows($SET_user);

if ($COUNT_user!=0)
{
	$error=1;
	$alert=$alert."Пользователь с таким адресом электронной почты уже существует! <br>";
} 


if (trim($password)<>trim($reppassword))
{
	$error=1;
	$alert=$alert."Повторите пароль корректно! <br>";
} 


if ($error==1)
{
$alert="Ошибка ввода данных!<br>".$alert;
?>
<meta charset="utf-8">
<script language="javascript">
var text = "<? echo $alert;?>";
text=text.replace(new RegExp("<br>",'g'),"\n");
alert(text);
history.back();
</script>
<?
exit();
}	
	

  {//формирование SQL-запроса на добавление данных
	 mysqli_query($dbcnx,"INSERT INTO user (login, password, mail, permission, surname, firstname, patronymic) VALUES ('$login', '$password', '$mail', '$permission', '$surname', '$firstname', '$patronymic')");
	 	
	?>
	 <script language="javascript">
	 location.href='index.php?filter=0';
	 alert("Регистрация успешно завершена!");
	 </script>
	 <?
  }
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
						<li ><a href="index.php">Главная</a></li>                           
						<li  class="active"><a href="#">Регистрация</a></li>


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
                
<h3 class="breadcrumb-header">Регистрация покупателя</h3>
<form name="form2" method="post"  >
				  <table width="422" border="0">
                    <tr>
                      <td width="107"><font color="#000000" >   Фамилия: </font> </td>
                      <td><input   name="surname"   type="text"  value="<? if ($upd==1) echo "$f[surname]"; else echo(""); ?>" size="40" ></td>
                    </tr>  
                    <tr>
                      <td width="107"><font color="#000000" >   Имя: </font> </td>
                      <td><input   name="firstname"   type="text"  value="<? if ($upd==1) echo "$f[firstname]"; else echo(""); ?>" size="40" ></td>
                    </tr>  	     
                    <tr>
                      <td width="107"><font color="#000000" >   Отчество: </font> </td>
                      <td><input   name="patronymic"   type="text"  value="<? if ($upd==1) echo "$f[patronymic]"; else echo(""); ?>" size="40" ></td>
                    </tr>  	 	          
                    <tr>
                      <td width="107"><font color="#000000" >   Почта: </font> </td>
                      <td><input   name="mail"   type="text"  value="" size="40" ></td>
                    </tr>  	                                                                 
                    <tr>
                      <td><font color="#000000" > Логин: </font> </td>
                      <td><input   name="login"  value=""   type="text" ></td>
                    </tr>  				  
                    <tr>
                      <td><font color="#000000" >  Пароль: </font> </td>
                      <td><input   name="password"  value=""   type="password" ></td>
                    </tr>      
                    <tr>
                      <td><font color="#000000" >  Повторите пароль: </font> </td>
                      <td><input   name="reppassword"  value=""   type="password" ></td>
                    </tr>                                                  
				          
                  </table>
				<br>
				<input  type="button"  name="button"   onclick="this.form.action='reg.php?step=2&upd=<? echo"$upd";?>&id=<? echo"$Arr[0]";?>'; this.form.submit();"   value="OK" width="500">
				<input  type="button"  name="button"  onClick="javascript:history.back();"  value="Отмена">

		</form>		


				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

	
    
    <!-- HOT DEAL SECTION -->
		<div id="hot-deal" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="hot-deal">
							<ul class="hot-deal-countdown">
								<li>
									<div>
										<h3>02</h3>
										<span>Дня</span>
									</div>
								</li>
								<li>
									<div>
										<h3>10</h3>
										<span>Часов</span>
									</div>
								</li>
								<li>
									<div>
										<h3>34</h3>
										<span>Минуты</span>
									</div>
								</li>

							</ul>
							<h2 class="text-uppercase">Горячая распродажа</h2>

							<a class="primary-btn cta-btn" href="#">Купить</a>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /HOT DEAL SECTION -->
        
        	

		<!-- FOOTER -->
		<footer id="footer">
		

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
							</ul>
							<span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>


						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>

	</body>
</html>

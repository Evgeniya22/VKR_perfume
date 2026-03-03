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
$permission =  $_POST["permission"];

if ($upd==1)
     $id=$_REQUEST["id"];	


$error=0;
//формируем сообщение об ошибке
if ( (trim($surname)=="")  or (trim($login)=="") or (trim($mail)=="") or (trim($password)=="") ) 
$error=1;

if (trim($surname)=="")
$alert=$alert."Введите ФИО<br>";

if (trim($mail)=="")
$alert=$alert."Введите адрес почты! <br>";


if (trim($login)=="")
$alert=$alert."Введите поле логин! <br>";

if (trim($password)=="")
$alert=$alert."Введите пароль! <br>";


$s="select * from user where login='$login'";
if ($upd==1)
	$s=$s." and iduser!=$id";
$SET_user=mysqli_query($dbcnx,$s);
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

$s="select * from user where mail='$mail'";
if ($upd==1)
	$s=$s." and iduser!=$id";

$SET_user=mysqli_query($dbcnx,$s);
$COUNT_user=mysqli_num_rows($SET_user);

if ($COUNT_user!=0)
{
	$error=1;
	$alert=$alert."Пользователь с таким адресом электронной почты уже существует! <br>";
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
	
	
	

//выполнение запроса на редактирование или добавление данных	
if ($upd==1)
  {  
	 mysqli_query($dbcnx,"UPDATE user set login='$login',password='$password',mail='$mail',permission='$permission',surname='$surname', firstname='$firstname', patronymic='$patronymic' WHERE iduser=$id");
	 ?>
	 <script language="javascript">
	 location.href='user.php?filter=0';
	 </script>
	 <?
  }  else
  {//формирование SQL-запроса на добавление данных
	 mysqli_query($dbcnx,"INSERT INTO user (login, password, mail, permission, surname, firstname, patronymic) VALUES ('$login', '$password', '$mail', '$permission', '$surname', '$firstname', '$patronymic')");
	 	
	?>
	 <script language="javascript">
	 location.href='user.php?filter=0';
	 </script>
	 <?
  }

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
						<li  class="active"><a href="user.php">Пользователи</a></li>
						<li><a href="category.php">Категории</a></li>
						<li><a href="merch.php">Товары</a></li>
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
$Arr=$_REQUEST["Arr"];

$r=mysqli_query($dbcnx,"select *,  CONCAT (surname,' ', firstname,' ', patronymic) as fio from user where iduser="."$Arr[0]");
$f=mysqli_fetch_array($r);//считывание текующей записи
?>
<h3 class="breadcrumb-header">Редактирование пользователя (<? echo $f["fio"];?>)</h3>

<?
}
else
{
?>
<h3 class="breadcrumb-header">Добавление пользователя</h3>
<?
}
?>



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
                      <td><input   name="mail"   type="text"  value="<? if ($upd==1) echo "$f[mail]"; else echo(""); ?>" size="40" ></td>
                    </tr>  	                                                                 
                    <tr>
                      <td><font color="#000000" > Логин: </font> </td>
                      <td><input   name="login"  value="<? if ($upd==1) echo "$f[login]"; else echo(""); ?>"   type="text" ></td>
                    </tr>  				  
                    <tr>
                      <td><font color="#000000" >  Пароль: </font> </td>
                      <td><input   name="password"  value="<? if ($upd==1) echo "$f[password]"; else echo(""); ?>"   type="text" ></td>
                    </tr>      
                                 <tr>
                      <td><font color="#000000" >   Права: </font></td>
                      <td>
                 <select  name="permission"  style="height:22; width:auto"    >
					<option   value="Администратор"  >Администратор </option>	       
                    <option  value="Пользователь"    >Пользователь </option>	         																				
				</select>                    
				      </td> 
                      </tr>   
                  </table>
				<br>
				<input  type="button"  name="button"   onclick="this.form.action='upduser.php?step=2&upd=<? echo"$upd";?>&id=<? echo"$Arr[0]";?>'; this.form.submit();"   value="OK" width="500">
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

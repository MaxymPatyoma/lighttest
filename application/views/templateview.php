<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>Light IT</title>

	<link rel="stylesheet" href="/../../css/style.css">
  <link rel="stylesheet" href="/../../css/stylebg.css">
	<link rel="stylesheet" href="/../../assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/../../css/animations.css">
  <link rel="stylesheet" href="/../../assets/font-awesome/css/font-awesome.min.css">

</head>
<body>
<!-- Меню -->
<nav class="navbar navbar-inverse" role="navigation">
  <div class="container">
 		<ul class="nav nav-pills nav-justified">

  			<li class=" <?php if ($_SERVER["REQUEST_URI"]=='/facebook') echo 'active' ?> ">

        <a href="/facebook"> <?php echo (isset($_SESSION['fb_user']))?'Logout' : 'Login'; ?> </a>
        <p class="navbar-text">
        <?php echo (isset($_SESSION['fb_user']))? 'Signed in as '.$_SESSION['fb_user']['name'] : 'Sign in to send messages'; ?>
        </p>

        </li>
  			<li class=" <?php if ($_SERVER["REQUEST_URI"]=='/wall') echo 'active' ?>">
        <a href="/wall">Messages</a>
        </li>

		</ul>
  </div>
</nav>

<!-- Подгрузка Вьюшек -->
	<?php include_once $_SERVER['DOCUMENT_ROOT'].'/application/views/'.$contentView; ?>




<!-- Футер -->

<nav class="navbar navbar-inverse navbar-fixed-bottom" role="footer">
  <div class="container">
  <h4 class="text-center"><span class="label label-primary">2017 All Rights Reserved &copy;</span></h4>
  </div>
</nav>






	<script src="../../assets/jquery/jquery-1.11.3.min.js" type="text/javascript" defer></script>
	<script src="../../assets/bootstrap/js/bootstrap.min.js" type="text/javascript" defer></script>

  <!-- Свой JS Файл -->
	<!-- <script src="../../js/myjs.js" type="text/javascript" defer></script> -->

    <!--[if gte IE 9]>
      <style type="text/css">
        .gradient {
           filter: none;
        }
      </style>
      <script src="../../assets/ie7-js/IE9.min.js" async></script>
    <![endif]-->
</body>
</html>




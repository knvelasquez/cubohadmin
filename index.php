<?php
header('Location: https://cubohadminv2.herokuapp.com/');
/*
 *Validate if user has session
*/
require_once 'vertion.php';
if(isset($_COOKIE['user_pk'])) 
{
	header('Location: ./dashboard.php');
	exit;
}
?>
<html>
<head>
	<meta charset="utf-8">	
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<title>Cuboh &raquo;login</title>	
	<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
	<link rel="stylesheet" type="text/css" href="static/css/login.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />  
	<link rel="shortcut icon" type="image/x-icon" href="//production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico"/>
	<link rel="mask-icon" type="" href="//production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />
	<link rel="canonical" href="https://codepen.io/dpinnick/pen/LjdLmo?limit=all&page=21&q=service" />
	<link rel="stylesheet" type="text/css" href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'/>
	<link rel="stylesheet" type="text/css" href="./cuboh.css" />  	
</head>
<body>
	<div class="login">
		<div class="container">
			<div class="col-lg-12 login-box" >
				<div class="col-lg-6 left-box"></div>
				<div class="col-lg-6 right-box">      	 	   
					<div class="user">                      
						<div class="form-wrap">
							<div class="tabs">
								<h3 class="login-tab"><a class="log-in active" href="#login-tab-content"><span>Login<span></a></h3>								
							</div>
							<div class="tabs-content">
								<div id="login-tab-content" class="active">
									<form class="form-horizontal" action="#" method="POST" autocomplete="off">
										<div align="center">
											<input type="text" class="" name="userid" placeholder="Username"/>
										</div>
										<div align="center">
											<input type="password" name="pswrd" class=""  placeholder="Password"/>
										</div>
										<input type="checkbox" class="checkbox" checked id="remember_me"/>
										<label for="remember_me">Remember me</label>
										<input type="button" class="button" value="Login"/>      
										<span style="
											font-size: 10px;
											font-weight: bold;
											margin-top: -18px;
											margin-left: 40px;
											position: absolute;
											color: #4651FF;
											font-family: monospace;
										"><?php echo $version; ?></span>										
									</form>
									<div class="help-action">
										<p>
											<i class="fa fa-arrow-left" aria-hidden="true"></i>
											<a class="forgot" href="#">Forgot your password?</a>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--jQuery-->
	<script type="text/javascript" src="cdn.php?file=jquery"></script>
	<!--Bootstrap-->
	<script type="text/javascript" src="cdn.php?file=bootstrap_js"></script>  
	<!--jQuery cookie-->
	<script type="text/javascript" src="cdn.php?file=cookie"></script> 
	<!-- Site Script-->	
	<script type="text/javascript" src="cdn.php?file=script"></script>
</body>
{% endblock %}
</html>
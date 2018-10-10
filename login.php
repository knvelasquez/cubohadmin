<html>
<head>
  <meta charset="utf-8">
  <title>Cuboh &raquo;login</title>
  <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
  <script src="js/jquery.cookie.js"></script>
  <script src="js/script.js"></script>
  <!------- Include the above in your HEAD tag ---------->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="../static/css/login.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <!--
      instagram: www.instagram.com/programmingtutorial
      site: programlamadersleri.net
  -->
  <!-- Extra css -->
  <link rel="shortcut icon" type="image/x-icon" href="//production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" />
  <link rel="mask-icon" type="" href="//production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />
  <link rel="canonical" href="https://codepen.io/dpinnick/pen/LjdLmo?limit=all&page=21&q=service" />
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'/>
  <link rel="stylesheet" href="./cuboh.css" />
</head>
<body>
  <div class="login">
     	<div class="container">
  	    <div class="col-lg-12 login-box" >
      		<div class="col-lg-6 left-box"></div>
      	 	<div class="col-lg-6 right-box">
      	 	   <!-- <h1>LOGIN</h1>

                  <div class="form">

                      <div class="form-group">
              		    <label for="username">Your usersname </label>
                          <input type="text" id="username" class="form-control">

                      </div>

                      <div class="form-group">
              		    <label for="password">Your password</label>
                          <input type="password" id="password" class="form-control">

                      </div>

                      <div style="margin-left: 20%;" class="login-button">
                          <button class="btn btn-default">Login</button>
                      </div>

                  </div>-->
                  <!-- LOGIN FORM -->
                  <div class="user">
                      <!-- ACTIONS
                      <div class="actions">
                          <a class="help" href="#signup-tab-content">Sign Up</a><a class="faq" href="#login-tab-content">Login</a>
                      </div>
                      -->
                      <div class="form-wrap">
                          <!-- TABS -->
                        <div class="tabs">
                              <h3 class="login-tab"><a class="log-in active" href="#login-tab-content"><span>Login<span></a></h3>
                        <!--	<h3 class="signup-tab"><a class="sign-up" href="#signup-tab-content"><span>Sign Up</span></a></h3>-->
                        </div>
                          <!-- TABS CONTENT -->
                        <div class="tabs-content">
                              <!-- TABS CONTENT LOGIN -->
                          <div id="login-tab-content" class="active">
                            <form class="form-horizontal" action="#" method="POST" autocomplete="off">
                          <!--    {{ render_form_serializer }}-->
                              <div align="center">
								<input type="text" class="" name="userid" placeholder="Username"/>
							  </div>
                              <div align="center">
								<input type="password" name="pswrd" class=""  placeholder="Password"/>
							  </div>
                              <input type="checkbox" class="checkbox" checked id="remember_me"/>
                              <label for="remember_me">Remember me</label>
                              <input type="button" class="button" value="Login"/>                              
                            </form>
                            <div class="help-action">
                              <p><i class="fa fa-arrow-left" aria-hidden="true"></i><a class="forgot" href="#">Forgot your password?</a></p>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
              </div>  <!-- right-box -->

  		</div> <!--col-lg-8-->
      </div>
  </div>
</body>
{% endblock %}

</html>

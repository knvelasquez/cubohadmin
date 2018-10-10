<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Cuboh Admin Panel</title>
  <link href="https://d26b395fwzu5fz.cloudfront.net/keen-dataviz-2.0.4.min.css" rel="stylesheet" />
  <!--<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
  <style>  
	.chart-stage 
	{
		height: 250px;
	}	
	.keen-dashboard 
	{
		background: #f2f2f2;
		font-family: 'Gotham Rounded SSm A', 'Gotham Rounded SSm B', 'Helvetica Neue', Helvetica, Arial, sans-serif;
	}
	.keen-dataviz {
		background: #fff;
		border: 1px solid #e7e7e7;
		border-radius: 2px;
		box-sizing: border-box;
	}
	.keen-dataviz-title {
		border-bottom: 1px solid #e7e7e7;
		border-radius: 2px 2px 0 0;
		font-size: 13px;
		padding: 2px 10px 0;
		text-transform: uppercase;
	}
	.keen-dataviz-stage {
		padding: 10px;
	}
	.keen-dataviz-notes {
		background: #fbfbfb;
		border-radius: 0 0 2px 2px;
		border-top: 1px solid #e7e7e7;
		font-family: 'Helvetica Neue', Helvetica, sans-serif;
		font-size: 11px;
		padding: 0 10px;
	}
	.keen-dataviz .keen-dataviz-metric {
		border-radius: 2px;
	}
	.keen-dataviz .keen-spinner-indicator {
		border-top-color: rgba(0, 187, 222, .4);
	}
	.keen-dashboard .chart-wrapper {
		background: #fff;
		border: 1px solid #e2e2e2;
		border-radius: 3px;
		margin-bottom: 10px;
	}
  .keen-dashboard .chart-wrapper .chart-title {
    border-bottom: 1px solid #d7d7d7;
    color: #666;
    font-size: 14px;
    font-weight: 200;
    padding: 7px 10px 4px;
  }

  .keen-dashboard .chart-wrapper .chart-stage {
    overflow: hidden;
    padding: 5px 10px;
    position: relative;
  }

  .keen-dashboard .chart-wrapper .chart-notes {
    background: #fbfbfb;
    border-top: 1px solid #e2e2e2;
    color: #808080;
    font-size: 12px;
    padding: 8px 10px 5px;
  }

  .keen-dashboard .chart-wrapper .keen-dataviz,
  .keen-dashboard .chart-wrapper .keen-dataviz-title,
  .keen-dashboard .chart-stage .chart-title {
    border: medium none;
  }


  .cd-side-nav {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    visibility: hidden;
    opacity: 0;
    transition: opacity 0.2s 0s, visibility 0s 0.2s;
  }
  .cd-side-nav.nav-is-visible {
    opacity: 1;
    visibility: visible;
    transition: opacity 0.2s 0s, visibility 0s 0s;
  }

  @media only screen and (min-width: 768px) {
  .cd-side-nav {
    position: relative;
    float: left;
    width: 110px;
    /* reset style */
    visibility: visible;
    opacity: 1;
    }
  }

  @media only screen and (min-width: 768px) {
   .cd-main-content .content-wrapper {
   margin-left: 110px;
   }
  }

  /* --------------------------------
Sidebar
-------------------------------- */
.cd-side-nav {
  position: absolute;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  padding: 45px 0 0;
  background-color: #4651FF;
  visibility: hidden;
  opacity: 0;
  max-height: 100vh;
  overflow: hidden;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  -webkit-transition: opacity 0.2s 0s, visibility 0s 0.2s;
  -moz-transition: opacity 0.2s 0s, visibility 0s 0.2s;
  transition: opacity 0.2s 0s, visibility 0s 0.2s;
}
.cd-side-nav.nav-is-visible {
  opacity: 1;
  visibility: visible;
  overflow: visible;
  -webkit-overflow-scrolling: touch;
  -webkit-transition: opacity 0.2s 0s, visibility 0s 0s;
  -moz-transition: opacity 0.2s 0s, visibility 0s 0s;
  transition: opacity 0.2s 0s, visibility 0s 0s;
  max-height: none;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}
.cd-side-nav > ul {
  padding: 0.6em 0;
}
.cd-side-nav > ul:last-of-type {
  padding-bottom: 0;
}
.cd-side-nav .cd-label, .cd-side-nav a {
  display: block;
  padding: 1em 5%;
}
.cd-side-nav .cd-label {
  text-transform: uppercase;
  font-weight: bold;
  color: #646a6f;
  font-size: 1rem;
  letter-spacing: .1em;
}
.cd-side-nav a {
  position: relative;
  color: #ffffff;
  font-size: 1.4rem;
}
.cd-side-nav ul.cd-top-nav > li:last-of-type > a {
  border-bottom: none;
}
.cd-side-nav > ul > li > a {
  padding-left: calc(5% + 24px);
  border-bottom: 1px solid #373d44;
}
.cd-side-nav > ul > li > a::before {
  /* icon before item name */
  position: absolute;
  content: '';
  left: 5%;
  top: 50%;
  bottom: auto;
  -webkit-transform: translateY(-50%);
  -moz-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%);
  height: 16px;
  width: 16px;
  background: url(../img/cd-nav-icons.svg) no-repeat 0 0;
}
.cd-side-nav > ul > li.overview > a::before {
  background-position: -64px 0;
}
.cd-side-nav > ul > li.notifications > a::before {
  background-position: -80px 0;
}
.cd-side-nav > ul > li.comments > a::before {
  background-position: -48px 0;
}
.cd-side-nav > ul > li.bookmarks > a::before {
  background-position: -32px 0;
}
.cd-side-nav > ul > li.images > a::before {
  background-position: 0 0;
}
.cd-side-nav > ul > li.users > a::before {
  background-position: -16px 0;
}
.cd-side-nav .count {
  /* notification badge */
  position: absolute;
  top: 50%;
  bottom: auto;
  -webkit-transform: translateY(-50%);
  -moz-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%);
  right: calc(5% + 16px + 0.4em);
  padding: 0.2em 0.4em;
  background-color: #ff7e66;
  border-radius: .25em;
  color: #ffffff;
  font-weight: bold;
  font-size: 1.2rem;
  text-align: center;
}
.cd-side-nav .action-btn a {
  display: block;
  margin: 0 5%;
  padding: 1em 0;
  background-color: #1784c7;
  border-radius: .25em;
  border: none;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3), inset 0 1px 0 rgba(255, 255, 255, 0.2);
  text-align: center;
  color: #ffffff;
  font-weight: bold;
}
.cd-side-nav .action-btn a::before {
  display: none;
}
@media only screen and (min-width: 768px) {
  .cd-side-nav {
    position: fixed;
    float: left;
    top: auto;
    width: 65px;
    min-height: 100vh;
    padding-top: 55px;
    /* reset style */
    visibility: visible;
    opacity: 1;
    overflow: visible;
    max-height: none;
  }
  .cd-side-nav.nav-is-visible {
    box-shadow: none;
  }
  .cd-side-nav.is-fixed {
    position: fixed;
  }
  .cd-side-nav > ul {
    /* reset style */
    padding: 0.6em 0;
  }
  .cd-side-nav .cd-label {
    /* remove labels on minified version of the sidebar */
    display: none;
  }
  .cd-side-nav a {
    font-size: 1.2rem;
    text-align: center;
  }
  .cd-side-nav > ul > li > a {
    padding: calc(2.2em + 24px) 0 2.4em;
  }
  .cd-side-nav > ul > li > a::before {
    left: 50%;
    right: auto;
    -webkit-transform: translateX(-50%);
    -moz-transform: translateX(-50%);
    -ms-transform: translateX(-50%);
    -o-transform: translateX(-50%);
    transform: translateX(-50%);
    top: 2.4em;
  }
  .cd-side-nav .active > a {
    /* current page */
    box-shadow: inset 3px 0 0 #1784c7;
    background-color: #33383e;
  }
  .cd-side-nav .action-btn a {
    margin: 1em 10% 0;
  }
  .cd-side-nav .count {
    height: 8px;
    width: 8px;
    border-radius: 50%;
    box-shadow: 0 0 6px rgba(0, 0, 0, 0.2);
    padding: 0;
    top: 2em;
    -webkit-transform: translateX(-50%);
    -moz-transform: translateX(-50%);
    -ms-transform: translateX(-50%);
    -o-transform: translateX(-50%);
    transform: translateX(-50%);
    left: calc(50% + 5px);
    right: auto;
    color: transparent;
  }
}
@media only screen and (min-width: 1170px) {
  .cd-side-nav {
    width: 65px;
    position: fixed;
  }
  .cd-side-nav > ul {
    padding: 0.6em 0;
  }
  .cd-side-nav > ul > li:not(.action-btn):hover > a {
    background-color: #33383e;
  }
  .cd-side-nav > ul > li > a {
    padding: 1em 1em 1em 42px;
    text-align: left;
    border-bottom: none;
  }
  .cd-side-nav > ul > li > a::before {
    top: 50%;
    bottom: auto;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
    left: 18px;
  }
  .cd-side-nav .cd-label {
    display: block;
    padding: 1em 30px;
  }
  .cd-side-nav .action-btn {
    text-align: left;
  }
  .cd-side-nav .action-btn a {
    margin: 0 18px;
  }
  .no-touch .cd-side-nav .action-btn a:hover {
    background-color: #1a93de;
  }
  .cd-side-nav .count {
    /* reset style */
    color: #ffffff;
    height: auto;
    width: auto;
    border-radius: .25em;
    padding: .2em .4em;
    top: 50%;
    bottom: auto;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
    right: 18px;
    left: auto;
    box-shadow: none;
  }
}

.has-children ul {
  position: relative;
  width: 100%;
  /*display: none;*/
  background-color: #1c1f22;
}
.has-children > a::after {
  /* arrow icon */
  position: absolute;
  content: '';
  height: 16px;
  width: 16px;
  right: 5%;
  top: 50%;
  bottom: auto;
  -webkit-transform: translateY(-50%);
  -moz-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%);
  background: url(../img/cd-arrow.svg);
}
.has-children.selected > ul {
  display: block;
}
.has-children.selected > a::after {
  -webkit-transform: translateY(-50%) rotate(180deg);
  -moz-transform: translateY(-50%) rotate(180deg);
  -ms-transform: translateY(-50%) rotate(180deg);
  -o-transform: translateY(-50%) rotate(180deg);
  transform: translateY(-50%) rotate(180deg);
}
@media only screen and (min-width: 768px) {
  .has-children {
    position: relative;
  }
  .has-children ul {
    position: absolute;
    top: 0;
    left: 100%;
    width: 160px;
    padding: 0;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
  }
  .has-children ul a {
    text-align: left;
    border: none;
    padding: 1em;
  }
  .no-touch .has-children ul a:hover {
    color: #1784c7;
  }
  .has-children > a::after {
/*    display: none;*/
  }
  .cd-side-nav .has-children.selected > a {
    /* focus state -> show sub pages */
    background-color: #33383e;
  }
  .cd-top-nav .has-children {
    position: relative;
    background-color: #2c3136;
  }
  .cd-top-nav .has-children > a {
    height: 100%;
    padding: 0 calc(1.8em + 22px) 0 calc(1.8em + 26px) !important;
    line-height: 55px;
  }
  .cd-top-nav .has-children > a::after {
    display: block;
    right: 1.8em;
  }
  .cd-top-nav .has-children ul {
    background-color: #1c1f22;
    width: 200px;
    top: 100%;
    right: 0;
    left: auto;
    box-shadow: 0 1px 10px rgba(0, 0, 0, 0.2);
  }
  .cd-top-nav .has-children ul a {
    padding-left: 18px !important;
  }
}
@media only screen and (min-width: 1170px) {
  .has-children > ul {
    width: 100%;
    z-index: 1;
  }
  .has-children ul a {
    padding-left: 18px;
  }
  .has-children.active > ul {
    /* if the item is active, make the subnavigation visible */
    position: relative;
    display: block;
    /* reset style */
    left: 0;
    box-shadow: 0px 0px 0px #00823F;
  }
  .no-touch .cd-side-nav .has-children:hover > ul, .cd-side-nav .has-children.hover > ul {
    /* show subnavigation on hover */
    display: block;
    opacity: 1;
    visibility: visible;
  }
}

/*.button {
  style="background-color: white;
  width: 53px; margin-left: 5px;
  border-radius: .25em;
}*/

.button.selected {
    box-shadow: -5px 0px 0px  #BA2F10;
  /*  background-color: #666;*/
    color: white;
}

/* Month range picker css */
.mrp-container{
  margin-top:-8px;
}

.mrp-icon{
  border: solid 1px #ddd;
  border-radius: 5px 0px 0px 5px;
  color: #40667A;
  background: #eee;
  padding: 7px;
  margin-right:0px;
}

.mrp-monthdisplay{
  display:inline-block!important;
  border: solid 1px #ddd;
  padding: 5px 12px 5px 8px;
  border-radius: 0px 5px 5px 0px;
  background-color: #fff;
  cursor:pointer;
  margin-left: -5px;
}

.mrp-lowerMonth, .mrp-upperMonth{
  color: #40667A;
  font-weight:bold;
  font-size: 11px;
  text-transform:uppercase;
}

.mrp-to{
  color: #aaa;
  margin-right: 0px;
  margin-left: 0px;
  font-size: 11px;
  text-transform: uppercase;
  /* background-color: #eee; */
  padding: 5px 3px 5px 3px;
}

.mpr-calendar{
  display:inline-block;
  padding: 3px 5px;
  border-right: solid #999 1px;
}

.mpr-calendar.left{
  display: none;
}

.mpr-calendar:last-child{
  border-right: block;
}

.mpr-month{
  padding: 20px;
  text-transform: uppercase;
  font-size: 12px;
}

.mpr-calendar h5{
  width:100%;
  text-align:center;
  font-weight:bold;
  font-size:18px;
/*  display: none;*/
}

.mpr-selected{
  background: rgba(64, 102, 122, 0.75);;
  color: #fff;
}

.mpr-month:hover{
  border-radius: 5px;
  box-shadow: 0 0 0 1px #ddd inset;
  cursor:pointer;
}

.mpr-selected.mpr-month:hover{
  border-radius: 0px;
  box-shadow: none;
}

.mpr-calendarholder .col-xs-6 {
  max-width: 190px;
  min-width: 190px;
/*  position: absolute;
  clip: rect(0, 200px, 200px, 0);*/
}

.mpr-calendarholder .col-xs-1 {
  max-width: 150px;
  min-width: 150px;
}

.mpr-calendarholder .btn-info{
  background-color: #40667A;
  border-color: #406670;
  width:100%;
  margin-bottom: 10px;
  text-transform: uppercase;
  font-size: 10px;
  padding: 10px 0px;
}

.mpr-quickset{
  color: #666;
  text-transform: uppercase;
  text-align: center;
}

.mpr-yeardown, .mpr-yearup{
  margin-left: 5px;
  cursor: pointer;
  color: #666;
}

.mpr-yeardown{
  float:left;
}

.mpr-yearup{
  float:right;
}

.mpr-yeardown:hover,.mpr-yearup:hover{
  color: #40667A;
}

.mpr-calendar:first .mpr-selected:first{
    background-color: #40667A;
}

.mpr-calendar:last .mpr-selected:last{
    background-color: #40667A;
}

.popover{
  max-width: 1920px!important;
}

.mpr-calendar.right {
  display: none !important;
}
	@media (max-width: 768px) {
		.row{
			padding-left:0!important;
			transition: all 0.5s ease;
		}
		#dvnavhorizontal
		{
			display:block!important;
		}
		#dvbodygraph
		{		
			padding-top: 60px;
		}
	}
	@media (min-width: 768px) {
		.row{
			padding-left:60px!important;
			margin-right: 0px!important;
			margin-left: 0px!important;
			/*transition: all 0.5s ease;*/
		}
		
	}
	.navbar-default .navbar-toggle:hover, .navbar-default .navbar-toggle:focus {
		background-color: #178ede!important;
	}
	.icon-bar
	{
		background-color: white!important;
	}
  </style>
  <link href="https://cdn.jsdelivr.net/npm/keen-dataviz@3/dist/keen-dataviz.min.css" rel="stylesheet" />
  <!--<link rel="stylesheet" href="dist/daterangepicker.min.css">-->
  <!-- Dependencies -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.3.2/holder.min.js" type="text/javascript"></script>
  <script>
    Holder.add_theme("white", { background:"#fff", foreground:"#a7a7a7", size:10 });
  </script>
  <script src="js/jquery.cookie.js"></script>
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
  <!-- Dashboard -->
  <!--<link rel="stylesheet" type="text/css" href="keen-dashboards.css" />--->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <script src="js/dashboard.js"></script>
</head>
<body class="keen-dashboard" style="padding-top: 0px;">
	<nav id="dvnavhorizontal" class="navbar navbar-default navbar-fixed-top" style="display: none;background-color: #4651FF;border-color: #4651FF;">
	  <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="#">
			<img src="static/img/cuboh-image.svg" width="20px"">
		  </a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="nav navbar-nav">
			<li class="button" style="background-color: white;width: 53px;margin-left: 5px;border-radius:.25em;">
				<a href="#">
					<img src="static/img/chart-67.png" width="20px">
				</a>
			</li>
			<li class="button" style="background-color: white;width: 53px;margin-left: 68px;border-radius: .25em;margin-top: -41px;">
				<a href="#">
					<img src="static/img/settings-25-67.png" width="20px">
				</a>
			</li>
		  </ul>
		</div>
	  </div>
	</nav>
  <nav class="cd-side-nav">
    <ul>
      <div style="margin-top: -50px; margin-left: -5px;">
		<a><img srcset="static/img/cuboh-image.svg" style="width: 40%;"></a>
      </div>
      <!--<div style="margin-top: -35px; margin-left: -10px;" class="navbar-header">
        <a><h class="navbar-brand">Cuboh</h></a>
      </div>-->
      <!--<li class="cd-label">Main</li>-->
      <!--<button class="button" style="background-color: white; width: 53px; margin-top: 20px; margin-left: 5px; border-radius: .25em;" > </button>-->
      <div class="button" style="background-color: white; width: 53px;margin: 20px auto 0 auto; border-radius:.25em;">
        <a href="#">
			<img src="static/img/chart-67.png" style="width: 50%;">
		</a>
      </div>
        <!--<ul>
          <li><a href="#0">All Data</a></li>
          <li><a href="#0">Category 1</a></li>
          <li><a href="#0">Category 2</a></li>
        </ul>-->
     
      <!--<li style="margin-left: -50px;" class="cd-label">
        <a href="#0">Notifications<span class="count">3</span></a>
        <ul>
          <li><a href="#0">All Notifications</a></li>
          <li><a href="#0">Friends</a></li>
          <li><a href="#0">Other</a></li>
        </ul>
      </li>-->
      <!--<button class="button" style="background-color: white; width: 53px; margin-top: 460px; margin-left: 5px; border-radius: .25em;"></button>-->
      <div class="button" style="background-color: white; width: 53px;border-radius: .25em;position: absolute;bottom: 0.5%;left: 9%;">
        <a href="#">
			<img src="static/img/settings-25-67.png" style="width: 50%;">
		</a>
      </div>
        <!--<ul>
          <li><a href="#0">All Comments</a></li>
          <li><a href="#0">Edit Comment</a></li>
          <li><a href="#0">Delete Comment</a></li>
        </ul>-->      
    </ul>
    <!--<ul>
      <li style="margin-left: -35px;" class="cd-label">Secondary</li>
      <li style="margin-left: -35px;" class="has-children bookmarks">
        <a href="#0">Bookmarks</a>
        <ul>
          <li><a href="#0">All Bookmarks</a></li>
          <li><a href="#0">Edit Bookmark</a></li>
          <li><a href="#0">Import Bookmark</a></li>
        </ul>
      </li>
      <li style="margin-left: -35px;" class="has-children images">
        <a href="#0">Images</a>
        <ul>
          <li><a href="#0">All Images</a></li>
          <li><a href="#0">Edit Image</a></li>
        </ul>
      </li>
      <li style="margin-left: -35px;" class="has-children users">
        <a href="#0">Users</a>
        <ul>
          <li><a href="#0">All Users</a></li>
          <li><a href="#0">Edit User</a></li>
          <li><a href="#0">Add User</a></li>
        </ul>
      </li>
    </ul>-->
  <!--  <ul style="margin-left: -50px;">
      <li class="cd-label">Action</li>-->
    <!--  <li class="action-btn"><a href="#0">+ Button</a></li>-->
  <!--  </ul>-->
  </nav>
  <!-- end-test -->
  <!--<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand">Cuboh</a>
      </div>
      <div class="navbar-collapse collapse">-->
        <!--<ul class="nav navbar-nav navbar-left">
           <li><a href="https://keen.io">Home</a></li>
          <li><a href="https://keen.io/team">Team</a></li>
          <li><a href="https://github.com/keenlabs/dashboards/tree/gh-pages/layouts/thirds-grid">Source</a></li>
          <li><a href="https://groups.google.com/forum/#!forum/keen-io-devs">Community</a></li><li><a href="http://stackoverflow.com/questions/tagged/keen-io?sort=newest&pageSize=15">Technical Support</a></li>
        </ul>-->
      </div>
    </div>
</div>
<!-- style="padding-left: 80px;"-->
<div id="dvbodygraph">
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="chart-wrapper">
        <div class="chart-title">
          Revenue Today						   		
			<!--<div style="float: right;margin-top: -3px;margin-left: 3px;">
				<a href="javascript:;" data-toggle="modal" data-target="#csvModal" style="text-decoration-line: none;">
					<span class="mrp-icon" style="border-radius: 5px 5px 5px 5px;font-size: 11px;font-weight: bold;">CSV</span>	
				</a>
			</div>	
			DateRange
			<div style="float:right;margin-top:-2px">
				<div style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;display: inline;" graph="#revenue_today" graph_call="set_revenue_today" class="reportrange">
					<i class="fa fa-calendar"></i>&nbsp;
					<span></span>
				</div>				
			</div>-->	  
        </div>
        <div class="chart-stage" id="revenue_today"></div>
        <div class="chart-notes">
          This is how much money you earned today
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-6">
      <div class="chart-wrapper">
        <div class="chart-title">
          Weekly Revenue
		  <div style="float: right;margin-top: -3px;margin-left: 3px;">
				<a href="javascript:;" data-toggle="modal" data-target="#csvModal" style="text-decoration-line: none;">
					<span class="mrp-icon" style="border-radius: 5px 5px 5px 5px;font-size: 11px;font-weight: bold;">CSV</span>	
				</a>
		  </div>
			<!--DateRange-->
			<div style="float:right;margin-top:-2px">
				<div style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;display: inline;" graph="#orders_per_week" graph_call="set_orders_per_week" class="reportrange">
					<i class="fa fa-calendar"></i>&nbsp;
					<span>
					<!--<span class="mrp-lowerMonth">Jul 2014</span>
					<span class="mrp-to"> to </span>
					<span class="mrp-upperMonth">Aug 2014</span>-->
					</span>
				</div>				
			</div>
        </div>		
        <div class="chart-stage" id="orders_per_week"></div>
        <div class="chart-notes">
          This is how much money you earned this week
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-6">
      <div class="chart-wrapper">
        <div class="chart-title">
          Revenue Per Platform
			<div style="float: right;margin-top: -3px;margin-left: 3px;">
					<a href="javascript:;" data-toggle="modal" data-target="#csvModal" style="text-decoration-line: none;">
						<span class="mrp-icon" style="border-radius: 5px 5px 5px 5px;font-size: 11px;font-weight: bold;">CSV</span>	
					</a>
			</div>
			<!--DateRange-->
			<div style="float:right;margin-top:-2px">
				<div style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;display: inline;" graph="#revenuetoday2" graph_call="sales_per_source" class="reportrange">
					<i class="fa fa-calendar"></i>&nbsp;
					<span>
					<span class="mrp-lowerMonth">Jul 2014</span>
					<span class="mrp-to"> to </span>
					<span class="mrp-upperMonth">Aug 2014</span>
					</span>
				</div>				
			</div>		  
        </div>
        <div class="chart-stage" id="revenuetoday2"></div>
        <div class="chart-notes">
          This is how much money you earned this last week per platform
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-6">
      <div class="chart-wrapper">
        <div class="chart-title">
			Sales Breakdown per Source This Week
			<div style="float: right;margin-top: -3px;margin-left: 3px;">
					<a href="javascript:;" data-toggle="modal" data-target="#csvModal" style="text-decoration-line: none;">
						<span class="mrp-icon" style="border-radius: 5px 5px 5px 5px;font-size: 11px;font-weight: bold;">CSV</span>	
					</a>
			</div>
			<!--DateRange-->
			<div style="float:right;margin-top:-2px">
				<div style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;display: inline;" graph="#sales_per_source" graph_call="set_sales_per_source" class="reportrange">
					<i class="fa fa-calendar"></i>&nbsp;
					<span>
					<!--<span class="mrp-lowerMonth">Jul 2014</span>
					<span class="mrp-to"> to </span>
					<span class="mrp-upperMonth">Aug 2014</span>-->
					</span>
				</div>				
			</div>			
        </div>
        <div class="chart-stage" id="sales_per_source"></div>
        <div class="chart-notes">
          Distribution of what % of your orders comes from which platform
        </div>
      </div>
    </div>
    <!--<div class="col-sm-6 col-md-6">
      <div class="chart-wrapper">
        <div class="chart-title">
          Monthly Revenue.
			<div style="float: right;margin-top: -3px;margin-left: 3px;">
				<a href="javascript:;" data-toggle="modal" data-target="#csvModal" style="text-decoration-line: none;">
					<span class="mrp-icon" style="border-radius: 5px 5px 5px 5px;font-size: 11px;font-weight: bold;">CSV</span>	
				</a>
			</div>
			<div style="float:right;margin-top:-2px">
				<div style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;display: inline;" graph="#monthly_sales" graph_call="set_monthly_sales" class="reportrange">
					<i class="fa fa-calendar"></i>&nbsp;
					<span>
					<!--<span class="mrp-lowerMonth">Jul 2014</span>
					<span class="mrp-to"> to </span>
					<span class="mrp-upperMonth">Aug 2014</span>
					</span>
				</div>				
			</div>			
        </div>
        <div class="chart-stage" id="monthly_sales"></div>
        <div class="chart-notes">
          This is how much money you earned this month.
        </div>
      </div>
    </div>-->
	<div class="col-sm-6 col-md-6">
      <div class="chart-wrapper">
        <div class="chart-title">
          Daily sales per platform.
				<div style="float: right;margin-top: -3px;margin-left: 3px;">
					<a href="javascript:;" data-toggle="modal" data-target="#csvModal" style="text-decoration-line: none;">
						<span class="mrp-icon" style="border-radius: 5px 5px 5px 5px;font-size: 11px;font-weight: bold;">CSV</span>	
					</a>
			  </div>
			<!--DateRange-->
			<div style="float:right;margin-top:-2px">
				<div style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;display: inline;" graph="#daily_sales_per_platform" graph_call="set_daily_sales_per_platform" class="reportrange">
					<i class="fa fa-calendar"></i>&nbsp;
					<span>
					<!--<span class="mrp-lowerMonth">Jul 2014</span>
					<span class="mrp-to"> to </span>
					<span class="mrp-upperMonth">Aug 2014</span>-->
					</span>
				</div>				
			</div>			  
		</div>
        <div class="chart-stage" id="daily_sales_per_platform"></div>
        <div class="chart-notes">
          This is the total sales per platform.
        </div>
      </div>
    </div>
	<div class="col-sm-6 col-md-6">
      <div class="chart-wrapper">
        <div class="chart-title">
          Weekly per Sales.
			<div style="float: right;margin-top: -3px;margin-left: 3px;">
				<a href="javascript:;" data-toggle="modal" data-target="#csvModal" style="text-decoration-line: none;">
					<span class="mrp-icon" style="border-radius: 5px 5px 5px 5px;font-size: 11px;font-weight: bold;">CSV</span>	
				</a>
			</div>
			<!--DateRange-->
			<div style="float:right;margin-top:-2px">
				<div style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;display: inline;" graph="#weekly_sales" graph_call="set_weekly_sales" class="reportrange">
					<i class="fa fa-calendar"></i>&nbsp;
					<span>
					<!--<span class="mrp-lowerMonth">Jul 2014</span>
					<span class="mrp-to"> to </span>
					<span class="mrp-upperMonth">Aug 2014</span>-->
					</span>
				</div>				
			</div>			
        </div>
        <div class="chart-stage" id="weekly_sales"></div>
        <div class="chart-notes">
          This is the total of Weekly per Sales.
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-6">
      <div class="chart-wrapper">
        <div class="chart-title">
          Number of Orders
			<div style="float: right;margin-top: -3px;margin-left: 3px;">
				<a href="javascript:;" data-toggle="modal" data-target="#csvModal" style="text-decoration-line: none;">
					<span class="mrp-icon" style="border-radius: 5px 5px 5px 5px;font-size: 11px;font-weight: bold;">CSV</span>	
				</a>
			</div>
			<!--DateRange-->
			<div style="float:right;margin-top:-2px">
				<div style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;display: inline;" graph="#orders_perweek" graph_call="set_orders_perweek" class="reportrange">
					<i class="fa fa-calendar"></i>&nbsp;
					<span>
					<!--<span class="mrp-lowerMonth">Jul 2014</span>
					<span class="mrp-to"> to </span>
					<span class="mrp-upperMonth">Aug 2014</span>-->
					</span>
				</div>				
			</div>
        </div>
        <div class="chart-stage" id="orders_perweek"></div>
        <div class="chart-notes">
          How many orders you received this week
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-6">
      <div class="chart-wrapper">
        <div class="chart-title">
          Average Order Value
			<div style="float: right;margin-top: -3px;margin-left: 3px;">
				<a href="javascript:;" data-toggle="modal" data-target="#csvModal" style="text-decoration-line: none;">
					<span class="mrp-icon" style="border-radius: 5px 5px 5px 5px;font-size: 11px;font-weight: bold;">CSV</span>	
				</a>
			</div>
			<!--DateRange-->
			<div style="float:right;margin-top:-2px">
				<div style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;display: inline;" graph="#average_order_value" graph_call="set_average_order_value" class="reportrange">
					<i class="fa fa-calendar"></i>&nbsp;
					<span>
					<!--<span class="mrp-lowerMonth">Jul 2014</span>
					<span class="mrp-to"> to </span>
					<span class="mrp-upperMonth">Aug 2014</span>-->
					</span>
				</div>				
			</div>			
        </div>
        <div class="chart-stage" id="average_order_value"></div>
        <div class="chart-notes">
          This is the average revenue you earn per order
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-6">
      <div class="chart-wrapper">
        <div class="chart-title">
          Average Order Value Per Platform
			<div style="float: right;margin-top: -3px;margin-left: 3px;">
				<a href="javascript:;" data-toggle="modal" data-target="#csvModal" style="text-decoration-line: none;">
					<span class="mrp-icon" style="border-radius: 5px 5px 5px 5px;font-size: 11px;font-weight: bold;">CSV</span>	
				</a>
			</div>
			<!--DateRange-->
			<div style="float:right;margin-top:-2px">
				<div style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;display: inline;" graph="#average_order_value_per_platform" graph_call="set_average_order_value_per_platform" class="reportrange">
					<i class="fa fa-calendar"></i>&nbsp;
					<span>
					<!--<span class="mrp-lowerMonth">Jul 2014</span>
					<span class="mrp-to"> to </span>
					<span class="mrp-upperMonth">Aug 2014</span>-->
					</span>
				</div>				
			</div>			
        </div>
        <div class="chart-stage" id="average_order_value_per_platform"></div>
        <div class="chart-notes">
          This is the average revenue you earn per order, per platform
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-6">
      <div class="chart-wrapper">
        <div class="chart-title">
          Monthly Taxes
			<div style="float: right;margin-top: -3px;margin-left: 3px;">
				<a href="javascript:;" data-toggle="modal" data-target="#csvModal" style="text-decoration-line: none;">
					<span class="mrp-icon" style="border-radius: 5px 5px 5px 5px;font-size: 11px;font-weight: bold;">CSV</span>	
				</a>
			</div>
			<!--DateRange-->
			<div style="float:right;margin-top:-2px">
				<div style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;display: inline;" graph="#taxes" graph_call="set_taxes" class="reportrange">
					<i class="fa fa-calendar"></i>&nbsp;
					<span>
					<!--<span class="mrp-lowerMonth">Jul 2014</span>
					<span class="mrp-to"> to </span>
					<span class="mrp-upperMonth">Aug 2014</span>-->
					</span>
				</div>				
			</div>			
        </div>
        <div class="chart-stage" id="taxes"></div>
        <div class="chart-notes">
          How much taxes you've paid
        </div>
      </div>
    </div>
	<div class="col-sm-12 col-md-12">
      <div class="chart-wrapper">
        <div class="chart-title">
			Item Sales
			<div style="float: right;margin-top: -3px;margin-left: 3px;">
				<a href="javascript:;" data-toggle="modal" data-target="#csvModal" style="text-decoration-line: none;">
					<span class="mrp-icon" style="border-radius: 5px 5px 5px 5px;font-size: 11px;font-weight: bold;">CSV</span>	
				</a>
			</div>
			<!--DateRange-->
			<div style="float:right;margin-top:-2px">
				<div style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;display: inline;" graph="#iteminv" graph_call="set_iteminv" class="reportrange">
					<i class="fa fa-calendar"></i>&nbsp;
					<span>
					<!--<span class="mrp-lowerMonth">Jul 2014</span>
					<span class="mrp-to"> to </span>
					<span class="mrp-upperMonth">Aug 2014</span>-->
					</span>
				</div>				
			</div>			
        </div>
        <div class="chart-stage" id="iteminv"></div>
        <div class="chart-notes">
          How much Item Sales
        </div>
      </div>
    </div>
	<div class="col-sm-12 col-md-12">
      <div class="chart-wrapper">
        <div class="chart-title">
			Modifier Sales
			<div style="float: right;margin-top: -3px;margin-left: 3px;">
				<a href="javascript:;" data-toggle="modal" data-target="#csvModal" style="text-decoration-line: none;">
					<span class="mrp-icon" style="border-radius: 5px 5px 5px 5px;font-size: 11px;font-weight: bold;">CSV</span>	
				</a>
			</div>
			<!--DateRange-->
			<div style="float:right;margin-top:-2px">
				<div style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;display: inline;" graph="#modinv" graph_call="set_modinv" class="reportrange">
					<i class="fa fa-calendar"></i>&nbsp;
					<span>
					<!--<span class="mrp-lowerMonth">Jul 2014</span>
					<span class="mrp-to"> to </span>
					<span class="mrp-upperMonth">Aug 2014</span>-->
					</span>
				</div>				
			</div>			
        </div>
        <div class="chart-stage" id="modinv"></div>
        <div class="chart-notes">
          How much Modifier Sales
        </div>
      </div>
    </div>
  </div>
<!-- Modal-Popup -->
<div class="modal fade" id="csvModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">What email should we send the CSV file to?</h4>
      </div>
      <div class="modal-body">
        <div>
		  <input type="text" class="form-control" placeholder="Email Adress" aria-describedby="basic-addon2">
		</div>
      </div>
      <div class="modal-footer">        
        <button type="button" class="btn btn-default" data-dismiss="modal">Send</button>
      </div>
    </div>
  </div>
</div>
</div>
<div style="text-align: center" class="container-fluid">
	<p class="small text-muted">Built with &#9829; by <a href="https://www.cuboh.com">Cuboh</a></p>
</div>
  <!-- Project Analytics -->
  <!--<script type="text/javascript" src="static/js/keen-analytics.js"></script>-->
  <script crossorigin src="https://cdn.jsdelivr.net/npm/keen-analysis@3"></script>
  <script crossorigin src="https://cdn.jsdelivr.net/npm/keen-dataviz@3.0/dist/keen-dataviz.min.js"></script>
  <script src="js/saladboxmiami.js"></script>
  <!--<script type="text/javascript" src="newdashboard.js"></script>-->
  <!--<script type="text/javascript" src="ordersperweek.js"></script>-->
  <!--<script type="text/javascript" src="weeklyrevenue.js"></script>-->
<script>
/*const client = new KeenAnalysis({
  projectId: '5b64e745c9e77c0001ea6d78',
  masterKey: '4B17301A4D08BE5B07EDAD4876420B919390893E3B53DCB34D235224EC4E0590',
  readKey: "0B63415EBF79394D682631551864E85C7ADC59238B68C94D1BAFCAB5E42F130240F96387571C97757EE77BF5680B64A97F0AF3262915F7E5E89CB6CFCA80413CEE1B88BA3D0F09317DC1E63F20A24EADE3F79076E509A1E6082AF9DE319C97CE"
});*/
const savedQueryName = 'revenuetodayxx';
function createNewSavedQuery(){
  console.log('create new saved query');
  client
    .put(client.url('queries', 'saved', savedQueryName))
    .auth(client.masterKey())
    .send({
      query: {
        analysis_type: 'sum',
        event_collection: 'orders',
        target_property: 'revenue',
        timeframe: "this_1_days",
        filters: [
          {
            operator: 'eq',
            property_name: 'user',
            property_value: 'id'
          }
        ],
        refresh_rate: 14400
      },
      metadata: {
        display_name: 'Revenue (Today)',
        visualization: {
          chart_type: 'metric'
        }
      }
    })
    .then(res => {
      console.log('created...', res);
      return getResult();
    })
    .catch(err => {
      console.log(err);
    });
}
function getResult(){
  console.log('run getResult');
  return client
    .query('saved', savedQueryName)
    .then(res => {
      console.log('got result', res);

      // create a keenDataviz instance
      const revenuetodayDataviz = new KeenDataviz({
        container: '#revenuetoday',
        type: 'metric',
        prefix: '$'
      });
      // pass the response into the KeenDataviz instance
      revenuetodayDataviz.render(res);

    })
    .catch(err => {
      if (err && !err.ok && err.error_code === 'ResourceNotFoundError') {
        // saved query doesn't exist yet - create a new one
        console.log('saved query not found', err);
        return createNewSavedQuery();
      }
      // other errors
      console.log(err);
    });
}
//getResult();
//month range picker js
var MONTHS = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
$(function () {
  startMonth = 7;
  startYear = 2014
  SingleMonth = true
  endMonth = 8;
  endYear = 2015;
  fiscalMonth = 7;
  if(startMonth < 10)
  	startDate = parseInt("" + startYear + '0' + startMonth + "");
  else
    startDate = parseInt("" + startYear  + startMonth + "");
  if(endMonth < 10)
  	endDate = parseInt("" + endYear + '0' + endMonth + "");
  else
    endDate = parseInt("" + endYear + endMonth + "");
  content = '<div class="row mpr-calendarholder">';
  calendarCount = endYear - startYear;
  if(calendarCount == 0)
    calendarCount++;
  var d = new Date();
  for(y = 0; y < 2; y++){
		content += '<div class="col-xs-6" ><div class="mpr-calendar row" id="mpr-calendar-' + (y+1) + '">'
 						 + '<h5 class="col-xs-12"><i class="mpr-yeardown fa fa-chevron-circle-left"></i><span>' + (startYear + y).toString() + '</span><i class="mpr-yearup fa fa-chevron-circle-right"></i></h5><div class="mpr-monthsContainer"><div class="mpr-MonthsWrapper">';
    for(m=0; m < 12; m++){
      var monthval;
      if((m+1) < 10)
        monthval = "0" + (m+1);
      else
        monthval = "" + (m+1);
			content += '<span data-month="' + monthval  + '" class="col-xs-3 mpr-month">' + MONTHS[m] + '</span>';
    }
    content += '</div></div></div></div>';
  }
  content += '<div class="col-xs-1"> <h5 class="mpr-quickset">Presets</h5>';
  content += '<button class="btn btn-info mpr-fiscal-ytd">Today</button>';
  content += '<button class="btn btn-info mpr-ytd">This week</button>';
  content += '<button class="btn btn-info mpr-prev-fiscal">This month</button>';
  content += '<button class="btn btn-info mpr-prev-year">All-Time</button>';
  content += '</div>';
  content += '</div>';
  $(document).on('click','.mpr-month',function(e){
    e.stopPropagation();
  		$month = $(this);
    	var monthnum = $month.data('month');
    	var year = $month.parents('.mpr-calendar').children('h5').children('span').html();
        if($month.parents('#mpr-calendar-1').size() > 0){
          //Start Date
          startDate = parseInt("" + year + monthnum);
          if(startDate > endDate){

            if(year != parseInt(endDate/100))
              $('.mpr-calendar:last h5 span').html(year);
               endDate = startDate;
          }
        }else{
          //End Date
          endDate = parseInt("" + year + monthnum);
          if(startDate > endDate){
            if(year != parseInt(startDate/100))
              $('.mpr-calendar:first h5 span').html(year);
            startDate = endDate;
          }
        }		
    	paintMonths();
  });
  $(document).on('click','.mpr-yearup',function(e){
    	e.stopPropagation();
  		var year = parseInt($(this).prev().html());
    	year++;
    	$(this).prev().html(""+year);
   	 	$(this).parents('.mpr-calendar').find('.mpr-MonthsWrapper').fadeOut(175,function(){
        paintMonths();
        $(this).parents('.mpr-calendar').find('.mpr-MonthsWrapper').fadeIn(175);
      });
  });
  $(document).on('click','.mpr-yeardown',function(e){
    	e.stopPropagation();
  		var year = parseInt($(this).next().html());
    	year--;
    	$(this).next().html(""+year);
   	 	//paintMonths();
      $(this).parents('.mpr-calendar').find('.mpr-MonthsWrapper').fadeOut(175,function(){
        paintMonths();
        $(this).parents('.mpr-calendar').find('.mpr-MonthsWrapper').fadeIn(175);
      });
  });
  $(document).on('click','.mpr-ytd', function(e){
    e.stopPropagation();
    var d = new Date();
    startDate = parseInt(d.getFullYear() + "01");
    var month = d.getMonth() + 1;
    if(month < 9)
      month = "0" + month;
    endDate = parseInt("" + d.getFullYear() + month);
    $('.mpr-calendar').each(function(){
      var $cal = $(this);
      var year = $('h5 span',$cal).html(d.getFullYear());
    });
    $('.mpr-calendar').find('.mpr-MonthsWrapper').fadeOut(175,function(){
        paintMonths();
        $('.mpr-calendar').find('.mpr-MonthsWrapper').fadeIn(175);
    });
  });
  $(document).on('click','.mpr-prev-year', function(e){
    e.stopPropagation();
    var d = new Date();
    var year = d.getFullYear()-1;
    startDate = parseInt(year + "01");
    endDate = parseInt(year + "12");
    $('.mpr-calendar').each(function(){
      var $cal = $(this);
      $('h5 span',$cal).html(year);
    });
    $('.mpr-calendar').find('.mpr-MonthsWrapper').fadeOut(175,function(){
        paintMonths();
        $('.mpr-calendar').find('.mpr-MonthsWrapper').fadeIn(175);
    });
  });
  $(document).on('click','.mpr-fiscal-ytd', function(e){
    e.stopPropagation();
    var d = new Date();
    var year;
    if((d.getMonth()+1) < fiscalMonth)
      year = d.getFullYear() - 1;
    else
      year = d.getFullYear();
    if(fiscalMonth < 10)
      fm = "0" + fiscalMonth;
    else
      fm = fiscalMonth;
    if(d.getMonth()+1 < 10)
      cm = "0" + (d.getMonth()+1);
    else
      cm = (d.getMonth()+1);
    startDate = parseInt("" + year + fm);
    endDate = parseInt("" + d.getFullYear() + cm);
    $('.mpr-calendar').each(function(i){
      var $cal = $(this);
      if(i == 0)
      	$('h5 span',$cal).html(year);
      else
        $('h5 span',$cal).html(d.getFullYear());
    });
    $('.mpr-calendar').find('.mpr-MonthsWrapper').fadeOut(175,function(){
        paintMonths();
        $('.mpr-calendar').find('.mpr-MonthsWrapper').fadeIn(175);
    });
  });
  $(document).on('click','.mpr-prev-fiscal', function(){
    var d = new Date();
    var year;
    if((d.getMonth()+1) < fiscalMonth)
      year = d.getFullYear() - 2;
    else
      year = d.getFullYear() - 1;
    if(fiscalMonth < 10)
      fm = "0" + fiscalMonth;
    else
      fm = fiscalMonth;
    if(fiscalMonth -1 < 10)
      efm = "0" + (fiscalMonth-1);
    else
      efm = (fiscalMonth-1);
    startDate = parseInt("" + year + fm);
    endDate = parseInt("" + (d.getFullYear() - 1) + efm);
    $('.mpr-calendar').each(function(i){
      var $cal = $(this);
      if(i == 0)
      	$('h5 span',$cal).html(year);
      else
        $('h5 span',$cal).html(d.getFullYear()-1);
    });
    $('.mpr-calendar').find('.mpr-MonthsWrapper').fadeOut(175,function(){
        paintMonths();
        $('.mpr-calendar').find('.mpr-MonthsWrapper').fadeIn(175);
    });
  });
  var mprVisible = false;
  var mprpopover = $('.mrp-container').popover({
    container: "body",
    placement: "bottom",
    html: true,
    content: content
  }).on('show.bs.popover', function () {
    $('.popover').remove();
    var waiter = setInterval(function(){
      if($('.popover').size() > 0){
        clearInterval(waiter);
        setViewToCurrentYears();
    		paintMonths();
      }
    },50);
  }).on('shown.bs.popover', function(){
    mprVisible = true;
  }).on('hidden.bs.popover', function(){
    mprVisible = false;
  });
  $(document).on('click','.mpr-calendarholder',function(e){
    e.preventDefault();
    e.stopPropagation();
  });
  $(document).on("click",".mrp-container",function(e){
    if(mprVisible){
      e.preventDefault();
    	e.stopPropagation();
      mprVisible = false;
    }
  });
  $(document).on("click",function(e){
    if(mprVisible){
    	$('.mpr-calendarholder').parents('.popover').fadeOut(200,function(){
        $('.mpr-calendarholder').parents('.popover').remove();
        $('.mrp-container').trigger('click');
      });
      mprVisible = false;
    }
  });
});
function setViewToCurrentYears(){
  	var startyear = parseInt(startDate / 100);
    var endyear = parseInt(endDate / 100);
  	$('.mpr-calendar h5 span').eq(0).html(startyear);
  	$('.mpr-calendar h5 span').eq(1).html(endyear);
}
function paintMonths(){
    $('.mpr-calendar').each(function(){
      var $cal = $(this);
      var year = $('h5 span',$cal).html();
      $('.mpr-month',$cal).each(function(i){
        if((i+1) > 9)
          cDate = parseInt("" + year + (i+1));
        else
          cDate = parseInt("" + year+ '0' + (i+1));
        if(cDate >= startDate && cDate <= endDate){
            $(this).addClass('mpr-selected');
        }else{
          $(this).removeClass('mpr-selected');
        }
      });
    });
  $('.mpr-calendar .mpr-month').css("background","");
    //Write Text
    var startyear = parseInt(startDate / 100);
    var startmonth = parseInt(safeRound((startDate / 100 - startyear)) * 100);
    var endyear = parseInt(endDate / 100);
    var endmonth = parseInt(safeRound((endDate / 100 - endyear)) * 100);
    $('.mrp-monthdisplay .mrp-lowerMonth').html(MONTHS[startmonth - 1] + " " + startyear);
    $('.mrp-monthdisplay .mrp-upperMonth').html(MONTHS[endmonth - 1] + " " + endyear);
    $('.mpr-lowerDate').val(startDate);
    $('.mpr-upperDate').val(endDate);
  	if(startyear == parseInt($('.mpr-calendar:first h5 span').html()))
  		$('.mpr-calendar:first .mpr-selected:first').css("background","#40667A");
    if(endyear == parseInt($('.mpr-calendar:last h5 span').html()))
      $('.mpr-calendar:last .mpr-selected:last').css("background","#40667A");
  }
  function safeRound(val){
    return Math.round(((val)+ 0.00001) * 100) / 100;
  }
  // end of month range picker
  // Add active class to the current button (highlight it)
//  var header = document.getElementById("myDIV");
//  var buttons = header.getElementsByClassName("button");
//  for (var i = 0; i < buttons.length; i++) {
//    buttons[i].addEventListener("click", function() {
//      var current = document.getElementsByClassName("active");
//      current[0].className = current[0].className.replace(" active", "");
//      this.className += " active";
//    });
//  }
  $('button').on('click', function(){
    $('button').removeClass('selected');
    $(this).addClass('selected');
  });
</script>
<!--<script type="text/javascript" src="moment.min.js"></script>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="dist/jquery.daterangepicker.min.js"></script>
<script>
$('#dom-id').dateRangePicker(configObject);
</script>-->
</body>
</html>
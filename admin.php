<?php
/*
 *Validate if user has not session
*/
require_once 'vertion.php';
$name="#N/A";
if(!isset($_COOKIE['user_pk'])) 
{
	header('Location: ./');
	exit;
}
if(isset($_COOKIE['name'])) 
{
	$name=$_COOKIE['name'];
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
		<title>Cuboh Admin Panel</title>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
		<!-- Dashboard -->
		<link rel="stylesheet" type="text/css" href="cdn.php?file=keen_dataviz_2_0_4_min_css.css"/>    
		<link rel="stylesheet" type="text/css" href="keen/dashboards.css"/>  
		<link rel="stylesheet" type="text/css" href="keen/keen-dataviz.min.css"/>
		<!--Bootstrap-->
		<link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.min.css"/>
		<!--Date Range Picker-->
		<link rel="stylesheet" type="text/css" href="daterangepicker/daterangepicker.css"/>        
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
					<img src="static/img/cuboh-image.svg" width="20px"/>
				</a>
				<span style="
					color: white;
					font-size: 10px;
					position: absolute;
					margin-top: 36px;
					margin-left: -39px;
					font-family: monospace;
				"><?php echo $name; ?></span>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="button" style="background-color: white;width: 53px;margin-left: 5px;border-radius:.25em;">
						<a href="#">
							<img src="static/img/chart-67.png" width="20px"/>
						</a>
					</li>																			
					<li class="button logout-btn" style="background-color: white;width: 53px;margin-left: 68px;border-radius: .25em;margin-top: -41px;">
						<a href="#">
							<img src="static/img/settings-25-67.png" width="20px"/>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<nav class="cd-side-nav">
		<ul>
			<div style="
				color: white;
				font-weight: bold;
				margin-left: 14px;
				margin-top: -9px;
				position: absolute;
				font-size: 13px;
				font-family: monospace;
			"><?php echo $name; ?></div>
			<div style="margin-top: -50px; margin-left: -5px;">
				<a>
					<img srcset="static/img/cuboh-image.svg" style="width: 40%;"/>
				</a>
			</div>      
			<div class="button" style="background-color: white; width: 53px;margin: 20px auto 0 auto; border-radius:.25em;" data-toggle="tooltip" data-placement="right" title="Metrics">
				<a href="#">
					<img src="static/img/chart-67.png" style="width: 50%;"/>
				</a>
			</div> 	  												
			<div class="dropdown" style="background-color: white; width: 53px;border-radius: .25em;position: absolute;margin: 20px auto 0 auto;position: absolute;bottom: 0.5%;left: 9%;" data-toggle="tooltip" data-placement="right" title="Settings">
				<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"
						style="background-color: white; width: 53px;border-radius: .25em;padding: 1em 5%;">
					<img src="static/img/settings-25-67.png" style="width: 50%;"/>
				</button>
				<ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="left: 66px;top: 0px;">
					<li>
						<a id="btnlogout" href="#">Logout</a>
					</li>
				</ul>
			</div>     
		</ul>    
	</nav>
	<div id="dvbodygraph">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="chart-wrapper">
					<div class="chart-title">Revenue Today
						<div style="float: right;margin-top: -3px;margin-left: 3px;" graph_call="email_revenue_today">
							<a href="#" data-toggle="modal" data-target="#csvModal" style="text-decoration-line: none;">
								<span class="mrp-icon" style="border-radius: 5px 5px 5px 5px;font-size: 11px;font-weight: bold;">CSV</span>	
							</a>
						</div>
					</div>
					<div class="chart-stage" id="revenue_today"></div>
					<div class="chart-notes">This is how much money you earned today.</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-12">
				<div class="chart-wrapper">
					<div class="chart-title">
					  Daily Sales
						<div style="float: right;margin-top: -3px;margin-left: 3px;" graph_call="email_weekly_sales">
							<a href="#" data-toggle="modal" data-target="#csvModal" style="text-decoration-line: none;">
								<span class="mrp-icon" style="border-radius: 5px 5px 5px 5px;font-size: 11px;font-weight: bold;">CSV</span>	
							</a>
						</div>						
						<!--DateRange-->
						<div style="float:right;margin-top:-2px">
							<div style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;display: inline;" graph="#weekly_sales" graph_call="set_weekly_sales" class="reportrange">
								<i class="fa fa-calendar"></i>&nbsp;
								<span></span>
							</div>				
						</div>						
					</div>
					<div class="chart-stage" id="weekly_sales"></div>
					<div class="chart-notes">
					  This is how much money you have earned on a daily basis.
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-6">
				<div class="chart-wrapper">
					<div class="chart-title">
						Number of Weekly Orders
						<div style="float: right;margin-top: -3px;margin-left: 3px;" graph_call="email_orders_per_week">
							<a href="#" data-toggle="modal" data-target="#csvModal" style="text-decoration-line: none;">
								<span class="mrp-icon" style="border-radius: 5px 5px 5px 5px;font-size: 11px;font-weight: bold;">CSV</span>	
							</a>
						</div>						
						<!--DateRange-->
						<div style="float:right;margin-top:-2px">
							<div style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;display: inline;" graph="#orders_per_week" graph_call="set_orders_per_week" class="reportrange">
								<i class="fa fa-calendar"></i>&nbsp;
								<span></span>
							</div>				
						</div>
					</div>		
					<div class="chart-stage" id="orders_per_week"></div>
					<div class="chart-notes">This is how many orders you have received on a weekly basis.</div>
				</div>
			</div>    
			<div class="col-sm-6 col-md-6">
				<div class="chart-wrapper">
					<div class="chart-title">
						Sales Breakdown per Source							
						<!--DateRange-->
						<div style="float:right;margin-top:-2px">
							<div style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;display: inline;" graph="#sales_per_source" graph_call="set_sales_per_source" class="reportrange">
								<i class="fa fa-calendar"></i>&nbsp;
								<span></span>
							</div>				
						</div>			
					</div>
					<div class="chart-stage" id="sales_per_source"></div>
					<div class="chart-notes">Distribution of what % of your orders comes from each platform.</div>
				</div>
			</div>    
			<div class="col-sm-6 col-md-6">
				<div class="chart-wrapper">
					<div class="chart-title">
						Daily Sales per Platform.
						<div style="float: right;margin-top: -3px;margin-left: 3px;" graph_call="email_daily_sales_per_platform">
							<a href="#" data-toggle="modal" data-target="#csvModal" style="text-decoration-line: none;">
								<span class="mrp-icon" style="border-radius: 5px 5px 5px 5px;font-size: 11px;font-weight: bold;">CSV</span>	
							</a>
						</div>	
						<!--Table Options-->
						<div class="dropdown table-options" style="float:right;margin-top:-6px;" graph="#revenue_today" raph="#daily_sales_per_platform" graph_call="set_daily_sales_per_platform">
						  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="padding: 3px 12px;">
							<span>General</span>
							<span class="caret"></span>
						  </button>
						  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="left: -82px;top: 34px;">
							<li><a href="javascript:;" graph-type="columnchart">General</a></li>	
							<li><a href="javascript:;" graph-type="table">Table</a></li>
						  </ul>
						</div>
						<!--DateRange-->
						<div style="float:right;margin-top:-2px">
							<div style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;display: inline;" graph="#daily_sales_per_platform" graph_call="set_daily_sales_per_platform" class="reportrange">
								<i class="fa fa-calendar"></i>&nbsp;
								<span></span>
							</div>				
						</div>			  
					</div>
					<div class="chart-stage" id="daily_sales_per_platform" style="overflow:auto"></div>
					<div class="chart-notes">This is the total daily sales per platform.</div>
				</div>
			</div>	    
			<div class="col-sm-6 col-md-6">
				<div class="chart-wrapper">
					<div class="chart-title">
						Average Order Value							
						<!--DateRange-->
						<div style="float:right;margin-top:-2px">
							<div style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;display: inline;" graph="#average_order_value" graph_call="set_average_order_value" class="reportrange">
								<i class="fa fa-calendar"></i>&nbsp;
								<span></span>
							</div>				
						</div>			
					</div>
					<div class="chart-stage" id="average_order_value"></div>
					<div class="chart-notes">This is the average revenue you earn per order.</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-6">
				<div class="chart-wrapper">
					<div class="chart-title">Average Order Value Per Platform						
						<!--DateRange-->
						<div style="float:right;margin-top:-2px">
							<div style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;display: inline;" graph="#average_order_value_per_platform" graph_call="set_average_order_value_per_platform" class="reportrange">
								<i class="fa fa-calendar"></i>&nbsp;
								<span></span>
							</div>				
						</div>			
					</div>
					<div class="chart-stage" id="average_order_value_per_platform"></div>
					<div class="chart-notes">This is the average revenue you earn per order, per platform.</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-6">
				<div class="chart-wrapper">
					<div class="chart-title">
						Monthly Taxes
						<div style="float: right;margin-top: -3px;margin-left: 3px;" graph_call="email_taxes">
							<a href="#" data-toggle="modal" data-target="#csvModal" style="text-decoration-line: none;">
								<span class="mrp-icon" style="border-radius: 5px 5px 5px 5px;font-size: 11px;font-weight: bold;">CSV</span>	
							</a>
						</div>						
						<!--DateRange-->
						<div style="float:right;margin-top:-2px">
							<div style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;display: inline;" graph="#taxes" graph_call="set_taxes" class="reportrange">
								<i class="fa fa-calendar"></i>&nbsp;
								<span></span>
							</div>				
						</div>			
					</div>
					<div class="chart-stage" id="taxes"></div>
					<div class="chart-notes">This is the amount of taxes due on a monthly basis across all online ordering platforms.</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-12">
				<div class="chart-wrapper">
					<div class="chart-title">
						Item Sales
						<div style="float: right;margin-top: -3px;margin-left: 3px;" graph_call="email_iteminv">
							<a href="#" data-toggle="modal" data-target="#csvModal" style="text-decoration-line: none;">
								<span class="mrp-icon" style="border-radius: 5px 5px 5px 5px;font-size: 11px;font-weight: bold;">CSV</span>	
							</a>
						</div>	
						<!--Table Options-->
						<div class="dropdown table-options" style="float:right;margin-top:-6px" graph="#iteminv" graph_call="set_iteminv">
						  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="padding: 3px 12px;">
							<span>General</span>
							<span class="caret"></span>
						  </button>
						  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="left: -82px;top: 34px;">
							<li><a href="javascript:;" graph-type="general">General</a></li>	
							<li><a href="javascript:;" graph-type="perplatform">Per Platform</a></li>
						  </ul>
						</div>
						<!--DateRange-->
						<div style="float:right;margin-top:-2px">
							<div style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;display: inline;" graph="#iteminv" graph_call="set_iteminv" class="reportrange">
								<i class="fa fa-calendar"></i>&nbsp;
								<span></span>
							</div>				
						</div>			
					</div>
					<div class="chart-stage" id="iteminv" style="height:500px;overflow:auto"></div>
					<div class="chart-notes">These are how many items you have sold across all online ordering platforms.</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-12">
				<div class="chart-wrapper">
					<div class="chart-title">
						Modifier Sales
						<div style="float: right;margin-top: -3px;margin-left: 3px;" graph_call="email_modinv">
							<a href="#" data-toggle="modal" data-target="#csvModal" style="text-decoration-line: none;">
								<span class="mrp-icon" style="border-radius: 5px 5px 5px 5px;font-size: 11px;font-weight: bold;">CSV</span>	
							</a>
						</div>	
						<!--Table Options-->
						<div class="dropdown table-options" style="float:right;margin-top:-6px" graph="#modinv" graph_call="set_modinv">
						  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="padding: 3px 12px;">
							<span>General</span>
							<span class="caret"></span>
						  </button>
						  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="left: -82px;top: 34px;">
							<li><a href="javascript:;" graph-type="general">General</a></li>	
							<li><a href="javascript:;" graph-type="perplatform">Per Platform</a></li>
						  </ul>
						</div>						
						<!--DateRange-->
						<div style="float:right;margin-top:-2px">
							<div style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;display: inline;" graph="#modinv" graph_call="set_modinv" class="reportrange">
								<i class="fa fa-calendar"></i>&nbsp;
								<span></span>
							</div>				
						</div>			
					</div>
					<div class="chart-stage" id="modinv" style="height:500px;overflow:auto"></div>
					<div class="chart-notes">These are how many modifiers you have sold across all online ordering platforms.</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal-Email-Popup -->
	<div class="modal fade" id="csvModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">What email should we send the CSV file to?</h4>
				</div>
				<div class="modal-body">
					<div>
						<input id="dvemailtxt" type="text" class="form-control" placeholder="Email Adress" aria-describedby="basic-addon2">
					</div>
				</div>
				<div class="modal-footer">        
					<button type="button" class="btn btn-default" data-dismiss="modal" onclick="email_send('email_weekly_sales')">Send</button>
				</div>
			</div>
		</div>
	</div>
	<div style="text-align: center" class="container-fluid">
		<p class="small text-muted">Built with &#9829; by <a href="https://www.cuboh.com">Cuboh</a><span style="
											font-size: 10px;
											font-weight: bold;
											margin-top: 12px;
											margin-left: -65px;
											position: absolute;
											color: #4651FF;
											font-family: monospace;
										"><?php echo $version; ?></span></p>
	</div>  
	<!--jQuery-->
	<script type="text/javascript" src="cdn.php?file=jquery"></script>
	<!--Bootstrap-->
	<script type="text/javascript" src="cdn.php?file=bootstrap_js"></script>  
	<!--Holder-->
	<script type="text/javascript" src="cdn.php?file=holder"></script>
	<script type="text/javascript" src="cdn.php?file=init"></script>
	<!--jQuery cookie-->
	<script type="text/javascript" src="cdn.php?file=cookie"></script>    
	<!--Keen Data Viz-->
	<script type="text/javascript" src="cdn.php?file=keen_analysis"></script>
	<script type="text/javascript" src="cdn.php?file=keen_dataviz"></script>
	<!-- Project Analytics -->
	<!--<script type="text/javascript" src="static/js/keen-analytics.js"></script>-->
	<!--Moment js-->
	<script type="text/javascript" src="cdn.php?file=moment_js"></script>
	<!--Date Range Picker-->
	<script type="text/javascript" src="cdn.php?file=daterangepicker_js"></script> 
	<!--CubohAdmin Site-->
	<script type="text/javascript" src="cdn.php?file=admin"></script>  
	<script type="text/javascript" src="cdn.php?file=dashboard"></script>   	
	<script type="text/javascript" src="cdn.php?file=email"></script>   	
	<script type="text/javascript" src="js/site.js"></script>  	
</body>
</html>
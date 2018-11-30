/*
 *@Author:     @Author
 *@Description:Admin dasboard Graph
 *@Date:       30/11/2018
*/
//Set the Global variable Definitions.
var client
	,$userpk
	,set_loading
	,set_revenue_today
	,set_orders_per_week
	,set_sales_per_source
	,set_daily_sales_per_platform
	,set_weekly_sales
	,set_average_order_value
	,set_average_order_value_per_platform
	,set_taxes
	,set_iteminv
	,set_modinv
	,set_delivery_fees
	,set_tips;
var global_graph={};
$(function(){
	//Set Keen JS Cliend Credentials
	client = new Keen({
		  projectId: "5b64e745c9e77c0001ea6d78",
		  masterKey: "4B17301A4D08BE5B07EDAD4876420B919390893E3B53DCB34D235224EC4E0590",
		  readKey: "0B63415EBF79394D682631551864E85C7ADC59238B68C94D1BAFCAB5E42F130240F96387571C97757EE77BF5680B64A97F0AF3262915F7E5E89CB6CFCA80413CEE1B88BA3D0F09317DC1E63F20A24EADE3F79076E509A1E6082AF9DE319C97CE"
	});
	//Set user id
	$userpk=$.cookie("user_pk");
	//set loading div
	set_loading=function(element){
		$(element).html("<div class=\"keen-dataviz\">"+
						"<div class=\"keen-spinner-container keen-dataviz-box\">"+
							"<div class=\"keen-spinner-indicator\"></div>"+
						"</div>"+
					"</div>");
	};
	// Revenue Today
	var revenue_today = new Keen.Dataviz()
	.el("#revenue_today")
	.chartOptions({
		prefix: '$'
	})
	.type("metric")
	.prepare();  
	//Set set_revenue_today fuction
	set_revenue_today=function($start,$end,$range){
		const revenuetoday = 'revenuetoday';
		//if $range is undefined then set it.		
		$range=($range===undefined)?"Today":$range;
		$range=global_graph["#revenue_today"]!==undefined?global_graph["#revenue_today"]["range"]:$range;
		//Set Graph Title.
		revenue_today = new Keen.Dataviz()
		.el("#revenue_today")
		.chartOptions({
			prefix: '$'
		})
		.type("metric")		
		.prepare();  
		revenue_today.config.title="Revenue "+$range;
		$("#sprevenue").html($range);
		client
		  .query("sum", {
			event_collection: "orders",
			filters: [{"operator":"eq","property_name":"user","property_value":$userpk}],
			target_property: "revenue",
			timeframe: global_graph["#revenue_today"]!==undefined?$timeframe[global_graph["#revenue_today"]["range"]]:$timeframe[$range],
			timezone: $.cookie("timezone"),
		  })
		  .then(function(res) {
			revenue_today.data(res).render();
		  })
		  .catch(function(err) {
			revenue_today.message(err.message);
		  });
	};
	// Weekly Sales
	var weekly_sales = new Keen.Dataviz()
      .el("#weekly_sales")
      //.title("Weekly Revenue")
      .type("areachart")
      .prepare();
	const weeklysales = 'weeklysales';
	//Set set_weekly_sales functio 
	set_weekly_sales=function($start,$end,$range)
	{
		//if $range is undefined then set it.		
		$range=($range===undefined)?"7 Days":$range;
		//Set Graph Title.
		weekly_sales.config.title="Revenue for " + $range;
		//Set Date Range Span Label	
		$("div.reportrange[graph=#weekly_sales]>span").html(($range!=="Custom Range")?$range:$start.format('YYYY-MM-DD') +" - " + $end.format('YYYY-MM-DD'));
		//client request
		client
		  .query("sum", {
			  event_collection: "orders",
			  filters: [{"operator":"eq","property_name":"user","property_value":$userpk}],
			  interval: "daily",
			  target_property: "revenue",
			  //timeframe: "this_7_days",
			  timeframe: $timeframe[$range],
			  //timezone: "US/Eastern",
			  timezone: $.cookie("timezone"),
		  })
		  .then(function(res) {
			weekly_sales.data(res).render();
		  })
		  .catch(function(err) {
			weekly_sales.message(err.message);
		  }); 
	}; 
	// Number of orders per week
    var orders_per_week = new Keen.Dataviz()
      .el("#orders_per_week")
      //.title("Number of Orders")
      .type("areachart")
      .prepare();
	const ordersperweek = 'ordersperweek';
	//Set set_orders_per_week function
	set_orders_per_week=function($start,$end,$range){
		//if $range is undefined then set it.		
		$range=($range===undefined)?"Last 4 Weeks":$range;
		//Set Graph Title.
		orders_per_week.config.title="Number of Orders For " + ($range);	
		//Set Date Range Span Label			
		$("div.reportrange[graph=#orders_per_week]>span").html(($range!=="Custom Range")?$range:$start.format('YYYY-MM-DD') +" - " + $end.format('YYYY-MM-DD'));			
		//client request
		client
		  .query("count", {
			event_collection: "orders",
			filters: [{"operator":"eq","property_name":"user","property_value":$userpk}],
			interval: "weekly",
			//timeframe: "this_4_weeks",
			timeframe: $timeframe[$range],
			//timezone: "US/Eastern",
			timezone: $.cookie("timezone"),
		  })
		  .then(function(res) {
			orders_per_week.data(res).render();
		  })
		  .catch(function(err) {
			orders_per_week.message(err.message);
		  });
	};     
	// Breakdown of Sales Per Platform
    var sales_per_source = new Keen.Dataviz()
      .el("#sales_per_source")
      //.title("Breakdown of Sales Per Source")
      .type("piechart")
      .prepare();
	const salespersource = 'salespersource';
	set_sales_per_source=function($start,$end,$range){
		//if $range is undefined then set it.		
		$range=($range===undefined)?"7 Days":$range;
		//Set Graph Title.
		sales_per_source.config.title="Breakdown of Sales Per Source (" + $range +")";	
		//Set Date Range Span Label	
		$("div.reportrange[graph=#sales_per_source]>span").html(($range!=="Custom Range")?$range:$start.format('YYYY-MM-DD') +" - " + $end.format('YYYY-MM-DD'));
		//client request	
		client
		  .query("count", {
			  event_collection: "orders",
			  filters: [{"operator":"eq","property_name":"user","property_value":$userpk}],
			  group_by: "app",
			  //timeframe: "this_7_days",
			  timeframe: $timeframe[$range],
			  //timezone: "US/Eastern",
			  timezone: $.cookie("timezone"),
		  })
		  .then(function(res) {
			sales_per_source.data(res).render();
		  })
		  .catch(function(err) {
			//sales_per_source.message(err.message);
		  });      
	};
	//Daily Sales per Online Ordering Platform
    var daily_sales_per_platform = new Keen.Dataviz()
      .el("#daily_sales_per_platform")
      .type("columnchart")
      .prepare();
	const dailysalesperplatform = 'dailysalesperplatform';
	//Set set_daily_sales_per_platform function
	set_daily_sales_per_platform=function($start,$end,$range,$type){
		//Set the type graph
		$type=($type===undefined)?"columnchart":$type;
		//
		daily_sales_per_platform = new Keen.Dataviz()
		  .el("#daily_sales_per_platform")
		  //.type("columnchart")
		  .type($type)
		  .prepare();
		
		//if $range is undefined then set it.		
		$range=($range===undefined)?"7 Days":$range;
		//Set Graph Title.
		daily_sales_per_platform.config.title="Revenue Per Platform " + $range;	
		//Set Date Range Span Label	
		$("div.reportrange[graph=#daily_sales_per_platform]>span").html(($range!=="Custom Range")?$range:$start.format('YYYY-MM-DD') +" - " + $end.format('YYYY-MM-DD'));
		//client request
		client
		  .query("sum", {
			  event_collection: "orders",
			  group_by: ["app"],
			  filters: [{"operator":"eq","property_name":"user","property_value":$userpk}],
			  interval: "daily",
			  target_property: "revenue",
			  //timeframe: "this_7_days",
			  timeframe: $timeframe[$range],
			  //timezone: "US/Eastern",
			  timezone: $.cookie("timezone"),
		  })
		  .then(function(res) {
			daily_sales_per_platform.data(res).render();
		  })
		  .catch(function(err) {
			daily_sales_per_platform.message(err.message);
		  }); 
	};   	
	// Average Order Value For This Month
	var average_order_value = new Keen.Dataviz()
      .el("#average_order_value")
      //.title("Average Order Value For This Month")
      .type("metric")
      .prepare();
	const averageordervalue = 'averageordervalue';
	//Set set_average_order_value function
	set_average_order_value=function($start,$end,$range){
		//if $range is undefined then set it.
		$range=($range===undefined)?"This Month":$range;
		//Set Graph Title.
		average_order_value.config.title="Average Order Value For " + $range;
		//Set Date Range Span Label	
		$("div.reportrange[graph=#average_order_value]>span").html(($range!=="Custom Range")?$range:$start.format('YYYY-MM-DD') +" - " + $end.format('YYYY-MM-DD'));
		//client request
		client
		  .query("average", {
			  event_collection: "orders",
			  filters: [{"operator":"eq","property_name":"user","property_value":$userpk}],
			  target_property: "revenue",
			  //timeframe: "this_month",
			  timeframe: $timeframe[$range],
			  //timezone: "US/Eastern",
			  timezone: $.cookie("timezone"),
		  })
		  .then(function(res) {
			average_order_value.data(res).render();
		  })
		  .catch(function(err) {
			average_order_value.message(err.message);
		  }); 
	};    
	// Average Order Value Per Platform This Month
	var average_order_value_per_platform = new Keen.Dataviz()
      .el("#average_order_value_per_platform")
      //.title("Average Order Value Per Platform This Month")
      .type("columnchart")
      .prepare();
	const averageordervalueperplatform = 'averageordervalueperplatform';
	//Set set_average_order_value_per_platform function
	set_average_order_value_per_platform=function($start,$end,$range){
		//if $range is undefined then set it.		
		$range=($range===undefined)?"Last 14 Days":$range;
		//Set Graph Title.
		average_order_value_per_platform.config.title="Average Order Value Per Platform For " + $range;	
		//Set Date Range Span Label	
		$("div.reportrange[graph=#average_order_value_per_platform]>span").html(($range!=="Custom Range")?$range:$start.format('YYYY-MM-DD') +" - " + $end.format('YYYY-MM-DD'));	
		//client request
		client
		  .query("average", {
			  event_collection: "orders",
			  filters: [{"operator":"eq","property_name":"user","property_value":$userpk}],
			  group_by: ["app"],
			  target_property: "revenue",
			  //timeframe: "this_14_days",
			  timeframe: $timeframe[$range],
			  //timezone: "US/Eastern",
			  timezone: $.cookie("timezone"),
		  })
		  .then(function(res) {
			average_order_value_per_platform.data(res).render();
		  })
		  .catch(function(err) {
			average_order_value_per_platform.message(err.message);
		  }); 
	};
	// Taxes Per Year, Monthly
	var taxes = new Keen.Dataviz()
      .el("#taxes")
      .title("Monthly Taxes Paid")
      .type("linechart")
      .prepare();
	const taxes_monthly = 'taxes_monthly';
	//SET set_taxes function
	set_taxes=function($start,$end,$range){
		//if $range is undefined then set it.		
		$range=($range===undefined)?"Last 1 Year":$range;
		//Set Graph Title.
		taxes.config.title="Monthly Taxes Paid For " + $range;	
		//Set Date Range Span Label	
		$("div.reportrange[graph=#taxes]>span").html(($range!=="Custom Range")?$range:$start.format('YYYY-MM-DD') +" - " + $end.format('YYYY-MM-DD'));
		//client request
		client
		  .query("sum", {
			  event_collection: "orders",
			  filters: [{"operator":"eq","property_name":"user","property_value":$userpk}],
			  interval: "monthly",
			  target_property: "tax",
			  //timeframe: "this_1_years",
			  timeframe: $timeframe[$range],
			  //timezone: "US/Eastern",
			  timezone: $.cookie("timezone"),
		  })
		  .then(function(res) {
			taxes.data(res).render();
		  })
		  .catch(function(err) {
			taxes.message(err.message);
		  });
	};
	//Inventory Sales
	var iteminv = new Keen.Dataviz()
      .el("#iteminv")
      .type("table")
      .prepare();
	const iteminventory = 'iteminventory';
	//SET set_iteminv function
	set_iteminv=function($start,$end,$range,$type){
		//Set the type graph
		var $goupby=["item"];		
		if($type==="perplatform")
		{
			$goupby.push("app");
		}					
		//if $range is undefined then set it.		
		$range=($range===undefined)?"Today":$range;
		//Validation for last selected date.
		$range=global_graph["#iteminv"]!==undefined?global_graph["#iteminv"]["range"]:$range;
		//Set Graph Title.
		iteminv.config.title="Item Sales " + $range;
		if($start===undefined && global_graph["#iteminv"]!==undefined)
		{
			$start=global_graph["#iteminv"]["start"];
		}
		if($end===undefined && global_graph["#iteminv"]!==undefined)
		{
			$end=global_graph["#iteminv"]["end"];
		}		
		//Set Date Range Span Label	
		$("div.reportrange[graph=#iteminv]>span").html(($range!=="Custom Range")?$range:$start.format('YYYY-MM-DD') +" - " + $end.format('YYYY-MM-DD'));
		//client request
		client
		  .query("count", {
			event_collection: "items",
			filters: [{"operator":"eq","property_name":"user","property_value":$userpk}],
			group_by:$goupby,
			//timeframe: "this_1_days",
			timeframe: global_graph["#iteminv"]!==undefined?$timeframe[global_graph["#iteminv"]["range"]]:$timeframe[$range],
			order_by: {
			  'property_name': 'result',
			  'direction': 'DESC'
			},
			//timezone: "US/Pacific"
			timezone: $.cookie("timezone"),
		  })
		  .then(function(res) {
			iteminv.data(res).render();
		  })
		  .catch(function(err) {
			iteminv.message(err.message);
		  });
	};
	// Modifiers Sales
	var modinv = new Keen.Dataviz()
      .el("#modinv")
      .type("table")
      .prepare();
	const modinventory = 'modinventory';
	//SET set_modinv function
	set_modinv=function($start,$end,$range,$type){
		//Set the type graph
		var $goupby=["subitem"];
		if($type==="perplatform")
		{
			$goupby.push("app");
		}	
		//if $range is undefined then set it.		
		$range=($range===undefined)?"Today":$range;
		//Validation for last selected date.
		$range=global_graph["#modinv"]!==undefined?global_graph["#modinv"]["range"]:$range;
		//Set Graph Title.
		modinv.config.title="Modifier Sales " + $range;
		if($start===undefined && global_graph["#modinv"]!==undefined)
		{
			$start=global_graph["#modinv"]["start"];
		}
		if($end===undefined && global_graph["#modinv"]!==undefined)
		{
			$end=global_graph["#modinv"]["end"];
		}
		//Set Date Range Span Label	
		$("div.reportrange[graph=#modinv]>span").html(($range!=="Custom Range")?$range:$start.format('YYYY-MM-DD') +" - " + $end.format('YYYY-MM-DD'));
		//client request
		client
		  .query("count", {
			  event_collection: "modifiers",
			  filters: [{"operator":"eq","property_name":"user","property_value":$userpk}],
			  group_by:  $goupby,
			  order_by: {
				'property_name': 'result',
				'direction': 'DESC'
			  },			  			  
			  timeframe: global_graph["#modinv"]!==undefined?$timeframe[global_graph["#modinv"]["range"]]:$timeframe[$range],
			  //timezone: "US/Eastern"
			  timezone: $.cookie("timezone"),
		  })
		  .then(function(res) {
			modinv.data(res).render();
		  })
		  .catch(function(err) {
			modinv.message(err.message);
		  });
	};  
	/*
	 *Delivery Fees
	*/
	var delivery_fees = new Keen.Dataviz()
	.el("#delivery_fees")
	.chartOptions({
		prefix: '$'
	})
	.type("metric")
	.prepare();  
	//Set set_revenue_today fuction
	set_delivery_fees=function($start,$end,$range){
		//if $range is undefined then set it.		
		$range=($range===undefined)?"Today":$range;
		$range=global_graph["#delivery_fees"]!==undefined?global_graph["#delivery_fees"]["range"]:$range;
		//Set Graph Title.
		delivery_fees = new Keen.Dataviz()
		.el("#delivery_fees")
		.chartOptions({
			prefix: '$'
		})
		.type("metric")		
		.prepare();  
		delivery_fees.config.title="Delivery "+$range;
		$("#spdeliveryfee").html($range);
		client
		  .query("sum", {
			event_collection: "orders",
			filters: [{"operator":"eq","property_name":"user","property_value":$userpk}],
			target_property: "deliveryfee",
			timeframe: global_graph["#delivery_fees"]!==undefined?$timeframe[global_graph["#delivery_fees"]["range"]]:$timeframe[$range],
			timezone: $.cookie("timezone"),
		  })
		  .then(function(res) {
			delivery_fees.data(res).render();
		  })
		  .catch(function(err) {
			delivery_fees.message(err.message);
		  });
	};
	/*
	 *Tips
	*/
	var tips = new Keen.Dataviz()
	.el("#tips")
	.chartOptions({
		prefix: '$'
	})
	.type("metric")
	.prepare();  
	//Set set_revenue_today fuction
	set_tips=function($start,$end,$range){
		//if $range is undefined then set it.		
		$range=($range===undefined)?"Today":$range;
		$range=global_graph["#tips"]!==undefined?global_graph["#tips"]["range"]:$range;
		//Set Graph Title.
		tips = new Keen.Dataviz()
		.el("#tips")
		.chartOptions({
			prefix: '$'
		})
		.type("metric")		
		.prepare();  
		tips.config.title="Tips "+$range;
		$("#sptips").html($range);
		client
		  .query("sum", {
			event_collection: "orders",
			filters: [{"operator":"eq","property_name":"user","property_value":$userpk}],
			target_property: "tip",
			timeframe: global_graph["#tips"]!==undefined?$timeframe[global_graph["#tips"]["range"]]:$timeframe[$range],
			timezone: $.cookie("timezone"),
		  })
		  .then(function(res) {
			tips.data(res).render();
		  })
		  .catch(function(err) {
			tips.message(err.message);
		  });
	};	
});
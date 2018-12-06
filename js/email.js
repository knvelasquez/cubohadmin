/**
 *@Author:      @author
 *@Description: Extractions to csv file and sending email.
 *@Date:        06/12/2018
*/
//Set the Global variable Definitions.
var email_send
	,$graphcall
	,email_weekly_sales;
$(function(){	
	/**
	 *Email send function
	*/
	email_send=function(){
		//set the user_email cookie value.
		$.cookie("user_email",$("#dvemailtxt").val());
		//
		if($graphcall===undefined)
		{
			console.log("$graphcall is undefined");
			return false;			
		}
		if(typeof window[$graphcall]==="undefined")
		{
			console.log("this function '" + $graphcall + "();' is not defined, please check");
			return false;
		}		
		//TO-DO Validate is email is ok.
		window[$graphcall]();
	}
	$('#csvModal').on('shown.bs.modal',function($elem){
		var $userEmail=function(){
			return $.cookie("user_email");
		}
		$("#dvemailtxt").val(($userEmail!==undefined)?$userEmail("user_email"):"");
		//Set the graph email invok.
		$graphcall=$($elem.relatedTarget).parent().attr("graph_call");				
	});
	/**
	 *cvs extraction for revenue today
	*/
	email_revenue_today=function(){		
		client
		  .query("extraction", {
			event_collection: "orders",
			email: $.cookie("user_email"),
			timezone: $.cookie("timezone"),
			//
			filters: [{"operator":"eq","property_name":"user","property_value":$userpk}],
			target_property: "revenue",
			timeframe: global_graph["#revenue_today"]!==undefined?$timeframe[global_graph["#revenue_today"]["range"]]:$timeframe[$range]			
		  })
		  .then(function($res) {
			console.log($res);
		  })
		  .catch(function($err) {
			console.log($err);
		  });
	};
	/**
	 *csv extraction for weekly sales
	*/
	email_weekly_sales=function($range){
		$range=($range===undefined)?"7 Days":$range;
		//Validation for last selected date.
		$range=global_graph["#weekly_sales"]!==undefined?global_graph["#weekly_sales"]["range"]:$range;
		client
		  .query("extraction", {
			  event_collection: "orders",
			  email: $.cookie("user_email"),
			  //
			  filters: [{"operator":"eq","property_name":"user","property_value":$userpk}],
			  interval: "daily",
			  target_property: "revenue",			  
			  timeframe: global_graph["#weekly_sales"]!==undefined?$timeframe[global_graph["#weekly_sales"]["range"]]:$timeframe[$range],
			  timezone: $.cookie("timezone")
		  })
		  .then(function(res) {
			console.log($res);
		  })
		  .catch(function($err) {
			console.log($err);
		  }); 
	};
	/**
	 *csv extraction for orders per week
	*/
	email_orders_per_week=function($range){
		//	
		$range=($range===undefined)?"Last 4 Weeks":$range;	
		client
		  .query("extraction", {
			event_collection: "orders",
			email: $.cookie("user_email"),
			//
			filters: [{"operator":"eq","property_name":"user","property_value":$userpk}],
			interval: "weekly",
			timeframe: global_graph["#orders_per_week"]!==undefined?$timeframe[global_graph["#orders_per_week"]["range"]]:$timeframe[$range],
			timezone: $.cookie("timezone")
		  })
		  .then(function($res) {
				console.log($res);
		  })
		  .catch(function($err) {
				console.log($err);
		  });		
	};
	/**
	 *csv daily sales per platform
	*/
	email_daily_sales_per_platform=function($range){
		//		
		$range=($range===undefined)?"7 Days":$range;
		client
		  .query("extraction", {
			  event_collection: "orders",
			  email: $.cookie("user_email"),
			  //
			  filters: [{"operator":"eq","property_name":"user","property_value":$userpk}],
			  group_by: "app",
			  timeframe: global_graph["#daily_sales_per_platform"]!==undefined?$timeframe[global_graph["#daily_sales_per_platform"]["range"]]:$timeframe[$range],
			  timezone: $.cookie("timezone")
		  })
		  .then(function($res) {
				console.log($res);
		  })
		  .catch(function($err) {
				console.log($err);
		  });
	};
	/**
	 *csv for taxes
	*/
	email_taxes=function($range){	
		//
		$range=($range===undefined)?"Last 1 Year":$range;
		//
		client
		  .query("extraction", {
			  event_collection: "orders",
			  email: $.cookie("user_email"),
			  //
			  filters: [{"operator":"eq","property_name":"user","property_value":$userpk}],
			  interval: "monthly",
			  target_property: "tax",
			  timeframe: global_graph["#taxes"]!==undefined?$timeframe[global_graph["#taxes"]["range"]]:$timeframe[$range],
			  timezone: $.cookie("timezone")
		  })
		  .then(function($res) {
				console.log($res);
		  })
		  .catch(function($err) {
				console.log($err);
		  });
	};
	/**
	 *csv for item inv
	*/
	email_iteminv=function($range,$type){
		//Set the type graph
		var $goupby=["item"];		
		if($type==="perplatform")
		{
			$goupby.push("app");
		}					
		//if $range is undefined then set it.		
		$range=($range===undefined)?"Today":$range;		
		client
		  .query("extraction", {
			event_collection: "items",
			email: $.cookie("user_email"),
			//
			filters: [{"operator":"eq","property_name":"user","property_value":$userpk}],
			group_by:$goupby,
			timeframe: global_graph["#iteminv"]!==undefined?$timeframe[global_graph["#iteminv"]["range"]]:$timeframe[$range],
			order_by: {
			  'property_name': 'result',
			  'direction': 'DESC'
			},
			timezone: $.cookie("timezone")
		  })
		  .then(function($res) {
				console.log($res);
		  })
		  .catch(function($err) {
				console.log($err);
		  });
	};
	/**
	 *csv for mod inv
	*/
	email_modinv=function($range,$type){
		//Set the type graph
		var $goupby=["subitem"];
		if($type==="perplatform")
		{
			$goupby.push("app");
		}	
		//if $range is undefined then set it.		
		$range=($range===undefined)?"Today":$range;		
		client
		  .query("extraction", {
			  event_collection: "modifiers",
			  email: $.cookie("user_email"),
			  //
			  filters: [{"operator":"eq","property_name":"user","property_value":$userpk}],
			  group_by:  $goupby,
			  order_by: {
				'property_name': 'result',
				'direction': 'DESC'
			  },			  
			  timeframe: global_graph["#modinv"]!==undefined?$timeframe[global_graph["#modinv"]["range"]]:$timeframe[$range],
			  timezone: $.cookie("timezone")
		  })
		  .then(function($res) {
				console.log($res);
		  })
		  .catch(function($err) {
				console.log($err);
		  });
	};	
});
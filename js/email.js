/*
 *@Author:     @Author
 *@Description:@Email function Description
 *@Date:       @Date
*/
//Set the Global variable Definitions.
var email_send
	,$graphcall
	,email_weekly_sales;
$(function(){	
	/*
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
		//
		var $userEmail=function(){
			return $.cookie("user_email");
		}
		$("#dvemailtxt").val(($userEmail!==undefined)?$userEmail("user_email"):"");
		//Set the graph email invok.
		$graphcall=$($elem.relatedTarget).parent().attr("graph_call");				
	});
	//
	email_revenue_today=function(){		
		client
		  .query("extraction", {
			event_collection: "orders",
			email: $.cookie("user_email"),
			timezone: "US/Eastern",
			//
			filters: [{"operator":"eq","property_name":"user","property_value":$userpk}],
			target_property: "revenue",
			timeframe: "this_1_days"			
		  })
		  .then(function($res) {
			console.log($res);
		  })
		  .catch(function($err) {
			console.log($err);
		  });
	};
	//
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
			  timeframe: $timeframe[$range],
			  timezone: "US/Eastern"
		  })
		  .then(function(res) {
			console.log($res);
		  })
		  .catch(function($err) {
			console.log($err);
		  }); 
	};
	//
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
			timeframe: $timeframe[$range],
			timezone: "US/Eastern"
		  })
		  .then(function($res) {
				console.log($res);
		  })
		  .catch(function($err) {
				console.log($err);
		  });		
	};
	//
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
			  timeframe: $timeframe[$range],
			  timezone: "US/Eastern"
		  })
		  .then(function($res) {
				console.log($res);
		  })
		  .catch(function($err) {
				console.log($err);
		  });
	};
	//
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
			  timeframe: $timeframe[$range],
			  timezone: "US/Eastern"
		  })
		  .then(function($res) {
				console.log($res);
		  })
		  .catch(function($err) {
				console.log($err);
		  });
	};
	//
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
			timeframe: $timeframe[$range],
			order_by: {
			  'property_name': 'result',
			  'direction': 'DESC'
			},
			timezone: "US/Pacific"
		  })
		  .then(function($res) {
				console.log($res);
		  })
		  .catch(function($err) {
				console.log($err);
		  });
	};
	//
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
			  timeframe: $timeframe[$range],
			  timezone: "US/Eastern"
		  })
		  .then(function($res) {
				console.log($res);
		  })
		  .catch(function($err) {
				console.log($err);
		  });
	};	
});
/*
 *@Author:     @Author
 *@Description:@Description
 *@Date:       @Date
*/
var $timeframe={
	 "Today":"today"	
	,"Yesterday":"previous_1_days"	
	,"Last 7 Days":"this_1_weeks"			
	,"This Month":"this_1_months"	
	,"Last Month":"previous_1_months"	
	,"This Year":"this_1_years"
	,"Last Year":"previous_1_years"		
	//Custom Range
	,"Last 1 Year":"this_1_years"
	,"Last 4 Weeks":"this_4_weeks"
	,"Last 14 Days":"this_14_days"
	,"7 Days":"this_7_days"
	,"Custom Range":{
		"start":null,
		"end":null		
	}
};
$(function(){	
	//Set the Dropdown Table Options.
	$(".dropdown.table-options ul a").click(function($event){		
		$graphType=$(this).attr("graph-type");
		$graphelem=$(this).closest(".dropdown.table-options").attr("graph");
		$graphCall=$(this).closest(".dropdown.table-options").attr("graph_call");
		$(this).closest(".dropdown.table-options").find("button span:first-child").html($(this).text());
		//Set refresh graph
		set_loading($graphelem);
		//set the call.
		window[$graphCall](undefined,undefined,undefined,$graphType);
	});	
	//Set the tooltips.
	$('[data-toggle="tooltip"]').tooltip();
	//Initialize all graphipc
	var initAllGraph=function(){
		set_revenue_today();
		set_orders_per_week(); 
		set_sales_per_source();
		set_daily_sales_per_platform(); 
		set_weekly_sales(); 
		set_average_order_value();
		set_average_order_value_per_platform();
		set_taxes();
		set_iteminv();
		set_modinv();
	}
	if($.cookie("timezone")===undefined)
	{
		//Set the time zone of the current location.
		/*$.getJSON( "http://ip-api.com/json", function($data) {		
			$.cookie("timezone", $data.timezone);
			initAllGraph();			
		});*/
		$.cookie("timezone", "US/Eastern");
		initAllGraph();	
	}		
	else
	{
		initAllGraph();
	}	
	//Set the date range picker.
    $('.reportrange').daterangepicker({
		"autoApply": true,
		"showDropdowns": true,
		/*"minYear": 2017,
		"maxYear": 2020,
		//if minyear is set then minDate must be set.
		"minDate":"01/02/2017",//MM/DD/YYYY.
		//if maxYear is set then maxDate must be set.
		"maxDate":"12/30/2020",//MM/DD/YYYY.*/
		ranges: {
			'Today': [moment(), moment()],
			'Yesterday'  : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Last 7 Days': [moment().subtract(6, 'days'), moment()],
			'This Month' : [moment().startOf('month'), moment().endOf('month')],
			'Last Month' : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
			'This Year'  : [moment().startOf('year'), moment().endOf('year')],
			'Last Year'  : [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
		},
		"linkedCalendars": false,
		"alwaysShowCalendars": true,
		"startDate": moment().subtract(29, 'days'),
		"endDate": moment(),
		//"opens": "center"
    }, function($start,$end,$range){	
			var $graphelem=this.element.attr("graph");
			global_graph[$graphelem]={
				"start" :$start
				,"end"  :$end
				,"range":$range
			}
			//Set Date Range Span Label
			$("div.reportrange[graph="+$graphelem+"]>span").html(($range==="Custom Range")?$start.format('MMM YYYY') + ' to ' + $end.format('MMM YYYY'):$range);
			//Set refresh graph
			set_loading($graphelem);
			//
			if($range==="Custom Range")
			{
				$timeframe[$range]["start"]=$start.format('YYYY-MM-DDT00:00:00');
				$timeframe[$range]["end"]=$end.format('YYYY-MM-DDT00:00:00');
			}				
			if (typeof window[this.element.attr("graph_call")] === "function") 
			{
				window[this.element.attr("graph_call")]($start,$end,$range);
			}
			else
			{
				console.log("function "+this.element.attr("graph_call")+" not exist!");
				$(this.element.attr("graph")).html("");
			}					
	});	
	//Logout user
	$("#btnlogout,.logout-btn").click(function(){
			$.removeCookie("token");
			$.removeCookie("user_pk");
			$.removeCookie("name");
			window.location.href = "./";		
	});
});
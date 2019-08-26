/**
 *@Author:      @author
 *@Description: @Short description of the file
 *@Date:        26/08/2019
*/
$(function(){				
	$('#langOpt').multiselect({
		columns: 1,				
		placeholder: 'Select Locations',
		search: true,
		selectAll: true,
		unselectAll:true,
		texts:{
			selectAll:"Select All",
			unselectAll:"Unselect All"
		},
		onOptionClick : function( element, option ){},
		onControlClose: function( element ){
			var $userId=$(element).find("option:selected").map(function () {
				return $(this).attr("value");
			}).get().join(',');
			//
			client.query("sum", {
				event_collection: "orders",
				filters: [{"operator":"eq","property_name":"user","property_value":$userId}],
				target_property: "revenue",
				timeframe: "today",
				timezone: "America/Argentina/Buenos_Aires"
			  })
			  .then(function(res) {		
					console.log(res);
			  })
			  .catch(function(err) {
					console.log(err);
			  });
		} 
	});
});
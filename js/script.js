/*
 *@Author:     @Author
 *@Description:@Description
 *@Date:       @Date
*/
$(function(){	
	//Validate if user has session
	if($.cookie("user_pk")!==undefined)
	{
		window.location.href = "./dashboard.php";
	}
	/*
	 *@url_base:@decription	 
	*/
	var $url_base=function($method){
		return "https://fathomless-thicket-42350.herokuapp.com/rest-auth/"+$method;	
	};
	/*
	 *@setParam:@description
	*/	
	var $setParam=function($json){
		return {
			username: $json[0].value,
			password: $json[1].value
		}
	}
	/*
	 *@LoginButton:@description
	*/
	$(".button").click(function(){
		$button=$(this);
		$button.val("Wait...");
		//Sending POST with parameters.
		var $login=function($withCredentials){						
			$.ajax({
				type: "POST",
				url: $url_base("login/"),
				crossDomain: true,
				data:$setParam($(".form-horizontal").serializeArray()),			
				xhrFields: {
				  withCredentials: $withCredentials
				},		
				headers : {
					//'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'
				},			
				beforeSend: function(xhr) {	},
				success: function($result,$msg,$obj){
					console.log($msg + " : " + $result.key);
					//Validate if response status is 200
					if($obj.status===200)
					{			
						//Sending GET with credentials to get user details
						$.ajax({
							type: "GET",
							url: $url_base("user/?format=json"),
							contentType: "application/json",
							//crossDomain: true,
							//dataType: "json",
							xhrFields: {
							  withCredentials: true
							},						
							headers : {},
							beforeSend: function(xhr) {},						
							success: function($result,$msg,$obj){
								//TODO-Go to next page
								$.cookie("user_pk", $result.pk);
								window.location.href = "dashboard.php";						
							},
							error:function($object,$error,$message){
								console.warn($error+ " " + $object.status.toString() + " : " + $message);	
								$login(true);								
							}
						});								
					}				
				},
				error:function($object,$error,$message) {			
					console.warn($error+ " " + $object.status.toString() + " : " + $message);
					$login(true);
				},
				always:function($object,$info,$message) {
					console.info($info+ " " + $info.status + " : " + $message);
					$button.val("Login");			
				}
			});	
		};
		$login(false);						
	})
});
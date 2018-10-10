/*
 *@Author:     @Author
 *@Description:@Description
 *@Date:       @Date
*/
$(function(){	
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
		$.ajax({
			type: "POST",
			url: $url_base("login/"),
			//crossDomain: true,
			data:$setParam($(".form-horizontal").serializeArray()),
			/*xhrFields: {
			  withCredentials: true
			},*/
			success: function($result,$msg,$obj){
				console.log($msg + " : " + $result.key);
				//Validate if response status is 200
				if($obj.status===200)
				{			
					//Sending GET with credentials to get user details
					$.ajax({
						type: "GET",
						url: $url_base("user/"),
						crossDomain: true,
						xhrFields: {
						  withCredentials: true
						},
						success: function($result,$msg,$obj){
							//TODO-Go to next page
							$.cookie("user_pk", $result.pk);
							window.location.href = "dashboard.php";						
						}
					});								
				}				
			},
			fail:function($object,$error,$message) {			
				console.error($error+ " " + $object.status + " : " + $message);
			},
			always:function($object,$info,$message) {
				console.info($info+ " " + $info.status + " : " + $message);
				$button.val("Login");			
			}
		});					
	})
});
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
			crossDomain: true,
			data:$setParam($(".form-horizontal").serializeArray()),			
			xhrFields:{
			  withCredentials: false
			},		
			headers:{},			
			beforeSend: function(xhr) {	},
			success: function($result,$msg,$obj){
				console.log($msg + " : " + $result.key);
				if($obj.status===200)
				{			
					$.cookie("token", $result.key);
					$.ajax({
						type: "GET",
						url: $url_base("user/"),
						contentType: "application/json",
						crossDomain: true,						
						xhrFields: {
						  withCredentials: true
						},						
						headers : {
							'Authorization':'Token '+$result.key,
						},
						beforeSend: function(xhr) {},						
						success: function($result,$msg,$obj){
							$.cookie("name",$result.first_name.toUpperCase().substring(0,2)+"-"+$result.last_name.toUpperCase().substring(0,2))
							$.cookie("user_pk", $result.pk);							
							window.location.href = "dashboard.php";						
						},
						error:function($object,$error,$message){
							console.log($error+ " " + $object.status.toString() + " : " + $message);								
						},
						always:function($object,$error,$message){
							console.log($error+ " " + $object.status.toString() + " : " + $message);
						}
					});								
				}				
			},
			error:function($object,$error,$message) {			
				console.log($error+ " " + $object.status.toString() + " : " + $message);
				alert("Incorrect user or password");
			},
			always:function($object,$info,$message) {
				console.log($info+ " " + $info.status + " : " + $message);
				$button.val("Login");			
			}
		});							
	})
});
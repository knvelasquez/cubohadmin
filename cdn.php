<?php
/*
 *@Author:     @Author
 *@Description:@Description
 *@Date:       @Date
*/
$files = array(
	/*keen data viz*/
	'keen_dataviz_2_0_4_min_css.css'=>'keen/keen-dataviz-2.0.4.min.css'
	,'keen_dataviz_min_css.css'=>'keen/keen-dataviz.min.css'	
	,'keen_dashboard'=>'keen/dashboards.css'
	,'keen_analysis'=>'keen/keen-analysis3.js'
	,'keen_dataviz'=>'keen/keen-dataviz.min.js'	
	/*Bootstrap*/
	,'bootstrap_css'=>'bootstrap/bootstrap.min.css'
	,'bootstrap_js'=>'bootstrap/bootstrap.min.js'	
	/*jQuery*/
	,'jquery'=>'jquery/jquery.min.js'
	/*Holder*/
	,'holder'=>'holder/holder.min.js'
	,'init'=>'holder/init.js'
	/*Date Range Picker*/
	,'daterangepicker_css'=>'daterangepicker/daterangepicker.css'
	,'daterangepicker_js'=>'daterangepicker/daterangepicker.min.js'
	,'moment_js'=>'daterangepicker/moment.min.js'
	/*Js*/
	,'admin' => 'js/admin.js'
	,'dashboard' =>'js/dashboard.js'
	,'cookie' =>'js/jquery.cookie.js'
	,'script' =>'js/script.js'		
	,'email' =>'js/email.js'
	/*jQuery Multi-select*/
	,'multiselect_css'=>'css/jquery.multiselect.css'	
	,'multiselect_js'=>'js/jquery.multiselect.js'
	,'multiselect_init_js'=>'js/jquery.multiselect.init.js'
);
//echo $_GET['file']==='admin';
if(isset($files[$_GET['file']]))
{
	//or, if you DO want a file to cache, use:
	//header("Cache-Control: public, max-age=2592000, must-revalidate"); //30days (60sec * 60min * 24hours * 30days)
							
	//set headers to NOT cache a page
	//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	//header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
	//header("Pragma: no-cache"); //HTTP 1.0		

	//$file_last_mod_time = filemtime(__FILE__);// Get last modification time of the current PHP file		
	$file_last_mod_time = filemtime($files[$_GET['file']]);		
	// Get last modification time of the main content (that user sees)
	// Hardcoded just as an example
	$content_last_mod_time = 1520949851;		

	// Combine both to generate a unique ETag for a unique content
	// Specification says ETag should be specified within double quotes
	$etag = '"' . $file_last_mod_time . '.' . $content_last_mod_time . '"';		

	// Set ETag header
	header('ETag: ' . $etag);

	// Check whether browser had sent a HTTP_IF_NONE_MATCH request header
	if(isset($_SERVER['HTTP_IF_NONE_MATCH'])) 
	{
		// If HTTP_IF_NONE_MATCH is same as the generated ETag => content is the same as browser cache
		// So send a 304 Not Modified response header and exit
		if($_SERVER['HTTP_IF_NONE_MATCH'] == $etag) {
			header('HTTP/1.1 304 Not Modified', true, 304);
			exit();
		}
	}			
	echo file_get_contents($files[$_GET['file']]);	
}
?>
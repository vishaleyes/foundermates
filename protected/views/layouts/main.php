<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>##_SITENAME_## Beta</title>

<link href="<?php echo Yii::app()->params->base_url; ?>css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->params->base_url; ?>css/validationEngine.jquery.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="<?php echo Yii::app()->params->base_url; ?>images/favicon.ico" />
<script src="<?php echo Yii::app()->params->base_url; ?>js/jquery-1.8.2.min.js" type="text/javascript"></script>

<script src="<?php echo Yii::app()->params->base_url; ?>js/jquery.validationEngine-en.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url; ?>js/jquery.validationEngine.js" type="text/javascript"></script>

<script type="text/javascript">
var BASHPATH='<?php echo Yii::app()->params->base_url; ?>';
var $j = jQuery.noConflict();

$j(document).ready(function(){

	var msgBox	=	$j('#msgbox');
	msgBox.click(function(){
		msgBox.fadeOut();
	});
});
	
function confirmBox() {
	if(confirm("Are sure want to clear db?")) {
		return true;
	}
	return false;
}

function dropmenu() {
	 $i("#menuadmin").toggle();
	}


function changeBG()
 {
	if($j("#password").val()=='')
	{
		$j("#password").css('background','#ffffff url(../images/##_PASSWORD_IMAGE_##) left center');
		$j("#password").css('background-repeat','no-repeat');
	}
 }
</script>

</head>
<body>
  	<?php
	
	if(!Yii::app()->session['adminUser']) { 
	?>
   <header>

<div class="admintoppaneladmin">
<a href="<?php echo Yii::app()->params->base_path;?>admin"><span>FounderMates</span></a><font class="tagline">"Seek.Share.Synergize"</font>
</div>
<div class="adminnavadmin">
    <ul>
        <li><a href="<?php echo Yii::app()->params->base_path;?>site">Site</a></li>
        <li><a href="<?php echo Yii::app()->params->base_path;?>admin/" class="current">Login</a></li>
       
        
    </ul>
</div>
</header>
	<?php }else { ?> 
  <header>

<div class="admintoppaneladmin">
<a href="<?php echo Yii::app()->params->base_path;?>admin"><span style="margin-left:10px ;">FounderMates</span></a><font style=" left:115px;" class="tagline">"Seek.Share.Synergize"</font>
</div>

<div class="adminnavadmin adminnavmargin" style="padding-left:340px; max-width:1000px;">
    <ul>
        <li><a href="<?php echo Yii::app()->params->base_path;?>admin/users" <?php if(Yii::app()->session['current'] == 'users'){  ?> class="current" <?php } ?>>Signup Approvals</a></li>
        <li><a href="<?php echo Yii::app()->params->base_path;?>admin/QuestionApproval" <?php if(Yii::app()->session['current'] == 'Questions'){  ?> class="current" <?php } ?>>QUESTION Approvals</a></li>
        <li><a href="<?php echo Yii::app()->params->base_path;?>admin/emails" <?php if(Yii::app()->session['current'] == 'Emails'){  ?> class="current" <?php } ?>>Emails</a></li>
        <li><a href="<?php echo Yii::app()->params->base_path;?>admin/reviews" <?php if(Yii::app()->session['current'] == 'Reviews'){  ?> class="current" <?php } ?> >Review Approvals</a></li>
         <li><a href="<?php echo Yii::app()->params->base_path;?>admin/DeleteUsers" <?php if(Yii::app()->session['current'] == 'Delete Users'){  ?> class="current" <?php } ?> >Delete User</a></li>
        <li style="height: 35px; margin-left: -50px;"><a href="#"<?php if(Yii::app()->session['current'] == 'adminTab'){  ?> class="current" <?php } ?>><font class="username">Hi, Admin</font>&nbsp;
        <div class="triangle triangleadmin" style="right: 10.5%;"></div></a>
        <div class="dropdownContain admindrop">        
					<div class="dropOut"  style="right: 9%;">						
                    <div class="triangleup"></div>
						<ul>
							<li onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>admin/changePassword'">Change Password</li>
                             <li onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>admin/keywordsListing'">Search Keywords</li>
                            <li onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>admin/exportView'">Export Data</li>
							<li onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>admin/logout'">Log Out</li>
						</ul>
					</div>
				</div>
		</li>
    </ul>
</div>
</header>


</header>
		<?php } ?>
	<!--<div class="middle">
        <div class="clear"></div>
    </div>-->
     <div class="clear"></div>
    
            <div align="left"> 
      		<?php //echo Yii::app()->user->setFlash('error', "adsfasdfasfsadf");?>
            <?php if(Yii::app()->user->hasFlash('success')): ?>								   
            <div id="msgbox" class="clearmsg" style="margin-top:0px !important;"><?php echo Yii::app()->user->getFlash('success'); ?></div>
            <div class="clear"></div>
            <?php endif; ?>
            <?php if(Yii::app()->user->hasFlash('error')): ?>
            <div id="msgbox" class="errormsg" style="margin-top:0px !important;" > <?php echo Yii::app()->user->getFlash('error'); ?></div>     
            <?php endif; ?>
            </div>
            
            <div>
          
                <?php echo $content; ?>
            </div>
            <!-- Footer Part content-->
            
         </div>
          <div class="clear"></div>
    </div>

<footer>
	
<div class="twitterfeed"><h1 class="twittericon"></h1><span class="latestupdate">
<marquee style="width:700px !important; color:#FFAD77;" scrollamount="4">
<?php 


/**
* 	Oauth.php
*
*	Created by Jon Hurlock on 2013-03-20.
* 	
*	Jon Hurlock's Twitter Application-only Authentication App by Jon Hurlock (@jonhurlock)
*	is licensed under a Creative Commons Attribution-ShareAlike 3.0 Unported License.
*	Permissions beyond the scope of this license may be available at http://www.jonhurlock.com/.
*/


// fill in your consumer key and consumer secret below
define('CONSUMER_KEY', 'OqrzQV3aE6EvWMMoUf8Bg');
define('CONSUMER_SECRET', 'z0z0V5etj5onAC54jCRFIHo9abkTnwwBXEFe0n3rjw');
/**
*	Get the Bearer Token, this is an implementation of steps 1&2
*	from https://dev.twitter.com/docs/auth/application-only-auth
*/
function get_bearer_token(){
	// Step 1
	// step 1.1 - url encode the consumer_key and consumer_secret in accordance with RFC 1738
	$encoded_consumer_key = urlencode(CONSUMER_KEY);
	$encoded_consumer_secret = urlencode(CONSUMER_SECRET);
	// step 1.2 - concatinate encoded consumer, a colon character and the encoded consumer secret
	$bearer_token = $encoded_consumer_key.':'.$encoded_consumer_secret;
	// step 1.3 - base64-encode bearer token
	$base64_encoded_bearer_token = base64_encode($bearer_token);
	// step 2
	$url = "https://api.twitter.com/oauth2/token"; // url to send data to for authentication
	$headers = array( 
		"POST /oauth2/token HTTP/1.1", 
		"Host: api.twitter.com", 
		"User-Agent: jonhurlock Twitter Application-only OAuth App v.1",
		"Authorization: Basic ".$base64_encoded_bearer_token."",
		"Content-Type: application/x-www-form-urlencoded;charset=UTF-8", 
		"Content-Length: 29"
	); 

	$ch = curl_init();  // setup a curl
	curl_setopt($ch, CURLOPT_URL,$url);  // set url to send to
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // set custom headers
	curl_setopt($ch, CURLOPT_POST, 1); // send as post
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return output
	curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials"); // post body/fields to be sent
	$header = curl_setopt($ch, CURLOPT_HEADER, 1); // send custom headers
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	$retrievedhtml = curl_exec ($ch); // execute the curl
	curl_close($ch); // close the curl
	$output = explode("\n", $retrievedhtml);
	$bearer_token = '';
	foreach($output as $line)
	{
		if($line === false)
		{
			// there was no bearer token
		}else{
			$bearer_token = $line;
		}
	}
	$bearer_token = json_decode($bearer_token);
	return $bearer_token->{'access_token'};
}

/**
* Invalidates the Bearer Token
* Should the bearer token become compromised or need to be invalidated for any reason,
* call this method/function.
*/
function invalidate_bearer_token($bearer_token){
	$encoded_consumer_key = urlencode(CONSUMER_KEY);
	$encoded_consumer_secret = urlencode(CONSUMER_SECRET);
	$consumer_token = $encoded_consumer_key.':'.$encoded_consumer_secret;
	$base64_encoded_consumer_token = base64_encode($consumer_token);
	// step 2
	$url = "https://api.twitter.com/oauth2/invalidate_token"; // url to send data to for authentication
	$headers = array( 
		"POST /oauth2/invalidate_token HTTP/1.1", 
		"Host: api.twitter.com", 
		"User-Agent: jonhurlock Twitter Application-only OAuth App v.1",
		"Authorization: Basic ".$base64_encoded_consumer_token."",
		"Accept: */*", 
		"Content-Type: application/x-www-form-urlencoded", 
		"Content-Length: ".(strlen($bearer_token)+13).""
	); 
    
	$ch = curl_init();  // setup a curl
	curl_setopt($ch, CURLOPT_URL,$url);  // set url to send to
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // set custom headers
	curl_setopt($ch, CURLOPT_POST, 1); // send as post
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return output
	curl_setopt($ch, CURLOPT_POSTFIELDS, "access_token=".$bearer_token.""); // post body/fields to be sent
	$header = curl_setopt($ch, CURLOPT_HEADER, 1); // send custom headers
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	$retrievedhtml = curl_exec ($ch); // execute the curl
	curl_close($ch); // close the curl
	return $retrievedhtml;
}

/**
* Search
* Basic Search of the Search API
* Based on https://dev.twitter.com/docs/api/1.1/get/search/tweets
*/
function search_for_a_term($bearer_token, $query, $result_type='mixed', $count='1'){
	$url = "https://api.twitter.com/1.1/search/tweets.json"; // base url
	$q = urlencode(trim($query)); // query term
	$formed_url ='?q='.$q; // fully formed url
	if($result_type!='mixed'){$formed_url = $formed_url.'&result_type='.$result_type;} // result type - mixed(default), recent, popular
	if($count!='15'){$formed_url = $formed_url.'&count='.$count;} // results per page - defaulted to 15
	$formed_url = $formed_url.'&include_entities=true'; // makes sure the entities are included, note @mentions are not included see documentation
	$headers = array( 
		"GET /1.1/search/tweets.json".$formed_url." HTTP/1.1", 
		"Host: api.twitter.com", 
		"User-Agent: jonhurlock Twitter Application-only OAuth App v.1",
		"Authorization: Bearer ".$bearer_token."",
	);
	$ch = curl_init();  // setup a curl
	curl_setopt($ch, CURLOPT_URL,$url.$formed_url);  // set url to send to
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // set custom headers
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return output
	$retrievedhtml = curl_exec ($ch); // execute the curl
	curl_close($ch); // close the curl
	return $retrievedhtml;
}


  
if($_SERVER['HTTP_HOST'] != 'localhost')
{
//getTweets('#yankees');
// lets run a search.
$bearer_token = get_bearer_token(); // get the bearer token
$data =  search_for_a_term($bearer_token, "@foundermates"); //  search for the work 'test'
$data1 = json_decode($data);

echo $data1->statuses[0]->text;
invalidate_bearer_token($bearer_token); // invalidate the token
/*
echo "<hr /><p>This page is an example for the article <a href=\"http://www.inkplant.com/code/get-twitter-posts-by-hashtag.php\">Get All Twitter Posts of a Specific Hashtag in PHP</a>.</p>" ;*/
}

?>


</marquee>
</span></div>
    <!-- BEGIN WIDGETS -->
      <div id="widgets">
          <div class="social-group">
          <a href="http://www.facebook.com/Foundermates?fref=ts" rel="external me" target="_blank" class="knob">
          <img src="<?php echo Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url ;?>images/facebook.png&h=40&w=40&q=60&zc=0" style="padding-top:-10px;"/></a>      
          <a href="https://twitter.com/foundermates" rel="external me" target="_blank" class="knob">
          <img src="<?php echo Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url ;?>images/twitter.png&h=40&w=40&q=60&zc=0" /></a>
          <a href="http://www.youtube.com/foundermates" rel="external me" target="_blank" class="knob">
          <img src="<?php echo Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url ;?>images/youtube.png&h=40&w=40&q=60&zc=0" />
          </a>      
          <a href="http://www.linkedin.com/company/3041498" rel="external me" target="_blank" class="knob">
           <img src="<?php echo Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url ;?>images/linkedin.png&h=40&w=40&q=60&zc=0" />
          </a>
          <a href="https://plus.google.com/u/1/103636925596337563630" rel="external me" target="_blank" class="knob">
          <img src="<?php echo Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url ;?>images/gplus.png&h=40&w=45&q=60&zc=0" />
         </a>    
          </div>                
      </div>
	  <!-- END WIDGETS -->
      <div class="navfooter"><a href="<?php echo Yii::app()->params->base_path;?>site/" style="color:#FFF;">Home</a> | <a href="<?php echo Yii::app()->params->base_path;?>site/howworks" style="color:#FFF;">How it Works</a> | <a  style="color:#FFF;" href="<?php echo Yii::app()->params->base_path; ?>site/about">About Us</a> | <a style="color:#FFF;" href="#">Work with Us</a> | <a style="color:#FFF;" href="<?php echo Yii::app()->params->base_path; ?>site/tos">Terms/Privacy</a> | <a style="color:#FFF;" href="<?php echo Yii::app()->params->base_path; ?>site/contact">Contact Us</a></div>
      <span class="copyrightinfo">&copy; Copyright 2013 FounderMates</span>   
      <br />
      <span class="copyrightinfo">&nbsp;&nbsp;&nbsp;&nbsp;Product Managed by <a target="_blank" href="http://www.innovify.co.uk/" style="color:#FE8C3D">Innovify!</a></span>   
</footer>

<script type="text/javascript">
	$j(document).ready(function(){
			$j('table tr td').each(function(){
				if($j(this).html() == ''){
					$j(this).html('&nbsp;');
				}
			});	
		});
</script>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>##_SITENAME_## Beta</title>
<link href="<?php echo Yii::app()->params->base_url; ?>css/style.css" rel="stylesheet" type="text/css" />
<?php /*?><link href="<?php echo Yii::app()->params->base_url; ?>css/1141.css" rel="stylesheet" type="text/css" /><?php */?>
<link href="<?php echo Yii::app()->params->base_url; ?>css/validationEngine.jquery.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="<?php echo Yii::app()->params->base_url; ?>images/favicon.ico" />
<script src="<?php echo Yii::app()->params->base_url; ?>js/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url; ?>js/jquery.validationEngine-en.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url; ?>js/jquery.validationEngine.js" type="text/javascript"></script>
<?php /*?><script src="<?php echo Yii::app()->params->base_url; ?>js/css3-mediaqueries.js" type="text/javascript"></script><?php */?>

<script type="text/javascript">
var BASHPATH='<?php echo Yii::app()->params->base_url; ?>';
var $j = jQuery.noConflict();
  
$j(document).ready(function(){
	
	/*var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-37461852-1']);
  _gaq.push(['_trackPageview']);
  (function() {
varga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
	*/
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

function changeBG()
 {
	if($j("#password").val()=='')
	{
		$j("#password").css('background','#ffffff url(../images/##_PASSWORD_IMAGE_##) left center');
		$j("#password").css('background-repeat','no-repeat');
	}
 }
 
function trim(stringToTrim) {
	return stringToTrim.replace(/^\s+|\s+$/g,"");
}
function ltrim(stringToTrim) {
	return stringToTrim.replace(/^\s+/,"");
}
function rtrim(stringToTrim) {
	return stringToTrim.replace(/\s+$/,"");
}
function popitup(url) {
	newwindow=window.open(url,'name','height=500,width=850,scrollbars=yes,screenX=250,screenY=200,top=150');
	if (window.focus) {newwindow.focus()}
	return false;
} 



</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-37461852-1']);
  _gaq.push(['_setDomainName', 'foundermates.com']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript';
ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' :
'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
<?php
	
	if(!isset(Yii::app()->session['fmloginId'])) { 
	?>
<header> 
  <!-- The tab on top -->
  <div class="tab">
    <ul class="login">
      <li class="left">&nbsp;</li>
      <li>LogIn :</li>
      <li id="toggle"> <a id="open" class="open" href="<?php echo Yii::app()->params->base_path; ?>site/advisorlogin">Advisor</a> <span class="sep">|</span> <a id="open" class="open" href="<?php echo Yii::app()->params->base_path; ?>site/entlogin">Entrepreneur</a> </li>
      <li class="right">&nbsp;</li>
    </ul>
  </div>
  <!-- / top -->
  <figure id="navigation"> 
    <!-- Logo --> 
    
    <a href="<?php echo Yii::app()->params->base_path; ?>site">
    <div id="logo"> <img src="<?php echo Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url ;?>images/founder_mates_logo.png&h=100&w=400&q=72&zc=0" style=" padding-top:5px !important; position:absolute;" /> </div>
    </a> 
    
    <!-- / Logo --> 
    
    <!-- The nav on top -->
    <nav>
      <ul>
        <li><a href="<?php echo Yii::app()->params->base_path; ?>site" <?php if(Yii::app()->session['currentTab'] == 'Home'){  ?> class="active" <?php } ?>>Home</a></li>
        <li><a href="<?php echo Yii::app()->params->base_path; ?>site/howworks" <?php if(Yii::app()->session['currentTab'] == 'How it Works'){  ?> class="active" <?php } ?>>How it Works</a></li>
        <li><a href="<?php echo Yii::app()->params->base_path; ?>site/advisorfaq" <?php if(Yii::app()->session['currentTab'] == 'Advisor FAQ'){  ?> class="active" <?php } ?>>Advisor FAQ</a></li>
        <li><a href="<?php echo Yii::app()->params->base_path; ?>site/entfaq" <?php if(Yii::app()->session['currentTab'] == 'Entrepreneur FAQ'){  ?> class="active" <?php } ?>>Entrepreneur FAQ</a></li>
        <li><a href="http://blog.foundermates.com" <?php if(Yii::app()->session['currentTab'] == 'Contact Us'){  ?> class="active" <?php } ?>>BLOG</a></li>
      </ul>
    </nav>
  </figure>
  <div class="borderbottom"></div>
</header>
<?php }else { ?>
<header>
  <div class="admintoppanel" > <a href="<?php echo Yii::app()->params->base_path; ?>site"><span>
    <div id="logo"> <img src="<?php echo Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url ;?>images/founder_mates_logo.png&h=100&w=400&q=72&zc=0" style=" padding-top:5px !important; position:absolute;" /> </div>
    </span></a><font class="tagline"></font> </div>
  <div class="adminnav">
    <?php
		if(Yii::app()->session['currentTab'] == 'changepassword' || Yii::app()->session['currentTab'] == 'logout') {
			$style = "55px;";
		}
		else if(Yii::app()->session['currentTab'] == 'Advisor List' || Yii::app()->session['currentTab'] == 'Messages' || Yii::app()->session['currentTab'] == 'Profile' || Yii::app()->session['currentTab'] == 'Reviews')
		{
			$style = '16px;';
		}
		else
		{
			$style = '55px;';
		}
	?>
    <ul style="margin-top:<?php echo $style; ?>">
      <?php if(Yii::app()->session['userType'] == 1) {  ?>
      <li><a href="<?php echo Yii::app()->params->base_path; ?>entrepreneur/getAdvisorList"  <?php if(Yii::app()->session['currentTab'] == 'Advisor List'){  ?> class="active1" <?php } ?>>Advisor List</a></li>
      <?php } ?>
      <?php if(Yii::app()->session['userType'] == 1) {  ?>
      <li><a href="<?php echo Yii::app()->params->base_path; ?>entrepreneur/messages"  <?php if(Yii::app()->session['currentTab'] == 'Messages'){  ?> class="active1" <?php } ?>>FounderMail
        <?php if(isset(Yii::app()->session['unreadCount']) && Yii::app()->session['unreadCount'] != 0 ) { ?>
        <?php if(Yii::app()->session['current'] == 'Ent Messages' || Yii::app()->session['current'] == 'Messages') { ?>
        <div class="my-bubble" style="margin-top:22px !important;"><span><?php echo Yii::app()->session['unreadCount'];  ?></span></div>
        <?php }else { ?>
        <div class="my-bubble"><span><?php echo Yii::app()->session['unreadCount'];  ?></span></div>
        <?php } ?>
        <?php } Yii::app()->session['current'] = ''; ?>
        </a> </li>
      <?php } else { ?>
      <li><a href="<?php echo Yii::app()->params->base_path; ?>advisor/messages"  <?php if(Yii::app()->session['currentTab'] == 'Messages'){ $bool = true; ?> class="active1" <?php } ?>>FounderMail
        <?php if(isset(Yii::app()->session['unreadCount']) && Yii::app()->session['unreadCount'] != 0 ) { ?>
        <div class="my-bubble" <?php if(isset($bool) && $bool == true) {?> style="margin-top:22px;" <?php } ?>><span><?php echo Yii::app()->session['unreadCount'];  ?></span></div>
        <?php } ?>
        </a> </li>
      <?php } ?>
      <?php if(Yii::app()->session['userType'] == 1) {  ?>
      <li><a href="<?php echo Yii::app()->params->base_path; ?>entrepreneur/Index"  <?php if(Yii::app()->session['currentTab'] == 'Profile'){  ?> class="active1" <?php } ?>>Profile</a></li>
      <?php } else { ?>
      <li><a href="<?php echo Yii::app()->params->base_path; ?>advisor/showAdvisorProfile"  <?php if(Yii::app()->session['currentTab'] == 'Profile'){  ?> class="active1" <?php } ?>>Profile</a></li>
      <?php } ?>
      <?php if(Yii::app()->session['userType'] == 1) {  ?>
      <li><a href="<?php echo Yii::app()->params->base_path; ?>entrepreneur/review"  <?php if(Yii::app()->session['currentTab'] == 'Reviews'){  ?> class="active1" <?php } ?>>Reviews</a></li>
      <?php } else  { ?>
      <li><a href="<?php echo Yii::app()->params->base_path; ?>advisor/review"  <?php if(Yii::app()->session['currentTab'] == 'Reviews'){  ?> class="active1" <?php } ?>>Reviews</a></li>
      <?php } ?>
      <?php if(Yii::app()->session['userType'] == 1) {  ?>
      <li style="height: 80px;"><a href="#">Hi, <?php echo Yii::app()->session['fullname']; ?></font>
        <div class="triangle" style="top:63px;"></div>
        </a>
        <?php } else  { ?>
      <li style="height: 80px;"><a href="#">Hi, <?php echo Yii::app()->session['fullname']; ?></font>
        <div class="triangle triangleadvisor" style="top:63px;"></div>
        </a>
        <?php } ?>
        <div class="dropdownContain">
          <div class="dropOut">
            <?php if(Yii::app()->session['userType'] == 1) {  ?>
            <div class="triangleup" style=" top:60px important!;"></div>
            <?php }else{ ?>
            <div class="triangleup"></div>
            <?php } ?>
            <ul>
              <?php if(Yii::app()->session['userType'] == 1) {  ?>
              <li onclick="window.location.href='<?php echo Yii::app()->params->base_path; ?>entrepreneur/changePassword'" >Change Password</li>
              <?php }else{ ?>
              <li onclick="window.location.href='<?php echo Yii::app()->params->base_path; ?>advisor/changePassword'">Change Password</li>
              <?php } ?>
              <li onclick="window.location.href='<?php echo Yii::app()->params->base_path; ?>entrepreneur/logout'">Log Out</li>
            </ul>
          </div>
        </div>
      </li>
    </ul>
  </div>
  <div class="borderbottom" style="margin-top:6px;"></div>
</header>
<?php } ?>
<!--<div class="middle">
        <div class="clear"></div>
    </div>-->

<div class="clear"></div>
<div align="left">
  <?php //echo Yii::app()->user->setFlash('success', "adsfasdfasfsadf");?>
  <?php if(Yii::app()->user->hasFlash('success')): ?>
  <div id="msgbox" class="clearmsg"><?php echo Yii::app()->user->getFlash('success'); ?></div>
  <div class="clear"></div>
  <?php endif; ?>
  <?php if(Yii::app()->user->hasFlash('error')): ?>
  <div id="msgbox" class="errormsg"> <?php echo Yii::app()->user->getFlash('error'); ?></div>
  <?php endif; ?>
</div>
<div> <?php echo $content; ?> </div>
<!-- Footer Part content-->

</div>
<div class="clear"></div>
</div>
<footer>
  <div class="twitterfeed">
    <h1 class="twittericon"></h1>
    <span class="latestupdate" style="width:750px !important;">
    <marquee style=" color:#FFAD77;" direction="left"  >

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
    <div class="social-group"> <a href="http://www.facebook.com/Foundermates?fref=ts" rel="external me" target="_blank" class="knob"> <img src="<?php echo Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url ;?>images/facebook.png&h=40&w=40&q=60&zc=0" style="padding-top:-10px;"/></a> <a href="https://twitter.com/foundermates" rel="external me" target="_blank" class="knob"> <img src="<?php echo Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url ;?>images/twitter.png&h=40&w=40&q=60&zc=0" /></a> <a href="http://www.youtube.com/foundermates" rel="external me" target="_blank" class="knob"> <img src="<?php echo Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url ;?>images/youtube.png&h=40&w=40&q=60&zc=0" /> </a> <a href="http://www.linkedin.com/company/3041498" rel="external me" target="_blank" class="knob"> <img src="<?php echo Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url ;?>images/linkedin.png&h=40&w=40&q=60&zc=0" /> </a> <a href="https://plus.google.com/u/1/103636925596337563630" rel="external me" target="_blank" class="knob"> <img src="<?php echo Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url ;?>images/gplus.png&h=40&w=45&q=60&zc=0" /> </a> </div>
  </div>
  <!-- END WIDGETS -->
  <div class="navfooter"><a href="<?php echo Yii::app()->params->base_path;?>site/" style="color:#FFF;">Home</a> | <a href="<?php echo Yii::app()->params->base_path;?>site/howworks" style="color:#FFF;">How it Works</a> | <a  style="color:#FFF;" href="<?php echo Yii::app()->params->base_path; ?>site/about">About Us</a> | <a style="color:#FFF;" href="#">Work with Us</a> | <a style="color:#FFF;" href="<?php echo Yii::app()->params->base_path; ?>site/tos">Terms/Privacy</a> | <a style="color:#FFF;" href="<?php echo Yii::app()->params->base_path; ?>site/contact">Contact Us</a></div>
  <span class="copyrightinfo">&copy; Copyright 2013 FounderMates</span> <br />
  <span class="copyrightinfo">&nbsp;&nbsp;&nbsp;&nbsp;Product Managed by <a target="_blank" href="http://www.innovify.co.uk/" style="color:#FE8C3D">Innovify!</a></span> </footer>
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
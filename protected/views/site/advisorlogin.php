<script src="<?php echo Yii::app()->params->base_url; ?>js/jquery-1.8.2.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->params->base_url;?>css/jquery.fancybox.css">
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url;?>js/jquery.fancybox.js?v=2.0.6">
</script>
<script type="text/javascript">
function validateEmail()
{
	var email = $j("#email").val();
	
	if(email == "")
	{
		$j("#email").css("border-color","red");
		return false;
	}
	return true;
}

</script>		 
         <div class="content">
	 <h2>Log In</h2>
     
     <div class="bordertop">
     <hr class="bluethickborder" />
     <hr class="thinborder" />
	</div>
    <font class="advisorloginheading">Advisors</font>
    <figure class="signuparea">
    	<center><div class="advisorlogin">
        	
            <form id="login" action="<?php echo Yii::app()->params->base_path;?>site/advisorlogin" method="post">
                <fieldset>
                	<label style=" padding-left:25px !important;">Email <font class="requiredblue">*</font></label>                    
                     <input type="text" name="email" value="<?php if(isset($_COOKIE['email'])) { echo $_COOKIE['email']; } else {  echo "username@email.com"; }?>" onBlur="if(this.value=='') this.value='username@email.com'" onFocus="if(this.value =='username@email.com' ) this.value=''" />                    
                    <label style=" padding-left:25px !important;">Password <font class="requiredblue">*</font> <a href="#inline" class="forgotpassblue">(Forgotten Password)</a></label>                   
                    <input type="password" name="password" value="<?php if(isset($_COOKIE['password'])) { echo $_COOKIE['password']; } else {  echo "username@email.com"; }?>" onBlur="if(this.value=='') this.value='Password'" onFocus="if(this.value =='Password' ) this.value=''" />
                    <input type="hidden" name="userType" value="2" id="userType"  />
					<font class="remember">&nbsp;&nbsp; &nbsp;&nbsp;Remember me</font>
                    <input type="checkbox" name="remember" <?php if(isset($_COOKIE['email'])) { ?> checked="checked" <?php } ?> id="remember"  style="margin-left:20px; "  /> 
                 <input type="submit" class="btnblue btnloginmargin" name="submitLogin" id="submitLogin" value="LogIn" />
                    
                </fieldset>
            </form>
            
        </div></center>
       <!-- <div class="entlogin">
        	<font class="entloginheading">Entrepreneur</font>            
			<a href="#" class="signuporange">Log In</a>
        </div>-->
    </figure>
</div>

<div style="padding-left:210px;height:100px;">
 <font class="titleheading">New to <font class="titleblue">FounderMates </font>?</font>
</div>
<div style="padding-left:530px;padding-bottom:70px;">
<input type="submit" class="btnblue" name="submitLogin"  onclick="window.location.href='<?php  echo Yii::app()->params->base_path; ?>site/registerAdvisorFirst'" id="submitLogin" value="Register Now" />
</div>

<!--<figure>
 <font class="titleheading">New to <font class="titleblue">FounderMates </font>?</font>

 <input type="submit" class="btnblue" name="submitLogin" style="margin-left:700px; margin-top:-150px;" onclick="window.location.href='<?php // echo Yii::app()->params->base_path; ?>site/registerAdvisorFirst'" id="submitLogin" value="Register Now" />
</figure>-->
<!-- hidden inline form -->
<div id="inline">
	<h2>Forgot Your Password ?</h2>
    <span>Enter your <strong>email address</strong> and an <strong>email</strong> will be sent with reset instructions</span>
	<form id="contact" name="contact" onsubmit="return validateEmail();" action="<?php echo Yii::app()->params->base_path;?>site/forgotPassword" method="post">
		<label for="email">Your E-mail</label>
		<input type="email" id="email" name="email" class="txt" style=" min-height:20px !important;">
		
		<!--<button id="send" class="btnblue" style="margin-left:85px;">Send E-mail</button>-->
         <input type="submit" class="btnblue" name="submitforgotPassword" style="margin-left:85px;" id="subForgot" value="Send Email"  />
	</form>
</div>

<!-- basic fancybox setup -->
<script type="text/javascript">
	$(document).ready(function() {
		$(".forgotpassblue").fancybox();
		//$("#contact").submit(function() { return false; });

		
		/*$("#send").on("click", function(){
			var emailval  = $("#email").val();
			var msgval    = $("#msg").val();
			var msglen    = msgval.length;
			var mailvalid = validateEmail(emailval);
			
			if(mailvalid == false) {
				$("#email").addClass("error");
			}
			else if(mailvalid == true){
				$("#email").removeClass("error");
			}
			
			if(msglen < 4) {
				$("#msg").addClass("error");
			}
			else if(msglen >= 4){
				$("#msg").removeClass("error");
			}
			
			if(mailvalid == true && msglen >= 4) {
				// if both validate we attempt to send the e-mail
				// first we hide the submit btn so the user doesnt click twice
				$("#send").replaceWith("<em>sending...</em>");
				
				$.ajax({
					type: 'POST',
					url: 'sendmessage.php',
					data: $("#contact").serialize(),
					success: function(data) {
						if(data == "true") {
							$("#contact").fadeOut("fast", function(){
								$(this).before("<p><strong>Success! Your feedback has been sent, thanks :)</strong></p>");
								setTimeout("$.fancybox.close()", 1000);
							});
						}
					}
				});}*/
			
		/*});*/
	});
</script>

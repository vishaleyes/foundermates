<script src="<?php echo Yii::app()->params->base_url; ?>js/jquery-1.8.2.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->params->base_url;?>css/jquery.fancybox.css">
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url;?>js/jquery.fancybox.js?v=2.0.6">
</script>
<section class="content">	
	 <h2>Log In</h2>
     
     <div class="bordertop">
     <hr class="orangethickborder" />
     <hr class="thinborder" />
	</div>
    <font class="entloginheading">Entrepreneur</font>
    <figure class="signuparea">
    	<center><div class="advisorlogin">
        	
			
            <form id="login" action="<?php echo Yii::app()->params->base_path;?>site/entlogin" method="post">
                <fieldset>
                	<label><font class="requiredorange">*</font>Email</label>                    
                     <input type="text" name="email" value="username@email.com" onBlur="if(this.value=='') this.value='username@email.com'" onFocus="if(this.value =='username@email.com' ) this.value=''" />                    
                    <label><font class="requiredorange">*</font>Password <a href="#inline" class="forgotpassblue">(Forgotten Password)</a></label>                    
                    <input type="password" name="password" value="Password" onBlur="if(this.value=='') this.value='Password'" onFocus="if(this.value =='Password' ) this.value=''" />
					<font class="remember">Remember me</font>
                    <input type="checkbox" /> 
                   <?php /*?><a href="#" class="loginorange">Log In</a><?php */?>
                   <input type="submit" name="submitLogin" id="submitLogin" value="LogIn" />
                </fieldset>
            </form>
        </div></center>
       <!-- <div class="entlogin">
        	<font class="entloginheading">Entrepreneur</font>            
			<a href="#" class="signuporange">Log In</a>
        </div>-->
    </figure>
</section>

<figure>
 <font class="titleheading">New to <font class="titleorange">FounderMates</font>..??</font><a href="<?php echo Yii::app()->params->base_path; ?>site/registerEnterpreneur" class="registerorange">Register Now</a>
</figure>

<!-- hidden inline form -->
<div id="inline">
	<h2>Forgot Your Password..??</h2>
    <span>Enter your <strong>email address</strong> and an <strong>email</strong> will be sent with reset instructions</span>
	<form id="contact" name="contact" action="<?php echo Yii::app()->params->base_path;?>site/forgotPassword" method="post">
		<label for="email">Your E-mail</label>
		<input type="email" id="email" name="email" class="txt">
		
		<?php /*?><button id="send">Send E-mail</button><?php */?>
        <input type="submit" name="submitforgotPassword" id="subForgot" value="Send Email"  />
	</form>
</div>

<!-- basic fancybox setup -->
<script type="text/javascript">
	$(document).ready(function() {
		$(".forgotpassblue").fancybox();
		

		
		$("#send").on("click", function(){
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
				});
			}
		});
	});
</script>


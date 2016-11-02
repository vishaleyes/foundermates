<script type="text/javascript">
var $ = jQuery.noConflict();

	$(document).ready(function(){
	   // binds form submission and fields to the validation engine
	   $("#registeration").validationEngine();
	  });
	  
	  function validateReferral()
	  {
			var value = $("#referral option:selected").val();
			if(value == 1)
			{
				 $('#referralId').attr( "class","validate[required] text-input");	
			}	
			else if(value == 0)
			{
				$('#referralId').attr( "class","");	
			}	  
	  }
	  
	  function validateMendetory()
	  {
			var value = $("#mentorship_experience option:selected").val();
			if(value == 1)
			{
				 $('#mentorship_details').attr( "class","validate[required] text-input");	
			}	
			else if(value == 0)
			{
				$('#mentorship_details').attr( "class","");	
			}	  
	  }
	  
	  function validateStartupExperience()
	  {
			var value = $("#startup_experience option:selected").val();
			if(value == 1)
			{
				 $('#startup_roles').attr( "class","validate[required] text-input");	
			}	
			else if(value == 0)
			{
				$('#startup_roles').attr( "class","");	
			}	  
	  }
	  
</script>
<section class="content">	
	 <h2>Register</h2>
     
     <div class="bordertop">
     <hr class="orangethickborder" />
     <hr class="thinborder" />
	</div>
    <div class="asheading">
    <font class="entloginheading">Entrepreneur</font>
    </div>
    <p>To sign up, click on the LinkedIn icon below</p>
</section>
<div class="optionalsignup" style="margin-top: -20px;">
<span></span>
    <figure class="socialsignup">
    <a href="<?php echo Yii::app()->params->base_path;?>site/registerWithLinkedin/type/1">
    <img src="<?php echo Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url ;?>images/linkedin-logo.png&h=75&w=75&q=72&zc=0" style="margin-right:15px;" /></a></figure>
    <p>
	Why LinkedIn signup? Refer to <a href="<?php echo Yii::app()->params->base_path;?>site/entfaq" style="color:#10BEF8;">ENTREPRENEUR FAQ</a>
</p>
</div>

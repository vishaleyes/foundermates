<script src="<?php echo Yii::app()->params->base_url;?>js/jquery.alerts.js" type="text/javascript"></script>
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->params->base_url; ?>css/jquery.alerts.css" />
<script>
function validateAll()
{
	
	var name = $j("#name").val();
	var email = $j("#email").val();
	var comment = $j("#comment").val();
	
	
	if(name == '')
	{
		//jAlert("Please enter email address");
		$j("#errorname").text("Please enter name");
		$j("#name").css('background-color','#FCBAAB');
		$j("#name").css('border-color','red');
		return false;
		
	}
	else
	{
		$j("#errorname").text("");
		$j("#name").css('background-color','#D0FFC4');
		$j("#name").css('border-color','green');
	}
	
	if(email == '')
	{
		//jAlert("Please enter email address");
		$j("#erroremail").text("Please enter email address");
		$j("#email").css('background-color','#FCBAAB');
		$j("#email").css('border-color','red');
		return false;
	}
	else
	{
/*--------------------------------check email validation -----------------------------------------*/	
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		var address = email ;
		if(reg.test(address)==false)
		{
			$j("#erroremail").text("Please enter valid email address");
			$j("#email").css('background-color','#FCBAAB');
			$j("#email").css('border-color','red');
			return false;
		}
		else
		{
			$j("#erroremail").text("");
			$j("#email").css('background-color','#D0FFC4');
			$j("#email").css('border-color','green');
		}
/*--------------------------------check email validation -----------------------------------------*/
	}
	if(comment == '')
	{
		//jAlert("Please enter email address");
		$j("#errorcomment").text("Please enter comment");
		$j("#comment").css('background-color','#FCBAAB');
		$j("#comment").css('border-color','red');
		return false;
	}
	else
	{
		$j("#errorcomment").text("");
		$j("#comment").css('background-color','#D0FFC4');
		$j("#comment").css('border-color','#22AA00');
	}
}
</script>



<section class="content">	
	 <h2>Contact Us</h2>
     
     <div class="bordertop">
     <hr class="bluethickborder" />
     <hr class="thinborder" />
	</div>
    
    <figure class="signuparea">
    	<center><div class="" style="text-align:justify;color:#3C3C3C;margin-top:55px; margin-left:290px; margin-right:200px;" align="center">
        	
       
			<?php echo CHtml::beginForm(Yii::app()->params->base_path.'site/contact','post',array('id' => 'contactusform','name' => 'contactusform','onsubmit' => 'return validateAll();')) ?>
                <div>
                    <div class="field">
                        <label>##_CONTACT_NAME_##<span>*</span><span id="nameerror"></span></label>
                        <input type="text" name="name" id="name"  value="<?php if(isset($name)) {echo $name; } ?>" onkeyup="validateAll()" onblur="validateAll('name',this.value);" onfocus="this.style.color='black';" /><br /><span id="errorname" class="errorvalidation"></span>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="field">
                        <label>##_CONTACT_EMAIL_##<span>*</span> <span id="emailerror"></span></label>
                            <input type="email" maxlength="256" name="email" id="email"  value="<?php  if(isset($email)) {echo $email; }  ?>"  onkeyup="validateAll()"  onblur="validateAll()" onfocus="this.style.color='black';" /><br /><span id="erroremail" class="errorvalidation"></span>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="field">
                        <label>##_CONTACT_COMMENT_##<span>*</span> <span id="commenterror"></span></label>
                        <textarea  name="comment" id="comment"  onblur="validateAll()" cols="20" class="txt" rows="2" onfocus="this.style.color='black';" onkeyup="validateAll()" style="padding-left:5px !important; margin-left:0px !important; width:294px !important;" ><?php if(isset($comment)) {echo $comment;} ?></textarea><br /><br /><span id="errorcomment" class="errorvalidation"></span>
                    </div>  
                    <div class="clear"></div>
                    
                  
                    <div class="clear"></div>
                    
                    <div class="fieldBtn">
                        <input type="submit" style="margin-bottom:15px; margin-left:-90px;"  name="FormSubmit" id="FormSubmit" class="btnblue"  value="##_BTN_SUBMIT_##" />
                    </div>
                </div>
            <?php echo CHtml::endForm(); ?> 
        </div>
            </center>
       
    </figure>
</section>
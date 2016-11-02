<section class="admincontent">	
	 <h2>Change Password</h2>
     
     <div class="bordertop">
     <hr class="bluethickborder" />
     <hr class="thinborder" />
	</div>
    <figure class="signuparea">
    	<center><div class="changepassform">
        	
			
            <form method="post" id="login" action="<?php echo Yii::app()->params->base_path;?>entrepreneur/changePassword" style="margin-top:100px;">
                <fieldset>
                	<label>Old Password <font class="requiredorange">*</font> </label>                    
                     <input type="password" name="oldpassword" value="" />                    
                    <label>New Password <font class="requiredorange">*</font> </label>                   
                    <input type="password" name="newpassword" value=""/>
                    
                    <label>Confirm New Password <font class="requiredorange">*</font> </label>                   
                    <input type="password" name="confirmpassword" value="" />
					 
                   <input type="submit" name="submit" style="margin-left:35px;" class="btnblue btncpmargin" value="Change Password" />
                </fieldset>
            </form>
        </div></center>
       <!-- <div class="entlogin">
        	<font class="entloginheading">Entrepreneurs</font>            
			<a href="#" class="signuporange">Log In</a>
        </div>-->
    </figure>
</section>
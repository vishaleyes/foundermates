<section class="content">	
	 <h2></h2>
     
     <div class="" style="margin-top:20px;">
	</div>
    <font class="advisorloginheading" style="margin-left:-40px; margin-top:70px;">Administrator Login</font>
    <figure class="signuparea">
    	<center><div class="advisorlogin adminloginmargin">
        	
            <form id="login" action="<?php echo Yii::app()->params->base_path;?>admin/adminLogin" method="post">
                <fieldset>
                	<label>Email <font class="requiredorange">*</font></label>                    
                     <input type="text" name="email_admin" value="username@email.com" onBlur="if(this.value=='') 

this.value='username@email.com'" onFocus="if(this.value =='username@email.com' ) this.value=''" />                    
                    <label>Password <font class="requiredorange">*</font></label>                    
                    <input type="password" name="password_admin" value="Password" onBlur="if(this.value=='') 

this.value='Password'" onFocus="if(this.value =='Password' ) this.value=''" />
                    <input type="hidden" name="userType" value="1" id="userType"  />
					
                
                   <input type="text" name="verifyCode" id="verifyCode" value="" style="width:80px; margin-left:-20px;" />	
                   <?php $this->widget('CCaptcha'); //echo Chtml::textField('verifyCode',''); ?>
                  
                   <?php /*?><a href="#" class="loginorange">Log In</a><?php */?>
                   <input type="submit" name="submit_login" class="btnblue btnloginmargin" id="submitLogin" value="LogIn" 

/>
                   
                </fieldset>
            </form>
            
        </div></center>
       <!-- <div class="entlogin">
        	<font class="entloginheading">Entrepreneur</font>            
			<a href="#" class="signuporange">Log In</a>
        </div>-->
    </figure>
</section>
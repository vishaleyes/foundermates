<script type="text/javascript">
var $ = jQuery.noConflict();

	$(document).ready(function(){
	   // binds form submission and fields to the validation engine
	   $("#registeration").validationEngine();
	  });
	  
</script>
<section class="content">	
	 <h2>Register</h2>
     
     <div class="bordertop">
     <hr class="orangethickborder" />
     <hr class="thinborder" />
	</div>
    <div class="asheading">
    <font class="asent">as</font>
    <font class="entloginheading">Entrepreneur</font>
    </div>
    <figure class="signuparea">
    	<div class="entsignupform">
               <form id="registeration" name="registeration" method="post" enctype="multipart/form-data" action="<?php echo Yii::app()->params->base_path ; ?>site/registerEntStep2">
                <fieldset>
                
                	<label>First Name <font class="requiredorange">*</font></label>                    
                  <input type="text" class="validate[required] text-input" value="<?php if(isset($firstName)) { echo $firstName ; } ?>"  id="firstName" name="firstName" />                    
                    <label>Email <font class="requiredorange">*</font></label>                   
                    <input type="text" value="<?php if(isset($email)) { echo $email ; } ?>" class="validate[required,custom[email]] text-input"  id="email" name="email" />
                     <label>Photo <font class="requiredorange">*</font></label>
					 <input type="file"  class="filestyle text-input" id="userImage" name="userImage" />
                     <label style="color: #838383;">Why do I have to upload a photo? <a class="ttphoto"><img src="images/photomsg.png" width="30" height="25" 
                     style="position: absolute;" /> <i>We want to simulate a real world <br />meet up for better experience for<br />both Entrepreneurs and Advisors. Your geniune original photo helps build trust with the advisor</i></a><br /><?php if(isset($avatarlink)) { ?><span><img src="<?php if(isset($avatarlink)) { echo $avatarlink; } ?>" style="margin-left:0px;" width="50" height="50" name="image" id="image" /></span><?php } ?></label>
                </fieldset>
                <fieldset class="rightsideform">
                
                	<label>Last Name <font class="requiredorange">*</font></label>                    
                  <input type="text" value="<?php if(isset($lastName)) { echo $lastName ; } ?>" class="validate[required] text-input"   id="lastName" name="lastName"  />                    
                   
                    <label>Country <font class="requiredorange">*</font> </label>                   
                    <select id="country" name="country"  style="width:329px;" class="validate[required]" >
                    	<option value="">-- Please Select Country --</option>
                        <option value="India" <?php if(isset($country) && $country == "India") { ?> selected <?php } ?>  >India</option>
                        <option value="United Kingdom" <?php if(isset($country) && $country == "United Kingdom") { ?>  selected  <?php } ?> >United Kingdom</option>
                    </select>         
                    <label>City <font class="requiredorange">*</font> </label>
                    <input type="text" value="<?php if(isset($city)) { echo $city ; } ?>" class="validate[required] text-input"  id="city" name="city" />
                    <?php if(isset($avatarlink)) { ?>
                      <input type="hidden" name="avatarlink" value="<?php echo $avatarlink; ?>">  
                      <?php } ?>   
                       <label>Industry <font class="requiredblue">*</font> </label>                   
                        <select id="industry" name="industry" style="width:329px;" class="validate[required]" >
                            <option value="">Choose industry...</option>
                            <?php 
							$industryObj = new Industry();
							$industryData = $industryObj->getIndustryList();
							foreach ($industryData as $row ) { 
							?>
                            <option value="<?php echo $row['industry']; ?>"  <?php if(isset($industry) && $industry == $row['industry_name'] ) { ?> selected="selected" <?php } ?>><?php echo $row['industry_name']; ?></option>
                            <?php } ?>
                        </select> 
                    <input type="hidden" name="userType" value="1"> 
                    <input type="hidden" name="headline" value="<?php if(isset($headline)) {echo $headline;} ?>">  
                   <input type="hidden" name="linkedinLink" value="<?php if(isset($linkedinLink)) { echo $linkedinLink; } ?>">
                </fieldset>
              <input type="submit" name="submitEnt" style="margin-top:80px;" class="btnorange btnsignupmargin" value="Continue">
       		</form>
            
        </div>
     
    </figure>
</section>
<div class="optionalsignup" style="margin: 60px auto;">
</div>
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>-->
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
<script type="text/javascript">

function checkStageLimit()
{
	 var items = $('#stage option').parent().val();
        if (items.length > 4) {
                    alert("You can only select 4 skills at a time");
           			return false;
        }
}


$(document).ready(function() 
{
    $('#stage option').click(function() 
    {
        var items = $(this).parent().val();
        if (items.length > 4) {
                      alert("You can only select 4 skills at a time");
           $(this).removeAttr("selected");
        }
    });
	
	
   });
</script>
<section class="content">	
	 <h2>Register</h2>
     
     <div class="bordertop">
     <hr class="bluethickborder" />
     <hr class="thinborder" />
	</div>
    <div class="asheading">
    <font class="as">as</font>
    <font class="advisorsignupheading">Advisor</font>
    </div>
    <?php 
    $industryObj = new Industry();
	$industryData = $industryObj->getIndustryList();
	
	$expertiseObj = new ExpertiseAreas();
	$expertiseData = $expertiseObj->getExpertiseList();
    ?>
	<figure class="signuparea">
    	<div class="entsignupform">
			
            <form id="registeration" name="registeration" method="post" enctype="multipart/form-data" action="<?php echo Yii::app()->params->base_path ; ?>site/registerAdvisorStep2" onsubmit="return checkStageLimit();">
                <fieldset>
                
                	<label>First Name <font class="requiredblue">*</font></label>                    
                  <input type="text" class="validate[required] text-input" value="<?php if(isset($firstName)) { echo $firstName ; } ?>"  id="firstName" name="firstName" />                    
                    <label>Email <font class="requiredblue">*</font> </label>                   
                    <input type="text" value="<?php if(isset($email)) { echo $email ; } ?>" class="validate[required,custom[email]] text-input"  id="email" name="email"  />
                     <label>Country <font class="requiredblue">*</font> </label>                   
                     <select id="country" name="country" style="width:329px;"  class="validate[required]" >
                    	<option value="">-- Please Select Country --</option>
                        <option value="India" <?php if(isset($country) && $country == "India") { ?> selected="selected" <?php } ?>  >India</option>
                        <option value="United Kingdom" <?php if(isset($country) && $country == "United Kingdom") { ?> selected="selected" <?php } ?> >United Kingdom</option>
                    </select>          
                    <label>City <font class="requiredblue">*</font></label>                   
                    <input type="text" value="<?php if(isset($city)) { echo $city ; } ?>" class="validate[required] text-input"  id="city" name="city" />
                    
                    <label>Skills <font class="requiredblue">(Max 4)*</font></label>
                    <select name="area_of_expertise[]" id="stage"   multiple="multiple" style="height:135px;" class="validate[required]" size="4" >
                    	<option value="">Choose skills...</option>
                        <?php 
						foreach ($expertiseData as $row ) { ?>
                        
                       <?php  if(isset($area_of_expertise) && in_array($row['area_of_expertise'],  $area_of_expertise))
                        {
					?>
							<option value="<?php echo $row['area_of_expertise']; ?>" selected="selected"><?php echo $row['area_of_expertise']; ?></option>
					<?php }else { ?>
                    <option value="<?php echo $row['area_of_expertise']; ?>"  <?php if(isset($area_of_expertise) && $area_of_expertise == $row['area_of_expertise'] ) { ?> selected="selected" <?php } ?>><?php echo $row['area_of_expertise']; ?></option>
                    <?php } ?>
                        <?php /*?><option value="<?php echo $row['area_of_expertise']; ?>"  <?php if(isset($area_of_expertise) && $area_of_expertise == $row['area_of_expertise'] ) { ?> selected="selected" <?php } ?>><?php echo $row['area_of_expertise']; ?></option><?php */?>
						<?php } ?>
                    
                    </select>
                  <br /> <div style="margin-left:42px !important; float:left;"> 
                  Expert  <a class="ttphoto"><img src="images/photomsg.png" width="30" height="25" style="position: relative; top:7px !important;" /> <i style=" left:26% !important; top:70% !important; text-align:justify">You are an Expert if you have worked in a functional skill(s) or a domain for 5 years or above  and demonstrated your expertise.<br/> You may be an entrepreneur, a professional or a specialist.</i></a>
                  <input type="radio" name="advisorType"  checked="checked"  value="0" />
                  Mentor  <a class="ttphoto"><img src="images/photomsg.png" width="30" height="25" style="position: relative; top:7px !important;" /> <i style=" left:52% !important; top:70% !important; text-align:justify ">You are a Mentor if you have been an entrepreneur or are one currently.<br/> Your entrepreneurial journey must be at least 5 years old so you would have experienced the business cycle at length.<br/> You must have experience in mentoring startups/businesses.</i></a>
                  <input type="radio" name="advisorType" value="1" />
                  
                  </div>
                       
                </fieldset>
                <fieldset class="rightsideform">
                
                	<label>Last Name <font class="requiredblue">*</font></label>                    
                  <input type="text" value="<?php if(isset($lastName)) { echo $lastName ; } ?>" class="validate[required] text-input"   id="lastName" name="lastName"  />                    
                    <label>Password <font class="requiredblue">*</font></label>                   
                    <input type="password"  class="validate[required] text-input"  id="password" name="password" />  
                     <label>Organisation <font class="requiredblue">*</font></label>                   
                    <input type="text" value="<?php if(isset($organisation)) { echo $organisation ; } ?>"  class="validate[required] text-input"  id="organisation" name="organisation" />
                     <label> Current work status/work title/Position Held <font class="requiredblue">*</font></label>                   
                    <input type="text" value="<?php if(isset($work_status)) { echo $work_status ; } ?>"  class="validate[required] text-input"  id="work_status" name="work_status" />
                      <label>Industry <font class="requiredblue">*</font> </label>                   
                    <select id="industry" name="industry" style="width:329px;"  class="validate[required]" >
                    	<option value="">Choose industry...</option>
                        <?php foreach ($industryData as $row ) { ?>
                        <option value="<?php echo $row['industry']; ?>"  <?php if(isset($industry) && $industry == $row['industry_name'] ) { ?> selected="selected" <?php } ?>><?php echo $row['industry_name']; ?></option>
						<?php } ?>
                    </select> 
                    
                    <label>Photo<font class="requiredblue">&nbsp;(jpg,jpeg,png)&nbsp; *</font> </label>
                     
                     <input type="file" class="filestyle text-input" value="<?php if(isset($avatarlink))  {echo $avatarlink; } else if(isset($avatar)) { echo $avatar; } ?>" id="userImage" name="userImage" style="margin-left:0px ;"  >
                     <label style="color: #838383;">Why do I have to upload a photo? <a class="ttphoto"><img src="images/photomsg.png" width="30" height="25" style="position: absolute;" /> <i>We want to simulate a real world <br />meet up for better experience for<br />both Entrepreneurs and Advisors. Your geniune original photo helps build trust with the entrepreneurs</i></a><br /><?php  if(isset($avatarlink)) { ?><img src="<?php if(isset($avatarlink)) { echo $avatarlink; } ?>" style="margin-left:0px;" width="50" height="50" name="image" id="image" /><?php } ?>
                         </label>
                    
                     <?php /*?><label>Previous Mentorship Expereince <font class="requiredblue">*</font> </label>
                     <select id="mentorship_experience" name="mentorship_experience"  class="validate[required]" onblur="validateMendetory();" >
                    	<option value="">-- Please Select --</option>
                        <option value="0" <?php if(isset($startup_experience) && $startup_experience == "0") { echo "selected" ; } ?>  >No</option>
                        <option value="1" <?php if(isset($startup_experience) && $startup_experience == "1") { echo "selected" ; } ?>  >Yes</option>
                    </select>  
                    <label>If "Yes", Details of Mentorship <font class="requiredblue">*</font> </label>                   
                    <input type="text" value="<?php if(isset($mentorship_details)) { echo $mentorship_details ; } ?>"   id="mentorship_details" name="mentorship_details" /> <?php */?>
                    
                   <?php /*?> <label>Were you referred by an advisor on Foundermates?<font class="requiredblue">*</font></label>
                     <select id="referral" name="referral"  class="validate[required]" onblur="validateReferral();" >
                    	<option value="">-- Please Select --</option>
                        <option  value="0" <?php if(isset($startup_experience) && $startup_experience == "0") { echo "selected" ; } ?>  >No</option>
                        <option  value="1" <?php if(isset($startup_experience) && $startup_experience == "1") { echo "selected" ; } ?>  >Yes</option>
                    </select>  
                    <label>If "Yes" , REFERRL ID <font class="requiredblue">*</font> <a class="ttphoto margintooltip"><img src="images/photomsg.png" width="30" height="25" 
                     style="position: absolute;" /> <i>We want to simulate a real world <br />meet up for better experience for<br />both Entrepreneurs and Advisors. Your geniune original photo helps build trust with the advisor</i></a></label>                   
                    <input type="text"  value="<?php if(isset($referralId)) { echo $referralId ; } ?>"   id="referralId" name="referralId" /> <?php */?>
                </fieldset>
                <input type="hidden" name="userType" value="2">
                  <input type="hidden" name="headline" value="<?php if(isset($headline)) { echo $headline; } ?>"> 
                <input type="hidden" name="linkedinLink" value="<?php if(isset($linkedinLink)) { echo $linkedinLink; } ?>">
                <input type="hidden" name="avatarlink" value="<?php if(isset($avatarlink)) { echo $avatarlink; } ?>">
               <br /></br> 
              <input type="submit" name="submitAdvisor" style="margin-top:80px;" class="btnblue btnsignupmargin" value="Continue">
            </form>
        </div>
     
    </figure>
</section>

<div class="optionalsignup" style="margin: 185px auto;">
	
</div>
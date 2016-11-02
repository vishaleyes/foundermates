<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>-->
<script type="text/javascript">
var $j = jQuery.noConflict();

	$j(document).ready(function(){
	   // binds form submission and fields to the validation engine
	   $j("#registeration").validationEngine();
	  });
	  
	  function setOtherDiv()
	  {
			var value = $j("#hearabout option:selected").val();
			if(value == "Referred by an advisor on FounderMates")
			{
				 $j('#otherDiv').html('<label><font class="requiredblue">*</font>Advisor Name</label><input type="text" name="referralId" id="referralId" value="" class="validate[required] text-input"  />');	
			}	
			else if(value == "Networking event")
			{
				$j('#otherDiv').html('<label><font class="requiredblue">*</font>Event Name</label><input type="text" name="referralId" id="referralId" value="" class="validate[required] text-input"  />');	
			}
			else if(value == "Others")
			{
				$j('#otherDiv').html('<label><font class="requiredblue">*</font>Others</label><input type="text" name="referralId" id="referralId" value="" class="validate[required] text-input"  />');	
			}
			else
			{
				$j('#otherDiv').html('');
			}	  
	  }
	  
</script>
<script>
      function countCharOne(val) {
        var len = val.value.length;
		
        if (len >= 111) {
          val.value = val.value.substring(0, 110);
	 } else {
		  $j('#charNumOne').text(110 - len );
        }
      };
	  
	  function countChar(val) {
        var len = val.value.length;
		
        if (len >= 251) {
          val.value = val.value.substring(0, 250);
	 } else {
		  $j('#charNum').text(250 - len );
        }
      };
	  
	function isNumberKey(evt)
	{
	if(evt.keyCode == 9)
	{
	
	}
	else
	{
	var charCode = (evt.which) ? evt.which : event.keyCode 
	if (charCode > 31 && (charCode < 48 || charCode > 57))
	return false;
	}
	return true;
	}
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
    <figure class="signuparea">
    	<div class="entsignupform">
			<?php 
				$industryObj = new Industry();
				$industryData = $industryObj->getIndustryList();
			?>
            <form  id="registeration" name="registeration" method="post" enctype="multipart/form-data" action="<?php echo Yii::app()->params->base_path ; ?>site/FinalRegistrationForAdvisor">
                <fieldset>
                
                	<label>Phone Number <font class="requiredblue">*</font> &nbsp;&nbsp;<a  style="position:absolute !important;" class="ttphoto"><img src="images/photomsg.png" width="30" height="25" 
                     style="position: relative;" /> <i style="margin-bottom:-40px !important;">We won't share your number. It is for <br />FounderMates to contact you in case <br />we need to understand your interests more.</i></a></label>                    
                  <input type="text"  name="phone" id="phone" class="validate[required,custom[integer]] text-input" value="<?php if(isset($phone)) { echo $phone; }?>" maxlength="15" onkeypress="return isNumberKey(event);" />                    
                     <label>What kind of entrepreneurs can connect to you? <font class="requiredblue">*</font> </label>                   
                    <select id="ent_industry" name="ent_industry[]" class="validate[required]" multiple="multiple" >
                    	<option value="">Choose industry...</option>
                        <?php foreach ($industryData as $row ) { ?>
                        
                         <?php  if(isset($ent_industry) && in_array($row['industry'],  $ent_industry))
                        {
					?>
							<option value="<?php echo $row['industry']; ?>" selected="selected"><?php echo $row['industry_name']; ?></option>
					<?php }else { ?>
                        <option value="<?php echo $row['industry']; ?>"  <?php if(isset($industry) && $industry == $row['industry'] ) { echo "selected" ; } ?>><?php echo $row['industry_name']; ?></option>
                        <?php } ?>
						<?php } ?>
                    </select>          
                    <label>What stage entrepreneur are you interested in advising? <font class="requiredblue">*</font> </label>                   
                     <select name="stage[]" id="stage"  class="validate[required]"   multiple="multiple" >
                    	<option value="">
                        	-- Please Select --
                        </option>
                        <option value="1">Idea</option>
                        <option value="2">Prototype</option>
                        <option value="3">Pre-revenue</option>
                        <option value="4">Revenue</option>
                        <option value="5">Growth</option>
                        <option value="6">Established</option>
                    </select> 
                        
                    <label>I can help you with (<span id="charNum" style=" color:#F60; font-weight:bold;">250</span> characters) <font class="requiredblue">*</font> &nbsp;&nbsp;<a  style="position:absolute !important;" class="ttphoto" ><img src="images/photomsg.png" width="30" height="25" style="position: relative;" /> <i style=" margin-bottom:-50px !important;">Mention specific areas where can I provide advice to entrepreneurs. Examples include starting up, product/market fit, raising investment, business model etc.</i></a>&nbsp;</label>
                      <textarea  id="help"  name="help" onkeyup="countChar(this)" class="validate[required] txt" style="font-family: arial;
    margin-left: -38px;
    min-height: 150px;
    padding-left: 0;
    padding-right: 0;
    padding-top: 0;
    width: 320px !important;"><?php if(isset($help)) { echo $help; }?></textarea> 
                     
                 
                   
                    </fieldset>
                <fieldset class="rightsideform">
                	<label>Do you run your own consultancy/advisory business for SMEs/startups? <font class="requiredblue">*</font><!--<a class="ttphoto"><img src="images/photomsg.png" width="30" height="25" style="position: relative; top:7px !important;" /> <i style=" left:67% !important; top:-8% !important; text-align:justify ; margin-top:0px !important; height:109px;">Tell us about the startups you have worked with and your role.<br/> It's alright if you don't wish to mention the startup name; <br/>just tell us what it does.
</i></a>--> </label>
                     <select name="startups" class="validate[required]" >
                    	<option value="">
                        	-- Please Select --
                        </option>
                        <option value="1" <?php if(isset($startups) && $startups == '1'){ ?> selected="selected" <?php } ?>>Yes</option>
                        <option value="0" <?php if(isset($startups) && $startups == '0'){ ?> selected="selected" <?php } ?>>No</option>
                    </select> 
                    <label>Key advice to entrepreneurs<font class="requiredblue">*</font> &nbsp;&nbsp;
                    <a  style="position:absolute !important;" class="ttphoto"><img src="images/photomsg.png" width="30" height="25" style="position: relative;" /> <i style="margin-bottom:-40px !important;"><a  style="position:relative  !important;" class="ttphoto" ><img src="images/photomsg.png" width="30" height="25" style="position: relative;" /><i style=" margin-bottom:-23px !important;">Give entrepreneurs a key bit of advice from your experience with startups/businesses so far</i></a></i></a></label>                    
                  <input type="text"  name="startup_experience" id="startup_experience" class="validate[required] text-input" value="<?php if(isset($startup_experience)) { echo $startup_experience; }?>" />
                    <label>What is your primary motivation to join FounderMates? <font class="requiredblue">*</font> </label>
                     <select name="motivation" class="validate[required]" >
                    	<option value="">
                        	-- Please Select --
                        </option>
                        <option value="Give back to community" <?php if(isset($motivation) && $motivation == 'Give back to community'){ ?> selected="selected" <?php } ?>>Give back to community </option>
                         <option value="Develop own SME/startup expertise" <?php if(isset($motivation) && $motivation == 'Develop own SME/startup expertise'){ ?> selected="selected" <?php } ?>>Develop own SME/startup expertise </option>
                         <option value="Potential monetary benefit from advisory" <?php if(isset($motivation) && $motivation == 'Potential monetary benefit from advisory'){ ?> selected="selected" <?php } ?>>Potential monetary benefit from advisory</option>
                         <option value="Visibility among entrepreneurs" <?php if(isset($motivation) && $motivation == 'Visibility among entrepreneurs'){ ?> selected="selected" <?php } ?>>Visibility among entrepreneurs</option>
                    </select> 
                    <label>Where did you hear about us? <font class="requiredblue">*</font></label>
                     <select name="hearabout" id="hearabout" class="validate[required]" onChange="setOtherDiv();" >
                    	<option value="">
                        	-- Please Select --
                        </option>
                        <option value="Referred by an advisor on FounderMates" <?php if(isset($hearabout) && $hearabout == 'Referred by an advisor on FounderMates'){ ?> selected="selected" <?php } ?>>Referred by an advisor on FounderMates</option>
                        <option value="Contacted by FounderMates" <?php if(isset($hearabout) && $hearabout == 'Contacted by FounderMates'){ ?> selected="selected" <?php } ?>>Contacted by FounderMates</option>
                        <option value="Referred by an entrepreneur" <?php if(isset($hearabout) && $hearabout == 'Referred by an entrepreneur'){ ?> selected="selected" <?php } ?>>Referred by an entrepreneur</option>
                        <option value="LinkedIn/Social Media" <?php if(isset($hearabout) && $hearabout == 'LinkedIn/Social Media'){ ?> selected="selected" <?php } ?>>LinkedIn/Social Media</option>
                        <option value="Networking event" <?php if(isset($hearabout) && $hearabout == 'Networking event'){ ?> selected="selected" <?php } ?>>Networking event</option>
                        <option value="Others" <?php if(isset($hearabout) && $hearabout == 'Others'){ ?> selected="selected" <?php } ?>>Others</option>
                         
                    </select>
                     <div id="otherDiv"></div>
                     <label>Years of mentorship/consultancy experience <font class="requiredblue">*</font></label>
                     <select name="mentorship_experience" id="mentorship_experience" class="validate[required]" >
                    	<option value="" >
                        	-- Please Select --
                        </option>
                        <option value="< 5" <?php if(isset($mentorship_experience) && $mentorship_experience == '< 5'){ ?> selected="selected" <?php } ?>>< 5</option>
                        <option value="5 - 10" <?php if(isset($mentorship_experience) && $mentorship_experience == '5 - 10'){ ?> selected="selected" <?php } ?>>5 - 10</option>
                        <option value="10 +" <?php if(isset($mentorship_experience) && $mentorship_experience == '10 +'){ ?> selected="selected" <?php } ?>>10 +</option>
                    </select>
                    
                    <label>My pitch (<span id="charNumOne" style="color:#F60; font-weight:bold;">110</span> characters) <font class="requiredblue">*</font> &nbsp;&nbsp;<a  style="position:absolute !important;" class="ttphoto" ><img src="images/photomsg.png" width="30" height="25" style="position: relative;" /> <i style=" margin-bottom:-8px !important;">Your pitch is your USP.</i></a>&nbsp;&nbsp;&nbsp;</label>                    
                  <textarea  id="my_pitch"  name="my_pitch" class="validate[required] txt"   onkeyup="countCharOne(this);" style="font-family: arial;
    margin-left: 0px;
    min-height: 65px;
    padding-left: 0;
    padding-right: 0;
    padding-top: 0;
    width: 320px !important;"><?php if(isset($my_pitch)) { echo $my_pitch; }?></textarea> 
                   
                </fieldset>
              
              <input type="submit" class="btnblue btnsignupmargin"  value="Register"  />
            </form>
        </div>
     
    </figure>
</section>
<div class="optionalsignup" style="margin: 195px auto;">
	
</div>
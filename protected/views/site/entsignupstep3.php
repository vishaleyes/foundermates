<script type="text/javascript">
var $j = jQuery.noConflict();

	$j(document).ready(function(){
	   // binds form submission and fields to the validation engine
	   $j("#registeration").validationEngine();
	  });
	  
	  
</script>
<script>
      function countChar(val) {
        var len = val.value.length;
		
        if (len >= 501) {
          val.value = val.value.substring(0, 500);
	 } else {
		  $j('#charNum').text(500 - len);
        }
      };
</script>
<script>
      function countCharOne(val) {
        var len = val.value.length;
		
        if (len >= 301) {
          val.value = val.value.substring(0, 300);
	 } else {
		  $j('#charNumOne').text(300 - len );
        }
      };
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
			
            <form  id="registeration" name="registeration" method="post" enctype="multipart/form-data" action="<?php echo Yii::app()->params->base_path ; ?>site/FinalRegistrationForEnt">
                <fieldset>
                
                	<label>Password <font class="requiredorange">*</font> </label>                   
                    <input type="password"  class="validate[required] text-input"  id="password" name="password" />                    
                     <label>What is the stage of your business ? <font class="requiredorange">*</font></label>                   
                    <select id="business_stage" style="width:329px;"  name="business_stage" class="validate[required]" >
                    	<option value="">-- Please Select --</option>
                        <option <?php if(isset($business_stage) && $business_stage == "1" ) { ?> selected="selected" <?php } ?> value="1">Idea</option>
                        <option <?php if(isset($business_stage) && $business_stage == "2" ) { ?> selected="selected" <?php } ?> value="2">Prototype</option>
                        <option <?php if(isset($business_stage) && $business_stage == "3" ) { ?> selected="selected" <?php } ?> value="3">Pre-revenue</option>
                        <option <?php if(isset($business_stage) && $business_stage == "4" ) { ?> selected="selected" <?php } ?> value="4">Revenue</option>
                        <option <?php if(isset($business_stage) && $business_stage == "5" ) { ?> selected="selected" <?php } ?> value="5">Growth</option>
                        <option <?php if(isset($business_stage) && $business_stage == "6" ) { ?> selected="selected" <?php } ?> value="6">Established</option>
                    </select>          
                    
                       
                    <label>Why do you need an advisor? Please be specific about the kind of help you need. <font class="requiredorange">*</font> (<span id="charNum" style="color:#F60; font-weight:bold;">500</span> characters max)&nbsp;</label>
                                  
                  <textarea maxlength = "503"    id="need_from_mentor"  name="need_from_mentor" class="validate[required] txt" style="font-family: arial;
    margin-left: -38px;
    min-height: 40px;
    padding-left: 0;
    padding-right: 0;
    padding-top: 0;
    width: 320px !important;" onkeyup="countChar(this)"><?php if(isset($need_from_mentor)) { echo $need_from_mentor ; } ?></textarea>                   
                    
                      
                    </fieldset>
                <fieldset class="rightsideform">
                    <label>Confirm Password <font class="requiredorange">*</font></label>                   
                    <input type="password"  class="validate[required] text-input"  id="cpassword" name="cpassword" />                    
                    <label>Website/Blog (if any) <font class="requiredorange">*</font></label>
                     <input type="text" name="website" id="website" value="<?php if(isset($website)) { echo $website ; } ?>"  class="validate[required] text-input" />       
                     <label>Describe your idea/product/service briefly <font class="requiredorange">*</font> (<span id="charNumOne" style="color:#F60; font-weight:bold;">300</span> characters max)&nbsp;</label>                   
                     <textarea maxlength = "300"  id="idea"  name="idea" class="validate[required] txt" style="font-family: arial;
    margin-left: 0px;
    min-height: 40px;
    padding-left: 0;
    padding-right: 0;
    padding-top: 0;
    width: 320px !important;" onkeyup="countCharOne(this)"><?php if(isset($idea)) { echo $idea ; } ?></textarea>      
                </fieldset>
              <input type="submit" class="btnorange btnsignupmargin" value="Register"  />
            </form>
        </div>
     
    </figure>
</section>
<div class="optionalsignup">
	
</div>

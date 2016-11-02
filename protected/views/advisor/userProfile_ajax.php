<style>
.profileTextBox
{
  margin: 5px 5px 5px auto !important ;
  width:200px !important;
}
</style>

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
</script>
<script type="text/javascript">

function checkStageLimit()
{
	 var items = $j('#area_of_expertise option').parent().val();
        if (items.length > 4) {
                alert("You can only select 4 skills at a time");
           		return false;
        }
}


$j(document).ready(function() 
{
    $j('#area_of_expertise option').click(function() 
    {
        var items = $j(this).parent().val();
        if (items.length > 4) {
                      alert("You can only select 4 skills at a time");
           $j(this).removeAttr("selected");
        }
    });
	
	
   });
</script>

<link rel="stylesheet" type="text/css" href="style.css" />
<div class="admincontent">
<h2>User Profile</h2>
     
     <div class="bordertop">
     <hr class="bluethickborder" />
     <hr class="thinborder" style="margin-left: -25px;" /> 
	</div>
</div>




<center>
<form action="<?php echo Yii::app()->params->base_path;?>advisor/editUserProfile" method="post" enctype="multipart/form-data" onsubmit="return checkStageLimit();">

<div class="profileContainer">
<center>
	<div class="per_det" >
	<h3  style="
    background-color: #10BEF8;
    height: 33px;
    margin: 0 0 10px -10px;
    padding-bottom: 0;
    padding-left: 10px;
    font-size:26px;
    color:#FFF;
    padding-top: 5px;"><img src="<?php echo Yii::app()->params->base_url; ?>images/photo_icon.png" />  Personal Details</h3>
	    <div class="photo">
          <?php 
		//$file = Yii::app()->params->base_url."assets/upload/avatar/".$row['avatar'] ;
		if( 0 === strpos($avatar, 'http') )
		{
			$content = file_get_contents($avatar);
			
			if(!empty($content))
			{
				$filePath =  $avatar;
			}
			else
			{
				$filePath =  Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url."assets/upload/avatar/image.png";
			}
		}
		else
		{
			
			
			
			if(!empty($avatar))
			{
				$filename = "assets/upload/avatar/". $avatar ."";
				if(file_exists($filename))
				{
					$filePath =  Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url."assets/upload/avatar/". $avatar ."&h=65&w=75&q=60&zc=0";
				}
				else
				{
					$filePath =  Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url."assets/upload/avatar/image.png";
				}
			}
			else
			{
				$filePath =  Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url."assets/upload/avatar/image.png";
			}
		} ?>
		
        <img src="<?php echo $filePath; ?>" style="width:100px; height:100px;" /> 
        </div>
	    <div class="details">
        <table width="100%" border="0" style="margin:0px; margin-left:-40px; padding:5px; color:#666666;
			  font-size:12px; vertical-align:top;">
			<tr>
	    	<td width="30%" align="right"><strong class="profilelbl">Firstname: </strong></td>
    		<td width="70%" align="left"><input type="text" style="width:150px; " class="profileTextBox" name="firstName" id="firstName" value="<?php if(isset($firstName)) { echo $firstName ; } else { echo "-NOT SET-"; } ?>" /></td>
  			</tr>
            <tr>
	    	<td align="right"><strong class="profilelbl">Lastname: </strong></td>
    		<td width="" align="left"><input type="text" style="width:150px;" class="profileTextBox" name="lastName" id="lastName" value="<?php if(isset($firstName)) { echo $lastName ; } else { echo "-NOT SET-"; } ?>" /></td>
  			</tr>
  			<tr>
	    	<td align="right"><strong class="profilelbl">City:  </strong></td>
	    	<td align="left"><input type="text" style="width:150px;" class="profileTextBox"  name="city" id="city" value="<?php if(isset($city)) { echo $city ; } else { echo "-NOT SET-"; } ?>" /></td>
  			</tr>
            <tr>
	    	<td align="right"><strong class="profilelbl">Country: </strong></td>
	    	<td align="left"><input type="text" style="width:150px;" class="profileTextBox"  name="country" id="country" value="<?php if(isset($country)) { echo $country ; } else { echo "-NOT SET-"; } ?>" /></td>
  			</tr>
            <td align="right"><strong class="profilelbl">AdvisorType: </strong></td>
	    	<td align="left">Expert: <input type="radio" name="advisorType" value="0" <?php if(isset($advisorType) && $advisorType == 0 ) { echo 'checked="checked"' ; } ?> /> Mentor: <input type="radio" name="advisorType" value="1" <?php if(isset($advisorType) && $advisorType == 1 ) { echo 'checked="checked"' ; } ?> /></td>
  			</tr>
            <tr>
            <td align="right" ><strong class="profilelbl">Photo:</strong></td>
	    	<td align="left" ><input type="file" class="profileTextBox"    id="userImage" name="userImage"  /><br />(jpb,png,bmp,gif)  </td>
            </tr>
		</table>
    	</div>
		<br /><br /><br /><br /><br /><br />
		<div class="linkbtn">
        <?php if(isset($linkedinLink) && $linkedinLink != "" ) { ?>
        
        <a target="_blank" href="<?php if(isset($linkedinLink)) { echo $linkedinLink ; } ?>" >
        <img src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo Yii::app()->params->base_url; ?>images/linkedin-logo.png&h=50&w=50&q=72&zc=0"     />
        </a>
        <?php } ?>
        </div>    
    </div>
   	<div class="prof_det">
		<h3 style="background-color: #10BEF8;
    height: 33px;
    margin: 0 0 10px -10px;
    padding-bottom: 0;
    padding-left: 10px;
    font-size:26px;
    color:#FFF;
    padding-top: 5px;"><img src="<?php echo Yii::app()->params->base_url; ?>images/prof_icon.png" />
    Professional Details</h3>
    	<div>
		<table width="100%" border="0" style="margin:0px;  padding:5px; color:#666666;
			  font-size:12px; vertical-align:top;">
          <tr>
            <td width="30%" align="left" ><strong class="profilelbl">Organisation: </strong></td>
            <td width="70%" align="left"><input type="text" style="width:150px;" class="profileTextBox" name="organisation" id="organisation" value="<?php if(isset($organisation)) { echo htmlentities($organisation) ; } else { echo "-NOT SET-"; } ?>" /> </td>
          </tr>
          <tr>
            <td align="left"><strong class="profilelbl">Work/Title Position Held: </strong></td>
            <td align="left"><input type="text" style="width:150px;" class="profileTextBox" name="work_status" id="work_status" value="<?php if(isset($work_status)) { echo htmlentities($work_status) ; } else { echo "-NOT SET-"; } ?>" /></td>
          </tr>
          <tr>
            <td align="left"><strong class="profilelbl">Skills: </strong></td>
            <td align="left">
            <?php //if(isset($industry_name)) { echo $industry_name ; } else { echo "-NOT SET-"; } 
			
			$expertiseObj = new ExpertiseAreas();
			$expertiseData = $expertiseObj->getExpertiseList();
			
			/*echo "<pre>";
			print_r($area_of_expertise);
			$expertise = explode(',',$area_of_expertise);
			print_r($expertise);
			exit;
			exit; */
			
			?>
            
            <select id="area_of_expertise" name="area_of_expertise[]" style=" margin: 5px 5px 5px auto !important ;"  multiple="multiple" >
                    <option value="">Choose area of expertise...</option>
                    <?php 
                    $expertise = explode(',',$area_of_expertise);
                    
                    foreach ($expertiseData as $row ) {
						if(in_array($row['area_of_expertise'], $expertise))
                        {
					?>
                        <option value="<?php echo $row['area_of_expertise']; ?>" selected="selected"><?php echo $row['area_of_expertise']; ?></option>
                <?php } 
                    else
                    { ?>
                       <option value="<?php echo $row['area_of_expertise']; ?>" ><?php echo $row['area_of_expertise']; ?></option>                    
                        <?php   
					    }
                    }
                    ?>
           </select> 
            </td>
          </tr>
          <tr>
            <td align="left"><strong class="profilelbl">Industry: </strong></td>
            <td align="left">
			
			<?php //if(isset($industry_name)) { echo $industry_name ; } else { echo "-NOT SET-"; } 
			
			$industryObj = new Industry();
			$industryData = $industryObj->getIndustryList();
			?>
            
            <select id="industry" style="width:180px;" name="industry"  class="profileTextBox" >
                    	<option value="">Choose industry...</option>
                        <?php foreach ($industryData as $row ) { ?>
                        <option value="<?php echo $row['industry']; ?>"  <?php if(isset($industry) && $industry == $row['industry']) { ?> selected="selected" <?php } ?>><?php echo $row['industry_name']; ?></option>
						<?php } ?>
                    </select> </td>
          </tr>
        </table>

        </div>	
        <br /><br /><br />
    </div>
        
	<div class="adv_det">
	<h3 style="background-color: #10BEF8;
    height: 33px;
    margin-left:-15px;
    padding-bottom: 0;
    padding-left: 10px;
    font-size:26px;
    color:#FFF;
    padding-top: 5px;"><img src="<?php echo Yii::app()->params->base_url; ?>images/personalinfo_icon.png" /> Advisory Details</h3>
    <table width="1000" border="0" style="margin:0px;  padding:5px; color:#666666;
			  font-size:12px; vertical-align:top;">
      <tr>
        <td width="35%" align="right"><strong class="profilelbl">My Pitch (<span id="charNumOne" style=" color:#F60; font-weight:bold;">110</span> Char. max): </strong>&nbsp;&nbsp;&nbsp;<a  style="position:relative  !important;" class="ttphoto" ><img src="images/photomsg.png" width="30" height="25" style="position: relative;" /><i style=" margin-bottom:-23px !important;">Please mention specific areas where you can provide advice to entrepreneurs, e.g. starting up, product/market fit, raising investment, business model, etc.</i></a>&nbsp;</td>
        <td width="65%">
        <textarea  name="my_pitch" id="my_pitch" cols="40" rows="3" style="font-size:14px; font-family:Arial, Helvetica, sans-serif !important;" onkeyup="countCharOne(this);" maxlength="110" ><?php if(isset($my_pitch)) { echo htmlentities($my_pitch) ; } else { echo "-NOT SET-"; } ?></textarea>
        </td>
      </tr>
      <tr>
        <td align="right"><strong class="profilelbl">I can help you with (<span id="charNum" style=" color:#F60; font-weight:bold;">250</span> words): </strong><a  style="position:relative !important;" class="ttphoto" ><img src="images/photomsg.png" width="30" height="25" style="position: relative;" /> <i style=" margin-bottom:-50px !important;">Mention specific areas where can I provide advice to entrepreneurs. Examples include starting up, product/market fit, raising investment, business model etc.</i></a></td>
        <td>
        <textarea  name="help" id="help" cols="40" rows="3" style="font-size:14px; font-family:Arial, Helvetica, sans-serif !important;" onkeyup="countChar(this);" maxlength="250"><?php if(isset($help)) { echo htmlentities($help) ; } else { echo "-NOT SET-"; } ?></textarea>
       </td>
      </tr>
      <tr>
        <td align="right"><strong class="profilelbl">What kind of entrepreneurs can connect to me: </strong></td>
        <td>
        	<select id="ent_industry" name="ent_industry[]" style=" margin: 5px 5px 5px auto !important ;"  multiple="multiple" >
                <option value="">Choose industry...</option>
                <?php 
					$industryArray = explode(',',$ent_industry);
					foreach ($industryData as $row ) { 
						if(in_array($row['industry'], $industryArray))
                        {
				?>
                <option value="<?php echo $row['industry']; ?>" selected="selected"><?php echo $row['industry_name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $row['industry']; ?>"><?php echo $row['industry_name']; ?></option>
                <?php } }?>
            </select>  
        </td>
      </tr>
      <tr>
        <td align="right"><strong class="profilelbl">Key advice to entrepreneurs : </strong><a  style="position:relative  !important;" class="ttphoto" ><img src="images/photomsg.png" width="30" height="25" style="position: relative;" /><i style=" margin-bottom:-23px !important;">Give entrepreneurs a key bit of advice from your experience with startups/businesses so far</i></a></td>
        <td><input type="text" style="width:318px !important;" class="profileTextBox" name="startup_experience" id="startup_experience" value="<?php if(isset($startup_experience) && $startup_experience != "") { echo htmlentities($startup_experience) ; } else { echo "-NOT SET-"; } ?>" /> </td>
      </tr>
      <tr>
        <td align="right"><strong class="profilelbl">Years of mentorship/consultancy experience: </strong></td>
        <td> <select name="mentorship_experience" id="mentorship_experience" style=" margin: 5px 5px 5px auto !important ;"  >
                    	<option value="">
                        	-- Please Select --
                        </option>
                        <option  <?php if(isset($mentorship_experience) && $mentorship_experience == "< 5" ) { echo "selected" ; } ?> value="< 5">< 5</option>
                        <option  <?php if(isset($mentorship_experience) && $mentorship_experience == "5 - 10" ) { echo "selected" ; } ?> value="5 - 10">5 - 10</option>
                        <option  <?php if(isset($mentorship_experience) && $mentorship_experience == "10 +" ) { echo "selected" ; } ?> value="10 +">10 +</option>
                    </select><?php //if(isset($mentorship_experience)) { echo $mentorship_experience ; } else { echo "-NOT SET-"; } ?></td>
      </tr>
      <tr>
        <td align="right"><strong class="profilelbl">Interested in advising: </strong></td>
        <td>
		<?php 
			$stagename = explode(',',$stage);
		?>
        
         <select name="stage[]" id="stage" style=" margin: 5px 5px 5px auto !important ;"    multiple="multiple" >
                    	<option value="">
                        	-- Please Select --
                        </option>
                        <option value="1" <?php if(in_array('1', $stagename)){  ?> selected="selected" <?php } ?>>Idea</option>
                        <option value="2" <?php if(in_array('2', $stagename)){  ?> selected="selected" <?php } ?>>Prototype</option>
                        <option value="3" <?php if(in_array('3', $stagename)){  ?> selected="selected" <?php } ?>>Pre-revenue</option>
                        <option value="4" <?php if(in_array('4', $stagename)){  ?> selected="selected" <?php } ?>>Revenue</option>
                        <option value="5" <?php if(in_array('5', $stagename)){  ?> selected="selected" <?php } ?>>Growth</option>
                        <option value="6" <?php if(in_array('6', $stagename)){  ?> selected="selected" <?php } ?>>Established</option>
                    </select> 
        </td>
      </tr>
    </table>
	</div>
    
    <br /><br />
    <div style="text-align:center !important">
<input type="Submit" name="editProfile" id="editProfile" style="margin-top:-30px; margin-bottom:10px;" class="btnblue" value="Update" />&nbsp; <span style="bottom: 15px;left: 25px;margin-right: 750px;position: relative;"> or <a href="<?php echo Yii::app()->params->base_path; ?>advisor/showAdvisorProfile" style="padding:10px;">Cancel</a></span>

</div>
</center>
</div>



</form>
</center>

<div  style="height:450px;"> 
</div>

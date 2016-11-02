<style>
.profileTextBox
{
  margin: 5px 5px 5px auto !important ;
  width:200px !important;
}
</style>
<link rel="stylesheet" type="text/css" href="style.css" />
<div class="admincontent">
<h2>User Profile</h2>
     
     <div class="bordertop">
     <hr class="bluethickborder" />
     <hr class="thinborder" style="margin-left: -25px;" />
	</div>
</div>
<form action="<?php echo Yii::app()->params->base_path;?>entrepreneur/editUserProfile" method="post" enctype="multipart/form-data" >
<div class="profileContainer" style="padding-left:170px;">
	<div class="per_det" style="float:none; width:100%;" >
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
        
                <br />
		<div class="linkbtn">
        <?php if(isset($linkedinLink) && $linkedinLink != "" ) { ?>
        
        <a target="_blank" href="<?php if(isset($linkedinLink)) { echo $linkedinLink ; } ?>" >
        <img src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo Yii::app()->params->base_url; ?>images/linkedin-logo.png&h=50&w=50&q=72&zc=0"   />
        </a>
        <?php } ?>
        </div> 

        </div>
	    <div class="details" style="float:left; margin-left:80px; width:670px !important;">
       
        
        <table width="100%" border="0" style="margin:0px; padding:5px; margin-left: -58px; color:#666666;
			  font-size:12px; vertical-align:top;">
			<tr>
	    	<td  width="85px" align="right"><strong class="profilelbl">First Name : </strong><em style="color:#F00;">*</em></td>
    		<td width="25%" align="left"><input type="text" class="profileTextBox" name="firstName"  id="firstName" style="width:150px;" value="<?php if(isset($firstName)) { echo htmlentities($firstName) ; } ?>"  /></td>
            <td width="85px" align="right"><strong class="profilelbl">Last Name : </strong><em style="color:#F00;">*</em></td>
    		<td width="25%" align="left"><input type="text" class="profileTextBox"  name="lastName" id="lastName"  style="width:150px;" value="<?php if(isset($lastName)) { echo htmlentities($lastName) ; } ?>"  /></td>
  			</tr>
            
  			<tr>
	    	<td align="right"><strong class="profilelbl">City : </strong><em style="color:#F00;">*</em></td>
	    	<td align="left"><input type="text" class="profileTextBox"   style="width:150px;" id="city" name="city" value="<?php if(isset($city)) { echo htmlentities($city) ; } ?>"  /></td>
            <td align="right"><strong class="profilelbl">Country : </strong><em style="color:#F00;">*</em></td>
	    	<td align="left"><input type="text" class="profileTextBox"   style="width:150px;" id="country" name="country" value="<?php if(isset($country)) { echo htmlentities($country) ; } ?>"  /></td>
  			</tr>
            <tr>
	    	<td align="right" ><strong class="profilelbl">Photo :  </strong></td>
	    	<td align="left" ><input type="file" class="profileTextBox"    id="userImage" name="userImage"  /><br />(jpg,bmp,gif,png)</td>
            <td align="right"><strong class="profilelbl">Industry : </strong><em style="color:#F00;">*</em></td>
	    	<td align="left">
            <select id="industry" name="industry" style="width:205px !important;"  class="profileTextBox" >
                <option value="">Choose industry...</option>
                <?php 
                $industryObj = new Industry();
                $industryData = $industryObj->getIndustryList();
                foreach ($industryData as $row ) { 
                ?>
                <option value="<?php echo $row['industry']; ?>"  <?php if(isset($industry) && $industry == $row['industry'] ) { ?> selected="selected" <?php } ?>><?php echo $row['industry_name']; ?></option>
                <?php } ?>
            </select> </td>
            </tr>
           
		</table>
    	</div>
		   
    </div>
        <br /><br />
    <div class="per_det" style=" width:100%;" >
	<h3  style="
    background-color: #10BEF8;
    height: 33px;
    margin: 0 0 10px -10px;
    padding-bottom: 0;
    padding-left: 10px;
    font-size:26px;
    color:#FFF;
    padding-top: 5px;"><img src="<?php echo Yii::app()->params->base_url; ?>images/prof_icon.png" />  Professional Details</h3>
	    <table width="100%" border="0" style="margin:0px; padding:5px; color:#666666;
			  font-size:12px; vertical-align:top;">
      <tr>
        <td width="22%" align="right"><strong class="profilelbl">Stage of your business : </strong><em style="color:#F00;">*</em></td>
        <td width="78%">
        <select id="business_stage" name="business_stage" style=" width:338px; margin: 5px 5px 5px auto !important ;"  >
            <option value="">-- Please Select --</option>
            <option <?php if(isset($business_stage) && $business_stage == 1 ) {  ?> selected="selected" <?php } ?> value="1">Idea</option>
            <option <?php if(isset($business_stage) && $business_stage == 2 ) {  ?> selected="selected" <?php } ?>  value="2">Prototype</option>
            <option <?php if(isset($business_stage) && $business_stage == 3 ) {  ?> selected="selected" <?php } ?>  value="3">Pre-revenue</option>
            <option <?php if(isset($business_stage) && $business_stage == 4 ) {  ?> selected="selected" <?php } ?>  value="4">Revenue</option>
            <option <?php if(isset($business_stage) && $business_stage == 5 ) {  ?> selected="selected" <?php } ?>  value="5">Growth</option>
            <option <?php if(isset($business_stage) && $business_stage == 6 ) {  ?> selected="selected" <?php } ?>  value="6">Established</option>
        </select>
        </td>
      </tr>
      <tr>
        <td align="right"><strong class="profilelbl">Why do you need an advisor? : </strong><em style="color:#F00;">*</em></td>
        <td><textarea name="need_from_mentor" style="font-size:14px; font-family:Arial, Helvetica, sans-serif !important; margin: 5px 5px 5px auto !important ; min-width:332px !important" id="need_from_mentor"><?php if(isset($need_from_mentor)) { echo htmlentities($need_from_mentor) ; } ?></textarea></td>
      </tr>
      <tr>
        <td align="right"><strong class="profilelbl">Your idea/product/service : </strong><em style="color:#F00;">*</em></td>
        <td ><textarea name="idea" style="font-size:14px; font-family:Arial, Helvetica, sans-serif !important; margin: 5px 5px 5px auto !important ; min-width:332px !important" id="idea"><?php if(isset($idea)) { echo htmlentities($idea) ; } ?></textarea></td>
      </tr>
      <tr>
        <td align="right"><strong class="profilelbl">Website/Blog : </strong><em style="color:#F00; ">*</em></td>
        <td><input type="text" name="website" style="width:330px; margin: 5px 5px 5px auto !important ;"  id="website"  value="<?php if(isset($website) && $website != "") { echo htmlentities($website) ; } else { echo "" ; } ?>"  /></td>
      </tr>
      
    </table>  
    </div>
	
<br /><br /><br /><br />
    <div>
<input type="Submit" class="btnblue" value="Update" /> <span style=" left: 25px;margin-right: 750px;position: relative;top: 14px;">or <a href="<?php echo Yii::app()->params->base_path; ?>entrepreneur/index" style="margin:10px;">Cancel</a></span>

</div>
</form>
</div>

<div style="height:250px;"> 
</div>

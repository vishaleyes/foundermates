<link rel="stylesheet" type="text/css" href="style.css" />

<div class="admincontent">


<h2>Entrepreneur Profile</h2>
     
     <div class="bordertop">
     <hr class="bluethickborder" />
     <hr class="thinborder" style="margin-left: -25px;" />
	</div>
</div>

<div style="height:60px; margin-left:1025px;">
<input type="button" onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>admin/entProfileAjax/userId/<?php echo $userId ; ?>'" class="btnblue" value="Edit" />
</div>



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
			$filePath =  $avatar;	
		}
		else
		{
			$filePath =  Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url."assets/upload/avatar/". $avatar ."&h=100&w=100&q=60&zc=0";
		}
		
		if($avatar != "" ){ 
		?>
        
        <img src="<?php echo $filePath; ?>" style="width:100px; height:100px;" /> 
        <?php }else {  ?>
        
         <img src="<?php echo Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url ;?>assets/upload/avatar/image.png&h=100&w=100&q=60&zc=0" />
        <?php } ?>
        </div>
	    <div class="details" style="float:left; margin-left:40px;">
        <table border="0"  style="margin:0px; padding:5px; color:#666666;
			  font-size:12px; vertical-align:top;">
			<tr>
	    	<td width="10%" align="left"><strong class="profilelbl">Name  </strong></td>
    		<td width="90%" align="left"><?php if(isset($firstName)) { echo $firstName." ".$lastName ; } else { echo "-NOT SET-"; } ?></td>
  			</tr>
  			<tr>
	    	<td align="left"><strong class="profilelbl">Location  </strong></td>
	    	<td align="left"><?php if(isset($city)) { echo $city.", ".$country ; } else { echo "-NOT SET-"; } ?></td>
  			</tr>
            <tr>
	    	<td align="left"><strong class="profilelbl">Industry  </strong></td>
	    	<td align="left"><?php if(isset($industry_name)) { echo $industry_name ; } else { echo "-NOT SET-"; } ?></td>
  			</tr>
		</table>
    	</div>
		<br /><br /><br /><br /><br /><br />
		<div class="linkbtn">
        <?php if(isset($linkedinLink) && $linkedinLink != "" ) { ?>
        
        <a target="_blank" href="<?php if(isset($linkedinLink)) { echo $linkedinLink ; } ?>" >
        <img src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo Yii::app()->params->base_url; ?>images/linkedin-logo.png&h=50&w=50&q=72&zc=0"  />
        </a>
        <?php } ?>
        </div>    
    </div>
        <br /><br />
    <div class="per_det" style=" width:100%;" >
	<h3  style="
    background-color: #10BEF8;
    height: 33px;
    margin: -40px 0 10px -10px;
    padding-bottom: 0;
    padding-left: 10px;
    font-size:26px;
    color:#FFF;
    padding-top: 5px;"><img src="<?php echo Yii::app()->params->base_url; ?>images/prof_icon.png" />  Professional Details</h3>
    
    <table style="margin:0px;  padding:5px; color:#666666;
			  font-size:12px; vertical-align:top;">
    	<tr>
        <td width="40%"><strong class="profilelbl">Stage of your business </strong></td>
        <td width="60%"><?php if(isset($business_stage) && $business_stage == 1 ) { echo "Idea" ; } else if(isset($business_stage) && $business_stage == 2 ) { echo "Prototype"; } else if(isset($business_stage) && $business_stage == 3 ) { echo "Pre-revenue"; } else if(isset($business_stage) && $business_stage == 4 ) { echo "Revenue"; }  else if(isset($business_stage) && $business_stage == 5 ) { echo "Growth"; }  else if(isset($business_stage) && $business_stage == 6 ) { echo "Established"; } ?></td>
      </tr>
      <tr>
        <td><strong class="profilelbl">Briefly describe your product/service </strong></td>
        <td><?php if(isset($idea)) { echo $idea ; } else { echo "-NOT SET-"; } ?></td>
      </tr>
      <tr>
        <td><strong class="profilelbl">Website/Blog</strong></td>
        <td><a href="<?php if(isset($website)) { echo $website ; } else { echo "#"; } ?>/"  target="_blank"><?php if(isset($website)) { echo $website ; } else { echo "-NOT SET-"; } ?></a></td>
      </tr>
      <tr>
        <td><strong class="profilelbl">Why do you need a advisor?</strong></td>
        <td><?php if(isset($need_from_mentor)) { echo $need_from_mentor ; } else { echo "-NOT SET-"; } ?></td>
      </tr>
    </table>
    
  <?php /*?>  <table class="tblprofile" style="margin-left: -10px; min-width: 500px;"  border="0">
      <tr>
        <td style="min-width: 300px !important;"><strong class="profilelbl">Stage of your business: </strong></td>
        <td style="min-width: 700px !important;"><?php if(isset($business_stage) && $business_stage == 1 ) { echo "Idea" ; } else if(isset($business_stage) && $business_stage == 2 ) { echo "Prototype"; } else if(isset($business_stage) && $business_stage == 3 ) { echo "Pre-revenue"; } else if(isset($business_stage) && $business_stage == 4 ) { echo "Revenue"; }  else if(isset($business_stage) && $business_stage == 5 ) { echo "Growth"; }  else if(isset($business_stage) && $business_stage == 6 ) { echo "Established"; } ?></td>
      </tr>
      <tr>
        <td style="min-width: 300px !important;"><strong class="profilelbl">Briefly describe your product/service </strong></td>
        <td style="min-width: 700px !important;"><?php if(isset($idea)) { echo $idea ; } else { echo "-NOT SET-"; } ?> </td>
      </tr>
      <tr>
        <td style="min-width: 300px !important;"><strong class="profilelbl">Website/Blog</strong></td>
        <td style="min-width: 700px !important;"><a href="<?php if(isset($website)) { echo $website ; } else { echo "#"; } ?>"  target="_blank"><?php if(isset($website)) { echo $website ; } else { echo "-NOT SET-"; } ?></a></td>
      </tr>
      <tr>
        <td style="min-width: 300px !important;"><strong class="profilelbl">Why do you need a advisor?</strong></td>
        <td style="min-width: 700px !important;"><?php if(isset($need_from_mentor)) { echo $need_from_mentor ; } else { echo "-NOT SET-"; } ?></td>
      </tr>
    </table><?php */?>
    
    
    </div>
	

</div>

<div style="height:0px;"> 
</div>

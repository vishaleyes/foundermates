<link rel="stylesheet" type="text/css" href="style.css" />

<div class="admincontent">


<h2>Entrepreneur Profile</h2>
     
     <div class="bordertop">
     <hr class="bluethickborder" />
     <hr class="thinborder" style="margin-left: -25px;" />
	</div>
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
	    <div class="details" style="float:left; margin-left:80px;">
        <table width="" border="0">
			<tr>
	    	<td width="80" align="right"><strong>Name : </strong></td>
    		<td width="" align="left"><?php if(isset($firstName)) { echo $firstName." ".$lastName ; } else { echo "-NOT SET-"; } ?></td>
  			</tr>
  			<tr>
	    	<td align="right"><strong>Location : </strong></td>
	    	<td align="left"><?php if(isset($city)) { echo $city." , ".$country ; } else { echo "-NOT SET-"; } ?></td>
  			</tr>
            <tr>
	    	<td align="right"><strong>Industry : </strong></td>
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
    margin: 0 0 10px -10px;
    padding-bottom: 0;
    padding-left: 10px;
    font-size:26px;
    color:#FFF;
    padding-top: 5px;"><img src="<?php echo Yii::app()->params->base_url; ?>images/prof_icon.png" />  Professional Details</h3>
	    <table width="100%" border="0">
      <tr>
        <td  style=" width:230px;" align="left"><strong>Stage of your business: </strong></td>
        <td align="left"><?php if(isset($business_stage) && $business_stage == 1 ) { echo "Idea" ; } else if(isset($business_stage) && $business_stage == 2 ) { echo "Prototype"; } else if(isset($business_stage) && $business_stage == 3 ) { echo "Pre-revenue"; } else if(isset($business_stage) && $business_stage == 4 ) { echo "Revenue"; }  else if(isset($business_stage) && $business_stage == 5 ) { echo "Growth"; }  else if(isset($business_stage) && $business_stage == 6 ) { echo "Established"; } ?></td>
      </tr>
      <tr>
        <td align="left"><strong>Briefly describe your product/service : </strong></td>
        <td align="left"><?php if(isset($idea)) { echo substr($idea,0,110) ; } else { echo "-NOT SET-"; } ?></td>
      </tr>
      <tr>
        <td align="left"><strong>Website/Blog: </strong></td>
        <td align="left"><a href="<?php if(isset($website)) { echo $website ; } else { echo "#"; } ?>"  target="_blank"><?php if(isset($website)) { echo $website ; } else { echo "-NOT SET-"; } ?></a></td>
      </tr>
       <tr>
        <td align="left"><strong>Why do you need a advisor?: </strong></td>
        <td align="left"><?php if(isset($need_from_mentor)) { echo $need_from_mentor ; } else { echo "-NOT SET-"; } ?></td>
      </tr>
      
      
    </table>  
    </div>
	

</div>

<div style="height:150px;"> 
</div>

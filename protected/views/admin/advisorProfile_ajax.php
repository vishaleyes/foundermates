<link rel="stylesheet" type="text/css" href="style.css" />
<div class="admincontent">
<h2>Advisor Profile</h2>
     
     <div class="bordertop">
     <hr class="bluethickborder" />
     <hr class="thinborder" style="margin-left: -25px;" />
	</div>
</div>

<form action="<?php echo Yii::app()->params->base_path;?>admin/editProfile" method="post" >

<div style="height:10px; margin-left:1025px;">
<input type="submit" class="btnblue" value="Update" style=" margin-left:-30px !important;" />
</div>

<div class="profileContainer" style=" padding-left:146px !important; margin-top:50px; position: relative; margin-bottom: 10px;">
<center>
	<div class="per_det">
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
	    <div class="details">
        <table style="margin:0px; margin-left:-40px; padding:5px; color:#666666;
			  font-size:12px; vertical-align:top;">
        	<tr>
	    	<td width="24%" align="left"><strong class="profilelbl">Name  </strong></td>
    		<td width="68%" align="left"><?php if(isset($firstName)) { echo $firstName." ".$lastName ; } else { echo "-NOT SET-"; } ?></td>
  			</tr>
  			<tr>
	    	<td align="left"><strong class="profilelbl">Country  </strong></td>
	    	<td align="left"><?php if(isset($country)) { echo $country; } else { echo "-NOT SET-"; } ?></td>
  			</tr>
            <tr>
	    	<td align="left"><strong class="profilelbl">City  </strong></td>
	    	<td align="left"><input type="text" style="width:150px;" class="profileTextBox"  name="city" id="city" value="<?php if(isset($city)) { echo $city ; } else { echo "-NOT SET-"; } ?>" /></td>
  			</tr>
            <tr>
	    	<td align="left"><strong class="profilelbl">Phone No  </strong></td>
	    	<td align="left"><?php if(isset($phone)) { echo $phone ; } else { echo "-NOT SET-"; } ?></td>
  			</tr>
<input type="hidden" name="userId" id="userId" value="<?php echo $userId ; ?>" />
</form>
        </table>
        
     <?php /*?>   <table width="100%" border="0" class="tblprofile" style="margin-left: -65px;">
			<tr>
	    	<td width="80" align="right"><strong class="profilelbl">Name  </strong></td>
    		<td width="" align="left"><?php if(isset($firstName)) { echo $firstName." ".$lastName ; } else { echo "-NOT SET-"; } ?></td>
  			</tr>
  			<tr>
	    	<td align="right"><strong class="profilelbl">Location  </strong></td>
	    	<td align="left"><?php if(isset($city)) { echo $city." , ".$country ; } else { echo "-NOT SET-"; } ?></td>
  			</tr>
		</table><?php */?>
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
    	
        <table style="margin:0px; padding:5px; color:#666666;
			  font-size:12px; vertical-align:top;">
        
        	<tr>
            <td width="38%" align="left"><strong class="profilelbl">Organisation </strong></td>
            <td width="62%" align="left" ><?php if(isset($organisation)) { echo $organisation ; } else { echo "-NOT SET-"; } ?></td>
          </tr>
          <tr>
            <td align="left"><strong class="profilelbl">Work/Title Position<br /> Held </strong></td>
            <td align="left" ><?php if(isset($work_status)) { echo $work_status ; } else { echo "-NOT SET-"; } ?></td>
          </tr>
          <tr>
            <td  align="left"><strong class="profilelbl">Areas of Expertise </strong></td>
            <td align="left"><?php if(isset($area_of_expertise)) { echo $area_of_expertise ; } else { echo "-NOT SET-"; } ?></td>
          </tr>
          <tr>
            <td align="left"><strong class="profilelbl">Industry </strong></td>
            <td align="left"><?php if(isset($industry_name)) { echo $industry_name ; } else { echo "-NOT SET-"; } ?> </td>
          </tr>	
        </table>
        
		<?php /*?><table border="0" class="tblprofile tblprofilewidth" style="margin-left: -10px;">
          
           <tr>
            <td align="left"><strong class="profilelbl">Organisation </strong></td>
            <td align="left" style="left: -80px; position:relative;"><?php if(isset($organisation)) { echo $organisation ; } else { echo "-NOT SET-"; } ?></td>
          </tr>
          <tr>
            <td align="left"><strong class="profilelbl">Work/Title Position Held </strong></td>
            <td align="left" style="left: -80px; position:relative;"><?php if(isset($work_status)) { echo $work_status ; } else { echo "-NOT SET-"; } ?></td>
          </tr>
          <tr>
            <td  align="left"><strong class="profilelbl">Areas of Expertise </strong></td>
            <td align="left" style="left: -80px; position:relative;"><?php if(isset($area_of_expertise)) { echo $area_of_expertise ; } else { echo "-NOT SET-"; } ?></td>
          </tr>
          <tr>
            <td align="left"><strong class="profilelbl">Industry </strong></td>
            <td align="left" style="left: -80px; position:relative;"><?php if(isset($industry_name)) { echo $industry_name ; } else { echo "-NOT SET-"; } ?></td>
          </tr>
        </table><?php */?>
    </div>
        <br /><br /><br /><br />
	<div class="adv_det">
	<h3 style="background-color: #10BEF8;
    height: 33px;
    margin: 0 0 10px -15px;
    padding-bottom: 0;
    padding-left: 10px;
    font-size:26px;
    color:#FFF;
    padding-top: 5px;"><img src="<?php echo Yii::app()->params->base_url; ?>images/personalinfo_icon.png" /> Advisory Details</h3>
   <?php /*?> <table class="tblprofile" style="margin-left: -10px; max-width: 500px;"  border="1">
      <tr>
        <td style="min-width: 300px !important;"><strong class="profilelbl">My Pitch (110 Char. max): </strong></td>
        <td style="width:500px;"><?php if(isset($my_pitch)) { echo $my_pitch ; } else { echo "-NOT SET-"; } ?></td>
      </tr>
      <tr>
        <td style="min-width: 300px !important;"><strong class="profilelbl">I can help you with (50 words): </strong></td>
        <td><?php if(isset($help)) { echo substr($help,0,50) ; ; } else { echo "-NOT SET-"; } ?> </td>
      </tr>
      <tr>
        <td style="min-width: 300px !important;"><strong class="profilelbl">Where can i provide to entrepreneurs: </strong></td>
        <td><?php 
		if(isset($ent_industry)) {            
		
		 $ent_industryId = explode(',',$ent_industry);
		 $i = 0;
		 foreach($ent_industryId as $row)
		 {
			$industryObj=Industry::model()->findbyPk($row);
			if(isset($industryObj->industry_name))
			{
				echo $industryObj->industry_name;	
				if($i<20)
				{
					echo "&nbsp; , &nbsp;";
				}
			}
			if($i == 20)
			{
				break ;
			}
			$i++;
		 }
		
		} else { echo "-NOT SET-"; } ?></td>
      </tr>
      <tr>
        <td style="min-width: 350px !important;"><strong class="profilelbl">Years of mentorship/consultancy experience: </strong></td>
        <td><?php if(isset($mentorship_experience)) { echo $mentorship_experience ; } else { echo "-NOT SET-"; } ?></td>
      </tr>
      <tr>
        <td><strong class="profilelbl">Interested in advising: </strong></td>
        <td><?php 
		if(isset($stage)) { 
		
		 $stagename = explode(',',$stage);
		 foreach($stagename as $row)
		 {
			if($row == 1)
			{
				echo "Idea ; ";	
			}
			if($row == 2)
			{
				echo "Prototype ; ";	
			}
			if($row == 3)
			{
				echo "Pre-revenue ; ";	
			}
			if($row == 4)
			{
				echo "Revenue ; ";	
			}
			if($row == 5)
			{
				echo "Growth ; ";	
			}
			if($row == 6)
			{
				echo "Established ; ";	
			}
			if($row == 0)
			{
				echo "All ; ";	
			}		 
		 }
		
		} else { echo "-NOT SET-"; } ?> </td>
      </tr>
    </table><?php */?>
    
    <table border="0" style="margin:0px; padding:5px; color:#666666;
			  font-size:12px; vertical-align:top; " width="100%">
    	<tr>
        	<td width="28%"><strong class="profilelbl">My Pitch </strong></td>
            <td width="62%" ><?php if(isset($my_pitch)) { echo $my_pitch ; } else { echo "-NOT SET-"; } ?></td>
        </tr>
        
        <tr>
        	<td><strong class="profilelbl">I can help you with </strong>&nbsp;&nbsp;</td>
            <td><?php if(isset($help)) { echo substr($help,0,50) ; ; } else { echo "-NOT SET-"; } ?></td>
        </tr>
        <tr>
        	<td><strong class="profilelbl">Experience with startups/businesses</strong>&nbsp;&nbsp;</td>
            <td><?php if(isset($profileData['startup_experience'])) {  echo $profileData['startup_experience'] ; }else { echo "-NOT SET-";} ?></td>
        </tr>
        
        <tr>
        	<td><strong class="profilelbl">Entrepreneur industries I am interested in</strong></td>
            <td><?php 
		if(isset($ent_industry)) {            
		
		 $ent_industryId = explode(',',$ent_industry);
		 $i = 0;
		 foreach($ent_industryId as $row)
		 {
			$industryObj=Industry::model()->findbyPk($row);
			if(isset($industryObj->industry_name))
			{
				echo $industryObj->industry_name;	
				if($i<20)
				{
					echo ",";
				}
			}
			if($i == 20)
			{
				break ;
			}
			$i++;
		 }
		
		} else { echo "-NOT SET-"; } ?></td>
        </tr>
         <tr>
        	<td><strong class="profilelbl">Years of mentorship experience</strong></td>
            <td><?php echo $mentorship_experience;?></td>
         </tr>  
        <tr>
        	<td><strong class="profilelbl">Interested in advising </strong></td>
            <td><?php 
		if(isset($stage)) { 
		
		 $stagename = explode(',',$stage);
		 foreach($stagename as $row)
		 {
			if($row == 1)
			{
				echo "Idea;";	
			}
			if($row == 2)
			{
				echo "Prototype;";	
			}
			if($row == 3)
			{
				echo "Pre-revenue;";	
			}
			if($row == 4)
			{
				echo "Revenue;";	
			}
			if($row == 5)
			{
				echo "Growth;";	
			}
			if($row == 6)
			{
				echo "Established;";	
			}
			if($row == 0)
			{
				echo "All;";	
			}		 
		 }
		
		} else { echo "-NOT SET-"; } ?></td>
        </tr>
        <tr>
        	<td><strong class="profilelbl">Your motivation to join </strong>&nbsp;&nbsp;</td>
            <td><?php if(isset($motivation)) { echo $motivation ; } else { echo "-NOT SET-"; } ?></td>
        </tr>
        <tr>
        	<td><strong class="profilelbl">Where did you hear about us ? </strong>&nbsp;&nbsp;</td>
            <td><?php if(isset($hearabout)) { echo $hearabout ; } else { echo "-NOT SET-"; } ?></td>
        </tr>
    </table>




	</div>
</center>
</div>

<div style="height:50px;"> 
</div>

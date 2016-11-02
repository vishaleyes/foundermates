<link rel="stylesheet" type="text/css" href="style.css" />
<div class="admincontent">
<h2>Advisor Profile</h2>
     
     <div class="bordertop">
     <hr class="bluethickborder" />
     <hr class="thinborder" style="margin-left: -25px;" />
	</div>
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
    padding-top: 5px;"><img src="<?php echo Yii::app()->params->base_url; ?>images/photo_icon.png" />Personal Details</h3>
	   
        <div class="photo">
         <?php 
		//$file = Yii::app()->params->base_url."assets/upload/avatar/".$row['avatar'] ;
		if( 0 === strpos($profileData['avatar'], 'http') )
		{
			$content = file_get_contents($profileData['avatar']);
			
			if(!empty($content))
			{
				$filePath =  $profileData['avatar'];
			}
			else
			{
				$filePath =  Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url."assets/upload/avatar/image.png";
			}
		}
		else
		{
			
			
			
			if(!empty($profileData['avatar']))
			{
				$filename = "assets/upload/avatar/". $profileData['avatar'] ."";
				if(file_exists($filename))
				{
					$filePath =  Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url."assets/upload/avatar/". $profileData['avatar'] ."&h=65&w=75&q=60&zc=0";
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
        <table style="margin:0px; margin-left:-40px; padding:5px; color:#666666;
			  font-size:12px; vertical-align:top;">
        	<tr>
	    	<td width="24%" align="left"><strong class="profilelbl">Name  </strong></td>
    		<td width="68%" align="left"><?php if(isset($profileData['firstName'])) { echo $profileData['firstName']." ".$profileData['lastName'] ; } else { echo "-NOT SET-"; } ?></td>
  			</tr>
  			<tr>
	    	<td align="left"><strong class="profilelbl">Location  </strong></td>
	    	<td align="left"><?php if(isset($profileData['city'])) { echo $profileData['city'].", ".$profileData['country'] ; } else { echo "-NOT SET-"; } ?></td>
  			</tr>
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
        <?php if(isset($profileData['linkedinLink']) && $profileData['linkedinLink'] != "" ) { ?>
        
        <a target="_blank" href="<?php if(isset($profileData['linkedinLink'])) { echo $profileData['linkedinLink'] ; } ?>" >
        <img src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo Yii::app()->params->base_url; ?>images/linkedin-logo.png&h=50&w=50&q=72&zc=0"  />
        </a>
         
        <?php } ?>
        <?php if($profileData['advisorType'] == 0) { ?>
         <img src="images/expert.png" width="45" height="45" name="expert" id="expert" title="Expert"/>
         <?php } else if($profileData['advisorType'] == 1) { ?>
          <img src="images/mentor.png" width="45" height="45" name="mentor" id="mentor" title="Mentor"/>
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
            <td width="32%" align="left"><strong class="profilelbl">Organisation </strong></td>
            <td width="68%" align="left" ><?php if(isset($profileData['organisation'])) { echo $profileData['organisation'] ; } else { echo "-NOT SET-"; } ?></td>
          </tr>
          <tr>
            <td align="left"><strong class="profilelbl">Work/Title Position<br /> Held </strong></td>
            <td align="left" ><?php if(isset($profileData['work_status'])) { echo $profileData['work_status'] ; } else { echo "-NOT SET-"; } ?></td>
          </tr>
          <tr>
            <td  align="left"><strong class="profilelbl">Skills </strong></td>
            <td align="left"><?php if(isset($profileData['area_of_expertise'])) { echo $profileData['area_of_expertise'] ; } else { echo "-NOT SET-"; } ?></td>
          </tr>
          <tr>
            <td align="left"><strong class="profilelbl">Industry </strong></td>
            <td align="left"><?php if(isset($profileData['industry_name'])) { echo $profileData['industry_name'] ; } else { echo "-NOT SET-"; } ?> </td>
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
        	<td width="28%"><strong class="profilelbl">My Pitch  </strong></td>
            <td width="62%" ><?php if(isset($profileData['my_pitch'])) { echo $profileData['my_pitch'] ; } else { echo "-NOT SET-"; } ?></td>
        </tr>
        
        <tr>
        	<td><strong class="profilelbl">I can help you with  </strong></td>
            <td><?php if(isset($profileData['help'])) { echo substr($profileData['help'],0,250); } else { echo "-NOT SET-"; } ?></td>
        </tr>
        
        <tr>
        	<td><strong class="profilelbl">Entrepreneur industries I am interested in</strong></td>
            <td><?php 
		if(isset($profileData['ent_industry'])) {            
		
		 $ent_industryId = explode(',',$profileData['ent_industry']);
		 $i = 0;
		 foreach($ent_industryId as $row)
		 {
			$industryObj=Industry::model()->findbyPk($row);
			if(isset($industryObj->industry_name))
			{
				echo $industryObj->industry_name;	
				if($i<20)
				{
					echo ",&nbsp;";
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
        	<td><strong class="profilelbl">Key advice to entrepreneurs</strong></td>
            <td><?php if(isset($profileData['startup_experience']) && $profileData['startup_experience'] != "") {  echo $profileData['startup_experience'] ; }else { echo "-NOT SET-";} ?></td>
         </tr>
         <tr>
        	<td><strong class="profilelbl">Years of mentorship experience</strong></td>
            <td><?php echo $profileData['mentorship_experience'];?></td>
         </tr>   
        <tr>
        	<td><strong class="profilelbl">Interested in advising </strong></td>
            <td><?php 
		if(isset($profileData['stage'])) { 
		
		 $stagename = explode(',',$profileData['stage']);
		 foreach($stagename as $row)
		 {
			if($row == 1)
			{
				echo "Idea; ";	
			}
			if($row == 2)
			{
				echo "Prototype; ";	
			}
			if($row == 3)
			{
				echo "Pre-revenue; ";	
			}
			if($row == 4)
			{
				echo "Revenue; ";	
			}
			if($row == 5)
			{
				echo "Growth; ";	
			}
			if($row == 6)
			{
				echo "Established; ";	
			}
			if($row == 0)
			{
				echo "All; ";	
			}		 
		 }
		
		} else { echo "-NOT SET-"; } ?></td>
        </tr>
    </table>




	</div>
   
    <div class="per_det" style="width: 98% !important; float:left;">
    <?php
		
			$reviewObj = new Reviews();
			$rate = $reviewObj->getAverageRating($profileData['user_id']);
		?>	
        
    <h3  style="
    background-color: #10BEF8;
    height: 33px;
    margin: 0 0 10px -10px;
    padding-bottom: 0;
    padding-left: 10px;
    font-size:26px;
    color:#FFF;
    padding-top: 5px;"><img src="<?php echo Yii::app()->params->base_url; ?>images/photo_icon.png" /> Rating &amp; Reviews by Entrepreneurs  <div class="" style="float:right; margin-top:-7px;">
		<?php if($rate >= 0.1 and $rate <= 0.5)  { ?>
        <div id="ratingstars" style="background-color: transparent !important;" class="onestar"></div>
        
    	
        <?php }else if($rate >= 0.6 and $rate <= 1.5)  { ?>
        <div id="ratingstars" style="background-color: transparent !important;" class="twostar"></div>
        
    	
        
        <?php }else if($rate >= 1.6 and $rate <= 2.0)  { ?>
        <div id="ratingstars" style="background-color: transparent !important;" class="threestar"></div>
        
    	
		<?php  }elseif($rate >= 2.1 and $rate <= 2.5)  { ?>
        <div id="ratingstars" style="background-color: transparent !important;" class="fourstar"></div>
        
    	
    	
		<?php }elseif($rate >= 2.6 and $rate <= 3)  { ?>
        <div id="ratingstars" style="background-color: transparent !important;" class="fivestar"></div>
        
    	
        <?php }else {  ?>
         <div id="ratingstars" style="background-color: transparent !important;" class="zerostar"></div>
        
    	
        <?php }
		$rate = 0;
		 ?>
       </div><div class="" style="float:right;font-size: 15px;
    margin-top: 4px;">Overall Rating :</div></h3>
     
		<div>
	   	<?php /*?>  <div class="photo">
         <?php 
		//$file = Yii::app()->params->base_url."assets/upload/avatar/".$row['avatar'] ;
		if( 0 === strpos($row['EntImage'], 'http') )
		{
			$filePath =  $row['EntImage'];	
		}
		else
		{
			$filePath =  Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url."assets/upload/avatar/". $row['EntImage'] ."&h=100&w=100&q=60&zc=0";
		}
		
		if($row['EntImage'] != "" ){ ?>
	        <img src="<?php echo $filePath; ?>" style="width:100px; height:100px;" /> 
        <?php }else {  ?>
	         <img src="<?php echo Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url ;?>assets/upload/avatar/image.png&h=100&w=100&q=60&zc=0" />
        <?php } ?>
        </div><?php */?>
	  	<div class="details">
        <?php  $i=1;
		$cnt = count($data['messages']);
		if($cnt>0){
			
	foreach ($data['messages'] as $row) {  ?>
       	<?php
		
			$reviewObj = new Reviews();
			$rate = $reviewObj->getAverageRating($row['advisor_id']);
		?>	
       	 <table style="margin:0px; margin-left:-400px; margin-bottom: 50px; padding:5px; color:#666666;
			  font-size:12px; vertical-align:top;">
        	<tr>
	    	<td width="4%"  rowspan="2" align="right" valign="top">
            	
        
        <?php 
		//$file = Yii::app()->params->base_url."assets/upload/avatar/".$row['avatar'] ;
		if( 0 === strpos($row['EntImage'], 'http') )
		{
			$content = file_get_contents($row['EntImage']);
			
			if(!empty($content))
			{
				$filePath =  $row['EntImage'];
			}
			else
			{
				$filePath =  Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url."assets/upload/avatar/image.png";
			}
		}
		else
		{
			
			
			
			if(!empty($row['EntImage']))
			{
				$filename = "assets/upload/avatar/". $row['EntImage'] ."";
				if(file_exists($filename))
				{
					$filePath =  Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url."assets/upload/avatar/". $row['EntImage'] ."&h=65&w=75&q=60&zc=0";
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
        
            </td>
    		<td width="68%" align="left" style="color:#10BEF8; font-size:16px; vertical-align:top !important; height:5% !important"><b><a href="<?php echo $row['EntlinkedinLink'];?>" style="color:#10BEF8;" target="_blank"><?php if(isset($row['EntFirstName'])) { echo $row['EntFirstName']." ".$row['EntLastName'] ; } else { echo "-NOT SET-"; } ?></a></b></td>
  			</tr>
  			<tr>
	    	<td align="left" style="width: 100%;
min-width: 910px;
text-align: justify; vertical-align:top !important;"><?php if(isset($row['expertise_area'])) { echo "I endorse advisor in : ".$row['expertise_area']; } else { echo ""; } ?><br/><?php if(isset($row['advisor_experience'])) { echo $row['advisor_experience']; } else { echo "-NOT SET-"; } ?>
			<br />
              <div class="" style="margin-top:10px;">
				<?php if($rate >= 0.1 and $rate <= 0.5)  { ?>
                <div id="ratingstars" class="onestar"></div>
                
                
                <?php }else if($rate >= 0.6 and $rate <= 1.5)  { ?>
                <div id="ratingstars" class="twostar"></div>
                
                
                
                <?php }else if($rate >= 1.6 and $rate <= 2.0)  { ?>
                <div id="ratingstars" class="threestar"></div>
                
                
                <?php  }elseif($rate >= 2.1 and $rate <= 2.5)  { ?>
                <div id="ratingstars" class="fourstar"></div>
                
                
                
                <?php }elseif($rate >= 2.6 and $rate <= 3)  { ?>
                <div id="ratingstars" class="fivestar"></div>
                
                
                <?php }else {  ?>
                 <div id="ratingstars" class="zerostar"></div>
                
                
                <?php }
		$rate = 0;
		 ?>
       </div>  
				</td>
  			</tr>
          <?php /*?>  <tr>
	    		<td align="left" colspan="2" style="padding-left:120px;">
           
            </td>
  			</tr><?php */?>
	    </table>
         <?php } ?>  
         <?php 
		if($cnt > 0 && $data['pagination']->getItemCount()  > $data['pagination']->getLimit()){?>  
		<div class="pagination" > <?php $extraPaginationPara='&keyword='.$ext['keyword'].'&sortBy='.$ext['sortBy'].'&startdate='.$ext['startdate'].'&enddate='.$ext['enddate'];
		$this->widget('application.extensions.WebPager',
						 array('cssFile'=>false,
								'pages' => $data['pagination'],
								'id'=>'link_pager',
		));
		?>	
		</div>
    <?php } ?>
     	</div>
		</div>
     
      
	<div>
<?php } else { ?>
    	<h3>Reviews not found.</h3>
	<?php } ?>
   
</div>

	
    </div>
      
</center>
</div>

<div style="height:180px;"> 
</div>

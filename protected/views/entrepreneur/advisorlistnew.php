<script>
function searchBy()
{
	$j("#loaderDiv").css("display","block");
	var sortBy = $j("#sorting option:selected").val();
	var country = $j("#country option:selected").val();
	var industry = $j("#industry option:selected").val();
	var area_of_expertise = $j("#area_of_expertise option:selected").val();
	var mentorship_experience = $j("#mentorship_experience option:selected").val();
	var advisorType = $j("#advisorType option:selected").val();
	//alert(mentorship_experience);
	var city = $j("#city").val();
	var keyword = $j("#keyword").val();
	
	$j.ajax({
		type: 'POST',
		url: '<?php echo Yii::app()->params->base_path;?>entrepreneur/getAdvisorList',
		data: 'sortBy='+sortBy+'&country='+country+'&industry='+industry+'&area_of_expertise='+area_of_expertise+'&city='+city+'&mentorship_experience='+mentorship_experience+'&advisorType='+advisorType+'&keyword='+keyword,
		
		cache: false,
		
		success: function(data)
		{
			$j("#content").html(data);
			
			setTimeout(function() { $j("#update-message").fadeOut();}, 10000 );
			$j("#loaderDiv").css("display","none");
		}
	});	
}
</script>
<section class="admincontent">	
	 <h2>Advisor List</h2>
     
     <div class="bordertop">
     <hr class="bluethickborder" />
     <hr class="thinborder" />
	</div>
   <div class="tab-wrapper">
      <input type="text"  name="keyword" class="whitetextsmall" id="keyword" value="<?php if(isset($ext['keyword'])) {echo $ext['keyword'] ; } ?>"  onblur="searchBy();" />
                  <input type="button" class="btnblue searchblue" value="Search" onclick="searchBy();"  />
                  <br/><br/><br />
      <ul class="tab-wrapper" style="min-height: 400px;" id="tab-menu-noline">
         <li>
        <label> Country</label>                 
            <select class="listselect whitetextsmall"  id="country" name="country" onchange="searchBy();">
                <option value="">-- Please Select Country --</option>
                <option value="India" <?php if(isset($ext['country']) && $ext['country'] == "India") { echo "selected" ; } ?>  >India</option>
                <option value="United Kingdom" <?php if(isset($ext['country']) && $ext['country'] == "United Kingdom") { echo "selected" ; } ?> >United Kingdom</option>
            </select>
        </li>
         <li>
         <label>City</label>  <br/>               
             <input type="text" class="whitetextsmall"  name="city" id="city" value="<?php if(isset($ext['city'])) {echo $ext['city'] ; } ?>"  onblur="searchBy();"  />
         </li><br />	
         <li>
         <label>Industry</label>                 
                <select class="listselect whitetextsmall" id="industry" name="industry" onchange="searchBy();" >
                    <option value="">-- Please Select Industry --</option>
                    <?php foreach ($industryData as $row ) { ?>
                    <option value="<?php echo $row['industry']; ?>"  <?php if(isset($ext['industry']) && $ext['industry'] == $row['industry'] ) { echo "selected" ; } ?>><?php echo $row['industry_name']; ?></option>
                    <?php } ?>
                </select>
         </li>
         <li>
         <label>Expertise Area</label>  
         <?php
		 
		 $expertiseObj = new ExpertiseAreas();
		 $expertiseData = $expertiseObj->getExpertiseList();
		 
		 ?>               
                <select class="listselect whitetextsmall" id="area_of_expertise" name="area_of_expertise" onchange="searchBy();">
                    <option value="">Please select area of expertise...</option>
                        <?php foreach ($expertiseData as $row ) { ?>
                        <option value="<?php echo $row['area_of_expertise']; ?>" <?php if(isset($ext['area_of_expertise']) && $ext['area_of_expertise'] == $row['area_of_expertise'] ) { echo "selected" ; } ?>><?php echo $row['area_of_expertise']; ?></option>
                        <?php } ?>
                </select>
         </li>
         <li>
         <label>Years of Experience</label>
                       
                        <select name="mentorship_experience" id="mentorship_experience" style="width:167px;" onchange="searchBy();" class="validate[required]" >
                    	<option value="">
                        	-- Please Select --
                        </option>
                        <option <?php if(isset($ext['mentorship_experience']) && $ext['mentorship_experience'] == "< 5") { echo "selected" ; } ?>   value="< 5">< 5</option>
                        <option <?php if(isset($ext['mentorship_experience']) && $ext['mentorship_experience'] == "5 - 10") { echo "selected" ; } ?> value="5 - 10">5 - 10</option>
                        <option <?php if(isset($ext['mentorship_experience']) && $ext['mentorship_experience'] == "10") { echo "selected" ; } ?> value="10">10 +</option>
                    </select>
                      <?php /*?> <input type="text"  name="mentorship_details" id="mentorship_details" value="<?php if(isset($ext['mentorship_details'])) {echo $ext['mentorship_details'] ; } ?>" class="whitetextsmall select-col5" style=" margin-bottom:10px;"  onblur="searchBy();" /><?php */?>
         </li>
        <li>
         <label>Expert/Mentor</label>
                       
                        <select name="advisorType" id="advisorType" style="width:167px;" onchange="searchBy();" class="validate[required]" >
                    	<option value="">
                        	-- Please Select --
                        </option>
                        <option <?php if(isset($ext['advisorType']) && $ext['advisorType'] == "0") { echo "selected" ; } ?>   value="0">Expert</option>
                        <option <?php if(isset($ext['advisorType']) && $ext['advisorType'] == "1") { echo "selected" ; } ?> value="1">Mentor</option>
                       
                    </select>
                      
         </li>
      </ul>
       <figure class="sortby" style="margin-top:-130px; margin-left:770px !important ;">	            
          <label>Sort By :</label>                 
              <select id="sorting" name="sorting" onchange="searchBy();" class="whitetextsmall">
                  <option value="">-- Please Select --</option>
                  <option value="a.createdAt" <?php if(isset($ext['sortBy']) && $ext['sortBy'] == "a.createdAt") { echo "selected" ; } ?> >Recently joined</option>
                  <?php /*?><option value="startup_experience" <?php if(isset($ext['sortBy']) && $ext['sortBy'] == "startup_experience") { echo "selected" ; } ?> >Startup experience</option><?php */?>
                  <?php /*?><option value="mentorship_experience" <?php if(isset($ext['sortBy']) && $ext['sortBy'] == "mentorship_experience") { echo "selected" ; } ?> >Mentorship experience</option><?php */?>
                  <option value="rating" <?php if(isset($ext['sortBy']) && $ext['sortBy'] == "rating") { echo "selected" ; } ?> >Highest Rating</option>
              </select>
              </figure>	
      <div class="tab-content margintabcontent">
     	<table class="listing" style="vertical-align:middle;">
   <?php
   $cnt = $data['pagination']->itemCount;
	if($cnt>0){
    $i=1;
	if(isset($data)) { 
   foreach ($data['advisors'] as $row ) {  ?>
   	<?php 
		$reviewObj = new Reviews();
		$rate = $reviewObj->getAverageRating($row['user_id']);
	?>	
	<tr class="rowborder">
    	<td style="width:10%;">
         <?php 
		 
		//$file = Yii::app()->params->base_url."assets/upload/avatar/".$row['avatar'] ;
		
		
		if( 0 === strpos($row['avatar'], 'http') )
		{
			
			$content = file_get_contents($row['avatar']);
			
			if(!empty($content))
			{
				$filePath =  $row['avatar'];
			}
			else
			{
				$filePath =  Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url."assets/upload/avatar/image.png";
			}
		}
		else
		{
			
			if(!empty($row['avatar']))
			{
				$filename = "assets/upload/avatar/". $row['avatar'] ."";
				if(file_exists($filename))
				{
					$filePath =  Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url."assets/upload/avatar/". $row['avatar'] ."&h=65&w=75&q=60&zc=0";
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
		}?>
		
       
        <img src="<?php echo $filePath; ?>" style="width:75px; height:65px;" />
      
        <?php 
		 $alogObj = new Algoencryption();
		?>
        </td>
        <td colspan="5" class="advisordetails" style=" width:57%;"><a style="color:#10BEF8;" href="<?php echo Yii::app()->params->base_path ?>entrepreneur/showAdvisorProfile/userId/<?php echo $alogObj->encrypt($row['user_id'])  ; ?>" ><font class="advname"><?php echo $row['firstName']."&nbsp;".$row['lastName'] ; ?></font></a><br />
       <?php  //if(isset($row['tagline']) && $row['tagline'] != '') { echo $row['tagline']."<br />" ; }  ?> 
       
        <?php  //echo "<b>Industries :  </b>".$row['industry_name'] ; ?>
         <?php  //echo "<b>Location :  </b>".$row['city'] ; ?> <?php  //echo $row['country'] ; ?>
        <?php /*?> <?php  echo "<b>My Pitch :  </b>".$row['my_pitch'] ; ?><br /><?php */?>
         <?php  echo '" '.$row['my_pitch'].' "' ; ?><br />
         <?php  echo "<b>Skills :  </b>".$row['area_of_expertise'] ; ?><br />
        
       	</td>
        <td style="padding:20px; " class="lastcolumn">
        <div class="ratingadvisor">
        <?php 
			$algoObj =  new Algoencryption();
			
		?>
		<?php if($rate >= 0.1 and $rate <= 0.5)  { ?>
        <div id="ratingstars" class="onestar"></div>
        <a href="<?php echo Yii::app()->params->base_path;?>entrepreneur/requestAdvice/userId/<?php echo $algoObj->encrypt($row['user_id']);?>/firstName/<?php echo $row['firstName']; ?>/lastName/<?php echo $row['lastName']; ?>"><span>Request Advice</span></a>
    	
        <?php }else if($rate >= 0.6 and $rate <= 1.5)  { ?>
        <div id="ratingstars" class="twostar"></div>
        <a href="<?php echo Yii::app()->params->base_path;?>entrepreneur/requestAdvice/userId/<?php echo $algoObj->encrypt($row['user_id']);?>/firstName/<?php echo urlencode($row['firstName']); ?>/lastName/<?php echo urlencode($row['lastName']); ?>"><span>Request Advice</span></a>
    	
        
        <?php }else if($rate >= 1.6 and $rate <= 2.0)  { ?>
        <div id="ratingstars" class="threestar"></div>
        <a href="<?php echo Yii::app()->params->base_path;?>entrepreneur/requestAdvice/userId/<?php echo $algoObj->encrypt($row['user_id']);?>/firstName/<?php echo $row['firstName']; ?>/lastName/<?php echo $row['lastName']; ?>"><span>Request Advice</span></a>
    	
		<?php  }elseif($rate >= 2.1 and $rate <= 2.5)  { ?>
        <div id="ratingstars" class="fourstar"></div>
        <a href="<?php echo Yii::app()->params->base_path;?>entrepreneur/requestAdvice/userId/<?php echo $algoObj->encrypt($row['user_id']);?>/firstName/<?php echo html_entity_decode($row['firstName']); ?>/lastName/<?php echo html_entity_decode($row['lastName']); ?>"><span>Request Advice</span></a>
    	
    	
		<?php }elseif($rate >= 2.6 and $rate <= 3)  { ?>
        <div id="ratingstars" class="fivestar"></div>
        <a href="<?php echo Yii::app()->params->base_path;?>entrepreneur/requestAdvice/userId/<?php echo $algoObj->encrypt($row['user_id']);?>/firstName/<?php echo html_entity_decode($row['firstName']); ?>/lastName/<?php echo html_entity_decode($row['lastName']); ?>"><span>Request Advice</span></a>
    	
        <?php }else {  ?>
         <div id="ratingstars" class="zerostar"></div>
        <a href="<?php echo Yii::app()->params->base_path;?>entrepreneur/requestAdvice/userId/<?php echo $algoObj->encrypt($row['user_id']);?>/firstName/<?php echo urlencode($row['firstName']); ?>/lastName/<?php echo urlencode($row['lastName']); ?>"><span>Request Advice</span></a>
    	
        <?php }
		$rate = 0;
		 ?>
       </div>  
    </td>
    </tr>
    <?php } } }else{  ?>
    <tr>
    	<td><b>Unfortunately, we do not have any advisor who matches your criteria. We will try to help you as soon as possible</b></td>
    </tr>
    <?php } ?>
   
    </table>
    <div id="loaderDiv" style="display:none;">
    	<img src="images/loader.gif" style="margin-left: -185px;position: absolute;top: -75px;" />
     </div>
     <div>
		 <?php
         if($cnt > 0 && $data['pagination']->getItemCount()  > $data['pagination']->getLimit()){?>
             <div class="pagination">
             <?php 
             $extraPaginationPara='&keyword='.$ext['keyword'].'&sortBy='.$ext['sortBy'].'&country='.$ext['country'].'&city='.$ext['city'].'&industry='.$ext['industry'].'&area_of_expertise='.$ext['area_of_expertise'].'&mentorship_experience='.$ext['mentorship_experience'].'&advisorType='.$ext['advisorType'];
             $this->widget('application.extensions.WebPager',
                             array('cssFile'=>Yii::app()->params->base_url.'css/style.css',
                                     'extraPara'=>$extraPaginationPara,
                                    'pages' => $data['pagination'],
                                    'id'=>'link_pager',
            ));
         ?>	
         </div>
         <?php  
         }?>
    </div>
   
      </div>
    </div>
</section>


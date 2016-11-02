<script>
function sortingBy()
{
	var sortBy = $j("#sorting option:selected").val();
	$j.ajax({
		type: 'POST',
		url: '<?php echo Yii::app()->params->base_path;?>entrepreneur/getAdvisorList',
		data: 'sortBy='+sortBy,
		cache: false,
		success: function(data)
		{
			$j("#content").html(data);
			
			setTimeout(function() { $j("#update-message").fadeOut();}, 10000 );
		}
	});	
}
</script>
<section class="admincontent" id="admincontent">	
	 <h2>Advisor List</h2>
     
     <div class="bordertop">
     <hr class="bluethickborder" />
     <hr class="thinborder" />
	</div>
 
    <figure class="signuparea">
    
     <?php echo CHtml::beginForm(Yii::app()->params->base_path.'entrepreneur/getAdvisorList','post',array('id' => 'advisorsearch','name' => 'advisorsearch')) ?>

                <fieldset>
                
                    <figure  class="select-col1">
                    <label><font class="requiredorange">*</font> Country</label>                 
                    <select id="country" name="country">
                    	<option value="">-- Please Select Country --</option>
                        <option value="India" <?php if(isset($ext['country']) && $ext['country'] == "India") { echo "selected" ; } ?>  >India</option>
                        <option value="United Kingdom" <?php if(isset($ext['country']) && $ext['country'] == "United Kingdom") { echo "selected" ; } ?> >United Kingdom</option>
                    </select>
                    </figure>
                     <figure  class="select-col2">
                    <label><font class="requiredorange">*</font> City</label>                 
                    <input type="text" name="city" id="city" value="<?php if(isset($ext['city'])) {echo $ext['city'] ; } ?>"  style="margin-left:-380px; width:110px;"   />
                    </figure>
                     <figure  class="select-col3">
                    <label><font class="requiredorange">*</font> Industry</label>                 
                    <select id="industry" name="industry" >
                    	<option value="">-- Please Select Industry --</option>
                        <?php foreach ($industryData as $row ) { ?>
                        <option value="<?php echo $row['industry']; ?>"  <?php if(isset($ext['industry']) && $ext['industry'] == $row['industry'] ) { echo "selected" ; } ?>><?php echo $row['industry_name']; ?></option>
						<?php } ?>
                    </select>
                    </figure>
                     <figure  class="select-col4">
                    <label><font class="requiredorange">*</font>Expertise Area</label>                 
                    <select id="area_of_expertise" name="area_of_expertise">
                    	<option value="">-- Please Select --</option>
                        <option value="marketing" <?php if(isset($ext['area_of_expertise']) && $ext['area_of_expertise'] == "marketing") { echo "selected" ; } ?>  >marketing</option>
                        <option value="finance" <?php if(isset($ext['area_of_expertise']) && $ext['area_of_expertise'] == "finance") { echo "selected" ; } ?> >finance</option>
                        <option value="strategy" <?php if(isset($ext['area_of_expertise']) && $ext['area_of_expertise'] == "strategy") { echo "selected" ; } ?>  >strategy</option>
                        <option value="business development" <?php if(isset($ext['area_of_expertise']) && $ext['area_of_expertise'] == "business development") { echo "selected" ; } ?> >business development</option>
                        <option value="industry know-how" <?php if(isset($ext['area_of_expertise']) && $ext['area_of_expertise'] == "industry know-how") { echo "selected" ; } ?>  >industry know-how</option>
                        <option value="social capital" <?php if(isset($ext['area_of_expertise']) && $ext['area_of_expertise'] == "social capital") { echo "selected" ; } ?> >social capital</option>
                         <option value="design" <?php if(isset($ext['area_of_expertise']) && $ext['area_of_expertise'] == "design") { echo "selected" ; } ?>  >design</option>
                        <option value="Technical development" <?php if(isset($ext['area_of_expertise']) && $ext['area_of_expertise'] == "Technical development") { echo "selected" ; } ?> >Technical development</option>
                        <option value="Intellectual Property" <?php if(isset($area_of_expertise) && $area_of_expertise == "Intellectual Property") { echo "selected" ; } ?>  >Intellectual Property</option>
                        <option value="HR" <?php if(isset($ext['area_of_expertise']) && $ext['area_of_expertise'] == "HR") { echo "selected" ; } ?> >HR</option>
                        <option value="Personal development" <?php if(isset($ext['area_of_expertise']) && $ext['area_of_expertise'] == "Personal development") { echo "selected" ; } ?>  >Personal development</option>
                    </select>
                    </figure>
                     <figure  class="select-col5">
                   <label><font class="requiredorange">*</font> No. of Years of<br />Experience</label>                   <input type="text" name="mentorship_details" id="mentorship_details" value="<?php if(isset($ext['mentorship_details'])) {echo $ext['mentorship_details'] ; } ?>" class="select-col5" style=" width:110px; margin-left:-180px;" />
                    </figure>
                     <figure  class="select-col6">
                     <label style="margin-left:150px;"><font class="requiredorange">*</font>Keyword Search</label>
                  <input type="text" name="keyword" id="keyword" value="<?php if(isset($ext['keyword'])) {echo $ext['keyword'] ; } ?>" class="select-col6"  />
                  <input type="submit" class="btnorange searchorange" value="Search" />
                  </figure>
                </fieldset>
                
            <?php echo CHtml::endForm();?>
       
            <figure class="sortby">	            
          <label>Sort By :</label>                 
              <select id="sorting" name="sorting" onchange="sortingBy();">
                  <option value="">-- Please Select --</option>
                  <option value="a.createdAt" <?php if(isset($ext['sortBy']) && $ext['sortBy'] == "a.createdAt") { echo "selected" ; } ?> >Recently joined</option>
                  <option value="startup_experience" <?php if(isset($ext['sortBy']) && $ext['sortBy'] == "startup_experience") { echo "selected" ; } ?> >Startup experience</option>
                  <option value="mentorship_experience" <?php if(isset($ext['sortBy']) && $ext['sortBy'] == "mentorship_experience") { echo "selected" ; } ?> >Mentorship experience</option>
                  <option value="rating" <?php if(isset($ext['sortBy']) && $ext['sortBy'] == "rating") { echo "selected" ; } ?> >Highest Rating</option>
              </select>
              </figure>	
     </figure> 
   
<table class="listing" style="vertical-align:middle;">
   <tr>
   		<th>&nbsp;</th>
        <th>&nbsp;</th>
        <th class="alignLeft">CITY, COUNTRY</th>
        <th>EXPERTISE AREA</th>
        <th>INDUSRTY</th>
        <th >NO OF YEARS OF EXP</th>
        <th class="lastcolumn">&nbsp;</th>
        
        
   </tr>
   <tr>
   <?php
   $cnt = $data['pagination']->itemCount;
	if($cnt>0){
    $i=1;if(isset($data)) { 
   foreach ($data['advisors'] as $row ) {  ?>
   	<?php 
		
		$reviewObj = new Reviews();
		$rate = $reviewObj->getAverageRating($row['user_id']);
		
	?>	
	<tr>
    	<td>
       
        <?php 
		//$file = Yii::app()->params->base_url."assets/upload/avatar/".$row['avatar'] ;
		if($row['avatar'] != "" ){ 
		?>
        <img src="<?php echo Yii::app()->params->base_url ;?>assets/upload/avatar/<?php  echo $row['avatar'] ; ?>" style="width:75px; height:65px;" />
        <?php } else { ?>
        <img src="images/image.png" />
        <?php } ?>
        </td>
        <td><?php echo $row['firstName']."&nbsp;".$row['lastName'] ; ?></td>
        <td><?php  echo $row['city'] ; ?>&nbsp;,&nbsp; <?php  echo $row['country'] ; ?></td>
         <td><?php  echo $row['area_of_expertise'] ; ?></td>
        <td ><?php  echo $row['mentorship_details'] ; ?></td>
        <td><?php  echo $row['mentorship_details'] ; ?></td>
        <td style="padding:20px;" class="lastcolumn"><div class="ratingadvisor">
        <?php 
			$algoObj =  new Algoencryption();
			
		?>
    	<?php if($rate >= 0.1 and $rate <= 0.5)  { ?>
        <div id="ratingstars" class="onestar"></div>
        <a href="<?php echo Yii::app()->params->base_path;?>entrepreneur/requestAdvice/userId/<?php echo $algoObj->decrypt($row['user_id']);?>/firstName/<?php echo $row['firstName']; ?>/lastName/<?php echo $row['lastName']; ?>"><span>Request Advice</span></a>
    	</div>
        <?php }else if($rate >= 0.6 and $rate <= 1.5)  { ?>
        <div id="ratingstars" class="twostar"></div>
        <a href="<?php echo Yii::app()->params->base_path;?>entrepreneur/requestAdvice/userId/<?php echo $algoObj->decrypt($row['user_id']);?>/firstName/<?php echo $row['firstName']; ?>/lastName/<?php echo $row['lastName']; ?>"><span>Request Advice</span></a>
    	</div>
        
        <?php }else if($rate >= 1.6 and $rate <= 2.0)  { ?>
        <div id="ratingstars" class="threestar"></div>
        <a href="<?php echo Yii::app()->params->base_path;?>entrepreneur/requestAdvice/userId/<?php echo $algoObj->decrypt($row['user_id']);?>/firstName/<?php echo $row['firstName']; ?>/lastName/<?php echo $row['lastName']; ?>"><span>Request Advice</span></a>
    	</div>
		<?php  }elseif($rate >= 2.1 and $rate <= 2.5)  { ?>
        <div id="ratingstars" class="fourstar"></div>
        <a href="<?php echo Yii::app()->params->base_path;?>entrepreneur/requestAdvice/userId/<?php echo $algoObj->decrypt($row['user_id']);?>/firstName/<?php echo $row['firstName']; ?>/lastName/<?php echo $row['lastName']; ?>"><span>Request Advice</span></a>
    	</div>
    	
		<?php }elseif($rate >= 2.6 and $rate <= 3)  { ?>
        <div id="ratingstars" class="fivestar"></div>
        <a href="<?php echo Yii::app()->params->base_path;?>entrepreneur/requestAdvice/userId/<?php echo $algoObj->decrypt($row['user_id']);?>/firstName/<?php echo $row['firstName']; ?>/lastName/<?php echo $row['lastName']; ?>"><span>Request Advice</span></a>
    	</div>
        <?php }else {  ?>
         <div id="ratingstars" class="onestar"></div>
        <a href="<?php echo Yii::app()->params->base_path;?>entrepreneur/requestAdvice/userId/<?php echo $algoObj->decrypt($row['user_id']);?>/firstName/<?php echo $row['firstName']; ?>/lastName/<?php echo $row['lastName']; ?>"><span>Request Advice</span></a>
    	</div>
        <?php }
		$rate = 0;
		 ?>
    </td>
       
        
        
    </tr>
    
    	
    
  
    
  
    <?php  $i++;} } ?>
    
    <?php 
    }else{?>
        <tr>
            <td ><b>Unfortunately, we do not have any advisor who matches your criteria. Please let us know via the feedback button what you are looking for and we will try to help you as soon as possible</b></td>
        </tr>
        <?php
        }?>
    <tr>
    </tr>
    </table>
      <div>
		 <?php
         if($cnt > 0 && $data['pagination']->getItemCount()  > $data['pagination']->getLimit()){?>
             <div class="pagination">
             <?php 
             $extraPaginationPara='&keyword='.$ext['keyword'].'&sortBy='.$ext['sortBy'].'&country='.$ext['country'].'&city='.$ext['city'].'&industry='.$ext['industry'].'&area_of_expertise='.$ext['area_of_expertise'].'&mentorship_details='.$ext['mentorship_details'];
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
    </figure>
</section>
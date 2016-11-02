<script type="text/javascript" src="<?php echo Yii::app()->params->base_url; ?>js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url; ?>js/jquery.fancybox-1.3.1.js"></script>

<link href="<?php echo Yii::app()->params->base_url; ?>css/jquery.fancybox-1.3.1.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo Yii::app()->params->base_url; ?>css/style.css" type="text/css" />
<script>
	function approveReview()
	{
		var $j = jQuery.noConflict();
		$j.fancybox.close();
		parent.window.location.href="<?php echo Yii::app()->params->base_path;?>admin/approveReview/review_id/<?php echo $review_id ; ?>";
		
		
	}
	
	function deleteReview()
	{
		var $j = jQuery.noConflict();
		$j.fancybox.close();
		parent.window.location.href='<?php echo Yii::app()->params->base_path;?>admin/deleteReview/review_id/<?php echo $review_id ; ?>';
		
	}
</script>
<section class="admincontent">	
<figure class="profiledata">

	 <h2>Review Description</h2>
   <label>From : </label><span><?php echo $entrepreneur ;?></span>  <br/><br/>
   
   <label>Entrepereneur email : </label><span><?php echo $entrepreneur_email ;?></span>  <br/><br/>
   
   <label>To : </label><span><?php echo $advior ;?></span>  <br/><br/>
   
   <label>Advisor email : </label><span><?php echo $advior_email ;?></span>  <br/><br/>
   
   <label>Usefulness of Advice : </label>
   <span>
   <?php if( $usefulness == 0 ) { echo "Poor"; } ?>
   <?php if( $usefulness == 1 ) { echo "Average"; } ?>
   <?php if( $usefulness == 2 ) { echo "Good"; } ?>
   <?php if( $usefulness == 3 ) { echo "Excellent"; } ?>
   </span><br/><br/>
   
   <label>Knowledge of Advisor : </label>
   <span>
   <?php if( $knowledge == 0 ) { echo "Poor"; } ?>
   <?php if( $knowledge == 1 ) { echo "Average"; } ?>
   <?php if( $knowledge == 2 ) { echo "Good"; } ?>
   <?php if( $knowledge == 3 ) { echo "Excellent"; } ?>
   </span><br/><br/>
   
   <label>Timeliness of Advice : </label>
   <span>
   <?php if( $timeliness == 0 ) { echo "Poor"; } ?>
   <?php if( $timeliness == 1 ) { echo "Average"; } ?>
   <?php if( $timeliness == 2 ) { echo "Good"; } ?>
   <?php if( $timeliness == 3 ) { echo "Excellent"; } ?>
   </span><br/><br/>
   
   <label>Would you recommend this advisor to others? : </label>
   <span>
   <?php if( $recommend_other == 0 ) { echo "No"; } ?>
   <?php if( $recommend_other == 1 ) { echo "Neutral"; } ?>
   <?php if( $recommend_other == 2 ) { echo "Recommend"; } ?>
   <?php if( $recommend_other == 3 ) { echo "Strongly recommend"; } ?>
   </span><br/><br/>
   
   <label>Core expertise areas of the Advisor : </label> <br/><span><?php echo $expertise_area ;?></span>  <br/><br/>
   
   <label>Advisor experience : </label> <br/><span><?php echo $advisor_experience ;?></span>  <br/><br/>
   
   <input type="button" class="btnblue" name="approve" id="approve" onclick="approveReview();" value="Approve"/>
  
   <input type="button" class="btnblue" style="margin-left:20px;"  name="approve" id="approve" onclick="deleteReview();" value="Delete"/>
   <br/><br/>
 </figure>
</section>
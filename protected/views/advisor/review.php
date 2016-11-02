<!-- stylesheets -->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->params->base_url;?>css/jquery.fancybox.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url;?>js/jquery.fancybox.js"></script>
<script>
$(".showProfile").fancybox({
		'width' : '1000',
 		'height' : 'auto',
 		'transitionIn' : 'none',
		'transitionOut' : 'none',
		'type':'iframe'
		
 	});
</script>
<div class="admincontent" style="min-height:300px;">	
	<h2>Review List</h2>
      <div class="bordertop">
          <hr class="bluethickborder" />
          <hr class="thinborder" />
	  </div>
      <figure class="signuparea">
       <?php
		
			$reviewObj = new Reviews();
			$rate = $reviewObj->getAverageRating(Yii::app()->session['fmuserId']);
		?>	
        
    <h3 align="left"  style="
    background-color: #10BEF8;
    height: 33px;
    margin: 0 0 10px -10px;
    padding-bottom: 0;
    padding-left: 10px;
    font-size:26px;
    color:#FFF;
    padding-top: 5px;"><img src="<?php echo Yii::app()->params->base_url; ?>images/photo_icon.png" /> Rating &amp; Reviews by Entrepreneurs  <div class="" style="float:right; margin-top:-7px;">
		<?php if($rate >= 0.1 and $rate <= 0.5)  { ?>
        <div id="ratingstars" style="background-color: transparent !important;"  class="onestar"></div>
        
    	
        <?php }else if($rate >= 0.6 and $rate <= 1.5)  { ?>
        <div id="ratingstars" style="background-color: transparent !important;"  class="twostar"></div>
        
    	
        
        <?php }else if($rate >= 1.6 and $rate <= 2.0)  { ?>
        <div id="ratingstars" style="background-color: transparent !important;"  class="threestar"></div>
        
    	
		<?php  }elseif($rate >= 2.1 and $rate <= 2.5)  { ?>
        <div id="ratingstars" style="background-color: transparent !important;"  class="fourstar"></div>
        
    	
    	
		<?php }elseif($rate >= 2.6 and $rate <= 3)  { ?>
        <div id="ratingstars"  style="background-color: transparent !important;" class="fivestar"></div>
        
    	
        <?php }else {  ?>
         <div id="ratingstars" style="background-color: transparent !important;"  class="zerostar"></div>
        
    	
        <?php }
		$rate = 0;
		 ?>
       </div><div class="" style="float:right;font-size: 15px;
    margin-top: 4px;">Overall Rating :</div></h3>
          <table style="margin-top: -10px;" >
          <?php
		  $cnt = $data['pagination']->itemCount;
			if($cnt>0){ 
		  		foreach ($data['entrepreneurs'] as $row ) { 
			
			$reviewObj = new Reviews();
			$rate = $reviewObj->getAverageRating($row['advisor_id']);
		?>	
		  
          <tr>
       <td>
        <figure class="col-1">
            <div class="adminprofileimg" style="margin-left:0px !important;">
             <?php 
		//$file = Yii::app()->params->base_url."assets/upload/avatar/".$row['avatar'] ;
		if( 0 === strpos($row['avatar'], 'http') )
		{
			$filePath =  $row['avatar'];	
		}
		else
		{
			$filePath =  Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url."assets/upload/avatar/". $row['avatar'] ."&h=65&w=65&q=60&zc=0";
		}
		
		if($row['avatar'] != "" ){ 
		?>
        
        <img src="<?php echo $filePath; ?>" /> 
        <?php }else {  ?>
        
         <img src="<?php echo Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url ;?>assets/upload/avatar/image.png&h=65&w=65&q=60&zc=0" />
        <?php } ?>
            <?php $alogObj = new Algoencryption(); ?>
            </div>
            <div class="arrowright"></div>
            <div class="reviewcontent" style="text-align: justify; padding: 10px;">
            <span class="advisorname"><a href="<?php echo Yii::app()->params->base_path;?>advisor/showEntrepreneurProfile/userId/<?php echo $alogObj->encrypt($row['user_id'])  ; ?>" ><?php echo $row['firstName'] ;?>&nbsp;<?php echo $row['lastName'] ;?></a></span>    <div class="" style="float:right;">
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
       </div>  <br/>
            <span><?php echo $row['city'] ;?>,&nbsp;<?php echo $row['country'] ;?></span><br/>
            <span><?php echo date("d-M-Y", strtotime($row['reviewDate']));?></span>
            <blockquote style="height: 0px !important;"></blockquote>
            <span><?php //echo '<img src="'.Yii::app()->params->base_url.'images/quote.gif" />' ?> <?php if(isset($row['expertise_area'])) { echo "I endorse advisor in : ".$row['expertise_area']; } else { echo ""; } ?><br/><?php if(isset($row['advisor_experience'])) { echo $row['advisor_experience']; } else { echo "-NOT SET-"; } ?><?php //echo '<img src="'.Yii::app()->params->base_url.'images/quote_reverse.gif" />' ?></span>
            </div>        
        </figure>
        </td>
        </tr>
        <?php } } else{  ?>
       	<tr>	
        		<td>&nbsp;</td>
        </tr>
       <tr>
            <td align="center" style="color:#838383;">No review found.</td>
        </tr>
        <?php } ?>
        </table>
        <div>
		 <?php
         if($cnt > 0 && $data['pagination']->getItemCount()  > $data['pagination']->getLimit()){?>
             <div class="pagination">
             <?php 
             $extraPaginationPara='keyword='.$ext['keyword'];
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
</div>
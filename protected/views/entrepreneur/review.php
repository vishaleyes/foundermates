<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->params->base_url;?>css/jquery.fancybox.css"/>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url;?>js/jquery.fancybox.js"></script>
<script  type="text/javascript">
function test(id)
{
	$j("#ratingbutton_"+id).attr('href','#inlineent');
	$j("#advisorId").val(id);
}

function closeWindow()
{
	parent.$j.fancybox.close();	
}

</script>
<div style="clear:both;"></div>
<div class="admincontent" style="margin: 50px auto; min-height: 300px;">	
	 <h2>Pending Reviews</h2>
     
     <div class="bordertop">
     <hr class="bluethickborder" />
     <hr class="thinborder" />
	</div>
    <div class="signuparea">

<?php /*?><table style="margin-top: -10px;">
   <tr>
     <?php $i=1;if(isset($data)) { 
   foreach ($data as $row ) { 
   
   if($i%2!=0)
   { ?>
   </tr><tr>
   <?php } ?>
   <td>
    <?php 
	$filePath = Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url."assets/upload/avatar/".$row['avatar']."" ;
    ?>
	<figure class="col-1">
    	<div class="adminprofileimg">
        <?php if($row['avatar'] != "") { ?>
        <img src="<?php echo $filePath;?>" alt="" height="65px"  width="75px" />
        <?php }else { ?>
        <img src="<?php echo Yii::app()->params->base_url;?>images/image.png" alt="" />
        <?php } ?>
        </div>
        <div class="arrowright"></div><div class="adminpersondetails"><strong class="fieldnames">Name:</strong><span> <?php echo $row['firstName']."&nbsp;".$row['lastName'] ; ?></span><br />
        <strong class="fieldnames">Country:</strong><span><?php  echo $row['country'] ; ?></span><br /><strong class="fieldnames">City:</strong><span> <?php echo $row['city']; ?></span><br /><strong class="fieldnames">Expertise Area:</strong><span> <?php echo $row['area_of_expertise'] ; ?></span><br /><strong class="fieldnames">No. of Years of Exp:</strong><span> 6 - 9 Years</span></div>        
    </figure>
    
    <figure class="ratingadvisor reviewbacksize">
        <a href="#" onclick="test('<?php echo $row['advisorID']; ?>');" id="ratingbutton_<?php echo $row['advisorID']; ?>" class="forgotpassorange"><span>Review</span></a>
    </figure>
    </td>
    
    <?php $i++;} } ?> 
    
    </tr>
    
    </table><?php */?>
      <table class="listing reviewtbl" style="vertical-align:middle;">
      
 <?php 
 
 	$cnt = count( $data['advisorList']);
	if($cnt>0) {
   foreach ($data['advisorList'] as $row ) { 
   
   ?> 
   <?php 
	$filePath = Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url."assets/upload/avatar/".$row['avatar']."" ;
    ?>
     <tr class="rowborder">
     <td>
      <?php 
     if( 0 === strpos($row['avatar'], 'http') )
		{
			$filePath =  $row['avatar'];	
		}
		else
		{
			$filePath =  Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url."assets/upload/avatar/". $row['avatar'] ."&h=65&w=75&q=60&zc=0";
		}
       if($row['avatar'] != "") { ?>
        <img src="<?php echo $filePath;?>" alt="" height="65px"  width="75px" />
        <?php }else { ?>
        <img src="<?php echo Yii::app()->params->base_url;?>images/image.png" alt="" />
        <?php }
		 $alogObj = new Algoencryption();
		 ?> 
        </td>
        <td colspan="5" class="advisordetails widthmargin"><a style="color:#10BEF8;" href="<?php echo Yii::app()->params->base_path ?>entrepreneur/showAdvisorProfile/userId/<?php echo $alogObj->encrypt($row['advisorID'])  ; ?>" ><font class="advname"><?php echo $row['firstName']."&nbsp;".$row['lastName'] ; ?></font></a><br />
         <?php echo $row['city']; ?>,<br />
       <?php  echo $row['country'] ; ?>
       <?php echo $row['area_of_expertise'] ; ?>
        </td>
        <td><?php 
		$generalObj = new General();
		echo $generalObj->ago($row['messageDate']); ?></td>
        <td style="padding:20px;" class="lastcolumn"> 
        <figure class="ratingadvisor reviewbacksize">
            <a href="#" onclick="test('<?php echo $row['advisorID']; ?>');" id="ratingbutton_<?php echo $row['advisorID']; ?>" class="forgotpassorange"><span>Review</span></a>
            
        </figure>
     
    </td>
        
    </tr>
     
      
     <?php } 
	 
	 
	}else{ ?> 
  
  	<tr>
    	<td class="msgrow">No pending reviews.</td>
    </tr>
   <?php } ?>
    </table>
    </div>
</div>


<!-- hidden inline form -->
<div id="inlineent">
	<h2 align="center" style="margin-top: -5px; color: #fe8737;">Review of Advisor</h2>
	<form id="contactent" name="contact" action="<?php echo Yii::app()->params->base_path;?>entrepreneur/addRating" method="post">
        <table border="0" cellpadding="5" cellspacing="5" style="margin-top: 0px; margin-left:-10px; text-align:left;">
        <tr>
        <th></th>
        <th>Poor</th>
        <th>Average</th>
        <th>Good</th>
        <th>Excellent</th>
        </tr>
        <tr>
        <td>Usefulness of advice</td>
        <td><input type="radio" name="usefulness" value="0" /></td> 
        <td><input type="radio" name="usefulness" value="1"/></td> 
        <td><input type="radio" name="usefulness" value="2"/></td> 
        <td><input type="radio" name="usefulness" value="3"/></td>        
        </tr>
        <tr>
        <td>Knowledge of advisor</td>
        <td><input type="radio" name="knowledge" value="0"/></td> 
        <td><input type="radio" name="knowledge" value="1"/></td> 
        <td><input type="radio" name="knowledge" value="2"/></td> 
        <td><input type="radio" name="knowledge" value="3"/></td>        
        </tr>
        <tr>
        <td>Timeliness of advice</td>
        <td><input type="radio" name="timeliness" value="0"/></td> 
        <td><input type="radio" name="timeliness" value="1"/></td> 
        <td><input type="radio" name="timeliness" value="2"/></td> 
        <td><input type="radio" name="timeliness" value="3"/></td>        
        </tr>        
        </table>
		<p><label for="email">Would you recommend this advisor to others?</label></p>
		<p>No<input type="radio" name="recommend" value="0"/>   Neutral<input type="radio" name="recommend" value="1"/>   Recommend<input type="radio" name="recommend" value="2"/>   Strongly Recommend<input type="radio" name="recommend" value="3"/></p>
		<p>What do you think are the core expertise areas of the advisor?<input type="text" name="expertisearea" /></p>
        <p>Your comments about your advisor experience</p>
        <p><textarea id="comment" name="comment" cols="38" rows="5"></textarea></p>
        
        <input type="hidden" name="advisorId" id="advisorId" value="" />
		<button class="btnorange submitmargin" type="submit">Submit</button>
        <button class="btnorange cancelmargin" type="button" onclick="closeWindow();">Cancel</button>
	</form>
</div>

<div style="clear:both;"></div>
<!-- basic fancybox setup -->
<script type="text/javascript">
	
	$j(document).ready(function() {
		$j(".forgotpassorange").fancybox();
		$j("#contact").submit(function() { return false; });

		
		
		
	});
</script>


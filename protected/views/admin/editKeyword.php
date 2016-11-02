<script type="text/javascript" src="<?php echo Yii::app()->params->base_url; ?>js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url; ?>js/jquery.fancybox-1.3.1.js"></script>

<link href="<?php echo Yii::app()->params->base_url; ?>css/jquery.fancybox-1.3.1.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo Yii::app()->params->base_url; ?>css/style.css" type="text/css" />

<section class="admincontent">	
<figure class="profiledata">
<br/>
	 <h2>Edit Keyword</h2>
     <form id="keywordForm" method="post" action="<?php echo Yii::app()->params->base_url ; ?>admin/editKeyword"
   <label>Keyword : </label><br/><input readonly="readonly" type="text" name="keyword" id="keyword" value="<?php if(isset($data['keyword']) && $data['keyword'] != "") { echo $data['keyword'] ; } ?>" /><br/>
   
   <label>Similar Word : </label><br/><input type="text" name="similar_word" id="similar_word" value="<?php if(isset($data['similar_word']) && $data['similar_word'] != "") { echo $data['similar_word'] ; } ?>" /><br/>
   
   <input type="hidden" id="id" name="id" value="<?php if(isset($data['id']) && $data['id'] != "") { echo $data['id'] ; } ?>" />
   <input type="submit" class="btnblue" name="submit" id="submit" value="Submit"/>
  
   <input type="button" class="btnblue" style="margin-left:20px;"  name="cancel" id="cancel" onclick="window.history.go(-1);" value="Cancel"/>
   <br/><br/>
 </figure>
</section>
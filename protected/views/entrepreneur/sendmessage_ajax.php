<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->params->base_url;?>css/jquery.fancybox.css"/>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url;?>js/jquery.fancybox.js"></script>
<script type="text/javascript">
	$j("#viewMore").fancybox({
		  'width' : '800',
		   'height' : '600',
		   'transitionIn' : 'none',
		  'transitionOut' : 'none',
		  'type':'iframe'
	  
	  });
	function showMessage(id)
	{
		$j.ajax({
		  type: 'POST',
		  url: '<?php echo Yii::app()->params->base_path;?>entrepreneur/showDraftMessage',
		  data: 'message_id='+id,
		  cache: false,
		  success: function(data)
		  {
		   $j("#tab-content").replaceWith(data);
		  }
		 });
	}
	
	function saveAsDraft()
	{
		var subject = $j("#subject").val();
		var message = $j("#message").val();
		var to = $j("#to").val();
		$j.ajax({
		  type: 'POST',
		  url: '<?php echo Yii::app()->params->base_path;?>entrepreneur/saveAsDraft',
		  data: 'to='+to+'&message='+message+'&subject='+subject,
		  cache: false,
		  success: function(data)
		  {
		   	window.location.href = "<?php echo Yii::app()->params->base_path;?>entrepreneur/messages";
		  }
		 });
	}
	
	function showSentMessage(id)
	{
		$j.ajax({
		  type: 'POST',
		  url: '<?php echo Yii::app()->params->base_path;?>entrepreneur/showSentMessage',
		  data: 'message_id='+id,
		  cache: false,
		  success: function(data)
		  {
		   $j("#tab-content").replaceWith(data);
		  }
		 });
	}
	
	function showInbox()
	{
		$j.ajax({
		  type: 'POST',
		  url: '<?php echo Yii::app()->params->base_path;?>entrepreneur/showInbox',
		  data: '',
		  cache: false,
		  success: function(data)
		  {
		   $j("#tab-content").replaceWith(data);
		  }
		 });
	}
	
	function showSentMail()
	{
		$j.ajax({
		  type: 'POST',
		  url: '<?php echo Yii::app()->params->base_path;?>entrepreneur/showSentMail',
		  data: '',
		  cache: false,
		  success: function(data)
		  {
		    $j("#tab-content").replaceWith(data);
		    $j("#inboxLink").attr('class','');
		    $j("#trashLink").attr('class','');
			$j("#draftLink").attr('class','');
			$j("#composeBtn").attr('class','btnblue');
		    $j("#sentLink").attr('class','selected');
		  }
		 });
	}
	
	function getAdvisorList(id)
	{
		var subject = $j("#subject").val();
		var message = $j("#message").val();
		/*var mId = $j("#message").val();*/
		
		
		$j.ajax({
		  type: 'POST',
		  url: '<?php echo Yii::app()->params->base_path;?>entrepreneur/makeSessionForMessage/',
		  data: 'subject='+subject+'&message='+message+'&message_id='+id,
		  cache: false,
		  success: function(data)
		  {
					
			window.location.href = "<?php echo Yii::app()->params->base_path;?>entrepreneur/getAdvisorList/";

		  }
		 });
		
	}
	
	function validate()
	{
		var subject = $j("#subject").val();
		if(subject == '' || subject == null)
		{
			alert("Please enter subject");
			return false;
			
		}
		var message = $j("#message").val();
		if(message == '' || message == null)
		{
			alert("Please enter message");
			return false;
		}
		
		var to = $j("#to").val();
		if(to == '' || to == null)
		{
			alert("Please select one recepient.");
			return false;
		}
		
		
	}
	
	
	
</script>
  <div class="tab-content msgcontent tabcontentwidth" id="tab-content">
     
     	  <form action="<?php echo Yii::app()->params->base_path;?>entrepreneur/sendMessage" method="post" onsubmit="return validate();">  
        <table width="89%" border="0" cellpadding="5" cellspacing="5" style="margin-top:20px;" class="tblstyle">
            
    		<tr>
            	<td align="right">TO :</td>
                <td><input type="text" name="toEmail" id="toEmail" value="<?php echo $receiverData['firstName'].' '.$receiverData['lastName'];?>" readonly="readonly"  />&nbsp;&nbsp;<a href="#" onclick="getAdvisorList('<?php echo $message['message_id']; ?>');" ><img src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo Yii::app()->params->base_url; ?>images/blue_search_icon.png&h=30&w=30&q=72&zc=0" /></a></td>
            </tr>
            <input type="hidden" name="to" id="to" value="<?php echo $receiverData['id'];?>"  />
            <tr>
            	<td align="right">SUBJECT : </td>
                <td><input type="text" name="subject" id="subject" value="<?php if(isset($message['subject'])) { echo $message['subject']; } ?> "  /></td>
            </tr>
            
            
            <tr>
            	<td align="right">MESSAGE :</td>
                <td><textarea name="message" id="message" cols="50" rows="15"><?php if(isset($message['message'])) { echo htmlspecialchars_decode(html_entity_decode($message['message'])); }  ?></textarea></td>
            </tr>
            
            <tr>
            	<td>&nbsp;</td>
                <td><input type="submit" name="submitmessage" class="btnblue" id="submitmessage" value="Send"  /></td>
            </tr>
            
      </table>
      <input type="hidden" name="mId" id="mId" value="<?php if(isset($message['message_id'])) {  echo $message['message_id']; } ?>"  />
      </form>
       
      </div>
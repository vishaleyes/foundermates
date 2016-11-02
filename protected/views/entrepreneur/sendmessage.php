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
		  url: '<?php echo Yii::app()->params->base_path;?>entrepreneur/showMessage',
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
	
	
	
	function getAdvisorList()
	{
		
		var subject = $j("#subject").val();
		var message = $j("#message").val();
		
		
		
		$j.ajax({
		  type: 'POST',
		  url: '<?php echo Yii::app()->params->base_path;?>entrepreneur/makeComposeSeession',
		  data: 'subject='+subject+'&message='+message,
		  cache: false,
		  success: function(data)
		  {
					
			window.location.href = "<?php echo Yii::app()->params->base_path;?>entrepreneur/getAdvisorListForCompose";

		  }
		 });
		
		
		
	}
	
	function validate()
	{
		var subject = $j("#subject").val();
		var message = $j("#message").val();
		var to = $j("#to").val();
		var toEmail = $j("#toEmail").val();
		
		if(toEmail == null || toEmail == '' || toEmail == 'undefined')
		{
			alert("Please specify at least one recipient.");
			return false;
		}
		if(subject == null || subject == '')
		{
			alert("Please enter the subject.");
			return false;
		}
		if(message == null || message == '')
		{
			alert("Please enter message.");
			return false;
		}
		if(to == null || to == '')
		{
			alert("Please specify at least one recipient.");
			return false;
		}
		return true;
		
	}
	
	
</script>
<section class="admincontent">	
	 <h2>FounderMail</h2>
     
     <div class="bordertop">
     <hr class="bluethickborder" />
     <hr class="thinborder" />
	</div>
   <div class="tab-wrapper">
   <div class="composebg selectedcomposemsg">
                  <input type="button" id="composeBtn"  <?php if(Yii::app()->session['msgTab'] == 'Compose'){  ?> class="btnblue composeblue" <?php } ?>  onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>entrepreneur/sendmessages'"  value="Compose Message" />
    </div>
                  <br/><br/><br />
      <ul id="tab-menu" class="msgsidebar">
       <li id="inboxLink"  onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>entrepreneur/messages'"     <?php if(Yii::app()->session['msgTab'] == 'Inbox'){  ?> class="selected" <?php } ?> >Inbox(<?php echo $unreadCount ; ?>)</li>
         <li id="draftLink" <?php if(Yii::app()->session['msgTab'] == 'Draft'){  ?> class="selected" <?php } ?> onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>entrepreneur/draft'">Draft(<?php echo $draftCount ; ?>)</li>  
         <li id="sentLink" <?php if(Yii::app()->session['msgTab'] == 'Sent'){  ?> class="selected" <?php } ?>  onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>entrepreneur/showSentMail'">Sent</li>
         <li id="trashLink" <?php if(Yii::app()->session['msgTab'] == 'Trash'){  ?> class="selected" <?php } ?>   onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>entrepreneur/trashMessages'">Trash</li>
        
      </ul>
       	
      <div class="tab-content msgcontent tabcontentwidth" id="tab-content">
     
     	  <form action="<?php echo Yii::app()->params->base_path;?>entrepreneur/sendMessage" method="post" id="SendForm">  
        <table width="89%" border="0" cellpadding="5" cellspacing="5" style="margin-top:20px;" class="tblstyle">
            
    		<tr>
            	<td align="right">TO :</td>
                <td><input type="text" name="toEmail" id="toEmail" value="" readonly="readonly"  />&nbsp;&nbsp;<a href="#" onclick="getAdvisorList();" ><img src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo Yii::app()->params->base_url; ?>images/blue_search_icon.png&h=30&w=30&q=72&zc=0" /></a></td>
            </tr>
            <input type="hidden" name="to" id="to" value=""  />
            <tr>
            	<td align="right">SUBJECT :</td>
                <td><input type="text" name="subject" id="subject" value="<?php if(isset($message['subject'])) { echo $message['subject']; }  ?>"  /></td>
            </tr>
            
            
            <tr>
            	<td align="right">MESSAGE :</td>
                <td><textarea name="message" id="message" cols="50" rows="15"></textarea></td>
            </tr>
            
            <tr>
            	<td>&nbsp;</td>
                <td><input  type="button" onclick="validate();"  name="submitmessage" class="btnblue" id="submitmessage" value="Send"  /> <span style="margin-left:28px; top:20px; padding-top:20px; position:relative; "> &nbsp; or &nbsp; <a href="#" style="color:#10BEF8;" onclick="saveAsDraft();">Save as draft</a></span></td>
                <td></td>
            </tr>
            
      </table>
      </form>
       
      </div>
    </div>
</section>
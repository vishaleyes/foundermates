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
		$j("#SendForm").submit();
		$j("#submitmessage").attr("disabled","disabled");
		
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
                  <input type="button" id="composeBtn"   class="btnblue composeblue"   onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>entrepreneur/sendmessages'"  value="Compose Message" />
    </div>
                  <br/><br/><br />
     <ul id="tab-menu" class="msgsidebar">
        <li id="inboxLink"  onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>entrepreneur/messages'"     <?php if(Yii::app()->session['msgTab'] == 'Inbox'){  ?> class="selected" <?php } ?> >Inbox(<?php echo $unreadCount ; ?>)</li>
         <li id="draftLink" <?php if(Yii::app()->session['msgTab'] == 'Draft'){  ?> class="selected" <?php } ?> onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>entrepreneur/draft'">Draft(<?php echo $draftCount ; ?>)</li>  
         <li id="sentLink" <?php if(Yii::app()->session['msgTab'] == 'Sent'){  ?> class="selected" <?php } ?>  onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>entrepreneur/showSentMail'">Sent</li>
         <li id="trashLink" <?php if(Yii::app()->session['msgTab'] == 'Trash'){  ?> class="selected" <?php } ?>   onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>entrepreneur/trashMessages'">Trash</li>
        
      </ul>
                
                
                 
       	
      <div class="tab-content msgcontent tabcontentwidth" id="tab-content" style="margin-top:-135px ;">
     	  <form action="<?php echo Yii::app()->params->base_path;?>entrepreneur/sendMessage" method="post" id="SendForm">  
        <table width="89%" border="0" cellpadding="5" cellspacing="5" style="margin-top:20px;" class="tblstyle">
            
    		<tr>
            	<td align="right">TO :</td>
                <td><input type="text" style="font-family:Helvetica, Arial, sans-serif;" name="toEmail" id="toEmail" value="<?php echo htmlentities($data['firstName']) . ' ' . htmlentities($data['lastName']); ?>" readonly="readonly"  />&nbsp;&nbsp;<a href="<?php echo Yii::app()->params->base_path;?>entrepreneur/getAdvisorList"><img src="<?php echo Yii::app()->params->base_url; ?>timthumb/timthumb.php?src=<?php echo Yii::app()->params->base_url; ?>images/blue_search_icon.png&h=30&w=30&q=72&zc=0" /></a></td>
            </tr>
            <input type="hidden" name="to" id="to" value="<?php echo $data['userId']; ?>"  />
            <tr>
            	<td align="right">SUBJECT :</td>
                <td><input type="text" style="font-family:Helvetica, Arial, sans-serif;" name="subject" id="subject" value="<?php if(isset(Yii::app()->session['subject'])) { echo Yii::app()->session['subject'];} else if(Yii::app()->session['subject_'.Yii::app()->session['fmuserId']]) { echo htmlentities(Yii::app()->session['subject_'.Yii::app()->session['fmuserId']]) ; }else if(Yii::app()->session['subject_'.Yii::app()->session['fmuserId'].Yii::app()->session['message_Id_draft']]) { echo htmlentities(Yii::app()->session['subject_'.Yii::app()->session['fmuserId'].Yii::app()->session['message_Id_draft']]); } ?>"  /></td>
            </tr>
            
            
            <tr>
            	<td align="right">MESSAGE :</td>
                <td><textarea name="message" style="font-family:Helvetica, Arial, sans-serif;" id="message" cols="50" rows="15"><?php if(isset(Yii::app()->session['message'])) { echo htmlentities(Yii::app()->session['message']) ;}else if(Yii::app()->session['message_'.Yii::app()->session['fmuserId']]) { echo htmlentities(Yii::app()->session['message_'.Yii::app()->session['fmuserId']]) ; }else if(Yii::app()->session['subject_'.Yii::app()->session['fmuserId'].Yii::app()->session['message_Id_draft']]) { echo htmlentities(Yii::app()->session['message_'.Yii::app()->session['fmuserId'].Yii::app()->session['message_Id_draft']]) ; } ?></textarea></td>
            </tr>
            
            <tr>
            	<td>&nbsp;</td>
                <td><input type="button" onclick="validate();" name="submitmessage" class="btnblue" id="submitmessage" value="Send"  /><span style="margin-left:10px; position:relative; top:20px;  padding-top:20px;">or <a href="#" style="color:#10BEF8;" onclick="saveAsDraft();">Save as draft</a></span></td>
            </tr>
            
      </table>
     
      </form>
       
      </div>
    </div>
</section>

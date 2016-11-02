<script type="text/javascript">
	function reply()
	{
		$j("#messageText").css("display","none");
		$j("#replyForm").css("display","block");
		$j("#replyForm").focus();
	}
	
	function validate()
	{
		//var message = $j("#message").val();
		var message = document.replyForm["message"].value;
		//var message = $j('#message').text();
		if(message == '' || message == null)
		{
			alert("Please enter message");
			return false;
		}
		
		$j("#replyForm").submit();
		$j("#submitBTN").attr("disabled","disabled");
	}
</script>
<div class="tab-content msgcontent tabcontentwidth" id="tab-content">
     <h3 align="left" style="margin-left:10px;"><?php echo $message['firstName']." ".$message['lastName'] ; ?></h3>
     <div align="right" style="margin-bottom:10px;"> <a href="#replyForm" onclick="reply();">Reply</a> | <a href="#"   onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>entrepreneur/saveAsRecieverTrash/message_id/<?php echo $message['message_id']; ?>'"    >Delete</a> <?php /*?>| <a href="#"  onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>entrepreneur/saveAsDraft/message_id/<?php echo $message['message_id']; ?>'"  >Draft</a><?php */?></div>
     	 <table width="85%" style="margin-left:10px;" border="1" cellpadding="5" cellspacing="5" class="tblstyle" >
         	  
              <tr>
                  <td width="20%" style="text-align:right">Subject :</td>
                  <td class="msgrow" style="text-align:left; left:0px !important; position: relative !important;"><?php echo $message['subject']; ?></td>
                  <td  style="text-align:right">
                  <?php 
                  if(date('d-m-Y',strtotime($message['messageDate'])) == date('d-m-Y'))
                  {
                        echo  date('h:i A',strtotime($message['messageDate']));
                  }
                  else
                  {
                        echo  date('M d',strtotime($message['messageDate']));
                  }
                  ?>
                  </td>
              </tr>
         </table>
         <br/><br/>
         	<div id="messageText">
         		<textarea disabled="disabled" class="txt" name="message" style="margin-left:-110px;" id="message"><?php echo htmlspecialchars_decode(html_entity_decode($message['message'])) ; ?></textarea>
                <br/><br/>
               
            </div>
          <br/><br/>
          <form id="replyForm" name="replyForm" style="display:none;"  action="<?php echo Yii::app()->params->base_path;?>entrepreneur/sendMessage" method="post">
          <table>
          	
            <tr>
            	<td>Reply : </td>
                 <td>&nbsp;</td>
                <td><textarea class="txt" autofocus="autofocus" name="message" id="message"> On <?php echo  date('M d',strtotime($message['messageDate'])); ?>, <?php echo $message['firstName']." ".$message['lastName'] ; ?> wrote:
--------------------
<?php echo htmlspecialchars_decode(html_entity_decode($message['message'])); ?>
</textarea></td>
            </tr>
             
            <tr>
            	<td><input type="hidden" name="to" id="to" value="<?php echo $message['sender_id']; ?>" /></td>
                 <td><input type="hidden" name="subject" id="subject" value="<?php echo $message['subject']; ?>" /></td>
                <td><input type="button" onclick="validate();" id="submitBTN" class="btnblue" value="Send Reply" /></td>
            </tr> 
          </table>
         </form>
       
      </div>

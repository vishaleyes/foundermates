<div class="tab-content msgcontent tabcontentwidth" id="tab-content">
     
	 <?php
	 if($message['sender_id'] == Yii::app()->session['fmuserId']){ ?>
	<h3 align="left">To, <?php  echo $message['firstName']." ".$message['lastName'] ; ?> </h3>
	 <?php } else { 
	 					$userData=Users::model()->findbyPk($message['sender_id']);
						$firstName = $userData->firstName ; 
						$lastName = $userData->lastName ;
	 ?>
     <h3 align="left">From, <?php  echo $firstName ." ".$lastName ; ?> </h3>
     <?php } ?>
	
     	 <table width="89%" border="1" cellpadding="5" cellspacing="5" class="tblstyle" >
              <tr>
                  <td width="20%" style="text-align:right">Subject :</td>
                  <td class="msgrow"  style="text-align:left; left:0px !important; position: relative !important;"><?php echo $message['subject']; ?></td>
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
         
         <div style="margin-top:10px; text-align:left;">
        <div id="messageText">
         		<textarea disabled="disabled" style="margin-left:-00px;" class="txt" name="message" id="message"><?php echo htmlspecialchars_decode(html_entity_decode($message['message'])) ; ?></textarea>
                <br/><br/>
               
            </div>
         </div>
      </div>

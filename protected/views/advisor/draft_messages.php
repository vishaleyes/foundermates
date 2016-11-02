<script type="text/javascript">
	function showMessage(id)
	{
		$j.ajax({
		  type: 'POST',
		  url: '<?php echo Yii::app()->params->base_path;?>advisor/showMessage',
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
		  url: '<?php echo Yii::app()->params->base_path;?>advisor/showSentMessage',
		  data: 'message_id='+id,
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
		  url: '<?php echo Yii::app()->params->base_path;?>advisor/showSentMail',
		  data: '',
		  cache: false,
		  success: function(data)
		  {
		  $j("#tab-content").replaceWith(data);
		   $j("#inboxLink").attr('class','');
		    $j("#trashLink").attr('class','');
			 $j("#draftLink").attr('class','');
		   $j("#sentLink").attr('class','selected');
		  }
		 });
	}
	
</script>
<section class="admincontent">	
	 <h2>FounderMail</h2>
     
     <div class="bordertop">
     <hr class="bluethickborder" />
     <hr class="thinborder" />
	</div>
   <div class="tab-wrapper">
   
                  <br/><br/><br />
      <ul id="tab-menu" class="msgsidebar">
        <li id="inboxLink"  onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>advisor/messages'"     <?php if(Yii::app()->session['msgTab'] == 'Inbox'){  ?> class="selected" <?php } ?> >Inbox(<?php echo $unreadCount ; ?>)</li>
         <li id="draftLink" <?php if(Yii::app()->session['msgTab'] == 'Draft'){  ?> class="selected" <?php } ?> onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>advisor/draft'">Draft(<?php echo $draftCount ; ?>)</li>  
         <li id="sentLink" <?php if(Yii::app()->session['msgTab'] == 'Sent'){  ?> class="selected" <?php } ?>  onclick="showSentMail();">Sent</li>
         <li id="trashLink" <?php if(Yii::app()->session['msgTab'] == 'Trash'){  ?> class="selected" <?php } ?>   onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>advisor/trashMessages'">Trash</li>
        
      </ul>
       	
      <div class="tab-content msgcontent tabcontentwidth" id="tab-content" style="margin-top: -60px !important;font-family:Helvetica, Arial, sans-serif;">
     
     	<table border="0" cellpadding="5" cellspacing="5" class="tblstyle">
          
            <tr>
            <th>
            Select: <font class="allmailtxt">All</font> | <font class="nonetxt">None</font>
            </th>
            <th></th>
            <th>
            
            
            </th>
            </tr>
			<?php 
				$cnt = count( $data['messages']);
				if($cnt>0) {
				$i=0;
				foreach($data['messages'] as $row) { 
			?>  
              <tr <?php if($i%2!=0){ ?> class="oddrow bigrow" <?php } else { ?>class="evenrow bigrow" <?php } ?> >
               <td><input type="checkbox" /></td>
                  <td style="cursor:pointer;" onclick="showMessage('<?php echo $row['message_id']; ?>');"  class="msgrow"><font class="mailername"><a style="color:#10BEF8;" href="<?php echo Yii::app()->params->base_path ?>advisor/showEntProfile/userId/<?php echo $row['sender_id'] ; ?>" >
			  <?php echo $row['firstName'].' '.$row['lastName'] ; ?>
              </a></font><br /><?php echo $row['subject']; ?><br />
              <a href="#"><span>Delete</span></a>
              </td>
              <td>
               <?php 
              if(date('d-m-Y',strtotime($row['createdAt'])) == date('d-m-Y'))
              {
                    echo  date('h:i A',strtotime($row['createdAt']));
              }
              else
              {
                    echo  date('M d',strtotime($row['createdAt']));
              }
              ?>
              </td>
              </tr>
              <?php $i++; } } else { ?>  
  			<tr class="evenrow bigrow"  style="text-align:center;"><td colspan="3" style="color:#10BEF8 !important;">Your draft is Empty.</td></tr>				     
      <?php } ?>
          </table>
       <div>
		 <?php
         if($cnt > 0 && $data['pagination']->getItemCount()  > $data['pagination']->getLimit()){?>
             <div class="pagination">
             <?php 
             $this->widget('application.extensions.WebPager',
                             array('cssFile'=>Yii::app()->params->base_url.'css/style.css',
                                    // 'extraPara'=>$extraPaginationPara,
                                    'pages' => $data['pagination'],
                                    'id'=>'link_pager',
            ));
         ?>	
         </div>
         <?php  
         }?>
    </div>
      </div>
    </div>
</section>

<script type="text/javascript">
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
		   $j("#sentLink").attr('class','selected');
		  }
		 });
	}
	
	function redirect()
	{
		var ids="";
		for(i=0;i<document.fact_form.length;i++)
		{
			if(document.fact_form[i].type=="checkbox"&&document.fact_form[i].name=="check")
			{
				if(document.fact_form[i].checked)
				{
					ids+=","+document.fact_form[i].value;
				}
			}
		}
		if(ids!="")
		{
			document.getElementById('ids').value=ids;
			return true;
		}
		else
		{
			alert('Please Select Messages to Delete');
			return false;
		}
		return true;
	}
	
	function check_all(value)
	{
		if(document.getElementById('all').checked)
		{
			for(i=0;i<document.fact_form.length;i++)
			{
				if(document.fact_form[i].type=="checkbox"&&document.fact_form[i].name=="check")
				{
					document.fact_form[i].checked=true;
				}
			}
		}
		else
		{
			for(i=0;i<document.fact_form.length;i++)
			{
				if(document.fact_form[i].type=="checkbox"&&document.fact_form[i].name=="check")
				{
					document.fact_form[i].checked=false;
				}
			}
		}
	}
	
	function check_uncheck()
	{
		var checked=0;
		var total=0;
		for(i=0;i<document.fact_form.length;i++)
		{
			if(document.fact_form[i].type=="checkbox" && document.fact_form[i].name=="check")
			{
				total++;
				if(document.fact_forms[i].checked)
				{
					checked++;
				}
			}
		}
		if(checked!=0)
		{
			if(total==checked)
				document.getElementById('all').checked=true;
			return;
		}
		document.getElementById('all').checked=false;
	}

	
</script>
<section class="admincontent">	
	 <h2>FounderMail</h2>
     
     <div class="bordertop">
     <hr class="bluethickborder" />
     <hr class="thinborder" />
	</div>
   <div class="tab-wrapper">
   <div class="composebg">
                  <input type="button" class="btnblue composeblue" onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>entrepreneur/sendmessages'"  value="Compose Message" />
    </div>
      <br/><br/><br />
      <ul id="tab-menu" class="msgsidebar">
        <li id="inboxLink"  onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>entrepreneur/messages'"     <?php if(Yii::app()->session['msgTab'] == 'Inbox'){  ?> class="selected" <?php } ?> >Inbox(<?php echo $unreadCount ; ?>)</li>
         <li id="draftLink" <?php if(Yii::app()->session['msgTab'] == 'Draft'){  ?> class="selected" <?php } ?> onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>entrepreneur/draft'">Draft(<?php echo $draftCount ; ?>)</li>  
         <li id="sentLink" <?php if(Yii::app()->session['msgTab'] == 'Sent'){  ?> class="selected" <?php } ?>  onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>entrepreneur/showSentMail'">Sent</li>
         <li id="trashLink" <?php if(Yii::app()->session['msgTab'] == 'Trash'){  ?> class="selected" <?php } ?>   onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>entrepreneur/trashMessages'">Trash</li>
        
      </ul>
<div class="tab-content msgcontent tabcontentwidth" id="tab-content">
<form name="fact_form" id="fact_form" action="<?php echo Yii::app()->params->base_path; ?>entrepreneur/SendInSenderTrashMessages" method="post" onSubmit="return redirect();">
		<table border="0" cellpadding="5" cellspacing="5" class="tblstyle">
          
            <tr>
            <th>
            <input id="all" name="all" type="checkbox" value="all" onChange="return check_all(this.value);">&nbsp;&nbsp;<font class="allmailtxt">All</font>
            <input type="submit" value="Delete" id="delete_submit" style=" float:right !important; margin-right:-385px !important;  background-color: #10BEF8;
    background-image: -moz-linear-gradient(center top , #10BEF8, #048FBD);
    border: medium none;
    border-radius: 3px 3px 3px 3px;
    color: #FFFFFF;
    cursor: pointer;
    float: left;
    font-size: 12px;
    font-weight: bold;
    letter-spacing: 0.5px;
    padding: 3px 12px;
    text-decoration: none;" />
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
				
				 $alogObj = new Algoencryption();
			?>  
              <tr <?php if($i%2!=0){ ?> class="oddrow bigrow" <?php } else { ?>class="evenrow bigrow" <?php } ?> >
               <td><input type="checkbox" name="check" value="<?php echo $row['message_id'] ; ?>" onchange="check_uncheck();"></td>
                  <td style="cursor:pointer;"  onclick="showSentMessage('<?php echo $row['message_id']; ?>');"  class="msgrow"><font class="mailername"><a style="color:#10BEF8;" href="<?php echo Yii::app()->params->base_path ?>entrepreneur/showAdvisorProfile/userId/<?php echo $alogObj->encrypt($row['receiver_id'])  ; ?>" >
			  To: <?php echo $row['firstName'].' '.$row['lastName'] ; ?>
              </a></font><br /><?php echo $row['subject']; ?><br />
              <?php /*?><a href="#"><span>Delete</span></a><?php */?>
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
  			<tr class="evenrow bigrow"  style="text-align:center;"><td colspan="3" style="color:#10BEF8 !important;">Your sentbox is Empty.</td></tr>				     
      <?php } ?>
          </table> 
          <input type="hidden" value="" name="ids" id="ids" />
      </form>    
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
<?php /*?><script type="text/javascript">
$j(document).ready(function(){
	$j('#link_pager a').each(function(){
		$j(this).click(function(ev){
			ev.preventDefault();
			$j.get(this.href,{ajax:true},function(html){
				$j('#tab-content').replaceWith(html);
			});
		});
	});
});
</script><?php */?>
</section>
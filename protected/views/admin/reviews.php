<?php
$extraPaginationPara='&keyword='.$ext['keyword'].'&sortType='.$ext['currentSortType'].'&sortBy='.$ext['sortBy'].'&startdate='.$ext['startdate'].'&enddate='.$ext['enddate'];
?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->params->base_url;?>css/jquery.fancybox.css"/>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url;?>js/jquery.fancybox.js"></script>
<script type="text/javascript">
var base_path = "<?php echo Yii::app()->params->base_path;?>";
var $j = jQuery.noConflict();
$j.fancybox.close();
$j(document).ready(function(){
	$j('.delete_this').click(function(){
		var id	=	$j(this).attr('lang');
		
		jConfirm('Do you want to delete this record?', 'Confirmation dialog', function(res){
            if(res == true){
            	window.location.href=base_path+"admin/deleteOrder/id/"+id;
            }
        });
		
	});
	
});

$j("#viewMore").fancybox({
		  'width' : 800,
		   'height' : 'auto',
		   'transitionIn' : 'none',
		  'transitionOut' : 'none',
		  'type':'iframe'
	  
	  });
	  
function checkAll(){
	for (var i=0;i<document.forms[2].elements.length;i++)
	{
		var e=document.forms[2].elements[i];
		if ((e.name != 'checkboxAll') && (e.type=='checkbox'))
		{
			e.checked=document.forms[2].checkboxAll.checked;
		}
	}
}

function dSelectCheckAll()
{
	document.getElementById('checkboxAll').checked="";
}

function validateForm(){
	var checked	=	$j("input[name=checkbox[]]:checked").map(
    function () {return this.value;}).get().join(",");
	
	if(!checked){
		alert('Please select at least one record.');
		return false;
	}
	
	if(confirm("Do you want to delete this record")){
		return true;
	}
	return false;
}

function validateAll()
{
	var flag=0;
	
	return true;
	
}
function popitup(url) {
	newwindow=window.open(url,'name','height=400,width=780,scrollbars=yes,screenX=250,screenY=200,top=150');
	if (window.focus) {newwindow.focus()}
	return false;
}

function orderCancel(id)
{
	 var reason = document.getElementById('reason').value;
	 window.location.href=base_path+"admin/cancelOrder/id/"+id+"/reason/"+reason;
}

</script>
<script type="text/javascript">
var $j = jQuery.noConflict();

$j(document).ready(function(){

	$j("#cancelPopup").fancybox(
	{	
		'width' : 1000,
 		'height' : 1000,
 		'transitionIn' : 'none',
		'transitionOut' : 'none',
		

	});
		
 	});
</script>
<div align="center">
	<?php if(Yii::app()->user->hasFlash('success')): ?>                                
        <div id="msgbox" class="clearmsg" style="margin: 5px 0px 5px 0px  !important;"> <?php echo Yii::app()->user->getFlash('success'); ?></div>
        <div class="clear"></div>
    <?php endif; ?>
    <?php if(Yii::app()->user->hasFlash('error')): ?>
        <div id="msgbox" class="clearmsg errormsg" style="margin: 5px 0px 5px 0px  !important;"> <?php echo Yii::app()->user->getFlash('error'); ?></div>
        <div class="clear"></div>
    <?php endif; ?>
</div>
<div class="clear"></div>
<div class="wrapper">	
    <div class="signupForm">
    	<div class="container1">
        <!------------------------------   Flexible Section Start    ---------------------------->
            <div class="margincenter">
                <div class="toppannel">
                    <div class="boxtopm">
                        <div class="boxtopl">
                            <div class="boxtopr"></div>
                        </div>
                    </div>
                </div>
                <div class="middlepannel">
                    <div class="mid">
                        <div class="midl">
                            <div class="midr">
                                <div class="cont">   
                                    <div class="headingtop">
                                        <h1 style="margin-left:15px; background:none;">Reviews For Approval</h1>
                                    </div>
                                    <div class="contdiv">
                                        <div class="wrapper-big">
                                            
                                        <table width="100%">
                                        <tr align="right">
                                        <td>   
                         
                                                   
                          </td>
                          </tr></table>
                                               
<?php 
/*echo "<pre>";
print_r($data);exit;
*/   echo CHtml::beginForm(Yii::app()->params->base_path.'admin/deleteRecord/type/All','post',array('id' => 'deleteRecordForm','name' => 'deleteRecordForm','onsubmit' => 'return validateForm();')) ?>
 <div id="employee">
<div class="content-box">
                                                    
 <table cellpadding="0" style="vertical-align:middle;" cellspacing="0" border="0" class="tableListing width700">
  <tr>
   <th  class="alignCenter">No</th>
   
   <th  class="alignCenter"><a href="<?php echo Yii::app()->params->base_path;?>admin/Reviews/sortType/<?php echo $ext['sortType'];?>/sortBy/entrepreneur_id" class="sort">From<?php 
  if($ext['img_name'] != '' && $ext['sortBy'] == 'entrepreneur_id'){ ?>
  <img src="<?php echo Yii::app()->params->base_url;?>images/<?php echo $ext['img_name'];?>" class="sortImage" />
 <?php } ?> </a></th>
 
 <th  class="alignCenter"><a href="<?php echo Yii::app()->params->base_path;?>admin/Reviews/sortType/<?php echo $ext['sortType'];?>/sortBy/email" class="sort">Entrepreneur<?php 
  if($ext['img_name'] != '' && $ext['sortBy'] == 'email'){ ?>
  <img src="<?php echo Yii::app()->params->base_url;?>images/<?php echo $ext['img_name'];?>" class="sortImage" />
 <?php } ?> </a></th>
 
    <th   class="alignCenter"><a href="<?php echo Yii::app()->params->base_path;?>admin/Reviews/sortType/<?php echo $ext['sortType'];?>/sortBy/advisor_id" class="sort">To<?php 
  if($ext['img_name'] != '' && $ext['sortBy'] == 'advisor_id'){ ?>
  <img src="<?php echo Yii::app()->params->base_url;?>images/<?php echo $ext['img_name'];?>" class="sortImage" />
 <?php } ?> </a></th>
 
 <th   class="alignCenter"><a href="<?php echo Yii::app()->params->base_path;?>admin/Reviews/sortType/<?php echo $ext['sortType'];?>/sortBy/email" class="sort">Advisor<?php 
  if($ext['img_name'] != '' && $ext['sortBy'] == 'email'){ ?>
  <img src="<?php echo Yii::app()->params->base_url;?>images/<?php echo $ext['img_name'];?>" class="sortImage" />
 <?php } ?> </a></th>
  
  <th class="alignCenter"><a href="<?php echo Yii::app()->params->base_path;?>admin/Reviews/sortType/<?php echo $ext['sortType'];?>/sortBy/expertise_area" class="sort">Review<?php 
  if($ext['img_name'] != '' && $ext['sortBy'] == 'expertise_area'){ ?>
  <img src="<?php echo Yii::app()->params->base_url;?>images/<?php echo $ext['img_name'];?>" class="sortImage" />
 <?php } ?> </a></th> 
   
			<th class="lastcolumn"><a href="<?php echo Yii::app()->params->base_path;?>admin/Reviews/sortType/<?php echo $ext['sortType'];?>/sortBy/createdAt" class="sort">Date Posted On<?php 
  if($ext['img_name'] != '' && $ext['sortBy'] == 'createdAt'){ ?>
  <img src="<?php echo Yii::app()->params->base_url;?>images/<?php echo $ext['img_name'];?>" class="sortImage" />
 <?php } ?> </a></th>
			<?php /*?><th width="5" class="lastcolumn" style="text-align:center;">Cancel</th><?php */?>
		</tr>
		
<?php

/*echo "<pre>";print_r($data);exit;*/
$i=1;
$cnt = count($data['messages']);
if($cnt>0){
foreach($data['messages']  as $row){ 

?>
<tr>
<td  style="text-align:right">
 <?php
 	
echo $i+($data['pagination']->getCurrentPage()*$data['pagination']->getLimit());
          ?>
     </td>
     		
            <td  style="text-align:left" ><?php echo $row['entrepreneur'];?></td>
            <td  style="text-align:left" ><?php echo $row['entrepreneur_email'];?></td>
            <td  style="text-align:left" ><?php echo $row['advior'];?></td>
            <td  style="text-align:left" ><?php echo $row['advior_email'];?></td>
            <td  style="text-align:left" ><a href="<?php echo Yii::app()->params->base_path;?>admin/reviewDetail/review_id/<?php echo $row['review_id'];?>" id="viewMore" class="viewIcon noMartb viewMore floatLeft"><?php echo substr($row['expertise_area'],0,10) ;?> </a></td>
           <td class="lastcolumn" width="15">
           <?php echo $row['createdAt'];?>
		</td>

                                                                        
 </tr>
<?php
 $i++;
  }
  }else{?>
 <tr>
 <td colspan="12" class="lastcolumn">No Record Found</td>
</tr>
 <?php
 }?>
      <input type="hidden" name="total_acc" id="total_acc" value="<?php echo $i;?>" />
           </table>
              </div>
                     <div>
                                                
   							 <div class="clear"></div>
    
                                                
                                     <?php echo CHtml::endForm();?>
					</div> 
                    <div>
                    <?php 
  if($cnt > 0 && $data['pagination']->getItemCount()  > $data['pagination']->getLimit()){?>  
  <div class="pagination"> <?php $extraPaginationPara='&keyword='.$ext['keyword'].'&sortBy='.$ext['sortBy'].'&startdate='.$ext['startdate'].'&enddate='.$ext['enddate'];
     $this->widget('application.extensions.WebPager',
                                                                                 array('cssFile'=>false,
                                                                                       
                                                                                        'pages' => $data['pagination'],
                                                                                        'id'=>'link_pager',
                                                                ));
                                                             ?>	
                                                             </div>
                                                             <?php  
                                                             }?>
                    </div>
                    
                                            <div class="clear"></div>             
                                        </div>
                                    </div>
                                	<div class="headingbot"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="botompannel">
                    <div class="boxbotm">
                        <div class="boxbotl">
                            <div class="boxbotr"></div>
                        </div>
                    </div>
                </div>
            </div>
        <!-------------------------------   Flexible Section End   --------------------------------> 
        </div>
	</div>
</div>

<?php
$extraPaginationPara='&keyword='.$ext['keyword'].'&sortType='.$ext['currentSortType'].'&sortBy='.$ext['sortBy'].'&startdate='.$ext['startdate'].'&enddate='.$ext['enddate'];
?>
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->params->base_url;?>css/jquery.fancybox-1.3.1.css" />
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url; ?>js/jquery.fancybox-1.3.1.js"></script>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->params->base_url;?>css/custom-theme/jquery-ui-1.8.13.custom.css" />
<script type="text/javascript">
var base_path = "<?php echo Yii::app()->params->base_path;?>";
var $j = jQuery.noConflict();
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
	
function confirmDelete(userId)
{
	if(confirm("Are you sure want to delete?"))
	{
		window.location.href = "<?php echo Yii::app()->params->base_path;?>admin/deleteRequest/user_id/"+userId;
	}
	
}
</script>

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
                                        <h1 style="margin-left:15px; background:none;">All Users</h1>
                                    </div>
                                    <div class="contdiv">
                                        <div class="wrapper-big">
                                            
                                        <table width="100%">
                                        <tr align="right">
                                        <td>   
                         
                                                   
                          </td>
                          </tr></table>
                                               

 <div id="employee">
<div class="content-box">
  <div>
     <form action="<?php echo Yii::app()->params->base_path;?>admin/DeleteUsers/" method="post">
     <table>
     <tr>
     <td>
     <b>User Email&nbsp;</b>
     </td>
     <td>
     <input type="text" name="keyword" id="keyword" value="<?php if(isset($ext['keyword']) && $ext['keyword']!= "") { echo $ext['keyword'] ; } ?>" />
     </td>
     <td><input type="submit" name="btnsearch" id="btnsearch" value="Search" class="btnblue" /></td>
      <td><input type="button" name="btnsearch" id="btnsearch" value="View All" class="btnblue" onclick="window.location.href='<?php echo Yii::app()->params->base_url; ?>admin/DeleteUsers'" /></td>
     </tr>
     </table>
    </form>
  </div>                                                  
 <table cellpadding="0" style="vertical-align:middle;"  cellspacing="0" border="0" class="tableListing width700" width="960">
  <tr>
   <th width="20"  class="alignCenter">No</th>
    <th width="20"  class="alignCenter"><a href="<?php echo Yii::app()->params->base_path;?>admin/DeleteUsers/sortType/<?php echo $ext['sortType'];?>/sortBy/firstName" class="sort">UserName<?php 
  if($ext['img_name'] != '' && $ext['sortBy'] == 'firstName'){ ?>
  <img src="<?php echo Yii::app()->params->base_url;?>images/<?php echo $ext['img_name'];?>" class="sortImage" />
 <?php } ?> </a></th>
  
  <th width="50" class="alignCenter"><a href="<?php echo Yii::app()->params->base_path;?>admin/DeleteUsers/sortType/<?php echo $ext['sortType'];?>/sortBy/email" class="sort">Useremail<?php 
  if($ext['img_name'] != '' && $ext['sortBy'] == 'email'){ ?>
  <img src="<?php echo Yii::app()->params->base_url;?>images/<?php echo $ext['img_name'];?>" class="sortImage" />
 <?php } ?> </a></th> 
    
         <th width="35"  class="alignCenter"><a class="sort" href='<?php echo Yii::app()->params->base_path;?>admin/DeleteUsers/sortType/<?php echo $ext['sortType'];?>/sortBy/userType' >UserType<?php 
        if($ext['img_name'] != '' && $ext['sortBy'] == 'userType'){ ?>
            <img src="<?php echo Yii::app()->params->base_url;?>images/<?php echo $ext['img_name'];?>" class="sortImage" />
            <?php
        } ?>
        </a></th>
    <th width="35"  class="alignCenter"><a class="sort" href='<?php echo Yii::app()->params->base_path;?>admin/DeleteUsers/sortType/<?php echo $ext['sortType'];?>/sortBy/createdAt' >Date Registered<?php 
        if($ext['img_name'] != '' && $ext['sortBy'] == 'createdAt'){ ?>
            <img src="<?php echo Yii::app()->params->base_url;?>images/<?php echo $ext['img_name'];?>" class="sortImage" />
            <?php
        } ?>
        </a></th>
				
			<th width="15" class="lastcolumn">Delete</th>
			
		</tr>
		
<?php

/*echo "<pre>";print_r($data);exit;*/
$i=1;
$cnt = count($data['users']);
if($cnt>0){
foreach($data['users']  as $row){ 

?>
<tr>
<td  style="text-align:right">
 <?php
 	
echo $i+($data['pagination']->getCurrentPage()*$data['pagination']->getLimit());
          ?>
     </td>
     <td  style="text-align:left" ><?php echo $row['firstName'];?>&nbsp;<?php echo $row['lastName'];?></td>
		   <td  style="text-align:left"><?php echo $row['email'];?></td>
            <td style="text-align:left">
		   <?php if($row['userType'] == 1) {  ?>
           Enterprenuer
           <?php }else { ?>
		   Advisor
           <?php } ?>
		   </td>
		   <td style="text-align:right"><?php echo $row['createdAt'];?></td>
		   <td class="lastcolumn"   style="text-align:center ;"width="15">
          
 <a href="#"  onclick="confirmDelete('<?php echo $row['id'];?>');" title="Delete"><img src="<?php echo Yii::app()->params->base_url; ?>images/error-icon.png" width="25" height="21" /> </a>
		
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
    
                                                
                                     <?php //echo CHtml::endForm();?>
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

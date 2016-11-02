<?php
$extraPaginationPara='&keyword='.$ext['keyword'].'&sortType='.$ext['currentSortType'].'&sortBy='.$ext['sortBy'].'&startdate='.$ext['startdate'].'&enddate='.$ext['enddate'];
?>
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->params->base_url;?>css/jquery.fancybox-1.3.1.css" />
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url; ?>js/jquery.fancybox-1.3.1.js"></script>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->params->base_url;?>css/custom-theme/jquery-ui-1.8.13.custom.css" />

<script type="text/javascript">
function confirmDelete(id)
{
	if(confirm("Are you sure want to delete?"))
	{
		window.location.href = "<?php echo Yii::app()->params->base_path;?>admin/deleteKeyword/id/"+id;
	}
	
}
</script>
<div align="center">
	<?php if(Yii::app()->user->hasFlash('success')): ?>                                
        <div id="msgbox" class="clearmsg"> <?php echo Yii::app()->user->getFlash('success'); ?></div>
        <div class="clear"></div>
    <?php endif; ?>
    <?php if(Yii::app()->user->hasFlash('error')): ?>
        <div id="msgbox" class="clearmsg errormsg"> <?php echo Yii::app()->user->getFlash('error'); ?></div>
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
                                        <h1 style="margin-left:15px; background:none;">Zero Search Result Keywords</h1>
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
    <th   class="alignCenter"><a href="<?php echo Yii::app()->params->base_path;?>admin/keywordsListing/sortType/<?php echo $ext['sortType'];?>/sortBy/keyword" class="sort">Keywords<?php 
  if($ext['img_name'] != '' && $ext['sortBy'] == 'keyword'){ ?>
  <img src="<?php echo Yii::app()->params->base_url;?>images/<?php echo $ext['img_name'];?>" class="sortImage" />
 <?php } ?> </a></th>
  <th  class="alignCenter"><a href="<?php echo Yii::app()->params->base_path;?>admin/keywordsListing/sortType/<?php echo $ext['sortType'];?>/sortBy/similar_word" class="sort">Similar Words<?php 
  if($ext['img_name'] != '' && $ext['sortBy'] == 'similar_word'){ ?>
  <img src="<?php echo Yii::app()->params->base_url;?>images/<?php echo $ext['img_name'];?>" class="sortImage" />
 <?php } ?> </a></th>
  <th class="alignCenter"><a href="<?php echo Yii::app()->params->base_path;?>admin/keywordsListing/sortType/<?php echo $ext['sortType'];?>/sortBy/created" class="sort">Created Date<?php 
  if($ext['img_name'] != '' && $ext['sortBy'] == 'created'){ ?>
  <img src="<?php echo Yii::app()->params->base_url;?>images/<?php echo $ext['img_name'];?>" class="sortImage" />
 <?php } ?> </a></th> 
    <th  class="alignCenter"><a href="<?php echo Yii::app()->params->base_path;?>admin/keywordsListing/sortType/<?php echo $ext['sortType'];?>/sortBy/modified" class="sort">Modified Date<?php 
  if($ext['img_name'] != '' && $ext['sortBy'] == 'modified'){ ?>
  <img src="<?php echo Yii::app()->params->base_url;?>images/<?php echo $ext['img_name'];?>" class="sortImage" />
 <?php } ?> </a></th>
			<th width="15" class="alignCenter">Edit</th>
			<th width="15" class="lastcolumn">Delete</th>
			<?php /*?><th width="5" class="lastcolumn" style="text-align:center;">Cancel</th><?php */?>
		</tr>
		
<?php

/*echo "<pre>";print_r($data);exit;*/
$i=1;
$cnt = count($data['keywords']);
if($cnt>0){
foreach($data['keywords']  as $row){ 

?>
<tr>
            <td  style="text-align:right">
            <?php
            
            echo $i+($data['pagination']->getCurrentPage()*$data['pagination']->getLimit());
            ?>
            </td>
		    <td  style="text-align:left" ><?php echo $row['keyword'];?></td>
           <td  style="text-align:left" ><?php echo $row['similar_word'];?></td>
		   <td  style="text-align:center"><?php if($row['created'] != "" && $row['created'] != "0000-00-00 00:00:00") { echo date("d-m-Y",strtotime($row['created'])) ;} else {  echo "-NULL-"; } ?></td>
		   <td style="text-align:center"><?php if($row['modified'] != "" && $row['modified'] != "0000-00-00 00:00:00") { echo date("d-m-Y",strtotime($row['modified'])) ;} else {  echo "-NULL-"; } ?></td>
           <td style="text-align:center" width="15">
          	<a href="<?php echo Yii::app()->params->base_path;?>admin/editKeyword/id/<?php echo $row['id'];?>" title="Edit Keyword"><img src="<?php echo Yii::app()->params->base_url; ?>images/edit-icon.png"/> </a>
			</td>
			<td class="lastcolumn" style="text-align:center ;" width="15">
          	<a href="#" onclick="confirmDelete('<?php echo $row['id'] ; ?>');" title="Delete Keyword"><img src="<?php echo Yii::app()->params->base_url; ?>images/error-icon.png"/> </a>
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

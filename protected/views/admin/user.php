<?php
$extraPaginationPara='&keyword='.$ext['keyword'].'&sortType='.$ext['currentSortType'].'&sortBy='.$ext['sortBy'].'&startdate='.$ext['startdate'].'&enddate='.$ext['enddate'];
?>
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->params->base_url;?>css/custom-theme/jquery-ui-1.8.13.custom.css" />
<script type="text/javascript">
var base_path = "<?php echo Yii::app()->params->base_path;?>";
var $j = jQuery.noConflict();
$j(document).ready(function(){
	$j('.delete_this').click(function(){
		var id	=	$j(this).attr('lang');
		var total	=	document.getElementById("total_acc").value;
		current_page=1;
		if(confirm("Do you want to delete this record")){
			window.location=base_path+"admin/deleteUser/id/"+id+"/current_page/"+current_page+"/total/"+total;
		}
	});
	
	$j(function() {
		var dates = $j( "#startdate, #enddate" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 1,
			onSelect: function( selectedDate ) {
				var option = this.id == "startdate" ? "minDate" : "maxDate",
					instance = $j( this ).data( "datepicker" ),
					date = $j.datepicker.parseDate(
						instance.settings.dateFormat ||
						$j.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
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
<div id="content">
	<div>
		<h1>Users Listing</h1>
        
		
        <table width="100%" border="0" class="search-table" cellpadding="2" cellspacing="2">
                	<tr>
                        <td align="right" colspan="8">
                        	<a href="<?php echo Yii::app()->params->base_path;?>site/signUpMain/type/Seeker/admin/admin" class="btn" onclick="return popitup('<?php echo Yii::app()->params->base_path;?>site/signUpMain/type/Seeker/admin/admin')"
                >ADD User</a> 
                			
                		</td>
                    </tr>
                    <?php
                    echo CHtml::beginForm(Yii::app()->params->base_path.'admin/users/','post',array('id' => 'searchForm','name' => 'searchForm')) ?>
                    <tr><td colspan="8" class="height10"></td></tr>
                    <tr>
                        <td width="8%" align="left">Search :</td>
                        <td width="20%" align="left">
                        	<input name="keyword" id="keyword" class="textbox2" type="text" value="<?php echo $ext['keyword'];?>"/>
                        </td>
                   		<td width="14%" align="right">Start Date :</td>
                      	<td width="14%">
                        	<input name="startdate" id="startdate" class="textbox2 datebox" type="text" value="<?php if(isset($ext['startdate'])){echo $ext['startdate'];}?>"/>
                        </td>
                        <td width="12%" align="right">End Date :</td>
						<td width="14%" align="left">
                        	<input name="enddate" width="20" id="enddate" class="textbox2 datebox" type="text" value="<?php if(isset($ext['enddate'])){echo $ext['enddate'];}?>"/>
                        </td>
                        <td width="9%" align="right">
                        	<input type="submit"  name="Search" value="Search"  class="btn" />
                        </td>
                        <td width="9%" align="right">
                        	<input type="button"  name="" value="Show All"  onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>admin/users'"  class="btn"  />
                        </td>
                    </tr>
                    <?php echo CHtml::endForm();?>
                </table>
      <?php 
        echo CHtml::beginForm(Yii::app()->params->base_path.'admin/deleteRecord/type/All','post',array('id' => 'deleteRecordForm','name' => 'deleteRecordForm','onsubmit' => 'return validateForm();')) ?>
        <div id="employee">
            <div class="content-box">
            
                <table cellpadding="0" cellspacing="0" border="0" class="listing" width="960">
                	<tr>
                    	<th width="20">
                        	<input name="checkboxAll" type="checkbox" id="checkboxAll" value="1" onclick="checkAll();">
                        </th>
                        <th width="20">No</th>
                        <th width="20"><a href="<?php echo Yii::app()->params->base_path;?>admin/Users/sortType/<?php echo $ext['sortType'];?>/sortBy/firstName" class="sort">First Name<?php 
                            if($ext['img_name'] != '' && $ext['sortBy'] == 'firstName'){ ?>
                                <img src="<?php echo Yii::app()->params->base_url;?>images/<?php echo $ext['img_name'];?>" class="sortImage" />
                                <?php
                            } ?>
                            </a></th>
                        <th width="20"><a class="sort" href='<?php echo Yii::app()->params->base_path;?>admin/Users/sortType/<?php echo $ext['sortType'];?>/sortBy/lastName' >Last Name<?php 
                            if($ext['img_name'] != '' && $ext['sortBy'] == 'lastName'){ ?>
                                <img src="<?php echo Yii::app()->params->base_url;?>images/<?php echo $ext['img_name'];?>" class="sortImage" />
                                <?php
                            } ?>
                            </a></th>
                             <th width="10"><a class="sort" href='<?php echo Yii::app()->params->base_path;?>admin/Users/sortType/<?php echo $ext['sortType'];?>/sortBy/loginId' >LoginId<?php 
                            if($ext['img_name'] != '' && $ext['sortBy'] == 'loginId'){ ?>
                                <img src="<?php echo Yii::app()->params->base_url;?>images/<?php echo $ext['img_name'];?>" class="sortImage" />
                                <?php
                            } ?>
                            </a></th>
                        <th width="35" class="alignCenter"><a class="sort" href='<?php echo Yii::app()->params->base_path;?>admin/Users/sortType/<?php echo $ext['sortType'];?>/sortBy/createdAt' >Created Date<?php 
                            if($ext['img_name'] != '' && $ext['sortBy'] == 'createdAt'){ ?>
                                <img src="<?php echo Yii::app()->params->base_url;?>images/<?php echo $ext['img_name'];?>" class="sortImage" />
                                <?php
                            } ?>
                            </a></th>
                      	<th width="35"><a class="sort" href='<?php echo Yii::app()->params->base_path;?>admin/Users/sortType/<?php echo $ext['sortType'];?>/sortBy/modifiedAt' >Modified Date<?php 
                            if($ext['img_name'] != '' && $ext['sortBy'] == 'modifiedAt'){ ?>
                                <img src="<?php echo Yii::app()->params->base_url;?>images/<?php echo $ext['img_name'];?>" class="sortImage" />
                                <?php
                            } ?>
                            </a></th>
                        <th width="15">Verified</th>
                        <th width="15">Change Password</th>
                    	<th width="5">Delete</th>
                    </tr>
                    
                    <?php
                    $i=1;
					$cnt = $data['pagination']->itemCount;
					if($cnt>0){
						
						foreach($data['users'] as $row){ ?>
                            <tr>
                                <td>
                                    <input name="checkbox[]" type="checkbox" onclick="dSelectCheckAll()" id="checkbox<?php echo $row['id'];?>" value="<?php echo $row['id'];?>">
                                </td>
                                <td class="alignCenter">
                                    <?php 
                                    echo $i+($data['pagination']->getCurrentPage()*$data['pagination']->getLimit());
                                    ?>
                                </td>
                                <td><?php echo $row['firstName'];?></td>
                                <td><?php echo $row['lastName'];?></td>
                                <td><?php echo $row['loginId'];?></td>
                                <td class="alignCenter"><?php echo $row['createdAt'];?></td>
                                <td class="alignCenter"><?php echo $row['modifiedAt'];?></td>
                               
                                <td class="alignCenter" width="15">
                                 <?php if($row['isVerified'] != 1){?>
                                    <a href="<?php echo Yii::app()->params->base_path;?>admin/approveUser/id/<?php echo $row['logId'];?>&ajax=false" title="Active This User"><img src="<?php echo Yii::app()->params->base_url; ?>images/error-icon.png" /> </a>
                                <?php  }else{?>
                                    <img src="<?php echo Yii::app()->params->base_url; ?>images/success-icon.png" />
                                <?php } ?>
                                </td>
                                 <td class="alignCenter"><a href="<?php echo Yii::app()->params->base_path;?>admin/changePassword/id/<?php echo $row['logId'];?>&ajax=false"  title="Delete Seeker">
                                        <img src="<?php echo Yii::app()->params->base_url;?>images/changepassword.png" alt="Delete" border="0"/>
                                    </a>
                              	 </td>
                                <td class="alignCenter" width="15">
                                    <a class="delete_this" href="javascript:;"  lang="<?php echo $row['logId'];?>" title="Delete Seeker">
                                        <img src="<?php echo Yii::app()->params->base_url;?>images/false.png" alt="Delete" border="0"/>
                                    </a>
                                </td>
                                
                            </tr>
                            <?php
                            $i++;
						}
					}else{?>
                    <tr>
                    	<td colspan="10">No Record Found</td>
                    </tr>
                    <?php
					}?>
                    <input type="hidden" name="total_acc" id="total_acc" value="<?php echo $i;?>" />
                </table>
            </div>
            <div>
                <div class="floatLeft">
                    <?php
					if($cnt == '1'){?>
                    	&nbsp;
                    <?php 
					}else{?>
                        <span>
                       	 <input type="submit" name="delete_record" id="delete_record" value="Delete" class="btn"/>
                        </span>
                    <?php
					}?>
                </div>
                <div>
                	 <?php 
					 if($cnt > 0 && $data['pagination']->getItemCount()  > $data['pagination']->getLimit()){?>
                    	 <div class="pagination">
                         <?php 
						 $extraPaginationPara='&keyword='.$ext['keyword'].'&sortBy='.$ext['sortBy'].'&startdate='.$ext['startdate'].'&enddate='.$ext['enddate'];
						 $this->widget('application.extensions.WebPager',
										 array('cssFile'=>Yii::app()->params->base_url.'css/style.css',
												 'extraPara'=>$extraPaginationPara,
												'pages' => $data['pagination'],
												'id'=>'link_pager',
						));
					 ?>	
                     </div>
					 <?php  
					 }?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
  	<?php echo CHtml::endForm();?>
</div>
</div>
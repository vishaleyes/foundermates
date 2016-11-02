<script type="text/javascript" src="<?php echo Yii::app()->params->base_url; ?>js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url; ?>js/jquery.fancybox-1.3.1.js"></script>

<link href="<?php echo Yii::app()->params->base_url; ?>css/jquery.fancybox-1.3.1.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo Yii::app()->params->base_url; ?>css/style.css" type="text/css" />
<script type="text/javascript">
function sortData(sortBy,sortType)
{
	 //var url	=	$j(this).attr('lang');
     loadBoxContent('<?php echo Yii::app()->params->base_path;?>entrepreneur/advisorListing/sortType/'+sortBy+'/sortBy/'+sortType+'','MainDiv');
}

function loadBoxContent(urlData,boxid)
{
	mylist=0;
	mytodoStatus=0;
	
	var $j = jQuery.noConflict();
		$j.ajax({			
		type: 'POST',
		url: urlData,
		data: '',
		cache: false,
		success: function(data)
		{
			if(data=="logout")
			{
				window.location.href = '<?php echo Yii::app()->params->base_path;?>';
				return false;	
			}
			$j("#"+boxid).html(data);
			$j('#update-message').removeClass().html('').hide();
		}
		});	
} 

function selectNetworkUser(id,email)
{
	
	parent.$j("#toEmail").val(email);
	parent.$j("#to").val(id);
	
	parent.$j.fancybox.close();	
}

</script>
 
<div id="MainDiv" class="MainDiv">
	 <h2>Advisor List</h2>
     
     <div class="bordertop">
     <hr class="bluethickborder" />
     <hr class="thinborder" />
	</div>
<table cellpadding="0" cellspacing="0" border="0" class="tableListing width700" id="list">
    	<tr>
    		<th width="15%"> 
            	<a href="javascript:;" class="sort" onclick="sortData('<?php echo $ext['sortType'];?>','firstName');" lang='' >
               First Name
				<?php 
				if($ext['img_name'] != '' && $ext['sortBy'] == 'firstName'){ ?>
					<img src="<?php echo Yii::app()->params->base_url;?>images/<?php echo $ext['img_name'];?>" class="sortImage" />
					<?php
				} ?>
                </a>
            </th>
            <th width="7%">
            	<a href="javascript:;" class="sort" onclick="sortData('<?php echo $ext['sortType'];?>','lastName');" lang='' >
                Last Name
				<?php 
				if($ext['img_name'] != '' && $ext['sortBy'] == 'lastName'){ ?>
					<img src="<?php echo Yii::app()->params->base_url;?>images/<?php echo $ext['img_name'];?>" class="sortImage" />
					<?php
				} ?>
                </a>
            </th>
            <th width="10%">
            	<a href="javascript:;" class="sort" onclick="sortData('<?php echo $ext['sortType'];?>','email');" lang='' >
                Email
				<?php 
				if($ext['img_name'] != '' && $ext['sortBy'] == 'email'){ ?>
					<img src="<?php echo Yii::app()->params->base_url;?>images/<?php echo $ext['img_name'];?>" class="sortImage" />
					<?php
				} ?>
                </a>
            </th>
            
            <th width="10%">
            	<a href="javascript:;" class="sort" onclick="sortData('<?php echo $ext['sortType'];?>','city');" lang='' >
                City
				<?php 
				if($ext['img_name'] != '' && $ext['sortBy'] == 'city'){ ?>
					<img src="<?php echo Yii::app()->params->base_url;?>images/<?php echo $ext['img_name'];?>" class="sortImage" />
					<?php
				} ?>
                </a>
            </th>
            
            <th width="10%">
            	<a href="javascript:;" class="sort" onclick="sortData('<?php echo $ext['sortType'];?>','country');" lang='' >
                Country
				<?php 
				if($ext['img_name'] != '' && $ext['sortBy'] == 'country'){ ?>
					<img src="<?php echo Yii::app()->params->base_url;?>images/<?php echo $ext['img_name'];?>" class="sortImage" />
					<?php
				} ?>
                </a>
            
            <th width="10%" class="lastcolumn">Action</th>
		</tr>
        <?php  
		if(count($data) > 0){ $i=0;
			foreach($data['advisors'] as $row){  ?> 
            <tr>
            	<td class="alignCenter">
                	 <?php echo $row['firstName']; ?>
                </td>
                <td class="alignCenter">
                	<?php echo $row['lastName']; ?>
                </td>
                
                <td class="alignCenter">
                	<?php echo $row['email'];?>
                </td>				
                				
                <td class="alignCenter">
                	<?php echo $row['city'];?>
                </td>
                
                <td class="alignCenter">
                	<?php echo $row['country'] ;?>
                </td>
                
                <td style=" text-align:center;" class="lastcolumn">
                	<a href="#" lang="<?php echo $row['id']; ?>" id="myNetwork_<?php echo $row['id']; ?>" onclick="selectNetworkUser('<?php echo $row['user_id']; ?>','<?php echo $row['email'];?>')" >Select</a>
             	</td>
			</tr>
			<?php
           $i++; }
		} else { ?>
			<tr>
            	<td colspan="8" class="lastcolumn alignLeft">
                	Advisor not found.
				</td>
			</tr>
		<?php
		}?>
        </table>
      <div style="margin-right:0px;">
		 <?php
         if(count($data) > 0 && $data['pagination']->getItemCount()  > $data['pagination']->getLimit()){?>
             <div class="pagination">
             <?php 
             $extraPaginationPara='&keyword='.$ext['keyword'].'&sortBy='.$ext['sortBy'].'&country='.$ext['country'].'&city='.$ext['city'].'&industry='.$ext['industry'].'&area_of_expertise='.$ext['area_of_expertise'].'&mentorship_details='.$ext['mentorship_details'];
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

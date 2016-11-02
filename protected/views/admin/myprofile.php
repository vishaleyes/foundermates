<script type="text/javascript">
var bas_path = "<?php echo Yii::app()->params->base_path;?>";
var BASHPATH = "<?php echo Yii::app()->params->base_path;?>";
var imgPath = "<?php echo Yii::app()->params->base_url;?>images";
</script>
<link rel="shortcut icon" href="<?php echo Yii::app()->params->base_url;?>images/favicon.ico" />
<script type="text/javascript">
var $j = jQuery.noConflict();
function validateAll()
{
	
	$j("#submitFormLoader").html('<img src="<?php echo Yii::app()->params->base_url;?>images/progress_indicator_16_gray_transparent.gif" alt="">');
	
	var flag=0;
	if(!validatefName())
	{
		return false;
	}
	//saveProfile();
	return true;
}
function validatefName()
{
	$j('#firstnameerror').removeClass();
	$j('#firstnameerror').html('');
	var fName=document.getElementById('FirstName').value;
	var reg = /^[A-Za-z ]*$/;
	if(fName=='' || fName=="First Name"){
		$j('#firstnameerror').addClass('false');
		$j('#firstnameerror').html('Full name Required.');
		return false;
	}
	else if(!reg.test(fName)){
		$j('#firstnameerror').removeClass();
		$j('#firstnameerror').addClass('false');
		$j('#firstnameerror').html('No special charaters');
		return false;
	}
	else{
		$j('#firstnameerror').removeClass();
		$j('#firstnameerror').addClass('true');
		$j('#firstnameerror').html('Ok');
		return true;
	}
}
function validatelName()
{
	$j('#lastnameerror').removeClass();
	$j('#lastnameerror').html('');
	var fName=document.getElementById('FirstName').value;
	var reg = /^[A-Za-z ]*$/;
	if(fName=='' || fName=="First Name"){
		$j('#lastnameerror').addClass('false');
		$j('#lastnameerror').html('Full name Required.');
		return false;
	}
	else if(!reg.test(fName)){
		$j('#lastnameerror').removeClass();
		$j('#lastnameerror').addClass('false');
		$j('#lastnameerror').html('No special charaters');
		return false;
	}
	else{
		$j('#lastnameerror').removeClass();
		$j('#lastnameerror').addClass('true');
		$j('#lastnameerror').html('Ok');
		return true;
	}
}

function saveProfile()
{
	var fName=document.getElementById('FirstName').value;
	//Yii::app()->params->base_path.'admin/saveAuthor
	var postData	=	$j('#adminProfileform').serialize();
	$j.ajax ({
		url:'<?php echo Yii::app()->params->base_path;?>admin/saveprofile',
		type:'POST',
		data: postData,
		success: function(response)
		{
			
			if(trim(response)=='LOGOUT' || trim(response)=='logout')
			{
				window.location=BASHPATH;
				return false;
			}
				//var obj = $j.parseJSON(response);
				$j(".username").html('<b>Hi '+fName+'</b>');
						$j('#update-message').removeClass();
						$j('#update-message').addClass('msg_success');
						$j('#update-message').html("Successfully Updated");
						setTimeout(function() {
							$j('#update-message').fadeOut();
							$j('#mainContainer').load('<?php echo Yii::app()->params->base_path;?>admin/myprofile&ajax=true');	
						}, 10000 );	
			//inner tab menu
			//close inner tab menu
			return false;
		}
	//	});
	});
}
</script>   
    
<?php if(Yii::app()->user->hasFlash('success')): ?>                                
    <div id="msgbox" class="clearmsg"> <?php echo Yii::app()->user->getFlash('success'); ?></div>
    <div class="clear"></div>
<?php endif; ?>
<?php if(Yii::app()->user->hasFlash('error')): ?>
    <div id="msgbox" class="clearmsg errormsg"> <?php echo Yii::app()->user->getFlash('error'); ?></div>
    <div class="clear"></div>
<?php endif; ?>
<div class="pageNav">
     
  
</div>

<div id="update-message"></div>
<div class="box">
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
                                        <h1 style="margin-left:15px; background:none;">My Profile</h1>
                                    </div>
                                    <div class="contdiv">
                                        <div class="wrapper-big">
                                            <div class="logo-wrap1"></div>
                                            <div class="right-text">
												<?php echo CHtml::beginForm(Yii::app()->params->base_path.'admin/saveProfile','post',array('id' => 'adminProfileform','name' => 'adminProfileform','onsubmit' => 'return validateAll();')) ?>
	<div class="content-box func-para">
		<input type="hidden" name="AdminID" id="AdminID" value="<?php echo $data['adminDetails']['id'];?>" >
		<div class="field-area">
			<div><label>Full Name<span class="star">*</span></label></div> 
			<div>
				<div class="name">
					<div>
						<input type="text" name="FirstName" id="FirstName" style="width:150px; height:30px;" class="textbox" value="<?php echo $data['adminDetails']['first_name'];?>" onkeyup="validatefName()" />
					</div>
					<div class="info"><div class="nameerror"><span id="firstnameerror"></span></div></div>
				</div>
			
				
			</div>
            <div>
				<div class="name">
					<div>
						<input type="text" name="LastName" id="LastName" style="width:150px; height:30px;" class="textbox" value="<?php echo $data['adminDetails']['last_name'];?>" onkeyup="validatelName()" />
					</div>
					<div class="info"><div class="nameerror"><span id="lastnameerror"></span></div></div>
				</div>
			
				
			</div>
			<div class="clear"></div>
		</div>
		<div class="field-area">
			<label>Email<span class="star">*</span></label>
        </div>
        <div class="field-area">
			<input type="text" value="<?php echo $data['adminDetails']['email'];?>" style="width:250px; height:30px;" class="textbox" name="Email" id="Email" readonly="1" />
			<span id="emailerror" ></span>
		</div>
		<div style="display:none" id="eml"></div>
		<div class="field-area btnfield">
			<input type="submit"   name="FormSubmit" id="FormSubmit" class="btn" onclick="validateAll();"  value="Submit" />
			<input name="cancel" type="reset" class="btn" value="Cancel" onclick="javascript:history.go(-1)" />
			<span id="submitFormLoader"></span>
		</div>
	</div>
	<div class="clear"></div>
<?php echo CHtml::endForm();?>
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

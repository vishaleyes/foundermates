<script src="<?php echo Yii::app()->params->base_path_language; ?>languages/<?php echo Yii::app()->session['prefferd_language']?>/global.js" type="text/javascript"></script>
<script type="text/javascript">
var BASHPATH='<?php echo Yii::app()->params->base_path; ?>';
var base_path='<?php echo Yii::app()->params->base_path; ?>';
</script>
<script type="text/javascript">


function boxOpen(id)
{
	$j('#'+id).show();
}

function boxClose(id,fieldId)
{
	$j('#'+id).hide();
}


function validateAllAbout()
{
	if(!validatefName())
	{
		return false;
	}
	if(!validatelName())
	{
		return false;
	}
	
	email=document.getElementById('email').value;
	if(email!='')
	{		
		if($j("#eml").html() == "false")
		{
			return false;
		}
	}
	return true;
}

function validatefName()
{
	$j('#fullnameerror').removeClass();
	$j('#fullnameerror').html('');
	var fName=document.getElementById('fName').value;
	if(fName=='')
	{
		$j('#fullnameerror').addClass('false');
		$j('#fullnameerror').html(msg['FNAME_VALIDATE']);
		return false;
	}
	var reg = msg["FIRST_NAME_REG"];
	if(reg.test(fName))
	{
		$j('#fullnameerror').removeClass();
		$j('#fullnameerror').addClass('true');
		$j('#fullnameerror').html('##_BTN_OK_##');
		return true;
	}
	else
	{
		$j('#fullnameerror').addClass('false');
		$j('#fullnameerror').html(msg['FIRST_NAME_REG_SPECIAL_CHARACTER']);
		return false;
	}
}
function validatelName()
{
	$j('#fullnameerror').removeClass();
	$j('#fullnameerror').html('');
	var lName=document.getElementById('lName').value;
	if(lName=='')
	{
		$j('#fullnameerror').addClass('false');
		$j('#fullnameerror').html(msg['LNAME_VALIDATE']);
		return false;
	}
	var reg = msg["LAST_NAME_REG"];
	if(reg.test(lName))
	{
		$j('#fullnameerror').removeClass();
		$j('#fullnameerror').addClass('true');
		$j('#fullnameerror').html('##_BTN_OK_##');
		return true;
	}
	else
	{
		$j('#fullnameerror').addClass('false');
		$j('#fullnameerror').html(msg['LAST_NAME_REG_SPECIAL_CHARACTER']);
		return false;
	}
}
function validateEmail()
{
	$j('#emailerror').removeClass();
	$j('#emailerror').html('');
	var loginType="<?php echo Yii::app()->session['loginIdType']; ?>";
	if(loginType==0)
	{
		$j('#emailerror').addClass('true');
		$j('#emailerror').html(msg['_RESTRIC_TO_CHANGE_EMAIL_']);
		return true;
	}
	var email=document.getElementById('email').value;
	if(email=='')
	{		
		return true;
	}
	else
	{
		var reg = msg['EMAIL_REG'];
		if(reg.test(email))
		{
			$j.ajax({  
			type: "POST",  
			url: '<?php echo Yii::app()->params->base_path;?>user/checkOtherEmail/type/true' ,  
			data: "email="+email+"&"+csrfToken,  
			success: function(response) 
			{ 
			
				if(response==false)
				{
					$j('#emailerror').removeClass();
					$j('#emailerror').addClass('true');
					$j('#emailerror').html(msg['SUCCESS_EMAIL_VALIDATE_ACCOUNT_MANAGER']);
					$j('#eml').html('true');
				}
				else
				{
					$j('#emailerror').removeClass();
					$j('#emailerror').addClass('false');
					$j('#emailerror').html(msg['EMAIL_NOT_AVAILABLE_VALIDATE_ERROR']);
					$j('#eml').html('false');
				}
			}
			});
			return true;
		}
		else
		{
			$j('#emailerror').removeClass();
			$j('#emailerror').addClass('false');
			$j('#emailerror').html(msg['EMAIL_VALIDATE_VALID_ERROR_ACCOUNT_MANAGER']);
			return false;
		}
	}
}
function editAboutMe()
{
	$j('#update-message').removeClass().html('<div class="updateLoader"><img src="'+imgPath+'/spinner-small.gif" alt="loading" border="0" /> Loading...</div>').show();
	if(!validateAllAbout())
	{
		$j('#update-message').html('');
		return false;
	}
	var post_data = $j("#frm_edit_profile").serialize();
	var email=document.getElementById('email').value;
	var fName=document.getElementById('fName').value;
	var lName=document.getElementById('lName').value;
	var fullname = fName+'&nbsp;'+lName;
	if(email==''){
		email	=	"<a id='add_email' href='javascript:;' rel='<?php echo Yii::app()->params->base_path;?>user/aboutme' title='Add email'  onclick=javascript:$j('#headerLinkAboutme').trigger('click');>##_SEEKER_INDEX_ADD_EMAIL_##</a>";
	}
	
	$j("#btn_submit").attr("disabled","disabled");
	$j("#loader_profile").css('display','block');
	$j.ajax({			
		type: 'POST',
		url: base_path+'user/editProfile&id=1',
		data: post_data,
		cache: false,
		success: function(data)
		{
			
			if(data == "logout")
			{
				window.location.href = "<?php echo Yii::app()->params->base_path; ?>";
			}
			else if(data == "userdelete")
			{
				jConfirm("##_ABOUTME_DELETE_EMAIL_ACCOUNT_##", '##_ABOUTME_EMAIL_CONFIRMATION_DIALOG_##', function(response) {
				if(response==true)
				{
					document.getElementById('deleteyes').value=1;
					editAboutMe();
				}
				else
				{
					$j('#update-message').html('');
					$j('#headerLinkAboutme').trigger('click');
					return false;	
				}
				});
				$j("#loader_profile").css('display','none');
			}
			else
			{
				
				$j("#myfullname").html('<b>'+fullname+'</b>');
				$j(".username").html('<b>Hi '+fullname+'</b>');
				var arr = data.split(',');
				if(arr[0] == 'success')
				{
					$j("#update-message").removeClass().addClass('msg_success');
					$j("#update-message").addClass('msg_success');
					$j("#update-message").html(arr[1]);
					$j("#update-message").fadeIn();
					$j("#btn_submit").attr("disabled",false);
					$j("#loader_profile").css('display','none');	
					
					$j("#email-address").html('<b>'+email+'</b>');
				}	
				else
				{
					$j("#btn_submit").attr("disabled",false);
					$j("#loader_profile").css('display','none');
					$j("#update-message").removeClass().addClass('error-msg');
					$j("#update-message").html(data);
					$j("#update-message").fadeIn();
				}
			}
			
			setTimeout(function() {
				$j('#update-message').fadeOut();
				}, 10000 );
		}
	});
}

$j(document).ready(function() {
	$j(".box_open").click(function(){
		if(trim($j(this).attr("title")) != trim($j(this).html()))
		{
			var id = $j(this).attr("rel");
			id = '#'+id;
			$j(id).val(trim($j(this).html()));
			$j(id).focus().select();
		}
	})
	
	
	/* link */
	$j(".ltf_button").click(function() 
	{   
		var base_path = '<?php echo Yii::app()->params->base_path;?>',
			linkName = $j(this).attr("lang"),
			id="#"+linkName,
			value = $j(id).val(),
			name = $j(id).attr("name"),
			imgName = $j(this).attr("lang"),
			title = $j(this).attr("title"),
			boxId = $j(this).parent().parent().attr("id"),
			fToken = $j('#fToken').val(),
			post_data = "link_value="+value+"&link_name="+name+"&fToken="+fToken,
			post_url = base_path+'user/updateLink';
				
			
		$j.ajax(
		{			
			type: 'POST',
			url: post_url,
			data: post_data+"&"+csrfToken,
			cache: false,
			success: function(data)
			{
				if(data=='success')
				{
					if(value=='')
					{
						$j("#"+name).html(title);
						$j(id+'HomeLink').html('');
					}
					else
					{
						$j("#"+linkName+'HomeLink').html('<img src="<?php echo Yii::app()->params->base_url; ?>images/'+imgName+'-icon.png" />');
						$j("#"+linkName+'HomeLink').attr('href', value);
						$j("#"+name).html(value);
					}
					$j('#'+boxId).hide();
					
				}
				else if(trim(data) == "error")
				{
					$j('#update-message').removeClass().addClass('error-msg');
					$j('#update-message').html(msg['_VALIDATE_ID_']+' '+name);
					
					var scrpos=$j("update-message").scrollTop();
					smoothScroll('update-message');
					
					$j('#update-message').fadeIn();
					setTimeout(function() 
					{
						$j('#update-message').fadeOut();
					}, 10000 );
				}
				else if(trim(data) == 'Invalid_token')
				{
					$j('#update-message').removeClass().addClass('error-msg');
					$j('#update-message').html('Invalid token');
					
					var scrpos=$j("update-message").scrollTop();
					smoothScroll('update-message');
					
					$j('#update-message').fadeIn();
					setTimeout(function() 
					{
						$j('#update-message').fadeOut();
					}, 10000 );
				}
				else
				{
					//window.location.href = base_path+"user";
				}
			}
		});
		
	});
});

function addphone()
{
	var smsOk=0;
	if(document.getElementById('smsOk').checked)
	{
		smsOk=1;	
	}
	phone=document.getElementById('phone').value;
	
	if(phone=='' || phone=="Phone Number"){
		$j('#errorAddPhone').addClass('false');
		$j('#errorAddPhone').html(msg['ONLY_PHONE_VALIDATE']);
		return false;
	}
	
	$j.ajax({  
		type: "POST",  
		url: '<?php echo Yii::app()->params->base_path; ?>user/addUniquePhone' ,  
		data: "userphoneNumber="+phone+"&smsOk="+smsOk+"&"+csrfToken,  
		success: function(response) 
		{
			 if(response=="success")
			 {
				/* $j('#leftphonelist').load(base_path+'user/UserPhoneList',function(){
			 });*/
			 $j('#leftview').load('<?php echo Yii::app()->params->base_path;?>user/leftview',function(){
			 });
				
			    $j('#mainContainer').load(base_path+'user/aboutme',function(){
			 });
			 	$j("#add_phone_box").hide();
				$j("#headerLinkAboutme").trigger('click');	 
			 }
			 else
			 {
				 $j('#errorAddPhone').removeClass().addClass('false');
				 $j("#errorAddPhone").html(response);
			 }
		}
	})
}

function validatePhone()
{
	$j('#errorAddPhone').removeClass();
	$j('#errorAddPhone').html('');
	var VAL1=document.getElementById('phone').value;
	if(VAL1=='' || VAL1=="Phone Number")
	{
		$j('#errorAddPhone').addClass('false');
		$j('#errorAddPhone').html(msg['ONLY_PHONE_VALIDATE']);
		$j('#phn').html('false');
		
		if($j('#eml').html()=='true')
		{
			$j('#errorAddPhone').removeClass();
			$j('#errorAddPhone').html('');
		}
		return false;	
	}
	
	if(!isPhoneNumber(VAL1))
	{	
		$j('#phn').html('false');
		$j('#errorAddPhone').addClass('false');
		$j('#errorAddPhone').html(VAL1+' '+msg['VPHONE_VALIDATE']);
		$j('#verify_now').fadeOut();
		return false;		
	}

	$j('#errorAddPhone').html('<img src="<?php echo Yii::app()->params->base_url; ?>images/spinner-small.gif" alt="Loading">');
	$j.ajax({  
	type: "POST",  
	url: '<?php echo Yii::app()->params->base_path; ?>user/chkphone' ,  
	data: "phoneNumber="+VAL1+"&"+csrfToken,  
	success: function(response) 
	{ 
		if(response==false)
		{
			$j('#errorAddPhone').removeClass();
			$j('#errorAddPhone').addClass('true');
			$j('#errorAddPhone').html(msg['APHONE_VALIDATE']);
			$j('#phn').html('true');
			return true;
		}
		else
		{
			if(response==2)
			{
				$j('#errorAddPhone').addClass('false');
				$j('#errorAddPhone').html(msg['_DUPLICATE_ENTRY_VALIDATE_']);
				$j('#phn').html('false');
			}
			else
			{
				$j('#errorAddPhone').addClass('false');
				$j('#errorAddPhone').html(msg['NAPHONE_VALIDATE']);
				$j('#phn').html('false');
			}
			return false;
		}
	}
	})		
}

// returns true if the string is a US phone number formatted as...
// (000)000-0000, (000) 000-0000, 000-000-0000, 000.000.0000, 000 000 0000, 0000000000
function isPhoneNumber(str){
	var re = msg['PHONE_REG'];
	return re.test(str);
}

$j(".delete_phone").click( function() {		
	deletedId=$j(this).attr('lang');
	jConfirm('##_ABOUTME_PHONE_MESSAGE_##', '##_ABOUTME_PHONE_CONFIRMATION_DIALOG_##', function(response) {
		if(response==true)
		{
			deletePhone(deletedId);
		}
	});
});

function deletePhone(id)
{
	$j('#update-message').html('<img src="<?php echo Yii::app()->params->base_url; ?>images/spinner-small.gif" alt="Loading">');
	
	$j.ajax({
		url:base_path+'user/deletePhone/id/'+id,
		type: "POST",
		cache: false,
		data: csrfToken,
		success: function(data){

			data=trim(data);
			if(trim(data)=='success')
			{
				 $j('#leftview').load('<?php echo Yii::app()->params->base_path;?>user/leftview',function(){
			 });
			  $j('#mainContainer').load(base_path+'user/aboutme',function(){
			 });
			  $j("#headerLinkAboutme").trigger('click');	 
			}
			else if(data=='logout')
			{		
				window.location='<?php echo Yii::app()->params->base_path; ?>';
				return false;
			}
			else
			{
				$j("#update-message").removeClass().addClass('error-msg');
				$j("#update-message").html(data);
				$j("#update-message").fadeIn();
			}

			$j('#update-message').fadeOut();
		}
	});
}
$j(".verify_now_phone").click(function()
{		
	
	tempPhoneNo = $j(this).attr('title');	
	
	$j.ajax(
	{				
		type: 'POST',
		url: base_path+'user/getVerifyCode',
		data: "phone="+$j(this).attr("lang")+"&"+csrfToken,
		cache: false,
		success: function(data)
		{
			$j('#vfcationCodePhone' +tempPhoneNo).html(data);			
			$j('#vfcationCodePhone1' +tempPhoneNo).html(data);				
		}
	});
});

function phoneBoxOpen(id)
{
	$j('#'+id).show();
}

function phoneBoxClose(id,fieldId)
{
	$j('#'+id).hide();
	$j('#errorAddPhone').html('');
	$j('#errorAddPhone').removeClass();
}

function trim(stringToTrim) {
	return stringToTrim.replace(/^\s+|\s+$/g,"");
}
function ltrim(stringToTrim) {
	return stringToTrim.replace(/^\s+/,"");
}
function rtrim(stringToTrim) {
	return stringToTrim.replace(/\s+$/,"");
}
</script>

<div class="container1">
<!------------------------------   Flexible Section Start    ---------------------------->
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
                                <h1 style="margin-left:15px; background:none;">##_MY_PROFILE_##</h1>
                            </div>
                            <div class="contdiv">
                                <div class="wrapper-big">
                                    <div class="logo-wrap1"></div>
                                    <div class="right-text">
                                        <?php echo CHtml::beginForm(Yii::app()->params->base_path.'user/login','post',array('id' => 'frm_edit_profile','name' => 'frm_edit_profile','style'=>"padding:0px; margin:0px;")) ?>

                                            <div>
                                                <div class="colLeft">
                                                    <div class="field">
                                                        <label>##_MY_PROFILE_FULL_NAME_## <span id="fullnameerror"></span></label>
                                                        <input type="text" name="fName" maxlength="18" style="height:30px;width:150px;padding-left:5px" class="textbox width119" id="fName" value="<?php if(isset($data['loginDetails']['firstName'])){ echo $data['loginDetails']['firstName']; } ?>" onblur="validatefName();" onkeyup="validatefName();"/>
                                                        <input type="text" name="lName" maxlength="18" style="height:30px;width:150px;padding-left:5px" class="textbox width119" id="lName" value="<?php if(isset($data['loginDetails']['lastName'])){ echo $data['loginDetails']['lastName']; } ?>" onblur="validatelName();" onkeyup="validatelName();" />
                                                    </div>
                                                    <br />
                                                    <div class="field">
                                                        <label>##_MY_PROFILE_EMAIL_## <span id="emailerror"></span></label>
                                                        <div id="eml" style="display:none">true</div>
                                                        <input type="text" name="email" id="email" readonly="readonly" style="height:30px; width:308px;padding-left:5px" class="textbox readonly width272" value="<?php if(isset($data['loginDetails']['loginId'])){ echo $data['loginDetails']['loginId']; } ?>" onkeyup="validateEmail()" />
                                                    </div>
                                                    
                                                    <div class="clear"></div>
                                                    
                                                        
                                                    <div class="btnfield">
                                                    <input type="submit" onclick="editAboutMe();" style="background-image:url(<?php echo Yii::app()->params->base_url;?>images/submit1.png); background-repeat:no-repeat; width:150px;margin:8px 8px 0 0 !important; cursor:pointer; height:42px; border:none;"  value="" />
                                                                <input type="button" onclick="javascript:window.location='<?php echo Yii::app()->params->base_path; ?>';" style="background-image:url(<?php echo Yii::app()->params->base_url;?>images/cancel.png); background-repeat:no-repeat; width:150px; cursor:pointer; height:42px; border:none;"  value="" />
                                                                
                                                        
                                                       <span id="edit_profile_error"></span>
                                                    </div>
                                                </div>
                                                
                                                <div class="colRight">
                                                    <div class="link">
                                                        <?php /*?><div class="link-icon">
                                                            <?php if(isset($data['smsOk']) && $data['smsOk'] == '0')
                                                            {
                                                            ?>
                                                                <img src="<?php echo Yii::app()->params->base_url; ?>images/telephone-icon.png" height="19" width="19" alt="" border="0" align="top" />
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                                <img src="<?php echo Yii::app()->params->base_url; ?>images/sms.png" height="14" width="19" alt="" border="0" align="top" />
                                                            <?php
                                                            }
                                                            ?>
                                                        </div><?php */?>
                                                        <?php /*?><div class="link-title">
                                                            <div class="title">##_MY_PROFILE_PHONES_##</div>
                                                        </div><?php */?>
                                                    </div>
                                                                    
                                                   <?php /*?> <?php if(isset($data['vPhone']) && $data['vPhone']!='')
                                                    {
                                                    ?>
                                                    <div class="link" id="phone_<?php echo $data['vPhone']['loginId']; ?>">
                                                        <div class="link-icon">&nbsp;</div>
                                                        <div class="link-title width295">
                                                            <div class="links">
                                                                <a href="javascript:;" phone_id="<?php echo $data['vPhone']; ?>" name="loginId" default="##_MY_PROFILE_ADD_PHONE_##" lang="<?php echo $data['vPhone']; ?>" id="profile_phoneNumber">
                                                                  <?php if($data['vPhone']['loginId']!="")
                                                                  {
                                                                   echo $data['vPhone']['loginId'];
                                                                   }
                                                                   else
                                                                   {
                                                                  ?>
                                                                  ##_MY_PROFILE_ADD_PHONE_##
                                                                  <?php
                                                                  }
                                                                  ?>
                                                              </a>
                                                            </div>
                                                            <div class="links">
                                                                <b>[##_MY_PROFILE_PHONE_VERIFIED_##]</b>
                                                            </div>
                                                            <div class="links">
                                                               <?php if(count($data['email']) == 1)
                                                                {
                                                                ?>
                                                                    <a id="oppupref_<?php echo $data['vPhone']['loginId']; ?>" name="verifiedPhone"  class="delete_phone" href="javascript:;" title="<?php echo $data['vPhone']['loginId']; ?>" lang="<?php echo $data['vPhone']['id']; ?>">[##_MY_PROFILE_PHONE_DELETE_NOW_##]</a>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="clear"></div>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php if(isset($data['uPhone']) && $data['uPhone']!='')
                                                    {
                                                    ?>
                                                    
                                                    <div class="link" id="phone_<?php echo $data['uPhone']; ?>">
                                                        <div class="link-icon">&nbsp;</div>
                                                        <div class="link-title width295">
                                                            <div class="links">
                                                                <a href="javascript:;" phone_id="<?php echo $data['uPhone']['loginId']; ?>" name="loginId" default="##_MY_PROFILE_ADD_PHONE_##" lang="<?php echo $data['uPhone']['loginId'] ; ?>" id="profile_phoneNumber">
                                                                  <?php if($data['uPhone']['loginId'] != "")
                                                                  {
                                                                    echo $data['uPhone']['loginId'];
                                                                  }
                                                                  else
                                                                  {
                                                                  ?>
                                                                  ##_MY_PROFILE_ADD_PHONE_##
                                                                  <?php
                                                                  }
                                                                  ?>
                                                              </a>
                                                            </div>
                                                            <div class="links">
                                                                <a id="oppupref_<?php echo $data['uPhone']['loginId']; ?>" onclick="boxOpen('verify_box_phone<?php echo $data['uPhone']['loginId']; ?>')" class="verify_now_phone" href="javascript:;" title="<?php echo $data['uPhone']['loginId']; ?>" lang="<?php echo $data['uPhone']['id']; ?>">[##_MY_PROFILE_PHONE_VERIFY_NOW_##]</a>
                                                            </div>
                                                            <div class="links">
                                                                <a id="oppupref_<?php echo $data['uPhone']['loginId']; ?>" class="delete_phone"  href="javascript:;" title="<?php echo $data['uPhone']['loginId']; ?>" lang="<?php echo $data['uPhone']['id']; ?>" name="unVerifiedPhone" >[##_MY_PROFILE_PHONE_DELETE_NOW_##]</a>
                                                            </div>
                                                            <div class="clear"></div>
                                                            <div class="addBox" id="verify_box_phone<?php echo $data['uPhone']['loginId']; ?>" style="display:none;">
                                                                <p id="vfcationCodePhone<?php echo $data['uPhone']['loginId']; ?>"></p>
                                                                <p class="addBoxBtn"><input type="button" onclick="phoneBoxClose('verify_box_phone<?php echo $data['uPhone']['loginId']; ?>')" class="btn" value="##_BTN_OK_##" /></p>
                                                                <div class="clear"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php 
                                                    if(isset($data['vPhone']) && isset($data['uPhone']) && $data['uPhone']!='' && $data['vPhone']!='')
                                                    { 
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    
                                                    <div class="link">
                                                        <div class="link-icon">&nbsp;</div>
                                                        <div class="link-title">
                                                            <a id="add_phone" onclick="phoneBoxOpen('add_phone_box')" href="javascript:;">##_MY_PROFILE_ADD_REMOVE_PHONE_##</a>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="link">
                                                        <div class="link-icon">&nbsp;</div>
                                                        <div class="link-title width295">
                                                            <div class="addBox" id="add_phone_box" style="display:none;">
                                                               <?php
                                                              if(isset($data['uPhone']['loginId']) && !isset($data['vPhone']['loginId']) &&
                                                                 $data['uPhone']['loginId']!='')
                                                              {
                                                              ?>
                                                                 <p>##_MY_PROFILE_PHONE_DELETE_OR_VERIFY_##</p>
                                                                 <p class="addBoxBtn">
                                                                    <a id="oppupref_<?php echo $data['uPhone']['loginId']; ?>" onclick="boxOpen('verify_box_phone<?php echo $data['uPhone']['loginId']; ?>')" class="verify_now_phone" href="javascript:;" title="<?php echo $data['uPhone']['loginId']; ?>" lang="<?php echo $data['uPhone']['id']; ?>" style="width:auto !important;text-align:left;float:left; color:#666666;">[##_MY_PROFILE_PHONE_VERIFY_NOW_##]</a>
                                                                    <a id="oppupref_<?php echo $data['uPhone']; ?>" class="delete_phone"   href="javascript:;" title="<?php echo $data['uPhone']['loginId']; ?>" lang="<?php echo $data['uPhone']['id']; ?>" style="width:auto !important;text-align:left; float:left; margin-left:10px;color:#666666;">[##_MY_PROFILE_PHONE_DELETE_NOW_##]</a>
                                                                    <span>##_ABOUTME_OR_##</span>
                                                                    <a href="javascript:;" onclick="phoneBoxClose('add_phone_box','phone')" class="ltf_cancel" >##_BTN_CANCEL_##</a>	
                                                                 </p>
                                                               <?php 
                                                              }
                                                              else
                                                              { 
                                                              ?>
                                                                <?php 
                                                                if(isset($data['uPhone']) && isset($data['vPhone']) && $data['vPhone']=='' && $data['uPhone'] == '')
                                                                {
                                                                ?>
                                                                 <p>##_MY_PROFILE_SPECIFY_PHONE_NUMBER_##</p>
                                                                <?php }else{?>
                                                                 <p>##_MY_PROFILE_PHONE_ALREADY_VERIFIED_##</p>
                                                                <?php } ?>
                                                                <input type="text" name="phone" onkeyup="validatePhone()" id="phone" value="" class="textbox"/>
                                                                <p class="checkbox1">
                                                                    <input type="checkbox" checked="checked" class="" name="smsOk" id="smsOk"  /> <span>##_MY_PROFILE_PHONE_RECEIVE_SMS_##</span>
                                                                </p>
                                                                <div class="clear"></div>
                                                                <div class="addBoxBtn">
                                                                    <input type="button" name="Submit" title="" onclick="addphone()" value="##_BTN_SUBMIT_##" class="btn" />
                                                                                
                                                                    <span class="ltf_or">##_ABOUTME_OR_##</span>
                                                                    <a href="javascript:;" onclick="phoneBoxClose('add_phone_box','phone')" class="ltf_cancel" >##_BTN_CANCEL_##</a>	
                                                                </div>
                                                              <?php 
                                                              } 
                                                              ?>
                                                                  <div class="clear"></div>
                                                              </div>
                                                            <span id="errorAddPhone"></span>
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                    
                                                    <?php } ?> <?php */?>
                                                    
                                                    <div class="link">
                                        <!-- Social Link -->
                                                 
                                            <div class="link-icon">
                                                <img src="<?php echo Yii::app()->params->base_url; ?>images/links.png" width="16" height="14" alt="Linkedin" border="0" align="top" />
                                            </div> 
                                            <div class="link-title  width295">
                                                <div class="title">##_MY_PROFILE_SOCIAL_LINKS_##</div>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        
                                                    <div class="link">
                                                        <div class="link-icon">&nbsp;</div>
                                                        <div class="link-title width295">
                                                            <div>
                                                                <a href="javascript:;" name="linkedinLink" class="linkedinLink box_open" title="##_MY_PROFILE_ADD_LINKEDIN_##" id="linkedinLink" onClick="boxOpen('Linkedin_box')" rel="linkedin">
                                                            <?php  if(isset($data['loginDetails']) && $data['loginDetails']['linkedinLink'] != ""){echo $data['loginDetails']['linkedinLink'];}else{?>##_MY_PROFILE_ADD_LINKEDIN_##<?php } ?>
                                                            </a>
                                                            </div>
                                                            <div id="Linkedin_box" style="display:none;" class="addBox">
                                                                <p>##_MY_PROFILE_SPECIFY_LINKEDIN_##</p>
                                                                <p>##_MY_PROFILE_EG_LINKEDIN_##</p>
                                                                <p><input type="text" name="linkedinLink" id="linkedin" value="<?php echo $data['loginDetails']['linkedinLink'];?>" class="textbox"/></p>
                                                                <p class="addBoxBtn">
                                                                    <input type="button" id="btn_linked" name="Submit" title="##_MY_PROFILE_ADD_LINKEDIN_##" value="##_BTN_SUBMIT_##" class="ltf_button btn" lang="linkedin" /> 
                                                                    <span>or</span>
                                                                    <a href="javascript:;" onClick="boxClose('Linkedin_box','linkedin')" class="ltf_cancel" >##_BTN_CANCEL_##</a>
                                                                </p>
                                                                <div class="clear"></div>
                                                            </div>
                                                            <input type="hidden" id="LinkedIn" value="<?php echo $data['loginDetails']['linkedinLink'];?>" />
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="link">
                                                        <div class="link-icon">&nbsp;</div>
                                                        <div class="link-title width295"> 
                                                            <div>
                                                                <a href="javascript:;" name="twitterLink" title="##_MY_PROFILE_ADD_TWITTER_##" class="twitterLink box_open" id="twitterLink" onClick="boxOpen('Twitter_box')" rel="twitter">
                                                            
                                                            <?php if(isset($data['loginDetails']) && $data['loginDetails']['twitterLink'] != ""){echo $data['loginDetails']['twitterLink'];}else{?>##_MY_PROFILE_ADD_TWITTER_##<?php } ?>
                                                        </a>
                                                            </div>
                                                            <div id="Twitter_box" style="display:none;" class="addBox">
                                                                <p>##_MY_PROFILE_SPECIFY_TWITTER_##</p>
                                                                <p>##_MY_PROFILE_EG_TWITTER_##</p>
                                                                <p><input type="text" name="twitterLink" value="<?php echo $data['loginDetails']['twitterLink'];?>" id="twitter" class="textbox"/></p>
                                                                <p class="addBoxBtn">
                                                                    <input type="button" name="Submit" title="##_MY_PROFILE_ADD_TWITTER_##" value="##_BTN_SUBMIT_##" id="btn_twitter" class="ltf_button btn" lang="twitter"  /> 
                                                                    <span>or</span>
                                                                    <a href="javascript:;" onClick="boxClose('Twitter_box','twitter')" class="ltf_cancel" >##_BTN_CANCEL_##</a>
                                                                </p>
                                                                <div class="clear"></div>
                                                            </div>
                                                            <input type="hidden" id="Twitter" value="<?php echo $data['loginDetails']['twitterLink'];?>" />
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="link">
                                                        <div class="link-icon">&nbsp;</div>
                                                        <div class="link-title width295"> 
                                                            <div>
                                                                <a href="javascript:;" name="facebook" class="facebookLink box_open" title="##_MY_PROFILE_ADD_FACEBOOK_##" id="facebookLink" onClick="boxOpen('Facebook_box')" rel="facebook" >
                                                            <?php if(isset($data['loginDetails']) && $data['loginDetails']['facebookLink'] != ""){echo $data['loginDetails']['facebookLink'];}else{?>##_MY_PROFILE_ADD_FACEBOOK_##<?php } ?>
                                                        </a>
                                                            </div>
                                                            <div id="Facebook_box"  class="addBox" style="display:none;">
                                                                <p>##_MY_PROFILE_SPECIFY_FACEBOOK_##</p>
                                                                <p>##_MY_PROFILE_EG_FACEBOOK_##</p>
                                                                <p><input type="text" name="facebookLink" id="facebook" value="<?php echo $data['loginDetails']['facebookLink'];?>" class="textbox"/></p>
                                                                <p class="addBoxBtn">
                                                                    <input type="button" name="Submit" title="##_MY_PROFILE_ADD_FACEBOOK_##" value="##_BTN_SUBMIT_##" class="ltf_button btn" lang="facebook" /> 
                                                                    <span>or</span>
                                                                    <a href="javascript:;" onClick="boxClose('Facebook_box','facebook')" class="ltf_cancel" >##_BTN_CANCEL_##</a>
                                                                </p>
                                                                <div class="clear"></div>
                                                            </div>
                                                            <input type="hidden" id="Facebook" value="<?php echo $data['loginDetails']['facebookLink'];?>" />
                                                        </div>
                                                    </div> 
                                                </div>
                                                
                                                <div class="clear"></div>
                                            </div>
                                            
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
<!-------------------------------   Flexible Section End   --------------------------------> 
</div>

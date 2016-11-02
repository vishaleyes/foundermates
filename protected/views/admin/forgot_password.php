<script type="text/javascript">
function validateform()
{
	var reg = msg['EMAIL_REG'];
	
	if(!validateEmail())
	{
		return false;
	}
		
	return true;	

}
function validateEmail()
{
	$j('#emailerror').removeClass();
	$j('#emailerror').html('');
	var VAL1=document.getElementById('loginId').value;
	
	if(VAL1=='' || VAL1=='##_FORGOT_EMAIL_PHONE_VAL_##')
	{
		$j('#emailerror').addClass('false');
		$j('#emailerror').html(msg['EMAIL_PHONE']);
		return false;	
	
	}
	
	var reg = msg['EMAIL_REG'];
	var phoneReg = msg['PHONE_REG'];
 
	if (reg.test(VAL1) || phoneReg.test(VAL1)) 
	{
			$j('#emailerror').removeClass();
			$j('#emailerror').addClass('true');
			$j('#emailerror').html('ok.');
			return true;
	}	
	else
	{
		$j('#emailerror').addClass('false');
		$j('#emailerror').html(msg['VEMAIL_PHONE']);
		return false;
					
	}
}

</script>

     <div class="container1">

            <!---------------------------------         Flexible Section Start    ----------------------------------------->
            
            <div class="box">
              <div class="toppannel">
                <div class="boxtopm">
                <div class="boxtopl">
                <div class="boxtopr"></div></div></div></div>
              <div class="middlepannel">
              <div class="mid">
              <div class="midl">
                <div class="midr">
                <div class="cont">   
                <div class="headingtop"><h1 style="margin-left:15px; background:none;">Forgot Password</h1></div>
                <div class="contdiv" align="center">
                 
			<div class="wrapper-big">
    <div class="logo-wrap1">
        
    </div>
    <div class="right-text">        
       
        <div class="clear"></div>
        
       
		<?php echo CHtml::beginForm(Yii::app()->params->base_path.'admin/forgotPassword','post',array('id' => 'forgotpassform','name' => 'forgotpassform','onsubmit' => 'return validateform();')) ?>
           <p align="left"> KWEXC will send you instruction on how to reset your password to the email address associated with your account. If you have not yet registered then please register from the homepage.</p></br>
            <div>
                <div class="field" style="margin-left:220px;" >
                    <label>Enter Email Address:<span id="emailerror"></span></label>
                        <input type="text" id="loginId" name="loginId" class="textbox3" onfocus="this.style.color='black';"  maxlength="256" value="<?php if(isset($loginId)){ echo $loginId; }?>" />
                </div>
                <div class="clear"></div>
               	<table>
                <tr>
                <td class="captcha1">
						<?php $this->widget('CCaptcha'); echo Chtml::textField('verifyCode',''); ?> 
                </td>
                </tr>
                </table>
              
                <div class="clear"></div>
                
                <div class="fieldBtn"> 
                    &nbsp&nbsp;<input type="submit" style="background-image:url(<?php echo Yii::app()->params->base_url;?>images/submit1.png); background-repeat:no-repeat;margin:8px 42px 0 0 !important; width:150px; cursor:pointer; height:42px; border:none;"  value="" />
                    
                    <input type="button" onclick="javascript:window.location='<?php echo Yii::app()->params->base_path; ?>admin/index';" style="background-image:url(<?php echo Yii::app()->params->base_url;?>images/cancel.png); background-repeat:no-repeat;margin:8px 42px 0 -12px !important; width:150px; cursor:pointer; height:42px; border:none;"  value="" />
                </div>
                <div class="clear"></div>
            </div>
        <?php echo CHtml::endForm(); ?> 
        <div class="clear"></div>
    </div> 
    <div class="clear"></div>             
</div>               
			 </div>
                <div class="headingbot"></div>
                </div>
                </div></div>
                
                
                
                </div></div>
              <div class="botompannel">
              <div class="boxbotm">
                <div class="boxbotl">
                <div class="boxbotr"></div></div></div></div>
            </div>
            <!---------------------------------         Flexible Section End    -----------------------------------------> 
</div>


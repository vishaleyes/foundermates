<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<title>##_SITENAME_##<?php 
		if(isset(Yii::app()->session['accountType'])){
            if(Yii::app()->session['accountType'] == 1){?>
                - Employer
			<?php
			}else{ ?>
                - Seeker
            <?php
			}
        }
		?>
</title>
<head>
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->params->base_url; ?>css/iphonenav.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->params->base_url; ?>css/##_SITENAME_NO_CAPS_##/##_SITENAME_NO_CAPS_##-iphone.css" />

<link rel="shortcut icon" href="<?php echo Yii::app()->params->base_url; ?>images/##_SITENAME_NO_CAPS_##/logo/favicon.ico" />
<link rel="apple-touch-icon" href="<?php echo Yii::app()->params->base_url; ?>images/logo/apple-touch-icon.png" />

<script src="<?php echo Yii::app()->params->base_url;?>js/jquery-1.4.2.min.js" type="text/javascript"></script>


</head>
<body style="overflow-y:scroll;">
<!--{if $generalError ==  '1' }
    <div style="background-color:#FEECEC;">
        <p style="font-weight:bold; color:#000; text-align:center; margin-top:0;">The user has not setup profile</p>
        <p style=" text-align:center; color:#000;">Try going to the <a href="{$base_path}" title="##_SITENAME_##" style="color:#0080C8;">##_SITENAME_##</a> home page and navigating to your page from there.</p>
        <p style=" text-align:center; margin-bottom:0; padding-bottom:2px; color:#000;">You can <a href="{$base_path}user/contactus" title="contact us" style="color:#0080C8;">contact us</a> if you need help.</p>
    </div>--> <!--"wrapper mainlogin" DIV ENDS HERE-->
<!--{/if}-->
<div class="header">
    <h1>
        <a href="<?php echo Yii::app()->params->base_path; ?>muser/login"><img src="<?php echo Yii::app()->params->base_url; ?>images/##_THEME_NAME_##/logo/##_SITENAME_NO_CAPS_##-215.png" alt="" border="0" />
        <?php 
		if(isset(Yii::app()->session['accountType'])){
            if(Yii::app()->session['accountType'] == 1){?>
                <div class="login-side">##_SEEKER_VIEW_MORE_EMPLOYER_##</div>
			<?php
			}else{ ?>
                <div class="login-side">##_EMAIL_TMP_SIGNUP_SEEKER_ADMIN_SEEKER_##</div>
            <?php
			}
        }
		?>
        </a>
    </h1>
    <h2><a href="<?php echo Yii::app()->params->base_path; ?>muser/contactUs">##_MOBILE_USER_FOOTER_CONTACT_##</a></h2>
 <div style="clear:both;"></div>
 </div>
 <?php 
 if(isset(Yii::app()->session['fmuserId'])){?>
 <div align="center" class="main">
    <div class="content">
 	<div class="welcome">
        <div class="welcome-text">
            <label>##_MOBILE_EMPLOYER_HEADER_WELCOME_## <?php echo Yii::app()->session['fullname']; ?> </label>
        </div>
        <div class="logout-btn">
            <label>
                <form name="logout" action="<?php echo Yii::app()->params->base_path;?>muser/logout" method="post"> 
                    <input type="submit" style="float:right; margin:0px 5px 0px 0px;" name="submit_logout" onclick="javascript:window.location='<?php echo Yii::app()->params->base_path;?>muser/logout';" class="btn" value="##_BTN_LOGOUT_##" />
                </form>
            </label>
        </div>
        <div class="clear"></div>
	</div>
<?php
 }
echo $content; ?>
<?php
 
if(isset(Yii::app()->session['accountType'])){
	if(Yii::app()->session['accountType'] == 1){?>
		
        <?php if(isset($data['page_name']) && $data['page_name'] != ''){?>
        <div class="page-nav"><a href="<?php  echo Yii::app()->params->base_path;?><?php echo $data['page_link'];?>">##_EMPLOYER_HEADER_PAGE_## <?php echo $data['page_name'];?></a></div>
    <?php }?>
           <div class="list-wrapper">
              <ul class="list">
                <li><a href="<?php echo Yii::app()->params->base_path;?>memployer">##_MOBILE_EMPLOYER_FOOTER_HOME_##<span>&nbsp;</span></a></li>
                <li><a href="<?php echo Yii::app()->params->base_path;?>memployer/businessProfile">##_MOBILE_EMPLOYER_HEADER_BUSINESS_PROFILE_##<span>&nbsp;</span></a></li>
                <li><a href="<?php  echo Yii::app()->params->base_path;?>memployer/myProfile">##_EMPLOYER_HEADER_MY_PROFILE_##<span>&nbsp;</span></a></li>
                <li><a href="<?php echo Yii::app()->params->base_path;?>memployer/pendingHireRequest">##_MOBILE_EMPLOYER_FOOTER_PENDING_HIRE_##<span>&nbsp;</span></a></li>
                <li><a href="<?php echo Yii::app()->params->base_path;?>memployer/recentActivities">##_MOBILE_EMPLOYER_FOOTER_RECENT_ACTIVITIES_##<span>&nbsp;</span></a></li>
                <li><a href="<?php echo Yii::app()->params->base_path;?>memployer/statisticFooter">##_MOBILE_EMPLOYER_FOOTER_STATISTICS_##<span>&nbsp;</span></a></li>
                <li><a href="<?php echo Yii::app()->params->base_path;?>memployer/getFavourites">##_FAVOURITES_##<span>&nbsp;</span></a></li>
                <li><a href="<?php echo Yii::app()->params->base_path;?>memployer/accountSetting">##_MOBILE_EMPLOYER_FOOTER_ACCOUNT_SETTING_##<span>&nbsp;</span></a></li>
              </ul>
           </div>    
           <div class="footer-nav-bg" align="left">
                 <div class="footerlinks">
                        <a href="<?php  echo Yii::app()->params->base_path;?>muser/login">##_MOBILE_EMPLOYER_FOOTER_HOME_##</a><span>|</span><a href="#">##_MOBILE_EMPLOYER_FOOTER_TOP_##</a><span>|</span><?php if(Yii::app()->session['seekerId'] != ""){?><a href="<?php  echo Yii::app()->params->base_path;?>mtos/seeker">##_MOBILE_EMPLOYER_FOOTER_TOC_##</a><?php }elseif(Yii::app()->session['employerId'] != ""){?><a href="<?php  echo Yii::app()->params->base_path;?>mtos/employer">##_MOBILE_EMPLOYER_FOOTER_TOC_##</a><?php }else{?><a href="<?php  echo Yii::app()->params->base_path;?>mtos">##_MOBILE_EMPLOYER_FOOTER_TOC_##</a><?php }?><span>|</span><a href="<?php  echo Yii::app()->params->base_path;?>muser/privacy">##_MOBILE_EMPLOYER_FOOTER_PRIVACY_##</a><span>|</span><a href="<?php  echo Yii::app()->params->base_path;?>muser/about">##_MOBILE_EMPLOYER_FOOTER_ABOUT_##</a>					
                </div>
           </div>	   
          <div id="footer" align="center" class="footer">
                <label>##_MOBILE_USER_FOOTER_## <a href="http://finditnear.com/m">finditnear.com</a>  </label>
                <span><a href="<?php  echo Yii::app()->params->base_path;?>muser/language" class="share_link_footer">##_HOME_LANGUAGE_##</a></span>
           </div>
        </div>
    </div>	   
    </body>
    </html>
	<?php
    }elseif(Yii::app()->session['accountType'] == 0){ ?>
		<div class="list-wrapper">
			 <ul class="list">
				<li><a href="<?php echo Yii::app()->params->base_path;?>mseeker/index">##_MOBILE_SEEKER_FOOTER_HOME_##<span>&nbsp;</span></a></li>
				<li><a href="<?php echo Yii::app()->params->base_path;?>mseeker/myProfile">##_SEEKER_HEADER_PROFILE_##<span>&nbsp;</span></a></li>
				<li><a href="<?php echo Yii::app()->params->base_path;?>mseeker/index">##_MOBILE_SEEKER_FOOTER_RECENT_HIRE_##<span>&nbsp;</span></a></li>
				<li><a href="<?php echo Yii::app()->params->base_path;?>mseeker/recentActivities">##_MOBILE_SEEKER_FOOTER_RECENT_ACTIVITIES_##<span>&nbsp;</span></a></li>
				<li><a href="<?php echo Yii::app()->params->base_path;?>mseeker/accountSetting">##_MOBILE_SEEKER_FOOTER_ACCOUNT_SETTING_##<span>&nbsp;</span></a></li>
			 </ul>
	   </div>
		<div class="footer-nav-bg" align="left">
       		 <div class="footerlinks">
             		<a href="<?php echo Yii::app()->params->base_path;?>muser/login">##_MOBILE_SEEKER_FOOTER_HOME_##</a><span>|</span><a href="#">##_MOBILE_SEEKER_FOOTER_TOP_##</a><span>|</span><?php if(Yii::app()->session['seekerId'] != ""){?><a href="<?php echo Yii::app()->params->base_path;?>mtos/seeker">##_MOBILE_SEEKER_FOOTER_TOC_##</a><?php }elseif(Yii::app()->session['employerId'] != ""){?><a href="<?php echo Yii::app()->params->base_path;?>mtos/employer">##_MOBILE_SEEKER_FOOTER_TOC_##</a><?php  }else { ?><a href="<?php echo Yii::app()->params->base_path;?>mtos">##_MOBILE_SEEKER_FOOTER_TOC_##</a><?php } ?><span>|</span><a href="<?php echo Yii::app()->params->base_path;?>muser/privacy">##_MOBILE_SEEKER_FOOTER_PRIVACY_##</a><span>|</span><a href="<?php echo Yii::app()->params->base_path;?>muser/about">##_MOBILE_SEEKER_FOOTER_ABOUT_##</a>
              </div>		
		</div>	  
		<?php /*?><div id="footer" align="center" class="footer">
            <label>##_MOBILE_USER_FOOTER_## <a href="http://finditnear.com/m">finditnear.com</a>  </label>
            <span><a href="<?php echo Yii::app()->params->base_path;?>muser/language" class="share_link_footer">##_HOME_LANGUAGE_##</a></span>
       </div><?php */?>
	</div>
</div>
    <div id="footer" class="footer">
       
            <label>##_MOBILE_USER_FOOTER_## <a href="http://finditnear.com/m">finditnear.com</a>  </label>
            <span><a href="<?Php echo Yii::app()->params->base_path;?>muser/language" class="share_link_footer">##_HOME_LANGUAGE_##</a></span>
       </div>
</body>
</html>
<?php 
		//include();
	}
}else{
?>
   
       <div id="footer" class="footer">
       
            <label>##_MOBILE_USER_FOOTER_## <a href="http://finditnear.com/m">finditnear.com</a>  </label>
            <span><a href="<?Php //echo Yii::app()->params->base_path;?>muser/language" class="share_link_footer">##_HOME_LANGUAGE_##</a></span>
       </div>

       
<?php } ?>
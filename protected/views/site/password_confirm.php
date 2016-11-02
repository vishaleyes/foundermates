<div class="wrapper-small12" style="margin-left:150px;">     
         <div class="container2">

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
                <div class="headingtop"><h1 style="margin-left:10px;">Reset Password</h1></div>
               
                
                   <div class="contdiv">
                 
			<div class="wrapper-big">
    <div class="logo-wrap1">
        
    </div>
    <div class="right-text" style="margin-left:110px;">        
       
        <div class="clear"></div>
        
       
		<?php echo CHtml::beginForm(Yii::app()->params->base_path.'site/setResetPassword','post',array('id' => 'forgotpassform','name' => 'forgotpassform','onsubmit'=>'return validateform()')) ?>
            <div align="left" style="position:relative; right:100px;">
                <div class="field">
                    <label>Please choose a password for your Foundermates account:<span id="emailerror"></span></label>
                        <input type="password" id="new_password" name="new_password" class="textbox3" onfocus="this.style.color='black';"  maxlength="256" value="" />
                        <input type="hidden" name="token" id="token" value="<?php echo $token; ?>">
                </div>
                <div class="clear"></div>
                
              
                <div class="clear"></div>
                
                <div class="fieldBtn" align="left" style="width:338px; position:relative;right:90px;"> 
                    &nbsp&nbsp;
                    <input type="submit" class="btnblue"  value="Submit" />
                </div>
                <div class="clear"></div>
                <div class="clear"></div>
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
              <div class="botompannel">
              <div class="boxbotm">
                <div class="boxbotl">
                <div class="boxbotr"></div></div></div></div>
            </div>
            <!---------------------------------         Flexible Section End    -----------------------------------------> 
</div>
     
    
    
    </div> 
    <div class="clear"></div>             
</div>
</div>
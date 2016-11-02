<?php if(Yii::app()->user->hasFlash('success')): ?>                                
    <div id="msgbox" class="clearmsg"> <?php echo Yii::app()->user->getFlash('success'); ?></div>
    <div class="clear"></div>
<?php endif; ?>
<?php if(Yii::app()->user->hasFlash('error')): ?>
    <div id="msgbox" class="clearmsg errormsg"> <?php echo Yii::app()->user->getFlash('error'); ?></div>
    <div class="clear"></div>
<?php endif; ?>   

<h1>
	<a href="<?php echo Yii::app()->params->base_path;?>admin/product">User</a> <img src="<?php echo Yii::app()->params->base_url;?>images/path-arrow.png" alt="" border="0" /> <?php echo $title;?>
</h1>
<?php echo CHtml::beginForm(Yii::app()->params->base_path.'admin/saveClient','post',array('id' => 'functionForm','name' => 'functionForm')) ?>
        <div class="content-box func-para">
            
            <div class="field-area">
                <div><label>Full Name<span class="star">*</span></label></div> 
                <div>
                    <div class="name">
                        <div>
                            <input type="text" name="firstName" id="firstName" class="textbox" value="<?php echo $result['firstName'];?>" />
                        </div>
                        <div class="info"><div class="nameerror"><span id="firstnameerror"></span></div></div>
                    </div>
                    
                    <div class="name">
                        <div>
                            <input type="text" name="lastName" id="lastName" class="textbox" value="<?php echo $result['lastName'];?>" />
                        </div>
                        <div class="info"><div class="nameerror"><span id="lastnameerror"></span></div></div>
                    </div>
                </div>
                <div>
                    
                <div class="clear"></div>
            </div>    
            <div class="field-area">
                <div><label>Email<span class="star">*</span></label></div>
                <div>
                    <input type="text" value="<?php echo $result['Email'];?>" class="textbox" name="Email" id="Email"  />
                    <span id="emailerror" ></span>
                </div>
            </div>        
            <div class="select">
                <div><label>No of Users<span class="star">*</span></label></div>
                <div>
                	<select id="users" name="users" >
                    <option>Please select the no of users&nbsp;</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                	</select>
                </div>
            </div>   
            
            <div class="field-area">
                <div class="terms">
                    <div>
                        <input type="submit" name="FormSubmit" id="FormSubmit" class="btn"  value="Submit" />
                        <input name="cancel" type="reset" class="btn" value="Cancel" onclick="javascript:history.go(-1)" />
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
	    <input type="hidden" <?php if(isset($result['product_id'])){ ?> value="<?php echo $result['product_id']; ?>" <?php } ?> name="product_id"/>
<?php echo CHtml::endForm();?>
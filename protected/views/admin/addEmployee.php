<?php if(Yii::app()->user->hasFlash('success')): ?>                                
    <div id="msgbox" class="clearmsg"> <?php echo Yii::app()->user->getFlash('success'); ?></div>
    <div class="clear"></div>
<?php endif; ?>
<?php if(Yii::app()->user->hasFlash('error')): ?>
    <div id="msgbox" class="clearmsg errormsg"> <?php echo Yii::app()->user->getFlash('error'); ?></div>
    <div class="clear"></div>
<?php endif; ?>   

<h1>
	<a href="<?php echo Yii::app()->params->base_path;?>admin/employee">Employee</a> <img src="<?php echo Yii::app()->params->base_url;?>images/path-arrow.png" alt="" border="0" /> <?php echo $title;?>
</h1>
<?php echo CHtml::beginForm(Yii::app()->params->base_path.'admin/addEmployee','post',array('id' => 'functionForm','name' => 'functionForm')) ?>
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
                </div>
                <div>
                    <div class="name">
                        <div>
                            <input type="text" name="lastName" id="lastName" class="textbox" value="<?php echo $result['lastName'];?>" />
                        </div>
                        <div class="info"><div class="nameerror"><span id="lastnameerror"></span></div></div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>    
            <div class="field-area">
                <div><label>Email<span class="star">*</span></label></div>
                <div>
                    <input type="text" value="<?php echo $result['email'];?>" class="textbox" name="email" id="email"  />
                    <span id="emailerror" ></span>
                </div>
            </div>        
            <div class="field-area">
                <div><label>Contact Number<span class="star">*</span></label></div>
                <div>
                    <input type="text" value="<?php echo $result['contact_no'];?>" class="textbox" name="contact_no" id="contact_no" />
                </div>
            </div>      
            <div class="field-area">
                <div><label>Salary<span class="star">*</span></label></div>
                <div>
                    <input type="text" value="<?php echo $result['salary'];?>" class="textbox" name="salary" id="salary" />
                </div>
            </div>
            <div class="field-area">
                <div><label>Status<span class="star">*</span></label></div>
                <div>
                    <input type="radio" name="status"  id="status" value="1" <?php if(isset($result['status']) && $result['status']==1){ ?>  checked="checked" <?php }else{ ?>checked="checked" <?php } ?>/>Active
                    <input type="radio" name="status" <?php if(isset($result['status']) && $result['status']==0){ ?> checked="checked" <?php } ?>  id="status" value="0"/>Inactive	
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
	    <input type="hidden" <?php if(isset($result['employee_id'])){ ?> value="<?php echo $result['employee_id']; ?>" <?php } ?> name="employee_id"/>
<?php echo CHtml::endForm();?>
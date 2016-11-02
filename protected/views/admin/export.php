<link rel="stylesheet" type="text/css" href="style.css" />

<div class="admincontent">


<h2>Export Data</h2>
     
     <div class="bordertop">
     <hr class="bluethickborder" />
     <hr class="thinborder" style="margin-left: -25px;" />
	</div>
</div>



<div class="profileContainer" style="padding-left:170px; height:auto !important; width:400px !important; float:left;">
	<div class="per_det" style="float:none; width:100%;" >
	<h3  style="    background-color: #10BEF8;
    height: 33px;
    margin: 0 0 10px -10px;
    padding-bottom: 0;
    padding-left: 10px;
    font-size:26px;
    color:#FFF;
    padding-top: 5px;"><img src="<?php echo Yii::app()->params->base_url; ?>images/photo_icon.png" />  Enterprenuers Data</h3>
	    
	  <form action="<?php echo Yii::app()->params->base_path;?>admin/exportEntData" method="post" >
        <div style="height:60px;">
        <input type="submit" class="btnblue" value="Export" /> 
        </div>
       </form>
    </div>
 </div> 
 <div class="profileContainer" style="padding-left:170px; height:auto !important; width:400px !important;float:left;">
	<div class="per_det" style="float:none; width:100%;" >
	<h3  style="    background-color: #10BEF8;
    height: 33px;
    margin: 0 0 10px -10px;
    padding-bottom: 0;
    padding-left: 10px;
    font-size:26px;
    color:#FFF;
    padding-top: 5px;"><img src="<?php echo Yii::app()->params->base_url; ?>images/photo_icon.png" />  Advisors Data</h3>
	    
	  <form action="<?php echo Yii::app()->params->base_path;?>admin/exportAdvisorsData" method="post" >
        <div style="height:60px;">
        <input type="submit" class="btnblue" value="Export" /> 
        </div>
       </form>
    </div>
 </div>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>KWEXC&trade; : Inner Page</title>
    <link href="yourstyle.css" rel="stylesheet" type="text/css">
	</head>

<body>
<div class=skipnavbutton><span class=off><a class=off tabIndex=1 href="#topnavholder">Skip to Top navigation</a></span></div>
<div class=skipnavbutton><span class=off><a class=off tabIndex=1 href="#content_mid_insd_mid">Skip to Content</a></span></div><div class="inpg_cntcontainer">
  <div class="inpg_maincnt">
  <div class="inpg_maincnt_tp">
  	<div class="inpg_maincnt_insd_lft">
    	<div class="box_tp"></div>
        <div class="box_mid">
          <table width="606" border="0" cellspacing="0" cellpadding="0" class="" style="color:#826E89;">
            <tr>
              <td width="29" height="50" bgcolor="#E9E9E9">&nbsp;</td>
              <td width="341" bgcolor="#E9E9E9"><h1>Recent Payments</h1></td>
              <td width="236" bgcolor="#E9E9E9"><?php /*?><input type="button"  name="createOrder"  id="createOrder" onclick="window.location.href='<?php echo Yii::app()->params->base_path;?>user/createOrder'" class="button-big" value="CREATE PAYMENT" /><?php */?>
              <a href="<?php echo Yii::app()->params->base_path;?>user/createOrder"><img src="images/newpayment.png"  style="margin-bottom:10px; margin-left:40px;" border="0"></a>
              </td>
            </tr>
           <?php /*?> <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <!--<td style="background-image:url(images/inpg-search.png); height:42px; background-repeat:no-repeat;"><input name="textfield" type="text" id="textfield" style="margin: 8px; width:310px; height:24px; border: none; padding-left:10px;" value="Search By Amount"></td>-->
               <td>&nbsp;</td>
              <!--<td><a href="<?php //echo Yii::app()->params->base_path;?>user/createOrder"><img src="images/newpayment.png" width="198" height="42" border="0"></a></td>-->
            </tr><?php */?>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2" style="background-image:url(images/refresh.png); background-repeat:no-repeat; background-position:center;"><br>
<br>
               <table width="580" border="0" cellspacing="5" cellpadding="5" style="font-size:13px; vertical-align:middle;">
               
                 <?php
				 $generalObj = new General();
				if(isset($orderList[1]) && !empty($orderList[1]))
				{ ?>
				  <tr style="font-size:14px;">
                      <th align="left" colspan="2">Payment Status</th>
                      
                      <th align="left">Created</th>
                      <th align="left">Recipient</th>
                      <th align="right">Amount</th>
                      <th align="left">&nbsp;&nbsp;</th>
                  
                 </tr>
                <?php 	
					
				 $totalAMount = 0;
				 
				 foreach($orderList[1] as $row){?>
                 <tr>
                       <td width="11%" align="left">
                       <?php if($row['status']==1){ ?>
                      <img src="<?php echo Yii::app()->params->base_url;?>images/checkbox.png" width="50" style="margin-top:10px;" title="Pending"> 
                       <?php }elseif($row['status']==2){?>
                       <img src="<?php echo Yii::app()->params->base_url;?>images/checkbox2.png" width="50" style="margin-top:10px;" title="Waiting for Execution">                 
					   <?php }elseif($row['status']==3){ ?>
                        <img src="<?php echo Yii::app()->params->base_url;?>images/checkbox3.png" width="50" style="margin-top:10px;" title="Executed">  
                          <?php } elseif($row['status']==4){ ?>
                          <img src="<?php echo Yii::app()->params->base_url;?>images/checkbox4.png" width="50" style="margin-top:10px;" title="Paid to Recipient">    
                          <?php } else { ?>
                          <img src="<?php echo Yii::app()->params->base_url;?>images/checkbox5.png" width="50" style="margin-top:10px;" title="Cancelled">    
                          <?php } ?>
                       &nbsp;</td>
                       <td width="11%" align="left">
                        <?php if($row['status']==1){ ?>
                       Waiting
                        <?php }elseif($row['status']==2){?>
                        In-Execution
                        <?php }elseif($row['status']==3){ ?>
                        Executed
                         <?php } elseif($row['status']==4){ ?>
                        Paid
                         <?php } else { ?>
                         Cancelled
						 <?php } ?>
                       </td>
                       
                     <td width="18%" align="left"><?php if(substr($row['created'],0,10)!=''){echo date('d-m-Y',strtotime(substr($row['created'],0,10))); }else { echo '-Not Set-';} ?></td>
                     <td width="27%" align="left"><?php echo $row['recipientName'];?></td>
                     <td width="25%" align="right"><?php echo $row['payment'];?> <?php echo $row['source'];?> > <?php echo $row['targetCurrency'];?></td>
                     <td width="10%" align="left">
                     <?php if($row['status']==1) {  ?>
                     <a href="<?php echo Yii::app()->params->base_path;?>user/getInvoiceDataFromDB/id/<?php echo $row['id'];?>">View</a>
                     <?php  } else { ?>
                     <a href="<?php echo Yii::app()->params->base_path;?>user/editOrderDetails/id/<?php echo $row['id'];?>">View</a>
                     <?php } ?>
                     </td>
               </tr>
                 
				<?php 
					$totalAMount = $totalAMount + $row['payment']; 
				} 
				
				}else{ ?>
                 
                  <tr>
                  <td align="center"><p>This is where you'll find your payment history.<br>
                    It seems you are new here. Go a head and make your first payment</p></td>
                </tr>
               <?php } ?>
            </table>
          
              <br>
             <?php /*?> <?php if(!empty($orderList[0]) && $orderList[0]->getItemCount()  > $orderList[0]->getLimit()){?>

			<div class="pagination">
			<?php
			
			$this->widget('application.extensions.WebPager', 
			array('cssFile'=>true,
					  'pages' => $orderList[0],
					 'id'=>'link_pager',
			));
			?> </div> <?php
			} ?><?php */?>
</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><br></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td bgcolor="#E9E9E9">&nbsp;</td>
              <td colspan="2" bgcolor="#E9E9E9"><br>
                <table width="577" border="0" cellspacing="0" cellpadding="0">
                  
                  <tr>
                    <td width="555" align="right">
                     <?php if(isset($orderList[1]) && !empty($orderList[1]))
				{ ?>
            <p align="right" style="margin-right:-10px;"> <a href="<?php echo Yii::app()->params->base_path;?>user/paymentListing">View all</a></p> <?php } ?>
                     <?php /*?><?php if(isset($orderList[1]) && !empty($orderList[1]))
				{ ?>
                    <h3>Total Transferred: &pound;<?php if(isset($totalAMount) && $totalAMount!=0 && $totalAMount!=''){ echo $totalAMount; }?> GBP</h3>
                    <?php } ?><?php */?>
                    <br>
                    </td>
                    <td width="22">&nbsp;</td>
                  </tr>
                </table></td>
            </tr>
          </table>
        </div>
        <div class="box_btm"></div>
    </div>
    
 
    <div class="inpg_maincnt_insd_rt">
      <table width="316" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="316" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="206"><h1>Recent Recipients</h1></td>
              <td width="110" align="right"><a href="<?php echo Yii::app()->params->base_path ; ?>user/receipientList">See All</a></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="316" border="0" cellspacing="0" cellpadding="0">
           
           <?php if(count($recentReceipient) > 0){ ?>
             <?php foreach($recentReceipient as $row) {  ?>
            	 <tr>
              <td width="70"><br>
              <a href="<?php echo Yii::app()->params->base_path;?>user/getReceipient/personId/<?php echo $row['id'];?>/bussId/<?php echo $row['recBusinessId'];?>">
              
                          		<?php   $recPersonObj = new RecPersonAccount();
							$result = $recPersonObj->findByPk($row['id']);
							$result = $result->attributes;
							$algo=new Algoencryption();	
								$newdir=$algo->encrypt("USER_".$row['id']);
								$imagePath =  "assets/upload/receipient/".$newdir."/".$result['avatar'] ;
								//var_dump( file_exists($imagePath));
								
							if($result['avatar']!='' && file_exists($imagePath) )
							{
								
					?>
                                            <img id="main_image_preview" src="<?php echo Yii::app()->params->base_url;?>upload/getReciepientAvatar/dir/<?php echo $newdir;?>/fileName/<?php echo $result['avatar'];?>" width="39" height="48"/>
                      <?php }else{ ?>
						                    
                        <img id="main_image_preview" src="<?php echo Yii::app()->params->base_url ;?>/images/avatarbig.png"  width="39" height="48" />
             <?php } ?>
              </a>
                </td>
              <td width="214"><a href="<?php echo Yii::app()->params->base_path;?>user/getReceipient/personId/<?php echo $row['id'];?>/bussId/<?php echo $row['recBusinessId'];?>"><h3><?php echo $row['rec_firstName'] .''.$row['rec_lastName'] ;?> </h3></a></td>
            </tr>
             <?php } ?>
           <?php }else { ?>
            <tr>
              <td width="102"><br><img src="images/man-icon.png" width="39" height="48"><br>
                </td>
              <td width="214"><h3>No saved recipients yet<br>
                Add your first recipient</h3></td>
            </tr>
            <?php  } ?>
          </table></td>
        </tr>
        <tr>
          <td><br><!--<hr>--></td>
        </tr>
        <tr>
          <td><?php /*?><h3><strong>Recomend us to your friends and <br>
            get &pound;20</strong></h3><?php */?></td>
        </tr>
        <tr>
          <td><?php /*?><h3>Invite friends to use KWEXC and earn &pound;20 for every friend invited.<br>
            <a href="#">Invite friends</a></h3><?php */?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div>
    
      <?php if($kashflow==1)
	  {?>
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
                                        <h1 style="margin-left:30px; margin-top:7px;">Kashflow: Due Invoices</h1>
                                    </div>
                                    <div class="contdiv">
                                        <div class="wrapper-big">
                                            <div class=""></div>
                                            <div class="">
												 <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
              <td>&nbsp;</td>
              <td colspan="2" style="background-repeat:no-repeat; background-position:center;">
                 <table width="100%" border="0" cellspacing="10" cellpadding="10" style="font:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:13px;">
                
                 <?php
				 
				if(isset($res) && !empty($res))
				{ ?>
                
                <tr style="font-size:14px;">
                      
                      <th align="left" width="12%">Invoice No</th>
                      <th align="left" width="14%">DueDate</th>
                      <th align="left" width="20%">Supplier</th>
                      <th align="left" width="15%">Reference</th>
                      <th align="center" width="15%">Currency</th>
                      <th align="right" width="12%">Amount</th>
                   	  <!--<th align="left" width="15%">Invoice Date</th>-->
                      <th align="right" width="12%">Pay</th>
                 </tr>
                 <?php 
					$cnt=1;
				 $totalAMount = 0;
				 
				if(is_object($res) && isset($res->Invoice) && !isset($res->Invoice[0]))
				{
					$result  = $res;
				}
				else
				{
					$result = $res->Invoice;
				}
				foreach($result as $row){ 
				
				  ?>
                 <tr>
                     <td lign="left"><?php if(isset($row->InvoiceDBID)){ echo $row->InvoiceDBID; }?></td>
                     <td  align="left"><?php if(isset($row->InvoiceDate)) {echo date('d-m-Y',strtotime(substr($row->InvoiceDate,0,10))); } ?></td>
                     <td  align="left"><?php if(isset($row->Customer)) { echo $row->Customer; }?></td>
                     <td  align="left"><?php if(isset($row->CustomerReference)) {echo $row->CustomerReference; }?></td>
                     <td  align="center"><?php if(isset($row->CurrencyCode)) {echo $row->CurrencyCode; } ?></td>
                     <td align="right"><?php if(isset($row->NetAmount)) { echo $row->NetAmount +  $row->VATAmount; }?></td>
                     <?php /*?><td  align="left"><?php echo substr($row->DueDate,0,10);?></td><?php */?>
                     <?php if(isset($row->InvoiceNumber)){ ?>
                     <td  align="right"><a href="<?php echo Yii::app()->params->base_path;?>user/getInvoiceDataForPayment/invoiceId/<?php echo $row->InvoiceNumber;?>">Pay</a></td>
               		<?php } ?>	
               </tr>
               <?php
			   	 if(isset($row->NetAmount)){
					$totalAMount += $row->NetAmount +  $row->VATAmount; 
					}
                } 
				
				}else{ $cnt=0;?>
                  <tr>
                      <td align="center" colspan="7"><?php /*?><p>This is where you'll find your payment history.<br><?php */?>Congratulations, there are no invoices due!
                        <?php /*?>It seems you don't have any payments due to your suppliers in Kashflow. You can still make a payment to your Recipients by clicking <a href="">New Payment</a> button above</p><?php */?>
                       </td>
                </tr>
               <?php } ?>
            </table>
              <br>
</td>
            </tr>
            
         
            <tr>
              <td>&nbsp;</td>
              <td><br></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2"><br>
                <table width="577" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="555" align="right">
                    </td>
                    <td width="22">&nbsp;</td>
                  </tr>
                </table></td>
            </tr>
          </table>
                                            </div> 
                                            <div class="clear"></div>             
                                        </div>
                                    </div>
                                	<div class="headingbot"><div align="right"  style="margin-top:10px;margin-right:10px;"><h3 style="background:none;"><?php /*?>Total Due: &pound;<?php if(isset($totalAMount) && $totalAMount != '' && $cnt != 0){ echo $totalAMount;} else { echo "0"; }?> GBP<?php */?></h3></div><br></div>
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
  	<?php } ?>
      <?php if($xero==1){	 ?>
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
                                        <h1 style="margin-left:30px; margin-top:7px;">Xero: Invoices Payables</h1>
                                    </div>
                                    <div class="contdiv">
                                        <div class="wrapper-big">
                                            <div class=""></div>
                                            <div class="">
												
                                              
                                                 <table width="100%" border="0" cellspacing="0" cellpadding="0" >
      <tr>
              <td>&nbsp;</td>
              <td colspan="2" style="background-repeat:no-repeat; background-position:center;">
                 <table width="100%" border="0" cellspacing="10" cellpadding="10" style="font:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:13px;">
                 <?php
		  		$cnt=1;
				 $dataObj = $xeroObj->Invoices;
				 
				if(count($dataObj->Invoice) > 0)
				{ ?>
                  <tr style="font-size:14px;">
                     
                      <th align="left" width="13%">Due Date</th>
                      <th align="left" width="20%">Supplier</th>
                      <th align="left" width="15%">Reference</th>
                      <th align="center" width="15%">Currency</th>
                      <th align="right" width="12%">Amount</th>
                      <th align="right" width="12%">Pay</th>
                 </tr>
               <?php 	
				error_reporting(E_ALL);	
				 $totalAMount = 0;
				
				
				 for($i=0;$i<count($dataObj->Invoice);$i++){  
				 
				 ?>
                 <tr>
                    <?php /*?> <td width="13%" align="left"><?php echo $xeroObj->Invoices->Invoice->InvoiceNumber;?></td><?php */?>
                     <td width="13%" align="left"><?php echo date("d-m-Y",strtotime(substr($dataObj->Invoice[$i]->DueDate,0,10)));?></td>
                     <td width="20%"  align="left"><?php echo $dataObj->Invoice[$i]->Contact->Name;?></td>
                     <td width="15%" align="left"><?php echo $dataObj->Invoice[$i]->InvoiceNumber;?></td>
                     <td width="15%" align="center"><?php echo $dataObj->Invoice[$i]->CurrencyCode; ?></td>
                     <td width="12%"  align="right"><?php echo $dataObj->Invoice[$i]->Total;?>  </td>
                     <td width="12%"  align="right"><a href="<?php echo Yii::app()->params->base_path;?>user/getXeroInvoiceDataForPayment&endpoint=Invoices/<?php echo $dataObj->Invoice[$i]->InvoiceID;?>&start=1&order=ds">Pay</a></td>
               </tr>
               <?php 
					$totalAMount += $dataObj->Invoice[$i]->Total;
				
				} 
				
				}else{ $cnt=0;?>
                  <tr>
                      <td align="center" colspan="6"><p>
                        It seems you don't have any payments due to your suppliers in Xero. You can still make a payment to your Recipients by clicking New Payment button above</p>
                       </td>
                </tr>
               <?php 
			   
			   /*$userObj = new Users();
			   $xero_data['xero'] = 0;
			   $userObj->setData($xero_data);
			   $userObj->insertData(Yii::app()->session['fmuserId']);
			   	*/
			   } ?>
           
            </table>
          
              <br>
</td>
            </tr>
            
         
            <tr>
              <td>&nbsp;</td>
              <td><br></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2"><br>
                <table width="577" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="555" align="right">
                    </td>
                    <td width="22">&nbsp;</td>
                  </tr>
                </table></td>
            </tr>
          </table>
                                            </div> 
                                            <div class="clear"></div>             
                                        </div>
                                    </div>
                                	<div class="headingbot"><div align="right"  style="margin-top:10px;margin-right:10px;"><h3 style="background:none;"><?php /*?>Total Due:  &pound;<?php if(isset($totalAMount) && $totalAMount != '' && isset($cnt) && $cnt != 0){ echo $totalAMount;} else { echo "0"; }?> GBP<?php */?></h3></div><br></div>
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
      <?php } ?>    
  </div>
  
 <?php /*?> <div class="maincnt_btm">
  <div class="ftrcnt">
  	<div class="inpg_ftr_cnt_insd">
  	  <table width="950" border="0" cellspacing="0" cellpadding="0">
  	    <tr>
  	      <td valign="top"><h1>Get &pound;20</h1>
  	        <p>Get &pound;20 for every friend that <br>
  	          starts using KWEX. The more <br>
  	          people that use KWEX the <br>
  	          better it is. Valid until <br>
  	          end of September.</p>
  	        <p><a href="#">Invite friends</a></p></td>
  	      <td valign="top"><h1>About us</h1>
  	        <p>Company &amp; Team<br>
  	          News &amp; Blog<br>
  	          Press<br>
  	          Careers</p></td>
  	      <td valign="top"><h1>Help</h1>
  	        <p>Getting Started<br>
  	          Pricing<br>
  	          Supported Currencies<br>
  	          FAQ</p></td>
  	      <td valign="top"><h1>Contact</h1>
  	        <p>support@kwex.com<br>
  	          call +44 20 7873 222</p>
  	        <p><a href="#"><img src="images/twitter.png" width="16" height="16" border="0"></a> <a href="#"><img src="images/facebook.png" width="16" height="16" border="0"></a> <a href="#"><img src="images/google.png" width="16" height="16" border="0"></a></p></td>
	      </tr>
  	    <tr>
  	      <td>&nbsp;</td>
  	      <td>&nbsp;</td>
  	      <td>&nbsp;</td>
  	      <td>&nbsp;</td>
	      </tr>
  	    </table>
  	</div>
  </div>
  </div><?php */?>
  
</div>
</div>
	
</body>
</html>

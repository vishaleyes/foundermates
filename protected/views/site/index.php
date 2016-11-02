<script>
function submitSearchForm()
{
	var keyword = $j("#keyword").val();
	window.location.href = "<?php echo Yii::app()->params->base_path; ?>site/searchAdvisors/keyword/"+keyword;
}
</script>
<section class="content">
	<h1>FounderMates</h1>
    <span class="description">An organized platform that connects entrepreneurs with advisors in a safe, secure and private environment. </span>
    <font class="statementheading" style="font-size:14px; width: 768px;display: block;text-align: center;margin-left: 125px; text-transform: none; padding: 10px; color:#51545B; font-weight:bold; ">FounderMates is an attempt to break away from the inefficiencies of the existing advisory channels such as social media/public forums, physical networking events and cold calling by organizing entrepreneurs and advisors on a common dedicated platform.<br /><br />We aim to be the 'The Go-To-Place' for entrepreneurs globally for all questions and business problems that inhibit their entrepreneurial journey </font>
</section>
 

<div style="background:#FE9F53;border-top: 1px solid rgba(0, 0, 0, 0.2);box-shadow: 0 1px 0 0 rgba(255, 255, 255, 0.1) inset;color:#000000; margin-top: 30px; padding: 20px 0;  width: 1349px;overflow:auto;  z-index: 2;">
   
   <div style="margin: 0 auto;width: 1062px;">
  <div style="float:left">
    <form name="search" method="get" action="<?php echo Yii::app()->params->base_path; ?>site/searchAdvisors">

      <div class="search-headline"><H4 style="margin:0px; color:#FFFFFF;text-shadow: 0.5px 0.5px 0.5px #000000;">Search our Advisors</H4></div>
      <div class="search-input">
        <input style="border-radius:5px;" name="keyword" id="keyword"  type="text"  placeholder="Look up by Expertise Area or Location">
        
        <input type="button" name="search" style="cursor:pointer;" class="btn btn-success btnprofileviewer1" id="search" value="search" onclick="submitSearchForm();" />
      </div>

    </form>
    </div>
    </div>
        <div style="float:left;width:500px;margin-left:40px;margint-top:-23px !important;">
        <H4 style="margin:0px; color:#FFFFFF;text-shadow: 0.5px 0.5px 0.5px #000000;"> Popular search terms </H4>
        <P style="text-shadow: 0.5px 0.5px 0.5px #8A8A8A;
filter: dropshadow(color=#000000, offx=0.5, offy=0.5); font-size:12px;">
<a href="<?php echo Yii::app()->params->base_path; ?>site/searchAdvisors/keyword/Investment" style="text-decoration:none; color:#000;" >Investment</a>, 
<a href="<?php echo Yii::app()->params->base_path; ?>site/searchAdvisors/keyword/Growth" style="text-decoration:none; color:#000;"  >Growth</a>, 
<a href="<?php echo Yii::app()->params->base_path; ?>site/searchAdvisors/keyword/Bengaluru" style="text-decoration:none; color:#000;"  >Bengaluru</a>, 
<a href="<?php echo Yii::app()->params->base_path; ?>site/searchAdvisors/keyword/Venture Capital" style="text-decoration:none; color:#000;"  >Venture Capital</a>, 
<a href="<?php echo Yii::app()->params->base_path; ?>site/searchAdvisors/keyword/Ecommerce" style="text-decoration:none; color:#000;"  >Ecommerce</a>, 
<a href="<?php echo Yii::app()->params->base_path; ?>site/searchAdvisors/keyword/Business Strategy" style="text-decoration:none; color:#000;"  >Business Strategy</a>, 
<a href="<?php echo Yii::app()->params->base_path; ?>site/searchAdvisors/keyword/Delhi" style="text-decoration:none; color:#000;"  >Delhi</a>, 
<a href="<?php echo Yii::app()->params->base_path; ?>site/searchAdvisors/keyword/Design" style="text-decoration:none; color:#000;"  >Design</a>, 
<a href="<?php echo Yii::app()->params->base_path; ?>site/searchAdvisors/keyword/IP" style="text-decoration:none; color:#000;"  >IP</a>, 
<a href="<?php echo Yii::app()->params->base_path; ?>site/searchAdvisors/keyword/Concept Validation" style="text-decoration:none; color:#000;"  >Concept Validation, 
<a href="<?php echo Yii::app()->params->base_path; ?>site/searchAdvisors/keyword/Business Coaching" style="text-decoration:none; color:#000;"  >Business Coaching</a>, 
<a href="<?php echo Yii::app()->params->base_path; ?>site/searchAdvisors/keyword/Hyderabad" style="text-decoration:none; color:#000;" >Hyderabad</a>, 
<a href="<?php echo Yii::app()->params->base_path; ?>site/searchAdvisors/keyword/Marketing" style="text-decoration:none; color:#000;" >Marketing</a>, 
<a href="<?php echo Yii::app()->params->base_path; ?>site/searchAdvisors/keyword/Social Media" style="text-decoration:none; color:#000;" >Social Media</a> 
        </P>
        </div>
    </div>
<section class="content" style="margin-top:0px !important;">   
    <figure class="signuparea">
    
    	<div class="advisorsignup">
        	<font class="heading">Advisors</font>
			<p align="center" style="color:#999; font-size: 15px;
padding: 15px 50px;text-shadow: 5px 5px 3px #212121;
filter: dropshadow(color=#212121, offx=5, offy=5);">
            Increase visibility and build your 'influence' amongst entrepreneurs, hone your advisory skills by way of imparting advice, grow your network of startups/SMEs and build potential offline relationships with entrepreneurs 
            </p>	
            <input type="button" style="margin-top:-11px;" class="btnblue btnmargin" onclick="window.location.href='<?php echo Yii::app()->params->base_path; ?>site/registerAdvisorFirst'" value="SignUp" />
        </div>
        <div class="entsignup">
        	<font class="heading">Entrepreneurs</font>            
			<p align="center" style="color:#999; font-size: 15px;
padding: 15px 50px; text-shadow: 5px 5px 3px #212121;
filter: dropshadow(color=#212121, offx=5, offy=5);">Make the process of seeking advice easy and simple through our dedicated platform.  Search and connect for free with carefully-chosen advisors who are skilled in various expertise areas and sectors. </p>
             <input type="button" style="margin-top:7px;" onclick="window.location.href='<?php echo Yii::app()->params->base_path; ?>site/registerEnterpreneurFirst'" class="btnorange btnmargin" value="SignUp" />
        </div>
    </figure>
    
        
</section>




<div class="contentborder"></div>
<font class="advisorheading">Some Advisors on Our Platform</font>
<section class="advisorlist">
	
   <table width="100%">
    <tr>
    
   <?php
   $i=0;if(isset($data)) { 
   foreach ($data as $row ) { 
   
   if($i%3==0)
   { ?>
   </tr><tr>
   <?php } ?>
   <td style="width:30% !important; vertical-align:top;">
   
    <figure class="col-1">
     <?php 
		//$file = Yii::app()->params->base_url."assets/upload/avatar/".$row['avatar'] ;
		if( 0 === strpos($row['avatar'], 'http') )
		{
			$content = file_get_contents($row['avatar']);
			
			if(!empty($content))
			{
				$filePath =  $row['avatar'];
			}
			else
			{
				$filePath =  Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url."assets/upload/avatar/image.png";
			}
		}
		else
		{
			
			
			
			if(!empty($row['avatar']))
			{
				$filename = "assets/upload/avatar/". $row['avatar'] ."";
				if(file_exists($filename))
				{
					$filePath =  Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url."assets/upload/avatar/". $row['avatar'] ."&h=65&w=75&q=60&zc=0";
				}
				else
				{
					$filePath =  Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url."assets/upload/avatar/image.png";
				}
			}
			else
			{
				$filePath =  Yii::app()->params->base_url."timthumb/timthumb.php?src=".Yii::app()->params->base_url."assets/upload/avatar/image.png";
			}
		} ?>
		<div class="profileimg"><img src="<?php echo $filePath;?>"  height="65px"  width="75px"  /></div></div>
    
      <!--<div class="arrowright"></div>-->
        <div class="persondetails"><span class="advnamebig"><?php echo $row['firstName']."&nbsp;".$row['lastName'] ; ?></span><br /><span><?php  echo $row['city'].", ".$row['country'] ; ?></span><span><br />
		<?php 
		 $arr = explode(',',$row['area_of_expertise']);
		 $str = '';
		
		 if(count($arr) > 5)
		 {
			 for($k=0;$k<5; $k++)
			 {
				
				 $str .= $arr[$k];
				 if($k < 4 )
				 {
					$str .= ', '; 
				 };
			 }
			 echo $str;
		 }
		 else
		 {
			echo $row['area_of_expertise'];
		 }
		 $alogObj = new Algoencryption();
		 ?> </span>
        <a style="color:#10BEF8;" href="<?php echo Yii::app()->params->base_path ?>site/showAdvisorProfile/userId/<?php echo $alogObj->encrypt($row['advisorID'])  ; ?>" >
        <br />
        <span class="btnprofileviewer">View Profile</span>
        </a>
        </div>
            
    </figure>
    </a>
    </td>
    <?php $i++;} } ?>
    </tr>
    </table>

    </section>

 </div>

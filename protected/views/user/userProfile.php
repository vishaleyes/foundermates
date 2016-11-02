<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to FounderMates</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<!-- stylesheets -->
<link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<header>

<div class="admintoppanel">
<a href="index.html"><span>FounderMates</span></a><font class="tagline">"Seek.Share.Synergize"</font>
</div>
<div class="adminnav">
    <ul>
        <li><a href="../index.html" class="current">Advisor List</a></li>
        <li><a href="#">Message</a></li>
        <li><a href="#">Profile</a></li>
        <li><a href="#">Reviews</a></li>
        <li style="height: 80px;"><a href="#"><font class="username">Hi, Nidhi Kapoor</font><div class="triangle"></div></a>
        <div class="dropdownContain">        
					<div class="dropOut">						
                    <div class="triangleup"></div>
						<ul>
							<li>Change Password</li>
							<li>Log Out</li>
						</ul>
					</div>
				</div>
		</li>
    </ul>
</div>
</header>
<section class="userprofileinfo">	
	 <h2>User Profile</h2>
     
     <div class="bordertop">
     <hr class="orangethickborder" />
     <hr class="thinborder" style="margin-left: -25px;" />
	</div>
    <font class="userfullname"><strong class="firstletters">N K</strong> Business Developer (India Product-nestoria.co.in)	</font>
    <figure class="signuparea" id="container">
        	 <div class="box col2">
             <div class="borderblock"></div>
             	<h1 class="iconprof"></h1>
                <font class="profileheading">Professional Details</font>
                <input type="button" class="editbutton" value="Edit" />
                <figure class="profiledata">
                <strong>Rate: </strong><font class="dynamicprofiledata">Rs. 100 - Rs. 150 / Per Day</font><br /><br />
                <strong>Availability: </strong><font class="dynamicprofiledata">Available Immediately</font><br /><br />
                <strong>Status: </strong><font class="dynamicprofiledata">Not Looking for Work</font><br /><br />
                <strong>Current Role: </strong><font class="dynamicprofiledata">Architect - Data</font>
                </figure>
             </div>

  <div class="box col2">
  <div class="borderblock"></div>
             	<h1 class="iconpersonalinfo"></h1>
                <font class="profileheading">Personal Details</font>
                <input type="button" class="editbutton" value="Edit" />
                <figure class="profiledata">
                <strong>Nationality: </strong><font class="dynamicprofiledata">India</font><br /><br />
                <strong>Location: </strong><font class="dynamicprofiledata">India</font><br /><br />
                <strong>Visa Status: </strong><font class="dynamicprofiledata">Eligible to work in India</font>
                </figure>
  </div>

 

  <div class="box col2">
   <div class="borderblock"></div>
             	<h1 class="iconphotoupload"></h1>
                <font class="profileheading">Photo</font>
                <input type="button" class="editbutton" value="Edit" />
                <figure class="profiledata">
                <strong>Upload Photo: </strong><br /><br /><input type="file"  class="uoloadprofilepic"/>
                </figure>
  </div>
       <div class="box col2">
    <div class="borderblock"></div>
             	<h1 class="iconworklocation"></h1>
                <font class="profileheading">Work Locations</font>
                <input type="button" class="editbutton" value="Edit" />
                <figure class="profiledata">
                <strong>United Kingdom: </strong><font class="dynamicprofiledata">Everywhere</font>
               
                </figure>
  </div>
    </figure>
</section>

<footer>
	<figure class="footernav">
    	<div class="navleft">
        <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">How it Works</a></li>
        <li><a href="#">About Us</a></li>
        </ul>
        </div>
        <div class="navright">
        <ul>
        <li><a href="#">Contact Us</a></li>
        <li><a href="#">Terms/Privacy</a></li>
        <li><a href="#">Work with Us</a></li>
        </ul>
        </div>
    </figure>
    <!-- BEGIN WIDGETS -->
      <section id="widgets">
          <div class="social-group">
          <a href="http://www.facebook.com" rel="external me" target="_blank" class="knob"><img src="../images/fb_icon.png" /></a>      
          <a href="http://www.twitter.com" rel="external me" target="_blank" class="knob"><img src="../images/twitter_icon.png" /></a>      
          <a href="http://www.youtube.com" rel="external me" target="_blank" class="knob"><img src="../images/youtube_icon.png" /></a>      
          <a href="http://www.skype.com" rel="external me" target="_blank" class="knob"><img src="../images/skype_icon.png" /></a>    
          </div>                
      </section>
	  <!-- END WIDGETS -->
      <div class="twitterfeed"><h1 class="twittericon"></h1><span class="latestupdate">Latest Updates from FounderMates, We are going to launch our Website which wil contains Advisor as well Entrepreneurs..</span></div>
      <span class="copyrightinfo">&copy; Copyright 2013 FounderMates</span>      
</footer>
<script src="../js/jquery-1.7.1.min.js"></script>
<script src="../js/jquery.masonry.min.js"></script>
<script>
  $(function(){
    
    $('#container').masonry({
      itemSelector: '.box',
      columnWidth: 100,
      isAnimated: true
    });
    
  });
</script>
</body>
</html>

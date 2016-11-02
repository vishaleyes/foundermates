<?php
/**
 * Copyright (c) 2011 All Right Reserved, Todooli, Inc.
 *
 * This source is subject to the Todooli Permissive License. Any Modification
 * must not alter or remove any copyright notices in the Software or Package,
 * generated or otherwise. All derivative work as well as any Distribution of
 * this asis or in Modified
form or derivative requires express written consent
 * from Todooli, Inc.
 *
 *
 * THIS CODE AND INFORMATION ARE PROVIDED "AS IS" WITHOUT WARRANTY OF ANY
 * KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND/OR FITNESS FOR A
 * PARTICULAR PURPOSE.
 *
 *
**/ 

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class General extends CFormModel
{
//function for verify correct admin
	var $max;                           //Highest value of the array
	var $min;                           //Lowest value of the array   
	var $ntick = 10;                     //Number of tick marks      

	public $genrallibObj;
	function __construct()
	{
		
	}
	
	function clearPhone($phone)
	{
		$phone=trim($phone);
		$metcharray=array('[',']','(',')',' ','.','-');
		$replacearray=array('');
		$data=str_replace($metcharray,$replacearray,$phone);
		return trim($data);
	}
	
	function isValidEmail($email)
    {
        $lengthPattern = "/^[^@]{1,64}@[^@]{1,255}$/";
        $syntaxPattern = "/^((([\w\+\-]+)(\.[\w\+\-]+)*)|(\"[^(\\|\")]{0,62}\"))@(([a-zA-Z0-9\-]+\.)+([a-zA-Z0-9]{2,})|\[?([1]?\d{1,2}|2[0-4]{1}\d{1}|25[0-5]{1})(\.([1]?\d{1,2}|2[0-4]{1}\d{1}|25[0-5]{1})){3}\]?)$/";
        return ((preg_match($lengthPattern, $email) > 0) && (preg_match($syntaxPattern, $email) > 0)) ? true : false;
    }
	
	
	function clearPost($dataArray)
	{
		$search = unserialize(NOT_ALLOW_CHAR);
		$replace = array( '');
		$temp=$dataArray;
		
		$post = str_replace($search, $replace, $dataArray,$count);
		if(isset($count) && $count>0)
		{
			if(isset($_SERVER["HTTP_REFERER"]))
			{
			}
			if(isset($_SERVER["HTTP_USER_AGENT"]))
			{
			}
		}
		return $temp;
	}
	
	function check_password($password,$cpassword=NULL)
	{
		if($password == "")
		{
			return 1;
		}
		else if(strlen($password) < 8)
		{
			return 2;
		}
		else if(!preg_match("/[A-Za-z]/", $password))
		{
			return 3;
		}
		else if(!preg_match("/[0-9]/", $password))
		{
			return 5;
		}
		/*else if(!preg_match("/[A-Z]/", $password))
		{
			return 4;
		}
		else if(!preg_match("/[.,!,@,#,$,%,^,&,*,?,_,~,-,£,(,)]/", $password))
		{
			return 6;
		}*/
		else if(isset($cpassword))
		{
			if($password != $cpassword)
			{
				return 7;
			}
		}
		else
		{
			return 0;
		}
	}
	
	function validate_phoneUS($number){
		$numStripX = array('(', ')', '-', '.', '+');
		$numCheck = str_replace($numStripX, '', $number); 
		$firstNum = substr($number, 0, 1);
		if(($firstNum == 0) || ($firstNum == 1)) {return false;}
		elseif(!is_numeric($numCheck)){return false;}
		elseif(strlen($numCheck) > 10){return false;}
		elseif(strlen($numCheck) < 10){return false;}
		else{
			$formats = array('###-###-####', '(###) ###-####', '(###)###-####', '##########', '###.###.####', '(###) ###.####', '(###)###.####');
			$format = trim(preg_replace("/[0-9]/", "#", $number));
			return (in_array($format, $formats)) ? true : false;
		}
	}
	
	function getEmployerNumber() {
		$stop_hire_request = new StopHireRequests();
		$jobid_obj = new JOBID();
		
		$stop_hire_request->orderBy('id','DESC');
		$emp_num = $stop_hire_request->getField('employerNumber');
		if($emp_num == -1 || $emp_num == NULL)
		{
			$emp_num = "1";
		}
		else
		{
			$emp_num = $jobid_obj->baseNTo10($emp_num);
			$emp_num++;
		}
		$emp_num_new = $jobid_obj->base10ToN($emp_num);
		return $emp_num_new;
	}
	
	function getJobId()
		{
		$jobid_obj = new JobId();
		
		$jobId_old = Yii::app()->db->createCommand()
		->select('jobId')
		->from('hire_requests')
		->order('id DESC')
		->queryScalar();
		
		if($jobId_old == false)
		{
			$jobId_old = "1";
		}
		else
		{
			$jobId_old = $jobid_obj->baseNTo10($jobId_old);
			$jobId_old++;
		}
		$jobId_new = $jobid_obj->base10ToN($jobId_old);
		return $jobId_new;
	}
	
	function getBugIssueId()
	{
		$issueId_old	=	Yii::app()->db->createCommand()
							->select('issueId')
							->from('bugs')
							->order('id desc')
							->queryScalar();
							
		$jobid_obj = new JobId();
		
		if($issueId_old == -1 || $issueId_old == NULL)
		{
			$issueId_old = "1";
		}
		else
		{
			$issueId_old = $jobid_obj->baseNTo10($issueId_old);
			$issueId_old++;
		}
		$issueId_new = $jobid_obj->base10ToN($issueId_old);
		return $issueId_new;
	}
	
	/* 
	 * 
	 * method - get the pay range array
	 * 
	 * @param - integer $pay_range -> id of pay range
	 * @return - array of pay range with name
     */
	function getPayRangeArray($pay_range)
	{
		$payrange_array = array("8","9","10","11");
		$payrangeArr = array();
        if ($pay_range > _TOTAL_WAGES) {
          $pay_range = '1';
        }
		for($i=$pay_range; $i<=_TOTAL_WAGES; $i++) {
			$payrangeArr[] = $payrange_array[$i-1];
		}
		return $payrangeArr;
	}

	/* 
	 * 
	 * method - getAgeInYears
	 * 
	 * @param birthday is date in format "%Y-%m-%d"
	 * @return - age in years
     */
	function getAgeInYears($birthday) {
      list($year,$month,$day) = explode("-",$birthday);
      $year_diff  = date("Y") - $year;
      $month_diff = date("m") - $month;
      $day_diff   = date("d") - $day;
      if ($day_diff < 0 || $month_diff < 0)
        $year_diff--;
      return $year_diff;
    }
	
	function checkInArray($actualArray,$testingArray)
	{
		$result = array_merge((array)array_unique($actualArray), (array)array_unique($testingArray));
		$resultfinal=array_unique($result);
		if(count($resultfinal)>count($actualArray))
		{
			return 1;	
		}
		else
		{
			return 0;	
		}	
	}
	
	function truncateName($string,$length=10) {
		$string = substr($string,0,$length);
		return $string;
	}
	
	function truncateBusinessName($string,$length=25) {
		$string = substr($string,0,$length);
		return $string;
	}
	
	function truncateOccupationName($string,$length=20)
	{
		$string = substr($string,0,$length);
		return $string;
	}
	
	 public function ago($querydate)
    {
		global $msg;
		$dat=$querydate;
        $querydate=strtotime($querydate);
        $minusdate = strtotime(date('Y-m-d H:i:s')) - $querydate;
        if($minusdate > 88697640 && $minusdate < 100000000)
        {
            $minusdate = $minusdate - 88697640;
        }
        switch ($minusdate)
        {
            case ($minusdate <= 0):
            return $msg['_JUST_NOW_'];
            break;
            case ($minusdate < 2359):
            if($minusdate < 59)
            {
                return $date_string = $minusdate.$msg['_SECOND_AGO_'];
            }
            elseif($minusdate > 59)
            {
				$minutes=(int)($minusdate/60);
				if($minutes==1)
				{
					return $date_string = $msg['_ONE_MINUTE_AGO_'];
				}
				else
				{
                	return $date_string = $minutes.$msg['_MINUTES_AGO_'];
            	}
			}
            break;
            case ($minusdate > 2359 && $minusdate < 86400):
            $flr = (int)($minusdate/3600);
            if($flr == 1)
            {
                return $date_string = $msg['_ONE_HOUR_AGO_'];
            }
            else
            {
				if($flr==0)
				{
					return $date_string =$msg['_ONE_HOUR_AGO_'];
				}
				else
				{
                	return $date_string = $flr.$msg['_HOURS_AGO_'];
            	}
            }
            break;
            case ($minusdate > 2359 && $minusdate < 2629743):
            $flr = (int)($minusdate/86400);
            if($flr == 1)
            {
                return $msg['_ONE_DAY_AGO_'];
            }
            else
            {
                return $date_string = $flr.$msg['_DAYS_AGO_'];
            }
            break;
            case ($minusdate > 2629743 && $minusdate < 12320000):
            return date("j F, Y",strtotime($dat));
           
            break;
            case ($minusdate > 100000000):
            return date("j F, Y",strtotime($dat));
        }
    }  
	
	function rel_time($querydate, $to = null)
	{
		global $msg;
		$dat=$querydate;
		$querydate=strtotime($querydate);
		$minusdate = strtotime(date('Y-m-d H:i:s')) - $querydate;
		if($minusdate > 88697640 && $minusdate < 100000000)
		{
			$minusdate = $minusdate - 88697640;
		}
		switch ($minusdate)
		{
			case ($minusdate <= 0):
				return $msg['_JUST_NOW_'];
				break;
			case ($minusdate < 2359):
				if($minusdate < 59)
				{
					return $date_string = $minusdate.$msg['_SECOND_AGO_'];
				}
				elseif($minusdate > 59)
				{
					$minutes=(int)($minusdate/60);
					if($minutes==1)
					{
						return $date_string = $msg['_ONE_MINUTE_AGO_'];
					}
					else
					{
						return $date_string = $minutes.$msg['_MINUTES_AGO_'];
					}
				}
				break;
			case ($minusdate > 2359 && $minusdate < 86400):
				$flr = (int)($minusdate/3600);
				if($flr == 1)
				{
					return $date_string = $msg['_ONE_HOUR_AGO_'];
				}
				else
				{
					if($flr==0)
					{
						return $date_string =$msg['_ONE_HOUR_AGO_'];
					}
					else
					{
						return $date_string = $flr.$msg['_HOURS_AGO_'];
					}
				}
				break;
			case ($minusdate > 2359 && $minusdate < 2629743):
				$flr = (int)($minusdate/86400);
				if($flr == 1)
				{
					return $date_string = $msg['_ONE_DAY_AGO_'];
				}
				else
				{
					return $date_string = $flr.$msg['_DAYS_AGO_'];
				}
				break;
			case ($minusdate > 2629743 && $minusdate < 12320000):
				return date("j F, Y",strtotime($dat));
				
				break;
			case ($minusdate > 100000000):
				return date("j F, Y",strtotime($dat));
		}
	}
	
	function resizeImage($img_name,$filename, $new_w, $new_h, $ratio = true,$resizesmall = false){

		//get image extension.

		$ext = $this->getExtension($img_name);

		//creates the new image using the appropriate function from gd library
		if(!strcmp("jpg",$ext) || !strcmp("jpeg",$ext)) $src_img = imagecreatefromjpeg($img_name);

		if(!strcmp("png",$ext)) $src_img = imagecreatefrompng($img_name);

		if(!strcmp("gif",$ext)) $src_img = imagecreatefromgif($img_name);

		if(!strcmp("bmp",$ext)) $src_img = imagecreatefromwbmp($img_name);

		//gets the dimmensions of the image
		$old_x= imageSX($src_img);
		$old_y= imageSY($src_img);

		if ((($old_x >= $new_w) && ($old_y >= $new_h)) || (($old_x >= $new_w) || ($old_y >= $new_h) && $ratio == true) || $resizesmall == true)
		{

			// next we will calculate the new dimmensions for the thumbnail image
			// the next steps will be taken:
			// 1. calculate the ratio by dividing the old dimmensions with the new ones
			//	 2. if the ratio for the width is higher, the width will remain the one define in WIDTH variable
			//	 and the height will be calculated so the image ratio will not change
			//	 3. otherwise we will use the height ratio for the image
			// as a result, only one of the dimmensions will be from the fixed ones
			$ratio1 = $old_x / $new_w;
			$ratio2 = $old_y / $new_h;
			if ($ratio1 > $ratio2){
				$thumb_w=$new_w;
				$thumb_h=$old_y/$ratio1;
			} else {
				$thumb_h=$new_h;
				$thumb_w=$old_x/$ratio2;
			}

			if($ratio == false)
			{
				$thumb_w = $new_w;
				$thumb_h = $new_h;
			}

			// we create a new image with the new dimmensions
			$dst_img = ImageCreateTrueColor($thumb_w, $thumb_h);
			//$dst_img = imagecreate($thumb_w, $thumb_h);

			// resize the big image to the new created one
			imagecopyresampled($dst_img, $src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);

			// output the created image to the file. Now we will have the thumbnail into the file named by $filename
			if(!strcmp("png",$ext)){
				imagepng($dst_img,$filename);
			} else {
				imagejpeg($dst_img,$filename);
			}
		} else {
			
		}
		//destroys source and destination images.
		//imagedestroy($dst_img);
		//imagedestroy($src_img);
	}

	// This function reads the extension of the file. It is used to determine if the file is an image by checking the extension.
	function getExtension($str) {
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}

	function getStringOfArray($arrayVar) {
		if(is_array($arrayVar))
		{
		$new_array = array_map(
						create_function('$key, $value', 'return $key.":".$value." # ";'), 
						array_keys($arrayVar), array_values($arrayVar));
		return (implode($new_array));
		}
		return $arrayVar;
	}
	
	function isURL($url = NULL) {
        if($url==NULL) return false;
		$url=strtolower($url);
        $protocol = '(http://|https://)';
        $allowed = '([a-z0-9]([-a-z0-9]*[a-z0-9]+)?)';

        $regex = "/^". $protocol . // must include the protocol
                         '(' . $allowed . '{1,63}\.)+'. // 1 or several sub domains with a max of 63 chars
                         '[a-z]' . '{2,6}^$/i'; // followed by a TLD
        
		if(preg_match($regex, $url)==true) return true;
        else return false;
	}
	
	function isValidURL($url)
	{
		if(preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', strtolower($url)))
		{
			if(!preg_match('/[<>\?\%\\=\$]/',$url))
			{
				return true;	
			}
			else
			{
				return false;	
			}
		}
		else
		{
			return false;	
		}
	}
	
	
	function generateBusinessProfile()
	{
		$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
		$result = "";
		for ($i = 0; $i < 6; $i++)
		{
		   $result .= $chars[mt_rand(0, strlen($chars)-1)];
		}
		return $result;
	}
	
	function remove_directory($directory, $empty=FALSE)
	{
		
		// if the path has a slash at the end we remove it here
		if(substr($directory,-1) == '/')
		{
			$directory = substr($directory,0,-1);
		}
	
		// if the path is not valid or is not a directory ...
		if(!file_exists($directory) || !is_dir($directory))
		{
			// ... we return false and exit the function
			return FALSE;
	
		// ... if the path is not readable
		}elseif(!is_readable($directory))
		{
			// ... we return false and exit the function
			return FALSE;
	
		// ... else if the path is readable
		}else{
	
			// we open the directory
			$handle = opendir($directory);
	
			// and scan through the items inside
			while (FALSE !== ($item = readdir($handle)))
			{
				// if the filepointer is not the current directory
				// or the parent directory
				if($item != '.' && $item != '..')
				{
					// we build the new path to delete
					$path = $directory.'/'.$item;
	
					// if the new path is a directory
					if(is_dir($path)) 
					{
						// we call this function with the new path
						$this->remove_directory($path);
	
					// if the new path is a file
					} else {
						// we remove the file
						$is_svn = strstr($directory, '.svn');
						if ($is_svn === FALSE) {
							
							unlink($path);
						}
					}
				}
			}
			// close the directory
			closedir($handle);
	
			// if the option to empty is not set to true
			if($empty == FALSE)
			{
				// try to delete the now empty directory
				$is_svn = strstr($directory, '.svn');
				if ($is_svn === FALSE) {
				  if(!rmdir($directory)) {
					// return false if not possible
					return FALSE;
				  }
				}
			}
			// return success
			return TRUE;
		}
	}
	
	/************ GENERATION TOKEN IN SESSION ***********/
	function generateToken()
	{
		unset($_SESSION['fToken']);
		$_SESSION['fToken']	=	md5(uniqid() . microtime() . rand());
		return $_SESSION['fToken'];
	}
	
	/************ CHECK FOR VALID TOKEN ************/
	function checkValidToken($token)
	{
		
		if(Yii::app()->session['fToken'] == $token){
			return true;
		}else{
			return false;
		}
	}
	
	 function validate_password($plain, $encrypted) {
	if ($this->chk_not_null($plain) && $this->chk_not_null($encrypted)) {
// split apart the hash / salt
      $stack = explode(':', $encrypted);
	
      if (sizeof($stack) != 2) return false;
     
	  if (md5($stack[1] . $plain) == $stack[0]) {
		    return true;
      }
    }
    return false;
  }
  
   function chk_not_null($value) {
    $class='queryFactoryResult';
	if (is_array($value)) {
      if (sizeof($value) > 0) {
        return true;
      } else {
        return false;
      }
    } elseif($value instanceof $class) {
      if (sizeof($value->result) > 0) {
        return true;
      } else {
        return false;
      }
    } else {
      
		if ( (is_string($value) || is_int($value)) && ($value != '') && ($value != 'NULL') && (strlen($value) > 0)) {
        return true;
      } else {
        return false;
      }
    }
  }

////
// This function makes a new password from a plaintext password. 
  function encrypt_password($plain) {
    $password = '';
    for ($i=0; $i<10; $i++) {
      $password .= $this->get_rand();
    }

    $salt = substr(md5($password), 0, 2);

    $password = md5($salt . $plain) . ':' . $salt;

    return $password;
  }
  
  // Return a random value
  function get_rand($min = null, $max = null) {
    static $seeded;

    if (!$seeded) {
      mt_srand((double)microtime()*1000000);
      $seeded = true;
    }

    if (isset($min) && isset($max)) {
      if ($min >= $max) {
        return $min;
      } else {
        return mt_rand($min, $max);
      }
    } else {
      return mt_rand();
    }
  }
  
	//Function to calculate the Y-Axis scale for the trend data.         
	function y_axis_for_trend($trend_array)
	{
		$this->max = $trend_array[0];
		$array_length = count($trend_array);      //Length of the array
		// Calculate the highest trend value. 
		for ($i = 0; $i < ($array_length); $i++) 
		{
			if ($trend_array[$i] >= $this->max)
			{
				$this->max = $trend_array[$i];
		   	}
		}
		
		if ($this->max == 0)   {$this->max = 10;}   //If the Trend Array is empty or all values are zero, set the default Max Value to 10
		
		$this->min = $this->max;
		// Calculate the lowest trend value. 
		for ($i = 0; $i < ($array_length); $i++) 
		{
			if ($trend_array[$i] <= $this->min)
			{
				$this->min = $trend_array[$i];
			}   
		}            
		
		//Algorithm to calculate the graph axis tick marks
		$range = $this->nicenum($this->max - $this->min, 'false');
		$d = $this->nicenum(($range) / ($this->ntick - 1), 'true');   //Tick mark spacing
		$d	=	round($d);
		if($d == 0){
			$d =	1;
		}
		
		$graphmin = floor($this->min / $d) * $d;            //Graph range min
		$graphmax = ceil($this->max / $d) * $d;            //Graph range max
		$nfrac = max( -floor(log10($d)),0);
		
		$total = $graphmin - $d;
		$tick_marks = array();
		for ($i = 0; $total < ($graphmax); $i++) 
		{   
		   $total = $total + $d;
		   $tick_marks[$i] = round($total, $nfrac);   
		}
		
		if($graphmin > 0){
			$graphmin	=	0;	//	MINIMUM RANGE VALUE IS MADE 0 MANUALLY 
		}
		
		$result = array();
		$result[] = $graphmin;
		$result[] = $graphmax;
		$result[] = $d;
		return $result;
	}
	
	function nicenum($x, $round1)
	{
		$exp = floor(log10($x));   //Exponent of X
		$f = $x / pow(10,$exp);      //Fractional part of X
		if($round1)
		{
		if($f < 1.5)   {
		   $nf = 1;
		} elseif ($f < 3)   {
		   $nf = 2;
		} elseif ($f < 7)   {
		   $nf = 5;
		} else   {
		   $nf = 10;   
		}
		} else   {
		if ($f <= 1)   {
		   $nf = 1;
		} elseif ($f <= 2)   {
		   $nf = 2;
		} elseif ($f <= 5)   {
		   $nf = 5;
		} else   {
		   $nf = 10;      
		}
		}
		$nicenum = $nf * pow(10,$exp);   
		return $nicenum;
	}

}
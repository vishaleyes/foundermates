<?php

class ExportToExcel
{  
function exportWithPage($php_page,$excel_file_name)  
{  
$this->setHeader($excel_file_name);   require_once "$php_page";   
}    

function setHeader($excel_file_name)  
{   
		header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
		header('Content-Disposition: attachment; filename="ExportAdvisorsData'.date("Y_m_d_H_i_s").'.xls"');
		header('Cache-Control: max-age=0');   
}    

function exportWithQuery($qry,$excel_file_name,$conn)  
{  
$body="<center><table border=1px>";
$tmprst=mysql_query($qry,$conn);  
$body.="<tr>"; 
		for ($i = 0; $i < mysql_num_fields($tmprst); $i++) 
		{ 
			
			$body.="<th>".mysql_field_name($tmprst,$i)."</th>"; 
			
		} 
$body.="</tr>"; 
  
$num_field=mysql_num_fields($tmprst);  


while($row=mysql_fetch_array($tmprst,MYSQL_BOTH))  
{    $body.="<tr>";   
for($i=0;$i<$num_field;$i++)   
{
	if($i == 13)
	{
		$ent_industryId = explode(',',$row[$i]);
		$ent_industryList = array();
		
		 foreach($ent_industryId as $raw)
		 {
			$industryObj=Industry::model()->findbyPk($raw);
			
			if(isset($industryObj->industry_name))
			{
				$ent_industryList[] = $industryObj->industry_name;	
			}
		 }
		
		$ent_industryname = implode(",", $ent_industryList);
		$body.="<td>".$ent_industryname."</td>"; 	
	}
	else if($i == 19)
	{
		$interestInAdvising = explode(',',$row[$i]);
		
		$interestArray = array();
		
		 foreach($interestInAdvising as $raw)
		 {
			if($raw == '1')
			{
				$interestArray[] =  "Idea"; 	
			}
			else if($raw == '2')
			{
				$interestArray[] = "Prototype";	
			}
			else if($raw == '3')
			{
				$interestArray[] = "Pre-revenue";	
			}
			else if($raw == '4')
			{
				$interestArray[] = "Revenue";	
			}
			else if($raw == '5')
			{
				$interestArray[] = "Growth";	
			}
			else if($raw == '6')
			{
				$interestArray[] = "Established";	
			}
			
		 }
		
		$interestString = implode(",", $interestArray);
		$body.="<td>".$interestString."</td>";
	}
	else if($i == 23)
	{
		if($row[$i] == 0)
		{
			$advisorType = "Expert";	
		}
		else if($row[$i] == 1)
		{
			$advisorType = "Mentor";	
		}
		$body.="<td>".$advisorType."</td>";
	}
	else
	{
		$body.="<td>".$row[$i]."</td>";
	}
} 
 
$body.="</tr>";   

}
  
$this->setHeader($excel_file_name);  
echo $header.$body."</table>";  
}
} 
?>
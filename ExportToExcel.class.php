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
		header('Content-Disposition: attachment; filename="ExportEntrepreneursData'.date("Y_m_d_H_i_s").'.xls"');
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
	if($i == 10)
	{
		if($row[$i] == '1')
		{
			$stage =  "Idea"; 	
		}
		else if($row[$i] == '2')
		{
			$stage = "Prototype";	
		}
		else if($row[$i] == '3')
		{
			$stage = "Pre-revenue";	
		}
		else if($row[$i] == '4')
		{
			$stage = "Revenue";	
		}
		else if($row[$i] == '5')
		{
			$stage = "Growth";	
		}
		else if($row[$i] == '6')
		{
			$stage = "Established";	
		}
		$body.="<td>".$stage."</td>"; 	
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
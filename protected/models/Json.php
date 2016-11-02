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

class Json
	{
	
		 public function __construct()
		 {
			
		 }
		function utf8_array_encode($input)
		{
			$return = array();
		
			foreach ($input as $key => $val)
			{
				if( is_array($val) )
				{
					$return[$key] = $this->utf8_array_encode($val);
				}
				else
				{
					if($val == NULL)
					{
						$return[$key] = "";
					}
					else
					{
						$return[$key] = utf8_encode($val);
					}
				}
			}
			return $return;          
		}
	}
    ?>
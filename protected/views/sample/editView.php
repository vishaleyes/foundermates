<html>
<head>
<title>Edit row</title>
</head>
<body>
<div align="center">
<h3>For Edit row</h3>
<table border="1">
<tr>
<td>
<?php echo CHtml::beginForm(Yii::app()->params->base_path.'sample/updateData','post',array('id' =>'functionForm','name' => 'functionForm','enctype' => 'multipart/form-data')) ?>
<table>
<tr>
<td width="123">Name:</td>
<td width="334"><input type="text" name="user_name" id="user_name" value="<?php echo $data['user_name']; ?>"/></td>
</tr>

<tr>
<td>Phone:</td>
<td><input type="text" name="phones" id="phones" value="<?php echo $data['phones']; ?>"/></td>
</tr>

<tr>
<td>Email ID:</td>
<td><input type="text" name="email_id" id="email_id" value="<?php echo $data['email_id']; ?>"/></td>
</tr>

<tr>
<td>User Picture:</td>
<td><input type="text" name="user_pic" id="user_pic" value="<?php echo $data['user_pic']; ?>"/><input type="file" name="file" id="file" /></td>
</tr>

<input type="hidden" name="user_id" id="user_id" value="<?php echo $data['user_id']; ?>"/>
<td><input type="submit" name="submit" value="submit"/></td>
<td><input type="button" name="cancel" value="cancel" onClick="window.location.href='<?php echo Yii::app()->params->base_path ; ?>sample/Data'"/></td>
</tr>
</table>
<?php echo CHtml::endForm(); ?> 

</td>
</tr>
</table>

</div>
</body>
</html>
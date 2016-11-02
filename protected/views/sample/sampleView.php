<html>
<head>
<title>Demo</title>
</head>
<h3 align="center">Database Table</h3>
<div align="center">
<table border="1px" width="80%" height="75%">
<?php echo CHtml::beginForm(Yii::app()->params->base_path.'sample/addData','post',array('id' =>'functionForm','name' => 'functionForm','enctype' => 'multipart/form-data')) ?>	
    <tr bgcolor="green" style="color:Yellow">
    <th>NAME</th>
    <th>PHONES</th>
    <th>EMAIL ID</th>
    <th>Image</th>
    <th>Update</th>
    <th>Delete</th>
    </tr>
<?php foreach($alldata as $raw) { ?>
    <tr align="center">
    <td><?php echo $raw['user_name'] ; ?></td>
    <td><?php echo $raw['phones']; ?></td>
    <td><?php echo $raw['email_id']; ?></td>
    <td><img src="<?php echo Yii::app()->params->image_path ?>/map-icon/<?php echo $raw['user_pic']; ?>"/></td>
    <td><a href="<?php echo Yii::app()->params->base_path ?>sample/update&id=<?php echo $raw['user_id'] ;?>"><span style="color:red">Update</span></a></td>
    <td><a href="<?php echo Yii::app()->params->base_path ?>sample/deleteData&id=<?php echo $raw['user_id'] ;?>"><span style="color:red">Delete</span></a></td>
    </tr>
<?php } ?>

	<tr align="center">
    <td><input type="text" name="user_name" size="15px"/></td>
    <td><input type="text" name="phones" size="15px"/></td>
    <td><input type="text" name="email_id" size="15px"/></td>
    <td><input type="file" name="file" id="file" /></td>
    <td colspan="2"><input type="submit" name="Add" value="Add" size="100px" style="color:yellow; background-color:green"/></td>
    </tr>
<?php echo CHtml::endForm(); ?> 
</table>
</div>
</html>
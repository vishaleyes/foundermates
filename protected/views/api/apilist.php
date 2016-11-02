<html>
<head>
<title>Welcome to HealthApp API</title>

<style type="text/css">

body {
 background-color: #fff;
 margin: 40px;
 font-family: Lucida Grande, Verdana, Sans-serif;
 font-size: 14px;
 color: #4F5155;
}

a {
 color: #003399;
 background-color: transparent;
 font-weight: normal;
}

h1 {
 color: #444;
 background-color: transparent;
 border-bottom: 1px solid #D0D0D0;
 font-size: 16px;
 font-weight: bold;
 margin: 24px 0 2px 0;
 padding: 5px 0 6px 0;
}

code {
 font-family: Monaco, Verdana, Sans-serif;
 font-size: 12px;
 background-color: #f9f9f9;
 border: 1px solid #D0D0D0;
 color: #002166;
 display: block;
 margin: 14px 0 14px 0;
 padding: 12px 10px 12px 10px;
}

</style>
</head>
<body>

<h1>Welcome to HealthApp REST API!</h1>


<p></p>
<p><a href="<?php echo Yii::app()->params->base_path; ?>api/getLanguageList"><strong>getLanguageList</strong></a> : <?php echo Yii::app()->params->base_path; ?>api/getLanguageList</p>
<p><strong>Params</strong> </p>
<p><strong>Method</strong> : GET and POST</p>
<p><strong>Fields</strong> : country_id </p>
<p>--------------------------------------------------------------------------------------------------</p>

<p><a href="<?php echo Yii::app()->params->base_path; ?>api/getCountryList"><strong>getCountryList</strong></a> : <?php echo Yii::app()->params->base_path; ?>api/getCountryList </p>
<p><strong>Params</strong> </p>
<p><strong>Method</strong> : GET and POST</p>
<p><strong>Fields</strong> : </p>

<p>--------------------------------------------------------------------------------------------------</p>

<p><a href="<?php echo Yii::app()->params->base_path; ?>api/getDiseaseList&language_id=1"><strong>getDiseaseList</strong></a> : <?php echo Yii::app()->params->base_path; ?>api/getDiseaseList&language_id=1 </p>
<p><strong>Params</strong> </p>
<p><strong>Method</strong> : GET and POST</p>
<p><strong>Fields</strong> : language_id</p>

<p>--------------------------------------------------------------------------------------------------</p>

<p><a href="<?php echo Yii::app()->params->base_path; ?>api/getProductList&disease_id=1&language_id=1"><strong>getProductList</strong></a> : <?php echo Yii::app()->params->base_path; ?>api/getProductList&disease_id=1&language_id=1 </p>
<p><strong>Params</strong> </p>
<p><strong>Method</strong> : GET and POST</p>
<p><strong>Fields</strong> : disease_id , language_id</p>
<p>--------------------------------------------------------------------------------------------------</p>

<p><a href="<?php echo Yii::app()->params->base_path; ?>api/getProductDetails&language_id=1&medication_id=1"><strong>getProductDetails</strong></a> : <?php echo Yii::app()->params->base_path; ?>api/getProductDetails&language_id=1&medication_id=1 </p>
<p><strong>Params</strong> </p>
<p><strong>Method</strong> : GET and POST</p>
<p><strong>Fields</strong> : language_id=1&medication_id=1</p>
<p>--------------------------------------------------------------------------------------------------</p>

<p><a href="<?php echo Yii::app()->params->base_path; ?>api/getCategoryList&language_id=2&medication_id=1&user_udid=14323"><strong>getCategoryList</strong></a> : <?php echo Yii::app()->params->base_path; ?>api/getCategoryList&language_id=2&medication_id=1&user_udid=14323 </p>
<p><strong>Params</strong> </p>
<p><strong>Method</strong> : GET and POST</p>
<p><strong>Fields</strong> : language_id=1&medication_id=1&user_udid=14323</p>
<p>--------------------------------------------------------------------------------------------------</p>

<p><a href="<?php echo Yii::app()->params->base_path; ?>api/getSubCategoryList&language_id=2&category_id=1"><strong>getSubCategoryList</strong></a> : <?php echo Yii::app()->params->base_path; ?>api/getSubCategoryList&language_id=2&category_id=1 </p>
<p><strong>Params</strong> </p>
<p><strong>Method</strong> : GET and POST</p>
<p><strong>Fields</strong> : language_id=1&category_id=1</p>
<p>--------------------------------------------------------------------------------------------------</p>

<p><a href="<?php echo Yii::app()->params->base_path; ?>api/getSubCategoryDetails&language_id=1&category_id=5"><strong>getSubCategoryDetails</strong></a> : <?php echo Yii::app()->params->base_path; ?>api/getSubCategoryDetails&category_id=1&user_udid=1 </p>
<p><strong>Params</strong> </p>
<p><strong>Method</strong> : GET and POST</p>
<p><strong>Fields</strong> : category_id=1 & user_udid=1</p>
<p>--------------------------------------------------------------------------------------------------</p>

<p><a href="<?php echo Yii::app()->params->base_path; ?>api/addFavourite&category_id=1&user_udid=1"><strong>addFavourite</strong></a> : <?php echo Yii::app()->params->base_path; ?>api/addFavourite&category_id=1&user_udid=1 </p>
<p><strong>Params</strong> </p>
<p><strong>Method</strong> : GET and POST</p>
<p><strong>Fields</strong> : (category_id=1 || medication_id=1) & user_udid=1</p>
<p>--------------------------------------------------------------------------------------------------</p>

<!--<p><a href="<?php echo Yii::app()->params->base_path; ?>api/getFavortiesList&category_id=1&user_udid=1"><strong>getFavortiesList</strong></a> : <?php echo Yii::app()->params->base_path; ?>api/getFavortiesList&category_id=1&user_udid=1 </p>
<p><strong>Params</strong> </p>
<p><strong>Method</strong> : GET and POST</p>
<p><strong>Fields</strong> : (category_id=1 || medication_id=1) & user_udid=1</p>
<p>--------------------------------------------------------------------------------------------------</p>-->

<p><a href="<?php echo Yii::app()->params->base_path; ?>api/removeFavourite&category_id=1&user_udid=1"><strong>removeFavourite</strong></a> : <?php echo Yii::app()->params->base_path; ?>api/removeFavourite&category_id=1&user_udid=1 </p>
<p><strong>Params</strong> </p>
<p><strong>Method</strong> : GET and POST</p>
<p><strong>Fields</strong> : (category_id=1 || medication_id=1) & user_udid=1</p>
<p>--------------------------------------------------------------------------------------------------</p>

</body>
</html>
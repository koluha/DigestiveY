<?php
/* @var $this F_AlcoholController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'F  Alcohols',
);

$this->menu=array(
	array('label'=>'Create F_Alcohol', 'url'=>array('create')),
	array('label'=>'Manage F_Alcohol', 'url'=>array('admin')),
);
?>

<h1>F  Alcohols</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

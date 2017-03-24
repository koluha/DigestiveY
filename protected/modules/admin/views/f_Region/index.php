<?php
/* @var $this F_RegionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'F  Regions',
);

$this->menu=array(
	array('label'=>'Create F_Region', 'url'=>array('create')),
	array('label'=>'Manage F_Region', 'url'=>array('admin')),
);
?>

<h1>F  Regions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

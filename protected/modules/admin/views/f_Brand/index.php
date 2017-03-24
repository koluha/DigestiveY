<?php
/* @var $this F_BrandController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'F  Brands',
);

$this->menu=array(
	array('label'=>'Create F_Brand', 'url'=>array('create')),
	array('label'=>'Manage F_Brand', 'url'=>array('admin')),
);
?>

<h1>F  Brands</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

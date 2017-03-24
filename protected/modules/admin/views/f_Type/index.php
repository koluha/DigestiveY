<?php
/* @var $this F_TypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'F  Types',
);

$this->menu=array(
	array('label'=>'Create F_Type', 'url'=>array('create')),
	array('label'=>'Manage F_Type', 'url'=>array('admin')),
);
?>

<h1>F  Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
/* @var $this F_SugarController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'F  Sugars',
);

$this->menu=array(
	array('label'=>'Create F_Sugar', 'url'=>array('create')),
	array('label'=>'Manage F_Sugar', 'url'=>array('admin')),
);
?>

<h1>F  Sugars</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

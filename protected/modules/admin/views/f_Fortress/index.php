<?php
/* @var $this F_FortressController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'F  Fortresses',
);

$this->menu=array(
	array('label'=>'Create F_Fortress', 'url'=>array('create')),
	array('label'=>'Manage F_Fortress', 'url'=>array('admin')),
);
?>

<h1>F  Fortresses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

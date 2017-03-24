<?php
/* @var $this F_TasteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'F  Tastes',
);

$this->menu=array(
	array('label'=>'Create F_Taste', 'url'=>array('create')),
	array('label'=>'Manage F_Taste', 'url'=>array('admin')),
);
?>

<h1>F  Tastes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

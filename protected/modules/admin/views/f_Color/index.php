<?php
/* @var $this F_ColorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'F  Colors',
);

$this->menu=array(
	array('label'=>'Create F_Color', 'url'=>array('create')),
	array('label'=>'Manage F_Color', 'url'=>array('admin')),
);
?>

<h1>F  Colors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

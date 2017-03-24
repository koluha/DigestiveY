<?php
/* @var $this F_GrapeSortController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'F  Grape Sorts',
);

$this->menu=array(
	array('label'=>'Create F_GrapeSort', 'url'=>array('create')),
	array('label'=>'Manage F_GrapeSort', 'url'=>array('admin')),
);
?>

<h1>F  Grape Sorts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

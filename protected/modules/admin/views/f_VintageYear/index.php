<?php
/* @var $this F_VintageYearController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'F  Vintage Years',
);

$this->menu=array(
	array('label'=>'Create F_VintageYear', 'url'=>array('create')),
	array('label'=>'Manage F_VintageYear', 'url'=>array('admin')),
);
?>

<h1>F  Vintage Years</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

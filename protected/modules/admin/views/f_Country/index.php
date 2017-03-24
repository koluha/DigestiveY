<?php
/* @var $this F_CountryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'F  Countries',
);

$this->menu=array(
	array('label'=>'Create F_Country', 'url'=>array('create')),
	array('label'=>'Manage F_Country', 'url'=>array('admin')),
);
?>

<h1>F  Countries</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

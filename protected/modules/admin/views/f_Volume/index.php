<?php
/* @var $this F_VolumeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'F  Volumes',
);

$this->menu=array(
	array('label'=>'Create F_Volume', 'url'=>array('create')),
	array('label'=>'Manage F_Volume', 'url'=>array('admin')),
);
?>

<h1>F  Volumes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

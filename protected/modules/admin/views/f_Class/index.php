<?php
/* @var $this F_ClassController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'F  Classes',
);

$this->menu=array(
	array('label'=>'Create F_Class', 'url'=>array('create')),
	array('label'=>'Manage F_Class', 'url'=>array('admin')),
);
?>

<h1>F  Classes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

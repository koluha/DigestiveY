<?php
/* @var $this F_PackagingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'F  Packagings',
);

$this->menu=array(
	array('label'=>'Create F_Packaging', 'url'=>array('create')),
	array('label'=>'Manage F_Packaging', 'url'=>array('admin')),
);
?>

<h1>F  Packagings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

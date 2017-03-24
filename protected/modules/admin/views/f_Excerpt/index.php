<?php
/* @var $this F_ExcerptController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'F  Excerpts',
);

$this->menu=array(
	array('label'=>'Create F_Excerpt', 'url'=>array('create')),
	array('label'=>'Manage F_Excerpt', 'url'=>array('admin')),
);
?>

<h1>F  Excerpts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

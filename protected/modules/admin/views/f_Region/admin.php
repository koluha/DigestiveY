<?php
$updateDialog = <<<'EOT'
function() { 
    var url = $(this).attr('href');
    $.get(url, function(r){
        $("#update_re").html(r).dialog("open");
        return false;
    });
    return false;
}
EOT;

echo '<h2>Регион фильтр</h2>';
$model = new F_region();

echo CHtml::Link('Создать', '#', array(
    'id' => 'link_add_region',
    'ajax' => array(
        'url' => $this->createUrl('f_region/create'),
        'success' => 'function(r){$("#create_re").html(r).dialog("open"); return false;}',
        //'complete' => 'function() {$.fn.yiiGridView.update("f--region-grid")}'
    ),
));


$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'f--region-grid',
    'dataProvider' => $model->search(),
    //'filter'=>$model,
    'columns' => array(
        'id',
        'url',
        'title',
        'sort',
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
                'update' => array(
                    'click' => $updateDialog,
                    'url' => 'Yii::app()->createUrl("admin/f_region/update", array("id"=>$data->id))',
                ),
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("admin/f_region/delete", array("id"=>$data->id))',
                ),
            ),
        ),
    ),
));

$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'create_re',
    'options' => array(
        'title' => 'Создать Регион',
        'autoOpen' => false,
        'modal' => true,
        'width' => 'auto',
        'height' => 'auto',
        'resizable' => 'false',
    ),
));
$this->endWidget();

$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'update_re',
    'options' => array(
        'title' => 'Редактировать Регион',
        'autoOpen' => false,
        'modal' => true,
        'width' => 'auto',
        'height' => 'auto',
        'resizable' => 'false',
    ),
));
$this->endWidget();








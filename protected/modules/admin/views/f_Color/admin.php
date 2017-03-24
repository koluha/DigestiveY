<?php
$updateDialog = <<<'EOT'
function() { 
    var url = $(this).attr('href');
    $.get(url, function(r){
        $("#update_co").html(r).dialog("open");
        return false;
    });
    return false;
}
EOT;

echo '<h2>Цвет фильтр</h2>';
$model = new F_color();

echo CHtml::Link('Создать', '#', array(
    'id' => 'link_add_color',
    'ajax' => array(
        'url' => $this->createUrl('f_color/create'),
        'success' => 'function(r){$("#create_co").html(r).dialog("open"); return false;}',
        //'complete' => 'function() {$.fn.yiiGridView.update("f--color-grid")}'
    ),
));


$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'f--color-grid',
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
                    'url' => 'Yii::app()->createUrl("admin/f_color/update", array("id"=>$data->id))',
                ),
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("admin/f_color/delete", array("id"=>$data->id))',
                ),
            ),
        ),
    ),
));

$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'create_co',
    'options' => array(
        'title' => 'Создать Цвет',
        'autoOpen' => false,
        'modal' => true,
        'width' => 'auto',
        'height' => 'auto',
        'resizable' => 'false',
    ),
));
$this->endWidget();

$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'update_co',
    'options' => array(
        'title' => 'Редактировать Цвет',
        'autoOpen' => false,
        'modal' => true,
        'width' => 'auto',
        'height' => 'auto',
        'resizable' => 'false',
    ),
));
$this->endWidget();
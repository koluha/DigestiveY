<?php
$updateDialog = <<<'EOT'
function() { 
    var url = $(this).attr('href');
    $.get(url, function(r){
        $("#update_f").html(r).dialog("open");
        return false;
    });
    return false;
}
EOT;

echo '<h2>Крепость % фильтр</h2>';
$model = new F_fortress();

echo CHtml::Link('Создать', '#', array(
    'id' => 'link_add_fortress',
    'ajax' => array(
        'url' => $this->createUrl('f_fortress/create'),
        'success' => 'function(r){$("#create_f").html(r).dialog("open"); return false;}',
        //'complete' => 'function() {$.fn.yiiGridView.update("f--fortress-grid")}'
    ),
));


$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'f--fortress-grid',
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
                    'url' => 'Yii::app()->createUrl("admin/f_fortress/update", array("id"=>$data->id))',
                ),
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("admin/f_fortress/delete", array("id"=>$data->id))',
                ),
            ),
        ),
    ),
));

$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'create_f',
    'options' => array(
        'title' => 'Создать Крепость %',
        'autoOpen' => false,
        'modal' => true,
        'width' => 'auto',
        'height' => 'auto',
        'resizable' => 'false',
    ),
));
$this->endWidget();

$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'update_f',
    'options' => array(
        'title' => 'Редактировать Крепость %',
        'autoOpen' => false,
        'modal' => true,
        'width' => 'auto',
        'height' => 'auto',
        'resizable' => 'false',
    ),
));
$this->endWidget();
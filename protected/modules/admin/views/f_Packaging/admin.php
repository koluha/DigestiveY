<?php
$updateDialog = <<<'EOT'
function() { 
    var url = $(this).attr('href');
    $.get(url, function(r){
        $("#update_pa").html(r).dialog("open");
        return false;
    });
    return false;
}
EOT;

echo '<h2>Упаковка фильтр</h2>';
$model = new F_packaging();

echo CHtml::Link('Создать', '#', array(
    'id' => 'link_add_packaging',
    'ajax' => array(
        'url' => $this->createUrl('f_packaging/create'),
        'success' => 'function(r){$("#create_pa").html(r).dialog("open"); return false;}',
        //'complete' => 'function() {$.fn.yiiGridView.update("f--packaging-grid")}'
    ),
));


$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'f--packaging-grid',
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
                    'url' => 'Yii::app()->createUrl("admin/f_packaging/update", array("id"=>$data->id))',
                ),
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("admin/f_packaging/delete", array("id"=>$data->id))',
                ),
            ),
        ),
    ),
));

$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'create_pa',
    'options' => array(
        'title' => 'Создать Упаковка',
        'autoOpen' => false,
        'modal' => true,
        'width' => 'auto',
        'height' => 'auto',
        'resizable' => 'false',
    ),
));
$this->endWidget();

$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'update_pa',
    'options' => array(
        'title' => 'Редактировать Упаковка',
        'autoOpen' => false,
        'modal' => true,
        'width' => 'auto',
        'height' => 'auto',
        'resizable' => 'false',
    ),
));
$this->endWidget();
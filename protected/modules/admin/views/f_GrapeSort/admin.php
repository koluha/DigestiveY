<?php
$updateDialog = <<<'EOT'
function() { 
    var url = $(this).attr('href');
    $.get(url, function(r){
        $("#update_gr").html(r).dialog("open");
        return false;
    });
    return false;
}
EOT;

echo '<h2>Сорт винограда фильтр</h2>';
$model = new F_grapesort();

echo CHtml::Link('Создать', '#', array(
    'id' => 'link_add_grapesort',
    'ajax' => array(
        'url' => $this->createUrl('f_grapesort/create'),
        'success' => 'function(r){$("#create_gr").html(r).dialog("open"); return false;}',
        //'complete' => 'function() {$.fn.yiiGridView.update("f--grapesort-grid")}'
    ),
));


$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'f--grapesort-grid',
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
                    'url' => 'Yii::app()->createUrl("admin/f_grapesort/update", array("id"=>$data->id))',
                ),
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("admin/f_grapesort/delete", array("id"=>$data->id))',
                ),
            ),
        ),
    ),
));

$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'create_gr',
    'options' => array(
        'title' => 'Создать Сорт винограда',
        'autoOpen' => false,
        'modal' => true,
        'width' => 'auto',
        'height' => 'auto',
        'resizable' => 'false',
    ),
));
$this->endWidget();

$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'update_gr',
    'options' => array(
        'title' => 'Редактировать Сорт винограда',
        'autoOpen' => false,
        'modal' => true,
        'width' => 'auto',
        'height' => 'auto',
        'resizable' => 'false',
    ),
));
$this->endWidget();

<div class="form" style="width: 410px;
     margin-left: 0px;
     position: relative;
     display: block;
     top: 0;
     left: 0;
     ">
    <p>*url должен быть уникальным</p>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'f--packaging-form',
	 'enableAjaxValidation' => FALSE,
        'enableClientValidation' => TRUE,
)); ?>

   <div class="row">
        <?php echo $form->labelEx($model, 'url'); ?>
        <?php echo $form->textField($model, 'url', array('size' => 40, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'url'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'Название Упаковка'); ?>
        <?php echo $form->textField($model, 'title'); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'Сортировка'); ?>
        <?php echo $form->textField($model, 'sort'); ?>
        <?php echo $form->error($model, 'sort'); ?>
    </div>

    <div class="row buttons">
        <?php if (!Yii::app()->request->isAjaxRequest): ?>
            <div class="row buttons ">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
            </div>


        <?php else: ?>
            <div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">
                <div class="ui-dialog-buttonset">
                    <?php
                    $this->widget('zii.widgets.jui.CJuiButton', array(
                        'name' => 'submit_' . rand(),
                        'caption' => $model->isNewRecord ? 'Создать' : 'Сохранить',
                        'htmlOptions' => array(
                            'ajax' => array(
                                'url' => $model->isNewRecord ? $this->createUrl('create') : $this->createUrl('update', array('id' => $model->id)),
                                'type' => 'post',
                                'data' => 'js:jQuery(this).parents("form").serialize()',
                                'success' => 'function(r){
                            if(r=="success_create"){
                               $("#create_pa").html(r).dialog("close"); 
                               return false;
                            }else if(r=="success_create_close"){
                               $("#create_pa").html(r).dialog("open"); 
                               return false;
                            }else if(r=="success_update"){
                               $("#update_pa").html(r).dialog("close"); 
                               return false;
                            }else if(r=="success_update_close"){
                               $("#update_pa").html(r).dialog("open"); 
                               return false;
                            }             
                               
                            
                        }',
                                'complete' => 'function() {$.fn.yiiGridView.update("f--packaging-grid")}',
                            ),
                        ),
                    ));
                    ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->
<h1>Создать класс</h1>
<?php
Yii::app()->clientScript->scriptMap['jquery.js'] = false;
Yii::app()->clientScript->scriptMap['jquery-ui.min.js'] = false;
Yii::app()->clientScript->scriptMap['jquery-ui.css'] = false;
$this->renderPartial('_form', array('model' => $model));
?>

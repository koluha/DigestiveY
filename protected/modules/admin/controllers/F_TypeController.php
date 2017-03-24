<?php

class F_typeController extends Controller
 {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    //Создаем новую запись объема
    public function actionCreate() {
        $model = new F_type;
        
        if (isset($_POST['F_type'])) {
            //$model->attributes = $_POST['F_type'];
            $model->url=Myhelper::translitUrl($_POST['F_type']['url']);
            $model->title=$_POST['F_type']['title'];
            $model->sort=$_POST['F_type']['sort'];
            
            if ($model->save()) {
                if (Yii::app()->request->isAjaxRequest) {
                    echo 'success_create';
                    Yii::app()->end();
                } else {
                    $this->redirect(array('view', 'id' => $model->id));
                }
            }  else {
                echo 'success_create_close';
            }
        }
        if (Yii::app()->request->isAjaxRequest)
            $this->renderPartial('create', array('model' => $model), false, true);
        else
            $this->render('create', array('model' => $model));
        }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['F_type'])) {
            $model->attributes = $_POST['F_type'];
            $model->url=Myhelper::translitUrl($_POST['F_type']['url']);
            $model->title=$_POST['F_type']['title'];
            $model->sort=$_POST['F_type']['sort'];
            if ($model->save()) {
                if (Yii::app()->request->isAjaxRequest) {
                    echo 'success_update';
                    Yii::app()->end();
                } else
                   
                   $this->redirect(array('view', 'id' => $model->id));
            }else {
                echo 'success_update_close';
            }
        }
        if (Yii::app()->request->isAjaxRequest)
            $this->renderPartial('update', array('model' => $model), false, true);
        else
            $this->render('update', array('model' => $model));
    }

    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionAdmin() {
        $model = new F_type('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['F_type']))
            $model->attributes = $_GET['F_type'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = F_type::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'f--type-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}



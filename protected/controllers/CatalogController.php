<?php

class CatalogController extends Controller {

    private $rq;
    private $db;
    private $ob_cat; //Объект модели каталога
    private $ob_pagination; //Объект пагинация
    private $ob_bread; //Объект хлебных крошек
    public $breadcrumbs;  //Переменная доступна в шаблоне

    public function init() {
        $this->rq = Yii::app()->request;
        $this->db = Yii::app()->db;
        $this->ob_cat = new ModelCatalog();
        $this->ob_pagination = new Pagination($id, $url, $page);
        $this->ob_bread = new Breadcrumbs;
    }

    //Управление каталогом
    public function actionIndex() {

        try {
            //Если нету фильтра 
            if ($this->rq->getQuery('url') && !$this->rq->getQuery('url_filter') && !$this->rq->getQuery('name_filter')) {
                //Получаем url и найдем id_category
                $catal['url'] = $this->rq->getQuery('url');
                $catal['id'] = $this->ob_cat->get_id($catal['url']);

                //Сортировка
                $catal['sort'] = $this->rq->getQuery('order') ? $this->rq->getQuery('order') : '';
                Yii::app()->session['select_order'] = $catal['sort'];

                //Категорий
                $data['categories'] = $this->ob_cat->listCategory($catal['id']);

                //Рандомное описание
                $data['desc'] = $this->randomdesc($data['categories']);

                //Работа хлебных крошек
                $this->ob_bread->SetBreadSessian('', '', $catal['id']);
                // $this->breadcrumbs = $data['bread']; //Для шаблона
                //Запомнить id для фильтра бокового
                Yii::app()->session['filter_side'] = $catal['id'];

                //Пагинация 
                $page = intval($this->rq->getQuery('page'));
                $pag = $this->ob_pagination->use_pagination($catal['id'], $catal['url'], $page);
                $pag['sort'] = $catal['sort'];
                //Продукты без фильтра
                $data['products'] = $this->ob_cat->ListProduct($catal, $pag);

                $this->render('index', array('data' => $data, 'pagin' => $pag));

                //Если есть фильтра 
            } elseif ($this->rq->getQuery('url') && $this->rq->getQuery('url_filter')) {

                //Получаем url 
                $catal['url'] = $this->rq->getQuery('url');
                $catal['id'] = $this->ob_cat->get_id($catal['url']);
                //Сортировка
                $catal['sort'] = $this->rq->getQuery('order') ? $this->rq->getQuery('order') : '';
                Yii::app()->session['select_order'] = $catal['sort'];

                //Получить родителя категорий
                $catal['parent_id'] = $this->ob_cat->parent_id($catal['id']);

                //Значение фильтра
                $catal['url_filter'] = $this->rq->getQuery('url_filter');
                //Имя фильтра (массива)
                $catal['name_filter'] = $this->rq->getQuery('name_filter');

                //Если популярное
                $catal['popular'] = ($this->rq->getQuery('popular')) ? $this->rq->getQuery('popular') : FALSE;

                //Пагинация 
                $page = intval($this->rq->getQuery('page'));


                $pag = $this->ob_pagination->use_paginationfilter($catal['parent_id'], $catal['url'], $page, $catal['url_filter'], $catal['name_filter'], $catal['popular']);



                //Передаем данные фильтра
                $pag['url_filter'] = $catal['url_filter'];
                $pag['name_filter'] = $catal['name_filter'];
                //Сортировки
                $pag['sort'] = $catal['sort'];

                //Категорий
                $data['categories'] = $this->ob_cat->listCategory($catal['id']);
                //Рандомное описание
                $data['desc'] = $this->randomdesc($data['categories']);

                //Продукты c фильтром
                $data['products'] = $this->ob_cat->ListProduct($catal, $pag);
                //Популярное
                $pag['popular'] = $catal['popular'];

                //Работа хлебных крошек
                $title_filter = $this->ob_cat->get_title_filter($catal['url_filter'], $catal['name_filter']);
                $this->ob_bread->ClearBreadSessian;
                $this->ob_bread->SetBreadSessian('', $title_filter, $catal['parent_id']);

                //Запомнить id для фильтра бокового
                Yii::app()->session['filter_side'] = $catal['id'];

                $this->render('index', array('data' => $data, 'pagin' => $pag));
            }
        } catch (Exception $ex) {
            //$this->render('index', array('error'=>'Ошибка получения данных продуктов'));
            $ex->getMessage('Ошибка получения данных продуктов');
        }
    }

    //Вернет случайную запись выбраннной категорий
    public function randomdesc($data) {
        if ($data) {
            foreach ($data as $value) {
                $res[] = $value['id'];
            }

            $number = mt_rand(0, count($res) - 1);

            $data = $this->ob_cat->get_all($res[$number]);
            return ($data) ? $data : '';
        }
    }

    public function actionFilterAjax() {
        if (Yii::app()->request->isAjaxRequest) {
            $data_filrets = $_POST['data_filrets'];
            $url_category = $_POST['url_category'];
            $obj_catalog = new ModelCatalog;
            $id_catagory = $obj_catalog->get_id($url_category); //id категорий

            //Получание вида для каталога продуктов
            if ($data_filrets) { //Если пришли данные фильтра
                /* Входные данные  * Array([0] => brand&Bruichladdich [1] => country&Scotland) */

                foreach ($data_filrets as $name => $var) {
                    //Извлеч из строки строки массива - название фильтра и его значение в переменные 
                    $name_f = self::string_filter($var, '&', 'before');
                    $value_f = self::string_filter($var, '&', 'after');

                    //Это сделано для удобного сравнения одинаковых имен фильтра
                    $arr[] = array('name' => $name_f,
                        'value' => $value_f);
                }

                // Получить часть текста sql
                $list_filter = $obj_catalog->list_filter();
                $count = 0;
                $count_sql = 0;
                foreach ($list_filter as $name_filter => $value_filter) {
                    ${'count_' . $name_filter} = 0;
                    foreach ($arr as $key => $val) {
                        if ($val['name'] == $name_filter) {
                            ${'count_' . $name_filter} ++;
                            if (${'count_' . $name_filter} == 1) {
                                ${'sql_' . $name_filter}.="{$val['name']}.url='{$val['value']}'";
                            } elseif (${'count_' . $name_filter} > 1) {
                                ${'sql_' . $name_filter}.=($key >= 1 ? ' OR ' : '');
                                ${'sql_' . $name_filter}.="{$val['name']}.url='{$val['value']}'";
                            }
                        }
                    }
                    if (${'sql_' . $name_filter}) {

                        $sql_where.=' AND ';
                        $sql_where.= ${'sql_' . $name_filter} ? '(' . ${'sql_' . $name_filter} . ')' : ' ';
                    }
                    // выходе часть строки sql после where 
                }
                if (!empty($sql_where)) {
                    $list = $obj_catalog->AjaxListProduct($id_catagory, $sql_where);
                }

               //Получить Вид списка продукта
                $product_s=$obj_catalog->ViewProduct($list);
                
                
                //id группы, выбранные фильтры
                $filter_s=$obj_catalog->AjaxViewFilter($id_catagory,$arr);
                
                $view=array('product'=>$product_s,'filter'=>$filter_s, 'test1'=>$arr);
                
                echo json_encode($view);

                // Завершаем приложение
                Yii::app()->end();
            } else {
                //Поучить полный список продуктов
                $list = $obj_catalog->AjaxAllListProduct($id_catagory);
                $product_s =$obj_catalog->ViewProduct($list) ;
                
                $filter_s=$obj_catalog->AjaxViewFilter($id_catagory);
                
                $view=array('product'=>$product_s,'filter'=>$filter_s, 'test1'=>$arr);
                echo json_encode($view);
                Yii::app()->end();
            }
        }
    }

    //Возвращает разобранную строку
    static function string_filter($string, $flag, $position) {
        if ($string) {
            if ($position == 'before') {
                $pos = strpos($string, $flag); //Найти позицию flag
                $res = substr($string, 0, $pos); //Вырезать строку от начала до указанной позиции 
            } elseif ($position == 'after') {
                $pos = strpos($string, $flag);
                $len = strlen($string);
                $res = substr($string, $pos + 1, $len); //взять все строки после flag
            }
            return $res;
        }
    }

}

<?php

class ModelCatalog {

    private $id; //id выбранной категорий

    #Функция определит уровень вложенности 
    #Вернет уроверь вложенности 1/2/3

    public function level($id) {
        $count_level = 0;
        while (self::querylevel($id) != NULL) {
            $sql = "SELECT parent_id  FROM tb_catalog WHERE id='$id'";
            //Изменяем id
            $id = Yii::app()->db->createCommand($sql)->queryScalar();
            $count_level++;
        }
        return $count_level;
    }

    #Запрос к бд, для уровня вложеннности

    static function querylevel($id) {
        $sql = "SELECT parent_id  FROM tb_catalog WHERE id='$id'";
        $count = Yii::app()->db->createCommand($sql)->queryScalar();
        return $count != NULL ? $count : NULL;
    }

    #Вернет весь список в которой есть выбранная группы

    public function list_allgroup($id) {
        $sql = "SELECT id, parent_id, title, img, url FROM tb_catalog WHERE parent_id='$id'";
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res ? $res : FALSE;
    }

    #Вернет id родителя

    public function parent_id($id) {
        $sql = "SELECT parent_id FROM tb_catalog WHERE id='$id'";
        $res = Yii::app()->db->createCommand($sql)->queryScalar();
        return $res ? $res : FALSE;
    }

    #Вернет наименование категорий

    public function get_title($id) {
        $sql = "SELECT title FROM tb_catalog WHERE id='$id'";
        $text = Yii::app()->db->createCommand($sql)->queryScalar();
        return $text;
    }

    #Вернет url категорий

    public function get_url($id) {
        $sql = "SELECT url FROM tb_catalog WHERE id='$id'";
        $text = Yii::app()->db->createCommand($sql)->queryScalar();
        return $text;
    }

//**** Фронтенд функции  ****//    
    //Сформировать список первых родителей (для меню)(Group)
    static function ListGroup() {
        $sql = "SELECT id, title, url  FROM tb_catalog WHERE parent_id='0' ORDER BY sort";
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }

    //Установить id категорий
    public function setId_cat($url) {
        $this->id = $this->get_id($url);
        return $this->id;
    }

    //Установить id категорий
    public function set_cat($url) {
        $this->id = $url;
        return $this->id;
    }

    //МЕНЮ Вернет второй уровень Категорий товаров
    public function levelcategory() {
        $sql = "SELECT id, parent_id, title, img, url FROM tb_catalog WHERE parent_id='$this->id'";
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res ? $res : FALSE;
    }

    //В меню вернуть тип или класс(1)
    public function leveltype_or_class($check_class = 0) {
        $sql = "SELECT  DISTINCT 
                pr.group_3 as title,
                c.check_class,
                c.url as url
              FROM tb_product as pr
                INNER JOIN tb_catalog AS c ON pr.key_group_3=c.id
              WHERE pr.key_group_1='$this->id'  AND pr.group_3!='' AND c.check_class ='$check_class'
                GROUP BY pr.group_3 
                ORDER BY c.sort;"
        ;
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res ? $res : FALSE;
    }

    //МЕНЮ Вернет список фильтров
    //Передаем таблицу фильтра и нзвания поля фильтра в тб product
    public function levelspec($table_filter, $c_item) {
        $sql = "SELECT p.key_group_2, c.url AS url_category,  c.parent_id,    fl.url AS url_filter, fl.title AS title_filter, fl.sort AS sort_filter      
                    FROM tb_product as p
                INNER JOIN tb_catalog as c  ON c.id = p.key_group_2
                INNER JOIN $table_filter as fl  ON $c_item = fl.id
                    WHERE c.parent_id='$this->id' 
                GROUP BY  url_filter ORDER BY sort_filter";

        $res = Yii::app()->db->createCommand($sql)->queryAll();
        /* $sql = "SELECT 
          l.key_spec_value as key_spec_value,
          psv.id as id_spec,
          psv.name as name_spec,
          CASE
          WHEN (sv.val_text!='')  THEN   sv.val_text
          WHEN sv.val_int         THEN   sv.val_int
          WHEN sv.val_float       THEN   sv.val_float
          END as val_spec,
          p.id as p_id,
          c.id as cat_id
          FROM tb_product as p
          INNER JOIN tb_link as l  ON p.id = l.key_product
          INNER JOIN tb_spec_value as sv  ON sv.id = l.key_spec_value
          INNER JOIN tb_product_spec as psv  ON psv.id = sv.key_prod_spec
          INNER JOIN tb_catalog as c  ON c.id = p.key_catalog
          WHERE psv.id='$id_spec' AND c.parent_id='$this->id' GROUP BY val_spec";
          $res = Yii::app()->db->createCommand($sql)->queryAll(); */
        return $res ? $res : FALSE;
    }

//Найти id_parent по url
    public function get_id($url) {
        $sql = "SELECT id  FROM tb_catalog WHERE url='$url'";
        $id = Yii::app()->db->createCommand($sql)->queryScalar();
        return $id;
    }
    
    //Вернуть имя title фильтра
     public function get_title_filter($url_filter,$name_filter) {
        $sql = "SELECT title  FROM tb_f_$name_filter WHERE url='$url_filter'";
        $title = Yii::app()->db->createCommand($sql)->queryScalar();
        return $title;
    }

    public function get_all($id) {
        $sql = "SELECT * FROM tb_catalog WHERE id='$id'";
        $text = Yii::app()->db->createCommand($sql)->queryRow();
        return $text;
    }

    public function count_product() {
        $sql = "SELECT COUNT(*) FROM tb_product;";
        $count = Yii::app()->db->createCommand($sql)->queryScalar();
        return $count;
    }

    //Выбор товара на главную страницу
    static function randon_product($kol) {
        $sql = "SELECT COUNT(*) FROM tb_product WHERE i_popular=1;";
        $row_count = Yii::app()->db->createCommand($sql)->queryScalar();
        $query = array();
        while (count($query) < $kol) {
            $query[] = '(SELECT * FROM tb_product WHERE i_popular=1 LIMIT ' . rand(0, $row_count) . ', 1)';
        }
        $query = implode(' UNION ', $query);
        $randon_product = Yii::app()->db->createCommand($query)->queryAll();
        return $randon_product;
    }

//Получить Продукты для категорий key_group_2
    //($catal['id'], '', '', $pag['start'], $pag['num']);
    public function ListProduct($catal, $pag) {
        //Обрабатываем параметр сортировки
        if ($catal['sort']) {
            $sort = str_replace('-', ' ', $catal['sort']);
            $order = ' ORDER BY ' . $sort;
        } elseif ($catal['sort'] == '') {
            $order = ' ORDER BY i_old_price desc ';
        }

        //Без фильтра
        if ($catal['id'] && !$catal['url_filter'] && !$catal['name_filter']) {
            $sql = "SELECT  
                            p.id,
                            p.article,
                            p.key_group_1,
                            p.key_group_2,
                            p.key_group_3,
                            p.i_popular,
                            p.i_limitedly,
                            p.i_name_sku,
                            p.i_availability,
                            p.i_old_price,
                            p.i_price,
                            p.d_photo_small,
                            p.d_photo_middle,
                            p.t_url,
                            p.f_fortress,
                            p.f_volume
                        FROM  tb_catalog as c
                        INNER JOIN tb_product as p ON p.key_group_2 = c.id
                        WHERE c.parent_id=" . $catal['id'] . " OR c.id=" . $catal['id'] . "  OR key_group_3=" . $catal['id'] . " " . $order . " LIMIT " . $pag['start'] . "," . $pag['num'] . "";
            //С фильтром
        } elseif ($catal['parent_id'] && $catal['url_filter'] && $catal['name_filter']) {
            $url_filter = $catal['url_filter'];
            $name_filter = $catal['name_filter'];

            //Для популярного 
            $popular = ($catal['popular']) ? 'AND p.i_popular=' . $catal['popular'] : '';


            $sql = "SELECT 
                        c.id as c_id,
                        c.parent_id,
                        p.id,
                        p.article,
                        p.key_group_1,
                        p.key_group_2,
                        p.key_group_3,
                        p.i_popular,
                        p.i_limitedly,
                        p.i_name_sku,
                        p.i_availability,
                        p.i_popular,
                        p.i_old_price,
                        p.i_price,
                        p.d_photo_small,
                        p.d_photo_middle,
                        p.t_url,
                        f.url,
                        f_f.title as f_fortress,
                        f_f.title as f_volume
                FROM tb_catalog as c
                    INNER JOIN tb_product as p ON p.key_group_2 = c.id
                        INNER JOIN tb_f_$name_filter as f  ON p.f_id_$name_filter = f.id
                                LEFT JOIN tb_f_fortress AS f_f ON f_f.id=p.f_id_fortress
                                LEFT JOIN tb_f_volume AS f_v ON f_v.id=p.f_id_volume
                     WHERE (c.parent_id=" . $catal['parent_id'] . " OR c.id='" . $catal['parent_id'] . "'  OR key_group_3='" . $catal['parent_id'] . "')
                            $popular AND f.url='$url_filter' " . $order . "  LIMIT " . $pag['start'] . "," . $pag['num'] . " ";
        }
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }

    public function levelpopular() {
        $sql = "SELECT p.key_group_2, c.url AS url_category,  c.parent_id,    fl.url AS url_filter, fl.title AS title_filter, fl.sort AS sort_filter      
                        FROM tb_product as p
             INNER JOIN tb_catalog as c  ON c.id = p.key_group_2
             INNER JOIN tb_f_brand as fl  ON p.f_id_brand = fl.id
                    WHERE c.parent_id='$this->id' AND p.i_popular='1'
                    GROUP BY  url_filter";






        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res ? $res : FALSE;
    }

//Получить все продукты 
    public function allproduct($key_catalog = FALSE) {
        //Вывести весь список продукции

        if (!$key_catalog) {
            $sql = "SELECT * FROM tb_product";
            //Вывести список по каталогу выбранному    
        } elseif ($key_catalog) {
            $sql = "SELECT * FROM tb_product WHERE key_catalog='$key_catalog'";
        }
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }

//Получть для продукта его крепость(id=7) и объем(id=6)
    static function statdata($key_product) {
        $sql = "SELECT 
                    psv.name as name_spec,
                    psv.id as id_spec,
                    CASE
                        WHEN (sv.val_text!='')  THEN    sv.val_text
                        WHEN sv.val_int         THEN    sv.val_int
                        WHEN sv.val_float       THEN    sv.val_float
                    END as val_spec
                FROM tb_product as p
                    INNER JOIN tb_link as l  ON p.id = l.key_product
                    INNER JOIN tb_spec_value as sv  ON sv.id = l.key_spec_value
                    INNER JOIN tb_product_spec as psv  ON psv.id = sv.key_prod_spec
                WHERE p.id='$key_product' AND (psv.id='7' OR psv.id='6' OR psv.id='2' OR psv.id='14')";
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }

//Получить все фильтры имеющие эти категории товаров
    static function listFilters($key_category) {
        //Будет 15 запосов по каждому фильтру
        try {
            $transaction->commit();
        } catch (Exception $e) {
            if ($transaction->getActive()) {
                $transaction->rollback();
            }
            throw $e;
        }



        $sql = "SELECT 
                f_brand,
                f_s_brand,
                f_country,
                f_s_country,
                f_region,
                f_s_region,
                f_alcohol,
                f_s_alcohol,
                f_taste,
                f_s_taste,
                f_sugar,
                f_s_sugar,
                f_grape_sort,
                f_s_grape_sort,
                f_vintage_year,
                f_s_vintage_year,
                f_color,
                f_s_color,
                f_excerpt,
                f_s_excerpt,
                f_fortress,
                f_volume,
                f_packaging
                    
                FROM tb_catalog as c
                    INNER JOIN tb_product as p ON p.key_group_2 = c.id
                WHERE c.parent_id=$key_category OR c.id=$key_category GROUP BY f_brand, f_country ;";
        $res = Yii::app()->db->createCommand($sql)->queryAll();

        foreach ($res as $key => $value) {
            if ($value['f_brand']) {
                $data['f_brand'][] = $value['f_brand'];
            }
            if ($value['f_country']) {
                $data['f_country'][] = $value['f_country'];
            }
        }
        return $data;
    }

    static function GetFilter() {
        $sql = "SELECT 
                f_brand,
                f_s_brand,
                f_country,
                f_s_country,
                f_region,
                f_s_region,
                f_type,
                f_s_type,
                f_class,
                f_s_class,
                f_alcohol,
                f_s_alcohol,
                f_taste,
                f_s_taste,
                f_sugar,
                f_s_sugar,
                f_grape_sort,
                f_s_grape_sort,
                f_vintage_year,
                f_s_vintage_year,
                f_color,
                f_s_color,
                f_excerpt,
                f_s_excerpt,
                f_fortress,
                f_s_fortress,
                f_volume,
                f_s_volume,
                f_packaging,
                f_s_packaging
                    
                FROM tb_catalog as c
                    INNER JOIN tb_product as p ON p.key_category = c.id
                WHERE c.parent_id=$key_category OR c.id=$key_category GROUP BY f_brand, f_country ;";
        $res = Yii::app()->db->createCommand($sql)->queryAll();
    }

//Получить все фильтры имеющие эти категории товаров
    static function OLDlistFilters($key_category) {
        $sql = "SELECT 
                    psv.id as id_spec,
                    psv.name as name_spec,
                CASE
                    WHEN (sv.val_text!='')  THEN   sv.val_text
                    WHEN sv.val_int         THEN   sv.val_int
                    WHEN sv.val_float       THEN   sv.val_float
                END as val_spec
                FROM tb_catalog as c
                    INNER JOIN tb_product as p ON p.key_catalog = c.id
                    INNER JOIN tb_link as l  ON p.id = l.key_product
                    INNER JOIN tb_spec_value as sv  ON sv.id = l.key_spec_value
                    INNER JOIN tb_product_spec as psv  ON psv.id = sv.key_prod_spec
                WHERE c.parent_id=$key_category OR c.id=$key_category ;";
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }

//Функция возвращает дерево для хлебных крошек
    public function free($id) {
        $sql = "SELECT 
                    t1.url as id_1,
                    t1.title as title_1,
                    t2.url as id_2,
                    t2.title as title_2
                FROM tb_catalog AS t1 
                    LEFT JOIN tb_catalog AS t2 ON t1.parent_id = t2.id 
                WHERE t1.id = '$id'";
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }

//Функция для фильтра
    public function GetFilterSpec($id_cat, $name_spec, $start, $num) {
        //$name_spec=$this->getNameSpec($id_spec);

        $sql = "SELECT 
                    l.key_spec_value,
                    psv.id as id_spec,
                    psv.name as name_spec,
                        CASE
                            WHEN (sv.val_text!='')  THEN    sv.val_text
                            WHEN sv.val_int         THEN    sv.val_int
                            WHEN sv.val_float       THEN    sv.val_float
                        END as val_spec,
                    p.id as p_id,
                    c.id as cat_id,
                        p.id,
                        p.key_catalog,
                        p.title,
                        p.price,
                        p.old_price,
                        p.availability,
                        p.url,
                        p.img,
                        p.meta_title,
                        p.meta_keywords,
                        p.meta_description
                            FROM tb_product as p
                                INNER JOIN tb_link as l  ON p.id = l.key_product
                                INNER JOIN tb_spec_value as sv  ON sv.id = l.key_spec_value
                                INNER JOIN tb_product_spec as psv  ON psv.id = sv.key_prod_spec
				INNER JOIN tb_catalog as c  ON c.id = p.key_catalog
                            WHERE c.parent_id='$id_cat'  AND '$name_spec'=CASE
			                 						WHEN (sv.val_text!='')  THEN   sv.val_text  
					         					WHEN sv.val_int 	THEN   sv.val_int
						                        		WHEN sv.val_float       THEN   sv.val_float
									           END   
                             LIMIT $start, $num";
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res ? $res : FALSE;
    }

// //Функция для фильтра Получить имя выбранную спецификацию по id
    public function getNameSpec($id) {
        $sql = "SELECT 
                
                    CASE
                        WHEN (sv.val_text!='')  THEN  sv.val_text
                        WHEN sv.val_int         THEN  sv.val_int
                        WHEN sv.val_float       THEN  sv.val_float
                    END as val_spec
                FROM tb_spec_value  as  sv
                WHERE sv.id='$id' ";
        $name = Yii::app()->db->createCommand($sql)->queryScalar();
        return $name ? $name : FALSE;
    }

//**** Админка функции  ****//
//Сформировать список первых родителей (для меню)(Group) для Selecta
    static function DropListGroup() {
        $sql = "SELECT id,title  FROM tb_catalog WHERE parent_id='0' ORDER BY title";
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        if (!empty($res)) {
            $drop = self::MyFormatDropList($res);
        } else {
            $drop = array();
        }
        return $drop;
    }

//Получить список дочерних элементов (категорий)
    public function listCategory($key_category) {
        $sql = "SELECT id, parent_id, title, img, url, desc_product FROM tb_catalog WHERE parent_id='$key_category'";
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }

//Функция принимает массив и два поля (id и text)
//Подготавливает данные для DropList
    static function FormatDropList($list, $id, $text) {
        $list = CHtml::listData($list, $id, $text);
        return $list;
    }

    static function MyFormatDropList($list) {
        foreach ($list as $value) {
            $res[$value['id']] = $value['id'] . '-' . $value['title'];
        }
        return $res;
    }

//Проверка на одинаковый url при добавлении каталога
//act - действие добавление или редактирование записи
    static public function chek($act, $url, $id = '') {
        if ($act) { //Форма добавлени
            $sql = "SELECT id,url  FROM tb_catalog WHERE url='$url'";
            $res = Yii::app()->db->createCommand($sql)->queryAll();
        } else {
            $sql = "SELECT id,url  FROM tb_catalog WHERE url='$url' AND id<>'$id'";
            $res = Yii::app()->db->createCommand($sql)->queryAll();
        }
        //Если нашли запись, то такой url имеется
        if (!empty($res)) {
            return TRUE; //запись есть
        } else {
            return FALSE;
        }
    }

}

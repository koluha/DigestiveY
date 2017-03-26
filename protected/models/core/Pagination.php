<?php

class Pagination {

    // Определяем общее число 
    //Параметр выбранная категория
    public function AllPage($key_category) {
        $sql = "SELECT 
                   COUNT(*)
                FROM tb_product as p
                    WHERE p.key_group_1 ='$key_category' OR p.key_group_2 ='$key_category' OR p.key_group_3 ='$key_category'";
        $count = Yii::app()->db->createCommand($sql)->queryScalar();
        return $count;
    }
    
     public function AllPageFilter($key_category,$url_filter, $name_filter,$popular_in=''){
         $popular=($popular_in)?'AND p.i_popular=1':'';
          $sql = "SELECT COUNT(*)
                    FROM tb_product as p
                        INNER JOIN tb_f_$name_filter AS f ON f.id=p.f_id_$name_filter
                        WHERE (p.key_group_1 ='$key_category' OR p.key_group_2 ='$key_category' OR p.key_group_3 ='$key_category') $popular AND f.url='$url_filter'";
        $count = Yii::app()->db->createCommand($sql)->queryScalar();
        return $count;
     }

    public function use_pagination($id, $url, $page) {
        $pag['page'] = $page;
        //общее кол-во записей продуктов
        $pag['posts'] = $this->AllPage($id);
        //кол-во записей на странице
        $pag['num'] = Yii::app()->params['pagination_limit'];
        // Находим общее число страниц  

        $pag['total'] = intval(($pag['posts'] - 1) / $pag['num']) + 1;

        // Если значение $page меньше единицы или отрицательно  
        // переходим на первую страницу  
        // А если слишком большое, то переходим на последнюю 
        
        if (empty($pag['page']) or $pag['page'] < 0)
            $pag['page'] = 1;
        if ($pag['page'] > $pag['total'])
            $pag['page'] = $pag['total'];
        $pag['start'] = $pag['page'] * $pag['num'] - $pag['num'];

        $pag['url'] = $url;

        return $pag;
    }
    
    public function use_paginationfilter($id, $url, $page, $url_filter,$name_filter, $popular='') {
        $pag['page'] = $page;
        //общее кол-во записей продуктов
        $pag['posts'] = $this->AllPageFilter($id,$url_filter,$name_filter,$popular);
        
        //кол-во записей на странице
        $pag['num'] = Yii::app()->params['pagination_limit'];
        // Находим общее число страниц  
        if($pag['num']==0){
            $pag['total']=0;
        }elseif ($pag['num']>0) {
              $pag['total'] = intval(($pag['posts'] - 1) / $pag['num']) + 1;
        }
      
        // Если значение $page меньше единицы или отрицательно  
        // переходим на первую страницу  
        // А если слишком большое, то переходим на последнюю 
        if (empty($pag['page']) or $pag['page'] < 0)
            $pag['page'] = 1;
        if ($pag['page'] > $pag['total'])
            $pag['page'] = $pag['total'];
        $pag['start'] = $pag['page'] * $pag['num'] - $pag['num'];

        $pag['url'] = $url;

        return $pag;
    }

}

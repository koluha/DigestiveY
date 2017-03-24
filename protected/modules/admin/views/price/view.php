<?php



$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $model->search(),
    'filter'=>$model,
    'columns' => array(
        array(
            'name' => 'id',
            'type' => 'raw',
            'value' => '$data->id',
            'header' => 'ИД',
            'visible' => FALSE,
        ),
        array(
            'name' => 'pid',
            'value' => 'Prices::namePrice($data->pid)',
            'header' => 'Прайс',
            'visible' => TRUE,
        ),
        array(
            'name' => 'article',
            'type' => 'raw',
            'value' => '$data->article',
            'header' => 'Артикул',
            'visible' => TRUE,
        ),
        array(
            'name' => 'group_1',
            'type' => 'raw',
            'value' => '$data->group_1',
            'header' => 'Группа_1',
            'visible' => TRUE,
        ),
          array(
            'name' => 'key_group_1',
            'type' => 'raw',
            'value' => '$data->key_group_1',
            'header' => 'key_group_1',
            'visible' => TRUE,
        ),
          array(
            'name' => 'group_2',
            'type' => 'raw',
            'value' => '$data->group_2',
            'header' => 'Группа_2',
            'visible' => TRUE,
        ),
          array(
            'name' => 'key_group_2',
            'type' => 'raw',
            'value' => '$data->key_group_2',
            'header' => 'key_group_2',
            'visible' => TRUE,
        ),
          array(
            'name' => 'group_3',
            'type' => 'raw',
            'value' => '$data->group_3',
            'header' => 'Группа_3',
            'visible' => TRUE,
        ),
          array(
            'name' => 'key_group_3',
            'type' => 'raw',
            'value' => '$data->key_group_3',
            'header' => 'key_group_3',
            'visible' => TRUE,
        ),
   
    
        array(
            'name' => 'f_brand',
            'type' => 'raw',
            'value' => '$data->f_brand',
            'header' => '1.Брэнд',
            'visible' => TRUE,
        ),
        array(
            'name' => 'f_country',
            'type' => 'raw',
            'value' => '$data->f_country',
            'header' => '2.Страна',
            'visible' => TRUE,
        ),
        array(
            'name' => 'f_region',
            'type' => 'raw',
            'value' => '$data->f_region',
            'header' => '3.Регион',
            'visible' => TRUE,
        ),
        array(
            'name' => 'f_type',
            'type' => 'raw',
            'value' => '$data->f_type',
            'header' => '4.Тип',
            'visible' => TRUE,
        ),
        array(
            'name' => 'f_class',
            'type' => 'raw',
            'value' => '$data->f_class',
            'header' => '5.Класс',
            'visible' => TRUE,
        ),
        array(
            'name' => 'f_alcohol',
            'type' => 'raw',
            'value' => '$data->f_alcohol',
            'header' => '6.Спирт',
            'visible' => TRUE,
        ),
        array(
            'name' => 'f_taste',
            'type' => 'raw',
            'value' => '$data->f_taste',
            'header' => '7.Вкус',
            'visible' => TRUE,
        ),
        array(
            'name' => 'f_sugar',
            'type' => 'raw',
            'value' => '$data->f_sugar',
            'header' => '8.Сахар',
            'visible' => TRUE,
        ),
         array(
            'name' => 'f_grape_sort',
            'type' => 'raw',
            'value' => '$data->f_grape_sort',
            'header' => '9.Сорт винограда',
            'visible' => TRUE,
        ),
              array(
            'name' => 'f_vintage_year',
            'type' => 'raw',
            'value' => '$data->f_vintage_year',
            'header' => '10.Год урожая',
            'visible' => TRUE,
        ),
        array(
            'name' => 'f_color',
            'type' => 'raw',
            'value' => '$data->f_color',
            'header' => '11.Цвет',
            'visible' => TRUE,
        ),
        array(
            'name' => 'f_excerpt',
            'type' => 'raw',
            'value' => '$data->f_excerpt',
            'header' => '12.Выдержка',
            'visible' => TRUE,
        ),
        array(
            'name' => 'f_fortress',
            'type' => 'raw',
            'value' => '$data->f_fortress',
            'header' => '13.Крепость',
            'visible' => TRUE,
        ),
        array(
            'name' => 'f_volume',
            'type' => 'raw',
            'value' => '$data->f_volume',
            'header' => '14.Объем',
            'visible' => TRUE,
        ),
        array(
            'name' => 'f_packaging',
            'type' => 'raw',
            'value' => '$data->f_packaging',
            'header' => '15.Упаковка',
            'visible' => TRUE,
        ),
        array(
            'name' => 'i_name_sku',
            'type' => 'raw',
            'value' => '$data->i_name_sku',
            'header' => 'Наименование SKU',
            'visible' => TRUE,
        ),
        array(
            'name' => 'i_availability',
            'type' => 'raw',
            'value' => '$data->i_availability',
            'header' => 'В наличий',
            'visible' => TRUE,
        ),
         array(
            'name' => 'i_popular',
            'type' => 'raw',
            'value' => '$data->i_popular',
            'header' => 'Популярное',
            'visible' => TRUE,
        ),
         array(
            'name' => 'i_limitedly',
            'type' => 'raw',
            'value' => '$data->i_limitedly',
            'header' => 'Ограничено',
            'visible' => TRUE,
        ),
        
       array(
            'name' => 'i_old_price',
            'type' => 'raw',
            'value' => '$data->i_old_price',
            'header' => 'Старая цена',
            'visible' => TRUE,
        ),
        array(
            'name' => 'i_price',
            'type' => 'raw',
            'value' => '$data->i_price',
            'header' => 'Цена',
            'visible' => TRUE,
        ),
        array(
            'name' => 'i_manufacturer_importer',
            'type' => 'raw',
            'value' => '$data->i_manufacturer_importer',
            'header' => 'Производитель/ Импортер',
            'visible' => TRUE,
        ),
        array(
            'name' => 'i_supplier',
            'type' => 'raw',
            'value' => '$data->i_supplier',
            'header' => 'Поставщик',
            'visible' => TRUE,
        ),
        array(
            'name' => 'd_desc_product',
            'type' => 'raw',
            'value' => '$data->d_desc_product',
            'header' => 'Описание',
            'htmlOptions'=>array('width'=>'200px'),
            'visible' => TRUE,
        ),
        array(
            'name' => 'd_photo_small',
            'type' => 'raw',
            'value' => '$data->d_photo_small',
            'header' => 'Фото Small',
            'visible' => TRUE,
        ),
        array(
            'name' => 'd_photo_middle',
            'type' => 'raw',
            'value' => '$data->d_photo_middle',
            'header' => 'Фото middle',
            'visible' => TRUE,
        ),
        array(
            'name' => 'd_photo_high',
            'type' => 'raw',
            'value' => '$data->d_photo_high',
            'header' => 'Фото Hide',
            'visible' => TRUE,
        ),
        array(
            'name' => 'd_link_manuf',
            'type' => 'raw',
            'value' => '$data->d_link_manuf',
            'header' => 'Ссылка на сайт',
            'visible' => TRUE,
        ),
        array(
            'name' => 'd_logo_manuf',
            'type' => 'raw',
            'value' => '$data->d_logo_manuf',
            'header' => 'Логотип производителя',
            'visible' => TRUE,
        ),
        array(
            'name' => 't_url',
            'type' => 'raw',
            'value' => '$data->t_url',
            'header' => 'URL (строка www)',
            'visible' => TRUE,
        ),
        array(
            'name' => 't_meta_title',
            'type' => 'raw',
            'value' => '$data->t_meta_title',
            'header' => 'Meta_title (Заголовок)',
            'visible' => TRUE,
        ),
        array(
            'name' => 't_meta_keyword',
            'type' => 'raw',
            'value' => '$data->t_meta_keyword',
            'header' => 'Meta_keyword (Ключевые слова)',
            'visible' => TRUE,
        ),
        array(
            'name' => 't_meta_description',
            'type' => 'raw',
            'value' => '$data->t_meta_description',
            'header' => 'Meta_description (Описание)',
            'htmlOptions'=>array('width'=>'100px'),
            'visible' => TRUE,
        ),
    ),
));

?>

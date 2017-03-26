<?php

class Product {
    //Данные продукта
    public function DescProduct($url){
    //нужно знать категорий    
    $sql = "SELECT 
                    p.id,
                    p.article,
                    p.key_group_1,
                    p.key_group_2,
                    p.key_group_3,
                    p.i_name_sku,
                    p.i_price,
                    p.i_old_price,
                    p.i_availability,
                    p.i_popular,
                    p.i_limitedly,
                    p.t_url,
                    p.d_photo_middle,
                    p.d_link_manuf,
                    p.d_logo_manuf,
                    p.d_link_manuf,
                    p.t_meta_title,
                    p.t_meta_keyword,
                    p.t_meta_description,
                    p.d_desc_product,
                    brand.title as f_brand,
                    country.title as f_country,
                    region.title as f_region,
                    type.title as f_type,
                    class.title as f_class,
                    alcohol.title as f_alcohol,
                    taste.title as f_taste,
                    sugar.title as f_sugar,
                    grape_sort.title as f_grape_sort,
                    vintage_year.title as f_vintage_year,
                    color.title as f_color,
                    excerpt.title as f_excerpt,
                    fortress.title as f_fortress,
                    volume.title as f_volume,
                    packaging.title as f_packaging,
                    p.i_manufacturer_importer,
                    p. i_supplier
                FROM tb_product as p 
		    LEFT JOIN tb_f_brand AS brand ON brand.id=p.f_id_brand
		    LEFT JOIN tb_f_country AS country ON country.id=p.f_id_country
                    LEFT JOIN tb_f_region AS region ON region.id=p.f_id_region
                    LEFT JOIN tb_f_type AS type ON type.id=p.f_id_type
                    LEFT JOIN tb_f_class AS class ON class.id=p.f_id_class
                    LEFT JOIN tb_f_alcohol AS alcohol ON alcohol.id=p.f_id_alcohol
                    LEFT JOIN tb_f_taste AS taste ON taste.id=p.f_id_taste
                    LEFT JOIN tb_f_sugar AS sugar ON sugar.id=p.f_id_sugar
                    LEFT JOIN tb_f_grape_sort AS grape_sort ON grape_sort.id=p.f_id_grape_sort
		    LEFT JOIN tb_f_vintage_year AS vintage_year ON vintage_year.id=p.f_id_vintage_year
		    LEFT JOIN tb_f_color AS color ON color.id=p.f_id_color
		    LEFT JOIN tb_f_excerpt AS excerpt ON excerpt.id=p.f_id_excerpt
		    LEFT JOIN tb_f_fortress AS fortress ON fortress.id=p.f_id_fortress
                    LEFT JOIN tb_f_volume AS volume ON volume.id=p.f_id_volume
                    LEFT JOIN tb_f_packaging AS packaging ON packaging.id=p.f_id_packaging
                WHERE p.t_url='$url'";
        $res = Yii::app()->db->createCommand($sql)->queryRow();
        return $res;
    }
    
    
    
    //Характеристика продукта
    public function SpecProduct($url){
    $sql = "SELECT 
            psv.name as name_spec,
                CASE
                    WHEN (sv.val_text!='')  THEN  sv.val_text
                    WHEN sv.val_int         THEN  sv.val_int
                    WHEN sv.val_float       THEN  sv.val_float
                END as val_spec
           FROM
                tb_product as p
            INNER JOIN tb_link as l  ON p.id = l.key_product
            INNER JOIN tb_spec_value as sv  ON sv.id = l.key_spec_value
            INNER JOIN tb_product_spec as psv  ON psv.id = sv.key_prod_spec
                WHERE
            p.url='$url'";
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }
}


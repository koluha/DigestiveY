<?php

/**
 * This is the model class for table "{{product}}".
 *
 * The followings are the available columns in table '{{product}}':
 * @property integer $id
 * @property integer $pid
 * @property string $article
 * @property string $group_1
 * @property integer $key_group_1
 * @property string $group_2
 * @property integer $key_group_2
 * @property string $group_3
 * @property integer $key_group_3
 * @property string $f_brand
 * @property integer $f_id_brand
 * @property string $f_country
 * @property integer $f_id_country
 * @property string $f_region
 * @property integer $f_id_region
 * @property string $f_type
 * @property integer $f_id_type
 * @property string $f_class
 * @property integer $f_id_class
 * @property string $f_alcohol
 * @property integer $f_id_alcohol
 * @property string $f_taste
 * @property integer $f_id_taste
 * @property string $f_sugar
 * @property integer $f_id_sugar
 * @property string $f_grape_sort
 * @property integer $f_id_grape_sort
 * @property string $f_vintage_year
 * @property integer $f_id_vintage_year
 * @property string $f_color
 * @property integer $f_id_color
 * @property string $f_excerpt
 * @property integer $f_id_excerpt
 * @property integer $f_fortress
 * @property integer $f_id_fortress
 * @property string $f_volume
 * @property integer $f_id_volume
 * @property string $f_packaging
 * @property integer $f_id_packaging
 * @property string $i_name_sku
 * @property integer $i_availability
 * @property integer $i_popular
 * @property integer $i_limitedly
 * @property string $i_old_price
 * @property string $i_price
 * @property string $i_manufacturer_importer
 * @property string $i_supplier
 * @property string $d_desc_product
 * @property string $d_photo_small
 * @property string $d_photo_middle
 * @property string $d_photo_high
 * @property string $d_link_manuf
 * @property string $d_logo_manuf
 * @property string $t_url
 * @property string $t_meta_title
 * @property string $t_meta_keyword
 * @property string $t_meta_description
 */
class Product extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{product}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pid, article, group_1, key_group_1, group_2, key_group_2, group_3, key_group_3, f_brand, f_id_brand, f_country, f_id_country, f_region, f_id_region, f_type, f_id_type, f_class, f_id_class, f_alcohol, f_id_alcohol, f_taste, f_id_taste, f_sugar, f_id_sugar, f_grape_sort, f_id_grape_sort, f_vintage_year, f_id_vintage_year, f_color, f_id_color, f_excerpt, f_id_excerpt, f_fortress, f_id_fortress, f_volume, f_id_volume, f_packaging, f_id_packaging, i_name_sku, i_availability, i_popular, i_limitedly, i_old_price, i_price, i_manufacturer_importer, i_supplier, d_desc_product, d_photo_small, d_photo_middle, d_photo_high, d_link_manuf, d_logo_manuf, t_url, t_meta_title, t_meta_keyword, t_meta_description', 'required'),
			array('pid, key_group_1, key_group_2, key_group_3, f_id_brand, f_id_country, f_id_region, f_id_type, f_id_class, f_id_alcohol, f_id_taste, f_id_sugar, f_id_grape_sort, f_id_vintage_year, f_id_color, f_id_excerpt, f_fortress, f_id_fortress, f_id_volume, f_id_packaging, i_availability, i_popular, i_limitedly', 'numerical', 'integerOnly'=>true),
			array('article, group_1', 'length', 'max'=>250),
			array('group_2, group_3, f_brand, f_country, f_region, f_type, f_class, f_alcohol, f_taste, f_sugar, f_grape_sort, f_color, f_excerpt, f_packaging, i_name_sku, i_manufacturer_importer, i_supplier, d_photo_small, d_photo_middle, d_photo_high, d_link_manuf, d_logo_manuf, t_url, t_meta_title, t_meta_keyword, t_meta_description', 'length', 'max'=>255),
			array('f_vintage_year', 'length', 'max'=>11),
			array('f_volume, i_old_price, i_price', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pid, article, group_1, key_group_1, group_2, key_group_2, group_3, key_group_3, f_brand, f_id_brand, f_country, f_id_country, f_region, f_id_region, f_type, f_id_type, f_class, f_id_class, f_alcohol, f_id_alcohol, f_taste, f_id_taste, f_sugar, f_id_sugar, f_grape_sort, f_id_grape_sort, f_vintage_year, f_id_vintage_year, f_color, f_id_color, f_excerpt, f_id_excerpt, f_fortress, f_id_fortress, f_volume, f_id_volume, f_packaging, f_id_packaging, i_name_sku, i_availability, i_popular, i_limitedly, i_old_price, i_price, i_manufacturer_importer, i_supplier, d_desc_product, d_photo_small, d_photo_middle, d_photo_high, d_link_manuf, d_logo_manuf, t_url, t_meta_title, t_meta_keyword, t_meta_description', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pid' => 'Pid',
			'article' => 'Article',
			'group_1' => 'Group 1',
			'key_group_1' => 'Key Group 1',
			'group_2' => 'Group 2',
			'key_group_2' => 'Key Group 2',
			'group_3' => 'Group 3',
			'key_group_3' => 'Key Group 3',
			'f_brand' => 'F Brand',
			'f_id_brand' => 'F Id Brand',
			'f_country' => 'F Country',
			'f_id_country' => 'F Id Country',
			'f_region' => 'F Region',
			'f_id_region' => 'F Id Region',
			'f_type' => 'F Type',
			'f_id_type' => 'F Id Type',
			'f_class' => 'F Class',
			'f_id_class' => 'F Id Class',
			'f_alcohol' => 'F Alcohol',
			'f_id_alcohol' => 'F Id Alcohol',
			'f_taste' => 'F Taste',
			'f_id_taste' => 'F Id Taste',
			'f_sugar' => 'F Sugar',
			'f_id_sugar' => 'F Id Sugar',
			'f_grape_sort' => 'F Grape Sort',
			'f_id_grape_sort' => 'F Id Grape Sort',
			'f_vintage_year' => 'F Vintage Year',
			'f_id_vintage_year' => 'F Id Vintage Year',
			'f_color' => 'F Color',
			'f_id_color' => 'F Id Color',
			'f_excerpt' => 'F Excerpt',
			'f_id_excerpt' => 'F Id Excerpt',
			'f_fortress' => 'F Fortress',
			'f_id_fortress' => 'F Id Fortress',
			'f_volume' => 'F Volume',
			'f_id_volume' => 'F Id Volume',
			'f_packaging' => 'F Packaging',
			'f_id_packaging' => 'F Id Packaging',
			'i_name_sku' => 'I Name Sku',
			'i_availability' => 'I Availability',
			'i_popular' => 'I Popular',
			'i_limitedly' => 'I Limitedly',
			'i_old_price' => 'I Old Price',
			'i_price' => 'I Price',
			'i_manufacturer_importer' => 'I Manufacturer Importer',
			'i_supplier' => 'I Supplier',
			'd_desc_product' => 'D Desc Product',
			'd_photo_small' => 'D Photo Small',
			'd_photo_middle' => 'D Photo Middle',
			'd_photo_high' => 'D Photo High',
			'd_link_manuf' => 'D Link Manuf',
			'd_logo_manuf' => 'D Logo Manuf',
			't_url' => 'T Url',
			't_meta_title' => 'T Meta Title',
			't_meta_keyword' => 'T Meta Keyword',
			't_meta_description' => 'T Meta Description',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('pid',$this->pid);
		$criteria->compare('article',$this->article,true);
		$criteria->compare('group_1',$this->group_1,true);
		$criteria->compare('key_group_1',$this->key_group_1);
		$criteria->compare('group_2',$this->group_2,true);
		$criteria->compare('key_group_2',$this->key_group_2);
		$criteria->compare('group_3',$this->group_3,true);
		$criteria->compare('key_group_3',$this->key_group_3);
		$criteria->compare('f_brand',$this->f_brand,true);
		$criteria->compare('f_id_brand',$this->f_id_brand);
		$criteria->compare('f_country',$this->f_country,true);
		$criteria->compare('f_id_country',$this->f_id_country);
		$criteria->compare('f_region',$this->f_region,true);
		$criteria->compare('f_id_region',$this->f_id_region);
		$criteria->compare('f_type',$this->f_type,true);
		$criteria->compare('f_id_type',$this->f_id_type);
		$criteria->compare('f_class',$this->f_class,true);
		$criteria->compare('f_id_class',$this->f_id_class);
		$criteria->compare('f_alcohol',$this->f_alcohol,true);
		$criteria->compare('f_id_alcohol',$this->f_id_alcohol);
		$criteria->compare('f_taste',$this->f_taste,true);
		$criteria->compare('f_id_taste',$this->f_id_taste);
		$criteria->compare('f_sugar',$this->f_sugar,true);
		$criteria->compare('f_id_sugar',$this->f_id_sugar);
		$criteria->compare('f_grape_sort',$this->f_grape_sort,true);
		$criteria->compare('f_id_grape_sort',$this->f_id_grape_sort);
		$criteria->compare('f_vintage_year',$this->f_vintage_year,true);
		$criteria->compare('f_id_vintage_year',$this->f_id_vintage_year);
		$criteria->compare('f_color',$this->f_color,true);
		$criteria->compare('f_id_color',$this->f_id_color);
		$criteria->compare('f_excerpt',$this->f_excerpt,true);
		$criteria->compare('f_id_excerpt',$this->f_id_excerpt);
		$criteria->compare('f_fortress',$this->f_fortress);
		$criteria->compare('f_id_fortress',$this->f_id_fortress);
		$criteria->compare('f_volume',$this->f_volume,true);
		$criteria->compare('f_id_volume',$this->f_id_volume);
		$criteria->compare('f_packaging',$this->f_packaging,true);
		$criteria->compare('f_id_packaging',$this->f_id_packaging);
		$criteria->compare('i_name_sku',$this->i_name_sku,true);
		$criteria->compare('i_availability',$this->i_availability);
		$criteria->compare('i_popular',$this->i_popular);
		$criteria->compare('i_limitedly',$this->i_limitedly);
		$criteria->compare('i_old_price',$this->i_old_price,true);
		$criteria->compare('i_price',$this->i_price,true);
		$criteria->compare('i_manufacturer_importer',$this->i_manufacturer_importer,true);
		$criteria->compare('i_supplier',$this->i_supplier,true);
		$criteria->compare('d_desc_product',$this->d_desc_product,true);
		$criteria->compare('d_photo_small',$this->d_photo_small,true);
		$criteria->compare('d_photo_middle',$this->d_photo_middle,true);
		$criteria->compare('d_photo_high',$this->d_photo_high,true);
		$criteria->compare('d_link_manuf',$this->d_link_manuf,true);
		$criteria->compare('d_logo_manuf',$this->d_logo_manuf,true);
		$criteria->compare('t_url',$this->t_url,true);
		$criteria->compare('t_meta_title',$this->t_meta_title,true);
		$criteria->compare('t_meta_keyword',$this->t_meta_keyword,true);
		$criteria->compare('t_meta_description',$this->t_meta_description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

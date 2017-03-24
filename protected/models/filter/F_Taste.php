<?php

class F_taste extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{f_taste}}';
    }

    public function rules() {
        return array(
            array('url, title', 'required'),
            array('sort', 'numerical'),
            array('url', 'length', 'max' => 255),
            array('url', 'check'), //Валидатор если в тб user уже есть такое имя пользователя
            array('id, url, title, sort', 'safe', 'on' => 'search'),
        );
    }

    public function check($attribute, $params) {
        if (!$this->hasErrors()) {
            if ($this->id) { //Получен id форма редактирования
                $url = self::model()->find('url=:purl and id<>:pid', array(
                    ':purl' => $this->url,
                    ':pid' => $this->id));
            } else { //Не получен id форма добавления
                $url = self::model()->find('url=:purl', array(
                    ':purl' => $this->url));
            }
            if (!empty($url)) {
                $this->addError('url', 'url с таким наименованием уже существует.');
            }
        }
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'url' => 'URL',
            'title' => 'Название',
            'sort' => 'Сортировка',
        );
    }

    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('title', $this->title);
        $criteria->compare('sort', $this->sort);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 200,
        )));
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}

<h1>Фильтры каталога</h1>
<?php
$this->widget('zii.widgets.jui.CJuiTabs', array(
    'tabs' => array(
        'Бренд' => array('id' => 'brand-id', 'content' => $this->renderPartial(
                    'application.modules.admin.views.f_brand.admin', '', TRUE
            )),
        'Страна' => array('id' => 'country-id', 'content' => $this->renderPartial(
                    'application.modules.admin.views.f_country.admin', '', TRUE
            )),
        'Регион' => array('id' => 'region-id', 'content' => $this->renderPartial(
                    'application.modules.admin.views.f_region.admin', '', TRUE
            )),
        'Тип' => array('id' => 'type-id', 'content' => $this->renderPartial(
                    'application.modules.admin.views.f_type.admin', '', TRUE
            )),
        'Класс' => array('id' => 'class-id', 'content' => $this->renderPartial(
                    'application.modules.admin.views.f_class.admin', '', TRUE
            )),
        'Спирт' => array('id' => 'alcohol-id', 'content' => $this->renderPartial(
                    'application.modules.admin.views.f_alcohol.admin', '', TRUE
            )),
        'Вкус' => array('id' => 'taste-id', 'content' => $this->renderPartial(
                    'application.modules.admin.views.f_taste.admin', '', TRUE
            )),
        'Сахар' => array('id' => 'sugar-id', 'content' => $this->renderPartial(
                    'application.modules.admin.views.f_sugar.admin', '', TRUE
            )),
        'Сорт винограда' => array('id' => 'grape_sort-id', 'content' => $this->renderPartial(
                    'application.modules.admin.views.f_grapesort.admin', '', TRUE
            )),
        'Год урожая' => array('id' => 'vintage_year-id', 'content' => $this->renderPartial(
                    'application.modules.admin.views.f_vintageyear.admin', '', TRUE
            )),
        'Цвет' => array('id' => 'color-id', 'content' => $this->renderPartial(
                    'application.modules.admin.views.f_color.admin', '', TRUE
            )),
        'Выдержка' => array('id' => 'excerpt-id', 'content' => $this->renderPartial(
                    'application.modules.admin.views.f_excerpt.admin', '', TRUE
            )),
        'Крепость %' => array('id' => 'fortress-id', 'content' => $this->renderPartial(
                    'application.modules.admin.views.f_fortress.admin', '', TRUE
            )),
        'Объем' => array('id' => 'volume-id', 'content' => $this->renderPartial(
                    'application.modules.admin.views.f_volume.admin', '', TRUE
            )),
        'Упаковка' => array('id' => 'packaging-id', 'content' => $this->renderPartial(
                    'application.modules.admin.views.f_packaging.admin', '', TRUE
            )),
    ),
    // additional javascript options for the tabs plugin
    'options' => array(
        'collapsible' => true
      
    ),
));

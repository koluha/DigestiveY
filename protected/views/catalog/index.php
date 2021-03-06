<script>

    function submitFilter(data_name_filter) {
    var timeout;

    //console.log(data_name_filter);

    Checkes = $("input[name='param_filter[]']");

    //Получить выбранную категорию из url
    var url_category = '<?php echo Yii::app()->getRequest()->getPathInfo() ?>'
    var data = new Array();  //Массив data
    i = 0;
    Checkes.each(function() {  //найти все checked
        if ($(this).is(':checked')) {
            var attr_value = $(this).val();
            var attr_name_filter = $(this).attr('data-name-filter');
            data[i] = attr_name_filter + '&' + attr_value; //запись в массив (имя фильтра - значение)
            i++;

        }
    });
    //console.log(JSON.stringify(data));
    //!!Нужно знать id категорию 
    //Имитация загрузки css 
    $(".prod_block_filtr").fadeOut()
    var startTime = new Date().getTime(); // засекаем время начала запроса
    $.ajax({
    type: 'POST',
            url: "<?php echo Yii::app()->createUrl('Catalog/FilterAjax') ?>",
            data: {data_filrets: data, url_category: url_category , data_name_filter_in: data_name_filter },
            success: function(d) {
                var data1 = jQuery.parseJSON(d);

                //  console.log(data1.test);
                var requestDuration = new Date().getTime() - startTime; // вычисляем продолжительность запроса
                if (requestDuration < 500) { // если выполнился меньше чем за секунду
                    clearTimeout(timeout);
                    timeout = setTimeout(function() { // устанавливаем таймер
                        $('.prod_block_filtr').empty().append(data1.product);
                        $(".prod_block_filtr").fadeIn();
                        $('.page-numbers').empty();
                        $('.filter_ul').empty().append(data1.filter);
                    }, 300 - requestDuration); // на время оставшиеся до секунды
                } else {
                    $('.prod_block_filtr').empty().append(data1.product);
                    $(".prod_block_filtr").fadeIn();
                    $('.page-numbers').empty();
                    $('.filter_ul').empty().append(data1.filter);
                }
            }
    });
    }
    ;

    $(document).ready(function() {


        $('body').on('change', ".filter_options input[name='param_filter[]']", function() {
            //Выбранное data-name-filter фильтра не менять класс выше  
            var data_name_filter = $(this).attr('data-name-filter');
            submitFilter(data_name_filter);
        });



        $('.button_b').click(function() {
            var id_pr = $(this).attr('data-idproduct');
            // console.log(id_pr);
            $.get("<?php echo Yii::app()->createUrl('basket/addcart') ?>", {product_id: id_pr});

            //Чтобы в корзину успел добавить товар
            setTimeout(function() {
                document.location.href = '<?php echo Yii::app()->createUrl('basket/showcart') ?>'
            }, 500);

        });


        window.onload = function() {
            document.getElementById('button_filter').onclick = function() {
                openbox('filter_block', this, 'right_block');
                return false;
            };



        };
        /* Функция открывает блок фильтра и меняет класс у блока товара*/

        function openbox(id, toggler, right_block) {


            var div = document.getElementById(id);
            var div_right = document.getElementById(right_block);

            if (div.style.display == 'block') {
                div.style.display = 'none';
                toggler.innerHTML = '<i class="fa fa-tasks fa-lg" aria-hidden="true"></i>&nbsp; показать фильтр';
                div_right.className = 'prod_block';

            }
            else {
                div.style.display = 'block';
                toggler.innerHTML = '<i class="fa fa-tasks fa-lg" aria-hidden="true"></i>&nbsp; закрыть фильтр';
                div_right.className = 'prod_block_filtr';
            }
        }




        //$("input[name='param_filter[]']").change(function() {
        //    submitFilter();
        //});

        /*чек боксы*/
        /*Отловим событие изменения чек бокса */






        /*работа сортировки, если уже выбрана страница дальше первой то скидываем снова на первую*/
        $("#select_order").on('change', function() {
            var page = jQuery.query.get('page');
            if (page == '') {
                window.location.search = jQuery.query.set('order', $(this).val());
            } else if (page == 1) {
                window.location.search = jQuery.query.set('order', $(this).val());
            } else if (page > 1) {
                window.location.search = jQuery.query.set('order', $(this).val()).set('page', 1);
            }


        });
    });


</script>
<?php
if ($data['categories']) {
    $this->renderPartial('_categories', array('data' => $data));
    $this->renderPartial('_inline');
}
?>

<div class="filter_line">
    <div class="row">
        <div class="col-xs-4">
            <button id="button_filter" class="button left"><i class="fa fa-tasks fa-lg" aria-hidden="true"></i>&nbsp; показать фильтр</button>
        </div>
        <div class="col-xs-4">
            <span><!--Цена от - до: (в разработке)--></span>
        </div>
        <div class="col-xs-4">
            <button class="button right button_sh">отобразить</button>
        </div>
    </div>
</div>

<div class="filter_line_view">
    <div class="row">
        <div class="col-xs-6">
            <div class="view_sort">

                <span>Сортировать по:</span> 
                <form id='select_form' action="" method="GET">
                    <?php
                    echo CHtml::dropDownList('select_order', Yii::app()->session['select_order'], array('i_old_price-desc' => 'Акции, скидка',
                        'i_limitedly-desc' => 'Ограниченное количество',
                        'i_popular-desc' => 'Популярное',
                        'i_price-asc' => 'Возврастание Цены',
                        'i_price-desc' => 'Убывание Цены'
                    ));
                    ?>
                </form>

            </div>
        </div>
        <div class="col-xs-6">
            <div class="show_view">
                <span>Вид просмотра:</span>  <a href="#"><i class="fa fa-th fa-lg" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-bars fa-lg" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
</div>
<div class="prod_items clearfix">
    <div id="filter_block" class="filtr_block">
        <div class="h_filtr">Параметры фильтра</div>

        <ul class="filter_ul">
            <?php
            //В сессию записать ид категорий, и получить данные фильтра этой категорий
            $obq_filter = new ModelCatalog();
            $filters = $obq_filter->listFilters(Yii::app()->session['filter_side'], '');


            //Получаем Массив всех фильтров
            $array_filters = $obq_filter->list_filter();

            $view_filter = $obq_filter->ViewFilter($filters, $array_filters);
            echo $view_filter;


            /*  foreach ($array_filters as $key => $value) {

              if (isset($filters[$key])) {
              echo '<li>
              <button  class="filtr_ul_button">
              <span><i class="fa fa-caret-down" aria-hidden="true"></i>&nbsp;&nbsp;' . $value . '</span>
              </button>
              <ul class="filter_options">';

              foreach ($filters[$key] as $filtr) {
              echo '<li>
              <label>
              <input type="checkbox" data-name-filter="' . $key . '" name="param_filter[]" value="' . $filtr['filter_url'] . '">
              <span class="name"> <font>' . $filtr['filter_title'] . '</font><font class="fil_label">&nbsp;(' . $filtr['count'] . ')</font></span>
              </label>
              </li>';
              }

              echo '</ul></li>';
              }
              } */
            ?>




            <!-- <ul class="filter_ul">
                      <li>
                          <button  class="filtr_ul_button">
                              <span><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;&nbsp;Брэнд</span>
                          </button>
                          <ul class="filter_options">
                              <li>
                                  <label>
                                      <input type="checkbox" name="filter_parameters[]" value="Parametre|7|Drevený box">
                                      <span class="name"><font><font class="">Клод Шателье</font></font></span>
                                  </label>
                              </li>
                              <li>
                                  <label>
                                      <input type="checkbox" name="filter_parameters[]" value="Parametre|7|Plech">
                                      <span class="name"><font><font>Конт Джозеф</font></font></span>
                                  </label>
                              </li>
                          </ul>
                      </li>
                      <li>
                          <button class="filtr_ul_button">
                              <span><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;&nbsp;Страна</span>
                          </button>
                          <ul class="filter_options">
                              <li>
                                  <label>
                                      <input type="checkbox" name="filter_parameters[]" value="Parametre|7|Drevený box">
                                      <span class="name"><font><font class="">Франция</font></font></span>
                                  </label>
                              </li>
                              <li>
                                  <label>
                                      <input type="checkbox" name="filter_parameters[]" value="Parametre|7|Plech">
                                      <span class="name"><font><font>Россия</font></font></span>
                                  </label>
                              </li>
                          </ul>
                      </li>
                  </ul>
            -->


            <?php
//Формируем массив для вывода
//    foreach ($filters as $key => $filtr) {
//        $endfilters[$filtr['name_spec']][] = array('val_id' => $filtr['id_spec'],
//             'val_spec' => $filtr['val_spec']);
//      }
//print_r($endfilters);
            /*
              if (!empty($data['products'])) {
              foreach ($endfilters as $key => $filters) {
              $text = '<li>';
              $text.='<button class="filtr_ul_button">';
              $text.='<span><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;&nbsp; ' . $key . '</span>';
              $text.='</button>';

              $text.='<ul class="filter_options">';
              foreach ($filters as $value) {
              $text.='<li>';
              $text.='<label>';
              $text.='<input type="checkbox" name="filter_parameters[]" value=' . $value['val_id'] . '>';
              $text.='<span class="name"><font><font class="">' . $value['val_spec'] . '</font></font></span>';
              $text.='</label>';
              $text.='</li>';
              }
              $text.='</ul>';
              echo $text;
              }
              }
             */
            ?>

            <!--<li>
                <button class="filtr_ul_button">
                    <span><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;&nbsp; Страна_N</span>
                </button>
                <ul class="filter_options">
                    <li>
                        <label>
                            <input type="checkbox" name="filter_parameters[]" value="Parametre|7|Drevený box">
                            <span class="name"><font><font class="">Франция</font></font></span>
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="checkbox" name="filter_parameters[]" value="Parametre|7|Plech">
                            <span class="name"><font><font>Россия</font></font></span>
                        </label>
                    </li>
                </ul>
            </li>
            <li>
                <button class="filtr_ul_button">
                    <span><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;&nbsp; Возраст_N</span>
                </button>
                <ul class="filter_options">
                    <li>
                        <label>
                            <input type="checkbox" name="filter_parameters[]" value="Parametre|7|Drevený box">
                            <span class="name"><font><font class="">10 лет.</font></font></span>
                        </label>
                    </li>
                </ul>
            </li>


        </ul>
            -->
    </div>
    <div id="cat_loader"></div>
    <div id="right_block" class="prod_block">


        <?php
        $this->renderPartial('_product', array('products' => $data['products']));
        ?>

    </div>
</div>

<?php
if (!empty($data['products'])) {
    $this->renderPartial('_pagination', array('pag' => $pagin));
    $this->renderPartial('_desccategory', array('data' => $data['desc']));
}
?>



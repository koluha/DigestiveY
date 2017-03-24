<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= Yii::app()->params['meta_title'] ?></title>
        <?= CHtml::metaTag(Yii::app()->params['meta_keywords'], 'keywords') ?>
        <?= CHtml::metaTag(Yii::app()->params['meta_description'], 'description') ?>
        <meta name = "viewport" content = "width = 1200">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" /> <!-- Для создание адаптивного дизайна -->
        <link rel="shortcut icon" href="favicon.png" />
        <link rel="icon" href="/img/favicon.ico" type="image/x-icon"/>
        <?php
        $css = Yii::app()->clientScript;
        $css->registerCssFile(CHtml::asset(Yii::app()->basePath . '/../css/form.css', true));
        $css->registerCssFile(CHtml::asset(Yii::app()->basePath . '/../static/libs/bootstrap/bootstrap-grid-3.3.1.min.css', true));
        $css->registerCssFile(CHtml::asset(Yii::app()->basePath . '/../static/libs/font-awesome-4.6.1/css/font-awesome.min.css', true));
        $css->registerCssFile(CHtml::asset(Yii::app()->basePath . '/../static/css/main.css', true));

        $css->registerScriptFile(CHtml::asset(Yii::app()->basePath . '/../static/js/command.js', true), CClientScript::POS_HEAD);
        $css->registerScriptFile(CHtml::asset(Yii::app()->basePath . '/../static/js/inuser.js', true), CClientScript::POS_HEAD);
        $css->registerScriptFile(CHtml::asset(Yii::app()->basePath . '/../static/js/jquery.query-object.js', true), CClientScript::POS_HEAD);
        $css->registerScriptFile(CHtml::asset(Yii::app()->basePath . '/../static/libs/jquery-cookie-master/src/jquery.cookie.js', true));
        $css->registerPackage('jquery');
        $css->registerPackage('jquery.ui');
        ?>
        <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon"> 
    </head>
    <body>
        <!--
        <div id="block_confirmation">
            <span>18+</span>
            <p>Добро пожаловать на сайт сети винных магазинов Thedigestive. Для доступа необходимо подтвердить совершеннолетний возраст.</p>
            <button class="bt_18">Мне исполнилось 18 лет</button>
        </div>
        -->
        <div class="wrapper">


            <div class="sticky-content_all">
                <div class="container">
                     <div class="header_logo"><a href="/"><img src="/img/logo_digestive.png"></a></div>
                </div>
                <div class="right_head_top">
                    <div class="header_basket menu_g">
                        <ul>
                            <li><a href="<?php echo Yii::app()->createUrl('basket/showcart'); ?>">
                                    <?php
                                    $quantity = Yii::app()->request->cookies['quantity']->value;
                                    $quantity ? $quantity : 0;

                                    $cartsumma = Yii::app()->request->cookies['cartsumma']->value;
                                    $cartsumma ? $cartsumma : 0;
                                    ?>
                                    <span class="cart_money"><?php echo $cartsumma ?>&nbsp;Руб.</span>
                                    <i class="fa fa-shopping-cart fa-3x"></i>
                                    <span class="cart_quantity"><?php echo $quantity ?> шт.</span>
                                </a></li>
                        </ul>
                    </div>
                    <div class="header_links menu_g">
                        <ul>
                            <li><a href="<?php echo Yii::app()->createUrl('site/contact'); ?>"><i class="fa fa-envelope-o fa"></i><br>контакт</a></li>
                            <!--
                            array('label' => 'Вход', 'url' => 'user/login', 'visible' => Yii::app()->user->isGuest),
                            array('label' => 'Выход', 'url' => 'user/logout', 'visible' => !Yii::app()->user->isGuest), 
                            -->
                            <?php
                            if (Yii::app()->user->isGuest) {
                                $url = Yii::app()->createUrl("user/login");
                                echo '<li><a href=' . $url . '><i class="fa fa-user" aria-hidden="true"></i><br>войти</a></li>';
                            } elseif (!Yii::app()->user->isGuest) {
                                $url = Yii::app()->createUrl("user/logout");
                                echo '<li><a href=' . $url . '><i class="fa fa-user" aria-hidden="true"></i><br>выход</a></li>';
                            }
                            ?>
                            <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i><br>поиск</a></li>
                        </ul>
                    </div>
                    <div class="header_menu menu_g">

                        <?php
                        $this->widget('application.widgets.MainMenu', array(
                            'items' => ModelCatalog::ListGroup()
                        ));
                        ?>
                        <!--
                        <ul>
                            <li>
                                <a href="#">коньяк<i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                <ul>
                                    <p>В разработке</p>
                                    <li>
                                        <a href="#">Подменю 1</a>
                                    </li>
                                    <li>
                                        <a href="#">Подменю 2</a>
                                    </li>
                                    <li>
                                        <a href="#">Подменю 3</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="#">ликеры <i class="fa fa-caret-down" aria-hidden="true"></i></a></li>
                            <li><a href="#">ром <i class="fa fa-caret-down" aria-hidden="true"></i></a></li>
                            <li><a href="#">вино <i class="fa fa-caret-down" aria-hidden="true"></i></a></li>
                            <li><a href="#">виски <i class="fa fa-caret-down" aria-hidden="true"></i></a></li>
                            <li><a href="#">более <i class="fa fa-caret-down" aria-hidden="true"></i></a></li>
                        </ul>
                        -->
                    </div>
                </div>
            </div>

            <div class="context">
                <div class="crumbs_block">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <?php
//$br=$this->breadcrumbs[0]; 
// echo '<pre>';
//print_r(Breadcrumbs::GetBreadSessian());

                                $br = Breadcrumbs::GetBreadSessian();

                                $this->widget('application.widgets.MyBreadcrumbs', array(
                                    'items' => $br
                                ));
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <?php echo $content; ?>
                </div>
                <div class="footer">
                    <div class="inline">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="in_link">
                                        <a href="#">
                                            <div class="inl_icon"><i class="fa fa-users fa-3x" aria-hidden="true"></i></div>
                                            <div class="inl_title">самый большой выбор</div>
                                            <div class="inl_text">2000 наименовании от 640 брендов</div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="in_link">
                                        <a href="#">
                                            <div class="inl_icon"><i class="fa fa-truck fa-3x" aria-hidden="true"></i></div>
                                            <div class="inl_title">доставка</div>
                                            <div class="inl_text">от 300 руб. или выгоднее в зависимости от мероприятии</div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="in_link">
                                        <a href="#">
                                            <div class="inl_icon"><i class="fa fa-refresh fa-3x" aria-hidden="true"></i></div>
                                            <div class="inl_title">безопасная упаковка</div>
                                            <div class="inl_text">картонная защита, неброская упаковка Страхование условно</div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="in_link">
                                        <a href="#">
                                            <div class="inl_icon"><i class="fa fa-pencil-square-o fa-3x" aria-hidden="true"></i></div>
                                            <div class="inl_title">Удовледворение потребностей клиентов</div>
                                            <div class="inl_text">Виски Дом избран сайта Премиум Fiat-net</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="line_footer">
                        <div class="container ">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="fl_logo">thedigestive.ru</div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="fl_contact">
                                        <ul class="fl_contact_list">
                                            <li><span>Телефон:</span><a href="">8499 555 44 55</a></li>
                                            <li><span>Email:</span><a href="">dodyf@mail.ru</a></li>
                                            <li>
                                                <!-- Yandex.Metrika informer -->
                                                <a href="https://metrika.yandex.ru/stat/?id=42304124&amp;from=informer"
                                                   target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/42304124/3_0_FFFFFFFF_FFFFFFFF_0_pageviews"
                                                                                    style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" class="ym-advanced-informer" data-cid="42304124" data-lang="ru" /></a>
                                                <!-- /Yandex.Metrika informer -->

                                                <!-- Yandex.Metrika counter -->
                                                <script type="text/javascript">
                                                    (function (d, w, c) {
                                                        (w[c] = w[c] || []).push(function () {
                                                            try {
                                                                w.yaCounter42304124 = new Ya.Metrika({
                                                                    id: 42304124,
                                                                    clickmap: true,
                                                                    trackLinks: true,
                                                                    accurateTrackBounce: true,
                                                                    webvisor: true
                                                                });
                                                            } catch (e) {
                                                            }
                                                        });

                                                        var n = d.getElementsByTagName("script")[0],
                                                                s = d.createElement("script"),
                                                                f = function () {
                                                                    n.parentNode.insertBefore(s, n);
                                                                };
                                                        s.type = "text/javascript";
                                                        s.async = true;
                                                        s.src = "https://mc.yandex.ru/metrika/watch.js";

                                                        if (w.opera == "[object Opera]") {
                                                            d.addEventListener("DOMContentLoaded", f, false);
                                                        } else {
                                                            f();
                                                        }
                                                    })(document, window, "yandex_metrika_callbacks");
                                                </script>
                                                <noscript><div><img src="https://mc.yandex.ru/watch/42304124" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
                                                <!-- /Yandex.Metrika counter -->
                                            </li>
                                        </ul>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer_wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="fw_title">ОБСЛУЖИВАНИЕ КЛИЕНТОВ</div>
                                    <ul class="fw_list">
                                        <li><a href="#">Как заказать продукцию?</a></li>
                                        <li><a href="#">Правила и условия</a></li>
                                        <li><a href="#">Политика конфиденциальности</a></li>
                                        <li><a href="#">требование</a></li>
                                    </ul>
                                </div>
                                <div class="col-xs-3">
                                    <div class="fw_title">ВАРИАНТЫ ОПЛАТЫ:</div>
                                    <ul class="fw_list">
                                        <li><a href="#">Денежные средства при поднятии</a></li>
                                        <li><a href="#">наложенный платеж</a></li>
                                        <li><a href="#">банковский перевод</a></li>
                                        <li><a href="#">платежная карта ВУБ</a></li>
                                    </ul></div>
                                <div class="col-xs-3">
                                    <div class="fw_title">ВАРИАНТЫ: ТРАНСПОРТНЫЕ</div>
                                    <ul class="fw_list">
                                        <li><a href="#">особый</a></li>
                                        <li><a href="#">Личная коллекция в филиале</a></li>
                                        <li><a href="#">Личная коллекция в штаб-квартире</a></li>
                                    </ul></div>
                                <div class="col-xs-3">
                                    <div class="fw_title">ПОДПИСКА НА НОВОСТИ</div>
                                    <ul class="fw_list">
                                        <span class="subscription">Нравится ли вам наше предложение? Не пропустите наши специальные предложения!</span>
                                        <img src="img/subscription.jpg" alt="ПОДПИСКА" />
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item_footer">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-8">
                                    <div class="it_title">
                                        <span>В НАШЕМ МАГАЗИНЕ, НЕ ВОЛНУЙТЕСЬ:</span>
                                        <a href="#"><img src="img/logo_footer_overene.png" alt="overene" />
                                            <a href="#"><img src="img/logo_footer_pricemania.png" alt="pricemania" /></a>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="it_soc">
                                        <ul class="social_ul">
                                            <li><a href="#" class="facebook"><i class="fa fa-facebook-square fa-lg" aria-hidden="true" ></i> facebook</a></li>
                                            <li><a href="#"class="twitter"><i class="fa fa-twitter-square fa-lg" aria-hidden="true" ></i> twitter</a></li>
                                            <li><a href="#" class="google"><i class="fa fa-google-plus-square fa-lg" aria-hidden="true" ></i> google+</a></li>
                                            <li><a href="#" class="youtube"><i class="fa fa-youtube-square fa-lg" aria-hidden="true" ></i> youtube</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="e_footer">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12">
                                    2016 © sitengines.ru по всем вопросам пишите по адресу info@sitengines.ru
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- конец wrapper -->


    </body>
</html>

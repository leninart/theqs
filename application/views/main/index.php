<?php if (isset($_SESSION['account']['id'])): ?>
        <div class="container">
    <h1 class="my-4">Услуги</h1>
   <!-- <div class="row">
        <?php foreach ($tariffs as $key => $val): ?>
            <div class="col-lg-12 mb-4">
                <div class="card h-100">
                    <h3 class="card-header"><?php echo $val['title']; ?></h3>
                    <div class="card-body">
                        <div class="display-4"><?php echo $key; ?></div>
                        <div class="font-italic"><?php echo $val['description']; ?></div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Минимальный чек: <?php echo $val['min']; ?> р</li>
                        <li class="list-group-item">Можно использовать: <?php echo $val['seans']; ?> раз</li>
                        <li class="list-group-item">
                            <?php if (isset($_SESSION['account']['id'])): ?>
                                <a href="/dashboard/use/<?php echo $key; ?>" class="btn btn-primary">Записаться</a>
                            <?php else: ?>
                                <p>*Для записи войдите на сайт</p>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
    </div>-->
    <div class="row">
         <?php foreach ($service as $key => $val): ?>
            <div class="col-lg-12 mb-4">
                <div class="card h-100">
                    <h3 class="card-header"><?php echo $val['title']; ?></h3>
                    <div class="card-body">
                        
                        <div class="font-italic"><?php echo $val['price']; ?></div>
                    </div>
                    <ul class="list-group list-group-flush">
                      
                        <li class="list-group-item">Стоимость абонимента: <?php echo $val['price']; ?> р.</li>
                        <li class="list-group-item">
                            <?php if (isset($_SESSION['account']['id'])): ?>
                                <a href="/dashboard/visit/<?php echo $val['id']; ?>" class="btn btn-primary">Записаться</a>
                            <?php else: ?>
                                <p>*Для записи войдите на сайт</p>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php else: ?>
<div id="loader-wrapper">
<div id="loader"></div>
<div class="loader-section section-left"></div>
<div class="loader-section section-right"></div>
</div>


<div class="menu-outer">
    <div class="menu-icon">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>
    <nav>
        <ul>
           <li><a href="">Главная</a></li>
           <li><a href="/blog" target="_blank">Наши работы</a></li>
           <li><a href="/actions">Акции и скидки</a></li>
           <!--<li><a target="_blank" href="/account/register">Регистрация</a></li>-->
       </ul>
   </nav>
</div>
<a class="menu-close" onClick="return true">
    <div class="menu-icon">
        <div class="bar"></div>
        <div class="bar"></div>
    </div>
</a>

<div class="fixedcallicon fixedcallicon1">
    <i class="fa fa-phone"></i><span class="hide text-white">Телефон - 8(927)757 06 51</span>
</div>
<div class="fixedcallicon fixedcallicon2">
    <i class="fa fa-vk"></i><a href="https://vk.com/queenstudio_smr" target="_blank"><span class="hide text-white">VK - Мы во Вконтакте</span></a>
</div>
<div class="fixedcallicon fixedcallicon3">
    <i class="fa fa-instagram"></i><a href="https://vk.com/away.php?to=https%3A%2F%2Finstagram.com%2Fthequeen_smr%3Futm_source%3Dig_profile_share%26igshid%3Dkz3dlw8g4dic&cc_key=" target="_blank"><span class="hide text-white">Мы в Instagram</span></a>
</div>
<div class="fixedcallicon fixedcallicon4">
    <i class="fa fa-map-marker"></i><a href="https://go.2gis.com/wqof2" target="_blank"><span class="hide text-white">Как добраться</span></a>
</div>
<div class="jivo_site">

    <script type='text/javascript'>
        (function(){ var widget_id = 'uy8s3Z6iPG';var d=document;var w=window;function l(){
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;
         s.src = '//code.jivosite.com/script/widget/'+widget_id;
         var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}
        if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}
        else{w.addEventListener('load',l,false);}}})();
    </script>
<!-- {/literal} END JIVOSITE CODE -->
</div>
<div class="container">
    <section class="background">
    <div class="content-wrapper">
        <div class="intro">
            <h1><span class="smaller wow zoomIn" data-wow-duration="2s" data-wow-delay="0.5">г.Самара ул.Проспект Ленина 3</span>
            <span class="big wow pulse" data-wow-duration="1s" data-wow-delay="0s">The Queen Studio</span><br/>
            <span class="small wow fadeIn" data-wow-duration="2s" data-wow-delay="0.5s">- СТУДИЯ КРАСОТЫ -</span>
            </h1>
        </div>
    </div>
    </section>
    <section class="background">
    <div class="content-wrapper">
        <div class="about">
            <div class="aboutbadge">
                <span><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><br/>
                <span class="border">Надежный салон</span><br/>
                работаем с 2015</span>
            </div>
            <div class="aboutbadge black">
                <span>Для нас важно сохранить доверие клиента, поэтому наши мастера работают только на качественных средствах. Наши клиенты возвращаются к нам, потому что мы любим их и ждем всей командой! </span>
            </div>
        </div>
    </div>
    </section>
    <section class="background">
    <div class="content-wrapper">
        <div class="voucher">
            <div class="voucher-whitetransparent">
                <h2><i class="fa fa-gift"></i><br/>ПОЛУЧАЙТЕ СКИДКИ НА УСЛУГИ<br/>20% НА ЛЮБУЮ УСЛУГУ<br/><a href="/actions">Узнать Как</a></h2>
            </div>
        </div>
    </div>
    </section>
    <section class="background">
    <div class="content-wrapper">
        <div class="pricingbadge hair">
            <h4>Волосы</h4>
            <ul class="pricing_menu__list">
                <!--<?php/* foreach ($tariffs as $key => $val): ?>
                <li class="pricing_menu__row">
                <div class="pricing_menu__meal">
                    <span><?php echo $val['title']; ?></span>
                </div>
                <span class="pricing_menu__price"><?php echo $val['max']; ?> р</span>
                </li>
                <?php endforeach; */?>-->
                <li class="pricing_menu__row">
                <div class="pricing_menu__meal">
                    <span>Полировка волос</span>
                </div>
                <span class="pricing_menu__price">500 - 900 р</span>
                </li>
                <li class="pricing_menu__row">
                <div class="pricing_menu__meal">
                    <span>Полировка + керапластика с препаратом ботокс</span>
                </div>
                <span class="pricing_menu__price">1000 - 1700 р</span>
                </li>
                <li class="pricing_menu__row">
                <div class="pricing_menu__meal">
                    <span>Полировка + экранирование с препаратом ботокс</span>
                </div>
                <span class="pricing_menu__price">900 - 1500 р</span>
                </li>
                <li class="pricing_menu__row">
                <div class="pricing_menu__meal">
                    <span>Полировка + биоламинирование с препаратом ботокс</span>
                </div>
                <span class="pricing_menu__price">1200 - 2000р</span>
                </li>
                <a class="fullpricelist" href="../blog"><i class="fa fa-file-pdf-o"></i> Подробнее об услугах</a>
            </ul>
        </div>
    </div>
    </section>
    <section class="background">
    <div class="content-wrapper">
        <div class="pricingbadge nails">
            <h4>Ногти</h4>
            <ul class="pricing_menu__list">
                <li class="pricing_menu__row">
                <div class="pricing_menu__meal">
                    <span>Маникюр</span>
                </div>
                <span class="pricing_menu__price">от 450 р</span>
                </li>
                <li class="pricing_menu__row">
                <div class="pricing_menu__meal">
                    <span>Гель-лак + выравнивание ногтевой пластины </span>
                </div>
                <span class="pricing_menu__price">от 350 р</span>
                </li>
                <li class="pricing_menu__row">
                <div class="pricing_menu__meal">
                    <span>Дизайны</span>
                </div>
                <span class="pricing_menu__price">от 50 р</span>
                </li>
                <li class="pricing_menu__row">
                <div class="pricing_menu__meal">
                    <span>Педикр</span>
                </div>
                <span class="pricing_menu__price">от 900 р</span>
                </li>
                <a class="fullpricelist" href="../blog"><i class="fa fa-file-pdf-o"></i> Подробнее об услугах</a>
            </ul>
        </div>
    </div>
    </section>
        <section class="background">
    <div class="content-wrapper">
        <div class="pricingbadge resn">
            <h4>Реснички</h4>
            <ul class="pricing_menu__list">
                <li class="pricing_menu__row">
                <div class="pricing_menu__meal">
                    <span>Классическое наращивание</span>
                </div>
                <span class="pricing_menu__price">1100 р</span>
                </li>
                <li class="pricing_menu__row">
                <div class="pricing_menu__meal">
                    <span>Полуторный обьем</span>
                </div>
                <span class="pricing_menu__price">1200 р</span>
                </li>
                <li class="pricing_menu__row">
                <div class="pricing_menu__meal">
                    <span>2D обьем</span>
                </div>
                <span class="pricing_menu__price">1300 р</span>
                </li>
                <li class="pricing_menu__row">
                <div class="pricing_menu__meal">
                    <span>3D обьем</span>
                </div>
                <span class="pricing_menu__price">1500 р</span>
                </li>
                <li class="pricing_menu__row">
                <div class="pricing_menu__meal">
                    <span>4D обьемы и тд.</span>
                </div>
                <span class="pricing_menu__price">от 1700 р</span>
                </li>
                <a class="fullpricelist" href="../blog"><i class="fa fa-file-pdf-o"></i> Подробнее об услугах</a>
            </ul>
        </div>
    </div>
    </section>
    <section class="background">
    <div class="content-wrapper">
        <div class="pricingbadge nails">
            <h4>Брови</h4>
            <ul class="pricing_menu__list">
                <li class="pricing_menu__row">
                <div class="pricing_menu__meal">
                    <span>Коррекция бровей</span>
                </div>
                <span class="pricing_menu__price">250 р</span>
                </li>
                <li class="pricing_menu__row">
                <div class="pricing_menu__meal">
                    <span>Окрашивание краской/хной</span>
                </div>
                <span class="pricing_menu__price">250/350 р</span>
                </li>
                <a class="fullpricelist" href="../blog"><i class="fa fa-file-pdf-o"></i> Подробнее об услугах</a>
            </ul>
        </div>
    </div>
    </section>
    <section class="background">
    <div class="content-wrapper">
        <div class="pricingbadge resn">
            <h4>Перманентный макияж</h4>
            <ul class="pricing_menu__list">
                <li class="pricing_menu__row">
                <div class="pricing_menu__meal">
                    <span>Любая зона (брови, межресничка, губы)</span>
                </div>
                <span class="pricing_menu__price">4000 р</span>
                </li>
                <a class="fullpricelist" href="../blog"><i class="fa fa-file-pdf-o"></i> Подробнее об услугах</a>
            </ul>
        </div>
    </div>
    </section>
    <section class="background">
    <div class="content-wrapper">
        <div class="pricingbadge nails">
            <h4>Прически и макияж</h4>
            <ul class="pricing_menu__list">
                <li class="pricing_menu__row">
                <div class="pricing_menu__meal">
                    <span>Макияж</span>
                </div>
                <span class="pricing_menu__price">от 1000 р</span>
                </li>
                <li class="pricing_menu__row">
                <div class="pricing_menu__meal">
                    <span>Прически</span>
                </div>
                <span class="pricing_menu__price">от 1500 р</span>
                </li>
                <li class="pricing_menu__row">
                <div class="pricing_menu__meal">
                    <span>Укладки, локоны</span>
                </div>
                <span class="pricing_menu__price">от 1000 р</span>
                </li>
                <a class="fullpricelist" href="../blog"><i class="fa fa-file-pdf-o"></i> Подробнее об услугах</a>
            </ul>
        </div>
    </div>
    </section>
    <section class="background">
    <div class="content-wrapper">
        <div class="pricingbadge resn">
            <h4>Массаж</h4>
            <ul class="pricing_menu__list">
                <li class="pricing_menu__row">
                <div class="pricing_menu__meal">
                    <span>Массаж</span>
                </div>
                <span class="pricing_menu__price">1000 р</span>
                </li>
                <li class="pricing_menu__row">
                <div class="pricing_menu__meal">
                    <span>Массаж</span>
                </div>
                <span class="pricing_menu__price">1000 р</span>
                </li>
                <li class="pricing_menu__row">
                <div class="pricing_menu__meal">
                    <span>Массаж</span>
                </div>
                <span class="pricing_menu__price">1000 р</span>
                </li>
                <li class="pricing_menu__row">
                <div class="pricing_menu__meal">
                    <span>Массаж</span>
                </div>
                <span class="pricing_menu__price">1000 р</span>
                </li>
                <a class="fullpricelist" href="../blog"><i class="fa fa-file-pdf-o"></i> Подробнее об услугах</a>
            </ul>
        </div>
    </div>
    </section>
    <section class="background">
    <div class="content-wrapper">
        <div class="testimonialarea">
            <div class="testimonialarea-bubble">
                <div class="testimonial-widget">
                    <h3 class="uppercase">ЗАКАЖИТЕ КОНСУЛЬТАЦИЮ</h3>
                    <div class="testimonial">
                        <p>
                             Оставьте ваши данные и мы свяжемся с вами в ближайшее время!
                        </p>
                        <p>
                            <strong>Ждем вас!</strong>
                        </p>
                    </div>
                    <div class="testimonial">
                        <p>
                             Оставьте ваши данные и мы свяжемся с вами в ближайшее время!
                        </p>
                        <p>
                            <strong>Ждем вас!</strong>
                        </p>
                    </div>
                    <div class="testimonial">
                        <p>
                             Оставьте ваши данные и мы свяжемся с вами в ближайшее время! <i class="fa fa-star"></i>."
                        </p>
                        <p>
                            <strong>Ждем вас!</strong>
                        </p>
                    </div>
                    <button class="prev-testimonial">Prev</button>
                    <button class="next-testimonial">Next</button>
                </div>
            </div>
            <div class="contactform-bubble">
                <form autocomplete="off" class="contactform" method="post" action="*" id="contactform">
                    <input name="name" type="text" placeholder="Имя">
                    <input name="email" type="text" placeholder="E-mail">
                    <textarea name="comment" placeholder="Сообщение" rows="4"></textarea>
                    <input value="ОТПРАВИТЬ" type="submit" id="submit" class="btnsend">
                    <div class="done">
                        <div class="alert-box success">
                            <i>Сообщение отправлено! Мы уже набираем номер!</i>
                        </div>
                    </div>
                </form>
            </div>
            <div class="contactaddress-bubble">
                <div class="contactaddress">
                     г.Самара Проспект Ленина 3<br/>
                    <a class="map" href="#">Проезд</a>
                </div>
            </div>
        </div>
    
</div>
    </section>

    <section class="background">
    <div class="content-wrapper">
        <div id="map" style="width:80%; height:600px; margin: 0 auto; max-width: 100%;"></div>

             
    </section>

</div>
<?php endif; ?>
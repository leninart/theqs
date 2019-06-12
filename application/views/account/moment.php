<script>
        		/*function yoooo(){
        			swal({
              icon: "error",
              title: "Hey",
              text: "Hello!",
            });
        			swal.setActionValue({ confirm: 'Text from input' })
        		}*/
                function displayno(){
							document.getElementById('code').style.display = 'block';
                            /*if (!("Notification" in window))
                                alert ("Ваш браузер не поддерживает уведомления.");
                            else if (Notification.permission === "granted")
                                setTimeout(notifyMe, 2000);
                            else if (Notification.permission !== "denied") {
                                Notification.requestPermission (function (permission) {
                                    if (!('permission' in Notification))
                                        Notification.permission = permission;
                                    if (permission === "granted")
                                        setTimeout(notifyMe, 2000);
                                });
                            }*/
        		}
                /*function notifyMe () {
        
                    var notification = new Notification ("Все еще работаешь?", {
                        tag : "ache-mail",
                        body : "Пора сделать паузу и отдохнуть",
                        icon : "https://itproger.com/img/notify.png"
                    });
                }*/
            </script>
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
           <li><a href="/">Главная</a></li>
           <li><a href="/blog">Наши работы</a></li>
           <!--<li><a href="/account/login">Вход</a></li>
           <li><a target="_blank" href="/account/register">Регистрация</a></li>-->
       </ul>
   </nav>
</div>
<a class="menu-close" onClick="return true">
    <div class="menu-icon">
        <div class="bar"></div>
        <div class="bar"></div>
    </div>
</a>
<div class="container">

<section class="background">
    <div class="content-wrapper">
        <div class="intro">

        	<div class="fdfdf">
        	      <form class="contactform" method="post" action="/account/moment">
                    <input name="phone" type="number" placeholder="Телефон:" autofocus>
	                  <input name="promo" type="number" placeholder="Промокод:">
                      <input name="surname" type="surname" placeholder="Фамилия:" required>
                      <input name="name" type="name" placeholder="Имя:" required>
                      <input name="email" type="email" placeholder="Электронная почта:" required>
	                  <input name="code" type="number" placeholder="Код из SMS:" id = "code" style = "display: none;">
                    <?php if (isset($this->route['ref'])): ?>
											<input name="ref" type="number" value="<?php echo $this->route['ref']; ?>" readonly>
                    <?php else: ?>
	                    <input type="hidden" name="ref" value="none">
                		<?php endif; ?>
                    <!--<textarea name="comment" placeholder="Сообщение" rows="4"></textarea>-->
                    <input id="profile-login-popup-view-subscribe-input" type="checkbox" class="custom-checkbox" checked="" name="subscribe" style="width: inherit;">
                    <label for="profile-login-popup-view-subscribe-input" style="font-size: 10px;">Информация об акциях, новинках и подарках</label>
                    <div class="clear"></div><!--
                    <input id="profile-login-popup-view-str-input" type="checkbox" class="custom-checkbox" checked="" name="subscribe" style="width: inherit;">
                    <label for="profile-login-popup-view-str-input" style="font-size: 10px;
    line-height: 4px;
    margin: 0 0 4px;
    overflow: hidden;
    text-align: left;
    text-transform: none;">Модные новости и советы TheQueenStudio</label>-->

                    <input value="ОТПРАВИТЬ" type="submit" class="btnsend" id="cc" onclick="displayno()">
                    <div class="done">
                        <div class="alert-box success">
                            <i>Сообщение отправлено! Мы уже набираем номер!</i>
                        </div>
                    </div>
                    <div class="testimonialarea-bubble">
                <div class="testimonial-widget">
                    <!--<input type="checkbox" style="display: inline"><em style="font-size: 12px">Согласие на сбор и хранение персональных данных. Согласие предоставляется TheQueenStudio мной бессрочно.</em>
                    <input id="profile-login-popup-view-subscribe-input" type="checkbox" class="custom-checkbox" checked="" name="subscribe">-->
                    <div class="agreement">
                    Нажимая «<span class="js-agreement-text">отправить</span>»,
                    я&nbsp;соглашаюсь&nbsp;с&nbsp;<a target="_blank" href="/account/agreement/">условиями участия</a><br>
                    в&nbsp;Клубе TheQueenStudio и <a href="/account/confidential/" target="_blank">политикой конфиденциальности</a>
                </div>
                    <!--<input type="checkbox" style="display: inline"><p style="font-size: 12px">Я согласен(-сна) на получение SMS, Email и PUSH сообщений, которые будут информировать меня о рекламны акциях, новы услугах, проводимых мероприятиях и скидках.</p>-->
                   
            </div>
                </form>
                        <!--	<button onclick = "yoooo()">dsdssdsdsd</button>-->
            </div>
        </div>
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
    </section>
</div>
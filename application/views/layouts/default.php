<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="utf-8">
        <meta name="yandex-verification" content="279a12be87328426" />
        <link rel="stylesheet" type="text/css" href="/public/styles/style-img.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://maps.api.2gis.ru/2.0/loader.js?pkg=full"></script>
        <script type="text/javascript">
            var map;

            DG.then(function () {
                map = DG.map('map', {
                    center: [53.208583, 50.138501],
                    zoom: 16
                });

                DG.marker([53.208583, 50.138501]).addTo(map).bindPopup('Вам сюда!');
            });
        </script>
        <script charset="UTF-8" src="//cdn.sendpulse.com/js/push/50aa4feb00035cb84324e28f0188816a_1.js" async></script>
                <!-- Yandex.Metrika counter -->
        <script type="text/javascript" >
           (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
           m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
           (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

           ym(53107186, "init", {
                clickmap:true,
                trackLinks:true,
                accurateTrackBounce:true,
                webvisor:true
           });
        </script>
        <noscript><div><img src="https://mc.yandex.ru/watch/53107186" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->
        
    <?php if (isset($_SESSION['account']['id'])): ?>
        <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400italic,300italic,300,700,700italic' rel='stylesheet' type='text/css'>
        <link href="/public/styles/bootstrap.css" rel="stylesheet">
        <link href="/public/styles/main.css" rel="stylesheet">
        <link href="/public/styles/footable.bootstrap.min.css" rel="stylesheet">
        <script src="/public/scripts/jquery.js"></script>
        <script src="/public/scripts/form.js"></script>
        <script src="/public/scripts/popper.js"></script>
        <script src="/public/scripts/bootstrap.js"></script>
        <script src = "/public/scripts/footable.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            $(function() {
            $('.table').footable({});
        });
        </script>
    <?php elseif($this->route['action'] == 'blog'): ?>
        <link href="/public/styles/bootstrap.css" rel="stylesheet">
    <?php elseif($this->route['controller'] != 'account' OR $this->route['action'] == 'moment'): ?>
        <!-- шаблон -->
            <link href="/public/styles/style.css" rel="stylesheet">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
            <link href='https://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
            <link href='https://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>
            <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400italic,300italic,300,700,700italic' rel='stylesheet' type='text/css'>
        <!-- шаблон -->

    <?php else: ?>
            <link href="/public/styles/bootstrap.css" rel="stylesheet">
    <?php endif; ?>
    <script type="text/javascript">!function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src="https://vk.com/js/api/openapi.js?160",t.onload=function(){VK.Retargeting.Init("VK-RTRG-357514-6IdEJ"),VK.Retargeting.Hit()},document.head.appendChild(t)}();</script><noscript><img src="https://vk.com/rtrg?p=VK-RTRG-357514-6IdEJ" style="position:fixed; left:-999px;" alt=""/></noscript>
    </head>
    <?php if (isset($_SESSION['account']['id'])): ?>
    <body>
       <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="/">Запись</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        
                            <li class="nav-item">
                                <a class="nav-link" href="/dashboard/services">Мои посещения</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/dashboard/referrals">Рефералы</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/dashboard/history">История</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/account/profile">Профиль</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/account/logout">Выход</a>
                            </li>

                    </ul>
                </div>
            </div>
        </nav>
        <?php echo $content; ?>
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
    </body>
        <?php else: ?>
            <!--
            <li class="nav-item">
            <a class="nav-link" href="/account/register">Регистрация</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="/account/login">Вход</a>
            </li> -->
            <!-- Scripts -->
            <body class="frontpage">
                        <?php echo $content; ?>


        <script src="/public/scripts/jquery.js"></script>
        <script src="/public/scripts/form.js"></script>
        <script src="/public/scripts/popper.js"></script>
        <script src="/public/scripts/bootstrap.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- Шаблон -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
                <script src="/public/scripts/shablon/common.js"></script>
                <script src="/public/scripts/shablon/home.js"></script>
                <script src="/public/scripts/shablon/testimonials.js"></script>
        <!-- Шаблон -->
        <script type="text/javascript" src="https://vk.com/js/api/openapi.js?160"></script>

            </body>

        <?php endif; ?>
</html>
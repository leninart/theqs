<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo $title; ?></title>
        <link href="/public/styles/bootstrap.css" rel="stylesheet">
        <link href="/public/styles/admin.css" rel="stylesheet">
        <link href="/public/styles/footable.bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <script src="/public/scripts/jquery.js"></script>
        <script src="/public/scripts/form.js"></script>
        <script src="/public/scripts/popper.js"></script>
        <script src="/public/scripts/bootstrap.js"></script>
        <script src = "/public/scripts/footable.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            $(function() {
            $('.table').footable({});
            });
        </script>
        <script>
            $(function() {
              $('input[name="birthday"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 2010,
                maxYear: parseInt(moment().format('YYYY'),10) + 1,
    "locale": {
        "format": "MM/DD/YYYY",
        "separator": " - ",
        "applyLabel": "Apply",
        "cancelLabel": "Cancel",
        "fromLabel": "From",
        "toLabel": "To",
        "customRangeLabel": "Custom",
        "weekLabel": "W",
        "daysOfWeek": [
            "Вс",
            "Пн",
            "Вт",
            "Ср",
            "Чт",
            "Пт",
            "Сб"
        ],
        "monthNames": [
            "Январь",
            "Февраль",
            "Март",
            "Апрель",
            "Май",
            "Июнь",
            "Июль",
            "Август",
            "Сентябрь",
            "Октябрь",
            "Ноябрь",
            "Декабрь"
        ],
        "firstDay": 1
    },
    opens: "center",

              }, function(start, end, label) {
                //alert(start.format('DD.MM.YYYY'));
               window.location.href = "http://theqs.ru/admin/calendar/"+start.format('YYYYqMMqDD')
                /*var years = moment().diff(start, 'years');
                alert("You are " + years + " years old!");*/
              });
            });
        </script>
        
    </head>
    <body class="fixed-nav sticky-footer bg-dark">
        <?php if ($this->route['action'] != 'login'): ?>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
                <a class="navbar-brand" href="/admin/withdraw">Панель Администратора</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                        <li class="nav-item">
                            <span class="nav-link-text"><input type="text" name="birthday" value="<?php echo date('m'); ?>/<?php echo date('d'); ?>/<?php echo date('Y'); ?>" /></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/withdraw">
                                <span class="nav-link-text">Заявки на посещение</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/history">
                                <span class="nav-link-text">История</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/tariffs">
                                <span class="nav-link-text">Список записей</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/price">
                                <span class="nav-link-text">Список услуг</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/clients">
                                <span class="nav-link-text">Клиенты</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/logout">
                                <span class="nav-link-text">Выход</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        <?php endif; ?>
        <?php echo $content; ?>
        <?php if ($this->route['action'] != 'login'): ?>
            <footer class="sticky-footer">
                <div class="container">
                    <div class="text-center">
                        <small>&copy; 2019, Студия красоты TheQueenStudio</small>
                    </div>
                </div>
            </footer>
            <script>
                $(function () {
                    $("#btn1").click(function () {
                        $("#myModal1").modal('show');
                    });
                });
            </script>
            <script>
                $(function () {
                    $("#btn2").click(function () {
                        $("#myModal2").modal('show');
                    });
                });
            </script>
            <script>
                $(function () {
                    $("#btn3").click(function () {
                        $("#myModal3").modal('show');
                    });
                });
            </script>
        <?php endif; ?>
    </body>
</html>
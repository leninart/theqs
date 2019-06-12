<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><?php echo $title ?></div>
                    <div class="row">   
                        <div class="container">
                            <p><a href="#myModal3" id="btn3" class="btn btn-primary" data-toggle="modal">Записать клиента</a></p>
                            <div id="myModal3" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title">Записать клиента</h4>
                                        </div>
                                        <form action="/admin/addvisit" method="post">
                                            <div class="modal-body">
                                                <div class="control-group form-group">
                                                    <div class="controls">
                                                        <div class="form-group">
                                                            <label for="sel1">Клиент:</label>
                                                                <select class="form-control" id="sel1" name="client" >
                                                                    <?php foreach($spisok as $key => $val): ?>
                                                                    <option value="<?php echo $val['phone']; ?>"><?php echo $val['phone'].' '.$val['surname'].' '.$val['name']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group form-group">
                                                    <div class="controls">
                                                        <div class="form-group">
                                                            <label for="sel1">Услуга:</label>
                                                                <select class="form-control" onchange="change()" id="sel" name="service">
                                                                    <option selected >Выберите услугу</option>
                                                                    <?php foreach($spisok2 as $key => $val): ?>
                                                                        <?php $i[$val['id']]= $key; ?>
                                                                    <option id="<?php $i[$val['id']]; ?>" value="<?php echo $val['id']; ?>"><?php echo $val['title'].' '.$val['price'].' '.$val['category']; ?></option>
                                                                <?php endforeach; ?>
                                                                </select>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group form-group">
                                                    <div class="controls">
                                                        <label>Цена:</label>
                                                        <input type="number" class="form-control" name="price" value="" id="priority" readonly>
                                                    </div>
                                                </div>

                                                <script>
                                                    function change()
                                                    {  
                                                      var val = document.getElementById('sel').value  
                                                      var parent = document.getElementById('priority');
                                                      
                                                      if (val=='1') {
                                                        parent.value = '<?php echo $spisok2[$i[1]]["price"]; ?>';
                                                      } else {
                                                        parent.value = '121212';
                                                        }  
                                                    }
                                                </script>
                                                <div class="control-group form-group">
                                                    <div class="controls">
                                                        <div class="form-group">
                                                            <label for="sel1">Мастер:</label>
                                                                <select class="form-control" id="sel1" name="master" >
                                                                    <?php foreach($spisok3 as $key => $val): ?>
                                                                    <option value="<?php echo $val['id']; ?>"><?php echo $val['surname'].' '.$val['name'].' '.$val['category']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group form-group">
                                                    <div class="controls">
                                                        <label>Время:</label>
                                                        <select class="form-control" name="time" >
                                                        <?php foreach($spisok4 as $key => $val): ?>
                                                                    <option value="<?php echo $val[0]; ?>"><?php echo $val; ?></option>
                                                        <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <input type="hidden" name = "date" value="<?php echo str_replace('q', "", $this->route['date']); ?>">
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                <?php foreach($vars as $key => $val): ?>
                <div class="row">
                    <div class="col-md-auto">Заявка: <?php echo $val['id']; ?></div>
                    <div class="col-md-auto">Клиент: <?php echo $val['uid']; ?></div>
                    <div class="col-md-auto">Сумма: <?php echo $val['sum']; ?></div>
                    <div class="col-md-auto">Итоговая: <?php echo $val['sale']; ?></div>
                    <div class="col-md-auto">записан: <?php echo date('d.m.Y в H:i:s', $val['timeIn']); ?></div>
                    <div class="col-md-auto">Время: <?php echo $val['timevisit']; ?></div>
                    <div class="col-md-auto">Дата: <?php echo $val['datevisit']; ?></div>
                    <div class="col-md-auto">Услуга: <?php echo $val['service']; ?></div>
                    <div class="col-md-auto">Мастер: <?php echo $val['master']; ?></div>
                </div>
                <?php endforeach; ?>
        </div>
    </div>
</div>
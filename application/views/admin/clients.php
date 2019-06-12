<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><?php echo $title; ?></div>
            <div class="">
                        <div class="container">
                            <p><a href="#myModal1" id="btn1" class="btn btn-primary" data-toggle="modal">Добавить клиента</a></p>
                            <div id="myModal1" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title">Добавить нового клиента</h4>
                                        </div>
                                        <form action="/admin/addclient" method="post">
                                        <div class="modal-body">
                                        <div class="control-group form-group">
                                            <div class="controls">
                                                <label>Имя:</label>
                                                <input type="text" class="form-control" name="name">
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <div class="controls">
                                                <label>Фамилия:</label>
                                                <input type="text" class="form-control" name="surname">
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <div class="controls">
                                                <label>E-mail:</label>
                                                <input type="text" class="form-control" name="email">
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <div class="controls">
                                                <label>Телефон:</label>
                                                <input type="number" class="form-control" name="phone">
                                            </div>
                                        </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
            </div>
                        <?php if (empty($list)): ?>
                            <p>Список клиентов пуст</p>
                        <?php else: ?>
                            <div class="">
                                <table class="table table-bordered" data-filtering="true" data-sorting="true">
                                    <thead>
                                        <tr>
                                            <th data-breakpoints="xs sm">id</th>
                                            <th>Фамилия</th>
                                            <th>Имя</th>
                                            <th data-breakpoints="xs sm"  data-filter-value="email">email</th>
                                            <th data-breakpoints="xs sm">Телефон</th>
                                            <th data-breakpoints="xs sm">Приглашен</th>
                                            <th data-breakpoints="xs sm">Профиль</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $arrayName = [];
                                        foreach ($list as $val): ?>
                                            <tr>
                                                <td><?php echo $val['id']; ?></td>
                                                <td><?php echo $val['surname']; ?></td>
                                                <td><?php echo $val['name']; ?></td>
                                                <td><?php echo $val['email']; ?></td>
                                                <td><?php echo $val['phone']; ?></td>
                                                <td><?php echo $val['ref']; 
                                                $arrayName[$val['id']] = $val;
                                                /*echo ($arrayName[$val['id']]['surname'].' '.$arrayName[$val['id']]['name']));*/
                                                ?></td>
                                                <td><p><a href="clientprofile/<?php echo $val['id']; ?>" id="btn2" class="btn btn-primary">Профиль</a></p></td>
                                            </tr>
                                            <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php echo $pagination; ?>
                        <?php endif; ?>
        </div>
    </div>
</div>
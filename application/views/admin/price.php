<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><?php echo $title; ?></div>
            <div class="card-body">
                <div class="row">
                    <div class="container">
                            <p><a href="#myModal3" id="btn3" class="btn btn-primary" data-toggle="modal">Добавить услугу</a></p>
                            <div id="myModal3" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title">Добавить услугу</h4>
                                        </div>
                                        <form action="/admin/addservice" method="post">
                                        <div class="modal-body">
                                        <div class="control-group form-group">
                                            <div class="controls">
                                                <label>Название:</label>
                                                <input type="text" class="form-control" name="title">
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <div class="controls">
                                                <label>Цена:</label>
                                                <input type="number" class="form-control" name="price">
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <div class="controls">
                                                <label>Описание:</label>
                                                <textarea row="3" class="form-control" name="description" ></textarea>
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <div class="controls">
                                                <label>Категория:</label>
                                                <input type="text" class="form-control" name="category">
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
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?php if (empty($list)): ?>
                            <p>Список услуг пуст</p>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" data-filtering="true" data-sorting="true">
                                    <thead>
                                        <tr>
                                            <th data-breakpoints="xs sm">ID услуги</th>
                                            <th>Название</th>
                                            <th>Стоимость</th>
                                            <th data-breakpoints="xs sm">Описание</th>
                                            <th>Категория</th>
                                            <th data-breakpoints="xs sm">Разряд</th>
                                            <th data-breakpoints="xs sm">img</th>
                                            <th data-breakpoints="xs sm" >Редактор</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($list as $val): ?>
                                            <tr>
                                                <td><?php echo $val['id']; ?></td>
                                                <td><?php echo $val['title']; ?></td>
                                                <td><?php echo $val['price']; ?></td>
                                                <td><?php echo $val['description']; ?></td>
                                                <td><?php echo $val['category']; ?></td>
                                                <td><?php echo $val['label']; ?></td>
                                                <td><?php echo $val['img']; ?></td>
                                                <td><button>Редактировать</button></td>
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
        </div>
    </div>
</div>
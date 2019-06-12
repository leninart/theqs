<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><?php echo $title; ?></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <?php if (empty($list)): ?>
                            <p>История пуста</p>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Дата</th>
                                            <th>Логин</th>
                                            <th>E-mail</th>
                                            <th>Описание</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($list as $val): ?>
                                            <tr>
                                                <td><?php echo date('d.m.Y в H:i:s', $val['unixTime']); ?></td>
                                                <td><?php echo $val['phone']; ?></td>
                                                <td><?php echo $val['email']; ?></td>
                                                <td><?php echo $val['description']; ?></td>
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
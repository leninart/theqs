<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">Заявки на акционные псещения</div>
            <div class="card-body">
            	
                <div class="row">
                    <div class="col-sm-12">
                        <?php if (empty($listTariffs)): ?>
                            <p>Список заявок на акционные псещения пуст</p>
                        <?php else: ?>
                        	<div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Промокод</th>
                                        <th>Дата</th>
                                        <th>Скидка</th>
                                        <th>Телефон</th>
                                        <th>Карта</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listTariffs as $val): ?>
                                        <tr>
                                            <td># <?php echo $val['sumin']; ?></td>
                                            <td><?php echo date('d.m.Y в H:i', $val['unixTimeFinish']); ?></td>
                                            <td><?php echo $val['sumout']; ?> р</td>
                                            <td><?php echo $val['phone']; ?></td>
                                            <td><?php echo $val['card']; ?></td>
                                            <td>
                                                <form action="/admin/withdraw" method="post">
                                                    <input type="hidden" name="type" value="tariff">
                                                    <input type="hidden" name="id" value="<?php echo $val['id']; ?>">
                                                    <button type="submit" class="btn btn-success">Обработано</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                           </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">Заявки на вывод реферального вознаграждения</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <?php if (empty($listRef)): ?>
                            <p>Список заявок на вывод реферального вознаграждения пуст</p>
                        <?php else: ?>
                        	<div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Дата</th>
                                        <th>Сумма</th>
                                        <th>Логин</th>
                                        <th>Кошелек</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listRef as $val): ?>
                                        <tr>
                                            <td><?php echo date('d.m.Y в H:i', $val['unixTime']); ?></td>
                                            <td><?php echo $val['amount']; ?> $</td>
                                            <td><?php echo $val['phone']; ?></td>
                                            <td><?php echo $val['card']; ?></td>
                                            <td>
                                                <form action="/admin/withdraw" method="post">
                                                    <input type="hidden" name="type" value="ref">
                                                    <input type="hidden" name="id" value="<?php echo $val['id']; ?>">
                                                    <button type="submit" class="btn btn-success">Выплачено</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                           </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
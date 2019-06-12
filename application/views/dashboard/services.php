<div class="container">
    <h1 class="mt-4 mb-3"><?php echo $title; ?></h1>
    <div class="row">
        <div class="col-lg-12 mb-4">
					<?php if (empty($list)): ?>
							<p>У вас пока нет скидок</p>
					<?php else: ?>
						<table class="table" style="font-size:14px;" data-filtering="true" data-toggle-selector=".footable-toggle" data-sorting="true">
							<thead>
								<tr>
									<th>Дата получения</th>
									<th data-breakpoints="xs sm"><label>Дата окончания</label></th>
									<th data-breakpoints="xs sm">Скидка</th>
									<th data-breakpoints="xs sm">Цена со скидкой</th>
									<th data-breakpoints="xs sm">Скидка</th>
									<th data-breakpoints="xs sm">Статус</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($list as $val): ?>
									<tr>
										<td><?php echo date('d.m.Y в H:i', $val['unixTimeStart']); ?></td>
										<td><?php echo date('d.m.Y в H:i', $val['unixTimeFinish']); ?></td>
										<td><?php echo $val['sumin'] ?></td>
										<td><?php echo round( $val['sumin'] - $val['sumin'] * $val['percent'] / 100, 2 )?></td>
										<td><?php echo $val['percent'] ?> %</td>
										<td>
											<?php
													if (time() >= $val['unixTimeFinish']):
											  ?>
											  		<?php if ($val['sumout']): ?>
											  			Ожидает оплаты
											  		<?php else: ?>
											  			закрыт
											  		<?php endif; ?>
											  <?php else: ?>
											  		Активна
											  <?php endif; ?>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
						
						<?php echo $pagination; ?>
					<?php endif ?>
        </div>
    </div>
</div>
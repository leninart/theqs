<div class="container">
    <h1 class="mt-4 mb-3"><?php echo $title; ?></h1>
    <div class="row">
        <div class="col-lg-8 mb-4">
        	<form action="/dashboard/referrals" method="post">
                <div class="control-group form-group">
                    <div class="controls">
                        <label>ссылка:</label>
                        <input type="text" class="form-control" value="<?php $siteURL='http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['HTTP_HOST'].'/'; echo $siteURL; ?>account/register/<?php echo $_SESSION['account']['phone']; ?>" disabled>
                        <p class="help-block"></p>
                    </div>
                </div>

                <div class="control-group form-group">
                    <div class="controls">
                        <label>Реферальный баланс</label>
                        <input type="text" class="form-control" name="password" value="<?php echo $_SESSION['account']['refBalance']; ?>" readonly>
                     </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Заказать выплату</button>
            </form>
           <hr>
					<?php if (empty($vars)): ?>
							<p>Пригласите кого-нибудь</p>
					<?php else: ?>
						<table class="table table-bordered table-responsive">
							<thead>
								<tr>
									<th>Пользователь</th>
									<th>Описание</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($vars as $val): ?>
									<tr>
										<td><?php echo $val['card']; ?></td>
										<td><?php echo $val['email']; ?></td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
						
					<?php endif; ?>
        </div>
    </div>
</div>
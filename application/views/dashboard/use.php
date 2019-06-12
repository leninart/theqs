<div class="container">
    <h1 class="mt-4 mb-3"><?php echo $title; ?></h1>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <form action="/dashboard/perfectmoney" method="post" id="no_ajax">				
				<div class="control-group form-group">
                    <div class="controls">
                        <label>Название услуги:</label>
                        <input type="text" class="form-control" value="<?php echo $service['title']; ?>" disabled>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Стоимость:</label>
                        <input type="text" class="form-control" value="<?php echo $service['price']; ?> р." disabled>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Сеансов:</label>
                        <input type="text" class="form-control" value="<?php echo $service['seans']; ?> " disabled>
                    </div>
                </div>
				<input type="hidden" name="PAYEE_ACCOUNT" value="Кошелек получателя">
				<input type="hidden" name="PAYEE_NAME" value="Заказ по промокоду # <?php echo $this->route['id']; ?>">
				<div class="control-group form-group">
                    <div class="controls">
                        <label>Сумма:</label>
                        <input type="number" class="form-control" value="<?php echo $service['price']; ?>" name="PAYMENT_AMOUNT" readonly>
                    </div>
                </div>
				<input type="hidden" name="PAYMENT_ID" value="<?php echo $this->route['id'].','.$_SESSION['account']['id']; ?>">
				<input type="hidden" name="STATUS_URL" value="<?php $siteURL='http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['HTTP_HOST'].'/'; echo $siteURL; ?>merchant/perfectmoney">
				<input type="hidden" name="PAYMENT_URL" value="<?php echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST']; ?>/account/profile">
				<input type="hidden" name="NOPAYMENT_URL" value="<?php echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST']; ?>/account/profile">
				<button type="sumbit" class="btn btn-primary">Перейти к оплате</button>
			</form>
        </div>
    </div>
</div>
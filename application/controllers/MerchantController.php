<?php

namespace application\controllers;

use application\core\Controller;

class MerchantController extends Controller {

	public function perfectmoneyAction() 
	{
		
		$_POST['PAYMENT_BATCH_NUM'] = '';
		$_POST['PAYMENT_ACCOUNT'] = '';
		$_POST['TIMESTAMPGMT'] = '';
		
		
		if (empty($_POST))
		{
			$this->view->errorCode(404);
		}
		$data = $this->model->validatePerfectMoney($_POST, $this->tariffs);
		if (!$data)
		{
			$this->view->errorCode(403);
		}
		$this->model->createTariff($data, $this->tariffs[$data['tid']]);
	}

	public function visitaddAction() 
	{
		
		$_POST['PAYMENT_BATCH_NUM'] = '';
		$_POST['PAYMENT_ACCOUNT'] = '';
		$_POST['TIMESTAMPGMT'] = '';
		
		
		if (empty($_POST))
		{
			$this->view->errorCode(404);
		}
		$data = $this->model->validateVisit($_POST, $this->tariffs);
		if (!$data)
		{
			$this->view->errorCode(403);
		}
		$this->model->createVisit($data, $this->tariffs[$data['tid']]);
	}
}
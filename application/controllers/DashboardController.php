<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;

class DashboardController extends Controller {

	public function useAction() {
		$vars = [
			'service' => $this->tariffs[$this->route['id']], //tariffs это файл в config
		];
		//debug($vars['service']);
		$this->view->render('Запись', $vars);
	}
	public function visitAction() {
		$res = $this->model->getPrice();	
		$vars = [
			'service' => $res[$this->route['id']-1],
		];
		//debug($vars['service']);
		$this->view->render('Запись', $vars);
	}

	public function servicesAction() {
		$pagination = new Pagination($this->route, $this->model->servicesCount());
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->servicesList($this->route),
		];
		$this->view->render('Мои заказы', $vars);
	}
	
	public function historyAction() {
		$pagination = new Pagination($this->route, $this->model->historyCount());
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->historyList($this->route),
		];
		$this->view->render('История', $vars);
	}

	public function referralsAction() {
		if (!empty($_POST)) {
			if ($_SESSION['account']['refBalance'] <= 0) {
				$this->view->message('success', 'Реферальный баланс пуст');
			}
			$this->model->creatRefWithdraw();
			$this->view->message('success', 'Заявка на вывод создана');
		}
		$vars = $this->model->referralsList();
		$this->view->render('Рефералы', $vars);
	}

	public function perfectmoneyAction() 
	{
				
		if (empty($_POST))
		{
			$this->view->errorCode(404);
		}
		$data = $this->model->validatePerfectMoney($_POST, $this->tariffs);
		if (!$data)
		{
			$this->view->errorCode(403);
		}
		$code = key($this->tariffs);
		$this->model->createTariff($data, $this->tariffs[$data['tid']], $code);
	}

	public function visitaddAction() 
	{
		
		if (empty($_POST))
		{
			$this->view->errorCode(404);
		}
		$data = $this->model->validateVisit($_POST, $this->model->getPrice());
		if (!$data)
		{
			$this->view->errorCode(403);
		}
		//debug($this->model->getPrice());
		//debug($this->model->getPrice()[$data['tid']-1]);
		$this->model->createVisit($data, $this->model->getPrice()[$data['tid']-1]);
	}

}
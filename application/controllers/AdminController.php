<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;

class AdminController extends Controller {

	public function __construct($route) {
		parent::__construct($route);
		$this->view->layout = 'admin';
	}

	public function loginAction() {
		if (isset($_SESSION['admin'])) {
			$this->view->redirect('admin/withdraw');
		}
		if (!empty($_POST)) {
			if (!$this->model->loginValidate($_POST)) {
				$this->view->message('error', $this->model->error);
			}
			$_SESSION['admin'] = true;
			$this->view->location('admin/withdraw');
		}
		$this->view->render('Вход');
	}

	public function withdrawAction() {
		if (!empty($_POST)) {
			if ($_POST['type'] == 'ref') {
				$result = $this->model->withdrawRefComplete($_POST['id']);
				if ($result) {
					$this->view->location('admin/withdraw');
				}
				else {
					$this->view->message('error', 'Ошибка обработки запроса');
				}
			}
			elseif ($_POST['type'] == 'tariff') {
				$result = $this->model->withdrawTariffsComplete($_POST['id']);
				if ($result) {
					$this->view->location('admin/withdraw');
				}
				else {
					$this->view->message('error', 'Ошибка обработки запроса');
				}
			}
		}
		$vars = [
			'listRef' => $this->model->withdrawRefList(),
			'listTariffs' => $this->model->withdrawTariffsList(),
		];
		$this->view->render('Заказы на вывод средств', $vars);
	}

	public function historyAction() {
		$pagination = new Pagination($this->route, $this->model->historyCount());
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->historyList($this->route),
		];
		$this->view->render('История', $vars);
	}

	public function tariffsAction() {
		$pagination = new Pagination($this->route, $this->model->tariffsCount());
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->tariffsList($this->route),
		];
		$this->view->render('Список инвестиций', $vars);
	}

	public function priceAction() {
		$pagination = new Pagination($this->route, $this->model->priceCount());
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->priceList($this->route),
		];
		$this->view->render('Список услуг', $vars);
	}

	public function clientsAction() {
		$pagination = new Pagination($this->route, $this->model->clientsCount());
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->clientsList($this->route),
		];
		$this->view->render('Список клиентов', $vars);
	}

	public function logoutAction() {
		unset($_SESSION['admin']);
		$this->view->redirect('admin/login');
	}

	public function addclientAction()
	{
		if(!empty($_POST))
		{
			if(!$this->model->validate(['email', 'phone'], $_POST))
					{
						$this->view->message('error', $this->model->error);
					}
			elseif($this->model->checkEmailExists($_POST['email']))
					{
						$this->view->message('error', 'Этот E-mail уже используется');
					}
			elseif(!$this->model->checkPhoneExists($_POST['phone']))
					{
						$this->view->message('error', $this->model->error);
					}
			else{
					$this->model->addclient($_POST);
					$this->view->message('Success', 'Клиент добавлен');
					}
			}
	}

	public function clientprofileAction()
	{
$letters = array('/admin/clientprofile/');
$fruit   = array('');
$text    = $_SERVER['REQUEST_URI'];
$id  = str_replace($letters, $fruit, $text);
$vars = ($this->model->clientprofile($id));
//echo $vars[0]['email'];
$this->view->render('Профиль клиента', $vars);
	}

	public function addserviceAction()
	{
		if(!empty($_POST))
		{
			if(!$this->model->checkTitleExists($_POST['title']))
					{
						$this->view->message('error', 'Эта услуга уже существует');
					}
			if($this->model->addservice($_POST))
			{
				$this->view->message('Success', 'Услуга успешно добавлена');
			}
			else
			{
				$this->view->message('error', 'Услуга не добавлена');
			}
		}
		else($this->view->message('Success', 'ЗАПОЛНИ'));
	}

	public function calendarAction() {
		$date = str_replace('q', "", $this->route['date']);
		$data = $this->model->checkDate($date);
		$clientList = $this->model->setClient();
		$servicesList = $this->model->setService();
		$mastersList = $this->model->setMasters();
		$chislo = str_replace('q', "", $this->route['date']);
		$timeList = $this->model->setTime($chislo);
		$chislo = str_replace('q', "", $this->route['date']);
		
		$this->view->render('Календарь', $data, $clientList, $servicesList, $mastersList, $timeList);
	}

	public function addvisitAction()
	{
		if(!empty($_POST))
		{
			if(!$this->model->checkClientExists($_POST['client']))
				{
					$this->view->message('error', 'Такого клиента нет!');
				}
			else{
				if($this->model->checkDateTimeExists())
							{
								$this->view->message('error', 'Эта дата занята');
							}
						else
								$this->view->message('error', 'Эта дата yt занята');
					}
		}
		else($this->view->message('Success', 'ЗАПОЛНИ'));
	}


}
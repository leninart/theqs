<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;

class MainController extends Controller {

	public function indexAction() {
		$result = $this->model->getPrice();
		$varsvisit = [
			'service' => $result,
		];

		$vars = [
			'tariffs' => $this->tariffs,
		];

		$this->view->render('Главная страница', $vars, $varsvisit);
	}

	public function blogAction() {
		$this->view->render('Галерея');
	}

	public function actionsAction() {
		$this->view->render('Акции');
	}

}
<?php

namespace application\controllers;

use application\core\Controller;

class OtherController extends Controller {

	public function __construct($route) {
		parent::__construct($route);
		$this->view->layout = 'other';
	}

	public function otherAction()
	{
		$this->view->renderall('Другое');
	}
}
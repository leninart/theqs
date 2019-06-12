<?php

namespace application\models;

use application\core\Model;

class Main extends Model {

	public function getPrice() {
		$result = $this->db->row('SELECT * FROM prices');
		return $result;
	}

}
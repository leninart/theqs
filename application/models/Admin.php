<?php

namespace application\models;

use application\core\Model;

class Admin extends Model {

	public function loginValidate($post) {
		$config = require 'application/config/admin.php';
		if ($config['login'] != $post['login'] or $config['password'] != $post['password']) {
			$this->error = 'Логин или пароль указан неверно';
			return false;
		}
		return true;
	}

	public function validate($input, $post)
	{
		$rules = [
			'email' => [
				'pattern' => '#^([a-z0-9_.-]{1,20}+)@([a-z0-9_.-]+)\.([a-z\.]{2,10})$#',
				'message' => 'Email некорректный',
			],
			'phone' => [
				'pattern' =>'#^[0-9]{8,12}$#',
				'message' => 'Телефон введен некорректно',
			],
			'ref' => [
				'pattern' =>'#^[0-9none]{0,12}$#',
				'message' => 'Рефферал некорректный',
			],
			
		];


		foreach ($input as $val)
		{
			if (!isset($post[$val]) or !preg_match($rules[$val]['pattern'], $post[$val]))
			{
				$this->error = $rules[$val]['message'];
				return false;
			}
		}
		if (isset($post['ref']))
		{
			if ($post['phone'] == $post['ref'])
			{
				$this->error = 'Вы не можете быть своим рефераллом!';
				return false;
			}
		}
		return true;
	}


	/*public function validateVisit($post, $tariff)
		{
				
			  $tid = $post['PAYMENT_ID'];
			  $uid = $_SESSION['account']['id']; 
				//Делаем числами
				$tid += 0;
				$uid += 0;
				$amount = $post['price'] + 0;
				$params =[
					'tid' => $tid,
				];
				$rif = $this->db->row('SELECT * FROM prices WHERE id = :tid', $params);
				if ($amount != $rif[0]['price'])
				{
					return false;
				}
			return 
				[
					'tid' => $tid,
					'uid' => $uid,
					'amount' => $amount,
					'service' => $post['service'],
				];
		}
	
*/
	public function historyCount() {
		return $this->db->column('SELECT COUNT(id) FROM history');
	}

	public function historyList($route) {
		$max = 10;
		$params = [
			'max' => $max,
			'start' => ((($route['page'] ?? 1) - 1) * $max),
		];
		$arr = [];
		$result = $this->db->row('SELECT * FROM history ORDER BY id DESC LIMIT :start, :max', $params);
		if (!empty($result)) {
			foreach ($result as $key => $val) {
				$arr[$key] = $val;
				$params = [
					'id' => $val['uid'],
				];
				$account = $this->db->row('SELECT phone, email FROM users WHERE id = :id', $params)[0];
				$arr[$key]['phone'] = $account['phone'];
				$arr[$key]['email'] = $account['email'];
			}
		}
		return $arr;
	}

	public function withdrawRefList() {
		$arr = [];
		$result = $this->db->row('SELECT * FROM ref_withdraw ORDER BY id DESC');
		if (!empty($result)) {
			foreach ($result as $key => $val) {
				$arr[$key] = $val;
				$params = [
					'id' => $val['uid'],
				];
				$account = $this->db->row('SELECT phone, card FROM users WHERE id = :id', $params)[0];
				$arr[$key]['phone'] = $account['card'];
				$arr[$key]['card'] = $account['phone'];
			}
		}
		return $arr;
	}

	public function withdrawTariffsList() {
		$arr = [];
		$result = $this->db->row('SELECT * FROM tariffs WHERE UNIX_TIMESTAMP() >= unixTimeFinish AND sumOut != 0 ORDER BY id DESC');
		if (!empty($result)) {
			foreach ($result as $key => $val) {
				$arr[$key] = $val;
				$params = [
					'id' => $val['uid'],
				];
				$account = $this->db->row('SELECT phone, card FROM users WHERE id = :id', $params)[0];
				$arr[$key]['phone'] = $account['phone'];
				$arr[$key]['card'] = $account['card'];
			}
		}
		return $arr;
	}

	public function withdrawRefComplete($id) {
		$params = [
			'id' => $id,
		];
		$data = $this->db->row('SELECT uid, amount FROM ref_withdraw WHERE id = :id', $params);
		if (!$data) {
			return false;
		}
		$this->db->query('DELETE FROM ref_withdraw WHERE id = :id', $params);
		$data = $data[0];
		$params = [
			'id' => '',
			'uid' => $data['uid'],
			'unixTime' => time(),
			'description' => 'Выплата реферального вознаграждения произведена, сумма '.$data['amount'].' бонусов',
		];
		$this->db->query('INSERT INTO history VALUES (:id, :uid, :unixTime, :description)', $params);
		$params = [
			'id' => $data['uid'],
		];
		$dat = $this->db->row('SELECT * FROM users WHERE id = :id', $params);
		$bablo = $dat[0]['bonuse'] + $data['amount'];
		$this->db->query('UPDATE users SET bonuse = '.$bablo.' WHERE id = :id', $params);
		return true;
		unset($post);
	}

	public function withdrawTariffsComplete($id) {
		$params = [
			'id' => $id,
		];
		$data = $this->db->row('SELECT uid, sumOut FROM tariffs WHERE id = :id', $params);
		if (!$data) {
			return false;
		}
		$this->db->query('UPDATE tariffs SET sumOut = 0 WHERE id = :id', $params);
		$data = $data[0];
		$params = [
			'id' => '',
			'uid' => $data['uid'],
			'unixTime' => time(),
			'description' => 'Обработка входящей заявки # '.$id.' произведена',
		];
		$this->db->query('INSERT INTO history VALUES (:id, :uid, :unixTime, :description)', $params);
		return true;
	}

	public function tariffsCount() {
		return $this->db->column('SELECT COUNT(id) FROM tariffs');
	}

	public function tariffsList($route) {
		$max = 10;
		$params = [
			'max' => $max,
			'start' => ((($route['page'] ?? 1) - 1) * $max),
		];
		$arr = [];
		$result = $this->db->row('SELECT * FROM tariffs ORDER BY id DESC LIMIT :start, :max', $params);
		if (!empty($result)) {
			foreach ($result as $key => $val) {
				$arr[$key] = $val;
				$params = [
					'id' => $val['uid'],
				];
				$account = $this->db->row('SELECT phone, email FROM users WHERE id = :id', $params)[0];
				$arr[$key]['phone'] = $account['phone'];
				$arr[$key]['email'] = $account['email'];
			}
		}
		return $arr;
	}

	public function priceCount() {
		return $this->db->column('SELECT COUNT(id) FROM prices');
	}

	public function priceList($route) {
		$max = 10;
		$params = [
			'max' => $max,
			'start' => ((($route['page'] ?? 1) - 1) * $max),
		];
		$arr = [];
		$result = $this->db->row('SELECT * FROM prices ORDER BY category DESC LIMIT :start, :max', $params);
		if (!empty($result)) {
			foreach ($result as $key => $val) {
				$arr[$key] = $val;
				$params = [
					'id' => $val['id'],
				];
				}
		}
		return $arr;
	}

	public function clientsCount() {
		return $this->db->column('SELECT COUNT(id) FROM users');
	}
	public function clientsList($route) {
		$max = 10;
		$params = [
			'max' => $max,
			'start' => ((($route['page'] ?? 1) - 1) * $max),
		];
		$arr = [];
		$result = $this->db->row('SELECT * FROM users ORDER BY surname DESC LIMIT :start, :max', $params);
		if (!empty($result)) {
			foreach ($result as $key => $val) {
				$arr[$key] = $val;
				$params = [
					'ref' => $val['ref'],
				];
				$reffer = $this->db->row('SELECT name, surname, card FROM users WHERE id = :ref', $params)[0];
				if(!empty($reffer)) {
				$arr[$key]['ref'] = $reffer['surname'].' '.$reffer['name'].' '.$reffer['card']; }
				else {
					$arr[$key]['ref'] = 'нет';
				}
				}

		}
		return $arr;
	}

	public function addclient($post)
	{
		$token = $this->createToken();
		$params = [
			'id' =>'',
			'email' => $post['email'],
			'phone' => $post['phone'],
			'card' => random_int(10000000, 99999999),
			'password' => password_hash($post['phone'], PASSWORD_BCRYPT),
			'ref' => 0,
			'refBalance' => 0,
			'token' => $token,
			'status' => 0,
			'name' => $post['name'],
			'surname' => $post['surname'],
			'bonuse' => 0,
			'avatar' => 'noavatar.png',
		];
		$siteURL='http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['HTTP_HOST'].'/'; echo $siteURL;
		$this->db->query('INSERT INTO users VALUES (:id, :email, :phone, :card, :password, :ref, :refBalance, :token, :status, :name, :surname, :bonuse, :avatar)', $params);
		mail($post['email'], 'Register', 'Пройдите по ссылке для подтверждения учетной записи: '.$siteURL.'account/confirm/'.$token);
		unset($post); //Уничтожаем старые данные, чтобы не было ошибок при повторной регистрации реферала не выходя со страницы
	}

	public function addservice($post)
	{
		$params = [
			'id' =>'',
			'title' => $post['title'],
			'price' => $post['price'],
			'description' => $post['description'],
			'category' => $post['category'],
			'label' => '',
			'img' => 'noimg.png',
		];
		if($this->db->query('INSERT INTO prices VALUES (:id, :title, :price, :description, :category, :label, :img)', $params))
		{
			unset($post); //Уничтожаем старые данные, чтобы не было ошибок при повторной регистрации реферала не выходя со страницы
			return true;
		}
		else
		{
			return false;
		}
		
		
	}	

		public function checkEmailExists($email)
	{
		$params =[
			'email' => $email,
		];
		return $this->db->column('SELECT id FROM users WHERE email = :email', $params);
	}

	public function checkPhoneExists($phone)
	{
		$params =[
			'phone' => $phone,
		];
		if ($this->db->column('SELECT id FROM users WHERE phone = :phone', $params))
		{
			$this->error = 'Этот Телефон уже используется';
			return false;
		}
		return true;
	}

	public function checkTitleExists($title)
	{
		$params =[
			'title' => $title,
		];
		if ($this->db->column('SELECT id FROM prices WHERE title = :title', $params))
		{
			$this->error = 'Эта услуга уже существует';
			return false;
		}
		return true;
	}

	public function createToken()
	{
		return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyz', 30)), 0, 30);
	}

	public function checkRefExists($phone)
		{
		$params = [
			'phone' => $phone,
		];
		return $this->db->column('SELECT id FROM users WHERE phone = :phone', $params);
	}

	public function clientprofile($id)
	{
		$params = [
			'id' => $id,
		];
		return $this->db->row('SELECT * FROM users WHERE id = :id', $params);
	}

	public function checkDate($date)
	{
		//date('d.m.Y', $val['unixTime']);
		
		//$timestamp = strtotime($date);
		$params = [
			'daty'=> $date,
		];

		return $this->db->row('SELECT * FROM visits WHERE datevisit = :daty', $params);
	}

	public function setClient()
	{
		return $this->db->row('SELECT * FROM users ORDER BY surname');
	}

	public function setService()
	{
		return $this->db->row('SELECT * FROM prices ORDER BY category');
	}

	public function setMasters()
	{
		return $this->db->row('SELECT * FROM masters ORDER BY category');
	}

	public function setTime($chislo)
	{
		$freetime = [
			'a' => '0800',
			'b' => '0830',
			'c' => '0900',
			'd' => '0930',
			'e' => '1000',
			'f' => '1030',
			'g' => '1100',
			'h' => '1130',
			'i' => '1200',
			'j' => '1230',
			'k' => '1300',
			'l' => '1330',
			'm' => '1400',
			'n' => '1430',
			'o' => '1500',
			'p' => '1530',
			'q' => '1600',
			'r' => '1630',
			's' => '1700',
			't' => '1730',
			'u' => '1800',
			'v' => '1830',
			'w' => '1900',
			'x' => '1930',
			'y' => '2000',
			'z' => '2030',
			'z1' => '2100',
			'z2' => '2130',
			'z3' => '2200',
			'z4' => '2230',
			'z5' => '2300',
			'z6' => '2330'
		];
		
		$params = [
			'data' => $chislo,
		];
		$b = $this->db->row('SELECT * FROM visits WHERE datevisit = :data ORDER BY timevisit', $params);
		foreach ($b as $key => $value) {
			$c[] = $value['timevisit'];
		}
		return $freetime;//return array_diff($freetime, $c);
	}

	public function checkClientExists($client)
	{
		$params =[
			'client' => $client,
		];
		if ($this->db->row('SELECT id FROM users WHERE phone = :client', $params))
		{
			return true;
		}
		return false;
	}

	public function checkDateTimeExists()
	{
		$params =[
			'data' => $_POST['date'],
			'timevisit' => $_POST['time']
		];
		if ($this->db->row('SELECT * FROM visits WHERE datevisit = :data AND timevisit = :timevisit' , $params))
		{
			return true;
		}
		return false;
	}

	public function createVisit($data, $tarif)
		{
			$params = [
				'id' => '',
				'uid' => '',
				'sum' => round($data['amount'], 2),
				'sale' => 0,
				'timeIn' => time(),
				'timevisit'=> 1230,
				'datevisit' => date('Ymd'),
				'added' => 0,
				'service' => $data['service'],
				'master' => 0,
			];
			$this->db->query('INSERT INTO visits VALUES (:id, :uid, :sum, :sale, :timeIn, :timevisit, :datevisit, :added, :service, :master)', $params);
			
			$params = [
				'id' => '',
				'uid' => $data['uid'],
				'unixTime' => time(),
				'description' => 'Заявка посещение # '.$this->db->lastInsertId(),
			];
			$this->db->query('INSERT INTO history VALUES (:id, :uid, :unixTime, :description)', $params);
			mail('leninart@mail.ru', 'Заявка на посещение', $params["description"]);
			?>
			<script language="JavaScript" type="text/javascript">
function changeurl(){eval(self.location="/dashboard/services");}
window.setTimeout("changeurl();",0);
</script><?php
}


}
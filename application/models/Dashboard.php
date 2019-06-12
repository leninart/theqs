<?php

namespace application\models;

use application\core\Model;

class Dashboard extends Model {

	public function getPrice() {
		$result = $this->db->row('SELECT * FROM prices');
		return $result;
	}
	
	public function historyCount()
	{
		$params = [
			'uid' => $_SESSION['account']['id'],
		];
		return $this->db->column('SELECT COUNT(id) FROM history WHERE uid = :uid', $params);
	}

		public function historyList($route)
	{
		$max = 10;
		$params = [
			'max' => $max,
			'start' => ((($route['page'] ?? 1) - 1) * $max),
			'uid' => $_SESSION['account']['id'],
		];
		return $this->db->row('SELECT * FROM history WHERE uid = :uid ORDER BY id DESC LIMIT :start, :max', $params);
	}

	public function referralsCount()
	{
		$params = [
			'uid' => $_SESSION['account']['id'],
		];
		return $this->db->column('SELECT COUNT(id) FROM users WHERE ref = :uid', $params);
	}

	public function referralsList()
	{

		$params = [
			'uid' => $_SESSION['account']['id'],
		];
		return $this->db->row('SELECT card, email FROM users WHERE ref = :uid ORDER BY id', $params);
	}

	public function servicesCount()
	{
		$params = [
			'uid' => $_SESSION['account']['id'],
		];
		return $this->db->column('SELECT COUNT(id) FROM tariffs WHERE uid = :uid', $params);
	}

	public function servicesList($route)
	{
		$max = 10;
		$params = [
			'max' => $max,
			'start' => ((($route['page'] ?? 1) - 1) * $max),
			'uid' => $_SESSION['account']['id'],
		];
		return $this->db->row('SELECT * FROM tariffs WHERE uid = :uid ORDER BY id DESC LIMIT :start, :max', $params);
	}

	public function creatRefWithdraw() {
		$amount = $_SESSION['account']['refBalance'];
		$_SESSION['account']['refBalance'] = 0;
		
		$params = [
			'id' => $_SESSION['account']['id'],
		];
		$this->db->query('UPDATE users SET refBalance = 0 WHERE id = :id', $params);

		$params = [
			'id' => '',
			'uid' => $_SESSION['account']['id'],
			'unixTime' => time(),
			'amount' => $amount,
		];
		$this->db->query('INSERT INTO ref_withdraw VALUES (:id, :uid, :unixTime, :amount)', $params);

		$params = [
			'id' => '',
			'uid' => $_SESSION['account']['id'],
			'unixTime' => time(),
			'description' => 'Вывод реферального вознаграждения, сумма '.$amount.' баллов',
		];
		$this->db->query('INSERT INTO history VALUES (:id, :uid, :unixTime, :description)', $params);
	}

	public function validatePerfectMoney($post, $tariff)
		{
				$params =
				$post['PAYMENT_ID'].':'.
				$post['PAYEE_ACCOUNT'].':'.
				$post['PAYMENT_AMOUNT'].':'.
				$post['PAYMENT_UNITS'].':'.
				$post['PAYMENT_BATCH_NUM'].':'.
				$post['PAYMENT_ACCOUNT'].':'.
				strtoupper(md5('secret')).':'.
				$post['TIMESTAMPGMT'];
			list($tid, $uid) = explode(',', $post['PAYMENT_ID']);
				//Делаем числами
				$tid += 0;
				$uid += 0;
				$amount = $post['PAYMENT_AMOUNT'] + 0;
				//Делаем числами
			//if (strtoupper(md5($params)) != $post['V2_HASH'])
			//	{
			//		return false;
			//	}
			if ($post['PAYMENT_UNITS'] != 'USD') //проверяем валюту
				{
					return false;
				}
			elseif (!isset($tariff[$tid]))
				{
					return false;
				}
			elseif ($amount != $tariff[$tid]['price'])
				{
					return false;
				}
			return 
				[
					'tid' => $tid,
					'uid' => $uid,
					'amount' => $amount,
				];
		}
		public function validateVisit($post, $tariff)
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

		public function createVisit($data, $tarif)
		{
			$dataRef = $this->db->column('SELECT ref FROM users WHERE id = :id', ['id' => $data['uid']]);
			if ($dataRef === false)
			{ return false;}
		if ($dataRef != 0)
			{
				$refSum = round((($data['amount'] * 3) /100), 2);
				$params = [
					'sum' => $refSum,
					'id' => $dataRef,
				];
				$this->db->query('UPDATE users SET refBalance = refBalance + :sum WHERE id = :id', $params);
				$params = [
					'id' => '',
					'uid' => $dataRef,
					'unixTime' => time(),
					'description' => 'Реферальное вознаграждение, сумма '.$refSum.' $',
				];
			$this->db->query('INSERT INTO history VALUES (:id, :uid, :unixTime, :description)', $params);
			}
			$params = [
				'id' => '',
				'uid' => $data['uid'],
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

		public function createTariff($data, $tarif)
		{
			$dataRef = $this->db->column('SELECT ref FROM users WHERE id = :id', ['id' => $data['uid']]);
			if ($dataRef === false)
			{ return false;}
		if ($dataRef != 0)
			{
				$refSum = round((($data['amount'] * 5) /100), 2);
				$params = [
					'sum' => $refSum,
					'id' => $dataRef,
				];
				$this->db->query('UPDATE users SET refBalance = refBalance + :sum WHERE id = :id', $params);
				$params = [
					'id' => '',
					'uid' => $dataRef,
					'unixTime' => time(),
					'description' => 'Реферальное вознаграждение, сумма '.$refSum.' $',
				];
			$this->db->query('INSERT INTO history VALUES (:id, :uid, :unixTime, :description)', $params);
			}
			$params = [
				'id' => '',
				'uid' => $data['uid'],
				'sumIn' => round($data['amount'], 2),
				'sumOut' => round($data['amount'], 2),
				'percent' => $tarif['percent'],
				'unixTimeStart' => time(),
				'unixTimeFinish' => time(),

			];
			$this->db->query('INSERT INTO tariffs VALUES (:id, :uid, :sumIn, :sumOut, :percent, :unixTimeStart, :unixTimeFinish)', $params);
			
			$params = [
				'id' => '',
				'uid' => $data['uid'],
				'unixTime' => time(),
				'description' => 'Заявка на абонимент # '.$this->db->lastInsertId(),
			];
			$this->db->query('INSERT INTO history VALUES (:id, :uid, :unixTime, :description)', $params);
			mail('alinaevent@mail.ru', 'Заявка на покупку абонемента', $params["description"]);
			?>
			<script language="JavaScript" type="text/javascript">
function changeurl(){eval(self.location="/dashboard/services");}
window.setTimeout("changeurl();",0);
</script><?php
		}
	
}
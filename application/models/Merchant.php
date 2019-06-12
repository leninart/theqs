<?php

namespace application\models;

use application\core\Model;

class Merchant extends Model {

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
				'description' => 'Инвестиция, номер вклада # '.$this->db->lastInsertId(),
			];
			$this->db->query('INSERT INTO history VALUES (:id, :uid, :unixTime, :description)', $params);
		}

		public function validateVisit($post, $tariff)
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

		public function createVisit($data, $tarif)
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
				'description' => 'Инвестиция, номер вклада # '.$this->db->lastInsertId(),
			];
			$this->db->query('INSERT INTO history VALUES (:id, :uid, :unixTime, :description)', $params);
		}
}
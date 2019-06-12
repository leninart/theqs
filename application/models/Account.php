<?php

namespace application\models;

use application\core\Model;

class Account extends Model
{
	public function validate($input, $post)
	{
		$rules = [
			'email' => [
				'pattern' => '#^([a-z0-9_.-]{1,20}+)@([a-z0-9_.-]+)\.([a-z\.]{2,10})$#',
				'message' => 'E-mail адрес введен некоррекно',
			],
			'phone' => [
				'pattern' =>'#^[0-9]{10,10}$#',
				'message' => 'Телефон указан неверно (разрешены только цифры 10 символов) 9279998877',
			],
			'ref' => [
				'pattern' =>'#^[0-9none]{0,12}$#',
				'message' => 'Телефон пригласившего указан неверно',
			],
			'card' => [
				'pattern' => '#^[0-9]{3,15}$#',
				'message' => 'Карта указана неверно',
			],
			'password' => [
				'pattern' => '#^[a-z0-9]{6,30}$#',
				'message' => 'Пароль указан неверно (разрешены только латинские буквы и цифры от 6 до 20 символов)',
			],
			'promo' => [
				'pattern' =>'#^[0-9]{4,4}$#',
				'message' => 'Некорректный промокод',
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

	public function sendsms($phone, $msg)
	{
					$phone = '8'.$phone;
	 				$device = '111797';  // Код вашего устройства
	 				$token = '18f825b6746b65202aa60a9a7c4f8881';  // Ваш токен (секретный)

					 $sms = array(
	        "phone" => $phone,
	 				       "msg" => $msg,
					        "device" => $device,
					        "token" => $token
					    );

		$url = "https://semysms.net/api/3/sms.php"; //Адрес url для отправки СМС
		$curl = curl_init($url);
	    curl_setopt($curl, CURLOPT_POST, true);
	    curl_setopt($curl, CURLOPT_POSTFIELDS, $sms);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);     
	    $output = curl_exec($curl);
	    curl_close($curl);
	}

	public function checkEmailExists($email)
	{
		$params =[
			'email' => $email,
		];
		if ($this->db->column('SELECT email FROM users WHERE email = :email', $params))
		{
			$this->error = 'Этот Email уже используется';
			return false;
		}
		return true;
	}

	public function checkPhoneExists($phone)
	{
		$params =[
			'phone' => $phone,
		];
		if ($this->db->column('SELECT phone FROM users WHERE phone = :phone', $params))
		{
			$this->error = 'Этот Телефон уже используется';
			return false;
		}
		return true;
	}

	public function checkSms($phone, $email)
	{
		if(!isset($_SESSION['check'][$phone]))
		{
			$sms = random_int(1000, 9999); //.'проверочный код theqs.ru'
			$_SESSION['check'][$phone] = $sms;
			$this->sendsms($phone, $sms);
			//mail($email, 'Активация промокода', 'Введите '.$sms.' для активации промокода.');
			mail('oborona.sound@gmail.com', 'Попытка регистрации '.$phone, 'Клиент '.$phone.' сделал попытку зарегистрировать промокод! Проконтролируйте процесс!');
			mail('alinaevent@mail.ru', 'Попытка регистрации '.$phone, 'Клиент '.$phone.' сделал попытку зарегистрировать промокод! Проконтролируйте процесс!');
			return true;
		}
		return false;
	}

	public function validateSMS($code, $phone)
	{
		if ($code == $_SESSION['check'][$phone])
		{		
			return true;
		}
		return false;

	}

		public function checkTokenExists($token)
	{
		$params =[
			'token' => $token,
		];
		return $this->db->column('SELECT id FROM users WHERE token = :token', $params);
	}

		public function activate($token)
	{
		$params = [
			'token' => $token,
		];
		$this->db->query('UPDATE users SET status = 1, token = "" WHERE token = :token', $params);
	}

		public function checkRefExists($phone)
		{
		$params = [
			'phone' => $phone,
		];
		return $this->db->column('SELECT id FROM users WHERE phone = :phone', $params);
	}

	public function createToken()
	{
		return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyz', 30)), 0, 30);
	}

	public function momentRegister($post)
	{
		$token = $this->createToken();
		if ($post['ref'] == 'none')
		{
			$ref = 0;
		} else
		{
			$ref = $this->checkRefExists($post['ref']);
			if (!$ref)
			{
				$ref = $post['ref'];
			}
		}
		$params = [
			'id' =>'',
			'email' => $post['email'],
			'phone' => $post['phone'],
			'card' => random_int(10000000, 99999999),
			'password' => password_hash($post['phone'], PASSWORD_BCRYPT),
			'ref' => $ref,
			'refBalance' => 0,
			'token' => $post['promo'],
			'status' => 0,
			'name' => $post['name'],
			'surname' => $post['surname'],
			'bonuse' => 200,
			'avatar' => 'lalala.jpg',
		];
		$this->db->query('INSERT INTO users VALUES (:id, :email, :phone, :card, :password, :ref, :refBalance, :token, :status, :name, :surname, :bonuse, :avatar)', $params);
		
		mail('alinaevent@mail.ru', 'Новый клиент!', 'Позвоните: '.$post['phone'].' и пригласите потратить свое вознаграждение по промокоду '.$post['promo']);
		
	}

	public 	function addAdminWith($post)
	{
		$params = [
				'phone' => $post['phone'],
		];
		$data = $this->db->row('SELECT * FROM users WHERE phone = :phone', $params);
		$data = $data[0];

			$vars = [
			'id' => '',
			'uid' => $data['id'],
			'unixTime' => time(),
			'description' => 'Заявка на прмокод '.$post['promo'].' подана, клиент '.$data['surname'].' '.$data['name'],
		];
		$this->db->query('INSERT INTO history VALUES (:id, :uid, :unixTime, :description)', $vars);

$dars = [
				'id' => '',
				'uid' => $data['id'],
				'sumIn' => $post['promo'],
				'sumOut' => 999,
				'percent' => 999,
				'unixTimeStart' => time(),
				'unixTimeFinish' => time(),
			];
			$this->db->query('INSERT INTO tariffs VALUES (:id, :uid, :sumIn, :sumOut, :percent, :unixTimeStart, :unixTimeFinish)', $dars);
			unset($post); //Уничтожаем старые данные, чтобы не было ошибок при повторной регистрации реферала не выходя со страницы
			return true;
	}

	public function register($post)
	{
		$token = $this->createToken();
		if ($post['ref'] == 'none')
		{
			$ref = 0;
		} else
		{
			$ref = $this->checkRefExists($post['ref']);
			if (!$ref)
			{
				$ref = 0;
			}
		}
		$params = [
			'id' =>'',
			'email' => $post['email'],
			'phone' => $post['phone'],
			'card' => $post['card'],
			'password' => password_hash($post['password'], PASSWORD_BCRYPT),
			'ref' => $ref,
			'refBalance' => 0,
			'token' => $token,
			'status' => 0,
			'name' => '',
			'surname' => '',
			'bonuse' => 0,
			'avatar' => 'lalala.jpg',
		];
		$siteURL='http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['HTTP_HOST'].'/';
		$this->db->query('INSERT INTO users VALUES (:id, :email, :phone, :card, :password, :ref, :refBalance, :token, :status, :name, :surname, :bonuse, :avatar)', $params);
		mail($post['email'], 'Register', 'Confirm: '.$siteURL.'account/confirm/'.$token);
		unset($post); //Уничтожаем старые данные, чтобы не было ошибок при повторной регистрации реферала не выходя со страницы
	}

	public function checkData($phone, $password)
	{
		$params =[
			'phone' => $phone,
		];

		$hash = $this->db->column('SELECT password FROM users WHERE phone = :phone', $params);

		if (!$hash or !password_verify($password, $hash))
		{
			return false;
		}
		return true;
	}

	public function checkStatus($type, $data)
	{
		$params =[
			$type => $data,
		];
		$status = $this->db->column('SELECT status FROM users WHERE '.$type.' = :'.$type, $params);
		if ($status != 1)
		{
			$this->error = 'Аккаунт ожидает подтверждения по email';
			return false;
		}
		return true;
	}

	public function login($phone)
	{
		$params =[
			'phone' => $phone,
		];
		$data = $this->db->row('SELECT * FROM users WHERE phone = :phone', $params);
		$_SESSION['account'] = $data[0]; //Ноль так ккак в именно в этом ключике хранятся все данные
 	}

 	public function recovery($post)
 	{
 			$token = $this->createToken();
			$params = [
			'email' => $post['email'],
			'token' => $token,
		];
		$siteURL='http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['HTTP_HOST'].'/'; echo $siteURL;
		$this->db->query('UPDATE users SET token = :token WHERE email = :email', $params);
		mail($post['email'], 'Recovery', 'Confirm: '.$siteURL.'account/reset/'.$token);
 	}

	public function reset($token)
	{
		$new_password = $this->createToken();

		$params = [
			'token' => $token,
			'password' => password_hash($new_password, PASSWORD_BCRYPT),
		];
		$this->db->query('UPDATE users SET status = 1, token = "", password = :password WHERE token = :token', $params);
		return $new_password;
	}

	public function save($post)
	{
		$params = [
				'id' => $_SESSION['account']['id'],
				'email' => $post['email'],
			];
		if (!empty($post['password']))
			{
				$params['password'] = password_hash($post['password'], PASSWORD_BCRYPT);
				$sql = ',password = :password';
				header("Refresh:0");
			}
			else
			{
				$sql = '';
			}
			foreach ($params as $key => $val) {
				$_SESSION['account'][$key] = $val;
			}
		$this->db->query('UPDATE users SET email = :email'.$sql.' WHERE id = :id', $params);
	}
	public function saveAvatar($name)
	{
		$params = [
				'id' => $_SESSION['account']['id'],
				'avatar' => $name,
			];
		$this->db->query('UPDATE users SET avatar = :avatar WHERE id = :id', $params);
		$_SESSION['account']['avatar'] = $name;
	}

	/*
  $x_o и $y_o - координаты левого верхнего угла выходного изображения на исходном
  $w_o и h_o - ширина и высота выходного изображения
  */
  public function cropAvatar($image, $x_o, $y_o, $w_o, $h_o) {
    if (($x_o < 0) || ($y_o < 0) || ($w_o < 0) || ($h_o < 0)) {
      echo "Некорректные входные параметры";
      return false;
    }
    list($w_i, $h_i, $type) = getimagesize($image); // Получаем размеры и тип изображения (число)
    $types = array("", "gif", "jpeg", "png"); // Массив с типами изображений
    $ext = $types[$type]; // Зная "числовой" тип изображения, узнаём название типа
    if ($ext) {
      $func = 'imagecreatefrom'.$ext; // Получаем название функции, соответствующую типу, для создания изображения
      $img_i = $func($image); // Создаём дескриптор для работы с исходным изображением
    } else {
      echo 'Некорректное изображение'; // Выводим ошибку, если формат изображения недопустимый
      return false;
    }
    if ($x_o + $w_o > $w_i) $w_o = $w_i - $x_o; // Если ширина выходного изображения больше исходного (с учётом x_o), то уменьшаем её
    if ($y_o + $h_o > $h_i) $h_o = $h_i - $y_o; // Если высота выходного изображения больше исходного (с учётом y_o), то уменьшаем её
    $img_o = imagecreatetruecolor($w_o, $h_o); // Создаём дескриптор для выходного изображения
    imagecopy($img_o, $img_i, 0, 0, $x_o, $y_o, $w_o, $h_o); // Переносим часть изображения из исходного в выходное
    $func = 'image'.$ext; // Получаем функция для сохранения результата
    return $func($img_o, $image); // Сохраняем изображение в тот же файл, что и исходное, возвращая результат этой операции
  }

  /*
  $w_o и h_o - ширина и высота выходного изображения
  */
  public function resizeAvatar($image, $w_o = false, $h_o = false) {
    if (($w_o < 0) || ($h_o < 0)) {
      echo "Некорректные входные параметры";
      return false;
    }
    list($w_i, $h_i, $type) = getimagesize($image); // Получаем размеры и тип изображения (число)
    $types = array("", "gif", "jpeg", "png"); // Массив с типами изображений
    $ext = $types[$type]; // Зная "числовой" тип изображения, узнаём название типа
    if ($ext) {
      $func = 'imagecreatefrom'.$ext; // Получаем название функции, соответствующую типу, для создания изображения
      $img_i = $func($image); // Создаём дескриптор для работы с исходным изображением
    } else {
      echo 'Некорректное изображение'; // Выводим ошибку, если формат изображения недопустимый
      return false;
    }
    /* Если указать только 1 параметр, то второй подстроится пропорционально */
    if (!$h_o) $h_o = $w_o / ($w_i / $h_i);
    if (!$w_o) $w_o = $h_o / ($h_i / $w_i);
    $img_o = imagecreatetruecolor($w_o, $h_o); // Создаём дескриптор для выходного изображения
    imagecopyresampled($img_o, $img_i, 0, 0, 0, 0, $w_o, $h_o, $w_i, $h_i); // Переносим изображение из исходного в выходное, масштабируя его
    $func = 'image'.$ext; // Получаем функция для сохранения результата
    return $func($img_o, $image); // Сохраняем изображение в тот же файл, что и исходное, возвращая результат этой операции
  }
  

	public function updateBalance()
	{
		$params =[
			'id' => $_SESSION['account']['id'],
		];
		$data = $this->db->row('SELECT * FROM users WHERE id = :id', $params);
		$_SESSION['account'] = $data[0]; //Ноль так ккак в именно в этом ключике хранятся все данные
 	}


}
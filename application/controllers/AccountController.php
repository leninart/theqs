<?php

namespace application\controllers;

use application\core\Controller;

class AccountController extends Controller {

	//Регистрация

	public function registerAction()
	{
		if(!empty($_POST))
		{
			if(!$this->model->validate(['email', 'phone',  'card', 'password', 'ref'], $_POST))
					{
						$this->view->message('error', $this->model->error);
					}
			elseif(!$this->model->checkEmailExists($_POST['email']))
					{
						$this->view->message('error', $this->model->error);
					}
			elseif(!$this->model->checkPhoneExists($_POST['phone']))
					{
						$this->view->message('error', $this->model->error);
					}

					$this->model->register($_POST);
					$this->view->message('success', 'Регистрация завершена, проверьте свой почтовый ящик и подтвердите EMAIL');
					}

		$this->view->render('Регистрация');
	}

	public function momentAction()
	{
		if(!empty($_POST))
		{
			if(!$this->model->validate(['phone', 'promo', 'ref', 'email'], $_POST))
					{
						$this->view->message('error', $this->model->error);
					}
			elseif(!$this->model->checkPhoneExists($_POST['phone']))
					{
						$this->view->message('error', 'Этот промокод только для новых клиентов');
					}
			elseif(!$this->model->checkEmailExists($_POST['email']))
					{
						$this->view->message('error', $this->model->error);
					}
			elseif($this->model->checkSms($_POST['phone'], $_POST['email']))
					{
						$this->view->message('success', 'Теперь введите код из SMS');
					}
			elseif(!$this->model->validateSMS($_POST['code'], $_POST['phone']))
				{
					unset($_SESSION['check'][$_POST['phone']]);
					$this->model->checkSms($_POST['phone']);
					$this->view->message('error', 'Неверный код из SMS. Ожидайте новый код.');
				}
			elseif(!$this->model->checkPhoneExists($_POST['phone']))
					{
						$this->view->message('error', 'Этот промокод только для новых клиентов');
					}
			elseif(!$this->model->checkEmailExists($_POST['email']))
					{
						$this->view->message('error', $this->model->error);
					}
					$this->model->momentRegister($_POST);
					$this->model->addAdminWith($_POST);	
					$this->view->message('Success', 'Телефон '.$_POST['phone'].' подтвержден');


					}
		unset($_SESSION['check']);
		$this->view->render('Регистрация');
	}

	public function confirmAction()
	{
			if(!$this->model->checkTokenExists($this->route['token']))
					{
						$this->view->redirect('account/login');
					}
					$this->model->activate($this->route['token']);
					$this->view->render('Аккаунт активирован');
	}

	public function agreementAction()
	{
			$this->view->render('ПОЛЬЗОВАТЕЛЬСКОЕ СОГЛАШЕНИЕ САЛОНА КРАСОТЫ «TheQueenStudio»');
	}

	public function confidentialAction()
	{
					$this->view->render('Политика конфиденциальности');
	}

//Вход

	public function loginAction()
	{
		if(!empty($_POST))
		{
			if(!$this->model->validate(['phone', 'password'], $_POST))
					{
						$this->view->message('error', $this->model->error);
					}
			elseif(!$this->model->checkData($_POST['phone'], $_POST['password']))
					{
						$this->view->message('error', 'Телефон или пароль указан неверно');
					}
			elseif(!$this->model->checkStatus('phone', $_POST['phone']))
					{
						$this->view->message('error', $this->model->error);
					}
					$this->model->login($_POST['phone']);
					$this->view->location('account/profile');
			}

		$this->view->render('Вход');
	}

//Профиль
	public function profileAction()
	{
		if(!empty($_POST))
			{
				if(!$this->model->validate(['email'], $_POST)) /* Там, где email можно перечислить несколько значений для проверки на странице profile */
						{
							$this->view->message('error', $this->model->error);
						}
				$id = $this->model->checkEmailExists($_POST['email']); 
				if ($id and $id != $_SESSION['account']['id'])
						{
							$this->view->message('error', 'Этот E-mail уже используется');
						}
				if (!empty($_POST['password']) and !$this->model->validate(['password'], $_POST))
						{
							$this->view->message('error', $this->model->error);
						}

				$this->model->save($_POST);
				$this->model->updateBalance();
				$this->view->message('success', 'Отлично');
			}
		$this->view->render('Профиль');
	}

	public function logoutAction()
	{
		unset($_SESSION['account']);
		session_destroy();
		$this->view->redirect('');
	}

	public function recoveryAction()
	{
		if(!empty($_POST))
		{
			if(!$this->model->validate(['email'], $_POST))
					{
						$this->view->message('error', $this->model->error);
					}
			elseif(!$this->model->checkEmailExists($_POST['email']))
					{
						$this->view->message('error', 'Пользователь не найден');
					}
			elseif(!$this->model->checkStatus('email', $_POST['email']))
					{
						$this->view->message('error', $this->model->error);
					}

					$this->model->recovery($_POST);
					$this->view->message('Success', 'Запрос на восстановление пароля отправлен на EMAIL');
					}

		$this->view->render('Восстановление пароля');
	}

	public function resetAction()
	{
			if(!$this->model->checkTokenExists($this->route['token']))
					{
						$this->view->redirect('account/login');
					}
					$password = $this->model->reset($this->route['token']);
					$vars = [
						'password' => $password,
					];
					$this->view->render('Пароль сброшен', $vars);
	}

	public function downloadAction()
	{
// Перезапишем переменные для удобства
$filePath  = $_FILES['upload']['tmp_name'];
$errorCode = $_FILES['upload']['error'];
// Проверим на ошибки
if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {
    // Массив с названиями ошибок
    $errorMessages = [
        UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
        UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
        UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично.',
        UPLOAD_ERR_NO_FILE    => 'Файл не был загружен.',
        UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
        UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
        UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла.',
    ];
    // Зададим неизвестную ошибку
    $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';
    // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
    $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;
    // Выведем название ошибки
    die($outputMessage);
}
// Создадим ресурс FileInfo
$fi = finfo_open(FILEINFO_MIME_TYPE);
// Получим MIME-тип
$mime = (string) finfo_file($fi, $filePath);
// Закроем ресурс
finfo_close($fi);
// Проверим ключевое слово image (image/jpeg, image/png и т. д.)
if (strpos($mime, 'image') === false) die($this->view->message('error', 'Можно загружать только изображения.'));
// Результат функции запишем в переменную
$image = getimagesize($filePath);
// Зададим ограничения для картинок
$limitBytes  = 1024 * 1024 * 50;
$limitWidth  = 5000;
$limitHeight = 5000;
// Проверим нужные параметры
if (filesize($filePath) > $limitBytes) die($this->view->message('error', 'Размер изображения не должен превышать 5 Мбайт.'));
if ($image[1] > $limitHeight)          die($this->view->message('error', 'Высота изображения не должна превышать 768 точек.'));
if ($image[0] > $limitWidth)           die($this->view->message('error', 'Ширина изображения не должна превышать 1280 точек.'));
// Сгенерируем новое имя файла на основе MD5-хеша
$name = $_SESSION['account']['id'];
// Сгенерируем расширение файла на основе типа картинки
$extension = image_type_to_extension($image[2]);
// Сократим .jpeg до .jpg
$format = str_replace('jpeg', 'jpg', $extension);
/* Вызываем функцию с целью уменьшить изображение до ширины в 100 пикселей, а высоту уменьшив пропорционально, чтобы не искажать изображение */
$this->model->resizeAvatar($filePath, 204); // Вызываем функцию
$this->model->cropAvatar($filePath, 0, 0, 204, 204); // Вызываем функцию для обрезки
// Переместим картинку с новым именем и расширением в папку /pics
if (!move_uploaded_file($filePath, '/home/p363353/www/theqs.ru/public/img/avatar/' . $name . $format)) {
    die($this->view->message('error', 'При записи изображения на диск произошла ошибка.'));
}
$this->model->saveAvatar($name.$format);
$this->view->message('success', 'Фото загружено');
	}


}
<?php
ini_set("display_errors", 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
/**
 * 1.7.0 изменения:
 * Новое: добавлена возможность настроить свои дополнительные поля формы комментирования;
 * Новое: обработчик инф.сообщений вынесен в отдельную функцию для удобства перегрузки;
 * Новое: в обязательные для заполнения поля добавлен HTML5-параметр "required";
 * Новое: добавлена настройка формата отображения даты комментария;
 * Новое: добавлена настройка флуд-контроля;
 * FIX: дублируется HTTP_REFERER на аварийный случай (не поддерживается браузером или режется файрволлом);
 * FIX: исправлена ошибка дополнительных search параметров страницы, которые могли бы участвовать в формировании ref;
 * FIX: исправлено формирование обратной ссылки в нотификации.
 *
 * 1.7.1 Изменения:
 * FIX: баг с обратной ссылкой в нотификации;
 * FIX: баг с серверной интеграцией, когда не формировался http_ref - не сохранялись комменты с первого раза или не проходили бот-проверку;
 * FIX: лишнее сообщение об отписке при первом комменте;
 *
 * 1.7.2 Изменения:
 * NEW: убрана проверка флуд-контроля для администратора и добавлена возможность вывода таймера до снятия флуд контроля;
 * FIX: баг с именем сервера в обратной ссылке нотификации;
 * FIX: обработка переносов строк при редактировании сообщений;
 *
 * 1.7.3 Изменения:
 * NEW: автозаполнение формы комментариев данными администратора при наличии авторизации.
 * NEW: возможность блокировки комментирования с отключением формы (отображается только для модератора).
 * NEW: возможность отключения граватара (плюс измененные стили).
 * NEW: для удобства интеграции и написания плагинов все методы сделаны публичными.
 * NEW: дополнительное индексирование комментариев. Создается отдельный файл со статистикой по всем обновленным страницам.
 *
 * 1.8.0 Изменения:
 * NEW: добавлена опция на сохранение и отображение ip-адреса комментатора.
 * NEW: добавлена возможность вести глобальный черный список адресов. Добавлена возможность бана и разбана адреса из комментария.
 * NEW: множественный запуск на одной странице. Изменен формат инициализации скрипта.
 *
 * 1.8.1 Изменения:
 * FIX: Корректно обрабатываются собственные ссылки. Отрабатывает пагинация, а результат операций доступен только через AJAX запрос;
 * FIX: Корректное имя страницы в нотификации;
 * FIX: Упразднены опции admin_answer_only и answer_only_top;
 *
 * 1.9.0 Изменения:
 * REF: Магический _get разнесен на отдельные методы
 * NEW: Добавлена возможность отписаться от уведомлений по ссылки из письма с нотификацией
 *
 * 1.9.1 Изменения:
 * NEW: Добавлена возможность автозаполнения формы значениями из Cookies
 * NEW: Добавлена настройка spec_char_replace для включения и отключения замены спецсимволов в сообщении;
 * NEW: Автор может видеть свои не прошедние модерацию комментарии;
 * NEW: Добавлена настройка временного пояса;
 * FIX: Усложнена проверка мейла на валидность;
 * REF: Упразднен метод get_timeid();
 * todo: антибот ослаблен
 *
 * 1.9.2 Изменения:
 * FIX: убраны хвосты совместимости числовых форматов в старом варианте идентификаторов постов;
 * FIX: убраны уведомления о неудачной отправке нотификаций на почту;
 * FIX: исправлен баг с подпиской первого комментатора;
 *
 * 1.9.3 Изменения:
 * FIX: добавлено логирование случаев, когда мейл не прошел валидацию
 * FIX: исправлены заголовки нотификаций для корректной работы с mail.ru
 * FIX: добавлены корневые html-теги в тело письма для повышения валидности
 */
class ecomment {
	private $version = '1.9.3'; //версия скрипта

	//основные настройки
	private $store = '/store/'; //путь до директории хранения файлов с комментариями. Директория должна существовать и иметь достаточные права доступа.
	private $moderate = true; //премодерация - если true, то сообщения попадают в публичный список только после утверждения модератором.
	private $notify = true; //уведомление о новых комментах
	private $subscribe_allowed = true; //разрешить подписку на комментарии
	private $flood_control = 60; //контроль флуда, в секундах. Время, которое должно пройти между публикациями одного автора. Ноль для отключения.
	private $show_flood_control_timeout = true; //показывать ли при неудачной проверке флуд-контроля оставшееся время.
	private $spec_char_replace = true; //замена спецсимволов в сообщении на html-сущности.
	private $default_timezone = ''; //принудительная установка часового пояса. Например 'Europe/Moscow'

	private $password = 'admin'; //пароль администратора. Рекомендуется сменить после установки.
	private $form_autofill = true; //автозаполнение формы данными админа при наличии авторизации
	private $admin_name = 'Администратор'; //имя администратора, которое будет использоваться для автозаполнения формы
	private $salt = '8f56eeedf73175082gg8f4c4fceef4f86'; //секретный ключ шифрования. Желательно сменить перед началом использования скрипта.
	private $query = 'primer,test'; //переменные из запроса, которые могут определять уникальность страницы (через запятую)
	private $rating = true; //включение оценок сообщений

	private $max_length = 1024; //максимальная длинна сообщения (0 для отключения)
	private $cpp = 5; //комментариев на страницу
	private $gravatar_enabled = true; //отключение вывода граватара
	private $gravatar_size = '60'; //размер граватара к комменту.
	private $gravatar_default = 'mm'; //путь картинки по умолчанию для граватара (оставьте пустые кавычки, если нужно использовать родную дефолтную картинку граватара)
	private $timedate_format = 'd.m.Y H:i'; //формат времени комментария (дата + время: "d.m.Y H:i:s")
	//по умолчанию все комменты сортируются по дате добавления - сначала старые, потом свежие.
	private $total_reverse = false; //реверс последовательности всего списка комментариев
	private $page_reverse = false; //реверс комментов на странице
	private $from_last_page = true; //показывать последнюю страницу комментариев
	private $pagination_top = true; //отображать пагинацию сверху списка комментов
	private $pagination_bottom = true; //отображать пагинацию снизу
	//уведомления о новых комментариях отправляются только при включенной премодерации
	private $mail_subject = 'Комментарий к сайту'; //заголовок письма с уведомлением о новом комментарии
	private $mail_target = 'sample@email.ru'; //адреса, на которые будут отправляться уведомления (через запятую)
	private $mail_from = ''; //адрес, от имени которого будет отправлено письмо
	private $mail_sender_name = 'Нотификатор'; //имя отправителя

	private $comment_enabled = true; //блокировка комментирования с отключением формы (доступна только администратору)
	private $comment_hidden = false; //отключение вывода всех комментариев (доступны только для администратора)
	private $answer_allowed = false; //разрешить отвечать на комментарии

	private $stat_enabled = false; //индексирование и сохранение сводной статистики по комментариям
	private $stat_filename = 'statistic_collection'; //имя файла, в котором будет храниться статистика

	private $ip_store = true; //сохранять IP-адрес комментатора.
	private $ip_show = true; //отображать IP-адрес в комментарии. Видно только администраторам.
	private $blacklist_enabled = false; //включение блокировки по черному списку по ip.
	private $blacklist_filename = 'blacklist_collection'; //имя файла, в котором будет храниться черный список.

	/*
	Настройки дополнительных полей формы (пример)
	Каждый вложенный массив - одно поле
	private $extra_fields = array(
	    array(
			'name' => 'city',       // имя поля ввода латинскими буквами без пробелов. Используется в формировании стилевых классов и как ключ для хранения внутри комментария.
			'title' => 'Город',     // отображаемое название поля ввода
			'required' => false,    // обязательность заполнения при добавлении комментария true|false
			'public' => true        // публикация вместе с комментарием true|false
		),
		array(
			'name' => 'phone',
			'title' => 'Телефон',
			'required' => false,
			'public' => false
		)
	);
	 */
	private $extra_fields = array();

    //служебные переменные
    private $post = array();
    private $err = array();
    private $info = array();


	function __construct($ref = false){
		if($ref) {
			$this->ref = $this->make_ref($ref);
		}

		//задаем константы
		define('RPATH', realpath($_SERVER['DOCUMENT_ROOT']).'/');
		define('STORE', RPATH.$this->store);

		if($this->default_timezone) {
			date_default_timezone_set($this->default_timezone);
		}
		$this->post = filter_var_array(array_merge($_REQUEST, $_COOKIE));

		if(!empty($this->post['op'])){
			$this->do_operation($this->post['op']);
		}

	}

	//волшебный метод ;)
	//
	function &__get($name){
        $param = 'get_' . $name;
        if(method_exists(__CLASS__, $param)){
            $result = $this->$param();
            $this->$name = $result;
            return $this->$name;
        }
        $this->err[] = 'Обращение к незаданной переменной '.$name;
	}

    /*
     * основные обработчики запросов
     */

	/**
	 * выполняем операцию и возвращаем результат
	 * @param string $op имя операции
	 */
	function do_operation($op = ''){

		$operation = 'op_'.$op;
		if(method_exists($this, $operation)){
			$result = $this->$operation();
		} else {
			$this->err[] = 'Операция не существует.';
		}

        if($this->is_ajax){
            $result['info'] = $this->render_info();
            $result = json_encode($result);
            exit($result);
        }
	}

	/**
	 * инициализация гостевой или просто вывод списка комментов + форма
	 */
	function op_init(){
		return array(
			'list'=>$this->render_list($this->ref),
			'desktop'=>$this->render_form($this->ref)
		);
	}

	/**
	 * получение списка комментариев (без обновления формы, экономим трафик)
	 */
	function op_get_list(){
		return array(
			'list'=>$this->render_list()
		);
	}

	/**
	 * авторизация. Принимает из _POST пароль и сравнивает с настройками. При успешном сравнении добавляет "соленые" куки пользователю.
	 */
	function op_login(){
		$list = '';
		if($this->post['password'] == $this->password){
			$_COOKIE['is_admin'] = $this->salt_word($this->password.$_SERVER['SERVER_NAME']);
			setcookie('is_admin', $this->salt_word($this->password.$_SERVER['SERVER_NAME']), 0);
			$this->is_admin = true;
			$this->info[] = 'Вы успешно авторизированы.';
			$list = $this->render_list();
		} else {
			$this->err[] = 'Неверный пароль администратора.';
		}
		return array(
			'list'=>$list,
			'desktop'=>$this->render_form()
		);
	}

	/**
	 * метод выхода (разлогинивание). Очищает метку логина в текущем сеансе и в куках пользователя.
	 */
	function op_logout(){
		$list = '';
		if(isset($_COOKIE['is_admin'])){
			unset($_COOKIE['is_admin']);
			$this->is_admin = false;
			setcookie('is_admin', '', 0);
			$list = $this->render_list();
			$this->info[] = 'Вы успешно разлогинились.';
		} else {
			$this->err[] = 'Вы не были авторизованы.';
		}
		return array(
			'list'=>$list,
			'desktop'=>$this->render_form()
		);
	}

	/**
	 * добавление нового комментария
	 */
	function op_add_comment(){

		if($this->comment_enabled || $this->is_admin){
			$comment = array(
				'name'=>htmlspecialchars(trim($this->post['name'])),
				'email'=>htmlspecialchars(trim($this->post['email'])),
				'message'=>$this->post['message'],
				'moderated'=>!$this->moderate,
				'date' => time(),
				'key' => uniqid(),
				'rating' => 0,
				'parent' => $this->post['parent'],
				'is_admin'=> $this->is_admin,
			);
			//сохраняем ip-адрес
			if($this->ip_store){
				$comment['ip'] = $_SERVER['REMOTE_ADDR'];
			}

			//обрабатываем дополнительные кастомные поля
			if(!empty($this->extra_fields)){
				foreach($this->extra_fields as $field){
					$comment[$field['name']] = htmlspecialchars(trim($this->post[$field['name']]));
					if($field['required'] && empty($comment[$field['name']])){
						$this->err[] = 'Поле "'.$field['title'].'" не должно быть пустым.';
					}
				}
			}

			//проверки на корректность ввода
			if(!$comment['name']){
				$this->err[] = 'Имя комментатора не должно быть пустым.';
			}
			if(!$this->validate_email($comment['email'])){
				$this->err[] = 'Введен некорректный электронный адрес.';
			}
			if(!$comment['message']){
				$this->err[] = 'Необходимо ввести текст комментария.';
			}
			if($this->max_length && (mb_strlen($comment['message'], 'UTF-8') > $this->max_length)){
				$this->err[] = 'Длинна комментария не должна превышать <b>'.$this->max_length.'</b> символов.';
			} else {
				$comment['message'] = trim($this->post['message']);
				if($this->spec_char_replace && !$this->is_admin) {
					$comment['message'] = htmlspecialchars($comment['message']);
				}
				$comment['message'] = nl2br($comment['message']);
			}

			if($this->post['e-mail']){
				$this->err['spam'] = 'Вы не прошли бот-проверку.';
			}
			if(empty($this->post[$this->salt_word($this->ref.$this->post['ecomment_start'])])){
				$this->err['spam'] = 'Вы не прошли бот-проверку. Попробуйте еще раз.';
			}
			if($this->blacklist_enabled){
				$this->check_blacklist($_SERVER['ip']);
			}

			if($this->flood_control && !$this->is_admin){
				if(
					$_COOKIE['last_comment_time'] + $this->flood_control > time() ||
					($last_comment = $this->find_last_comment($comment['email'])) && $last_comment['date'] + $this->flood_control > time()
				){
					if($this->show_flood_control_timeout){
						$text_min = array('минуту','минуты','минут');
						$text_sec = array('секунду','секунды','секунд');

						$timeout = $_COOKIE['last_comment_time'] + $this->flood_control - time();
						$timeout_min = floor($timeout / 60);
						$timeout_sec = $timeout % 60;

						$timeout_str = ($timeout_min ? $timeout_min.' '.$this->num_conjugation($timeout_min, $text_min).' и ' : '').$timeout_sec.' '.$this->num_conjugation($timeout_sec, $text_sec).'.';

						$this->err[] = 'Вы слишком часто оставляете комментарии. Подождите еще '.$timeout_str;
					} else {
						$this->err[] = 'Вы слишком часто оставляете комментарии. Попробуйте еще раз через несколько минут.';
					}
				}
			}

			//если не было ошибок, то сохраняем
			if(!sizeof($this->err)){

				//отправляем метку последнего комментария в куки
				if($this->flood_control){
					setcookie('last_comment_time', time());
				}

				//регистрируем ответ у родительского сообщения
				if($comment['parent']){
					if($parent = $this->get_comment($comment['parent'])){
						$this->list[$parent['key']]['children'][] = $comment['key'];
					}
				}

				$this->list[$comment['key']] = $comment; //добавляем сам новый коммент

                //обрабатываем подписку
                if($this->subscribe_allowed){
                    $subscribe = $this->post['subscribe'] ? true : false;
                    $this->subscribe_email($comment['email'], $subscribe);
                    if($subscribe) {
                        setcookie('ecomment_subscribe', true);
                        $_COOKIE['ecomment_subscribe'] = true;
                    } else {
                        setcookie('ecomment_subscribe', false, 0);
                        unset($_COOKIE['ecomment_subscribe']);
                    }
                }

				if($this->save_comments($this->ref, $this->list)){

					$this->info[] = 'Ваш комментарий успешно добавлен.';
					if($this->moderate) {
						$this->info[] = 'Комментарий появится в общем списке сразу же после одобрения модератором.';
					}
					if($this->notify){
						$this->comment_notify($comment, false, false);
					}
					if($this->subscribe_allowed && !$this->moderate){
						$this->comment_notify($comment, $this->subscribes, false);
					}
					$this->user_posted[] = $comment['key'];
					setcookie('ecomment_posted', serialize($this->user_posted), 0x7FFFFFFF);
					unset(
						$this->post['message'],
						$this->post['parent']
					); //чистим то, что не должно больше запоминаться
				}

			} else {
				$this->err[] = 'Сообщение не было сохранено. Заполните все поля корректно.';
			}

		} else {
			$this->err[] = 'Комментирование данной страницы было приостановлено администрацией.';
		}
		return array(
			'list'=>$this->render_list(),
			'desktop'=>$this->render_form()
		);
	}

	/**
	 * удаление комментария по $_POST['id']
	 */
	function op_delete_comment(){
		$list = '';
		if($this->is_admin){
			if($comment = $this->get_comment($this->post['id'])){
				if(!empty($comment['parent'])){ //вычищаем упоминание об удаляемом комменте у его родителя (если есть родитель)
					if($parent = $this->get_comment($comment['parent'], false)){
						unset($parent['children'][array_search($comment['key'], $parent['children'])]);
						$this->list[$parent['key']] = $parent;
					}
				}
				if(!empty($comment['children'])){ //вычищаем у дочерних ответов инфу о родителе (если есть дочерние)
					foreach($comment['children'] as $child){
						$parent = ($comment['parent'] ? $comment['parent'] : '');
						$this->list[$child]['parent'] = $parent; //переписываем все дочерние ответы родителю удаляемого ответа
						if($this->get_comment($parent, false)){
							$this->list[$parent]['children'][] = $child;
						}
					}
				}
				unset($this->list[$comment['key']]);
				if($this->save_comments($this->ref, $this->list)){
					$this->info[] = 'Комментарий успешно удален.';
					$list = $this->render_list();
				}
			}
		}
		return array(
			'list'=>$list
		);
	}

	/**
	 * toggle статуса промодерированности комментария по $_POST['id']
	 */
	function op_moderate_comment(){
		$list = '';
		if($this->is_admin){
			if(isset($this->list[$this->post['id']])){
				$this->list[$this->post['id']]['moderated'] = !$this->list[$this->post['id']]['moderated'];
				if($this->save_comments($this->ref, $this->list)){
					$this->info[] = 'Комментарий успешно промодерирован.';
					$list = $this->render_list();
					//обработка подписки: если разрешена и включено премодерирование и коммент одобрен
					if($this->subscribe_allowed && $this->moderate && $this->list[$this->post['id']]['moderated']){
						$this->comment_notify($this->list[$this->post['id']], $this->subscribes, false);
					}
				}
			}
		}
		return array(
			'list'=>$list
		);
	}

	/**
	 * админская пометка коммента по $_POST['id']
	 */
	function op_admin_marker(){
		$list = '';
		if($this->is_admin){
			if(isset($this->list[$this->post['id']])){
				$this->list[$this->post['id']]['is_admin'] = !$this->list[$this->post['id']]['is_admin'];
				if($this->save_comments($this->ref, $this->list)){
					$list = $this->render_list();
				}
			}
		}
		return array(
			'list'=>$list
		);
	}

	/**
	 * Блокировка\разблокировка адреса комментария
	 */
	function op_ban(){
		$list = '';
		if($this->is_admin){
			if($comment = $this->get_comment($this->post['id'])){
				if(isset($comment['ip'])){
					if($this->check_blacklist($comment['ip'], false)){
						$this->remove_from_blacklist($comment['ip']);
					} else {
						$this->add_to_blacklist($comment['ip']);
					}
					$list = $this->render_list();

				} else {
					$this->info[] = 'Невозможно заблокировать. Не указан IP-адрес.';
				}
			}
		}
		return array(
			'list'=>$list,
			'desktop'=>$this->render_form()
		);
	}

	/**
	 * повышение рейтинга комментария
	 */
	function op_rate_up(){
		$list = '';

		if(isset($this->list[$this->post['id']])){
			if($this->can_rate($this->post['id'], true)){
				$comment = $this->list[$this->post['id']];
				$comment['rating'] = (!isset($comment['rating']) ? $comment['rating']+1 : 1);
				$this->list[$this->post['id']] = $comment;
				$this->user_rated[] = $comment['key'];
				$this->user_rated = array_unique($this->user_rated);
				if($this->save_comments($this->ref, $this->list)){
					setcookie('ecomment_rated', serialize($this->user_rated), 0x7FFFFFFF);
					$list = $this->render_list();
				}
			}
		}

		return array(
			'list'=>$list
		);
	}

	/**
	 * понижение рейтинга комментария
	 */
	function op_rate_down(){
		$list = '';

		if(isset($this->list[$this->post['id']])){
			if($this->can_rate($this->post['id'], true)){
				$comment = $this->list[$this->post['id']];
				$comment['rating'] = (!isset($comment['rating']) ? $comment['rating']-1 : -1);
				$this->list[$this->post['id']] = $comment;
				$this->user_rated[] = $comment['key'];
				$this->user_rated = array_unique($this->user_rated);
				if($this->save_comments($this->ref, $this->list)){
					setcookie('gb_rated', serialize($this->user_rated), 0x7FFFFFFF);
					$list = $this->render_list();
				}
			}
		}

		return array(
			'list'=>$list
		);
	}

	/**
	 * редактирование полей комментария
	 */
	function op_update_comment(){
		if($this->is_admin){
			if($comment = $this->get_comment($this->post['id'])){
				$new = array();
				if($this->post['name'])     $new['name'] = trim($this->post['name']);
				if($this->post['message'])  $new['message'] = strip_tags(trim($this->post['message']), '<br>');
				if($this->post['date'])     $new['date'] = strtotime(trim($this->post['date']));

				//обработка дополнительных кастомных полей
				if(!empty($this->extra_fields)){
					foreach($this->extra_fields as $field){
						if(isset($this->post[$field['name']])){
							$new[$field['name']] = strip_tags(trim($this->post[$field['name']]));
						}
					}
				}

				$comment = array_merge($comment, $new);
				$this->list[$comment['key']] = $comment;

				if($this->save_comments($this->ref, $this->list, 'Редактирование комментария.')){
					$this->info[] = 'Комментарий успешно обновлен.';
				}
			}
		} else {
			$this->err[] = 'У вас недостаточно прав чтобы редактировать комментарии.';
		}

		return array(
			'info'=>$this->render_info()
		);
	}

	/**
	 * AJAX-интерфейс для получения информации о количестве комментов на странице
	 * @param string $ref идентификатор страницы (по умолчанию идентификатор страницы, с которой был отправлен запрос)
	 */
	function op_get_total($ref = ''){
		$ref = $ref ? $ref : $this->ref;
		return $this->get_total($ref);
	}

    /**
     * Отказ от подписки на определенную страницу ref, мейла email
     */
    function op_unsubscribe(){

        if($this->subscribe_allowed && $this->post['email']){
            $this->subscribe_email($this->post['email'], false);

            unset($_COOKIE['ecomment_subscribe']);
            setcookie('ecomment_subscribe', false, 0);

            $this->save_comments($this->ref, $this->list);
        }
        $this->do_operation('init');
    }

	/**
	 * получение информации о списке комментов (количество комментов). Возвращает ассоциативный массив счетчиков:
	 * ref - идентификатор страницы, для которой берутся счетчики.
	 * total - комментариев всего.
	 * moderated - количество промодерированных комментариев.
	 * answers - количество всех комментов, являющихся ответами на другие комменты.
	 * moderated_answers - количество промодерированных ответов.
	 * @param string $ref имя (идентификатор) страницы, для которой вычисляются значения счетчиков
	 * @param array $list список комментариев, о котором нужно собрать статистику
	 * @return array
	 */
	function get_total($ref = '', $list = array()){
		if(!$ref) $ref = $this->ref;
		if(empty($list)) $list = $this->get_comments($ref, false);
		$total = array(
			'ref' => $ref,
			'total'=>sizeof($list),
			'moderated'=>0,
			'answers'=>0,
			'moderated_answers'=>0
		);
		foreach($list as $comment){
			if($comment['moderated']) $total['moderated']++;
			if($comment['parent']) $total['answers']++;
			if($comment['parent'] && $comment['moderated']) $total['moderated_answers']++;
		}
		return $total;
	}

	/**
	 * Обновление массива статистики данными в формате get_total
	 * @param array $stat массив данных по странице комментариев
	 * @param bool $log вывод ошибок
	 * @return bool
	 */
	function stat_update($stat, $log = true){
		if(is_array($stat) && isset($stat['ref'])){
			$this->statistic[$stat['ref']] = $stat;
			if($this->save_data($this->stat_filename, $this->statistic, $log)){
				return true;
			}
		} else {
			if($log) $this->err[] = $log.'Некорректный формат статистики для обновления.';
		}
		return false;
	}

	/**
	 * Сканирование и индексирование статистической информации по всем файлам с комментариям.
	 * @return array
	 */
	function stat_collect(){
		$dir = opendir(STORE);
		$index = array();
		while($file = readdir($dir)) {
			$file = pathinfo($file);
			$ref = $file['filename'];
			if ($file['extension'] == 'dat' && $ref != $this->stat_filename) {
				$index[$ref] = $this->get_total($ref);
			}
		}
		closedir($dir);
		$this->save_data($this->stat_filename, $index, 'Индексирование статистики.');
		return $index;
	}

	/**
	 * сортировка ассоциативного массива элементов по указанному ключу.
	 * @param $array array массив элементов для сортировки.
	 * @param $key string ключ, по которому сортируются вложенные элементы.
	 * @param $direct string направление сортировки ASC|DESC (ASC def.)
	 * @return array отсортированный по ключу массив.
	 */
	function array_sort($array, $key, $direct = 'ASC'){
		$tmp = array();
		foreach($array as $row){
			$k = $row[$key];
			while(isset($tmp[$k])){
				$k = (is_int($k) ? ++$k : $k . '-');
			}
			$tmp[$k] = $row;
		}
		if($direct == 'ASC') ksort($tmp); else krsort($tmp);
		return array_values($tmp);
	}

    /*
     * методы рендера
     */

	/**
	 * Рендер блока пагинации
	 * @param int $count расчетное количество элементов (всего).
	 * @param int $current текущая активная страница в последовательности пагинации (нумерация от 0)
	 * @param int $cpp количество элементов на страницу
	 * @param string|array $options дополнительные параметры для ссылок пагинации
	 * @return string HTML-разметка под пагинацию
	 */
	function render_pagination($count = 1, $current = 0, $cpp = 1, $options = ''){
		if(!$count || $count<=$cpp){
			return '';
		}
		if(is_array($options)){
			$tmp = '';
			foreach($options as $key=>$val){
				$tmp.= '&'.$key.'='.$val;
			}
			$options = $tmp;
		}

		$first = $prev = $next = $last = false;
		$page_count = ceil($count / $cpp);
		//начальная точка
		$start  = $current - 3;
		if($start >= 1) { $prev = true; $first = true; }
		if($start < 1) $start = 0;
		//конечная точка
		$end    = $current + 3;
		if($end < ($page_count-1)) { $next = true; $last = true; }
		if($end >= $page_count) $end = $page_count-1;

		$echo = '<div class="pagination"><small>Страницы'.(($page_count>11)?' (всего '.$page_count.')':'').':</small><br/>';
		if($first) $echo.= '<a href="?ecomment_page=1'.$options.'" class="first">первая</a>';
		if($prev) $echo.= '<a href="?ecomment_page='.$current.$options.'" class="prev">&laquo;</a> ... ';

		for($i = $start; $i <= $end; $i++){
			$echo.= '<a href="?ecomment_page='.($i+1).$options.'" '.(($i==$current)?'class="active"':'').'>'.($i+1).'</a>';
		}

		if($next) $echo.= ' ... <a href="?ecomment_page='.($current+2).$options.'" class="next">&raquo;</a>';
		if($last) $echo.= '<a href="?ecomment_page='.$page_count.$options.'" class="last">последняя</a>';

		$echo.= '</div>';
		return $echo;
	}

	/**
	 * рендер списка комментариев (основная логика)
	 * @param bool $ref идентификатор страницы. Если не указан или False, то используется идентификатор текущей загруженной страницы
	 * @param bool $log вывод сообщений\ошибок рендера
	 * @return string HTML-разметка списка комментариев
	 */
	function render_list($ref = false, $log = true){
		$echo = '';

		if($this->is_admin || !$this->comment_hidden) //отображать коммменты только для админа, если они отключены
		{
			if ($ref)
			{
				$ref        = $this->make_ref($ref);
				$this->list = $this->get_comments($ref, false);
			}
			$count = $this->get_total();

			if (!$count['total']) $this->info[] = 'Для текущей страницы нет комментариев';

			//сортируем по дате
			$this->list = $this->array_sort($this->list, 'date');

			//историческая сортировка - старые сообщения на последних страницах
			if ($this->total_reverse) $this->list = array_reverse($this->list, true);

			//восстанавливаем ключи
			foreach ($this->list as $val)
			{
				$list[$val['key']] = $val;
			}
			$this->list = $list;

			if (!$list) return ' ';

			//фильтруем, оставляя только исходные комментарии (без ответов) в любом случае, чтобы не дублировались
			foreach ($list as $comment)
			{
				if ($comment['parent'] && $this->get_comment($comment['parent']))
					unset($list[$comment['key']]);
			}

			//фильтруем, если есть необходимость, от не прошедших модерацию комментов
			if (!$this->is_admin && $this->moderate)
			{
				foreach ($list as $key => $comment)
					if (!$comment['moderated'] && !$this->is_my_comment($comment['key']))
					{
						unset($list[$key]);
					}
			}

			//включаем пагинацию
			$count   = sizeof($list);
			$options = array('op' => 'get_list');
			if ($this->pagination_top) $echo .= $this->render_pagination($count, $this->page, $this->cpp, $options); //верхняя пагинация


			//обрезаем лишние сообщения
			$list = array_slice($list, $this->page * $this->cpp, $this->cpp);

			//реверс сообщений на странице - сверие вверху (двойное отрицание ибо один реверс уже был)
			if ($this->page_reverse) $list = array_reverse($list, true);

			//перебор списка с комментариями
			foreach ($list as $comment)
			{
				$echo .= $this->render_comment($comment, $log);
			}
			if ($this->pagination_bottom) $echo .= $this->render_pagination($count, $this->page, $this->cpp, $options); //нижняя пагинация
		}
		return $echo;
	}

	/**
	 * Рендер одного конкретного комментария (для последующего использования внутри списка комментариев)
	 * @param array $comment массив с данными по комментарию
	 * @param bool $log отображение возможных ошибок во время рендера
	 * @return string HTML-разметка одного комментария
	 */
	function render_comment($comment, $log = true){
		$control = '';
		$ecomment_editable = ($this->is_admin ? 'ecomment_editable' : '');
		if($this->is_admin){
			$control = '<div class="ecomment_control">
                <a href="?op=moderate_comment&id='.$comment['key'].($this->post['ecomment_page'] ? '&ecomment_page='.$this->post['ecomment_page'] : '').'" class="ecomment_op">'.($comment['moderated'] ? 'скрыть' : 'утвердить').'</a>
                &nbsp;|&nbsp;
                <a href="?op=delete_comment&id='.$comment['key'].($this->post['ecomment_page'] ? '&ecomment_page='.$this->post['ecomment_page'] : '').'" class="ecomment_op">удалить</a>
            </div>';
		}

		$rating = '';
		if($this->rating){
			$rating = '
            <div class="ecomment_comment_rating">
                <a href="?op=rate_up&id='.$comment['key'].($this->post['ecomment_page'] ? '&ecomment_page='.$this->post['ecomment_page'] : '').'" title="Повысить рейтинг" class="ecomment_rate_link ecomment_rate_up ecomment_op">+</a>
                <span class="ecomment_rating_value'.($comment['rating'] < 0 ? ' negative': '').'" title="Рейтинг сообщения"> '.$comment['rating'].' </span>
                <a href="?op=rate_down&id='.$comment['key'].($this->post['ecomment_page'] ? '&ecomment_page='.$this->post['ecomment_page'] : '').'" title="Понизить рейтинг" class="ecomment_rate_link ecomment_rate_down ecomment_op">-</a>
            </div>';
		}

		$ip = '';
		if($this->ip_show && isset($comment['ip']) && $this->is_admin){
			$ip = '<span class="ecomment_ip">('.$comment['ip'].')</span>';
		}

		$extra_fields = '';
		if(!empty($this->extra_fields)){
			foreach($this->extra_fields as $field){
				if($field['public']){
					$extra_fields.= '
					<span class="ecomment_extra_field ecomment_'.$field['name'].'">
						<span class="ecomment_extra_field_title">'.$field['title'].':</span>
						<span class="ecomment_extra_field_value '.$ecomment_editable.'" rel="'.$field['name'].'">'.(empty($comment[$field['name']]) ? 'не указано' : $comment[$field['name']]).'</span>
					</span>';
				}
			}
		}
		if($extra_fields){
			$extra_fields = '<div class="ecomment_extra_fields">'.$extra_fields.'</div>';
		}

		$answer = '<small class="ecomment_answer_control">';

		if($this->answer_allowed || $this->is_admin){
			$answer.= '<a href="?id='.$comment['key'].'" class="ecomment_answer_link ecomment_control_icon" title="Ответить на комментарий">ответить</a>&nbsp;';
		}
		if($this->is_admin){
			$answer.= '<a href="mailto:'.$comment['email'].'" title="Ответить письмом на '.$comment['email'].'" class="ecomment_mailto_link ecomment_control_icon">email</a>&nbsp;';
		}
		if($this->is_admin){
			$answer.= '<a href="?op=admin_marker&id='.$comment['key'].($this->post['ecomment_page'] ? '&ecomment_page='.$this->post['ecomment_page']: '').'" class="ecomment_control_icon ecomment_isadmin_link ecomment_op '.($comment['is_admin'] ? '' : 'ecomment_opacity').'" title="'.($comment['is_admin'] ? 'Снять админскую метку' : 'Поставить админскую метку').'">Сообщение администратора</a>';
		}
		if($this->is_admin && $this->blacklist_enabled){
			$is_banned = isset($comment['ip']) && $this->check_blacklist($comment['ip'], false);
			$answer.= '<a href="?op=ban&id='.$comment['key'].($this->post['ecomment_page'] ? '&ecomment_page='.$this->post['ecomment_page']: '').'" class="ecomment_control_icon ecomment_ban_link ecomment_op '.($is_banned ? '' : 'ecomment_opacity').'" title="'.($is_banned ? 'Разблокировать' : 'Заблокировать').'">Блокировка пользователя</a>';
		}

		$answer.= '</small>';

		$gravatar = $this->gravatar_enabled ? '<div class="ecomment_avatar"><img src="'.(!empty($_SERVER['HTTPS']) ? 'https://' : 'http://').'www.gravatar.com/avatar/'.md5(strtolower(trim($comment['email']))).'?s='.$this->gravatar_size.'&d='.urlencode($this->gravatar_default).'"/></div>' : '';

		$echo = '
            <div id="ecomment_'.$comment['key'].'" rel="'.$comment['key'].'" class="ecomment '.($comment['moderated'] ? 'moderated' : 'unmoderated').' '.($comment['is_admin'] ? 'admin' : '').'">
                '.$gravatar.'
                <div class="ecomment_date '.$ecomment_editable.'" rel="date">'.date($this->timedate_format, $comment['date']).'</div>
                '.$rating.'
                <div class="ecomment_title">
                    <span class="ecomment_name '.$ecomment_editable.'" rel="name">'.$comment['name'].'</span>'.$ip.$answer.'
                </div>
                '.$extra_fields.'
                <div class="ecomment_message '.$ecomment_editable.'" rel="message">'.$comment['message'].'</div>
                '.$control.'
            </div>
        ';

		if(!empty($comment['children'])){
			$echo.= '<div class="ecomment_answers">';
			foreach($comment['children'] as $key){
				if($child = $this->get_comment($key, true)){
					if($this->is_admin || $child['moderated'] || !$this->moderate){
						$echo.= $this->render_comment($child , $log );
					}
				}
			}
			$echo.= '</div>';
		}
		return $echo;
	}

	/**
	 * рендер информационных сообщений
	 * @return string HTML-разметка информационных сообщений, накопившихся в системе. Если их нет, возвращает пустую строку.
	 */
	function render_info(){
		$err = $info = '';
		if($this->err)  $err  = '<div class="ecomment_err">'.implode('<br/>', $this->err).'</div>';
		if($this->info) $info = '<div class="ecomment_inf">'.implode('<br/>', $this->info).'</div>';
		return $err.$info;
	}

	/**
	 * Рендер формы для добавление нового комментария
	 * @param string $ref альтернативный идентификатор страницы (url или произвольная строка)
	 * @param string $http_ref альтернативный адрес страницы (url страницы запроса). Если не уверены, оставьте пустым.
	 * @return string HTML-разметка формы комментирования
	 */
	function render_form($ref = '', $http_ref = ''){

		if(($this->comment_enabled || $this->is_admin) && !$this->check_blacklist($_SERVER['REMOTE_ADDR'])){
			if($ref){
				$this->ref = $this->make_ref($ref);
			}
			if($http_ref){
				$this->http_ref = $http_ref;
			}
			$start = uniqid();
			//избавляемся от error Notice
			$this->post['parent']   = (empty($this->post['parent']) ? '' : $this->post['parent']);
			$this->post['name']     = (empty($this->post['name']) ? '' : $this->post['name']);
			$this->post['email']    = (empty($this->post['email']) ? '' : $this->post['email']);
			$this->post['message']  = (empty($this->post['message']) ? '' : $this->post['message']);

			//формируем дополнительные кастомные поля
			$extra_fields = '';
			if(!empty($this->extra_fields)){
				foreach($this->extra_fields as $field){
					$extra_fields.= '
					<dt>'.$field['title'].':</dt>
					<dd><input type="text" name="'.$field['name'].'" '.($field['required'] ? 'required':'').' value="'.$this->post[$field['name']].'" class="ecomment_form_'.$field['name'].'"/></dd>
				';
				}
			}

			return '
			<h2>Оставить комментарий</h2>
			<form method="post" class="ecomment_form">
				<input type="hidden" name="op" value="add_comment"/>
				<input type="hidden" name="ref" value="'.$this->ref.'"/>
				<input type="hidden" name="http_ref" value="'.$this->http_ref.'"/>
				<input type="hidden" name="ecomment_start" value="'.$start.'"/>
				<input type="hidden" name="ecomment_page" value="'.$this->post['ecomment_page'].'"/>
				<input type="hidden" name="parent" value="'.$this->post['parent'].'"/>
				<input type="hidden" name="counter" value="'.$this->max_length.'"/>
				<div class="ecomment_form_login"><noindex>'.($this->is_admin ? '<a href="?op=logout" class="ecomment_op" rel="nofollow">logout</a>' : '<a href="?op=login" class="ecomment_op" rel="nofollow">login</a>').'</noindex></div>
				<dl>
					<dt>Имя:</dt>
					<dd><input type="text" name="name" required class="ecomment_form_name" value="'.$this->get_autofill_name().'"/><span class="ecomment_answer_caption"></span></dd>

					<dt>Email:</dt>
					<dd>
						<input type="email" name="email" required class="ecomment_form_email" value="'.$this->get_autofill_email().'"/>
						<input type="text" name="e-mail" value=""/>
					</dd>

					'.$extra_fields.'

					<dt>Комментарий:</dt>
					<dd>
						<textarea name="message" class="ecomment_form_message" maxlength="'.$this->max_length.'">'.$this->post['message'].'</textarea>
						<input type="text" name="ecomment_counter" readonly class="ecomment_counter" value="'.$this->max_length.'"/>
					</dd>
					<dt></dt>
					<dd>
						<input type="checkbox" name="'.$this->salt_word($this->ref.$start).'" class="ecomment_form_not_robot" value="test"/> - я не робот
						'.($this->subscribe_allowed ? '
						<br>
						<input type="checkbox" name="subscribe" '.($_COOKIE['ecomment_subscribe'] ? 'checked' : '').' /> - подписаться на обновления
						' : '').'
					</dd>
					<dt></dt>
					<dd>
                        <input type="submit" class="ecomment_form_submit" value="Добавить комментарий">
                        <a href="http://ecomment.su" class="ecomment_version">eComment v.'.$this->version.'</a>
                    </dd>
				</dl>
			</form>';
		} else {
			return '';
		}

	}


    /*
     * методы ЧТЕНИЯ и СОХРАНЕНИЯ в файловой системе
     */

	/**
	 * чтение списка комментариев по идентификатору страницы
	 * @param string $ref идентификатор страницы
	 * @param bool $log отображение возможных ошибок
	 * @return array массив комментариев или пустой массив в случае ошибок чтения
	 */
	function get_comments($ref, $log = true){
		$ref = $this->make_ref($ref);
		if($list = $this->read_data($ref, $log)){
			$this->subscribes = isset($list['subscribes']) && !empty($list['subscribes']) ? $list['subscribes'] : array();
			unset($list['subscribes']);
			return $list;
		} else {
		    $this->subscribes = array();
			return array();
		}
	}

	/**
	 * выбор определенного коммента из текущего списка комментариев
	 * @param string $key идентификатор коммента
	 * @param bool $log вывод ошибок
	 * @return bool|array массив с данными комментария или false в случае ошибки (если коммент не найден)
	 */
	function get_comment($key, $log = true){
		if(isset($this->list[$key])){
			return $this->list[$key];
		} else {
			if($log) $this->err[] = 'В текущем списке нет указанного комментария "'.$key.'".';
			return false;
		}
	}

	/**
	 * сохранение базы комментариев (всего списка по странице)
	 * @param string $ref идентификатор страницы
	 * @param array $list массив комментариев
	 * @param bool $log вывод ошибок
	 * @return bool
	 */
	function save_comments($ref, $list, $log = true){
		if($this->stat_enabled){
			$this->statistic[$ref] = $this->get_total($ref, $list);
			$this->save_data($this->stat_filename, $this->statistic, 'Сохранение статистики. ');
		}
		$list['subscribes'] = $this->subscribes;
		return $this->save_data($ref, $list, $log);
	}


	/**
	 * чтение .dat-файлов с сериалиализованными данными из хранилища STORE.
	 * @param string $name имя файла для чтения (без расширения).
	 * @param bool $log вывод ошибок.
	 * @return bool|mixed десериализованные данные или false в случае ошибок чтения или десериализации
	 */
	function read_data($name, $log = true){
		$name = $this->make_ref($name);
		if(@$data = file_get_contents(STORE.$name.'.dat')){
			$data = unserialize($data);
			if($data !== false){
				return $data;
			} else {
				if($log) $this->err[] = 'Не удалось распаковать данные из файла.';
				return false;
			}
		} else {
			if($log) $this->err[] = 'Не удалось прочесть файл данных "'.$name.'".';
			return false;
		}
	}

	/**
	 * сохранение сериализованных данных в хранилище STORE.
	 * @param string $name имя файла для сохранения (без расширения)
	 * @param array|mixed $data данные для сохранения
	 * @param bool $log вывод ошибок
	 * @return bool
	 */
	function save_data($name, $data, $log = true){
		$name = $this->make_ref($name);
		$log_text = is_string($log) ? $log : '';

		if(file_put_contents(STORE.$name.'.dat', serialize($data))){
			return true;
		} else {
			if($log) $this->err[] = $log_text.'Не удалось сохранить файл данных с комментариями.';
			if(file_exists(STORE)){
				if(!is_writable(STORE)) if($log) $this->err[] = $log_text.'Недостаточно прав доступа к директрории хранения данных.';
			} elseif($log) $this->err[] = $log_text.'Указанная директория хранения файлов не существует.';

			return false;
		}
	}

	/**
	 * Управление подпиской на странице.
	 * @param string $email адрес для подписки
	 * @param bool $subs статус подписки - подписаться или отписаться
	 * @param bool $log вывод сообщений
	 */
	function subscribe_email($email, $subs = false, $log = true){
	    $searchResult = array_search($email, $this->subscribes);
		if($subs){
			//если были подписаны, то ничего не делаем
			if($searchResult === false){
				$this->subscribes[] = $email;
				if($log) $this->info[] = 'Вы успешно подписаны на обновления комментариев этой страницы.';
			}
		} else {
			//если были подписаны, то отписываемся
			if($searchResult !== false){
				unset($this->subscribes[$searchResult]);
				if($log) $this->info[] = 'Вы успешно отписаны от обновлений комментариев на странице.';
			}
		}
	}

//
//  Вспомогательные методы
//

	/**
	 * "соленое слово". Хэширует строку используя секретный ключ.
	 * @param string $word строка для хеширования.
	 * @return string
	 */
	function salt_word($word){
		return md5(md5($this->salt).md5($word));
	}

	/**
	 * Транслитерация строки
	 * @param string $str строка для транслитерации
	 * @return mixed
	 */
	function translit($str){
		$rp = array("Ґ"=>"G","Ё"=>"YO","Є"=>"Ye","Ї"=>"YI","І"=>"I",
			"і"=>"i","ґ"=>"g","ё"=>"yo","№"=>"#","є"=>"e",
			"ї"=>"yi","А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
			"Д"=>"D","Е"=>"E","Ж"=>"ZH","З"=>"Z","И"=>"I",
			"Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
			"О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
			"У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"Ts","Ч"=>"Ch",
			"Ш"=>"Sh","Щ"=>"Shch","Ъ"=>"'","Ы"=>"Yi","Ь"=>"",
			"Э"=>"E","Ю"=>"Yu","Я"=>"Ya","а"=>"a","б"=>"b",
			"в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"zh",
			"з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
			"м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
			"с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
			"ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"shch","ъ"=>"'",
			"ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya",
			" "=>"_","»"=>"","«"=>""
		);
		$str = strtr($str, $rp);
		return preg_replace('/[^-\d\w]/','',$str);
	}

	/**
	 * Почтовое уведомление администраторам о новом комментарии. Если хотя бы одна отправка провалилась, методо возвращает false.
	 * @param bool $comment массив с данными комментария
	 * @param bool $log вывод ошибок отправки
	 * @return bool
	 */
	function comment_notify($comment = false, $emails = false, $log = true){

		//составляем заголовки
		$mailHeaders = "Date: ".date("D, d M Y H:i:s")." UT\r\n";
		$mailHeaders.= "Subject: =?UTF-8?B?".base64_encode($this->mail_subject)."?=\r\n";
		$mailHeaders.= "MIME-Version: 1.0\r\n";
		$mailHeaders.= "Content-Type: text/html; charset=\"UTF-8\"\r\n";
		$mailHeaders.= "Content-Transfer-Encoding: 8bit\r\n";
		$mailHeaders.= "From: =?UTF-8?B?".base64_encode($this->mail_sender_name)."?= <".$this->mail_from.">\r\n";
		$mailHeaders.= "X-Priority: 3";
		$mailHeaders.= "X-Mailer: PHP/".phpversion()."\r\n";

		//формируем обратную ссылку на страницу, с которой был отправлен комментарий
		$http_ref = parse_url($this->http_ref);
		parse_str($http_ref['query'],$http_ref['query']); //отдельно обрабатываем параметры, чтобы добавить еще один
		$http_ref['ecomment_page'] = $this->post['ecomment_page'];
		$http_ref['scheme'] = empty($http_ref['scheme']) ? 'http' : $http_ref['scheme'];
        $http_ref_str = $http_ref['scheme'].'://'.$http_ref['host'].$http_ref['path'].'?'.http_build_query($http_ref['query']);

        //формируем ссылка на отписку от рассылки
        if($this->subscribe_allowed){
            $http_ref['query']['op'] = 'unsubscribe';
            $http_ref['query']['ref'] = $this->ref;
            $unsubscribe = $http_ref['scheme'] . '://' . $http_ref['host'] . $http_ref['path'] . '?' . http_build_query($http_ref['query']) . '&email={target_mail}';
        }

		//используем человеко-понятное название страницы либо копию обратной ссылки
		$page_title = $this->post['page_title'] ? mb_convert_encoding($this->post['page_title'], 'UTF-8', 'auto') : $http_ref;

        $mailHTMLBody = '<html><head></head><body>';
		$mailHTMLBody.= '<p>На странице <a href="'.$http_ref_str.'#ecomment_list">'.$page_title.'</a> оставлен новый комментарий:</p>';
        if($this->subscribe_allowed){
            $mailHTMLBody.= '<p>Отписаться от уведомлений: <a href="'.$unsubscribe.'">отписаться</a></p>';
        }
		if($comment){
			$mailHTMLBody.= '<b>Автор:</b> '.$comment['name'].'<br/>';
			if($emails === false) $mailHTMLBody.= '<b>Email:</b> '.$comment['email'].'<br/>';
			if(!empty($this->extra_fields)){
				foreach($this->extra_fields as $field){
					if($field['public'] || $emails === false){
						$mailHTMLBody.= '<b>'.$field['title'].':</b> '.(empty($comment[$field['name']]) ? 'не указано' : $comment[$field['name']]).'<br/>';
					}
				}
			}
			$mailHTMLBody.= '<b>Сообщение:</b> '.$comment['message'].'<br/>';
		}
		$mailHTMLBody.='</body></html>';
		$result = 1;

		$mail_target = explode(',', $this->mail_target);
		//если это рассылка по кастомным адресам, то исключаем из них админские
		if($emails !== false){
			foreach($mail_target as $mt){
				$k = array_search($mt, $emails);
				if($k !== false) unset($emails[$k]);
			}
		} else {
			$emails = $mail_target;
		}

		foreach($emails as $mail){
			$mail = trim($mail);
            if(!$this->validate_email($mail)){
	            if($log) $this->err[] = 'Мейл "'.$mail.'" не прошел валидацию';
                continue;
            }
			$mailBody = str_replace('{target_mail}', $mail, $mailHTMLBody);
			$mail_result = mail($mail, "=?UTF-8?B?".base64_encode($this->mail_subject)."?=", $mailBody, $mailHeaders);
			if(!$mail_result){
				if($log) $this->err[] = 'Не удалость отправить уведомление на почту '.$mail;
			}
			$result*= $mail_result;
		}
		return (bool)$result;
	}

	/**
	 * проверка на разрешение юзеру оценивать определенный комментарий
	 * @param string $key идентификатор комментария
	 * @param bool $log вывод ошибок
	 * @return bool
	 */
	function can_rate($key = '', $log = false){
		if(!$this->is_admin){
			if(!in_array($key, $this->user_posted)){ //запрещаем рейтить свои же посты
				if(!in_array($key, $this->user_rated)){ //запрещаем рейтить уже оцененные посты
					if($this->moderate){ //если включена премодерация сообщений, то проверяем доверенность пользователя
						foreach($this->user_posted as $posted){
							if(isset($this->list[$posted]) && $this->list[$posted]['moderated']){
								return true;
							}
						}
						if($log) $this->err[] = 'Оценивать сообщения могут лишь пользователи, оставившие в теме обсуждения хотя бы один одобренный модератором комментарий.';
					} else return true;
				} elseif($log) $this->err[] = 'Вы уже оценивали этот пост.';
			} elseif($log) $this->err[] = 'Авторы не могут оценивать собственные сообщения.';
		} else return true;
		return false;
	}

	/**
	 * проверка ip-адреса на вхождение в черный список.
	 * @param string $ip ip-адрес для проверки
	 * @param bool $log вывод ошибок
	 * @return bool Возвращает true если адрес присутствует в черном списке.
	 */
	function check_blacklist($ip = '', $log = true){
		if($ip){

			if(array_search($ip, $this->blacklist) !== false){
				if($log) $this->err['ban'] = 'Вам запрещено оставлять сообщения на этом сайте.';
				return true;
			} else {
				return false;
			}

		} else {
			if($log) $this->info[] = 'Не указан IP адрес для проверки в черном списке.';
			return false;
		}
	}

	/**
	 * Добавление адреса в черный список
	 * @param string $ip адрес комментатора
	 * @param bool $save сохранять обновленный черный список
	 * @param bool $log вывод ошибок
	 * @return bool Возвращает true если адрес найден и успешно удален из списка. В противном случае false.
	 */
	function remove_from_blacklist($ip = '', $save = true, $log = true){
		if(($key = array_search($ip, $this->blacklist)) !== false){
			unset($this->blacklist[$key]);
			if($log) $this->info[] = 'Адрес '.$ip.' исключен из черного списка.';
			if($save) return $this->save_data($this->blacklist_filename, $this->blacklist, 'Сохранение черного списка.');
			return true;
		} else {
			if($log) $this->err[] = 'Адрес '.$ip.' не найден в черном списке.';
			return false;
		}
	}

	/**
	 * добавление адреса в черный список
	 * @param string $ip адрес для добавления
	 * @param bool $save сохранять обновленный черный список
	 * @param bool $log вывод ошибок
	 * @return bool
	 */
	function add_to_blacklist($ip = '', $save = true, $log = true){
		$count_before = count($this->blacklist);
		array_push($this->blacklist, $ip);
		$count_after = count(array_unique($this->blacklist));
		if($count_before < $count_after){
			if($log) $this->info[] = 'Адрес успешно добавлен в черный список.';
			if($save) return $this->save_data($this->blacklist_filename, $this->blacklist, 'Сохранение черного списка.');
			return true;
		} else {
			if($log) $this->info[] = 'Адрес уже присутствует в черном списке.';
			return false;
		}
	}

	/** Формируем идентификатор страницы из параметра или пытаемся восстановить из поста или http_ref
	 * @param string $ref предпологаемые идентификатор страницы (url или просто строка)
	 * @return string
	 */
	function make_ref($ref = ''){
		if(empty($ref)){
			$ref = empty($this->post['ref']) ? $this->http_ref : $this->post['ref'];
		}
		$url = parse_url($ref);
		$ref = $this->translit($url['path']);

		if(!empty($this->query) && isset($url['query'])){ //добавляем в ref при любом раскладе параметр
			parse_str($url['query'], $url['query']);
			foreach(explode(',', $this->query) as $query){
				$query = trim($query);
				if(isset($url['query'][$query])) $ref.= '_'.$url['query'][$query];
			}
		}

		return $this->translit($ref);
	}

	/**
	 * Поиск последнего комментария в списке
	 * @param string $author опциональный параметр, Email автора - поиск последнего комментария автора
	 * @return bool
	 */
	function find_last_comment($author = ''){
		$last_comment = false;

		foreach($this->list as $comment){
			if(
				!$author && $comment['date'] > $last_comment['date'] ||
				$author && $comment['email'] == $author && $comment['date'] > $last_comment['date']
			){
				$last_comment = $comment;
			}

		}
		return $last_comment;
	}

	/**
	 * склонение фразы относительно числа
	 * @param int $num число, относительно которого нужно выбрать вариант склонения
	 * @param array $text варианты склонений, массив:
	 * 0 - для чисел, оканчивающихся на 1;
	 * 1 - для оканчивающихся на 2,3,4;
	 * 2 - для оканчивающихся на 5,6,7,8,9,0 + второй десяток.
	 * @return mixed
	 */
	function num_conjugation($num = 0, $text = array()){
		if($num%100 > 10 && $num%100 < 20){
			return $text[2];
		} else{
			$num = $num % 10;
			switch($num){
				case 1:
					return $text[0];
				case 2:
				case 3:
				case 4:
					return $text[1];
				case 5:
				case 6:
				case 7:
				case 8:
				case 9:
				case 0:
					return $text[2];
			}
		}
	}

	/**
	 * Определяет через cookie, является ли текущий пользователь автором комментария с ключом key
	 * @param $key
	 * @return bool
	 */
	function is_my_comment($key){
		return in_array($key, $this->user_posted);
	}

    /**
     * Проверяет мейл на соответствие формату + на существование соответствующего почтового сервера
     * @param $email
     * @return bool
     */
    function validate_email($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        }
        list($user, $domain) = explode('@', $email);
        return checkdnsrr($domain, 'MX');
    }

    /*
     * СЛУЖЕБНЫЕ ГЕТТЕРЫ
     */


	/**
	 * Определяет, является ли запрос AJAX'овым
	 * @return bool
	 */
	function get_is_ajax(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			$is_ajax = true;
		} else {
			$is_ajax = false;
		}
		return $is_ajax;
	}

	/**
	 * Возвращает номер текущей страницы
	 * @return int
	 */
	function get_page(){
		//соблюдение соглашения о нумерации страниц:
		//"пользователь нумерует от 1, в системе - от 0"
		if(empty($this->post['ecomment_page'])){
			if($this->from_last_page){ //если нужно показывать с последней страницы по умолчанию
				$page = $this->last_page - 1;
				$this->post['ecomment_page'] = $this->last_page;
			} else {
				$page = 0;
				$this->post['ecomment_page'] = 1;
			}
		} else {
			$page = $this->post['ecomment_page'] - 1;
		}
		return $page;
	}

	/**
	 * Возвращает referer запроса
	 * @return string
	 */
	function get_http_ref(){
		if(isset($this->post['http_ref'])){
			$http_ref = $this->post['http_ref'];
		} else { //аварийный случай. Может случиться при серверной интеграции
			$http_ref = (!empty($_SERVER['HTTPS']) ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		}
		return $http_ref;
	}

    /**
     * Возвращает ref (уникальный id на основе адреса) страницы, с которой был сделан запрос
     * @return string
     */
    function get_ref(){
        return $this->make_ref();
    }

    /**
     * Возвращает массив идентификаторов комментов, оставленных текущим пользователем
     * @return array
     */
    function get_user_posted(){
        return (!empty($this->post['ecomment_posted']) ? unserialize($this->post['ecomment_posted']) : array());
    }

    /**
     * Возвращает массив комментариев, оцененых текущим пользователем
     * @return array
     */
	function get_user_rated(){
        return (!empty($this->post['ecomment_rated']) ? unserialize($this->post['ecomment_rated']) : array());
    }

    /**
     * Определяет, является ли текущий пользователь администратором
     * @return bool
     */
    function get_is_admin(){
        $is_admin = false;
        if(!empty($_COOKIE['is_admin']) && $_COOKIE['is_admin'] == $this->salt_word($this->password . $_SERVER['SERVER_NAME'])){
            $is_admin = true;
        }
        return $is_admin;
    }

    /**
     * Возвращает список комментариев для текущей страницы
     * @return array
     */
    function get_list(){
        return $this->get_comments($this->ref, false);
    }

    /**
     * Определяет номер последней страницы в соответствии с настройками
     * @return int
     */
	function get_last_page(){
        //количество видимых комментов (страниц) для админа и простого пользователя отличается
        if($this->is_admin){
            $total = $this->total['total'] - $this->total['answers'];
        } else {
            $total = $this->total['moderated'] - $this->total['moderated_answers'];
        }
        return (int) ceil($total / $this->cpp);
    }

    /**
     * Возвращает список мейлов для подписки (рассылки нотификаций)
     * Хранятся в файле вместе с комментами
     * @return array
     */
    function get_subscribes(){
        //достаточно дернуть чтение списка комментов, во время которого формируется список подписок.
        $this->list;
        return $this->subscribes;
    }

    /**
     * Возвращает накопленную статистику по количеству комментариев на всех страницах
     * либо генерирует ее на лету
     * @return array
     */
    function get_statistic(){
        $statistic = $this->read_data($this->stat_filename, false);
        if($statistic === false){
            $statistic = $this->stat_collect();
            $this->save_data($this->stat_filename, $statistic, 'Автосоздание файла статистики. ');
        }
        return $statistic;
    }

    /**
     * Возвращает массив мейлов из черного списка. Читается из отдельного файла
     * или создается и сохраняется заново при необходимости.
     * @return array
     */
    function get_blacklist(){
        $blacklist = array();
        if($this->blacklist_enabled){
            $blacklist = $this->read_data($this->blacklist_filename, false);
            if($blacklist === false){
                $this->save_data($this->blacklist_filename, array(), 'Автосоздание файла черного списка.');
            }
        }
        return $blacklist;
    }

	/**
	 * Возвращает имя автора для автозаполнения формы
	 * @param string $default
	 * @return string
	 */
	public function get_autofill_name($default = ''){

		$autofill_name = $default;
		if($this->post['name']){
			$autofill_name = htmlspecialchars($this->post['name']);
		} elseif($this->is_admin && $this->form_autofill){
			$autofill_name = $this->admin_name;
		} elseif(isset($_COOKIE['autofill_name'])){
			$autofill_name = $_COOKIE['autofill_name'];
		}
		return $autofill_name;
	}

	/**
	 * Возвращает мейл автора для автозаполнения формы
	 * @param string $default
	 * @return string
	 */
	public function get_autofill_email($default = ''){
		$autofill_email = $default;

		if($this->post['email']){
			$autofill_email = htmlspecialchars($this->post['email']);
		} elseif($this->is_admin && $this->form_autofill){
			$autofill_email = trim(reset(explode(',', $this->mail_target))); //берем первый мейл из списка административных
		} elseif(isset($_COOKIE['autofill_email'])){
			$autofill_email = $_COOKIE['autofill_email'];
		}
		return $autofill_email;
	}

}
if($_REQUEST['op']){
	$comment = new ecomment();
}
?>
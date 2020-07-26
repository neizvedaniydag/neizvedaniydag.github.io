(function( $ ) {
	$.fn.ecomment = function(options) {

		return this.each(function(){

			var $this = $(this),
				data = $this.data('ecomment'),
				settings = $.extend({
					'ref'		: location.href,
					'http_ref'	: location.href,
					'path' 		: '/ecomment.php'
				}, options),
				query = parseQuery();



			if(!data){

				$this.data('ecomment', {

					'settings' : settings,
					'query' : query

				});

				if(!$this.find('.ecomment_list').length){ $this.append('<div class="ecomment_list" />'); }
				if(!$this.find('.ecomment_info').length){ $this.append('<div class="ecomment_info" />'); }
				if(!$this.find('.ecomment_desktop').length){ $this.append('<div class="ecomment_desktop" />'); }

			}

			// первичное заполнение контейнеров комментами, инф.сообщениями и формой ответа
			$.ajax({
				url: settings.path,
				type: 'post',
				dataType: 'json',
				data:{
					op: query.op !== undefined ? query.op : 'init', //прокидываем возможную операцию из адресной строки
					email: query.email, //опционально, для отписки
					ref: query.ref !== undefined ? query.ref : settings.ref,
					http_ref: settings.http_ref,
					ecomment_page: query.ecomment_page || undefined
				},
				success: function(data){
					htmlReturn(data);
				}
			});

			// обвес содержимого контейнера обработчиками
			$this
				//обвес сабмита формы
				.on('submit', '.ecomment_form', function(e){
					e.preventDefault();
					var request = $(this).serializeArray();
					// добавляем заголовок страницы, чтобы красиво выводить его в уведомлениях
					request.push({
						name: 'page_title',
						value: $('title').text()
					});

					$.ajax({
						type: 'POST',
						url: settings.path,
						data: request,
						success: htmlReturn,
						dataType: 'JSON'
					});
				})
				//обвес управляющих кнопок
				.on('click', 'a.ecomment_op, .pagination a', function(e){
					e.preventDefault();
					var href = parseQuery( $(this).attr('href') );
					href.page_title = $('title').text();

					if(href.op == 'login'){
						href.password = prompt('Введите пароль администратора:');
						if(!href.password) return false;
					}
					if(href.op == 'get_list'){ // чтобы при сабмите мы вернулись на ту же страницу, куда переходили по пагинации
						$('input[name=ecomment_page]').val(href.ecomment_page);
					}
					href = $.extend(href, settings);

					$.ajax({
						type: 'POST',
						url: settings.path,
						data: href,
						success: htmlReturn,
						dataType: 'JSON'
					});
				})
				//обвес клика по ссылке "ответить"
				.on('click', 'a.ecomment_answer_link', function(e){
					e.preventDefault();
					var href = parseQuery( $(this).attr('href') );
					var input = $this.find('.ecomment_form input[name=parent]');
					$this.find('.ecomment').removeClass('ecomment_selected_for_answer');


					if(input.val() && input.val() == href.id){
						input.val('');
						$this.find('.ecomment_answer_caption').html('');
					} else {
						var name = $(this).parents('.ecomment').addClass('ecomment_selected_for_answer').find('.ecomment_name').text();
						$this.find('.ecomment_answer_caption').html('ответ для <b>'+ name +'</b>');
						input.val(href.id);
					}
				})
				//обвес редактируемых полей
				//делаем поле редактируемым
				.on('click', '.ecomment_editable', function(e){
					e.preventDefault();
					$(this).attr('contenteditable', true).focus();
				})
				//у редактируемых полей внедряем обработчик потери фокуса
				.on('blur', '[contenteditable]', function(e){
					var $field = $(this);
					var name = $field.attr('rel');
					var key = $field.parents('.ecomment').attr('rel');

					var data = $.extend({
						op: 'update_comment',
						id: key,
						http_ref: settings.href
					}, settings);
					data[name] = $field.html();

					$.ajax({
						url: settings.path,
						dataType: 'json',
						type: 'post',
						data: data,
						success: function(data){
							htmlReturn(data);
							$field.off('blur').removeAttr('contenteditable');
						}
					});
				})
				//и добавляем обработку нажатия enter (в тему обработки переносов строк и сохранения изменний)
				.on('keyup, keydown', '[contenteditable]', function(e){
					if(e.keyCode == 13){
						e.preventDefault();
						if(e.ctrlKey){ //CTRL+ENTER - потеря фокуса и сохранение
							$(this).trigger('blur');
						} else { //просто добавляем br в разметку
							document.execCommand('insertHTML', false, '<br>');
						}
					}

				})
				//обвес клика по чекбоксу
				.on('click', '.ecomment_form_not_robot', function(e){
					var d = new Date();
					$(this).val( d.getTime() );
				})
				//обвес счетчика символов
				.on('keyup', '.ecomment_form_message', function(e){
					var length = $(this).val().length;
					$this.find('.ecomment_counter').val( $this.data('ecomment').counter - length );
				});

			// основной обработчик ответа сервера
			function htmlReturn(answer){
				data = $this.data('ecomment');

				if(answer.desktop !== undefined){
					$this.find('.ecomment_desktop').html(answer.desktop);
				}
				if(answer.info) {
					htmlReturnInfo(answer.info);
				}
				if(answer.list) {
					$this.find('.ecomment_list').html(answer.list);
				}
				data.counter = $this.find('input[name=counter]').val();
				$this.data('ecomment', data);
			}

			// отображение информационных сообщений
			function htmlReturnInfo(info){
				$this.find('.ecomment_info').html(info);
			}

			// разбор адресной строки на параметры
			function parseQuery(qs,options) {
				var q = (typeof qs === 'string' ? qs : window.location.search),
					o = {
						'f':function(v){
							return unescape(v).replace(/\+/g,' ');
						}
					},
					options = (typeof qs === 'object' && typeof options === 'undefined') ? qs : options,
					o = jQuery.extend({}, o, options),
					params = {};

				jQuery.each(q.match(/^\??(.*)$/)[1].split('&'),function(i,p){
					p = p.split('=');
					p[1] = o.f(p[1]);
					params[p[0]] = params[p[0]]?((params[p[0]] instanceof Array)?(params[p[0]].push(p[1]),params[p[0]]):[params[p[0]],p[1]]):p[1];
				});
				return params;
			}


		})

	}
})(jQuery);

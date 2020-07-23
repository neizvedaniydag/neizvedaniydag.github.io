<?php
/**
 * Скрипт импорта комментариев с одной страницы в другую
 * Важно! Делайте резервные сохранения файлов с комментариями перед запуском скрипта
 */

$source = 'http://ecomment/test_page.html'; //страница источник, с которой нужно перенести комменты
$target = 'http://ecomment/test_page.php'; //страница приемник, на которую нужно добавить комментарии

define('RPATH', realpath($_SERVER['DOCUMENT_ROOT']));
require_once(RPATH.'/ecomment.php');

$ecomment = new ecomment($ref);
$source_list = $ecomment->get_comments($source);
$target_list = $ecomment->get_comments($target);

if($source_list && $target_list){
	$new_list = array_merge($target_list, $source_list);
	if($ecomment->save_comments($target, $new_list)){
		echo 'Импорт комментариев прошел успешно.';
	} else {
		echo implode('<br>', $ecomment->err);
	}
}

?> 
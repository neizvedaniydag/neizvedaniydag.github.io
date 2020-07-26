<?php
/**
 * Пример серверной интеграции скрипта
 */
define('RPATH', realpath($_SERVER['DOCUMENT_ROOT']));
require_once(RPATH.'/ecomment.php');

$ref = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$comment = new ecomment($ref);

echo '
<link rel="stylesheet" href="/ecomment.css" type="text/css" />
<script src="/ecomment.js" type="text/javascript"></script>

<div class="ecomment_wrapper">
	<div class="ecomment_list">'.$comment->render_list().'</div>
	<div class="ecomment_info">'.$comment->render_info().'</div>
	<div class="ecomment_desktop">'.$comment->render_form().'</div>
</div>
<script>$(".ecomment_wrapper").ecomment()</script>';

?>
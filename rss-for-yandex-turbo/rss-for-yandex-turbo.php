<?php
/*
Plugin Name: RSS for Yandex Turbo
Plugin URI: https://wordpress.org/plugins/rss-for-yandex-turbo/
Description: Создание RSS-ленты для сервиса Яндекс.Турбо.
Version: 1.27
Author: Flector
Author URI: https://profiles.wordpress.org/flector#content-plugins
Text Domain: rss-for-yandex-turbo
*/

//вывод admin notice с рекламкой (для админов) begin
require_once plugin_dir_path( __FILE__ ) . 'inc/AdminNotice.php';
use \YTurboAdminNotices\AdminNotice;
function yturbo_add_notice_ads() {
    AdminNotice::create('yturbo-ads1')
        ->requiredCap('administrator')
        ->persistentlyDismissible(AdminNotice::DISMISS_PER_USER)
        ->success()
        ->rawHtml(__('<p>Для плагина <strong>RSS for Yandex Turbo</strong> появилось премиум-дополнение <strong><a target="_blank" href="https://wpcase.ru/wpcase-turbo-ads/">WPCase: Turbo Ads</a></strong>, которое позволит <br />вам добавить на турбо-страницы неограниченное количество рекламных блоков в нужных вам местах.</p>', 'rss-for-yandex-turbo'))
        ->show();
}
add_action( 'admin_notices', 'yturbo_add_notice_ads' );
//вывод admin notice с рекламкой (для админов) end

//проверка версии плагина (запуск функции установки новых опций) begin
function yturbo_check_version() {
    $yturbo_options = get_option('yturbo_options');
    if (!isset($yturbo_options['version'])){$yturbo_options['version']='1.00';update_option('yturbo_options',$yturbo_options);}
    if ( $yturbo_options['version'] != '1.27' ) {
        yturbo_set_new_options();
    }
}
add_action( 'plugins_loaded', 'yturbo_check_version' );
//проверка версии плагина (запуск функции установки новых опций) end

//функция установки новых опций при обновлении плагина у пользователей begin
function yturbo_set_new_options() {
    $yturbo_options = get_option('yturbo_options');

    //если нет опции при обновлении плагина - записываем ее
    //if (!isset($yturbo_options['new_option'])) {$yturbo_options['new_option']='value';}

    //если необходимо переписать уже записанную опцию при обновлении плагина
    //$yturbo_options['old_option'] = 'new_value';

    if (!isset($yturbo_options['ytrssname'])) {$yturbo_options['ytrssname']='turbo';}
    if (!isset($yturbo_options['ytrelated'])) {$yturbo_options['ytrelated']='disabled';}
    if (!isset($yturbo_options['ytrelatednumber'])) {$yturbo_options['ytrelatednumber']='5';}
    if (!isset($yturbo_options['ytrelatedselectthumb'])) {$yturbo_options['ytrelatedselectthumb']='medium';}
    if (!isset($yturbo_options['ytrelatedcache'])) {$yturbo_options['ytrelatedcache']='enabled';}
    if (!isset($yturbo_options['ytrelatedcachetime'])) {$yturbo_options['ytrelatedcachetime']='72';}
    if (!isset($yturbo_options['ytrelatedinfinity'])) {$yturbo_options['ytrelatedinfinity']='disabled';}
    if (!isset($yturbo_options['ytad3'])) {$yturbo_options['ytad3']='disabled';}
    if (!isset($yturbo_options['ytad3set'])) {$yturbo_options['ytad3set']='РСЯ';}
    if (!isset($yturbo_options['ytad3rsa'])) {$yturbo_options['ytad3rsa']='';}
    if (!isset($yturbo_options['ytadfox1'])) {$yturbo_options['ytadfox1']='';}
    if (!isset($yturbo_options['ytadfox2'])) {$yturbo_options['ytadfox2']='';}
    if (!isset($yturbo_options['ytadfox3'])) {$yturbo_options['ytadfox3']='';}
    if (!isset($yturbo_options['ytrazmer'])) {$yturbo_options['ytrazmer']='500';}
    if (!isset($yturbo_options['ytremoveturbo'])) {$yturbo_options['ytremoveturbo']='disabled';}
    if (!isset($yturbo_options['ytauthorselect'])) {$yturbo_options['ytauthorselect']='Указать автора';}
    if (!isset($yturbo_options['ytliveinternet'])) {$yturbo_options['ytliveinternet']='';}
    if (!isset($yturbo_options['ytgoogle'])) {$yturbo_options['ytgoogle']='';}
    if (!isset($yturbo_options['ytmailru'])) {$yturbo_options['ytmailru']='';}
    if (!isset($yturbo_options['ytrambler'])) {$yturbo_options['ytrambler']='';}
    if (!isset($yturbo_options['ytmediascope'])) {$yturbo_options['ytmediascope']='';}
    if (!isset($yturbo_options['ytqueryselect'])) {$yturbo_options['ytqueryselect']='Все таксономии, кроме исключенных';}
    if (!isset($yturbo_options['yttaxlist'])) {$yturbo_options['yttaxlist']='';}
    if (!isset($yturbo_options['ytaddtaxlist'])) {$yturbo_options['ytaddtaxlist']='';}
    if (!isset($yturbo_options['ytselectmenu'])) {$yturbo_options['ytselectmenu']='Не использовать';}
    if (!isset($yturbo_options['ytshare'])) {$yturbo_options['ytshare']='disabled';}
    if (!isset($yturbo_options['ytnetw'])) {$yturbo_options['ytnetw']='vkontakte,facebook,twitter,odnoklassniki,telegram,';}
    if (!isset($yturbo_options['ytcomments'])) {$yturbo_options['ytcomments']='disabled';}
    if (!isset($yturbo_options['ytcommentsavatar'])) {$yturbo_options['ytcommentsavatar']='disabled';}
    if (!isset($yturbo_options['ytcommentsnumber'])) {$yturbo_options['ytcommentsnumber']='40';}
    if (!isset($yturbo_options['ytcommentsorder'])) {$yturbo_options['ytcommentsorder']='В начале старые комментарии';}
    if (!isset($yturbo_options['ytcommentsdate'])) {$yturbo_options['ytcommentsdate']='enabled';}
    if (!isset($yturbo_options['ytcommentsdrevo'])) {$yturbo_options['ytcommentsdrevo']='enabled';}
    if (!isset($yturbo_options['ytpostdate'])) {$yturbo_options['ytpostdate']='enabled';}
    if (!isset($yturbo_options['ytexcerpt'])) {$yturbo_options['ytexcerpt']='disabled';}
    if (!isset($yturbo_options['ytad4'])) {$yturbo_options['ytad4']='disabled';}
    if (!isset($yturbo_options['ytad4set'])) {$yturbo_options['ytad4set']='РСЯ';}
    if (!isset($yturbo_options['ytad4rsa'])) {$yturbo_options['ytad4rsa']='';}
    if (!isset($yturbo_options['ytadfox4'])) {$yturbo_options['ytadfox4']='';}
    if (!isset($yturbo_options['ytad5'])) {$yturbo_options['ytad5']='disabled';}
    if (!isset($yturbo_options['ytad5set'])) {$yturbo_options['ytad5set']='РСЯ';}
    if (!isset($yturbo_options['ytad5rsa'])) {$yturbo_options['ytad5rsa']='';}
    if (!isset($yturbo_options['ytadfox5'])) {$yturbo_options['ytadfox5']='';}
    if (!isset($yturbo_options['ytfeedback'])) {$yturbo_options['ytfeedback']='disabled';}
    if (!isset($yturbo_options['ytfeedbackselect'])) {$yturbo_options['ytfeedbackselect']='right';}
    if (!isset($yturbo_options['ytfeedbackselectmesto'])) {$yturbo_options['ytfeedbackselectmesto']='В конце записи';}
    if (!isset($yturbo_options['ytfeedbacktitle'])) {$yturbo_options['ytfeedbacktitle']='Обратная связь';}
    if (!isset($yturbo_options['ytfeedbacknetw'])) {$yturbo_options['ytfeedbacknetw']='call,mail,vkontakte,';}
    if (!isset($yturbo_options['ytfeedbackcall'])) {$yturbo_options['ytfeedbackcall']='';} 
    if (!isset($yturbo_options['ytfeedbackcallback'])) {$yturbo_options['ytfeedbackcallback']='';}
    if (!isset($yturbo_options['ytfeedbackcallback2'])) {$yturbo_options['ytfeedbackcallback2']='';}
    if (!isset($yturbo_options['ytfeedbackcallback3'])) {$yturbo_options['ytfeedbackcallback3']='';}
    if (!isset($yturbo_options['ytfeedbackmail'])) {$yturbo_options['ytfeedbackmail']='';}
    if (!isset($yturbo_options['ytfeedbackvkontakte'])) {$yturbo_options['ytfeedbackvkontakte']='';}
    if (!isset($yturbo_options['ytfeedbackodnoklassniki'])) {$yturbo_options['ytfeedbackodnoklassniki']='';}
    if (!isset($yturbo_options['ytfeedbacktwitter'])) {$yturbo_options['ytfeedbacktwitter']='';}
    if (!isset($yturbo_options['ytfeedbackfacebook'])) {$yturbo_options['ytfeedbackfacebook']='';}
    if (!isset($yturbo_options['ytfeedbackviber'])) {$yturbo_options['ytfeedbackviber']='';}
    if (!isset($yturbo_options['ytfeedbackwhatsapp'])) {$yturbo_options['ytfeedbackwhatsapp']='';}
    if (!isset($yturbo_options['ytfeedbacktelegram'])) {$yturbo_options['ytfeedbacktelegram']='';}
    if (!isset($yturbo_options['ytexcludeshortcodes'])) {$yturbo_options['ytexcludeshortcodes']='disabled';}
    if (!isset($yturbo_options['ytexcludeshortcodeslist'])) {$yturbo_options['ytexcludeshortcodeslist']='contact-form-7,';}
    if (!isset($yturbo_options['yttab'])) {$yturbo_options['yttab']='RSS-лента';}
    if (!isset($yturbo_options['ytrating'])) {$yturbo_options['ytrating']='disabled';}
    if (!isset($yturbo_options['ytratingmin'])) {$yturbo_options['ytratingmin']='4.70';}
    if (!isset($yturbo_options['ytratingmax'])) {$yturbo_options['ytratingmax']='5.00';}

    $yturbo_options['ytnetw'] = str_replace('google,', '', $yturbo_options['ytnetw']);
    $yturbo_options['ytfeedbacknetw'] = str_replace('google,', '', $yturbo_options['ytfeedbacknetw']);

    if (!isset($yturbo_options['ytsearch'])) {$yturbo_options['ytsearch']='disabled';}
    if (!isset($yturbo_options['ytsearchplaceholder'])) {$yturbo_options['ytsearchplaceholder']='Поиск по сайту';}
    if (!isset($yturbo_options['ytsearchmesto'])) {$yturbo_options['ytsearchmesto']='В конце записи';}

    if (!isset($yturbo_options['yttoc'])) {$yturbo_options['yttoc']='disabled';}
    if (!isset($yturbo_options['yttype2'])) {$yturbo_options['yttype2']='post';}
    if (!isset($yturbo_options['yttoczag'])) {$yturbo_options['yttoczag']='Содержание';}
    if (!isset($yturbo_options['yttocmesto'])) {$yturbo_options['yttocmesto']='В начале записи';}
    if (!isset($yturbo_options['yttocnumber'])) {$yturbo_options['yttocnumber']='2';}
    if (!isset($yturbo_options['yttoch1'])) {$yturbo_options['yttoch1']='disabled';}
    if (!isset($yturbo_options['yttoch2'])) {$yturbo_options['yttoch2']='enabled';}
    if (!isset($yturbo_options['yttoch3'])) {$yturbo_options['yttoch3']='enabled';}
    if (!isset($yturbo_options['yttoch4'])) {$yturbo_options['yttoch4']='disabled';}
    if (!isset($yturbo_options['yttoch5'])) {$yturbo_options['yttoch5']='disabled';}
    if (!isset($yturbo_options['yttoch6'])) {$yturbo_options['yttoch6']='disabled';}

    if (!isset($yturbo_options['ytprotokol'])) {$yturbo_options['ytprotokol']='asis';}
    if (!isset($yturbo_options['ytdateformat'])) {$yturbo_options['ytdateformat']='create';}
    if (!isset($yturbo_options['ytturbocolumn'])) {$yturbo_options['ytturbocolumn']='enabled';}

    $yturbo_options['ytfigcaption'] = 'Использовать подписи';

    if (!isset($yturbo_options['ytrelateddate'])) {$yturbo_options['ytrelateddate']='12';}

    $yturbo_options['yttitle'] = esc_html(yturbo_remove_emoji(strip_tags($yturbo_options['yttitle'])));
    $yturbo_options['ytdescription'] = esc_html(yturbo_remove_emoji(strip_tags($yturbo_options['ytdescription'])));
    if (!isset($yturbo_options['required'])) {$yturbo_options['required']='1.00';}

    // новый формат хранения удаляемых тегов begin
    $yturbo_options['ytexcludetagslist'] = preg_replace('/[^A-Za-z0-9,]/', '', html_entity_decode($yturbo_options['ytexcludetagslist']));
    $yturbo_options['ytexcludetagslist'] = mb_strtolower($yturbo_options['ytexcludetagslist']);
    $a = explode(",", $yturbo_options['ytexcludetagslist'] );
    $a = array_diff($a, array(''));
    $yturbo_options['ytexcludetagslist'] = implode(",", $a );
    // новый формат хранения удаляемых тегов end

    // новый формат хранения удаляемых тегов begin
    $yturbo_options['ytexcludetagslist2'] = preg_replace('/[^A-Za-z0-9,]/', '', html_entity_decode($yturbo_options['ytexcludetagslist2']));
    $yturbo_options['ytexcludetagslist2'] = mb_strtolower($yturbo_options['ytexcludetagslist2']);
    $a = explode(",", $yturbo_options['ytexcludetagslist2'] );
    $a = array_diff($a, array(''));
    $yturbo_options['ytexcludetagslist2'] = implode(",", $a );
    // новый формат хранения удаляемых тегов end

    if (!isset($yturbo_options['ytexcludeurls'])) {$yturbo_options['ytexcludeurls']='disabled';}
    if (!isset($yturbo_options['ytexcludeurlslist'])) {$yturbo_options['ytexcludeurlslist']='';}
    if (!isset($yturbo_options['ytdeltracking'])) {$yturbo_options['ytdeltracking']='disabled';}


    $yturbo_options['version'] = '1.27';
    update_option('yturbo_options', $yturbo_options);
}
//функция установки новых опций при обновлении плагина у пользователей end

//функция установки значений по умолчанию при активации плагина begin
function yturbo_init() {
    $yturbo_options = array();
    $yturbo_options['version'] = '1.27';
    $yturbo_options['ytrssname'] = 'turbo';
    $yturbo_options['yttitle'] = esc_html(yturbo_remove_emoji(strip_tags(get_bloginfo_rss('title'))));
    $yturbo_options['ytlink'] = get_bloginfo_rss('url');
    $yturbo_options['ytdescription'] = esc_html(yturbo_remove_emoji(strip_tags(get_bloginfo_rss('description'))));
    $yturbo_options['ytlanguage'] = 'ru';
    $yturbo_options['ytnumber'] = '250';
    $yturbo_options['yttype'] = 'post';
    $yturbo_options['ytrazb'] = 'enabled';
    $yturbo_options['ytrazbnumber'] = '50';
    $yturbo_options['ytfigcaption'] = 'Использовать подписи';
    $yturbo_options['ytauthorselect'] = 'Отключить указание автора';
    $yturbo_options['ytauthor'] = '';
    $yturbo_options['ytthumbnail'] = 'enabled';
    $yturbo_options['ytselectthumb'] = 'large';
    $yturbo_options['ytexcludetags'] = 'enabled';
    $yturbo_options['ytexcludetagslist'] = 'span';
    $yturbo_options['ytexcludetags2'] = 'enabled';
    $yturbo_options['ytexcludetagslist2'] = 'script,style';
    $yturbo_options['ytexcludecontent'] = 'disabled';
    $yturbo_options['ytexcludecontentlist'] = esc_textarea('<!--more-->\n<p></p>\n<p>&nbsp;</p>');

    $yturbo_options['ytad1'] = 'disabled';
    $yturbo_options['ytad1set'] = 'РСЯ';
    $yturbo_options['ytad1rsa'] = '';
    $yturbo_options['ytadfox1'] = '';

    $yturbo_options['ytad2'] = 'disabled';
    $yturbo_options['ytad2set'] = 'РСЯ';
    $yturbo_options['ytad2rsa'] = '';
    $yturbo_options['ytadfox2'] = '';

    $yturbo_options['ytad3'] = 'disabled';
    $yturbo_options['ytad3set'] = 'РСЯ';
    $yturbo_options['ytad3rsa'] = '';
    $yturbo_options['ytadfox3'] = '';

    $yturbo_options['ytad4'] = 'disabled';
    $yturbo_options['ytad4set'] = 'РСЯ';
    $yturbo_options['ytad4rsa'] = '';
    $yturbo_options['ytadfox4'] = '';

    $yturbo_options['ytad5'] = 'disabled';
    $yturbo_options['ytad5set'] = 'РСЯ';
    $yturbo_options['ytad5rsa'] = '';
    $yturbo_options['ytadfox5'] = '';

    $yturbo_options['ytrelated'] = 'enabled';
    $yturbo_options['ytrelatednumber'] = '5';
    $yturbo_options['ytrelatedselectthumb'] = 'thumbnail';
    $yturbo_options['ytrelatedcache'] = 'enabled';
    $yturbo_options['ytrelatedcachetime'] = '72';
    $yturbo_options['ytrelatedinfinity'] = 'disabled';

    $yturbo_options['ytrazmer'] = '500';
    $yturbo_options['ytremoveturbo'] = 'disabled';

    $yturbo_options['ytmetrika'] = '';
    $yturbo_options['ytliveinternet'] = '';
    $yturbo_options['ytgoogle'] = '';
    $yturbo_options['ytmailru'] = '';
    $yturbo_options['ytrambler'] = '';
    $yturbo_options['ytmediascope'] = '';

    $yturbo_options['ytqueryselect'] = 'Все таксономии, кроме исключенных';
    $yturbo_options['yttaxlist'] = '';
    $yturbo_options['ytaddtaxlist'] = '';

    $yturbo_options['ytselectmenu'] = 'Не использовать';
    $yturbo_options['ytshare'] = 'disabled';
    $yturbo_options['ytnetw'] = 'vkontakte,facebook,twitter,odnoklassniki,telegram,';
    $yturbo_options['ytcomments'] = 'disabled';
    $yturbo_options['ytcommentsavatar'] = 'disabled';
    $yturbo_options['ytcommentsnumber'] = '40';
    $yturbo_options['ytcommentsorder'] = 'В начале старые комментарии';
    $yturbo_options['ytcommentsdate'] = 'enabled';
    $yturbo_options['ytcommentsdrevo'] = 'enabled';
    $yturbo_options['ytpostdate'] = 'disabled';
    $yturbo_options['ytexcerpt'] = 'disabled';

    $yturbo_options['ytfeedback'] = 'disabled';
    $yturbo_options['ytfeedbackselect'] = 'right';
    $yturbo_options['ytfeedbackselectmesto'] = 'В конце записи';
    $yturbo_options['ytfeedbacktitle'] = 'Обратная связь';
    $yturbo_options['ytfeedbacknetw'] = 'call,mail,vkontakte,';

    $yturbo_options['ytfeedbackcall'] = '';
    $yturbo_options['ytfeedbackcallback'] = '';
    $yturbo_options['ytfeedbackcallback2'] = '';
    $yturbo_options['ytfeedbackcallback3'] = '';
    $yturbo_options['ytfeedbackmail'] = '';
    $yturbo_options['ytfeedbackvkontakte'] = '';
    $yturbo_options['ytfeedbackodnoklassniki'] = '';
    $yturbo_options['ytfeedbacktwitter'] = '';
    $yturbo_options['ytfeedbackfacebook'] = '';
    $yturbo_options['ytfeedbackviber'] = '';
    $yturbo_options['ytfeedbackwhatsapp'] = '';
    $yturbo_options['ytfeedbacktelegram'] = '';

    $yturbo_options['ytexcludeshortcodes'] = 'disabled';
    $yturbo_options['ytexcludeshortcodeslist'] = 'contact-form-7,';
    $yturbo_options['yttab'] = 'RSS-лента';

    $yturbo_options['ytrating'] = 'disabled';
    $yturbo_options['ytratingmin'] = '4.70';
    $yturbo_options['ytratingmax'] = '5.00';

    $yturbo_options['ytsearch'] = 'disabled';
    $yturbo_options['ytsearchplaceholder'] = 'Поиск по сайту';
    $yturbo_options['ytsearchmesto'] = 'В конце записи';

    $yturbo_options['yttoc'] = 'disabled';
    $yturbo_options['yttype2'] = 'post';
    $yturbo_options['yttoczag'] = 'Содержание';
    $yturbo_options['yttocmesto'] = 'В начале записи';
    $yturbo_options['yttocnumber'] = '2';
    $yturbo_options['yttoch1'] = 'disabled';
    $yturbo_options['yttoch2'] = 'enabled';
    $yturbo_options['yttoch3'] = 'enabled';
    $yturbo_options['yttoch4'] = 'disabled';
    $yturbo_options['yttoch5'] = 'disabled';
    $yturbo_options['yttoch6'] = 'disabled';

    $yturbo_options['ytprotokol'] = 'asis';
    $yturbo_options['ytdateformat'] = 'create';
    $yturbo_options['ytturbocolumn'] = 'enabled';
    $yturbo_options['ytrelateddate'] = '12';

    $yturbo_options['ytexcludeurls'] = 'disabled';
    $yturbo_options['ytexcludeurlslist'] = '';
    $yturbo_options['ytdeltracking'] = 'disabled';

    $yturbo_options['required']='1.00';

    add_option('yturbo_options', $yturbo_options);

    yturbo_add_feed();
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}
add_action( 'activate_rss-for-yandex-turbo/rss-for-yandex-turbo.php', 'yturbo_init' );
//функция установки значений по умолчанию при активации плагина end

//функция при деактивации плагина begin
function yturbo_on_deactivation() {
    if ( ! current_user_can('activate_plugins') ) return;

    //удаляем ленту плагина при деактивации плагина и обновляем пермалинки begin
    $yturbo_options = get_option('yturbo_options');
    global $wp_rewrite;
    if ( in_array( $yturbo_options['ytrssname'], $wp_rewrite->feeds ) ) {
        unset($wp_rewrite->feeds[array_search($yturbo_options['ytrssname'], $wp_rewrite->feeds)]);
    }
    $wp_rewrite->flush_rules();
    //удаляем ленту плагина при деактивации плагина и обновляем пермалинки end
}
register_deactivation_hook( __FILE__, 'yturbo_on_deactivation' );
//функция при деактивации плагина end

//функция при удалении плагина begin
function yturbo_on_uninstall() {
    if ( ! current_user_can('activate_plugins') ) return;
    delete_option('yturbo_options');
    AdminNotice::cleanUpDatabase('yturbo-');
}
register_uninstall_hook( __FILE__, 'yturbo_on_uninstall' );
//функция при удалении плагина end

//загрузка файла локализации плагина begin
function yturbo_setup() {
    load_plugin_textdomain('rss-for-yandex-turbo');
}
add_action( 'init', 'yturbo_setup' );
//загрузка файла локализации плагина end

//добавление ссылки "Настройки" на странице со списком плагинов begin
function yturbo_actions( $links ) {
    return array_merge(array('settings' => '<a href="options-general.php?page=rss-for-yandex-turbo.php">' . __('Настройки', 'rss-for-yandex-turbo') . '</a>'), $links);
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ),'yturbo_actions' );
//добавление ссылки "Настройки" на странице со списком плагинов end

//функция загрузки скриптов и стилей плагина только в админке и только на странице настроек плагина begin
function yturbo_files_admin( $hook_suffix ) {
    $purl = plugins_url('', __FILE__);
    $yturbo_options = get_option('yturbo_options');
    if ( $hook_suffix == 'settings_page_rss-for-yandex-turbo' ) {
        wp_enqueue_script('jquery');
        wp_enqueue_script('yturbo-tagify-js', $purl . '/inc/tagify.js', array(), $yturbo_options['version']);
        wp_enqueue_style('yturbo-tagify-css', $purl . '/inc/tagify.css', array(), $yturbo_options['version']);
        wp_enqueue_script('yturbo-script', $purl . '/inc/yturbo-script.js', array(), $yturbo_options['version']);
        wp_enqueue_style('yturbo-css', $purl . '/inc/yturbo-css.css', array(), $yturbo_options['version']);
    }
}
add_action( 'admin_enqueue_scripts', 'yturbo_files_admin' );
//функция загрузки скриптов и стилей плагина только в админке и только на странице настроек плагина end

//функция вывода страницы настроек плагина begin
function yturbo_options_page() {
$purl = plugins_url('', __FILE__);

if (isset($_POST['submit'])) {

//проверка безопасности при сохранении настроек плагина begin
if ( ! wp_verify_nonce( $_POST['yturbo_nonce'], plugin_basename(__FILE__) ) || ! current_user_can('edit_posts') ) {
    wp_die(__( 'Cheatin&#8217; uh?', 'rss-for-yandex-turbo' ));
}
//проверка безопасности при сохранении настроек плагина end

    //проверяем и сохраняем введенные пользователем данные begin
    $yturbo_options = get_option('yturbo_options');

    if (!preg_match('/[^A-Za-z0-9]/', $_POST['ytrssname'])) {
        $yturbo_options['ytrssname'] = $_POST['ytrssname'];
        update_option('yturbo_options', $yturbo_options);
        yturbo_add_feed();
        global $wp_rewrite;
        $wp_rewrite->flush_rules();
    }

    $yturbo_options['yttitle'] = esc_html(yturbo_remove_emoji(strip_tags($_POST['yttitle'])));
    $yturbo_options['ytlink'] = esc_url_raw($_POST['ytlink']);
    $yturbo_options['ytdescription'] = esc_html(yturbo_remove_emoji(strip_tags($_POST['ytdescription'])));
    $yturbo_options['ytlanguage'] = sanitize_text_field($_POST['ytlanguage']);

    $ytnumber = sanitize_text_field($_POST['ytnumber']);
    if (is_numeric($ytnumber)) {
        $yturbo_options['ytnumber'] = sanitize_text_field($_POST['ytnumber']);
    }

    if(isset($_POST['ytrazb'])){$yturbo_options['ytrazb'] = sanitize_text_field($_POST['ytrazb']);}else{$yturbo_options['ytrazb'] = 'disabled';}
    $ytrazbnumber = sanitize_text_field($_POST['ytrazbnumber']);
    if (is_numeric($ytrazbnumber)) {
        $yturbo_options['ytrazbnumber'] = sanitize_text_field($_POST['ytrazbnumber']);
    }

    $yturbo_options['yttype'] = '';
    $checkboxes = isset($_POST['types']) ? $_POST['types'] : array();
    foreach($checkboxes as $value) {$yturbo_options['yttype'] .= $value . ',';}
    $yturbo_options['yttype'] = sanitize_text_field($yturbo_options['yttype']);

    $yturbo_options['ytfigcaption'] = sanitize_text_field($_POST['ytfigcaption']);
    $yturbo_options['ytauthorselect'] = sanitize_text_field($_POST['ytauthorselect']);
    $yturbo_options['ytauthor'] = sanitize_text_field($_POST['ytauthor']);

    if(isset($_POST['ytthumbnail'])){$yturbo_options['ytthumbnail'] = sanitize_text_field($_POST['ytthumbnail']);}else{$yturbo_options['ytthumbnail'] = 'disabled';}
    $yturbo_options['ytselectthumb'] = sanitize_text_field($_POST['ytselectthumb']);

    if(isset($_POST['ytexcludetags'])){$yturbo_options['ytexcludetags'] = sanitize_text_field($_POST['ytexcludetags']);}else{$yturbo_options['ytexcludetags'] = 'disabled';}
    $ytexcludetagslist = preg_replace('/[^A-Za-z0-9,]/', '', sanitize_text_field($_POST['ytexcludetagslist']));
    $yturbo_options['ytexcludetagslist'] = $ytexcludetagslist;

    if(isset($_POST['ytexcludetags2'])){$yturbo_options['ytexcludetags2'] = sanitize_text_field($_POST['ytexcludetags2']);}else{$yturbo_options['ytexcludetags2'] = 'disabled';}
    $ytexcludetagslist2 = preg_replace('/[^A-Za-z0-9,]/', '', sanitize_text_field($_POST['ytexcludetagslist2']));
    $yturbo_options['ytexcludetagslist2'] = $ytexcludetagslist2;

    if(isset($_POST['ytexcludecontent'])){$yturbo_options['ytexcludecontent'] = sanitize_text_field($_POST['ytexcludecontent']);}else{$yturbo_options['ytexcludecontent'] = 'disabled';}
    $lines = array_filter(explode("\n", trim(esc_textarea($_POST['ytexcludecontentlist']))));
    $yturbo_options['ytexcludecontentlist'] = implode("\n", $lines);

    if(isset($_POST['ytad1'])){$yturbo_options['ytad1'] = sanitize_text_field($_POST['ytad1']);}else{$yturbo_options['ytad1'] = 'disabled';}
    $yturbo_options['ytad1set'] = sanitize_text_field($_POST['ytad1set']);
    $yturbo_options['ytad1rsa'] = sanitize_text_field($_POST['ytad1rsa']);
    $yturbo_options['ytadfox1'] = esc_html($_POST['ytadfox1']);

    if(isset($_POST['ytad1'])) {
        if($yturbo_options['ytad1set'] == "РСЯ" && !$yturbo_options['ytad1rsa']) {$yturbo_options['ytad1'] = 'disabled';}
        if($yturbo_options['ytad1set'] == "ADFOX" && !$yturbo_options['ytadfox1']) {$yturbo_options['ytad1'] = 'disabled';}
    }

    if(isset($_POST['ytad2'])){$yturbo_options['ytad2'] = sanitize_text_field($_POST['ytad2']);}else{$yturbo_options['ytad2'] = 'disabled';}
    $yturbo_options['ytad2set'] = sanitize_text_field($_POST['ytad2set']);
    $yturbo_options['ytad2rsa'] = sanitize_text_field($_POST['ytad2rsa']);
    $yturbo_options['ytadfox2'] = esc_html($_POST['ytadfox2']);

    if(isset($_POST['ytad2'])) {
        if($yturbo_options['ytad2set'] == "РСЯ" && !$yturbo_options['ytad2rsa']) {$yturbo_options['ytad2'] = 'disabled';}
        if($yturbo_options['ytad2set'] == "ADFOX" && !$yturbo_options['ytadfox2']) {$yturbo_options['ytad2'] = 'disabled';}
    }

    if(isset($_POST['ytad3'])){$yturbo_options['ytad3'] = sanitize_text_field($_POST['ytad3']);}else{$yturbo_options['ytad3'] = 'disabled';}
    $yturbo_options['ytad3set'] = sanitize_text_field($_POST['ytad3set']);
    $yturbo_options['ytad3rsa'] = sanitize_text_field($_POST['ytad3rsa']);
    $yturbo_options['ytadfox3'] = esc_html($_POST['ytadfox3']);

    if(isset($_POST['ytad3'])) {
        if($yturbo_options['ytad3set'] == "РСЯ" && !$yturbo_options['ytad3rsa']) {$yturbo_options['ytad3'] = 'disabled';}
        if($yturbo_options['ytad3set'] == "ADFOX" && !$yturbo_options['ytadfox3']) {$yturbo_options['ytad3'] = 'disabled';}
    }

    if(isset($_POST['ytad4'])){$yturbo_options['ytad4'] = sanitize_text_field($_POST['ytad4']);}else{$yturbo_options['ytad4'] = 'disabled';}
    $yturbo_options['ytad4set'] = sanitize_text_field($_POST['ytad4set']);
    $yturbo_options['ytad4rsa'] = sanitize_text_field($_POST['ytad4rsa']);
    $yturbo_options['ytadfox4'] = esc_html($_POST['ytadfox4']);

    if(isset($_POST['ytad4'])) {
        if($yturbo_options['ytad4set'] == "РСЯ" && !$yturbo_options['ytad4rsa']) {$yturbo_options['ytad4'] = 'disabled';}
        if($yturbo_options['ytad4set'] == "ADFOX" && !$yturbo_options['ytadfox4']) {$yturbo_options['ytad4'] = 'disabled';}
    }

    if(isset($_POST['ytad5'])){$yturbo_options['ytad5'] = sanitize_text_field($_POST['ytad5']);}else{$yturbo_options['ytad5'] = 'disabled';}
    $yturbo_options['ytad5set'] = sanitize_text_field($_POST['ytad5set']);
    $yturbo_options['ytad5rsa'] = sanitize_text_field($_POST['ytad5rsa']);
    $yturbo_options['ytadfox5'] = esc_html($_POST['ytadfox5']);

    if(isset($_POST['ytad5'])) {
        if($yturbo_options['ytad5set'] == "РСЯ" && !$yturbo_options['ytad5rsa']) {$yturbo_options['ytad5'] = 'disabled';}
        if($yturbo_options['ytad5set'] == "ADFOX" && !$yturbo_options['ytadfox5']) {$yturbo_options['ytad5'] = 'disabled';}
    }
    if ( yturbo_check_ads() == true ) {
        $yturbo_options['ytad1'] = 'disabled';
        $yturbo_options['ytad2'] = 'disabled';
        $yturbo_options['ytad3'] = 'disabled';
        $yturbo_options['ytad4'] = 'disabled';
        $yturbo_options['ytad5'] = 'disabled';
    }

    if(isset($_POST['ytrelated'])){$yturbo_options['ytrelated'] = sanitize_text_field($_POST['ytrelated']);}else{$yturbo_options['ytrelated'] = 'disabled';}
    $ytrelatednumber = sanitize_text_field($_POST['ytrelatednumber']);
    if (is_numeric($ytrelatednumber) && (int)$ytrelatednumber<=30) {
        $yturbo_options['ytrelatednumber'] = sanitize_text_field($_POST['ytrelatednumber']);
    }
    $yturbo_options['ytrelatedselectthumb'] = sanitize_text_field($_POST['ytrelatedselectthumb']);
    if(isset($_POST['ytrelatedcache'])){$yturbo_options['ytrelatedcache'] = sanitize_text_field($_POST['ytrelatedcache']);}else{$yturbo_options['ytrelatedcache'] = 'disabled';}
    $ytrelatedcachetime = sanitize_text_field($_POST['ytrelatedcachetime']);
    if (is_numeric($ytrelatedcachetime)) {
        $yturbo_options['ytrelatedcachetime'] = sanitize_text_field($_POST['ytrelatedcachetime']);
    }
    if(isset($_POST['ytrelatedinfinity'])){$yturbo_options['ytrelatedinfinity'] = sanitize_text_field($_POST['ytrelatedinfinity']);}else{$yturbo_options['ytrelatedinfinity'] = 'disabled';}
    if($yturbo_options['ytrelatedinfinity']=='enabled'){$yturbo_options['ytrelatedselectthumb']='Не использовать';}
    
    $ytrazmer = sanitize_text_field($_POST['ytrazmer']);
    if (is_numeric($ytrazmer)) {
        $yturbo_options['ytrazmer'] = sanitize_text_field($_POST['ytrazmer']);
    }

    if(isset($_POST['ytremoveturbo'])){$yturbo_options['ytremoveturbo'] = sanitize_text_field($_POST['ytremoveturbo']);}else{$yturbo_options['ytremoveturbo'] = 'disabled';}

    $yturbo_options['ytmetrika'] = sanitize_text_field($_POST['ytmetrika']);
    $yturbo_options['ytliveinternet'] = sanitize_text_field($_POST['ytliveinternet']);
    $yturbo_options['ytgoogle'] = sanitize_text_field($_POST['ytgoogle']);
    $yturbo_options['ytmailru'] = sanitize_text_field($_POST['ytmailru']);
    $yturbo_options['ytrambler'] = sanitize_text_field($_POST['ytrambler']);
    $yturbo_options['ytmediascope'] = sanitize_text_field($_POST['ytmediascope']);

    $yturbo_options['ytqueryselect'] = sanitize_text_field($_POST['ytqueryselect']);

    $yturbo_options['yttaxlist'] = str_replace(' ', '', esc_textarea($_POST['yttaxlist']));
    $yturbo_options['ytaddtaxlist'] = str_replace(' ', '', esc_textarea($_POST['ytaddtaxlist']));

    $yturbo_options['ytselectmenu'] = sanitize_text_field($_POST['ytselectmenu']);
    if(isset($_POST['ytshare'])){$yturbo_options['ytshare'] = sanitize_text_field($_POST['ytshare']);}else{$yturbo_options['ytshare'] = 'disabled';}
    $yturbo_options['ytnetw'] = sanitize_text_field($_POST['ytnetwspan']);
    if(isset($_POST['ytcomments'])){$yturbo_options['ytcomments'] = sanitize_text_field($_POST['ytcomments']);}else{$yturbo_options['ytcomments'] = 'disabled';}
    if(isset($_POST['ytcommentsavatar'])){$yturbo_options['ytcommentsavatar'] = sanitize_text_field($_POST['ytcommentsavatar']);}else{$yturbo_options['ytcommentsavatar'] = 'disabled';}
    $ytcommentsnumber = sanitize_text_field($_POST['ytcommentsnumber']);
    if (is_numeric($ytcommentsnumber) && (int)$ytcommentsnumber<=40) {
        $yturbo_options['ytcommentsnumber'] = sanitize_text_field($_POST['ytcommentsnumber']);
    }
    $yturbo_options['ytcommentsorder'] = sanitize_text_field($_POST['ytcommentsorder']);
    if(isset($_POST['ytcommentsdate'])){$yturbo_options['ytcommentsdate'] = sanitize_text_field($_POST['ytcommentsdate']);}else{$yturbo_options['ytcommentsdate'] = 'disabled';}
    if(isset($_POST['ytcommentsdrevo'])){$yturbo_options['ytcommentsdrevo'] = sanitize_text_field($_POST['ytcommentsdrevo']);}else{$yturbo_options['ytcommentsdrevo'] = 'disabled';}
    if(isset($_POST['ytpostdate'])){$yturbo_options['ytpostdate'] = sanitize_text_field($_POST['ytpostdate']);}else{$yturbo_options['ytpostdate'] = 'disabled';}
    if(isset($_POST['ytexcerpt'])){$yturbo_options['ytexcerpt'] = sanitize_text_field($_POST['ytexcerpt']);}else{$yturbo_options['ytexcerpt'] = 'disabled';}

    if(isset($_POST['ytfeedback'])){$yturbo_options['ytfeedback'] = sanitize_text_field($_POST['ytfeedback']);}else{$yturbo_options['ytfeedback'] = 'disabled';}
    $yturbo_options['ytfeedbackselect'] = sanitize_text_field($_POST['ytfeedbackselect']);
    $yturbo_options['ytfeedbackselectmesto'] = sanitize_text_field($_POST['ytfeedbackselectmesto']);
    $yturbo_options['ytfeedbacktitle'] = sanitize_text_field($_POST['ytfeedbacktitle']);
    $yturbo_options['ytfeedbacknetw'] = sanitize_text_field($_POST['ytfeedbacknetwspan']);

    $yturbo_options['ytfeedbackcall'] = sanitize_text_field($_POST['ytfeedbackcall']);
    $yturbo_options['ytfeedbackcallback'] = sanitize_text_field($_POST['ytfeedbackcallback']);
    $yturbo_options['ytfeedbackcallback2'] = sanitize_text_field(htmlspecialchars($_POST['ytfeedbackcallback2']));
    $yturbo_options['ytfeedbackcallback3'] = sanitize_text_field($_POST['ytfeedbackcallback3']);
    $yturbo_options['ytfeedbackmail'] = sanitize_text_field($_POST['ytfeedbackmail']);
    $yturbo_options['ytfeedbackvkontakte'] = sanitize_text_field($_POST['ytfeedbackvkontakte']);
    $yturbo_options['ytfeedbackodnoklassniki'] = sanitize_text_field($_POST['ytfeedbackodnoklassniki']);
    $yturbo_options['ytfeedbacktwitter'] = sanitize_text_field($_POST['ytfeedbacktwitter']);
    $yturbo_options['ytfeedbackfacebook'] = sanitize_text_field($_POST['ytfeedbackfacebook']);
    $yturbo_options['ytfeedbackviber'] = sanitize_text_field($_POST['ytfeedbackviber']);
    $yturbo_options['ytfeedbackwhatsapp'] = sanitize_text_field($_POST['ytfeedbackwhatsapp']);
    $yturbo_options['ytfeedbacktelegram'] = sanitize_text_field($_POST['ytfeedbacktelegram']);

    if(isset($_POST['ytexcludeshortcodes'])){$yturbo_options['ytexcludeshortcodes'] = sanitize_text_field($_POST['ytexcludeshortcodes']);}else{$yturbo_options['ytexcludeshortcodes'] = 'disabled';}
    $yturbo_options['ytexcludeshortcodeslist'] = '';
    $checkboxes = isset($_POST['shortcodes']) ? $_POST['shortcodes'] : array();
    foreach($checkboxes as $value) {$yturbo_options['ytexcludeshortcodeslist'] .= $value . ',';}

    $types = explode(",", $yturbo_options['yttype']);
    $types = array_diff($types, array(''));
    foreach ( $types  as $post_type ) {
        if (in_array($post_type, $types)) {
            if(isset($_POST['template-'.$post_type])) {
                $yturbo_options['template-'.$post_type] = esc_textarea($_POST['template-'.$post_type]);
            }
        }
    }

    $yturbo_options['yttab'] = sanitize_text_field($_POST['yttab']);

    if(isset($_POST['ytrating'])){$yturbo_options['ytrating'] = sanitize_text_field($_POST['ytrating']);}else{$yturbo_options['ytrating'] = 'disabled';}
    $yturbo_options['ytratingmin'] = sanitize_text_field($_POST['ytratingmin']);
    $yturbo_options['ytratingmax'] = sanitize_text_field($_POST['ytratingmax']);

    if(isset($_POST['ytsearch'])){$yturbo_options['ytsearch'] = sanitize_text_field($_POST['ytsearch']);}else{$yturbo_options['ytsearch'] = 'disabled';}
    $yturbo_options['ytsearchplaceholder'] = sanitize_text_field($_POST['ytsearchplaceholder']);
    $yturbo_options['ytsearchmesto'] = sanitize_text_field($_POST['ytsearchmesto']);

    if(isset($_POST['yttoc'])){$yturbo_options['yttoc'] = sanitize_text_field($_POST['yttoc']);}else{$yturbo_options['yttoc'] = 'disabled';}
    $yturbo_options['yttype2'] = '';
    $checkboxes = isset($_POST['types2']) ? $_POST['types2'] : array();
    foreach($checkboxes as $value) {$yturbo_options['yttype2'] .= $value . ',';}
    $yturbo_options['yttype2'] = sanitize_text_field($yturbo_options['yttype2']);
    $yturbo_options['yttoczag'] = sanitize_text_field($_POST['yttoczag']);
    $yturbo_options['yttocmesto'] = sanitize_text_field($_POST['yttocmesto']);
    $yttocnumber = sanitize_text_field($_POST['yttocnumber']);
    if (is_numeric($yttocnumber)) {
        $yturbo_options['yttocnumber'] = sanitize_text_field($_POST['yttocnumber']);
    }
    if(isset($_POST['yttoch1'])){$yturbo_options['yttoch1'] = sanitize_text_field($_POST['yttoch1']);}else{$yturbo_options['yttoch1'] = 'disabled';}
    if(isset($_POST['yttoch2'])){$yturbo_options['yttoch2'] = sanitize_text_field($_POST['yttoch2']);}else{$yturbo_options['yttoch2'] = 'disabled';}
    if(isset($_POST['yttoch3'])){$yturbo_options['yttoch3'] = sanitize_text_field($_POST['yttoch3']);}else{$yturbo_options['yttoch3'] = 'disabled';}
    if(isset($_POST['yttoch4'])){$yturbo_options['yttoch4'] = sanitize_text_field($_POST['yttoch4']);}else{$yturbo_options['yttoch4'] = 'disabled';}
    if(isset($_POST['yttoch5'])){$yturbo_options['yttoch5'] = sanitize_text_field($_POST['yttoch5']);}else{$yturbo_options['yttoch5'] = 'disabled';}
    if(isset($_POST['yttoch6'])){$yturbo_options['yttoch6'] = sanitize_text_field($_POST['yttoch6']);}else{$yturbo_options['yttoch6'] = 'disabled';}

    $yturbo_options['ytprotokol'] = sanitize_text_field($_POST['ytprotokol']);
    $yturbo_options['ytdateformat'] = sanitize_text_field($_POST['ytdateformat']);

    if(isset($_POST['ytturbocolumn'])){$yturbo_options['ytturbocolumn'] = sanitize_text_field($_POST['ytturbocolumn']);}else{$yturbo_options['ytturbocolumn'] = 'disabled';}

    $ytrelateddate = sanitize_text_field($_POST['ytrelateddate']);
    if (is_numeric($ytrelateddate)) {
        $yturbo_options['ytrelateddate'] = sanitize_text_field($_POST['ytrelateddate']);
    }

    if(isset($_POST['ytexcludeurls'])){$yturbo_options['ytexcludeurls'] = sanitize_text_field($_POST['ytexcludeurls']);}else{$yturbo_options['ytexcludeurls'] = 'disabled';}
    $lines = array_filter(explode("\n", trim(esc_textarea($_POST['ytexcludeurlslist']))));
    $yturbo_options['ytexcludeurlslist'] = implode("\n", $lines);
    if(isset($_POST['ytdeltracking'])){$yturbo_options['ytdeltracking'] = sanitize_text_field($_POST['ytdeltracking']);}else{$yturbo_options['ytdeltracking'] = 'disabled';}

    update_option('yturbo_options', $yturbo_options);

    yturbo_clear_transients();
    //проверяем и сохраняем введенные пользователем данные end
}
$yturbo_options = get_option('yturbo_options');
?>
<?php if ( ! empty($_POST) ) :
if ( ! wp_verify_nonce( $_POST['yturbo_nonce'], plugin_basename(__FILE__) ) || ! current_user_can('edit_posts') ) {
    wp_die(__( 'Cheatin&#8217; uh?', 'rss-for-yandex-turbo' ));
}
?>
<div id="message" class="updated fade"><p><strong><?php _e('Настройки сохранены.', 'rss-for-yandex-turbo'); ?></strong></p></div>
<?php else : ?>
    <?php $yturbo_options['yttab'] = 'RSS-лента'; ?>
<?php endif; ?>

<div class="wrap foptions">
<h2><?php _e('Настройки плагина &#8220;Яндекс.Турбо&#8220;', 'rss-for-yandex-turbo'); ?> <span id="current-version">v<?php echo $yturbo_options['version']; ?></span><span id="restore-hide-blocks" class="dashicons dashicons-admin-generic hide" title="<?php _e('Восстановить скрытые блоки', 'rss-for-yandex-turbo'); ?>"></span></h2>

<div class="metabox-holder" id="poststuff">
<div class="meta-box-sortables">

<div class="postbox" id="donat">
<script>
var closedonat = localStorage.getItem('yt-close-donat');
if (closedonat == 'yes') {
    document.getElementById('donat').className = 'postbox hide';
    document.getElementById('restore-hide-blocks').className = 'dashicons dashicons-admin-generic';
}
</script>
    <h3 style="border-bottom: 1px solid #E1E1E1;background: #f7f7f7;"><?php _e('Вам нравится этот плагин ?', 'rss-for-yandex-turbo'); ?>
    <span id="close-donat" class="dashicons dashicons-no-alt" title="<?php _e('Скрыть блок', 'rss-for-yandex-turbo'); ?>"></span></h3>
    <div class="inside" style="display: block;margin-right: 12px;">
        <img src="<?php echo $purl . '/img/icon_coffee.png'; ?>" title="<?php _e('Купить мне чашку кофе :)', 'rss-for-yandex-turbo'); ?>" style=" margin: 5px; float:left;" />
        <p><?php _e('Привет, меня зовут <strong>Flector</strong>.', 'rss-for-yandex-turbo'); ?></p>
        <p><?php _e('Я потратил много времени на разработку этого плагина.', 'rss-for-yandex-turbo'); ?> <br />
        <?php _e('Поэтому не откажусь от небольшого пожертвования :)', 'rss-for-yandex-turbo'); ?></p>
        <a target="_blank" id="yadonate" href="https://money.yandex.ru/to/41001443750704/200"><?php _e('Подарить', 'rss-for-yandex-turbo'); ?></a> 
        <p><?php _e('Или вы можете заказать у меня услуги по WordPress, от мелких правок до создания полноценного сайта.', 'rss-for-yandex-turbo'); ?><br />
        <?php _e('Быстро, качественно и дешево. Прайс-лист смотрите по адресу <a target="_blank" href="https://www.wpuslugi.ru/?from=yturbo-plugin">https://www.wpuslugi.ru/</a>.', 'rss-for-yandex-turbo'); ?></p>
        <div style="clear:both;"></div>
    </div>
</div>

<form action="" method="post">

<div class="xyztabs">

    <input style="left:-2000px;position: absolute;" type="text" name="yttab" id="yttab" size="30" value="<?php echo stripslashes($yturbo_options['yttab']); ?>" />
    <ul class="xyztabs__caption">
        <li <?php if($yturbo_options['yttab']=='RSS-лента'){echo 'class="active"';} ?>><?php _e('RSS-лента', 'rss-for-yandex-turbo'); ?></li>
        <li <?php if($yturbo_options['yttab']=='Оформление'){echo 'class="active"';} ?>><?php _e('Оформление', 'rss-for-yandex-turbo'); ?></li>
        <li <?php if($yturbo_options['yttab']=='Блоки Яндекс.Турбо'){echo 'class="active"';} ?>><?php _e('Блоки Яндекс.Турбо', 'rss-for-yandex-turbo'); ?></li>
        <li <?php if($yturbo_options['yttab']=='Счетчики'){echo 'class="active"';} ?>><?php _e('Счетчики', 'rss-for-yandex-turbo'); ?></li>
        <li <?php if($yturbo_options['yttab']=='Реклама'){echo 'class="active"';} ?>><?php _e('Реклама', 'rss-for-yandex-turbo'); ?></li>
        <li <?php if($yturbo_options['yttab']=='Типы записей и исключения'){echo 'class="active"';} ?>><?php _e('Типы записей и исключения', 'rss-for-yandex-turbo'); ?></li>
        <li <?php if($yturbo_options['yttab']=='Шаблоны'){echo 'class="active"';} ?>><?php _e('Шаблоны', 'rss-for-yandex-turbo'); ?></li>
        <li <?php if($yturbo_options['yttab']=='Фильтры'){echo 'class="active"';} ?>><?php _e('Фильтры', 'rss-for-yandex-turbo'); ?></li>
    </ul>

    <div class="xyztabs__content<?php if($yturbo_options['yttab']=='RSS-лента'){echo ' active';} ?>"><!-- begin tab -->

        <?php yturbo_count_feeds(); ?>

        <?php if ( get_option('permalink_structure') ) {
            $kor = get_bloginfo('url') .'/feed/' . '<strong>' . $yturbo_options['ytrssname'] . '</strong>/';
        } else {
            $kor = get_bloginfo('url') .'/?feed=' . '<strong>' . $yturbo_options['ytrssname']. '</strong>';
        } ?>

        <table class="form-table">
            <tr class="trbordertop">
                <th><?php _e('Имя RSS-ленты:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytrssname" size="40" value="<?php echo $yturbo_options['ytrssname']; ?>" />
                    <br /><small><?php _e('Текущий URL RSS-ленты:', 'rss-for-yandex-turbo'); ?> <tt><?php echo $kor; ?></tt><br />
                    <?php _e('Только буквы и цифры, не меняйте без необходимости.', 'rss-for-yandex-turbo'); ?>
                    </small>
                </td>
            </tr>
            <tr class="trbordertop">
                <th><?php _e('Заголовок:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="yttitle" size="40" value="<?php echo stripslashes($yturbo_options['yttitle']); ?>" />
                    <br /><small><?php _e('Название RSS-ленты. Если экспортируется содержимое всего сайта, укажите название сайта.', 'rss-for-yandex-turbo'); ?><br /> 
                    <?php _e('Если экспортируется раздел сайта, укажите только название раздела.', 'rss-for-yandex-turbo'); ?><br />
                    </small>
                </td>
            </tr>
            <tr>
                <th><?php _e('Ссылка:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytlink" size="40" value="<?php echo stripslashes($yturbo_options['ytlink']); ?>" />
                    <br /><small><?php _e('URL сайта, данные которого экспортируются в RSS-ленту.', 'rss-for-yandex-turbo'); ?> </small>
               </td>
            </tr>
            <tr>
                <th><?php _e('Описание:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytdescription" size="40" value="<?php echo stripslashes($yturbo_options['ytdescription']); ?>" />
                    <br /><small><?php _e('Описание RSS-ленты одним предложением. Не используйте HTML-разметку.', 'rss-for-yandex-turbo'); ?> </small>
               </td>
            </tr>
            <tr>
                <th><?php _e('Язык:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input style="max-width: 38px;" type="text" name="ytlanguage" value="<?php echo stripslashes($yturbo_options['ytlanguage']); ?>" />
                    <br /><small><?php _e('Язык статей RSS-ленты в стандарте <a target="_blank" href="https://ru.wikipedia.org/wiki/%D0%9A%D0%BE%D0%B4%D1%8B_%D1%8F%D0%B7%D1%8B%D0%BA%D0%BE%D0%B2">ISO 639-1</a> (Россия - <strong>ru</strong>, Украина - <strong>uk</strong> и т.д.).', 'rss-for-yandex-turbo'); ?> </small>
               </td>
            </tr>
            <tr class="trbordertop">
                <th><?php _e('Количество записей:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input style="max-width: 74px;" name="ytnumber" type="number" min="1" max="999999" step="1" value="<?php echo $yturbo_options['ytnumber']; ?>" />
                    <br /><small><?php _e('Общее количество записей в RSS-ленте (обязательно прочтите про <a target="_blank" href="https://yandex.ru/dev/turbo/doc/rss/quota-docpage/">ограничения</a> Яндекса).', 'rss-for-yandex-turbo'); ?> <br />
                    <?php _e('При установке более 1000 записей необходимо включить разбитие RSS-ленты в обязательном порядке.', 'rss-for-yandex-turbo'); ?> <br />
                    </small>
               </td>
            </tr>
            <tr class="razb trbordertop">
                <th class="tdcheckbox"><?php _e('Разбитие RSS-ленты:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytrazb"><input type="checkbox" value="enabled" name="ytrazb" id="ytrazb" <?php if ($yturbo_options['ytrazb'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Включить разбитие RSS-ленты', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('Плагин будет генерировать несколько RSS-лент с указанным числом записей в каждой.', 'rss-for-yandex-turbo'); ?> <br />
                    <?php _e('Включите эту опцию, если RSS-лента слишком долго генерируется или если она превышает <a target="_blank" href="https://yandex.ru/dev/turbo/doc/rss/quota-docpage/">ограничения</a>, установленные Яндексом.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Яндекс может очень сильно нагружать ваш сервер - разбитие ленты и использование плагинов кэширования будет в этом случае весьма полезно.', 'rss-for-yandex-turbo'); ?> <br />
                    </small>
                </td>
            </tr>
            <tr class="ytrazbnumbertr" <?php if ($yturbo_options['ytrazb'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Делить RSS-ленту по:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input style="max-width: 60px;" name="ytrazbnumber" type="number" min="1" max="1000" step="1" value="<?php echo $yturbo_options['ytrazbnumber']; ?>" />
                    <br /><small><?php _e('Укажите число записей, по которому лента будет делиться.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Для получения ссылок на ваши RSS-ленты сохраните настройки плагина.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Важно: разбитие не будет работать, если на вашем сайте нет необходимого числа записей.', 'rss-for-yandex-turbo'); ?> <br />
                    </small>
               </td>
            </tr>
            <tr class="ytexcludeurlstr trbordertop">
                <th class="tdcheckbox"><?php _e('Выборочное отключение:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytexcludeurls"><input type="checkbox" value="enabled" name="ytexcludeurls" id="ytexcludeurls" <?php if ($yturbo_options['ytexcludeurls'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Удалить указанные турбо-страницы', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('Если вы полностью удалили запись на сайте, то отключить ее турбо-страницу обычным способом не получится.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Эта опция позволит сформировать отдельную RSS-ленту с записями, которые Яндекс должен удалить.', 'rss-for-yandex-turbo'); ?><br />
                    </small>
                </td>
            </tr>
            <tr class="ytexcludeurlslisttr" <?php if ($yturbo_options['ytexcludeurls'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th class="tdcheckbox"><?php _e('URL "мусорной" ленты:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <?php
                    if ( get_option('permalink_structure') ) {
                        echo '<a target="_blank" href="'.get_bloginfo("url").'/feed/'.$yturbo_options['ytrssname'].'/?lenta=trash'.'">'.get_bloginfo("url").'/feed/'.$yturbo_options['ytrssname'].'/?lenta=trash'.'</a>';
                    } else {
                        echo '<a target="_blank" href="'.get_bloginfo("url").'/?feed='.$yturbo_options['ytrssname'].'&lenta=trash">'.get_bloginfo("url").'/?feed='.$yturbo_options['ytrssname'].'&lenta=trash</a>';
                    }
                    ?>
                    <br /><small><?php _e('Добавьте эту RSS-ленту в Яндекс.Вебмастер как обычную ленту.', 'rss-for-yandex-turbo'); ?><br />
                    </small>
                </td>
            </tr>
            <tr class="ytexcludeurlslisttr" <?php if ($yturbo_options['ytexcludeurls'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th class="tdcheckbox"><?php _e('Отслеживание:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytdeltracking"><input type="checkbox" value="enabled" name="ytdeltracking" id="ytdeltracking" <?php if ($yturbo_options['ytdeltracking'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Следить за удаляемыми записями', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('Плагин будет автоматически добавлять в список ниже ссылки на удаленные записи.', 'rss-for-yandex-turbo'); ?><br />
                    
                    </small>
                </td>
            </tr>
            <tr class="ytexcludeurlslisttr" <?php if ($yturbo_options['ytexcludeurls'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Список удаляемых ссылок:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <textarea rows="8" cols="70" name="ytexcludeurlslist" id="ytexcludeurlslist"><?php echo stripcslashes($yturbo_options['ytexcludeurlslist']); ?></textarea>
                    <br /><small><?php _e('Каждая новая ссылка для удаления должна начинаться с новой строки.', 'rss-for-yandex-turbo'); ?><br />
                    </small>
                </td>
            </tr>
            <tr class="trbordertop">
                <th class="tdcheckbox"><?php _e('Полное отключение:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytremoveturbo"><input type="checkbox" value="enabled" name="ytremoveturbo" id="ytremoveturbo" <?php if ($yturbo_options['ytremoveturbo'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Удалить все турбо-страницы', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('Эта опция добавит в RSS-ленту атрибут <tt>turbo="false"</tt> к тегу <tt>&lt;item></tt> для всех записей.', 'rss-for-yandex-turbo'); ?> <br />
                    <?php _e('Это единственный способ заставить Яндекс отключить турбо-страницы для вашего сайта.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Простое удаление плагина не поможет - необходимо, чтобы бот Яндекса "съел" ленту с <tt>turbo="false"</tt>.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Не забудьте поправить настройки плагина, чтобы в RSS-ленту попали все записи сайта.', 'rss-for-yandex-turbo'); ?>
                    </small>
                </td>
            </tr>
            <tr class="ytprotokoltr" <?php if ($yturbo_options['ytremoveturbo'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Протокол:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <select name="ytprotokol" style="width: 260px;">
                        <option value="asis" <?php if ($yturbo_options['ytprotokol'] == 'asis') echo 'selected="selected"'; ?>><?php _e('Не менять протокол', 'rss-for-yandex-turbo'); ?></option>
                        <option value="http" <?php if ($yturbo_options['ytprotokol'] == 'http') echo 'selected="selected"'; ?>><?php _e('http', 'rss-for-yandex-turbo'); ?></option>
                        <option value="https" <?php if ($yturbo_options['ytprotokol'] == 'https') echo 'selected="selected"'; ?>><?php _e('https', 'rss-for-yandex-turbo'); ?></option>
                    </select>
                    <br /><small><?php _e('Выберите используемый протокол для удаляемых турбо-страниц.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Яндекс не удалит автоматически турбо-страницы для старого протокола (при переезде сайта на https и наоборот).', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Поэтому вам нужно будет сформировать ленту с записями для удаления со старым протоколом.', 'rss-for-yandex-turbo'); ?><br />
                    </small>
                </td>
            </tr>

            <tr class="trbordertop">
                <th></th>
                <td>
                    <input type="submit" name="submit" class="button button-primary" value="<?php _e('Сохранить настройки &raquo;', 'rss-for-yandex-turbo'); ?>" />
                </td>
            </tr> 
        </table> 
    </div><!-- end tab -->

    <div class="xyztabs__content<?php if($yturbo_options['yttab']=='Оформление'){echo ' active';} ?>"><!-- begin tab -->

        <p><?php _e('В этом разделе собраны настройки, касающиеся оформления контента на турбо-страницах.', 'rss-for-yandex-turbo'); ?><br /> 
        <?php _e('Отключите вывод миниатюр, если они не выводятся в вашей теме на страницах одиночных записей,', 'rss-for-yandex-turbo'); ?><br /> 
        <?php _e('так как Яндексу не нравится, когда турбо-страница не соответствует оригинальной версии.', 'rss-for-yandex-turbo'); ?><br /> 
        </p>

        <table class="form-table">
            <tr class="trbordertop">
                <th class="tdcheckbox"><?php _e('Дата записей:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytpostdate"><input type="checkbox" value="enabled" name="ytpostdate" id="ytpostdate" <?php if ($yturbo_options['ytpostdate'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Указать дату публикации записей', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('Выводить или не выводить дату публикации записей в ленте.', 'rss-for-yandex-turbo'); ?> <br />
                    </small>
                </td>
            </tr>
            <tr class="ytdateformattr" <?php if ($yturbo_options['ytpostdate'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Тип даты:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <select name="ytdateformat" style="width: 260px;">
                        <option value="create" <?php if ($yturbo_options['ytdateformat'] == 'create') echo 'selected="selected"'; ?>><?php _e('Дата создания', 'rss-for-yandex-turbo'); ?></option>
                        <option value="mod" <?php if ($yturbo_options['ytdateformat'] == 'mod') echo 'selected="selected"'; ?>><?php _e('Дата последнего изменения', 'rss-for-yandex-turbo'); ?></option>
                    </select>
                    <br /><small><?php _e('Выберите тип даты - дата создания записи или дата последнего изменения записи.', 'rss-for-yandex-turbo'); ?> <br />
                    <?php _e('Опция может быть полезна для формирования Яндексом автоматической главной страницы.', 'rss-for-yandex-turbo'); ?> <br />
                    </small>
                </td>
            </tr>
            <tr class="trbordertop">
                <th class="tdcheckbox"><?php _e('Отрывок записей:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytexcerpt"><input type="checkbox" value="enabled" name="ytexcerpt" id="ytexcerpt" <?php if ($yturbo_options['ytexcerpt'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Добавить в начало записей "отрывок"', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('Используйте эту опцию только в случае необходимости.', 'rss-for-yandex-turbo'); ?> <br />
                    <?php _e('Например, когда "отрывок" (цитата) записи содержит контент, которого нет в самой записи.', 'rss-for-yandex-turbo'); ?> <br />
                    </small>
                </td>
            </tr>
            <tr class="ytthumbnailtr trbordertop">
                <th class="tdcheckbox"><?php _e('Миниатюра в RSS:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytthumbnail"><input type="checkbox" value="enabled" name="ytthumbnail" id="ytthumbnail" <?php if ($yturbo_options['ytthumbnail'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Добавить миниатюру к заголовку записи', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('После заголовка записи будет выведена миниатюра записи (изображение записи).', 'rss-for-yandex-turbo'); ?> 
                    </small>
                </td>
            </tr>
            <tr class="ytselectthumbtr" <?php if ($yturbo_options['ytthumbnail'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Размер миниатюры в RSS:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <select name="ytselectthumb" style="width: 260px;">
                        <?php $image_sizes = get_intermediate_image_sizes(); ?>
                        <?php foreach ($image_sizes as $size_name): ?>
                            <option value="<?php echo $size_name ?>" <?php if ($yturbo_options['ytselectthumb'] == $size_name) echo 'selected="selected"'; ?>><?php echo $size_name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <br /><small><?php _e('Выберите нужный размер миниатюры (в списке находятся все зарегистрированные на сайте размеры миниатюр).', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Необходимо выбрать именно тот размер, который используется вашей темой для вывода "Изображения записи".', 'rss-for-yandex-turbo'); ?><br />
                    </small>
                </td>
            </tr>
            <tr class="trbordertop">
                <th><?php _e('Автор записей:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <select name="ytauthorselect" id="ytauthorselect" style="width: 260px;">
                        <option value="Автор записи" <?php if ($yturbo_options['ytauthorselect'] == 'Автор записи') echo 'selected="selected"'; ?>><?php _e('Автор записи', 'rss-for-yandex-turbo'); ?></option>
                        <option value="Указать автора" <?php if ($yturbo_options['ytauthorselect'] == 'Указать автора') echo 'selected="selected"'; ?>><?php _e('Указать автора', 'rss-for-yandex-turbo'); ?></option>
                        <option value="Отключить указание автора" <?php if ($yturbo_options['ytauthorselect'] == 'Отключить указание автора') echo 'selected="selected"'; ?>><?php _e('Отключить указание автора', 'rss-for-yandex-turbo'); ?></option>
                    </select>
                    <br /><small><?php _e('Автор записей (можно не указывать). ', 'rss-for-yandex-turbo'); ?> <br />
                    </small>
               </td>
            </tr>
            <tr id="ownname2" <?php if ($yturbo_options['ytauthorselect'] != 'Указать автора') echo 'style="display:none;"'; ?>>
                <th><?php _e('Автор записей:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytauthor" size="20" value="<?php echo stripslashes($yturbo_options['ytauthor']); ?>" />
                    <br /><small><?php _e('Произвольное имя автора записей (если не заполнено, то будет использовано имя автора записи).', 'rss-for-yandex-turbo'); ?> </small>
               </td>
            </tr>
            <tr class="trbordertop">
                <th><?php _e('Описания изображений:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                     <select name="ytfigcaption" id="capalt" style="width: 260px;">
                        <option value="Использовать подписи" <?php if ($yturbo_options['ytfigcaption'] == 'Использовать подписи') echo 'selected="selected"'; ?>><?php _e('Использовать подписи', 'rss-for-yandex-turbo'); ?></option>
                        <option value="Отключить описания" <?php if ($yturbo_options['ytfigcaption'] == 'Отключить описания') echo 'selected="selected"'; ?>><?php _e('Отключить описания', 'rss-for-yandex-turbo'); ?></option>
                    </select>
                    <br /><small><?php _e('Разметка "описания" для изображений на турбо-страницах (пример смотреть <a target="_blank" href="https://yandex.ru/dev/turbo/doc/rss/elements/multimedia-docpage/#ariaid-title3">здесь</a>).', 'rss-for-yandex-turbo'); ?> <br />
                    <?php _e('В html5-темах будет взята информация из тега <tt>&lt;figcaption></tt>, в html4-темах из шорткода <tt>[caption]</tt>.', 'rss-for-yandex-turbo'); ?><br />
                    </small>
                </td>
            </tr>
            <tr class="yttoctr trbordertop">
                <th class="tdcheckbox"><?php _e('Содержание:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="yttoc"><input type="checkbox" value="enabled" name="yttoc" id="yttoc" <?php if ($yturbo_options['yttoc'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Добавить блок содержания на турбо-страницы', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('На турбо-страницы будет добавлен блок содержания (аналогично <a target="_blank" href="https://wordpress.org/plugins/table-of-contents-plus/">TOC+</a> и подобным плагинам).', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Не включайте данный блок, если не используете плагины вывода содержания.', 'rss-for-yandex-turbo'); ?>
                    </small>
                </td>
            </tr>
            <tr class="yttocchildtr" <?php if ($yturbo_options['yttoc'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th class="tdcheckbox"><?php _e('Типы записей:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <?php
                    $registered = get_post_types( array('public'=> true), 'objects' );
                    $exclude    = array('attachment');
                    $types      = array();

                    foreach ( $registered as $post ) {
                        if ( in_array( $post->name, $exclude ) ) {
                            continue;
                        }
                        $types[ $post->name ] = $post->name;
                    }

                    $yttype2 = explode(",", $yturbo_options['yttype2']);
                    $yttype2 = array_diff($yttype2, array(''));

                    foreach ( $types as $post_type ) {
                        $obj = get_post_type_object( $post_type ); ?>
                        <label class="types2" for="<?php echo $post_type; ?>2"><input type="checkbox" value="<?php echo $post_type; ?>" name="types2[]" id="<?php echo $post_type; ?>2" <?php if (in_array($post_type, $yttype2)) echo 'checked="checked"'; ?> /><?php echo $obj->labels->name; ?> (<?php echo $post_type; ?>)</label><br />
                    <?php } ?>
                    <small><?php _e('Типы записей для добавления блока содержания.', 'rss-for-yandex-turbo'); ?> </small>
               </td>
            </tr>
            <tr class="yttocchildtr" <?php if ($yturbo_options['yttoc'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Текст заголовка:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" style="width:200px;" name="yttoczag" size="20" value="<?php echo stripslashes($yturbo_options['yttoczag']); ?>" />
                    <br /><small><?php _e('Например: "Содержание", "Оглавление", "Содержание страницы" и тому подобное.', 'rss-for-yandex-turbo'); ?><br />
               </td>
            </tr>
            <tr class="yttocchildtr" <?php if ($yturbo_options['yttoc'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Расположение блока:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <select name="yttocmesto" id="yttocmesto" style="width: 260px;">
                        <option value="Перед первым заголовком" <?php if ($yturbo_options['yttocmesto'] == 'Перед первым заголовком') echo 'selected="selected"'; ?>><?php _e('Перед первым заголовком', 'rss-for-yandex-turbo'); ?></option>
                        <option value="После первого заголовка" <?php if ($yturbo_options['yttocmesto'] == 'После первого заголовка') echo 'selected="selected"'; ?>><?php _e('После первого заголовка', 'rss-for-yandex-turbo'); ?></option>
                        <option value="В начале записи" <?php if ($yturbo_options['yttocmesto'] == 'В начале записи') echo 'selected="selected"'; ?>><?php _e('В начале записи', 'rss-for-yandex-turbo'); ?></option>
                        <option value="В конце записи" <?php if ($yturbo_options['yttocmesto'] == 'В конце записи') echo 'selected="selected"'; ?>><?php _e('В конце записи', 'rss-for-yandex-turbo'); ?></option>
                    </select>
                    <br /><small><?php _e('Выводите данный блок на турбо-страницах там же, где он расположен на обычных страницах.', 'rss-for-yandex-turbo'); ?>  <br />
                    </small>
               </td>
            </tr>
            <tr class="yttocchildtr" <?php if ($yturbo_options['yttoc'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Минимум заголовков:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input style="max-width: 50px;" name="yttocnumber" type="number" min="1" max="10" step="1" value="<?php echo $yturbo_options['yttocnumber']; ?>" />
                    <br /><small><?php _e('Укажите минимальное число заголовков записи, при котором будет выведен блок содержания.', 'rss-for-yandex-turbo'); ?> <br/>
                    </small>
               </td>
            </tr>
            <tr class="yttocchildtr" <?php if ($yturbo_options['yttoc'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th class="tdcheckbox"><?php _e('Уровни заголовков:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="yttoch1"><input type="checkbox" value="enabled" name="yttoch1" id="yttoch1" <?php if ($yturbo_options['yttoch1'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Заголовок &lt;h1>', 'rss-for-yandex-turbo'); ?></label><br />
                    <label for="yttoch2"><input type="checkbox" value="enabled" name="yttoch2" id="yttoch2" <?php if ($yturbo_options['yttoch2'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Заголовок &lt;h2>', 'rss-for-yandex-turbo'); ?></label><br />
                    <label for="yttoch3"><input type="checkbox" value="enabled" name="yttoch3" id="yttoch3" <?php if ($yturbo_options['yttoch3'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Заголовок &lt;h3>', 'rss-for-yandex-turbo'); ?></label><br />
                    <label for="yttoch4"><input type="checkbox" value="enabled" name="yttoch4" id="yttoch4" <?php if ($yturbo_options['yttoch4'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Заголовок &lt;h4>', 'rss-for-yandex-turbo'); ?></label><br />
                    <label for="yttoch5"><input type="checkbox" value="enabled" name="yttoch5" id="yttoch5" <?php if ($yturbo_options['yttoch5'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Заголовок &lt;h5>', 'rss-for-yandex-turbo'); ?></label><br />
                    <label for="yttoch6"><input type="checkbox" value="enabled" name="yttoch6" id="yttoch6" <?php if ($yturbo_options['yttoch6'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Заголовок &lt;h6>', 'rss-for-yandex-turbo'); ?></label><br />
                    <small><?php _e('Блок содержания будет формироваться только из указанных заголовков.', 'rss-for-yandex-turbo'); ?> <br/>
                    </small>
               </td>
            </tr>

            <tr class="trbordertop">
                <th></th>
                <td>
                    <input type="submit" name="submit" class="button button-primary" value="<?php _e('Сохранить настройки &raquo;', 'rss-for-yandex-turbo'); ?>" />
                </td>
            </tr> 
        </table>
    </div><!-- end tab -->

    <div class="xyztabs__content<?php if($yturbo_options['yttab']=='Блоки Яндекс.Турбо'){echo ' active';} ?>"><!-- begin tab -->

        <p><?php _e('Часть этих блоков вы можете настроить напрямую в Яндекс.Вебмастере.', 'rss-for-yandex-turbo'); ?><br />
        <?php _e('Указать логотип сайта можно только через Яндекс.Вебмастер.', 'rss-for-yandex-turbo'); ?><br />
        </p>

        <table class="form-table">
            <tr class="ytselectmenutr trbordertop">
                <th><?php _e('Меню:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <select name="ytselectmenu" style="width: 260px;">
                        <?php $menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );  ?>
                        <?php foreach ($menus as $menu): ?>
                            <option value="<?php echo $menu->name; ?>" <?php if ($yturbo_options['ytselectmenu'] == $menu->name) echo 'selected="selected"'; ?>><?php echo $menu->name; ?></option>
                        <?php endforeach; ?>
                        <option value="Не использовать" <?php if ($yturbo_options['ytselectmenu'] == 'Не использовать') echo 'selected="selected"'; ?>><?php echo 'Не использовать'; ?></option>
                    </select>
                    <?php $menulink = get_bloginfo('url') .'/wp-admin/nav-menus.php'; ?>
                    <br /><small><?php _e('Выберите меню для использования на турбо-страницах (создать меню можно на вкладке ', 'rss-for-yandex-turbo'); ?> "<a target="_blank" href="<?php echo $menulink; ?>"><?php _e('Внешний вид \ Меню', 'rss-for-yandex-turbo'); ?></a>").<br />
                    <?php _e('Меню должно быть ограничено <strong>10</strong> ссылками без иерархии (пример смотреть <a target="_blank" href="https://yandex.ru/dev/turbo/doc/rss/elements/header-docpage/#menu">здесь</a>).', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Через Яндекс.Вебмастер можно установить меню без ограничений и с иерархией.', 'rss-for-yandex-turbo'); ?><br />
                    </small>
                </td>
            </tr>
            <tr class="ytsharetr trbordertop">
                <th class="tdcheckbox"><?php _e('Блок "Поделиться":', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytshare"><input type="checkbox" value="enabled" name="ytshare" id="ytshare" <?php if ($yturbo_options['ytshare'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Добавить блок "Поделиться" на турбо-страницы', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('Этот блок будет добавлен в конце записи (пример смотреть <a target="_blank" href="https://yandex.ru/dev/turbo/doc/rss/elements/share-docpage/">здесь</a>).', 'rss-for-yandex-turbo'); ?> 
                    </small>
                </td>
            </tr>
            <tr class="ytsharechildtr" <?php if ($yturbo_options['ytshare'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Социальные сети:', 'rss-for-yandex-turbo'); ?></th>
                <td style="padding:0;">

                   <table>
                   <tr style="margin-left:-5px;">

                   <td>
                    <label for="facebook"><img title="Facebook" src="<?php echo $purl . '/img/facebook.png'; ?>" style="margin-bottom: 5px;width:48px;height:48px; vertical-align: middle; " /><br /></label>
                    <input type="checkbox" name="networks[]" id="facebook" style="margin-left:16px;" />
                   </td>

                   <td>
                    <label for="twitter"><img title="Twitter" src="<?php echo $purl . '/img/twitter.png'; ?>" style="margin-bottom: 5px;width:48px;height:48px; vertical-align: middle; " /><br /></label>
                    <input type="checkbox" name="networks[]" id="twitter" style="margin-left:16px;" />
                   </td>

                   <td>
                    <label for="odnoklassniki"><img title="Odnoklassniki" src="<?php echo $purl . '/img/odnoklassniki.png'; ?>" style="margin-bottom: 5px;width:48px;height:48px; vertical-align: middle; " /><br /></label>
                    <input type="checkbox" name="networks[]" id="odnoklassniki" style="margin-left:16px;">
                   </td>

                   <td>
                    <label for="vkontakte"><img title="VKontakte" src="<?php echo $purl . '/img/vk.png'; ?>" style="margin-bottom: 5px;width:48px;height:48px; vertical-align: middle; " /><br /></label>
                    <input type="checkbox" name="networks[]" id="vkontakte" style="margin-left:16px;" />
                   </td>

                   <td>
                    <label for="telegram"><img title="Telegram" src="<?php echo $purl . '/img/telegram.png'; ?>" style="margin-bottom: 5px;width:48px;height:48px; vertical-align: middle; " /><br /></label>
                    <input type="checkbox" name="networks[]" id="telegram" style="margin-left:16px;" />
                   </td>

                  </tr>
                  </table>
                </td>

            </tr>
            <tr class="ytsharechildtr" <?php if ($yturbo_options['ytshare'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Порядок:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                   <input style="" type="text" name="ytnetw" id="ytnetw" size="62" value="<?php echo $yturbo_options['ytnetw']; ?>" disabled="disabled" />
                   <input type="text" style="display:none;"  name="ytnetwspan" id="ytnetwspan" value="<?php echo $yturbo_options['ytnetw']; ?>"/>
                    <br /><small style=""><?php _e('Для сортировки иконок сначала снимите все чекбоксы, а потом снова их выберите в нужном вам порядке.', 'rss-for-yandex-turbo'); ?></small>
                </td>
            </tr>
            <tr class="ytfeedbacktr trbordertop">
                <th class="tdcheckbox"><?php _e('Блок обратной связи:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytfeedback"><input type="checkbox" value="enabled" name="ytfeedback" id="ytfeedback" <?php if ($yturbo_options['ytfeedback'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Добавить блок обратной связи на турбо-страницы', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('На турбо-страницы будет добавлен блок обратной связи в выбранном вами месте (пример смотреть <a target="_blank" href="https://yandex.ru/dev/turbo/doc/rss/elements/feedback-docpage/">здесь</a>).', 'rss-for-yandex-turbo'); ?>
                    </small>
                </td>
            </tr>
            <tr class="ytfeedbackchildtr" <?php if ($yturbo_options['ytfeedback'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Выравнивание блока:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <select name="ytfeedbackselect" id="ytfeedbackselect" style="width: 260px;">
                        <option value="left" <?php if ($yturbo_options['ytfeedbackselect'] == 'left') echo 'selected="selected"'; ?>><?php _e('Слева', 'rss-for-yandex-turbo'); ?></option>
                        <option value="right" <?php if ($yturbo_options['ytfeedbackselect'] == 'right') echo 'selected="selected"'; ?>><?php _e('Справа', 'rss-for-yandex-turbo'); ?></option>
                        <option value="false" <?php if ($yturbo_options['ytfeedbackselect'] == 'false') echo 'selected="selected"'; ?>><?php _e('В указанном месте', 'rss-for-yandex-turbo'); ?></option>
                    </select>
                    <br /><small><?php _e('Укажите где именно на турбо-страницах должен выводиться блок обратной связи.', 'rss-for-yandex-turbo'); ?> <br />
                    <?php _e('При выравнивании по левому или правому краю страницы можно разместить лишь <strong>4</strong> кнопки связи.', 'rss-for-yandex-turbo'); ?><br />
                    </small>
               </td>
            </tr>
            <tr class="ytfeedbackselectmestotr" <?php if ($yturbo_options['ytfeedback'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Расположить блок:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <select name="ytfeedbackselectmesto" id="ytfeedbackselectmesto" style="width: 260px;">
                        <option value="В начале записи" <?php if ($yturbo_options['ytfeedbackselectmesto'] == 'В начале записи') echo 'selected="selected"'; ?>><?php _e('В начале записи', 'rss-for-yandex-turbo'); ?></option>
                        <option value="В конце записи" <?php if ($yturbo_options['ytfeedbackselectmesto'] == 'В конце записи') echo 'selected="selected"'; ?>><?php _e('В конце записи', 'rss-for-yandex-turbo'); ?></option>
                    </select>
                    <br /><small><?php _e('В начале записи блок будет расположен после заголовка, а в конце записи после блока "Поделиться".', 'rss-for-yandex-turbo'); ?><br />
                    </small>
               </td>
            </tr>
            <tr class="ytfeedbackselectmestotr" style="display:none;">
                <th><?php _e('Заголовок блока:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytfeedbacktitle" size="30" value="<?php echo stripslashes($yturbo_options['ytfeedbacktitle']); ?>" />
                    <br /><small><?php _e('Укажите заголовок блока (используется только при выводе блока в указанном месте).', 'rss-for-yandex-turbo'); ?><br />
                    </small>
               </td>
            </tr>
            <tr class="ytfeedbackchildtr" <?php if ($yturbo_options['ytfeedback'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Кнопки связи:', 'rss-for-yandex-turbo'); ?></th>
                <td style="padding:0;">

                   <table>
                   <tr style="margin-left:-5px;display: flex;flex-wrap: wrap;">

                   <td style="padding: 15px 3px;">
                    <label for="feedbackcall"><img title="Звонок" src="<?php echo $purl . '/img/feedback/call.png'; ?>" style="margin-bottom: 5px;width:52px;height:52px; vertical-align: middle; " /><br /></label>
                    <input type="checkbox" name="networks2[]" id="feedbackcall" style="margin-left:16px;" />
                   </td>

                   <td style="padding: 15px 3px;">
                    <label for="feedbackcallback"><img title="Контактная форма" src="<?php echo $purl . '/img/feedback/callback.png'; ?>" style="margin-bottom: 5px;width:52px;height:52px; vertical-align: middle; " /><br /></label>
                    <input type="checkbox" name="networks2[]" id="feedbackcallback" style="margin-left:16px;" />
                   </td>

                   <td style="padding: 15px 3px;">
                    <label for="feedbackchat"><img title="Чат" src="<?php echo $purl . '/img/feedback/chat.png'; ?>" style="margin-bottom: 5px;width:52px;height:52px; vertical-align: middle; " /><br /></label>
                    <input type="checkbox" name="networks2[]" id="feedbackchat" style="margin-left:16px;" />
                   </td>

                   <td style="padding: 15px 3px;">
                    <label for="feedbackmail"><img title="E-mail" src="<?php echo $purl . '/img/feedback/mail.png'; ?>" style="margin-bottom: 5px;width:52px;height:52px; vertical-align: middle; " /><br /></label>
                    <input type="checkbox" name="networks2[]" id="feedbackmail" style="margin-left:16px;" />
                   </td>

                   <td style="padding: 15px 3px;">
                    <label for="feedbackvkontakte"><img title="VKontakte" src="<?php echo $purl . '/img/feedback/vkontakte.png'; ?>" style="margin-bottom: 5px;width:52px;height:52px; vertical-align: middle; " /><br /></label>
                    <input type="checkbox" name="networks2[]" id="feedbackvkontakte" style="margin-left:16px;" />
                   </td>

                   <td style="padding: 15px 3px;">
                    <label for="feedbackodnoklassniki"><img title="Odnoklassniki" src="<?php echo $purl . '/img/feedback/odnoklassniki.png'; ?>" style="margin-bottom: 5px;width:52px;height:52px; vertical-align: middle; " /><br /></label>
                    <input type="checkbox" name="networks2[]" id="feedbackodnoklassniki" style="margin-left:16px;" />
                   </td>

                   <td style="padding: 15px 3px;">
                    <label for="feedbacktwitter"><img title="Twitter" src="<?php echo $purl . '/img/feedback/twitter.png'; ?>" style="margin-bottom: 5px;width:52px;height:52px; vertical-align: middle; " /><br /></label>
                    <input type="checkbox" name="networks2[]" id="feedbacktwitter" style="margin-left:16px;" />
                   </td>

                   <td style="padding: 15px 3px;">
                    <label for="feedbackfacebook"><img title="Facebook" src="<?php echo $purl . '/img/feedback/facebook.png'; ?>" style="margin-bottom: 5px;width:52px;height:52px; vertical-align: middle; " /><br /></label>
                    <input type="checkbox" name="networks2[]" id="feedbackfacebook" style="margin-left:16px;" />
                   </td>

                   <td style="padding: 15px 3px;">
                    <label for="feedbackviber"><img title="Viber" src="<?php echo $purl . '/img/feedback/viber.png'; ?>" style="margin-bottom: 5px;width:52px;height:52px; vertical-align: middle; " /><br /></label>
                    <input type="checkbox" name="networks2[]" id="feedbackviber" style="margin-left:16px;" />
                   </td>

                   <td style="padding: 15px 3px;">
                    <label for="feedbackwhatsapp"><img title="Whatsapp" src="<?php echo $purl . '/img/feedback/whatsapp.png'; ?>" style="margin-bottom: 5px;width:52px;height:52px; vertical-align: middle; " /><br /></label>
                    <input type="checkbox" name="networks2[]" id="feedbackwhatsapp" style="margin-left:16px;" />
                   </td>

                   <td style="padding: 15px 3px;">
                    <label for="feedbacktelegram"><img title="Telegram" src="<?php echo $purl . '/img/feedback/telegram.png'; ?>" style="margin-bottom: 5px;width:52px;height:52px; vertical-align: middle; " /><br /></label>
                    <input type="checkbox" name="networks2[]" id="feedbacktelegram" style="margin-left:16px;" />
                   </td>

                  </tr>
                  </table>
                </td> 
            </tr>
            <tr class="ytfeedbackchildtr" <?php if ($yturbo_options['ytfeedback'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Порядок кнопок:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                   <input style="" type="text" name="ytfeedbacknetw" id="ytfeedbacknetw" size="62" value="<?php echo $yturbo_options['ytfeedbacknetw']; ?>" disabled="disabled" />
                   <input type="text" style="display:none;"  name="ytfeedbacknetwspan" id="ytfeedbacknetwspan" value="<?php echo $yturbo_options['ytfeedbacknetw']; ?>"/>
                    <br /><small style=""><?php _e('Для сортировки иконок сначала снимите все чекбоксы, а потом снова их выберите в нужном вам порядке.', 'rss-for-yandex-turbo'); ?></small>
                </td>
            </tr>
            <tr class="ytfeedbackchildtr ytfeedbackcontactstr" <?php if ($yturbo_options['ytfeedback'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Контакты для кнопок:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <select name="ytfeedbackcontacts" id="ytfeedbackcontacts" style="width: 260px;">
                        <option value="myselect" selected='true'><?php _e('- Выбрать -', 'rss-for-yandex-turbo'); ?></option>
                        <option disabled="disabled" value="feedbackcall"><?php _e('Звонок', 'rss-for-yandex-turbo'); ?></option>
                        <option disabled="disabled" value="feedbackcallback"><?php _e('Контактная форма', 'rss-for-yandex-turbo'); ?></option>
                        <option disabled="disabled" value="feedbackchat"><?php _e('Чат', 'rss-for-yandex-turbo'); ?></option>
                        <option disabled="disabled" value="feedbackmail"><?php _e('E-mail', 'rss-for-yandex-turbo'); ?></option>
                        <option disabled="disabled" value="feedbackvkontakte"><?php _e('VKontakte', 'rss-for-yandex-turbo'); ?></option>
                        <option disabled="disabled" value="feedbackodnoklassniki"><?php _e('Odnoklassniki', 'rss-for-yandex-turbo'); ?></option>
                        <option disabled="disabled" value="feedbacktwitter"><?php _e('Twitter', 'rss-for-yandex-turbo'); ?></option>
                        <option disabled="disabled" value="feedbackfacebook"><?php _e('Facebook', 'rss-for-yandex-turbo'); ?></option>
                        <option disabled="disabled" value="feedbackviber"><?php _e('Viber', 'rss-for-yandex-turbo'); ?></option>
                        <option disabled="disabled" value="feedbackwhatsapp"><?php _e('Whatsapp', 'rss-for-yandex-turbo'); ?></option>
                        <option disabled="disabled" value="feedbacktelegram"><?php _e('Telegram', 'rss-for-yandex-turbo'); ?></option>
                    </select>
                    <br /><small><?php _e('Для установки контактов выберите нужную кнопку из списка (доступны только отмеченные кнопки связи).', 'rss-for-yandex-turbo'); ?><br />
                    </small>
               </td>
            </tr>
            <tr class="ytfeedbackcalltr" style="display:none;">
                <th><?php _e('Звонок:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytfeedbackcall" size="40" value="<?php echo stripslashes($yturbo_options['ytfeedbackcall']); ?>" />
                    <br /><small><?php _e('Укажите телефонный номер в международном формате (пример: <tt>+74951234567</tt>).', 'rss-for-yandex-turbo'); ?> </small>
               </td>
            </tr>
            <tr class="ytfeedbackcallbacktr" style="display:none;">
                <th><?php _e('Email для контактной формы:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytfeedbackcallback" size="40" value="<?php echo stripslashes($yturbo_options['ytfeedbackcallback']); ?>" />
                    <br /><small><?php _e('Укажите адрес e-mail (пример: <tt>mail@test.ru</tt>).', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Разрешено указывать только e-mail, принадлежащий вашему домену.', 'rss-for-yandex-turbo'); ?><br />
                    </small>
               </td>
            </tr>
            <tr class="ytfeedbackcallbacktr" style="display:none;">
                <th><?php _e('Название организации:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytfeedbackcallback2" size="40" value="<?php echo stripslashes($yturbo_options['ytfeedbackcallback2']); ?>" />
                    <br /><small><?php _e('Укажите юридическое название вашей организации (пример: <tt>ООО «Ромашка»</tt>).', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('* При заполнении требуется указать ссылку на пользовательское соглашении.', 'rss-for-yandex-turbo'); ?><br />
                    </small>
               </td>
            </tr>
            <tr class="ytfeedbackcallbacktr" style="display:none;">
                <th><?php _e('Пользовательское соглашение:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytfeedbackcallback3" size="40" value="<?php echo stripslashes($yturbo_options['ytfeedbackcallback3']); ?>" />
                    <br /><small><?php _e('Укажите ссылку на пользовательское соглашение о предоставлении обратной связи.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('* При заполнении требуется указать юридическое название вашей организации.', 'rss-for-yandex-turbo'); ?><br />
                    </small>
               </td>
            </tr>
            <tr class="ytfeedbackchattr" style="display:none;">
                <th><?php _e('Чат:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input disabled="disabled" type="text" name="ytfeedbackchat" size="40" value="" />
                    <br /><small><?php _e('Указывать ничего не надо, если вы создали чат для своего сайта.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Справку о том, как создать "Чат для бизнеса" читайте <a target="_blank" href="https://tech.yandex.ru/turbo/doc/rss/elements/feedback-docpage/#feedback__chat">здесь</a>.', 'rss-for-yandex-turbo'); ?><br />
                    </small>
               </td>
            </tr>
            <tr class="ytfeedbackmailtr" style="display:none;">
                <th><?php _e('E-mail:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytfeedbackmail" size="40" value="<?php echo stripslashes($yturbo_options['ytfeedbackmail']); ?>" />
                    <br /><small><?php _e('Укажите адрес e-mail (пример: <tt>mail@test.ru</tt>).', 'rss-for-yandex-turbo'); ?></small>
               </td>
            </tr>
            <tr class="ytfeedbackvkontaktetr" style="display:none;">
                <th><?php _e('VKontakte:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytfeedbackvkontakte" size="40" value="<?php echo stripslashes($yturbo_options['ytfeedbackvkontakte']); ?>" />
                    <br /><small><?php _e('Укажите урл (профиль, группа или чат) ВКонтакте (пример для чата: <tt>https://vk.me/123456</tt>, где <tt>123456</tt> это ваш аккаунт).', 'rss-for-yandex-turbo'); ?></small>
               </td>
            </tr>
            <tr class="ytfeedbackodnoklassnikitr" style="display:none;">
                <th><?php _e('Odnoklassniki:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytfeedbackodnoklassniki" size="40" value="<?php echo stripslashes($yturbo_options['ytfeedbackodnoklassniki']); ?>" />
                    <br /><small><?php _e('Укажите урл (профиль или группа) Одноклассники (пример для профиля: <tt>https://www.ok.ru/profile/123456</tt>, где <tt>123456</tt> это ваш аккаунт).', 'rss-for-yandex-turbo'); ?></small>
               </td>
            </tr>
            <tr class="ytfeedbacktwittertr" style="display:none;">
                <th><?php _e('Twitter:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytfeedbacktwitter" size="40" value="<?php echo stripslashes($yturbo_options['ytfeedbacktwitter']); ?>" />
                    <br /><small><?php _e('Укажите урл профиля Twitter (пример: <tt>https://twitter.com/yandex</tt>, где <tt>yandex</tt> это ваш аккаунт).', 'rss-for-yandex-turbo'); ?></small>
               </td>
            </tr>
            <tr class="ytfeedbackfacebooktr" style="display:none;">
                <th><?php _e('Facebook:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytfeedbackfacebook" size="40" value="<?php echo stripslashes($yturbo_options['ytfeedbackfacebook']); ?>" />
                    <br /><small><?php _e('Укажите урл (профиль, группа или чат) Facebook (пример для профиля: <tt>https://www.facebook.com/yandex</tt>, где <tt>yandex</tt> это ваш аккаунт).', 'rss-for-yandex-turbo'); ?></small>
               </td>
            </tr>
            <tr class="ytfeedbackvibertr" style="display:none;">
                <th><?php _e('Viber:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytfeedbackviber" size="40" value="<?php echo stripslashes($yturbo_options['ytfeedbackviber']); ?>" />
                    <br /><small><?php _e('Укажите урл связи для Viber (пример для чата: <tt>viber://chat?number=+74951234567</tt>, где <tt>+74991234567</tt> это ваш номер телефона).', 'rss-for-yandex-turbo'); ?></small>
               </td>
            </tr>
            <tr class="ytfeedbackwhatsapptr" style="display:none;">
                <th><?php _e('Whatsapp:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytfeedbackwhatsapp" size="40" value="<?php echo stripslashes($yturbo_options['ytfeedbackwhatsapp']); ?>" />
                    <br /><small><?php _e('Укажите урл связи для Whatsapp (пример: <tt>whatsapp://send?phone=74951234567</tt>, где <tt>74951234567</tt> это ваш номер телефона).', 'rss-for-yandex-turbo'); ?></small>
               </td>
            </tr>
            <tr class="ytfeedbacktelegramtr" style="display:none;">
                <th><?php _e('Telegram:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytfeedbacktelegram" size="40" value="<?php echo stripslashes($yturbo_options['ytfeedbacktelegram']); ?>" />
                    <br /><small><?php _e('Укажите урл связи для Telegram (пример: <tt>https://t.me/123456</tt>, где <tt>123456</tt> это ваш аккаунт).', 'rss-for-yandex-turbo'); ?></small>
               </td>
            </tr>
            <tr class="ytcommentstr trbordertop">
                <th class="tdcheckbox"><?php _e('Комментарии:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytcomments"><input type="checkbox" value="enabled" name="ytcomments" id="ytcomments" <?php if ($yturbo_options['ytcomments'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Добавить комментарии к турбо-страницам', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('К записям на турбо-страницах будут добавлены комментарии (пример смотреть <a target="_blank" href="https://yandex.ru/dev/turbo/doc/rss/elements/comments-docpage/">здесь</a>).', 'rss-for-yandex-turbo'); ?>
                    </small>
                </td>
            </tr>
            <tr class="ytcommentschildtr" <?php if ($yturbo_options['ytcomments'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th class="tdcheckbox"><?php _e('Аватары:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytcommentsavatar"><input type="checkbox" value="enabled" name="ytcommentsavatar" id="ytcommentsavatar" <?php if ($yturbo_options['ytcommentsavatar'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Добавить аватары к комментариям', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('Выводить или нет аватары (граватары) к комментариям.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Внимание! Картинки аватаров могут не уложиться в лимит изображений на одну запись (не более <strong>50</strong> штук).', 'rss-for-yandex-turbo'); ?> <br />
                    <?php _e('В случае отключения вывода аватаров Яндекс выведет на месте аватаров картинку-заглушку.', 'rss-for-yandex-turbo'); ?><br />
                    </small>
                </td>
            </tr>
            <tr class="ytcommentschildtr" <?php if ($yturbo_options['ytcomments'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Число комментариев:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input style="max-width: 50px;" name="ytcommentsnumber" type="number" min="1" max="40" step="1" value="<?php echo $yturbo_options['ytcommentsnumber']; ?>" />
                    <br /><small><?php _e('Укажите число выводимых комментариев (максимально можно выводить только <strong>40</strong> комментариев).', 'rss-for-yandex-turbo'); ?><br/>
                    </small>
               </td>
            </tr>
            <tr class="ytcommentschildtr" <?php if ($yturbo_options['ytcomments'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Сортировка:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <select name="ytcommentsorder" id="ytcommentsorder" style="width: 260px;">
                        <option value="В начале новые комментарии" <?php if ($yturbo_options['ytcommentsorder'] == 'В начале новые комментарии') echo 'selected="selected"'; ?>><?php _e('В начале новые комментарии', 'rss-for-yandex-turbo'); ?></option>
                        <option value="В начале старые комментарии" <?php if ($yturbo_options['ytcommentsorder'] == 'В начале старые комментарии') echo 'selected="selected"'; ?>><?php _e('В начале старые комментарии', 'rss-for-yandex-turbo'); ?></option>
                    </select>
                    <br /><small><?php _e('Сортировка комментариев по дате добавления.', 'rss-for-yandex-turbo'); ?> <br />
                    <?php _e('Учтите, что при использовании древовидных комментариев сортировка визуально может быть нарушена.', 'rss-for-yandex-turbo'); ?><br />
                    </small>
               </td>
            </tr>
            <tr class="ytcommentschildtr" <?php if ($yturbo_options['ytcomments'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th class="tdcheckbox"><?php _e('Дата комментариев:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytcommentsdate"><input type="checkbox" value="enabled" name="ytcommentsdate" id="ytcommentsdate" <?php if ($yturbo_options['ytcommentsdate'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Добавить дату к комментариям', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('Указывать дату для комментариев по <a target="_blank" href="https://tech.yandex.ru/turbo/doc/rss/elements/comments-docpage/">спецификации</a> Яндекса необязательно.', 'rss-for-yandex-turbo'); ?>
                    </small>
                </td>
            </tr>
            <tr class="ytcommentschildtr" <?php if ($yturbo_options['ytcomments'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th class="tdcheckbox"><?php _e('Древовидность:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytcommentsdrevo"><input type="checkbox" value="enabled" name="ytcommentsdrevo" id="ytcommentsdrevo" <?php if ($yturbo_options['ytcommentsdrevo'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Использовать древовидность', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('Выводить или не выводить комментарии в древовидном виде.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Поддерживается древовидность только для 2 уровней глубины.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Учтите, что отключение древовидности не повлияет на сортировку комментариев.', 'rss-for-yandex-turbo'); ?><br />
                    </small>
                </td>
            </tr>
            <tr class="ytrelatedtr trbordertop">
                <th class="tdcheckbox"><?php _e('Похожие записи:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytrelated"><input type="checkbox" value="enabled" name="ytrelated" id="ytrelated" <?php if ($yturbo_options['ytrelated'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Добавить блок похожих записей на турбо-страницы', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('На турбо-страницы будет добавлен блок похожих записей (в конце страницы).', 'rss-for-yandex-turbo'); ?></small>
                </td>
            </tr>
            <tr class="ytrelatedchildtr" <?php if ($yturbo_options['ytrelated'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Количество похожих записей:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input style="max-width: 50px;" name="ytrelatednumber" type="number" min="1" max="30" step="1" value="<?php echo $yturbo_options['ytrelatednumber']; ?>" />
                    <br /><small><?php _e('Укажите число записей в блоке похожих записей.', 'rss-for-yandex-turbo'); ?> <br >
                    <?php _e('Список похожих записей будет формироваться случайным образом из записей рубрики текущей записи.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Внимание! Не устанавливайте слишком большое число похожих записей, если вы используете вместе с ними вывод миниатюр.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Лимит Яндекса на общее количество изображений одной страницы - <strong>50</strong> (миниатюры похожих записей тоже учитываются).', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Больше <strong>30</strong> похожих записей установить нельзя (тоже лимит Яндекса на количество ссылок в блоке похожих записей).', 'rss-for-yandex-turbo'); ?><br />
                    </small>
               </td>
            </tr>
            <tr class="ytrelatedchildtr" <?php if ($yturbo_options['ytrelated'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Ограничение по дате:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input style="max-width: 50px;" name="ytrelateddate" type="number" min="1" max="99" step="1" value="<?php echo $yturbo_options['ytrelateddate']; ?>" />
                    <br /><small><?php _e('Для похожих записей будут взяты только записи, опубликованные за указанное количество последних месяцев.', 'rss-for-yandex-turbo'); ?><br >
                    <?php _e('Это ограничение поможет избежать ситуаций, когда в похожих записях выводятся статьи 10-летней давности.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Не ставьте маленькое количество месяцев в случае, если ваш сайт не слишком часто обновляется.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('В такой ситуации список похожих записей может быть очень коротким (или вообще пустым).', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Если информация на вашем сайте не устаревает со временем, то ограничение по дате не имеет смысла (смело ставьте 99 месяцев).', 'rss-for-yandex-turbo'); ?><br />
                    </small>
               </td>
            </tr>
            <tr class="ytrelatedchildtr" <?php if ($yturbo_options['ytrelated'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Миниатюра для похожих записей:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <select name="ytrelatedselectthumb" style="width: 260px;">
                        <?php $image_sizes = get_intermediate_image_sizes(); ?>
                        <?php foreach ($image_sizes as $size_name): ?>
                            <option value="<?php echo $size_name ?>" <?php if ($yturbo_options['ytrelatedselectthumb'] == $size_name) echo 'selected="selected"'; ?>><?php echo $size_name ?></option>
                        <?php endforeach; ?>
                            <option value="Не использовать" <?php if ($yturbo_options['ytrelatedselectthumb'] == 'Не использовать') echo 'selected="selected"'; ?>><?php echo 'Не использовать'; ?></option>
                    </select>
                    <br /><small><?php _e('Выберите нужный размер миниатюры (в списке находятся все зарегистрированные на сайте размеры миниатюр). ', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Вывод миниатюр для похожих записей можно отключить.', 'rss-for-yandex-turbo'); ?><br />
                    </small>
                </td>
            </tr>
            <tr class="ytrelatedchildtr" <?php if ($yturbo_options['ytrelated'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th class="tdcheckbox"><?php _e('Непрерывная лента статей:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytrelatedinfinity"><input type="checkbox" value="enabled" name="ytrelatedinfinity" id="ytrelatedinfinity" <?php if ($yturbo_options['ytrelatedinfinity'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Включить непрерывную ленту статей', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('Вместо обычного короткого списка похожих статей будет выводиться непрерывная лента из полных записей (пример смотреть <a target="_blank" href="https://yandex.ru/turbo?text=promo-infinite">здесь</a>).', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('При включении непрерывной ленты статей вывод миниатюр для похожих записей будет отключен.', 'rss-for-yandex-turbo'); ?><br />
                    </small>
                </td>
            </tr>
            <tr class="ytrelatedchildtr" <?php if ($yturbo_options['ytrelated'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th class="tdcheckbox"><?php _e('Кэширование:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytrelatedcache"><input type="checkbox" value="enabled" name="ytrelatedcache" id="ytrelatedcache" <?php if ($yturbo_options['ytrelatedcache'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Кэшировать список похожих записей', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('Для ускорения генерирования RSS-ленты вы можете включить кэширование списка похожих записей.', 'rss-for-yandex-turbo'); ?></small>
                </td>
            </tr>
            <tr class="ytrelatedchildtr ytcachetime" style="display:none;">
                <th><?php _e('Время жизни кэша:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input style="max-width: 70px;" name="ytrelatedcachetime" type="number" min="1" max="1000" step="1" value="<?php echo $yturbo_options['ytrelatedcachetime']; ?>" />
                    <br /><small><?php _e('Укажите время жизни кэша (в часах).', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Внимание! Любое изменение настроек плагина скинет кэш похожих записей.', 'rss-for-yandex-turbo'); ?><br />
               </td>
            </tr>
            <tr class="ytratingtr trbordertop">
                <th class="tdcheckbox"><?php _e('Рейтинг:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytrating"><input type="checkbox" value="enabled" name="ytrating" id="ytrating" <?php if ($yturbo_options['ytrating'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Добавить рейтинг на турбо-страницы', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('На турбо-страницы будет добавлен блок рейтинга (пример смотреть <a target="_blank" href="https://yandex.ru/dev/turbo/doc/rss/elements/rating-docpage/">здесь</a>).', 'rss-for-yandex-turbo'); ?></small>
                </td>
            </tr>
            <tr class="ytratingchildtr" <?php if ($yturbo_options['ytrating'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Диапазон оценок:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <?php _e('От:', 'rss-for-yandex-turbo'); ?> <input style="max-width: 60px;margin-right:10px;" name="ytratingmin" type="number" min="1" max="5" step="0.01" value="<?php echo $yturbo_options['ytratingmin']; ?>" />
                    <?php _e('До:', 'rss-for-yandex-turbo'); ?> <input style="max-width: 60px;" name="ytratingmax" type="number" min="1" max="5" step="0.01" value="<?php echo $yturbo_options['ytratingmax']; ?>" />
                    <br /><small><?php _e('Укажите минимальную и максимальную оценку.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Каждой записи будет присвоена случайная оценка в указанном диапазоне.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Этот рейтинг будет выведен сразу после заголовка с миниатюрой записи.', 'rss-for-yandex-turbo'); ?><br />
               </td>
            </tr>
            <tr class="ytsearchtr trbordertop">
                <th class="tdcheckbox"><?php _e('Поиск:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytsearch"><input type="checkbox" value="enabled" name="ytsearch" id="ytsearch" <?php if ($yturbo_options['ytsearch'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Добавить поиск на турбо-страницы', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('На турбо-страницы будет добавлен блок поиска (пример смотреть <a target="_blank" href="https://yandex.ru/dev/turbo/doc/rss/elements/search-block-docpage/">здесь</a>).', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('На данный момент поиск не будет работать, если ваш сайт работает не на https протоколе.', 'rss-for-yandex-turbo'); ?>
                    </small>
                </td>
            </tr>
            <tr class="ytsearchchildtr" <?php if ($yturbo_options['ytsearch'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Текст по умолчанию:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" style="width:200px;" name="ytsearchplaceholder" size="20" value="<?php echo stripslashes($yturbo_options['ytsearchplaceholder']); ?>" />
                    <br /><small><?php _e('Текст, который отображается в поисковой строке по умолчанию', 'rss-for-yandex-turbo'); ?><br />
               </td>
            </tr>
            <tr class="ytsearchchildtr" <?php if ($yturbo_options['ytsearch'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Расположение блока:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <select name="ytsearchmesto" id="ytsearchmesto" style="width: 260px;">
                        <option value="В начале записи" <?php if ($yturbo_options['ytsearchmesto'] == 'В начале записи') echo 'selected="selected"'; ?>><?php _e('В начале записи', 'rss-for-yandex-turbo'); ?></option>
                        <option value="В конце записи" <?php if ($yturbo_options['ytsearchmesto'] == 'В конце записи') echo 'selected="selected"'; ?>><?php _e('В конце записи', 'rss-for-yandex-turbo'); ?></option>
                    </select>
                    <br /><small><?php _e('В начале записи блок будет расположен после заголовка, а в конце записи после блока "Поделиться".', 'rss-for-yandex-turbo'); ?><br />
                    </small>
               </td>
            </tr>

            <tr class="trbordertop">
                <th></th>
                <td>
                    <input type="submit" name="submit" class="button button-primary" value="<?php _e('Сохранить настройки &raquo;', 'rss-for-yandex-turbo'); ?>" />
                </td>
            </tr>

        </table>
    </div><!-- end tab -->

    <div class="xyztabs__content<?php if($yturbo_options['yttab']=='Счетчики'){echo ' active';} ?>"><!-- begin tab -->

        <p><?php _e('Укажите идентификаторы нужных вам счетчиков (<a target="_blank" href="https://yandex.ru/dev/turbo/doc/settings/find-counter-id-docpage/">как узнать идентификатор счетчика</a>).<br />В ленте будут использованы <strong>все</strong> указанные вами счетчики.', 'rss-for-yandex-turbo'); ?></p> 

        <table class="form-table">
            <tr class="trbordertop">
                <th><?php _e('Яндекс.Метрика:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytmetrika" size="22" value="<?php echo stripslashes($yturbo_options['ytmetrika']); ?>" />
                    <br /><small><?php _e('Укажите числовой идентификатор счетчика (например: <tt>3338249</tt>).', 'rss-for-yandex-turbo'); ?><br />
                    </small>
               </td>
            </tr>
            <tr>
                <th><?php _e('LiveInternet:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytliveinternet" size="22" value="<?php echo stripslashes($yturbo_options['ytliveinternet']); ?>" />
                    <br /><small><?php _e('Укажите идентификатор счетчика (например: <tt>site.ru</tt>).', 'rss-for-yandex-turbo'); ?></small>
               </td>
            </tr>
            <tr>
                <th><?php _e('Google Analytics:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytgoogle" size="22" value="<?php echo stripslashes($yturbo_options['ytgoogle']); ?>" />
                    <br /><small><?php _e('Укажите идентификатор отслеживания (например: <tt>UA-12340005-6</tt>).', 'rss-for-yandex-turbo'); ?></small>
               </td>
            </tr>
            <tr>
                <th><?php _e('Рейтинг Mail.Ru:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytmailru" size="22" value="<?php echo stripslashes($yturbo_options['ytmailru']); ?>" />
                    <br /><small><?php _e('Укажите числовой идентификатор счетчика (например: <tt>1234567</tt>).', 'rss-for-yandex-turbo'); ?></small>
               </td>
            </tr>
            <tr>
                <th><?php _e('Rambler Топ-100:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytrambler" size="22" value="<?php echo stripslashes($yturbo_options['ytrambler']); ?>" />
                    <br /><small><?php _e('Укажите числовой идентификатор счетчика (например: <tt>4505046</tt>).', 'rss-for-yandex-turbo'); ?></small>
               </td>
            </tr>
            <tr>
                <th><?php _e('Mediascope (TNS):', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytmediascope" size="22" value="<?php echo stripslashes($yturbo_options['ytmediascope']); ?>" />
                    <br /><small><?php _e('Идентификатор проекта <tt>tmsec</tt> с окончанием <tt>-turbo</tt>. <br />Например, если для обычных страниц сайта установлен счетчик <tt>example_total</tt>, <br />то для турбо-страниц указывается <tt>example_total-turbo</tt>.', 'rss-for-yandex-turbo'); ?></small>
               </td>
            </tr>

            <tr class="trbordertop">
                <th></th>
                <td>
                    <input type="submit" name="submit" class="button button-primary" value="<?php _e('Сохранить настройки &raquo;', 'rss-for-yandex-turbo'); ?>" />
                </td>
            </tr>

        </table>
    </div><!-- end tab -->

    <div class="xyztabs__content<?php if($yturbo_options['yttab']=='Реклама'){echo ' active';} ?>"><!-- begin tab -->

        <?php if ( yturbo_check_ads() == true ) echo '<div style="display:none;">'; ?>
        <p><?php _e('Реклама, установленная в Яндекс.Вебмастере, распределяется равномерно по тексту страницы (примерно каждые 2-3 экрана с общим ограничением в 10 рекламных блоков).', 'rss-for-yandex-turbo'); ?><br />
        <?php _e('Если у вас большие по размеру контента статьи или вас не устраивает частота, с которой Яндекс расставляет рекламу, то рекомендую попробовать плагин <a target="_blank" href="https://wpcase.ru/wpcase-turbo-ads/">WPCase: Turbo Ads</a>.', 'rss-for-yandex-turbo'); ?><br />
        <?php _e('В нем вы можете установить сколько угодно рекламных блоков и с той частотой, которая вам нужна (гибкие настройки вставки рекламных блоков).', 'rss-for-yandex-turbo'); ?><br /><br />
        <?php _e('Этот же плагин позволяет разместить максимально 5 рекламных блоков (только 3 в контенте статьи).', 'rss-for-yandex-turbo'); ?><br />
        <?php _e('При проблемах с настройкой рекламной сети ADFOX ознакомьтесь со справочными материалами: <a target="_blank" href="https://sites.help.adfox.ru/page/225">статья</a>, <a target="_blank" href="https://webmaster.yandex.ru/blog/videourok-kak-razmeschat-reklamu-na-turbo-stranitsakh-cherez-adfox">видеоурок</a>.', 'rss-for-yandex-turbo'); ?><br />
        </p>

        <table class="form-table">
            <tr class="myturbo trbordertop">
                <th class="tdcheckbox"><?php _e('Блок рекламы #1:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytad1"><input type="checkbox" value="enabled" name="ytad1" id="ytad1" <?php if ($yturbo_options['ytad1'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Включить первый блок рекламы (<span style="color:green;">после заголовка записи</span>)', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('Будет включен блок рекламы на турбо-страницах в выбранном вами месте.', 'rss-for-yandex-turbo'); ?></small>
                </td>
            </tr>
            <tr class="myturbo block1" <?php if ($yturbo_options['ytad1'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Рекламная сеть:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                     <select name="ytad1set" id="ytad1set" style="width: 200px;">
                        <option value="РСЯ" <?php if ($yturbo_options['ytad1set'] == 'РСЯ') echo 'selected="selected"'; ?>><?php _e('РСЯ', 'rss-for-yandex-turbo'); ?></option>
                        <option value="ADFOX" <?php if ($yturbo_options['ytad1set'] == 'ADFOX') echo 'selected="selected"'; ?>><?php _e('ADFOX', 'rss-for-yandex-turbo'); ?></option>
                    </select>
                    <br /><small><?php _e('Рекламная сеть блока рекламы #1.', 'rss-for-yandex-turbo'); ?></small>
                </td>
            </tr>
            <tr class="myturbo trrsa block1" style="display:none;">
                <th><?php _e('РСЯ идентификатор:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytad1rsa" size="22" value="<?php echo stripslashes($yturbo_options['ytad1rsa']); ?>" />
                    <br /><small><?php _e('Укажите идентификатор блока РСЯ (например, <strong>RA-123456-7</strong>, <a target="_blank" href="https://tech.yandex.ru/turbo/doc/settings/ads-docpage/#doc-c-tabs-0-tab-0">как его узнать</a>)</small>.', 'rss-for-yandex-turbo'); ?>
               </td>
            </tr>
            <tr class="myturbo trfox1 block1" style="display:none;">
                <th><?php _e('Код ADFOX:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <textarea rows="12" cols="60" name="ytadfox1" id="ytadfox1"><?php echo stripcslashes($yturbo_options['ytadfox1']); ?></textarea>
                    <br /><small><?php _e('Код рекламной сети ADFOX (начиная с <tt>&lt;div></tt>, <a target="_blank" href="https://tech.yandex.ru/turbo/doc/settings/ads-docpage/#doc-c-tabs-0-tab-1">как его узнать</a>).', 'rss-for-yandex-turbo'); ?><br />
               </td>
            </tr>

            <tr class="myturbo trbordertop">
                <th class="tdcheckbox"><?php _e('Блок рекламы #2:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytad2"><input type="checkbox" value="enabled" name="ytad2" id="ytad2" <?php if ($yturbo_options['ytad2'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Включить второй блок рекламы (<span style="color:green;">в середине записи</span>)', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('Будет включен блок рекламы на турбо-страницах в выбранном вами месте.', 'rss-for-yandex-turbo'); ?></small>
                </td>
            </tr>
            <tr class="myturbo block2" <?php if ($yturbo_options['ytad2'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Рекламная сеть:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                     <select name="ytad2set" id="ytad2set" style="width: 200px;">
                        <option value="РСЯ" <?php if ($yturbo_options['ytad2set'] == 'РСЯ') echo 'selected="selected"'; ?>><?php _e('РСЯ', 'rss-for-yandex-turbo'); ?></option>
                        <option value="ADFOX" <?php if ($yturbo_options['ytad2set'] == 'ADFOX') echo 'selected="selected"'; ?>><?php _e('ADFOX', 'rss-for-yandex-turbo'); ?></option>
                    </select>
                    <br /><small><?php _e('Рекламная сеть блока рекламы #2.', 'rss-for-yandex-turbo'); ?></small>
                </td>
            </tr>
            <tr class="myturbo trrsa2 block2" style="display:none;">
                <th><?php _e('РСЯ идентификатор:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytad2rsa" size="22" value="<?php echo stripslashes($yturbo_options['ytad2rsa']); ?>" />
                    <br /><small><?php _e('Укажите идентификатор блока РСЯ (например, <strong>RA-123456-7</strong>, <a target="_blank" href="https://tech.yandex.ru/turbo/doc/settings/ads-docpage/#doc-c-tabs-0-tab-0">как его узнать</a>)</small>.', 'rss-for-yandex-turbo'); ?>
               </td>
            </tr>
            <tr class="myturbo trfox2 block2" style="display:none;">
                <th><?php _e('Код ADFOX:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <textarea rows="12" cols="60" name="ytadfox2" id="ytadfox2"><?php echo stripcslashes($yturbo_options['ytadfox2']); ?></textarea>
                    <br /><small><?php _e('Код рекламной сети ADFOX (начиная с <tt>&lt;div></tt>, <a target="_blank" href="https://tech.yandex.ru/turbo/doc/settings/ads-docpage/#doc-c-tabs-0-tab-1">как его узнать</a>).', 'rss-for-yandex-turbo'); ?><br />
               </td>
            </tr>
            <tr class="myturbo trbordertop">
                <th class="tdcheckbox"><?php _e('Блок рекламы #3:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytad3"><input type="checkbox" value="enabled" name="ytad3" id="ytad3" <?php if ($yturbo_options['ytad3'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Включить третий блок рекламы (<span style="color:green;">в конце записи</span>)', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('Будет включен блок рекламы на турбо-страницах в выбранном вами месте.', 'rss-for-yandex-turbo'); ?> </small>
                </td>
            </tr>
            <tr class="myturbo block3" <?php if ($yturbo_options['ytad3'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Рекламная сеть:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                     <select name="ytad3set" id="ytad3set" style="width: 200px;">
                        <option value="РСЯ" <?php if ($yturbo_options['ytad3set'] == 'РСЯ') echo 'selected="selected"'; ?>><?php _e('РСЯ', 'rss-for-yandex-turbo'); ?></option>
                        <option value="ADFOX" <?php if ($yturbo_options['ytad3set'] == 'ADFOX') echo 'selected="selected"'; ?>><?php _e('ADFOX', 'rss-for-yandex-turbo'); ?></option>
                    </select>
                    <br /><small><?php _e('Рекламная сеть блока рекламы #3.', 'rss-for-yandex-turbo'); ?></small>
                </td>
            </tr>
            <tr class="myturbo trrsa3 block3" style="display:none;">
                <th><?php _e('РСЯ идентификатор:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytad3rsa" size="22" value="<?php echo stripslashes($yturbo_options['ytad3rsa']); ?>" />
                    <br /><small><?php _e('Укажите идентификатор блока РСЯ (например, <strong>RA-123456-7</strong>, <a target="_blank" href="https://tech.yandex.ru/turbo/doc/settings/ads-docpage/#doc-c-tabs-0-tab-0">как его узнать</a>)</small>.', 'rss-for-yandex-turbo'); ?>
               </td>
            </tr>
            <tr class="myturbo trfox3 block3" style="display:none;">
                <th><?php _e('Код ADFOX:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <textarea rows="12" cols="60" name="ytadfox3" id="ytadfox3"><?php echo stripcslashes($yturbo_options['ytadfox3']); ?></textarea>
                    <br /><small><?php _e('Код рекламной сети ADFOX (начиная с <tt>&lt;div></tt>, <a target="_blank" href="https://tech.yandex.ru/turbo/doc/settings/ads-docpage/#doc-c-tabs-0-tab-1">как его узнать</a>).', 'rss-for-yandex-turbo'); ?><br />
               </td>
            </tr>
            <tr class="myturbo trbordertop">
                <th class="tdcheckbox"><?php _e('Блок рекламы #4:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytad4"><input type="checkbox" value="enabled" name="ytad4" id="ytad4" <?php if ($yturbo_options['ytad4'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Включить четвертый блок рекламы (<span style="color:green;">после блока "Поделиться"</span>)', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('Будет включен блок рекламы на турбо-страницах в выбранном вами месте.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Рекламный блок будет выведен только, если включена опция вывода блока "Поделиться".', 'rss-for-yandex-turbo'); ?></small>
                </td>
            </tr>
            <tr class="myturbo block4" <?php if ($yturbo_options['ytad4'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Рекламная сеть:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                     <select name="ytad4set" id="ytad4set" style="width: 200px;">
                        <option value="РСЯ" <?php if ($yturbo_options['ytad4set'] == 'РСЯ') echo 'selected="selected"'; ?>><?php _e('РСЯ', 'rss-for-yandex-turbo'); ?></option>
                        <option value="ADFOX" <?php if ($yturbo_options['ytad4set'] == 'ADFOX') echo 'selected="selected"'; ?>><?php _e('ADFOX', 'rss-for-yandex-turbo'); ?></option>
                    </select>
                    <br /><small><?php _e('Рекламная сеть блока рекламы #4.', 'rss-for-yandex-turbo'); ?></small>
                </td>
            </tr>
            <tr class="myturbo trrsa4 block4" style="display:none;">
                <th><?php _e('РСЯ идентификатор:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytad4rsa" size="22" value="<?php echo stripslashes($yturbo_options['ytad4rsa']); ?>" />
                    <br /><small><?php _e('Укажите идентификатор блока РСЯ (например, <strong>RA-123456-7</strong>, <a target="_blank" href="https://tech.yandex.ru/turbo/doc/settings/ads-docpage/#doc-c-tabs-0-tab-0">как его узнать</a>)</small>.', 'rss-for-yandex-turbo'); ?>
               </td>
            </tr>
            <tr class="myturbo trfox4 block4" style="display:none;">
                <th><?php _e('Код ADFOX:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <textarea rows="12" cols="60" name="ytadfox4" id="ytadfox4"><?php echo stripcslashes($yturbo_options['ytadfox4']); ?></textarea>
                    <br /><small><?php _e('Код рекламной сети ADFOX (начиная с <tt>&lt;div></tt>, <a target="_blank" href="https://tech.yandex.ru/turbo/doc/settings/ads-docpage/#doc-c-tabs-0-tab-1">как его узнать</a>).', 'rss-for-yandex-turbo'); ?><br />
               </td>
            </tr>
            <tr class="myturbo trbordertop">
                <th class="tdcheckbox"><?php _e('Блок рекламы #5:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytad5"><input type="checkbox" value="enabled" name="ytad5" id="ytad5" <?php if ($yturbo_options['ytad5'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Включить пятый блок рекламы (<span style="color:green;">после комментариев</span>)', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('Будет включен блок рекламы на турбо-страницах в выбранном вами месте.', 'rss-for-yandex-turbo'); ?> <br />
                    <?php _e('Рекламный блок будет выведен только, если к записи есть хотя бы один комментарий (и включен вывод комментариев).', 'rss-for-yandex-turbo'); ?></small>
                </td>
            </tr>
            <tr class="myturbo block5" <?php if ($yturbo_options['ytad5'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Рекламная сеть:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                     <select name="ytad5set" id="ytad5set" style="width: 200px;">
                        <option value="РСЯ" <?php if ($yturbo_options['ytad5set'] == 'РСЯ') echo 'selected="selected"'; ?>><?php _e('РСЯ', 'rss-for-yandex-turbo'); ?></option>
                        <option value="ADFOX" <?php if ($yturbo_options['ytad5set'] == 'ADFOX') echo 'selected="selected"'; ?>><?php _e('ADFOX', 'rss-for-yandex-turbo'); ?></option>
                    </select>
                    <br /><small><?php _e('Рекламная сеть блока рекламы #5.', 'rss-for-yandex-turbo'); ?></small>
                </td>
            </tr>
            <tr class="myturbo trrsa5 block5" style="display:none;">
                <th><?php _e('РСЯ идентификатор:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input type="text" name="ytad5rsa" size="22" value="<?php echo stripslashes($yturbo_options['ytad5rsa']); ?>" />
                    <br /><small><?php _e('Укажите идентификатор блока РСЯ (например, <strong>RA-123456-7</strong>, <a target="_blank" href="https://tech.yandex.ru/turbo/doc/settings/ads-docpage/#doc-c-tabs-0-tab-0">как его узнать</a>)</small>.', 'rss-for-yandex-turbo'); ?>
               </td>
            </tr>
            <tr class="myturbo trfox5 block5" style="display:none;">
                <th><?php _e('Код ADFOX:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <textarea rows="12" cols="60" name="ytadfox5" id="ytadfox5"><?php echo stripcslashes($yturbo_options['ytadfox5']); ?></textarea>
                    <br /><small><?php _e('Код рекламной сети ADFOX (начиная с <tt>&lt;div></tt>, <a target="_blank" href="https://tech.yandex.ru/turbo/doc/settings/ads-docpage/#doc-c-tabs-0-tab-1">как его узнать</a>).', 'rss-for-yandex-turbo'); ?><br />
               </td>
            </tr>
            <tr class="myturbo trbordertop">
                <th><?php _e('Минимальный размер записи:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <input style="max-width: 54px;" name="ytrazmer" type="number" min="1" max="10000" step="1" value="<?php echo $yturbo_options['ytrazmer']; ?>" />
                    <br /><small><?php _e('Укажите минимальное количество символов записи для добавления рекламы.', 'rss-for-yandex-turbo'); ?><br/>
                    <?php _e('Данная опция используется только при вставке рекламы в <strong>середину</strong> записи.', 'rss-for-yandex-turbo'); ?><br/>
                    <?php _e('Учитывается только текст контента записи (HTML-разметка не считается).', 'rss-for-yandex-turbo'); ?>
                    </small>
               </td>
            </tr>

            <tr class="trbordertop">
                <th></th>
                <td>
                    <input type="submit" name="submit" class="button button-primary" value="<?php _e('Сохранить настройки &raquo;', 'rss-for-yandex-turbo'); ?>" />
                </td>
            </tr>

        </table>
        <?php if ( yturbo_check_ads() == true ) echo '</div>'; ?>
        <?php if ( yturbo_check_ads() == true ) : ?>
            <div class="alert alert-success">
            <?php $turboadslink = get_bloginfo('url') .'/wp-admin/options-general.php?page=wpcase-turbo-ads.php'; ?> 
            <p><?php _e( 'Настроить рекламу вы можете на странице', 'rss-for-yandex-turbo' ); ?> <a target="_blank" href="<?php echo $turboadslink; ?>"><?php _e( 'настроек', 'rss-for-yandex-turbo' ); ?></a> <?php _e('плагина "<strong>WPCase: Turbo Ads</strong>".', 'rss-for-yandex-turbo'); ?></p>
            </div>
        <?php endif; ?>
    </div><!-- end tab -->

    <div class="xyztabs__content<?php if($yturbo_options['yttab']=='Типы записей и исключения'){echo ' active';} ?>"><!-- begin tab -->

        <p><?php _e('Если у вас магазин на WordPress, то не включайте тип "Товары", а используйте <a target="_blank" href="https://webmaster.yandex.ru/blog/internet-magaziny-v-turbo">плагин генерации YML</a>.', 'rss-for-yandex-turbo'); ?><br />
        <?php _e('Будьте внимательны при настройке таксономий для включения или исключения из RSS-ленты.', 'rss-for-yandex-turbo'); ?><br />
        </p>

        <table class="form-table">
            <tr class="trbordertop">
                <th class="tdcheckbox"><?php _e('Типы записей:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <?php
                    $registered = get_post_types( array('public'=> true), 'objects' );
                    $exclude    = array('attachment');
                    $types      = array();

                    foreach ( $registered as $post ) {
                        if ( in_array( $post->name, $exclude ) ) {
                            continue;
                        }
                        $types[ $post->name ] = $post->name;
                    }

                    $yttype = explode(",", $yturbo_options['yttype']);
                    $yttype = array_diff($yttype, array(''));

                    foreach ( $types  as $post_type ) {
                        $obj = get_post_type_object( $post_type ); ?>
                        <label class="types" for="<?php echo $post_type; ?>"><input type="checkbox" value="<?php echo $post_type; ?>" name="types[]" id="<?php echo $post_type; ?>" <?php if (in_array($post_type, $yttype)) echo 'checked="checked"'; ?> /><?php echo $obj->labels->name; ?> (<?php echo $post_type; ?>)</label>
                    <?php } ?>
                    <small><?php _e('Типы записей для включения в RSS-ленту.', 'rss-for-yandex-turbo'); ?></small>
               </td>
            </tr>
            <tr class="ytqueryselect trbordertop">
                <th><?php _e('Включить в RSS:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <select name="ytqueryselect" id="ytqueryselect" style="width: 280px;">
                        <option value="Все таксономии, кроме исключенных" <?php if ($yturbo_options['ytqueryselect'] == 'Все таксономии, кроме исключенных') echo 'selected="selected"'; ?>><?php _e('Все таксономии, кроме исключенных', 'rss-for-yandex-turbo'); ?></option>
                        <option value="Только указанные таксономии" <?php if ($yturbo_options['ytqueryselect'] == 'Только указанные таксономии') echo 'selected="selected"'; ?>><?php _e('Только указанные таксономии', 'rss-for-yandex-turbo'); ?></option>
                    </select>
                    <br /><small><?php _e('Внимание! Будьте осторожны с этой настройкой!', 'rss-for-yandex-turbo'); ?><br />
                    <span id="includespan" <?php if ($yturbo_options['ytqueryselect'] != 'Только указанные таксономии') echo 'style="display:none;"'; ?>><?php _e('Обязательно установите ниже таксономии для включения в ленту - иначе лента будет пустой.', 'rss-for-yandex-turbo'); ?><br /></span>
                    <span id="excludespan" <?php if ($yturbo_options['ytqueryselect'] != 'Все таксономии, кроме исключенных') echo 'style="display:none;"'; ?>><?php _e('По умолчанию в ленту попадают записи всех таксономий, кроме указанных ниже.', 'rss-for-yandex-turbo'); ?><br /></span>
                    </small>
               </td>
            </tr> 
            <tr class="yttaxlisttr" <?php if ($yturbo_options['ytqueryselect'] != 'Все таксономии, кроме исключенных') echo 'style="display:none;"'; ?>>
                <th><?php _e('Таксономии для исключения:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <textarea rows="5" cols="70" name="yttaxlist" id="yttaxlist"><?php echo stripslashes($yturbo_options['yttaxlist']); ?></textarea>
                    <br /><small><?php _e('Используемый формат: <strong>taxonomy_name:id1,id2,id3</strong>', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Пример: <tt>category:1,2,4</tt> - записи рубрик с ID равным 1, 2 и 4 будут <strong style="color:red;">исключены</strong> из RSS-ленты.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Каждая новая таксономия должна начинаться с новой строки.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Стандартные таксономии WordPress: рубрика: <tt>category</tt>, метка: <tt>post_tag</tt>.', 'rss-for-yandex-turbo'); ?><br />

                    <br /><?php _e('Исключать из RSS-ленты отдельные записи необходимо в метабоксе плагина на странице редактировании записи.', 'rss-for-yandex-turbo'); ?><br />
                    </small>
                </td>
            </tr>
            <tr class="ytaddtaxlisttr" <?php if ($yturbo_options['ytqueryselect'] != 'Только указанные таксономии') echo 'style="display:none;"'; ?>>
                <th><?php _e('Таксономии для добавления:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <textarea rows="5" cols="70" name="ytaddtaxlist" id="ytaddtaxlist"><?php echo stripslashes($yturbo_options['ytaddtaxlist']); ?></textarea>
                    <br /><small><?php _e('Используемый формат: <strong>taxonomy_name:id1,id2,id3</strong>', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Пример: <tt>category:1,2,4</tt> - записи рубрик с ID равным 1, 2 и 4 будут <strong style="color:red;">добавлены</strong> в RSS-ленту.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Каждая новая таксономия должна начинаться с новой строки.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Стандартные таксономии WordPress: рубрика: <tt>category</tt>, метка: <tt>post_tag</tt>.', 'rss-for-yandex-turbo'); ?><br />
                    
                    <br /><?php _e('Исключать из RSS-ленты отдельные записи необходимо в метабоксе плагина на странице редактировании записи.', 'rss-for-yandex-turbo'); ?><br />
                    </small>
                </td>
            </tr> 
            <tr class="trbordertop">
                <th class="tdcheckbox"><?php _e('Колонка в админке:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytturbocolumn"><input type="checkbox" value="enabled" name="ytturbocolumn" id="ytturbocolumn" <?php if ($yturbo_options['ytturbocolumn'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Добавить колонку "Турбо" в админку', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('Будет выведена колонка (при просмотре списка записей) с информацией о турбо-статусе записей.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Статусы: есть в RSS-ленте, исключена вручную, запись на удалении, исключена фильтрами таксономий.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Статусы отображаются иконками для компактности, подробная информация при наведении курсора мышки.', 'rss-for-yandex-turbo'); ?><br />
                    </small>
                </td>
            </tr>

            <tr class="trbordertop">
                <th></th>
                <td>
                    <input type="submit" name="submit" class="button button-primary" value="<?php _e('Сохранить настройки &raquo;', 'rss-for-yandex-turbo'); ?>" />
                </td>
            </tr>
        </table>
    </div><!-- end tab -->

    <div class="xyztabs__content<?php if($yturbo_options['yttab']=='Шаблоны'){echo ' active';} ?>"><!-- begin tab -->

        <p><?php _e('Здесь можно создать собственный шаблон формирования контента для указанного типа записей.', 'rss-for-yandex-turbo'); ?><br />
        <?php _e('Чтобы здесь появились все выбранные вами типы записей - <strong>сохраните</strong> настройки плагина.', 'rss-for-yandex-turbo'); ?><br />
        </p>

        <p><?php _e('В шаблоне по умолчанию для каждого типа записей выводится только поле <strong>post_content</strong>.', 'rss-for-yandex-turbo'); ?><br />
        <?php _e('В стандартных типах записей (<strong>post</strong>, <strong>page</strong>) в этом поле содержится весь контент записи.', 'rss-for-yandex-turbo'); ?><br /></p>

        <p><?php _e('Для использования произвольных полей оберните название произвольного поля символами <strong>%%</strong>.', 'rss-for-yandex-turbo'); ?><br />
        <?php _e('Например, <strong>%%views%%</strong>, <strong>%%ratings%%</strong> или <strong>%%_aioseop_title%%</strong>.', 'rss-for-yandex-turbo'); ?>
        </p>

        <p><?php _e('Простой пример собственного шаблона:', 'rss-for-yandex-turbo'); ?><br />

<pre>&lt;h2&gt;Приветствуем!&lt;/h2&gt;

&lt;a href="[yt-permalink]" data-turbo="false"&gt;Полная версия статьи&lt;/a&gt;

%%post_content%%

Спасибо за внимание!

</pre>
        </p>

        <p><?php _e('То есть данную функцию плагина можно использовать в качестве "подписи" к вашим записям на турбо-страницах.', 'rss-for-yandex-turbo'); ?><br />
        <?php _e('Учтите, что фильтры плагина сработают уже после формирования контента записи по вашему шаблону.', 'rss-for-yandex-turbo'); ?><br />
        </p>

        <p><?php _e('В шаблоне можно использовать шорткоды (убедитесь, что их вывод не содержит скрипты или css-код).', 'rss-for-yandex-turbo'); ?><br />
        <?php _e('В плагин встроено несколько собственных шорткодов, полный их список вы можете посмотреть <a target="_blank" href="https://ru.wordpress.org/plugins/rss-for-yandex-turbo/#%D0%BA%D0%B0%D0%BA%D0%B8%D0%B5%20%D1%88%D0%BE%D1%80%D1%82%D0%BA%D0%BE%D0%B4%D1%8B%20%D0%BC%D0%BE%D0%B6%D0%BD%D0%BE%20%D0%B8%D1%81%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D1%82%D1%8C%20%D0%B2%20%D1%88%D0%B0%D0%B1%D0%BB%D0%BE%D0%BD%D0%B0%D1%85%3F">здесь</a>.', 'rss-for-yandex-turbo'); ?></p>
        <p> <?php _e('<strong>Внимание!</strong> Произвольные поля плагина <strong>Advanced Custom Fields</strong> необходимо обрабатывать <a target="_blank" href="https://ru.wordpress.org/plugins/rss-for-yandex-turbo/#%D1%88%D0%B0%D0%B1%D0%BB%D0%BE%D0%BD%D1%8B%20%D0%B8%20%D0%BF%D0%BB%D0%B0%D0%B3%D0%B8%D0%BD%20advanced%20custom%20fields">фильтром</a>.', 'rss-for-yandex-turbo'); ?><br /><br />
        </p>

            <table class="form-table">
            <?php
            $i = 0;
            foreach ( $types  as $post_type ) {
                $obj = get_post_type_object( $post_type );

                if (in_array($post_type, $yttype)) {
                    $i++; ?>
                <tr class="trbordertop">
                    <th class="tdcheckbox"><?php echo $obj->labels->name; ?>:</th>
                    <td>

                    <style>
                    i.mce-i-yablocks {background-image: url('<?php echo $purl; ?>/img/yablocks.png');}
                    i.mce-i-small {background-image: url('<?php echo $purl; ?>/img/small.png');}
                    i.mce-i-big {background-image: url('<?php echo $purl; ?>/img/big.png');}
                    </style>
                    <?php if ( !isset($yturbo_options['template-'.$post_type]) ) {$yturbo_options['template-'.$post_type] = '';} ?>
                    <?php if($yturbo_options['template-'.$post_type]=='') {$yturbo_options['template-'.$post_type]='%%post_content%%';} ?>

                    <?php $content = html_entity_decode(stripcslashes($yturbo_options['template-'.$post_type]),ENT_QUOTES); ?>
                    <?php $editor_id = 'wpeditor' . $post_type; ?>
                    <?php $textarea_name = 'template-' . $post_type; ?>
                    <?php $settings = array(
                                'textarea_name' => $textarea_name,
                                'wpautop'       => 1,
                                'media_buttons' => 1,
                                'textarea_rows' => 16,
                                'editor_height' => 300,
                                'tinymce'       => array(
                                    'toolbar1'      => 'undo,redo,formatselect,bold,italic,underline,strikethrough,superscript,subscript,hr,blockquote,link,unlink,bullist,numlist,table,yablocks,',
                                    'toolbar2'      => '',
                                    'toolbar3'      => '',
                                    'content_css'   => $purl . '/inc/editor.css?ver=' . $yturbo_options['version'],
                                ),
                                'quicktags'     => array(
                                    'id'      => $editor_id,
                                    'buttons' => 'strong,em,link,block,del,hr,img,ul,ol,li,code,close,'
                                ),
                         );
                    ?>
                    <?php wp_editor( $content, $editor_id, $settings); ?>
                    <small><?php _e('Шаблон контента для типа записи', 'rss-for-yandex-turbo'); ?>: <strong><?php echo $post_type; ?></strong>.</small>

                    </td>
                </tr>
            <?php }
            } ?>
            <?php if($i==0){echo __('<p><strong style="color:red;">Внимание!</strong> У вас не включен вывод ни для одного типа записей. <br />Перейдите на вкладку "<a href="#tab6">Типы записей и исключения</a>" и включите хотя бы один тип записей.</p>', 'rss-for-yandex-turbo');} ?>

            <tr class="trbordertop">
                <th></th>
                <td>
                    <input type="submit" name="submit" class="button button-primary" value="<?php _e('Сохранить настройки &raquo;', 'rss-for-yandex-turbo'); ?>" />
                </td>
            </tr>
        </table>
    </div><!-- end tab -->

    <div class="xyztabs__content<?php if($yturbo_options['yttab']=='Фильтры'){echo ' active';} ?>"><!-- begin tab -->

        <p><?php _e('В данной секции находятся продвинутые настройки. <br />Пожалуйста, будьте внимательны в этом разделе!', 'rss-for-yandex-turbo'); ?> </p>

        <table class="form-table">
            <tr class="ytexcludeshortcodestr trbordertop">
                <th class="tdcheckbox"><?php _e('Фильтр шорткодов:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytexcludeshortcodes"><input type="checkbox" value="enabled" name="ytexcludeshortcodes" id="ytexcludeshortcodes" <?php if ($yturbo_options['ytexcludeshortcodes'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Удалить указанные шорткоды', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('Из контента записей будут удалены все указанные шорткоды (вместе с их контентом).', 'rss-for-yandex-turbo'); ?> </small>
                </td>
            </tr>
            <tr class="ytexcludeshortcodeslisttr" <?php if ($yturbo_options['ytexcludeshortcodes'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th style="padding-top: 5px!important;"><?php _e('Шорткоды для удаления:', 'rss-for-yandex-turbo'); ?></th>
                <td style="padding-top: 5px!important;">
                    <?php
                    $shortcodes = $GLOBALS['shortcode_tags'];
                    $exclude    = array('wp_caption','caption','gallery','playlist','audio','video','embed','yt-permalink','yt-title');
                    $result = array(); 

                    foreach ($shortcodes as $key => $value) {
                        if ( ! in_array( $key, $exclude ) ) {
                            $result[] = $key;
                        }
                    }

                    $ytshortcodes = explode(",", $yturbo_options['ytexcludeshortcodeslist']);
                    $ytshortcodes = array_diff($ytshortcodes, array(''));

                    if ( ! empty($result) ) :

                    foreach ( $result as $shortcode ) { ?>
                        <label class="shortcodes" for="<?php echo $shortcode; ?>"><input type="checkbox" value="<?php echo $shortcode; ?>" name="shortcodes[]" id="<?php echo $shortcode; ?>" <?php if (in_array($shortcode, $ytshortcodes)) echo 'checked="checked"'; ?> />[<?php echo $shortcode; ?>]</label>
                    <?php } ?>
                    <small><?php _e('В списке находятся все зарегистрированные на сайте шорткоды, кроме системных.', 'rss-for-yandex-turbo'); ?><br />
                    </small>

                    <?php else : ?>
                        <p style="margin-top: -5px;"><?php _e('Сторонних шорткодов не найдено.', 'rss-for-yandex-turbo'); ?></p>
                    <?php endif; ?>
                </td>
            </tr>
            <tr class="ytexcludetagstr trbordertop">
                <th class="tdcheckbox"><?php _e('Фильтр тегов (без контента):', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytexcludetags"><input type="checkbox" value="enabled" name="ytexcludetags" id="ytexcludetags" <?php if ($yturbo_options['ytexcludetags'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Удалить указанные html-теги', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('Из контента записей будут удалены все указанные html-теги (<strong>без контента этих тегов</strong>).', 'rss-for-yandex-turbo'); ?></small>
                    

                </td>
            </tr>
            <tr class="ytexcludetagslisttr" <?php if ($yturbo_options['ytexcludetags'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th style="padding-top: 5px;"><?php _e('Теги для удаления:', 'rss-for-yandex-turbo'); ?></th>
                <td style="padding-top: 5px;">
                    <input style="display:none;" name="ytexcludetagslist-input" class="ytexcludetagslist-input" placeholder="" value="<?php echo stripslashes($yturbo_options['ytexcludetagslist']); ?>" />
                    <input type="hidden" id="tags-list" value="<?php echo yturbo_tags_list(); ?>" />
                    <input type="hidden" name="ytexcludetagslist" id="ytexcludetagslist" value="<?php echo stripslashes($yturbo_options['ytexcludetagslist']); ?>" />
                    <small><?php _e('Список удаляемых html-тегов. Начните набирать нужный тег для подсказки.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Самозакрывающиеся теги вроде <tt>&lt;br /></tt> этим фильтром удалить нельзя.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Список возможных для удаления тегов можно <a target="_blank" href="https://ru.wordpress.org/plugins/rss-for-yandex-turbo/#%D0%BA%D0%B0%D0%BA%20%D0%BF%D0%B5%D1%80%D0%B5%D0%BE%D0%BF%D1%80%D0%B5%D0%B4%D0%B5%D0%BB%D0%B8%D1%82%D1%8C%20%D1%81%D0%BF%D0%B8%D1%81%D0%BE%D0%BA%20%D1%82%D0%B5%D0%B3%D0%BE%D0%B2%20%D0%B4%D0%BB%D1%8F%20%D1%83%D0%B4%D0%B0%D0%BB%D0%B5%D0%BD%D0%B8%D1%8F%3F">переопределить</a>.', 'rss-for-yandex-turbo'); ?><br />
                    </small>
                </td>
            </tr>
            <tr class="ytexcludetags2tr trbordertop">
                <th class="tdcheckbox"><?php _e('Фильтр тегов (с контентом):', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytexcludetags2"><input type="checkbox" value="enabled" name="ytexcludetags2" id="ytexcludetags2" <?php if ($yturbo_options['ytexcludetags2'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Удалить указанные html-теги', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('Из контента записей будут удалены все указанные html-теги (<strong>включая контент этих тегов</strong>).', 'rss-for-yandex-turbo'); ?></small>
                </td>
            </tr>
            <tr class="ytexcludetagslist2tr" <?php if ($yturbo_options['ytexcludetags2'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th style="padding-top: 5px;"><?php _e('Теги для удаления:', 'rss-for-yandex-turbo'); ?></th>
                <td style="padding-top: 5px;">
                    <input style="display:none;" name="ytexcludetagslist-input2" class="ytexcludetagslist-input2" placeholder="" value="<?php echo stripslashes($yturbo_options['ytexcludetagslist2']); ?>" />
                    <input type="hidden" id="tags-list2" value="<?php echo yturbo_tags_list(); ?>" />
                    <input type="hidden" name="ytexcludetagslist2" id="ytexcludetagslist2" value="<?php echo stripslashes($yturbo_options['ytexcludetagslist2']); ?>" />
                    <small><?php _e('Список удаляемых html-тегов. Начните набирать нужный тег для подсказки.', 'rss-for-yandex-turbo'); ?><br />
                    <?php _e('Самозакрывающиеся теги вроде <tt>&lt;br /></tt> этим фильтром удалить нельзя.', 'rss-for-yandex-turbo'); ?> <br />
                    <?php _e('Список возможных для удаления тегов можно <a target="_blank" href="https://ru.wordpress.org/plugins/rss-for-yandex-turbo/#%D0%BA%D0%B0%D0%BA%20%D0%BF%D0%B5%D1%80%D0%B5%D0%BE%D0%BF%D1%80%D0%B5%D0%B4%D0%B5%D0%BB%D0%B8%D1%82%D1%8C%20%D1%81%D0%BF%D0%B8%D1%81%D0%BE%D0%BA%20%D1%82%D0%B5%D0%B3%D0%BE%D0%B2%20%D0%B4%D0%BB%D1%8F%20%D1%83%D0%B4%D0%B0%D0%BB%D0%B5%D0%BD%D0%B8%D1%8F%3F">переопределить</a>.', 'rss-for-yandex-turbo'); ?><br />
                    </small>
                </td>
            </tr>
            <tr class="ytexcludecontenttr trbordertop">
                <th class="tdcheckbox"><?php _e('Контент для удаления:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <label for="ytexcludecontent"><input type="checkbox" value="enabled" name="ytexcludecontent" id="ytexcludecontent" <?php if ($yturbo_options['ytexcludecontent'] == 'enabled') echo 'checked="checked"'; ?> /><?php _e('Удалить указанный контент из RSS', 'rss-for-yandex-turbo'); ?></label>
                    <br /><small><?php _e('Точные вхождения указанного контента будут удалены из записей в RSS-ленте.', 'rss-for-yandex-turbo'); ?></small>
                </td>
            </tr>
            <tr class="ytexcludecontentlisttr" <?php if ($yturbo_options['ytexcludecontent'] == 'disabled') echo 'style="display:none;"'; ?>>
                <th><?php _e('Список удаляемого контента:', 'rss-for-yandex-turbo'); ?></th>
                <td>
                    <textarea rows="8" cols="70" name="ytexcludecontentlist" id="ytexcludecontentlist"><?php echo stripcslashes($yturbo_options['ytexcludecontentlist']); ?></textarea>
                    <br /><small><?php _e('Каждый новый шаблон для удаления должен начинаться с новой строки.', 'rss-for-yandex-turbo'); ?><br />
                    </small>
                </td>
            </tr>

            <tr class="trbordertop">
                <th></th>
                <td>
                    <input type="submit" name="submit" class="button button-primary" value="<?php _e('Сохранить настройки &raquo;', 'rss-for-yandex-turbo'); ?>" />
                </td>
            </tr>
        </table>
    </div><!-- end tab -->

</div><!-- .xyztabs -->

<div id="about" class="postbox" style="margin-bottom:0;">
<script>
var closeabout = localStorage.getItem('yt-close-about');
if (closeabout == 'yes') {
    document.getElementById('about').className = 'postbox hide';
    document.getElementById('restore-hide-blocks').className = 'dashicons dashicons-admin-generic';
}
</script>
    <h3 style="border-bottom: 1px solid #E1E1E1;background: #f7f7f7;"><?php _e('О плагине', 'rss-for-yandex-turbo'); ?>
    <span id="close-about" class="dashicons dashicons-no-alt" title="<?php _e('Скрыть блок', 'rss-for-yandex-turbo'); ?>"></span></h3>
      <div class="inside" style="padding-bottom:15px;display: block;">

      <p><?php _e('Если вам нравится мой плагин, то, пожалуйста, поставьте ему <a target="_blank" href="https://wordpress.org/support/plugin/rss-for-yandex-turbo/reviews/#new-post"><strong>5 звезд</strong></a> в репозитории.', 'rss-for-yandex-turbo'); ?></p>
      <p style="margin-top:20px;margin-bottom:10px;"><?php _e('Возможно, что вам также будут интересны другие мои плагины:', 'rss-for-yandex-turbo'); ?></p>

      <div class="about">
        <ul>
            <li><a target="_blank" href="https://ru.wordpress.org/plugins/rss-for-yandex-zen/">RSS for Yandex Zen</a> - <?php _e('создание RSS-ленты для сервиса Яндекс.Дзен.', 'rss-for-yandex-turbo'); ?></li>
            <li><a target="_blank" href="https://ru.wordpress.org/plugins/bbspoiler/">BBSpoiler</a> - <?php _e('плагин позволит вам спрятать текст под тегами [spoiler]текст[/spoiler].', 'rss-for-yandex-turbo'); ?></li>
            <li><a target="_blank" href="https://ru.wordpress.org/plugins/easy-textillate/">Easy Textillate</a> - <?php _e('плагин очень красиво анимирует текст (шорткодами в записях и виджетах или PHP-кодом в файлах темы).', 'rss-for-yandex-turbo'); ?> </li>
            <li><a target="_blank" href="https://ru.wordpress.org/plugins/cool-image-share/">Cool Image Share</a> - <?php _e('плагин добавляет иконки социальных сетей на каждое изображение в ваших записях.', 'rss-for-yandex-turbo'); ?> </li>
            <li><a target="_blank" href="https://ru.wordpress.org/plugins/today-yesterday-dates/">Today-Yesterday Dates</a> - <?php _e('относительные даты для записей за сегодня и вчера.', 'rss-for-yandex-turbo'); ?> </li>
            <li><a target="_blank" href="https://ru.wordpress.org/plugins/truncate-comments/">Truncate Comments</a> - <?php _e('плагин скрывает длинные комментарии js-скриптом (в стиле Яндекса или Амазона).', 'rss-for-yandex-turbo'); ?> </li>
            <li><a target="_blank" href="https://ru.wordpress.org/plugins/easy-yandex-share/">Easy Yandex Share</a> - <?php _e('продвинутый вывод блока &#8220;Яндекс.Поделиться&#8221;.', 'rss-for-yandex-turbo'); ?></li>
            <li><a target="_blank" href="https://ru.wordpress.org/plugins/hide-my-dates/">Hide My Dates</a> - <?php _e('плагин прячет от Гугла даты публикации записей и комментариев.', 'rss-for-yandex-turbo'); ?></li>
            <li style="margin: 3px 0px 3px 35px;"><a target="_blank" href="https://ru.wordpress.org/plugins/html5-cumulus/">HTML5 Cumulus</a> <span class="new">new</span> - <?php _e('современная (HTML5) версия классического плагина &#8220;WP-Cumulus&#8221;.', 'rss-for-yandex-turbo'); ?></li>

            </ul>
      </div>
    </div>
</div>
<?php wp_nonce_field( plugin_basename(__FILE__), 'yturbo_nonce' ); ?>
</form>
</div>
</div>
</div>
<?php 
}
//функция вывода страницы настроек плагина end

//функция добавления ссылки на страницу настроек плагина в раздел "Настройки" begin
function yturbo_menu() {
    add_options_page('Яндекс.Турбо', 'Яндекс.Турбо', 'manage_options', 'rss-for-yandex-turbo.php', 'yturbo_options_page');
}
add_action( 'admin_menu', 'yturbo_menu' );
//функция добавления ссылки на страницу настроек плагина в раздел "Настройки" end

//создаем метабокс begin
function yturbo_meta_box() {
    $yturbo_options = get_option('yturbo_options');
    $yttype = $yturbo_options['yttype'];
    $yttype = explode(",", $yttype);
    $yttype = array_diff($yttype, array(''));

    $ytqueryselect = $yturbo_options['ytqueryselect'];
    $yttaxlist = $yturbo_options['yttaxlist'];
    $ytaddtaxlist = $yturbo_options['ytaddtaxlist'];

    if (!$yttaxlist) {$yttaxlist = 'category:10000000';}
    if ($ytqueryselect=='Все таксономии, кроме исключенных' && $yttaxlist) {
        $textAr = explode("\n", trim($yttaxlist));
        $textAr = array_filter($textAr, 'trim');
        add_meta_box('yturbo_meta_box', 'Яндекс.Турбо', 'yturbo_callback', $yttype, 'normal' , 'high');
        foreach ($textAr as $line) {
            $tax = explode(":", $line);
            $taxterm = explode(",", $tax[1]);
            $taxterm = array_map('intval', $taxterm);
            if ( has_term($taxterm, $tax[0]) ) {
                remove_meta_box('yturbo_meta_box', $yttype, 'normal' );
                break;
            }
        }
    }
    if (!$ytaddtaxlist) {$ytaddtaxlist = 'category:10000000';}
    if ($ytqueryselect=='Только указанные таксономии' && $ytaddtaxlist) {
        $textAr = explode("\n", trim($ytaddtaxlist));
        $textAr = array_filter($textAr, 'trim');
        foreach ($textAr as $line) {
            $tax = explode(":", $line);
            $taxterm = explode(",", $tax[1]);
            $taxterm = array_map('intval', $taxterm);
            if ( has_term($taxterm, $tax[0]) ) {
                add_meta_box('yturbo_meta_box', 'Яндекс.Турбо', 'yturbo_callback', $yttype, 'normal' , 'high');
                break;
            }
        }
    }
}
add_action( 'add_meta_boxes', 'yturbo_meta_box' );
//создаем метабокс end

//сохраняем метабокс begin
function yturbo_save_metabox( $post_id ) {

    if ( ! isset($_POST['yturbo_meta_nonce']) )
        return $post_id;

    if ( ! wp_verify_nonce($_POST['yturbo_meta_nonce'], plugin_basename(__FILE__)) )
        return $post_id;

    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
        return $post_id;

    if(isset($_POST['ytrssenabled'])){
        update_post_meta($post_id, 'ytrssenabled_meta_value', 'yes');
    } else {
        update_post_meta($post_id, 'ytrssenabled_meta_value', 'no');
    }
    if(isset($_POST['ytremove'])){
        update_post_meta($post_id, 'ytremove_meta_value', 'yes');
    } else {
        update_post_meta($post_id, 'ytremove_meta_value', 'no');
    }

    if(isset($_POST['ytad1meta'])){
        update_post_meta($post_id, 'ytad1meta', 'disabled');
    } else {
        update_post_meta($post_id, 'ytad1meta', 'enabled');
    }
    if(isset($_POST['ytad2meta'])){
        update_post_meta($post_id, 'ytad2meta', 'disabled');
    } else {
        update_post_meta($post_id, 'ytad2meta', 'enabled');
    }
    if(isset($_POST['ytad3meta'])){
        update_post_meta($post_id, 'ytad3meta', 'disabled');
    } else {
        update_post_meta($post_id, 'ytad3meta', 'enabled');
    }
    if(isset($_POST['ytad4meta'])){
        update_post_meta($post_id, 'ytad4meta', 'disabled');
    } else {
        update_post_meta($post_id, 'ytad4meta', 'enabled');
    }
    if(isset($_POST['ytad5meta'])){
        update_post_meta($post_id, 'ytad5meta', 'disabled');
    } else {
        update_post_meta($post_id, 'ytad5meta', 'enabled');
    }

    if(isset($_POST['template_meta'])){
        $template_meta = 'yes';
        update_post_meta($post_id, 'template_meta', $template_meta);
    } else {
        $template_meta = 'no';
        update_post_meta($post_id, 'template_meta', $template_meta);
    }

    //сохраняем индивидуальный шаблон только, если стоит галочка на его использовании
    if($template_meta == 'yes') {
        $custom_template = esc_textarea($_POST['custom_template']);
        update_post_meta($post_id, 'custom_template', $custom_template);
    }
}
add_action( 'save_post', 'yturbo_save_metabox' );
//сохраняем метабокс end

//выводим метабокс begin
function yturbo_callback() {
    global $post;
    $purl = plugins_url('', __FILE__);
    wp_nonce_field( plugin_basename(__FILE__), 'yturbo_meta_nonce' );

    $yturbo_options = get_option('yturbo_options');

    $ytad1meta = get_post_meta($post->ID, 'ytad1meta', true);
    if (!$ytad1meta) {$ytad1meta = $yturbo_options['ytad1'];}

    $ytad2meta = get_post_meta($post->ID, 'ytad2meta', true);
    if (!$ytad2meta) {$ytad2meta = $yturbo_options['ytad2'];}

    $ytad3meta = get_post_meta($post->ID, 'ytad3meta', true);
    if (!$ytad3meta) {$ytad3meta = $yturbo_options['ytad3'];}

    $ytad4meta = get_post_meta($post->ID, 'ytad4meta', true);
    if (!$ytad4meta) {$ytad4meta = $yturbo_options['ytad4'];}

    $ytad5meta = get_post_meta($post->ID, 'ytad5meta', true);
    if (!$ytad5meta) {$ytad5meta = $yturbo_options['ytad5'];}

    $ytrssenabled = get_post_meta($post->ID, 'ytrssenabled_meta_value', true);
    if (!$ytrssenabled) {$ytrssenabled = 'no';}

    $ytremove = get_post_meta($post->ID, 'ytremove_meta_value', true);
    if (!$ytremove) {$ytremove = 'no';}

    $template_meta = get_post_meta($post->ID, 'template_meta', true);
    if (!$template_meta) {$template_meta = 'no';}

    $custom_template = get_post_meta($post->ID, 'custom_template', true);
    $custom_template = html_entity_decode(stripcslashes($custom_template),ENT_QUOTES);
    if (!$custom_template) {
        $post_type = get_post_type( get_the_ID() );
        if ( !isset($yturbo_options['template-'.$post_type]) ) {$yturbo_options['template-'.$post_type] = '';}
        if ( $yturbo_options['template-'.$post_type] == '' ) {
            $custom_template = '%%post_content%%';
        } else {
            $custom_template = html_entity_decode(stripcslashes($yturbo_options['template-'.$post_type]),ENT_QUOTES);
        }
    }
    //обрабатываем шаблон функцией wpautop, если активирован блочный редактор
    global $wp_version;
    $block_editor_enabled = false;
    if ( version_compare( $wp_version, '5.0', '>=' ) ) {
        $block_editor_enabled = get_current_screen()->is_block_editor();
    }
    if ( $block_editor_enabled == true ) {
        $custom_template = wpautop( $custom_template );
    }
    ?>

    <p style="margin: 10px 0px 0px 1px!important;">

<script>
jQuery(document).ready(function($) {
    if ($('#ytrssenabled').is(':checked')) {$temp = 1;}
    if ($('#ytremove').is(':checked')) {$('#ytrssenabled').removeAttr('checked');$('#ytrssenabled').attr('disabled', true);}
    $('#ytrssenabled').change(function() {
        if(this.checked) {
            $temp = 1;
        } else {
            $temp = 0;
        }
    });
    $('#ytremove').change(function() {
        if(this.checked) {
            $('#ytrssenabled').removeAttr('checked');
            $('#ytrssenabled').attr('disabled', true);
        } else {
            $('#ytrssenabled').attr('disabled', false);
            if ($temp == 1) {$('#ytrssenabled').attr ('checked', 'checked');}
        }
    });
    $('#template_meta').change(function() {
        if(this.checked) {
            $('#custom_template_op').fadeIn();
        } else {
            $('#custom_template_op').hide();
        }
    });
})
</script>
<style>
i.mce-i-yablocks {background-image: url('<?php echo $purl; ?>/img/yablocks.png');}
i.mce-i-small {background-image: url('<?php echo $purl; ?>/img/small.png');}
i.mce-i-big {background-image: url('<?php echo $purl; ?>/img/big.png');}
tt{padding: 1px 5px 1px;margin: 0 1px;background: #eaeaea;background: rgba(0, 0, 0, .07);font-family: Consolas, Monaco, monospace;unicode-bidi: embed;}
</style>

    <label for="ytrssenabled"><input type="checkbox" <?php if ($ytremove != 'yes') {echo 'value="enabled"';}else{echo 'disabled';} ?> name="ytrssenabled" id="ytrssenabled" <?php if ($ytrssenabled == 'yes' && $ytremove != 'yes') echo 'checked="checked"'; ?> /><?php _e('Исключить эту запись из RSS', 'rss-for-yandex-turbo'); ?></label><br />
    <label for="ytremove"><input type="checkbox" name="ytremove" id="ytremove" <?php if ($ytremove == 'yes') echo 'checked="checked"'; ?> /><?php _e('Удалить турбо-страницу для этой записи', 'rss-for-yandex-turbo'); ?></label><br>

    <small style="margin-top:5px;"><?php _e('Удалить турбо-страницу можно только, если запись попадет в RSS-ленту.', 'rss-for-yandex-turbo'); ?></small>
    </p>

    <p style="margin:10px 0 5px 1px!important;">

    <?php if ($yturbo_options['ytad1'] == 'enabled') { ?>
        <label for="ytad1meta"><input type="checkbox" name="ytad1meta" id="ytad1meta" <?php if ($ytad1meta == 'disabled') echo 'checked="checked"'; ?> /><?php _e('Отключить блок рекламы #1 для этой записи (в начале записи)', 'rss-for-yandex-turbo'); ?></label><br />
    <?php } ?>
    <?php if ($yturbo_options['ytad2'] == 'enabled') { ?>
        <label for="ytad2meta"><input type="checkbox" name="ytad2meta" id="ytad2meta" <?php if ($ytad2meta == 'disabled') echo 'checked="checked"'; ?> /><?php _e('Отключить блок рекламы #2 для этой записи (в середине записи)', 'rss-for-yandex-turbo'); ?></label><br />
    <?php } ?>
    <?php if ($yturbo_options['ytad3'] == 'enabled') { ?>
        <label for="ytad3meta"><input type="checkbox" name="ytad3meta" id="ytad3meta" <?php if ($ytad3meta == 'disabled') echo 'checked="checked"'; ?> /><?php _e('Отключить блок рекламы #3 для этой записи (в конце записи)', 'rss-for-yandex-turbo'); ?></label><br />
    <?php } ?>
    <?php if ($yturbo_options['ytad4'] == 'enabled') { ?>
        <label for="ytad4meta"><input type="checkbox" name="ytad4meta" id="ytad4meta" <?php if ($ytad4meta == 'disabled') echo 'checked="checked"'; ?> /><?php _e('Отключить блок рекламы #4 для этой записи (после блока "Поделиться")', 'rss-for-yandex-turbo'); ?></label><br />
    <?php } ?>
    <?php if ($yturbo_options['ytad5'] == 'enabled') { ?>
        <label for="ytad5meta"><input type="checkbox" name="ytad5meta" id="ytad5meta" <?php if ($ytad5meta == 'disabled') echo 'checked="checked"'; ?> /><?php _e('Отключить блок рекламы #5 для этой записи (после комментариев)', 'rss-for-yandex-turbo'); ?></label><br />
    <?php } ?>
    </p>

    <div style="margin:10px 0 5px 1px!important;">
        <label for="template_meta"><input type="checkbox" name="template_meta" id="template_meta" <?php if ($template_meta == 'yes') echo 'checked="checked"'; ?> /><?php _e('Задать индивидуальный шаблон для этой записи', 'rss-for-yandex-turbo'); ?></label><br />  
        <div id="custom_template_op" class="foptions" style="margin:5px 0 0 0;margin-top:5px;<?php if ($template_meta != 'yes') echo 'display:none;'; ?>">
        <style>.foptions .wp-editor-wrap .button,.foptions .wp-editor-wrap .button-secondary{color:#555;border-color:#ccc;background:#f7f7f7;box-shadow:0 1px 0 #ccc;vertical-align:top}.foptions .wp-editor-wrap .button-secondary:active,.foptions .wp-editor-wrap .button.active,.foptions .wp-editor-wrap .button.active:hover,.foptions .wp-editor-wrap .button:active{background:#eee;border-color:#999;box-shadow:inset 0 2px 5px -3px rgba(0,0,0,.5);transform:translateY(1px)}.foptions .wp-editor-wrap .button:active,.foptions .wp-editor-wrap .button:focus{outline:2px solid transparent;outline-offset:0}.foptions .wp-editor-wrap .button-secondary:focus,.foptions .wp-editor-wrap .button-secondary:hover,.foptions .wp-editor-wrap .button.focus,.foptions .wp-editor-wrap .button.hover,.foptions .wp-editor-wrap .button:focus,.foptions .wp-editor-wrap .button:hover{background:#fafafa;border-color:#999;color:#23282d}.foptions .wp-editor-area,.foptions .wp-editor-area:active,.foptions .wp-editor-area:focus{box-shadow:0 0 2px rgba(30,140,190,0)!important;border:none!important;border-radius:0!important}.foptions .wp-editor-wrap #insert-media-button:focus,.foptions .wp-editor-wrap .button:focus{border-color:#5b9dd9;box-shadow:0 0 3px rgba(0,115,170,.8)}.foptions .wp-editor-wrap .button-secondary:active,.foptions .wp-editor-wrap .button.active,.foptions .wp-editor-wrap .button.active:hover,.foptions .wp-editor-wrap .button:active{background:#eee;border-color:#999;box-shadow:inset 0 2px 5px -3px rgba(0,0,0,.5);transform:translateY(1px)}.foptions .wp-editor-wrap .mce-ico.mce-i-table{margin-top:2px;height:18px}.foptions #wp-customtemplate-wrap{margin-bottom:6px}.foptions .wp-editor-wrap .mce-btn-has-text .mce-ico {padding-right: 0px!important;}.foptions .wp-editor-wrap .mce-btn-has-text .mce-txt{font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif!important;}</style>
        <div style="margin-top:10px;"></div>
        <?php $settings = array(
            'textarea_name' => 'custom_template',
            'wpautop'       => 1,
            'media_buttons' => 1,
            'textarea_rows' => 16,
            'editor_height' => 350,
            'tinymce'       => array(
                'toolbar1'      => 'undo,redo,formatselect,bold,italic,underline,strikethrough,superscript,subscript,hr,blockquote,link,unlink,bullist,numlist,table,yablocks,',
                'toolbar2'      => '',
                'toolbar3'      => '',
                'content_css'   => $purl . '/inc/editor.css?ver=' . $yturbo_options['version'],
            ),
            'quicktags'     => array(
                'id'      => 'customtemplate',
                'buttons' => 'strong,em,link,block,del,hr,img,ul,ol,li,code,close,'
            ),
        ); ?>
        <?php wp_editor( $custom_template, 'customtemplate', $settings ); ?>
        <small><?php _e('Названия произвольных полей должны быть обернуты символами <strong>%%</strong>.', 'rss-for-yandex-turbo'); ?>
        <?php _e('Например, <strong>%%views%%</strong>. Стандартное поле со всем контентом - <strong>%%post_content%%</strong>.', 'rss-for-yandex-turbo'); ?><br />
        <?php _e('Проверяйте отображение записи в "Отладке" в Яндекс.Вебмастере - визуальный редактор WordPress не может отобразить блоки так, как они будут выглядеть на турбо-страницах. ', 'rss-for-yandex-turbo'); ?><br />
        <?php _e('При слишком большом различии контента мобильной версии страницы от ее турбо-версии Яндекс может выдать ошибку и отключить турбо-страницу для этой записи.', 'rss-for-yandex-turbo'); ?><br />
        <?php _e('Документацию по оформлению элементов турбо-страниц вы можете посмотреть <a target="_blank" href="https://yandex.ru/dev/turbo/doc/rss/elements/index-docpage/">тут</a>, список встроенных в плагин шорткодов <a target="_blank" href="https://ru.wordpress.org/plugins/rss-for-yandex-turbo/#%D0%BA%D0%B0%D0%BA%D0%B8%D0%B5%20%D1%88%D0%BE%D1%80%D1%82%D0%BA%D0%BE%D0%B4%D1%8B%20%D0%BC%D0%BE%D0%B6%D0%BD%D0%BE%20%D0%B8%D1%81%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D1%82%D1%8C%20%D0%B2%20%D1%88%D0%B0%D0%B1%D0%BB%D0%BE%D0%BD%D0%B0%D1%85%3F">здесь</a>.', 'rss-for-yandex-turbo'); ?><br />

        <?php if ( $block_editor_enabled == true ) { ?>
            <?php _e('<br /><span style="color:red;">Внимание!</span> Вы используете блочный редактор, в этом случае автоформатирование текста на основе переноса строк работать не будет, расставляйте ', 'rss-for-yandex-turbo'); ?><br />
            <?php _e('теги <tt>&lt;p></tt> и <tt>&lt;br /></tt> вручную или в визуальном режиме редактора (плагин потом заменит код <tt>&lt;p>%%post_content%%&lt;/p></tt> на <tt>%%post_content%%</tt>).', 'rss-for-yandex-turbo'); ?><br />
        <?php } ?>
        </small>
        </div>
    </div>

<?php }
//выводим метабокс end

//добавляем новую rss-ленту begin
function yturbo_add_feed() {
    $yturbo_options = get_option('yturbo_options');
    add_feed($yturbo_options['ytrssname'], 'yturbo_feed_template');
}
add_action( 'init', 'yturbo_add_feed' );
//добавляем новую rss-ленту end

//шаблон для RSS-ленты Яндекс.Турбо begin
function yturbo_feed_template() {
$yturbo_options = get_option('yturbo_options');

$yttitle = $yturbo_options['yttitle'];
$ytlink = $yturbo_options['ytlink'];
$ytdescription = $yturbo_options['ytdescription'];
$ytlanguage = $yturbo_options['ytlanguage'];
$ytnumber = $yturbo_options['ytnumber'];
$ytrazb = $yturbo_options['ytrazb'];
$ytrazbnumber = $yturbo_options['ytrazbnumber'];
$yttype = $yturbo_options['yttype'];
$yttype = explode(",", $yttype);
$yttype = array_diff($yttype, array(''));
$ytfigcaption = $yturbo_options['ytfigcaption'];
$ytauthorselect = $yturbo_options['ytauthorselect'];
$ytauthor = $yturbo_options['ytauthor'];
$ytthumbnail = $yturbo_options['ytthumbnail'];
$ytselectthumb = $yturbo_options['ytselectthumb'];

if ( yturbo_check_ads() == true ) {
    $yturbo_options['ytad1'] = 'disabled';
    $yturbo_options['ytad2'] = 'disabled';
    $yturbo_options['ytad3'] = 'disabled';
    $yturbo_options['ytad4'] = 'disabled';
    $yturbo_options['ytad5'] = 'disabled';
    update_option('yturbo_options', $yturbo_options);
}
$ytad1 = $yturbo_options['ytad1'];
$ytad1set = $yturbo_options['ytad1set'];
$ytad1rsa = $yturbo_options['ytad1rsa'];
$ytadfox1 = html_entity_decode(stripcslashes($yturbo_options['ytadfox1']),ENT_QUOTES);
$ytad2 = $yturbo_options['ytad2'];
$ytad2set = $yturbo_options['ytad2set'];
$ytad2rsa = $yturbo_options['ytad2rsa'];
$ytadfox2 = html_entity_decode(stripcslashes($yturbo_options['ytadfox2']),ENT_QUOTES);
$ytad3 = $yturbo_options['ytad3'];
$ytad3set = $yturbo_options['ytad3set'];
$ytad3rsa = $yturbo_options['ytad3rsa'];
$ytadfox3 = html_entity_decode(stripcslashes($yturbo_options['ytadfox3']),ENT_QUOTES);
$ytad4 = $yturbo_options['ytad4'];
$ytad4set = $yturbo_options['ytad4set'];
$ytad4rsa = $yturbo_options['ytad4rsa'];
$ytadfox4 = html_entity_decode(stripcslashes($yturbo_options['ytadfox4']),ENT_QUOTES);
$ytad5 = $yturbo_options['ytad5'];
$ytad5set = $yturbo_options['ytad5set'];
$ytad5rsa = $yturbo_options['ytad5rsa'];
$ytadfox5 = html_entity_decode(stripcslashes($yturbo_options['ytadfox5']),ENT_QUOTES);

$ytexcludetags = $yturbo_options['ytexcludetags'];
$ytexcludetagslist = $yturbo_options['ytexcludetagslist'];
$ytexcludetags2 = $yturbo_options['ytexcludetags2'];
$ytexcludetagslist2 = $yturbo_options['ytexcludetagslist2'];
$ytexcludecontent = $yturbo_options['ytexcludecontent'];
$ytexcludecontentlist = html_entity_decode($yturbo_options['ytexcludecontentlist']);
$tax_query = array();

$ytrelated = $yturbo_options['ytrelated'];
$ytrelatednumber = $yturbo_options['ytrelatednumber'];
$ytrelatedselectthumb = $yturbo_options['ytrelatedselectthumb'];
$ytrelatedcachetime = $yturbo_options['ytrelatedcachetime'];
$ytremoveturbo = $yturbo_options['ytremoveturbo'];
$ytrelatedinfinity = $yturbo_options['ytrelatedinfinity'];
$ytrelatedcache = $yturbo_options['ytrelatedcache'];

$ytmetrika = $yturbo_options['ytmetrika'];
$ytliveinternet = $yturbo_options['ytliveinternet'];
$ytgoogle = $yturbo_options['ytgoogle'];
$ytmailru = $yturbo_options['ytmailru'];
$ytrambler = $yturbo_options['ytrambler'];
$ytmediascope = $yturbo_options['ytmediascope'];

$ytqueryselect = $yturbo_options['ytqueryselect'];
$yttaxlist = $yturbo_options['yttaxlist'];
$ytaddtaxlist = $yturbo_options['ytaddtaxlist'];

$ytselectmenu = $yturbo_options['ytselectmenu'];
$ytcomments = $yturbo_options['ytcomments'];
$ytcommentsnumber = $yturbo_options['ytcommentsnumber'];
$ytcommentsorder = $yturbo_options['ytcommentsorder'];
if ($ytcommentsorder=='В начале новые комментарии'){
    $reverse_top_level=false;
    $reverse_children=false;
} else {
    $reverse_top_level=true;
    $reverse_children=true;
}
$ytcommentsdate = $yturbo_options['ytcommentsdate'];
$ytcommentsdrevo = $yturbo_options['ytcommentsdrevo'];
if ($ytcommentsdrevo=='enabled') {
    $ytcommentsdrevo = 2;
} else {
    $ytcommentsdrevo = 1;
}
$ytpostdate = $yturbo_options['ytpostdate'];

$ytrating = $yturbo_options['ytrating'];
$ytratingmin = $yturbo_options['ytratingmin'];
$ytratingmax = $yturbo_options['ytratingmax'];
$ytrelateddate = $yturbo_options['ytrelateddate'];

if ($ytqueryselect=='Все таксономии, кроме исключенных' && $yttaxlist) {
    $textAr = explode("\n", trim($yttaxlist));
    $textAr = array_filter($textAr, 'trim');
    $tax_query = array( 'relation' => 'AND' );
    foreach ($textAr as $line) {
        $tax = explode(":", $line);
        $taxterm = explode(",", $tax[1]);
        $tax_query[] = array(
            'taxonomy' => $tax[0],
            'field'    => 'id',
            'terms'    => $taxterm,
            'operator' => 'NOT IN',
        );
    }
}
if (!$ytaddtaxlist) {$ytaddtaxlist = 'category:10000000';}
if ($ytqueryselect=='Только указанные таксономии' && $ytaddtaxlist) {
    $textAr = explode("\n", trim($ytaddtaxlist));
    $textAr = array_filter($textAr, 'trim');
    $tax_query = array( 'relation' => 'OR' );
    foreach ($textAr as $line) {
        $tax = explode(":", $line);
        $taxterm = explode(",", $tax[1]);
        $tax_query[] = array(
            'taxonomy' => $tax[0],
            'field'    => 'id',
            'terms'    => $taxterm,
            'operator' => 'IN',
        );
    }
}

if ($ytrazb == 'enabled' && $ytrazbnumber) {
    if (isset($_GET['paged'])) {
        $paged = $_GET['paged'];
    } else {
        $paged = 1;
    }
    if ($paged == 0) {$paged = 1;}
} else {
    $paged = 1;
    $ytrazbnumber = $ytnumber;
}
if ( isset($_GET['lenta']) && $_GET['lenta'] == 'trash' ) {
    if ( $yturbo_options['ytexcludeurls'] == 'enabled' ) {
        yturbo_lenta_trash();
        exit;
    }
}

//если в настройках не выбраны типы записей, то отключаем дефолтный post_type равный 'post'
if($yttype[0]==''){$yttype[0]='trulala';}

$args = array(
    'paged' => $paged,
    'ignore_sticky_posts' => 1,
    'post_type' => $yttype,
    'post_status' => 'publish',
    'posts_per_page' => $ytrazbnumber,
    'tax_query' => $tax_query,
    'meta_query' => array(
        'relation' => 'OR',
            array('key' => 'ytrssenabled_meta_value', 'compare' => 'NOT EXISTS',),
            array('key' => 'ytrssenabled_meta_value', 'value' => 'yes', 'compare' => '!=',),
    )
);
$args = apply_filters( 'yturbo_query_args', $args );
$query = new WP_Query( $args );

header('Content-Type: ' . feed_content_type('rss2') . '; charset=' . get_option('blog_charset'), true);
echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>'.PHP_EOL;
?>
<rss
    xmlns:yandex="http://news.yandex.ru"
    xmlns:media="http://search.yahoo.com/mrss/"
    xmlns:turbo="http://turbo.yandex.ru"
    version="2.0">
<channel>
    <turbo:cms_plugin>C125AEEC6018B4A0EF9BF40E6615DD17</turbo:cms_plugin>
    <title><?php echo stripslashes($yttitle); ?></title>
    <link><?php echo esc_html($ytlink); ?></link>
    <description><?php echo stripslashes($ytdescription); ?></description>
    <?php if ($ytmetrika) { ?><turbo:analytics id="<?php echo $ytmetrika; ?>" type="Yandex"></turbo:analytics><?php echo PHP_EOL; ?><?php } ?>
    <?php if ($ytliveinternet) { ?><turbo:analytics type="LiveInternet"></turbo:analytics><?php echo PHP_EOL; ?><?php } ?>
    <?php if ($ytgoogle) { ?><turbo:analytics id="<?php echo $ytgoogle; ?>" type="Google"></turbo:analytics><?php echo PHP_EOL; ?><?php } ?>
    <?php if ($ytmailru) { ?><turbo:analytics id="<?php echo $ytmailru; ?>" type="MailRu"></turbo:analytics><?php echo PHP_EOL; ?><?php } ?>
    <?php if ($ytrambler) { ?><turbo:analytics id="<?php echo $ytrambler; ?>" type="Rambler"></turbo:analytics><?php echo PHP_EOL; ?><?php } ?>
    <?php if ($ytmediascope) { ?><turbo:analytics id="<?php echo $ytmediascope; ?>" type="Mediascope"></turbo:analytics><?php echo PHP_EOL; ?><?php } ?>
    <?php do_action( 'yturbo_ads_header' ); echo yturbo_turbo_ads(); ?>
    <language><?php echo $ytlanguage; ?></language>
    <generator>RSS for Yandex Turbo v<?php echo $yturbo_options['version']; ?> (https://wordpress.org/plugins/rss-for-yandex-turbo/)</generator>
    <?php do_action( 'yturbo_generator' ); ?>
    <?php while($query->have_posts()) : $query->the_post(); ?>
    <?php $ytremove = get_post_meta(get_the_ID(), 'ytremove_meta_value', true); ?>
    <?php if ($ytremoveturbo != 'enabled' && $ytremove != 'yes') { ?>
    <item turbo="true">
    <?php } else { ?>
    <item turbo="false">
    <?php } ?>
        <title><?php echo get_the_title_rss(); ?></title>
        <link><?php the_permalink_rss(); ?></link>
        <turbo:topic><?php echo get_the_title_rss(); ?></turbo:topic>
        <turbo:source><?php the_permalink_rss(); ?></turbo:source>
        <?php if ($ytpostdate == 'enabled') : ?>
        <?php $gmt_offset = get_option('gmt_offset');
              $gmt_offset_abs = floor(abs($gmt_offset));
              $gmt_offset_str = ($gmt_offset_abs > 9) ? $gmt_offset_abs.'00' : ('0'.$gmt_offset_abs.'00');
              $gmt_offset_str = $gmt_offset >= 0 ? '+' . $gmt_offset_str : '-' . $gmt_offset_str; ?>
        <?php if ($yturbo_options['ytdateformat'] == 'create') { ?>
        <pubDate><?php echo mysql2date('D, d M Y H:i:s '.$gmt_offset_str, get_date_from_gmt(get_post_time('Y-m-d H:i:s', true)), false); ?></pubDate>
        <?php } ?>
        <?php if ($yturbo_options['ytdateformat'] == 'mod') { ?>
        <pubDate><?php echo mysql2date('D, d M Y H:i:s '.$gmt_offset_str, get_date_from_gmt(get_post_modified_time('Y-m-d H:i:s', true)), false); ?></pubDate>
        <?php } ?>
        <?php endif; ?>
        <?php if ($ytauthorselect != 'Отключить указание автора') { ?>
        <?php if ($ytauthor && $ytauthorselect != 'Автор записи') {
            echo '<author>'.$ytauthor.'</author>'.PHP_EOL;
        } else {
            echo '<author>'.get_the_author().'</author>'.PHP_EOL;
        } } ?>
        <turbo:content><![CDATA[
        <?php
        global $post;
        $tt = $post;
        $content = yturbo_the_content_feed();
        $post = $tt;
        setup_postdata( $post );
        $content = yturbo_build_template($content);
        $post = $tt;
        setup_postdata( $post );

        if ($ytexcludetags != 'disabled' && $ytexcludetagslist) {
            $content = yturbo_strip_tags_without_content($content, $ytexcludetagslist);
        }
        if ($ytexcludetags2 != 'disabled' && $ytexcludetagslist2) {
            $content = yturbo_strip_tags_with_content($content, $ytexcludetagslist2, true);
        }

        //удаляем все атрибуты тега img кроме src
        $content = yturbo_strip_attributes($content,array('src'));

        $content = wpautop($content);

        //удаляем unicode-символы (как невалидные в rss)
        $content = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $content);

        //удаляем разметку движка при использовании шорткода с подписью [caption] (в html4 темах - classic editor)
        $pattern = "/<div id=\"attachment(.*?)>(.*?)<img (.*?) \/>(.*?)<\/p>\n<p id=\"caption-attachment(.*?)\">(.*?)<\/p>\n<\/div>/i";
        $replacement = '<img data-caption="$6" $3 />';
        $content = preg_replace($pattern, $replacement, $content);
        //разметка описания на случай, если тег <div> удаляется в настройках плагина
        $pattern = "/<p><img(.*?) \/><\/p>\n<p id=\"caption-attachment(.*?)\">(.*?)<\/p>/i";
        $replacement = '<img data-caption="$3"$1 />';
        $content = preg_replace($pattern, $replacement, $content);

        //удаляем разметку движка при использовании шорткода с подписью [caption] (в html5 темах - classic editor)
        $pattern = "/<figure id=\"attachment(.*?)\"(.*?)>(.*?)<img (.*?) \/>(.*?)<figcaption id=\"caption-attachment(.*?)\">(.*?)<\/figcaption><\/figure>/i";
        $replacement = '<img data-caption="$7" $4 />';
        $content = preg_replace($pattern, $replacement, $content);

        //удаляем <figure>, если они изначально присутствуют в контенте записи (с указанным caption - gutenberg)
        $pattern = "/<figure(.*?)>(.*?)<img src=\"(.*?)\" \/>(.*?)<figcaption>(.*?)<\/figcaption><\/figure>/i";
        $replacement = '<img data-caption="$5" src="$3" />';
        $content = preg_replace($pattern, $replacement, $content);

        //удаляем <figure>, если они изначально присутствуют в контенте записи (без caption - gutenberg)
        $pattern = "/<figure(.*?)>(.*?)<img(.*?)>(.*?)<\/figure>/i";
        $replacement = '<img$3>';
        $content = preg_replace($pattern, $replacement, $content);

        //удаляем <figure> вокруг всех элементов (яндекс такое не понимает)
        $pattern = "/<figure(.*?)>/i";
        $replacement = '';
        $content = preg_replace($pattern, $replacement, $content);
        $pattern = "/<\/figure>/i";
        $replacement = '';
        $content = preg_replace($pattern, $replacement, $content);
        $pattern = "/<figcaption>(.*?)<\/figcaption>/i";
        $replacement = '';
        $content = preg_replace($pattern, $replacement, $content);

        //преобразуем iframe с видео
        $pattern = "/<iframe title=\"(.*?)\"(.*?) allow=\"(.*?)\"(.*?)><\/iframe>/i";
        $replacement = '<iframe$2 allowfullscreen="true"></iframe>';
        $content = preg_replace($pattern, $replacement, $content);

        //удаляем <p> у отдельно стоящих изображений
        $pattern = "/<p><img(.*?)><\/p>/i";
        $replacement = '<img$1>';
        $content = preg_replace($pattern, $replacement, $content);

        //добавляем data-caption если его вообще нет в теге img
        $pattern = "/<img(?!([^>]*\b)data-caption=)([^>]*?)>/i";
        $replacement = '<img data-caption=""$1$2>';
        $content = preg_replace( $pattern, $replacement, $content );

        //обрабатываем img теги и оборачиваем их тегами figure
        if ($ytfigcaption == 'Использовать подписи') {
             //если описания нет
             $pattern = "/<img data-caption=\"\" src=\"(.*?)\" \/>/i";
             $replacement = '<figure><img src="$1" /></figure>';
             $content = preg_replace($pattern, $replacement, $content);
             //если описание есть
             $pattern = "/<img data-caption=\"(.*?)\" src=\"(.*?)\" \/>/i";
             $replacement = '<figure><img src="$2" /><figcaption>$1</figcaption></figure>';
             $content = preg_replace($pattern, $replacement, $content);
        }
        if ($ytfigcaption == 'Отключить описания') {
             $pattern = "/<img data-caption=\"(.*?)\" src=\"(.*?)\" \/>/i";
             $replacement = '<figure><img src="$2" /></figure>';
             $content = preg_replace($pattern, $replacement, $content);
        }

        $purl = plugins_url('', __FILE__);

        //формируем video для mp4 файлов согласно документации яндекса (гутенберг)
        $pattern = "/<video(.*?)src=\"(.*?).mp4\"><\/video>/i";
        $replacement = '<figure><video><source src="$2.mp4" type="video/mp4" /></video><img src="'.$purl.'/img/video.png'.'" /></figure>';
        $content = preg_replace($pattern, $replacement, $content);

        //формируем video для mp4 файлов согласно документации яндекса (классический редактор)
        $content = str_replace('<!--[if lt IE 9]><script>document.createElement(\'video\');</script><![endif]-->', '', $content);
        $pattern = "/<video class=\"wp-video-shortcode\"(.*?)><source(.*?)src=\"(.*?).mp4(.*?)\"(.*?)\/>(.*?)<\/video>/i";
        $replacement = '<figure><video><source src="$3.mp4" type="video/mp4" /></video><img src="'.$purl.'/img/video.png'.'" /></figure>';
        $content = preg_replace($pattern, $replacement, $content);

        //формируем audio для mp3 файлов (гутенберг)
        $pattern = "/<audio(.*?)src=\"(.*?).mp3\"><\/audio>/i";
        $replacement = '<div data-block="audio" src="$2.mp3"></div>';
        $content = preg_replace($pattern, $replacement, $content);

        //формируем audio для mp3 файлов (классический редактор)
        $content = str_replace('<!--[if lt IE 9]><script>document.createElement(\'audio\');</script><![endif]-->', '', $content);
        $pattern = "/<audio class=\"wp-audio-shortcode\"(.*?)><source(.*?)src=\"(.*?).mp3(.*?)\"(.*?)\/>(.*?)<\/audio>/i";
        $replacement = '<div data-block="audio" src="$3.mp3"></div>';
        $content = preg_replace($pattern, $replacement, $content);

        //удаляем картинки из контента, если их больше 50 уникальных (ограничение яндекс.турбо)
        if (preg_match_all("/<figure><img(.*?)>(.*?)<\/figure>/i", $content, $res)) {
            $i = 0;
            if ($ytrelated=='enabled' && $ytrelatednumber && $ytrelatedinfinity != 'enabled') $i = $ytrelatednumber;
            if ($ytthumbnail=='enabled' && has_post_thumbnail(get_the_ID())) $i++;
            $final = array();
            foreach ($res[0] as $r) {
                if (! in_array($r, $final)) {$i++;}
                if ($i > 50 && ! in_array($r, $final)) {
                    $content = str_replace($r, '', $content);
                }
                if (! in_array($r, $final)) {$final[] = $r;}
            }
        }

        if ($ytexcludecontent != 'disabled' && $ytexcludecontentlist) {
            $textAr = explode("\n", str_replace(array("\r\n", "\r"), "\n", $ytexcludecontentlist));
            foreach ($textAr as $line) {
                $line = stripcslashes($line);
                $content = str_replace($line, '', $content);
            }
        }

        //преобразовываем галереи в турбо-галереи
        add_shortcode('gallery', 'gallery_shortcode');
        add_filter( 'post_gallery', 'yturbo_gallery', 10, 2 );
        $content = do_shortcode($content);
        $content = yturbo_do_gallery($content);

        $ytad4meta = get_post_meta($post->ID, 'ytad4meta', true);
        $ytad5meta = get_post_meta($post->ID, 'ytad5meta', true);

        $content = apply_filters( 'yturbo_add_contents', $content );
        ?>
        <header>
            <?php if ( $ytthumbnail=='enabled' && has_post_thumbnail(get_the_ID()) ) {
                echo '<figure><img src="'. strtok(get_the_post_thumbnail_url(get_the_ID(),$ytselectthumb), '?') .'" /></figure>'.PHP_EOL; ?>
            <?php } ?>
            <h1><?php echo get_the_title_rss(); ?></h1>
            <?php if ($ytselectmenu!='Не использовать') {
            echo '<menu>'.PHP_EOL;
                    $menu = wp_get_nav_menu_object( $ytselectmenu );
                    $menu_items = wp_get_nav_menu_items($menu->term_id);

                    foreach ( (array) $menu_items as $key => $menu_item ) {
                        $title = $menu_item->title;
                        $url = $menu_item->url;
                        echo '<a href="' . $url . '">' . $title . '</a>'.PHP_EOL;
                    }

            echo '</menu>'.PHP_EOL;} ?>
        </header>
        <?php if ($ytrating == 'enabled') {
            $temprating = mt_rand ($ytratingmin*100, $ytratingmax*100) / 100;
            echo '
            <div itemscope itemtype="http://schema.org/Rating">
                <meta itemprop="ratingValue" content="'.$temprating.'">
                <meta itemprop="bestRating" content="5">
            </div>
            ';
        } ?>
        <?php if ($yturbo_options['ytsearch'] != 'disabled' &&  $yturbo_options['ytsearchmesto'] == 'В начале записи') {echo yturbo_search_widget();} ?>
        <?php if ($yturbo_options['ytfeedback'] != 'disabled' && $yturbo_options['ytfeedbackselect'] == 'false' && $yturbo_options['ytfeedbackselectmesto'] == 'В начале записи') {echo yturbo_widget_feedback();} ?>
        <?php
        $content = apply_filters('yturbo_before_ads', $content);
        $temp = apply_filters('yturbo_add_custom_ads', $content);
        if ( $temp != $content ) {
            echo $temp;
        } else {
            echo yturbo_add_advert($content);
        }
        ?>
        <?php if ($yturbo_options['ytshare'] == 'enabled') {
            echo PHP_EOL.'<div data-block="share" data-network="'.$yturbo_options['ytnetw'].'"></div>';
            if ($ytad4 == 'enabled' && $ytad4meta != 'disabled') { echo PHP_EOL.'<figure data-turbo-ad-id="fourth_ad_place"></figure>'.PHP_EOL; }
            do_action( 'yturbo_after_share' );
        } ?>
        <?php if ($yturbo_options['ytfeedback'] != 'disabled' && $yturbo_options['ytfeedbackselect'] == 'false' && $yturbo_options['ytfeedbackselectmesto'] == 'В конце записи') {echo yturbo_widget_feedback();} ?>
        <?php if ($yturbo_options['ytfeedback'] != 'disabled' && $yturbo_options['ytfeedbackselect'] != 'false') {echo yturbo_widget_feedback();} ?>
        <?php if ($yturbo_options['ytsearch'] != 'disabled' &&  $yturbo_options['ytsearchmesto'] == 'В конце записи') {echo yturbo_search_widget();} ?>
        <?php if ($ytcomments == 'enabled') {
           $comments = get_comments(array(
            'post_id' => get_the_ID(),
            'status' => 'approve',
        ));
        if ($comments) {echo PHP_EOL.'<div data-block="comments" data-url="'.get_permalink().'#respond">';}
        wp_list_comments(array(
            'type' => 'comment',
            'per_page' => $ytcommentsnumber,
            'callback' => 'yturbo_comments',
            'end-callback' => 'yturbo_comments_end',
            'title_li' => null,
            'max_depth' => $ytcommentsdrevo,
            'reverse_top_level' => $reverse_top_level,
            'reverse_children' => $reverse_children,
            'style' => 'div',
        ), $comments);
        if ($comments) {echo '</div>';}
        if ($comments && $ytad5 == 'enabled' && $ytad5meta != 'disabled') { echo PHP_EOL.'<figure data-turbo-ad-id="fifth_ad_place"></figure>'.PHP_EOL; }
        do_action( 'yturbo_after_comments' );
       } ?>
        ]]></turbo:content>
        <?php
        if ( $ytrelated=='enabled' ) {

            $tempID = get_the_ID();
            $rcontent = '';

            if ($ytrelatedcache == 'enabled') {$rcontent = get_transient('related-' . $tempID);}

            if(!$rcontent) {
                $cats = array();
                $childonly = array();
                foreach (get_the_category(get_the_ID()) as $cat) {
                    array_push($cats, $cat->cat_ID);
                    if ($cat->category_parent !== 0 ) {
                        array_push($childonly, $cat->cat_ID);
                    }
                }
                if ($childonly) $cats = $childonly;
                $cur_post_id = array();
                array_push($cur_post_id, get_the_ID());

                $args = array('post__not_in' => $cur_post_id, 'cat' => $cats,'orderby' => 'rand','date_query' => array('after' => $ytrelateddate . ' month ago',),'ignore_sticky_posts' => 1, 'post_type' => $yttype, 'post_status' => 'publish', 'posts_per_page' => $ytrelatednumber,'tax_query' => $tax_query,'meta_query' => array('relation' => 'OR', array('key' => 'ytrssenabled_meta_value', 'compare' => 'NOT EXISTS',),array('key' => 'ytrssenabled_meta_value', 'value' => 'yes', 'compare' => '!=',),));
                $related = new WP_Query( $args );

                if (!$related->have_posts()) {
                    $args = array('post__not_in' => $cur_post_id, 'orderby' => 'rand','date_query' => array('after' => $ytrelateddate . ' month ago',),'ignore_sticky_posts' => 1, 'post_type' => $yttype, 'post_status' => 'publish', 'posts_per_page' => $ytrelatednumber,'tax_query' => $tax_query,'meta_query' => array('relation' => 'OR', array('key' => 'ytrssenabled_meta_value', 'compare' => 'NOT EXISTS',),array('key' => 'ytrssenabled_meta_value', 'value' => 'yes', 'compare' => '!=',),));
                    $related = new WP_Query( $args );
                }

                if ($related->have_posts()) {
                    if ( $ytrelatedinfinity == 'disabled') {
                        $rcontent .= '<yandex:related>'.PHP_EOL;
                    } else {
                        $rcontent .= '<yandex:related type="infinity">'.PHP_EOL;
                    }
                }
                while ($related->have_posts()) : $related->the_post();
                    $ytremove = get_post_meta(get_the_ID(), 'ytremove_meta_value', true);
                    if ( $ytremove == 'yes' ) continue;
                    $thumburl = '';
                    if ($ytrelatedselectthumb != "Не использовать" && has_post_thumbnail(get_the_ID()) && $ytrelatedinfinity != "enabled") {
                        $thumburl = ' img="' . strtok(get_the_post_thumbnail_url(get_the_ID(),$ytrelatedselectthumb), '?') . '"';
                    }
                    $rlink = htmlspecialchars(get_the_permalink());
                    $rtitle = get_the_title_rss();
                    if ($ytrelatedselectthumb != "Не использовать" && $ytrelatedinfinity != "enabled") {
                        $rcontent .=  '<link url="'.$rlink.'"'.$thumburl.'>'.$rtitle.'</link>'.PHP_EOL;
                    } else {
                        $rcontent .=  '<link url="'.$rlink.'">'.$rtitle.'</link>'.PHP_EOL;
                    }

                endwhile;
                if ($related->have_posts()) {$rcontent .=  '</yandex:related>'.PHP_EOL;}
                if ($related->have_posts()) {echo $rcontent;}
                wp_reset_query($related);

                if ($ytrelatedcache == 'enabled') {set_transient('related-' . $tempID, $rcontent, $ytrelatedcachetime * HOUR_IN_SECONDS);}
            } else {
                echo $rcontent;
            }
        } ?>
    </item>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
<?php wp_reset_query(); ?>
</channel>
</rss>
<?php }
//шаблон для RSS-ленты Яндекс.Турбо end

//установка правильного content type для ленты плагина begin
function yturbo_feed_content_type( $content_type, $type ) {
    $yturbo_options = get_option('yturbo_options');
    if ( $yturbo_options['ytrssname'] == $type ) {
        $content_type = 'application/rss+xml';
    }
    return $content_type;
}
add_filter( 'feed_content_type', 'yturbo_feed_content_type', 10, 2 );
//установка правильного content type для ленты плагина end

//функция формирования content в rss begin
function yturbo_the_content_feed() {
    $yturbo_options = get_option('yturbo_options');
    remove_shortcode('gallery');
    if ($yturbo_options['ytexcerpt'] == 'enabled') {
        $content = '';
        if ( has_excerpt( get_the_ID() ) ) {
            $content = '<p>' . get_the_excerpt( get_the_ID() ) . '</p>';
        }
        $content .= apply_filters('the_content', yturbo_strip_shortcodes(get_post_field('post_content', get_the_ID())));
    } else {
        $content = apply_filters('the_content', yturbo_strip_shortcodes(get_post_field('post_content', get_the_ID())));
    }
    $content = apply_filters('yturbo_the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = apply_filters('wp_staticize_emoji', $content);
    $content = apply_filters('_oembed_filter_feed_content', $content);
    return $content;
}
//функция формирования content в rss end

//функция удаления тегов вместе с их контентом begin 
function yturbo_strip_tags_with_content( $text, $tags = '', $invert = FALSE ) {

    // удаляем лишние символы, добавляем тегам символы <> begin
    $tags = preg_replace('/[^A-Za-z0-9,]/', '', $tags);
    $a = explode(",", $tags );
    $a = array_diff($a, array(''));
    array_walk($a, function(&$value, $key) { $value = '<'. $value . '>'; } );
    $tags = implode(",", $a );
    // удаляем лишние символы, добавляем тегам символы <> end

    preg_match_all( '/<(.+?)[\s]*\/?[\s]*>/si', trim( $tags ), $tags_array );
    $tags_array = array_unique( $tags_array[1] );

    $regex = '';

    if ( count( $tags_array ) > 0 ) {
        if ( ! $invert ) {
            $regex = '@<(?!(?:' . implode( '|', $tags_array ) . ')\b)(\w+)\b[^>]*?(>((?!<\1\b).)*?<\/\1|\/)>@si';
            $text  = preg_replace( $regex, '', $text );
        } else {
            $regex = '@<(' . implode( '|', $tags_array ) . ')\b[^>]*?(>((?!<\1\b).)*?<\/\1|\/)>@si';
            $text  = preg_replace( $regex, '', $text );
        }
    } elseif ( ! $invert ) {
        $regex = '@<(\w+)\b[^>]*?(>((?!<\1\b).)*?<\/\1|\/)>@si';
        $text  = preg_replace( $regex, '', $text );
    }

    if ( $regex && preg_match( $regex, $text ) ) {
        $text = yturbo_strip_tags_with_content( $text, $tags, $invert );
    }

    return $text;
}
//функция удаления тегов вместе с их контентом end

//функция удаления тегов без их контента begin 
function yturbo_strip_tags_without_content( $text, $tags = '' ) {

    // удаляем лишние символы, добавляем тегам символы <> begin
    $tags = preg_replace('/[^A-Za-z0-9,]/', '', $tags);
    $a = explode(",", $tags );
    $a = array_diff($a, array(''));
    array_walk($a, function(&$value, $key) { $value = '<'. $value . '>'; } );
    $tags = implode(",", $a );
    // удаляем лишние символы, добавляем тегам символы <> end

    preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags);
    $tags = array_unique($tags[1]);

    if(is_array($tags) AND count($tags) > 0) {
        foreach($tags as $tag)  {
            $text = preg_replace("/<\\/?" . $tag . "(.|\\s)*?>/", '', $text);
        }
    }
    return $text;
}
//функция удаления тегов без их контента end

//функция принудительной установки header-тега X-Robots-Tag (решение проблемы с SEO-плагинами) begin
function yturbo_index_follow_rss() {
    $yturbo_options = get_option('yturbo_options');
    if ( is_feed($yturbo_options['ytrssname']) ) {
        header( 'X-Robots-Tag: index, follow', true );
        header( 'HTTP/1.1 200 OK', true );
    }
}
add_action( 'template_redirect', 'yturbo_index_follow_rss', 999999 );
//функция принудительной установки header-тега X-Robots-Tag (решение проблемы с SEO-плагинами) end

//функция подсчета количества rss-лент и их вывод на странице настроек плагина begin
function yturbo_count_feeds() {
$yturbo_options = get_option('yturbo_options');

$ytnumber = $yturbo_options['ytnumber'];
$ytrazb = $yturbo_options['ytrazb'];
$ytrazbnumber = $yturbo_options['ytrazbnumber'];
$yttype = $yturbo_options['yttype'];
$yttype = explode(",", $yttype);
$yttype = array_diff($yttype, array(''));

$tax_query = array();

$ytqueryselect = $yturbo_options['ytqueryselect'];
$yttaxlist = $yturbo_options['yttaxlist'];
$ytaddtaxlist = $yturbo_options['ytaddtaxlist'];

if ($ytqueryselect=='Все таксономии, кроме исключенных' && $yttaxlist) {
    $textAr = explode("\n", trim($yttaxlist));
    $textAr = array_filter($textAr, 'trim');
    $tax_query = array( 'relation' => 'AND' );
    foreach ($textAr as $line) {
        $tax = explode(":", $line);
        $taxterm = explode(",", $tax[1]);
        $tax_query[] = array(
            'taxonomy' => $tax[0],
            'field'    => 'id',
            'terms'    => $taxterm,
            'operator' => 'NOT IN',
        );
    }
}
if (!$ytaddtaxlist) {$ytaddtaxlist = 'category:10000000';}
if ($ytqueryselect=='Только указанные таксономии' && $ytaddtaxlist) {
    $textAr = explode("\n", trim($ytaddtaxlist));
    $textAr = array_filter($textAr, 'trim');
    $tax_query = array( 'relation' => 'OR' );
    foreach ($textAr as $line) {
        $tax = explode(":", $line);
        $taxterm = explode(",", $tax[1]);
        $tax_query[] = array(
            'taxonomy' => $tax[0],
            'field'    => 'id',
            'terms'    => $taxterm,
            'operator' => 'IN',
        );
    }
}

if ($ytnumber > 500) :
if ($ytrazb == 'enabled') {
$paged = 2;
echo '<p>Вы установили слишком большое общее количество записей в RSS (больше 500 записей), <br />
поэтому чтобы не нагружать базу данных фактическая проверка наличия записей в разбитых <br />
RSS-лентах не осуществлялась. Проверяйте наличие записей самостоятельно (пустые <br />
RSS-ленты сервис Яндекс.Вебмастер откажется принимать и выдаст ошибку).</p>
<p>Всего у вас ' . yturbo_russian_number(ceil($ytnumber / $ytrazbnumber), array(' RSS-лента', ' RSS-ленты', ' RSS-лент')) . ' (максимально по '.yturbo_russian_number($ytrazbnumber, array(' запись', ' записи', ' записей')). ' в каждой):</p>';
echo '<ul style="margin-bottom: 25px;">';
if ( get_option('permalink_structure') ) {
    echo '<li>1. <a target="_blank" href="'.get_bloginfo("url").'/feed/'.$yturbo_options['ytrssname'].'/">'.get_bloginfo("url").'/feed/'.$yturbo_options['ytrssname'].'/</a></li>';
} else {
    echo '<li>1. <a target="_blank" href="'.get_bloginfo("url").'/?feed='.$yturbo_options['ytrssname'].'">'.get_bloginfo("url").'/?feed='.$yturbo_options['ytrssname'].'</a></li>';
}
while ($paged <= ceil($ytnumber / $ytrazbnumber) ) {

    if ( get_option('permalink_structure') ) {
        echo '<li>'.$paged.'. <a target="_blank" href="'.get_bloginfo("url").'/feed/'.$yturbo_options['ytrssname'].'/?paged='.$paged.'">'.get_bloginfo("url").'/feed/'.$yturbo_options['ytrssname'].'/?paged='.$paged.'</a></li>';
    } else {
        echo '<li>'.$paged.'. <a target="_blank" href="'.get_bloginfo("url").'/?feed='.$yturbo_options['ytrssname'].'&paged='.$x.'">'.get_bloginfo("url").'/?feed='.$yturbo_options['ytrssname'].'&paged='.$paged.'</a></li>';
    }
    $paged++;

    if ($paged == 10 && (ceil($ytnumber / $ytrazbnumber))>10) {
        echo '<li>....</li>';
        echo '<li>Слишком много RSS-лент, остальные ленты были скрыты (<span id="showlistrss">показать</span>).</li>';
        echo '<div id="allrss" style="display:none;">';
    }
}
if ($paged >= 10 && (ceil($ytnumber / $ytrazbnumber))>10) {
    echo '</div>';
}
echo '</ul>';
} else {
    echo '<p>Всего у вас 1 RSS-лента ' . ' (в ней максимально может быть '.yturbo_russian_number($ytnumber, array(' запись', ' записи', ' записей')). '):</p>';   
    echo '<ul style="margin-bottom: 25px;">';
    if ( get_option('permalink_structure') ) {
        echo '<li>1. <a target="_blank" href="'.get_bloginfo("url").'/feed/'.$yturbo_options['ytrssname'].'/">'.get_bloginfo("url").'/feed/'.$yturbo_options['ytrssname'].'/</a></li>';
    } else {
        echo '<li>1. <a target="_blank" href="'.get_bloginfo("url").'/?feed='.$yturbo_options['ytrssname'].'">'.get_bloginfo("url").'/?feed='.$yturbo_options['ytrssname'].'</a></li>'; 
    }
    echo '</ul>';
}
else :

if($yttype[0]==''){$yttype[0]='trulala';}//если в настройках не выбраны типы записей, то отключаем дефолтный post_type равный 'post'
$args = array('ignore_sticky_posts' => 1, 'post_type' => $yttype, 'post_status' => 'publish', 'posts_per_page' => $ytnumber,'tax_query' => $tax_query,
'meta_query' => array('relation' => 'OR', array('key' => 'ytrssenabled_meta_value', 'compare' => 'NOT EXISTS',),
array('key' => 'ytrssenabled_meta_value', 'value' => 'yes', 'compare' => '!=',),));
$query = new WP_Query( $args );

if ($query->post_count < $ytnumber) $ytnumber = $query->post_count;

if ($ytrazb == 'enabled' && (ceil($query->post_count / $ytrazbnumber) > 1)) {
    echo '<p>Согласно настройкам плагина в RSS попадут ' . yturbo_russian_number($query->post_count, array(' запись', ' записи', ' записей')) . ' (максимально: '.$yturbo_options['ytnumber'].').<br/>';
    echo 'Эти ' . yturbo_russian_number($query->post_count, array(' запись', ' записи', ' записей')) . ' распределены по ' . yturbo_russian_number(ceil($query->post_count / $ytrazbnumber), array(' RSS-ленте', ' RSS-лентам', ' RSS-лентам')) . ' (разбитие по '. yturbo_russian_number($ytrazbnumber, array(' записи', ' записям', ' записям')) .'):</p>';
} else {
    echo '<p>Всего у вас 1 RSS-лента '. ' (в ней '.yturbo_russian_number($ytnumber, array(' запись', ' записи', ' записей')). '):</p>';
}

echo '<ul style="margin-bottom: 20px;">';
if ( get_option('permalink_structure') ) {
    echo '<li>1. <a target="_blank" href="'.get_bloginfo("url").'/feed/'.$yturbo_options['ytrssname'].'/">'.get_bloginfo("url").'/feed/'.$yturbo_options['ytrssname'].'/</a></li>';
} else {
    echo '<li>1. <a target="_blank" href="'.get_bloginfo("url").'/?feed='.$yturbo_options['ytrssname'].'">'.get_bloginfo("url").'/?feed='.$yturbo_options['ytrssname'].'</a></li>'; 
}

if ($ytrazb == 'enabled' && (ceil($query->post_count / $ytrazbnumber) > 1)) {
    for ($x=1; $x++<ceil($query->post_count / $ytrazbnumber);) {
        if ( get_option('permalink_structure') ) {
            echo '<li>'.$x.'. <a target="_blank" href="'.get_bloginfo("url").'/feed/'.$yturbo_options['ytrssname'].'/?paged='.$x.'">'.get_bloginfo("url").'/feed/'.$yturbo_options['ytrssname'].'/?paged='.$x.'</a></li>';
        } else {
            echo '<li>'.$x.'. <a target="_blank" href="'.get_bloginfo("url").'/?feed='.$yturbo_options['ytrssname'].'&paged='.$x.'">'.get_bloginfo("url").'/?feed='.$yturbo_options['ytrssname'].'&paged='.$x.'</a></li>'; 
        }
        if ($x == 9 && (ceil($query->post_count / $ytrazbnumber))>9) {
            echo '<li>....</li>';
            echo '<li>Слишком много RSS-лент, остальные ленты были скрыты (<span id="showlistrss">показать</span>).</li>';
            echo '<div id="allrss" style="display:none;">';
        }
    }
    if (ceil($query->post_count / $ytrazbnumber)>9) {
        echo '</div>';
    }
}

echo '</ul>';

endif;
}
//функция подсчета количества rss-лент и их вывод на странице настроек плагина end

//функция склонения слов после числа begin
function yturbo_russian_number( $number, $titles ) {
    $cases = array (2, 0, 1, 1, 1, 2);
    return $number . ' ' . $titles[ ($number%100 > 4 && $number %100 < 20) ? 2 : $cases[min($number%10, 5)] ];
}
//функция склонения слов после числа end

//функция добавления рекламы в запись begin
function yturbo_add_advert( $content ) {

    $yturbo_options = get_option('yturbo_options');
    $ytrazmer = $yturbo_options['ytrazmer'];
    $ytad1 = $yturbo_options['ytad1'];
    $ytad2 = $yturbo_options['ytad2'];
    $ytad3 = $yturbo_options['ytad3'];

    $tempcontent = $content;
    $tempcontent = strip_tags($tempcontent);
    $tempcontent = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $tempcontent);

    $num = ceil(mb_strlen($tempcontent) / 2);

    global $post;
    $ytad1meta = get_post_meta($post->ID, 'ytad1meta', true);
    $ytad2meta = get_post_meta($post->ID, 'ytad2meta', true);
    $ytad3meta = get_post_meta($post->ID, 'ytad3meta', true);

    if ($ytad2 != 'enabled' or $ytad2meta == 'disabled') {$ads ='';}

    if ($ytad2 == 'enabled' && $ytad2meta != 'disabled') {
        $ads = PHP_EOL.'<figure data-turbo-ad-id="second_ad_place"></figure>';
    }

    if (mb_strlen($tempcontent) > (int)$ytrazmer && mb_strlen($tempcontent) < 65000) {
        $content = preg_replace('~[^^]{'. $num .'}.*?(?:\r?\n\r?\n|</p>|</figure>|</ul>|</pre>|</table>|</ol>|</blockquote>)~su', "\${0}$ads", trim( $content ), 1);
    }

    if ($ytad1 == 'enabled' && $ytad1meta != 'disabled') { $content = '<figure data-turbo-ad-id="first_ad_place"></figure>'.PHP_EOL . $content;}
    if ($ytad3 == 'enabled' && $ytad3meta != 'disabled') { $content = PHP_EOL . $content . PHP_EOL.'<figure data-turbo-ad-id="third_ad_place"></figure>';}

    return $content;
}
//функция добавления рекламы в запись end

//функция удаления всех атрибутов тега img кроме указанных begin
function yturbo_strip_attributes( $s, $allowedattr = array() ) {

    if (preg_match_all("/<img[^>]*\\s([^>]*)\\/*>/msiU", $s, $res, PREG_SET_ORDER)) {
        foreach ($res as $r) {
            $tag = $r[0];
            $attrs = array();
            preg_match_all("/\\s.*=(['\"]).*\\1/msiU", " " . $r[1], $split, PREG_SET_ORDER);
                foreach ($split as $spl) {
                    $attrs[] = $spl[0];
                }
            $newattrs = array();
            foreach ($attrs as $a) {
                $tmp = explode("=", $a);
                if (trim($a) != "" && (!isset($tmp[1]) || (trim($tmp[0]) != "" && !in_array(strtolower(trim($tmp[0])), $allowedattr)))) {

                } else {
                    $newattrs[] = $a;
                }
            }

            //сортировка чтобы alt был раньше src
            sort($newattrs);
            reset($newattrs);

            $attrs = implode(" ", $newattrs);
            $rpl = str_replace($r[1], $attrs, $tag);
            //заменяем одинарные кавычки на двойные
            $rpl = str_replace("'", "\"", $rpl);
            //добавляем закрывающий символ / если он отсутствует
            $rpl = str_replace("\">", "\" />", $rpl);
            //добавляем пробел перед закрывающим символом /
            $rpl = str_replace("\"/>", "\" />", $rpl);
            //удаляем двойные пробелы
            $rpl = str_replace("  ", " ", $rpl);

            $s = str_replace($tag, $rpl, $s);
        }
    }

    return $s;
}
//функция удаления всех атрибутов тега img кроме указанных end

//функция удаления транзитного кэша для похожих записей begin
function yturbo_clear_transients() {
    global $wpdb;

    $sql = "
            DELETE 
            FROM {$wpdb->options}
            WHERE option_name like '\_transient\_related-%'
            OR option_name like '\_transient\_timeout\_related-%'
    ";

    $wpdb->query($sql);
}
//функция удаления транзитного кэша для похожих записей end

//функция преобразования стандартных галерей движка в турбо-галереи begin
function yturbo_gallery( $output, $attr ) {

    $yturbo_options = get_option('yturbo_options');
    if ( ! is_feed($yturbo_options['ytrssname']) ) {return;}

    $post = get_post();

    static $instance = 0;
    $instance++;

    if ( ! empty( $attr['ids'] ) ) {
        // 'ids' is explicitly ordered, unless you specify otherwise.
        if ( empty( $attr['orderby'] ) ) {
            $attr['orderby'] = 'post__in';
        }
        $attr['include'] = $attr['ids'];
    }

    $html5 = current_theme_supports( 'html5', 'gallery' );
    $atts = shortcode_atts( array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post ? $post->ID : 0,
        'itemtag'    => $html5 ? 'figure'     : 'dl',
        'icontag'    => $html5 ? 'div'        : 'dt',
        'captiontag' => $html5 ? 'figcaption' : 'dd',
        'columns'    => 3,
        'size'       => 'thumbnail',
        'include'    => '',
        'exclude'    => '',
        'link'       => ''
    ), $attr, 'gallery' );

    $id = intval( $atts['id'] );

    $atts['include'] = str_replace(array("&#187;","&#8243;"), "", $atts['include']);
    $atts['orderby'] = str_replace(array("&#187;","&#8243;"), "", $atts['orderby']);
    $atts['order'] = str_replace(array("&#187;","&#8243;"), "", $atts['order']);
    $atts['exclude'] = str_replace(array("&#187;","&#8243;"), "", $atts['exclude']);

    if ( ! empty( $atts['include'] ) ) {
        $_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }

    } elseif ( ! empty( $atts['exclude'] ) ) {
        $attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
    } else {
        $attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
    }

    if ( empty( $attachments ) ) {
        return '';
    }

    $output = PHP_EOL.'<div data-block="gallery">'.PHP_EOL;

        foreach ( $attachments as $id => $attachment ) {
            $output .= '<img src="'.wp_get_attachment_url($id) . '"/>'.PHP_EOL;
        }
       $output .= '</div>'.PHP_EOL;

    return $output;
}
//функция преобразования стандартных галерей движка в турбо-галереи end

//функция преобразования стандартных галерей движка в турбо-галереи в гутенберге begin
function yturbo_do_gallery( $content ) {

    //удаляем ul разметку галерей в гутенберге (wordpress 5.3+)
    $pattern = "/<ul class=\"blocks-gallery-grid(.*?)>(.*?)<\/ul>/s";
    $replacement = '<div data-block="gallery">$2</div>';
    $content = preg_replace($pattern, $replacement, $content);

    //удаляем ul разметку галерей в гутенберге (wordpress 5.2+)
    $pattern = "/<ul class=\"wp-block-gallery(.*?)>(.*?)<\/ul>/s";
    $replacement = '<div data-block="gallery">$2</div>';
    $content = preg_replace($pattern, $replacement, $content);

    //удаляем li разметку галерей в гутенберге
    $pattern = "/<li class=\"blocks-gallery-item\">\n<figure><img src=\"(.*?)\" \/>(.*?)<\/figure>\n<\/li>/i";
    $replacement = '<img src="$1"/>';
    $content = preg_replace($pattern, $replacement, $content);

    return $content;
}
//функция преобразования стандартных галерей движка в турбо-галереи в гутенберге end

//функции открытия и закрытия комментариев begin
function yturbo_comments( $comment, $args, $depth ) {
    $yturbo_options = get_option('yturbo_options');
    $ytcommentsdate = $yturbo_options['ytcommentsdate'];
    $ytcommentsdrevo = $yturbo_options['ytcommentsdrevo'];
    $ytcommentsavatar = $yturbo_options['ytcommentsavatar'];
    echo PHP_EOL;
    ?>
    <div data-block="comment"
         data-author="<?php comment_author(); ?>" 
         <?php if ($ytcommentsavatar=='enabled') { ?>
         data-avatar-url="<?php echo esc_url( get_avatar_url( $comment, 100 ) ); ?>" 
         <?php } ?>
         <?php if ($ytcommentsdate=='enabled') { ?>
         data-subtitle="<?php echo get_comment_date(); ?> в <?php echo get_comment_time(); ?>"
         <?php } ?>
    >
        <div data-block="content">
        <?php comment_text(); ?>
        </div>
        <?php if ($args['has_children'] && $ytcommentsdrevo=='enabled') { ?><?php echo '<div data-block="comments">'; ?><?php }
}

function yturbo_comments_end( $comment, $args, $depth ) {
$yturbo_options = get_option('yturbo_options');
$ytcommentsdrevo = $yturbo_options['ytcommentsdrevo'];
?>
    </div>
    <?php if ($depth==1 && $ytcommentsdrevo=='enabled') { ?><?php echo '</div>'; ?><?php } ?>
<?php }
//функции открытия и закрытия комментариев end

//функция формирования объявлений рекламной сети begin
function yturbo_turbo_ads() {
    $yturbo_options = get_option('yturbo_options');

    $ytcomments = $yturbo_options['ytcomments'];
    $ytshare = $yturbo_options['ytshare'];

    $ytad1 = $yturbo_options['ytad1'];
    $ytad1set = $yturbo_options['ytad1set'];
    $ytad1rsa = $yturbo_options['ytad1rsa'];
    $ytadfox1 = html_entity_decode(stripcslashes($yturbo_options['ytadfox1']),ENT_QUOTES);
    $ytad2 = $yturbo_options['ytad2'];
    $ytad2set = $yturbo_options['ytad2set'];
    $ytad2rsa = $yturbo_options['ytad2rsa'];
    $ytadfox2 = html_entity_decode(stripcslashes($yturbo_options['ytadfox2']),ENT_QUOTES);
    $ytad3 = $yturbo_options['ytad3'];
    $ytad3set = $yturbo_options['ytad3set'];
    $ytad3rsa = $yturbo_options['ytad3rsa'];
    $ytadfox3 = html_entity_decode(stripcslashes($yturbo_options['ytadfox3']),ENT_QUOTES);
    $ytad4 = $yturbo_options['ytad4'];
    $ytad4set = $yturbo_options['ytad4set'];
    $ytad4rsa = $yturbo_options['ytad4rsa'];
    $ytadfox4 = html_entity_decode(stripcslashes($yturbo_options['ytadfox4']),ENT_QUOTES);
    $ytad5 = $yturbo_options['ytad5'];
    $ytad5set = $yturbo_options['ytad5set'];
    $ytad5rsa = $yturbo_options['ytad5rsa'];
    $ytadfox5 = html_entity_decode(stripcslashes($yturbo_options['ytadfox5']),ENT_QUOTES);

    $yturboads = '';
    if ($ytad1 == 'enabled') {
        if ($ytad1set == 'РСЯ') {
            $yturboads .= '<turbo:adNetwork type="Yandex" id="'.$ytad1rsa.'" turbo-ad-id="first_ad_place"></turbo:adNetwork>'.PHP_EOL;
        }
        if ($ytad1set == 'ADFOX') {
            $yturboads .= '<turbo:adNetwork type="AdFox" turbo-ad-id="first_ad_place">
                <![CDATA[
                    '.$ytadfox1.'
                ]]>
            </turbo:adNetwork>'.PHP_EOL;
        }
    }
    if ($ytad2 == 'enabled') {
        if ($ytad2set == 'РСЯ') {
            $yturboads .= '<turbo:adNetwork type="Yandex" id="'.$ytad2rsa.'" turbo-ad-id="second_ad_place"></turbo:adNetwork>'.PHP_EOL;
        }
        if ($ytad2set == 'ADFOX') {
            $yturboads .= '<turbo:adNetwork type="AdFox" turbo-ad-id="second_ad_place">
                <![CDATA[
                    '.$ytadfox2.'
                ]]>
            </turbo:adNetwork>'.PHP_EOL;
        }
    }
    if ($ytad3 == 'enabled') {
        if ($ytad3set == 'РСЯ') {
            $yturboads .= '<turbo:adNetwork type="Yandex" id="'.$ytad3rsa.'" turbo-ad-id="third_ad_place"></turbo:adNetwork>'.PHP_EOL;
        }
        if ($ytad3set == 'ADFOX') {
            $yturboads .= '<turbo:adNetwork type="AdFox" turbo-ad-id="third_ad_place">
                <![CDATA[
                    '.$ytadfox3.'
                ]]>
            </turbo:adNetwork>'.PHP_EOL;
        }
    }
    if ($ytad4 == 'enabled' && $ytshare == 'enabled') {
        if ($ytad4set == 'РСЯ') {
            $yturboads .= '<turbo:adNetwork type="Yandex" id="'.$ytad4rsa.'" turbo-ad-id="fourth_ad_place"></turbo:adNetwork>'.PHP_EOL;
        }
        if ($ytad4set == 'ADFOX') {
            $yturboads .= '<turbo:adNetwork type="AdFox" turbo-ad-id="fourth_ad_place">
                <![CDATA[
                    '.$ytadfox4.'
                ]]>
            </turbo:adNetwork>'.PHP_EOL;
        }
    }
    if ($ytad5 == 'enabled' && $ytcomments == 'enabled') {
        if ($ytad5set == 'РСЯ') {
            $yturboads .= '<turbo:adNetwork type="Yandex" id="'.$ytad5rsa.'" turbo-ad-id="fifth_ad_place"></turbo:adNetwork>'.PHP_EOL;
        }
        if ($ytad5set == 'ADFOX') {
            $yturboads .= '<turbo:adNetwork type="AdFox" turbo-ad-id="fifth_ad_place">
                <![CDATA[
                    '.$ytadfox5.'
                ]]>
            </turbo:adNetwork>'.PHP_EOL;
        }
    }

    return $yturboads;
}
//функция формирования объявлений рекламной сети end

//функция вывода виджета обратной связи begin
function yturbo_widget_feedback() {
    $yturbo_options = get_option('yturbo_options');

    if ($yturbo_options['ytfeedback'] == 'disabled')
        return;

    $content = PHP_EOL.PHP_EOL.'<div data-block="widget-feedback" data-title="'.$yturbo_options['ytfeedbacktitle'].'" data-stick="'.$yturbo_options['ytfeedbackselect'].'">'.PHP_EOL;

    $ytfeedbacknetw = explode(",", $yturbo_options['ytfeedbacknetw']);
    $ytfeedbacknetw = array_diff($ytfeedbacknetw, array(''));

    foreach ($ytfeedbacknetw as $network) {
        switch ($network) {
        case 'call':
            if ($yturbo_options['ytfeedbackcall']) {
                $content .= '<div data-type="call" data-url="'.$yturbo_options['ytfeedbackcall'].'"></div>'.PHP_EOL;
            }
            break;
        case 'callback':
            if ($yturbo_options['ytfeedbackcallback']) {
                $content .= '<div data-type="callback" data-send-to="'.$yturbo_options['ytfeedbackcallback'].'"';
                if ($yturbo_options['ytfeedbackcallback2'] && $yturbo_options['ytfeedbackcallback3']) {
                    $content .= ' data-agreement-company="'.stripslashes($yturbo_options['ytfeedbackcallback2']).'" data-agreement-link="'.$yturbo_options['ytfeedbackcallback3'].'"';
                }
            }
            $content .= '></div>'.PHP_EOL;
            break;
        case 'chat':
            $content .= '<div data-type="chat"></div>'.PHP_EOL;
            break;
        case 'mail':
            if ($yturbo_options['ytfeedbackmail']) {
                $content .= '<div data-type="mail" data-url="'.$yturbo_options['ytfeedbackmail'].'"></div>'.PHP_EOL;
            }
            break;
        case 'vkontakte':
            if ($yturbo_options['ytfeedbackvkontakte']) {
                $content .= '<div data-type="vkontakte" data-url="'.$yturbo_options['ytfeedbackvkontakte'].'"></div>'.PHP_EOL;
            }
            break;
        case 'odnoklassniki':
            if ($yturbo_options['ytfeedbackodnoklassniki']) {
                $content .= '<div data-type="odnoklassniki" data-url="'.$yturbo_options['ytfeedbackodnoklassniki'].'"></div>'.PHP_EOL;
            }
            break;
        case 'twitter':
            if ($yturbo_options['ytfeedbacktwitter']) {
                $content .= '<div data-type="twitter" data-url="'.$yturbo_options['ytfeedbacktwitter'].'"></div>'.PHP_EOL;
            }
            break;
        case 'facebook':
            if ($yturbo_options['ytfeedbackfacebook']) {
                $content .= '<div data-type="facebook" data-url="'.$yturbo_options['ytfeedbackfacebook'].'"></div>'.PHP_EOL;
            }
            break;
        case 'viber':
            if ($yturbo_options['ytfeedbackviber']) {
                $content .= '<div data-type="viber" data-url="'.$yturbo_options['ytfeedbackviber'].'"></div>'.PHP_EOL;
            }
            break;
        case 'whatsapp':
            if ($yturbo_options['ytfeedbackwhatsapp']) {
                $content .= '<div data-type="whatsapp" data-url="'.$yturbo_options['ytfeedbackwhatsapp'].'"></div>'.PHP_EOL;
            }
            break;
        case 'telegram':
            if ($yturbo_options['ytfeedbacktelegram']) {
                $content .= '<div data-type="telegram" data-url="'.$yturbo_options['ytfeedbacktelegram'].'"></div>'.PHP_EOL;
            }
            break;
        }
    }
    unset($network);

    $content .= '</div>'.PHP_EOL;
    return $content;
}
//функция вывода виджета обратной связи end

//функция удаления указанных шорткодов begin
function yturbo_strip_shortcodes( $content ) {
    $yturbo_options = get_option('yturbo_options');

    //выполняем блоки гутенберга
    global $wp_version;
    if ( version_compare( $wp_version, '5.0', '>=' ) ) {
        $content = do_blocks( $content );
    }

    if ($yturbo_options['ytexcludeshortcodes'] == 'disabled' or !$yturbo_options['ytexcludeshortcodeslist']) return $content;

    global $shortcode_tags;
    $stack = $shortcode_tags;

    $code = explode(",", $yturbo_options['ytexcludeshortcodeslist']);
    $code = array_diff($code, array(''));

    $how_many = count($code);
    for($i = 0; $i < $how_many; $i++){
        $arr[$code[$i]] = 1;
    }

    $shortcode_tags = $arr;
    $content = strip_shortcodes($content);
    $shortcode_tags = $stack;

    return $content;
}
//функция удаления указанных шорткодов end

//функция формирования контента по шаблону begin
function yturbo_build_template( $post_content ) {
    $yturbo_options = get_option('yturbo_options');

    $post_type = get_post_type( get_the_ID() );

    if ( !isset($yturbo_options['template-'.$post_type]) ) {$yturbo_options['template-'.$post_type] = '';}
    if( $yturbo_options['template-'.$post_type] == '' ) {$yturbo_options['template-'.$post_type] = '%%post_content%%';}

    $content = html_entity_decode(stripcslashes($yturbo_options['template-'.$post_type]),ENT_QUOTES);

    //проверка на индивидуальный шаблон записи (если включен и существует)
    $template_meta = get_post_meta(get_the_ID(), 'template_meta', true);
    if( $template_meta == 'yes' ) {
        $custom_template = get_post_meta(get_the_ID(), 'custom_template', true);
        $custom_template = html_entity_decode(stripcslashes($custom_template),ENT_QUOTES);
        if (!$custom_template) {$custom_template=$content;}
        $content = $custom_template;
    }

    //сначала обработаем шаблон произвольным фильтром 
    $content = apply_filters('yturbo_the_template', $content);

    //заменяем переменные на произвольные поля
    if (preg_match_all("/%%(.*?)%%/i", $content, $res)) {
        foreach ($res[0] as $r) {
            if($r != '%%post_content%%') {
                $temp = str_replace('%%', '', $r);
                $content = str_replace($r, get_post_meta(get_the_ID(), $temp, true), $content);
            }
        }
    }

    //обрабатываем шаблон фильтрами для RSS
    $content = do_shortcode($content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = apply_filters('wp_staticize_emoji', $content);
    $content = apply_filters('_oembed_filter_feed_content', $content);

    //заменяем в шаблоне переменную %%post_content%% на контент записи
    $content = str_replace('<p>%%post_content%%</p>', '%%post_content%%', $content);
    $content = str_replace('%%post_content%%', $post_content, $content);

    return $content;
}
//функция формирования контента по шаблону end

//функция вывода блока поиска begin
function yturbo_search_widget() {
    $yturbo_options = get_option('yturbo_options');

    $url = get_bloginfo('url') . '/?s={s}';
    $content = PHP_EOL.'<form action="'. $url . '" method="GET"><input type="search" name="s" placeholder="' . $yturbo_options['ytsearchplaceholder'] . '" /></form>'.PHP_EOL;

    return $content;
}
//функция вывода блока поиска end

//вставка оглавления записи begin
function yturbo_toc( $content ) {
    $yturbo_options = get_option('yturbo_options');

    if ( ! is_feed($yturbo_options['ytrssname']) )
        return $content;

    if ( $yturbo_options['yttoc'] == 'disabled' )
        return $content;

    $types = $yturbo_options['yttype2'];
    $types = explode(",", $types);
    $types = array_diff($types, array(''));

    if ( ! in_array( get_post_type( get_the_ID() ), $types ) )
        return $content;

    //подключение файла с классом YTurbo_Contents begin
    require_once dirname( __FILE__ ) . '/inc/Contents.php';
    //подключение файла с классом YTurbo_Contents end

    $selectors = array();
    if ($yturbo_options['yttoch1']=='enabled'){array_push($selectors, 'h1');}
    if ($yturbo_options['yttoch2']=='enabled'){array_push($selectors, 'h2');}
    if ($yturbo_options['yttoch3']=='enabled'){array_push($selectors, 'h3');}
    if ($yturbo_options['yttoch4']=='enabled'){array_push($selectors, 'h4');}
    if ($yturbo_options['yttoch5']=='enabled'){array_push($selectors, 'h5');}
    if ($yturbo_options['yttoch6']=='enabled'){array_push($selectors, 'h6');}

    $args = array(
        'css'        => false,
        'to_menu'    => false,
        'title'      => $yturbo_options['yttoczag'],
        'min_found'  => $yturbo_options['yttocnumber'],
        'min_length' => 100,
        'page_url'   => get_the_permalink(),
        'selectors'  => $selectors,
    );

    $contents = YTurbo_Contents::init( $args )->make_contents( $content );

    $contents = str_replace("\n", '', $contents);
    $contents = trim(preg_replace('/\t+/', '', $contents));
    $contents = wpautop($contents);

    if ( $yturbo_options['yttocmesto'] == 'В начале записи' ) {
        return PHP_EOL . $contents . $content;
    }
    if ( $yturbo_options['yttocmesto'] == 'В конце записи' ) {
        return $content . $contents . PHP_EOL;
    }
    if ( $yturbo_options['yttocmesto'] == 'Перед первым заголовком' ) {
        $pattern = "/<h(.*?)>/i";
        $replacement = $contents . PHP_EOL . '<h$1>';
        $content = preg_replace($pattern, $replacement, $content, 1);
        return $content;
    }
    if ( $yturbo_options['yttocmesto'] == 'После первого заголовка' ) {
        $pattern = "/<\/h(.*?)>/i";
        $replacement = '</h$1>' . PHP_EOL . PHP_EOL . $contents;
        $content = preg_replace($pattern, $replacement, $content, 1);
        return $content;
    }
}
add_filter( 'yturbo_add_contents', 'yturbo_toc' );
//вставка оглавления записи end

//функция удаления эмоджи begin
function yturbo_remove_emoji( $text ) {

    $text = preg_replace('/[^\pL\pM[:ascii:]]+/u', '', $text);
    $text = str_replace('  ', ' ', $text);
    $text = trim($text);

    return $text;
}
//функция удаления эмоджи end

//приводим заголовки записей в соответствие с требованиями яндекса begin
function yturbo_filter_title_rss( $title ) {
    $yturbo_options = get_option('yturbo_options');

    //если это не лента плагина возвращаем оригинальный заголовок
    if ( ! is_feed($yturbo_options['ytrssname']) )
        return $title;

    //удаляем эмоджи (яндекс выдает на них ошибку)
    $title = yturbo_remove_emoji($title);
    //устанавливаем заголовком название сайта, если заголовок пустой
    $title = yturbo_empty_title($title);
    //преобразуем спец. символы в html-сущности
    $title = esc_html($title);
    //обрезаем заголовок по словам, чтобы не превышать ограничение в 240 символов
    $title = yturbo_cut_by_words(237, $title);
    //обрабатываем фильтром для установки пользовательского заголовка
    $title = apply_filters('yturbo_custom_title', $title);

    return $title;
}
add_filter( 'the_title_rss', 'yturbo_filter_title_rss' );
//приводим заголовки записей в соответствие с требованиями яндекса end

//функция обрезки текста по словам begin
function yturbo_cut_by_words( $maxlen, $text ) {
    $len = (mb_strlen($text) > $maxlen)? mb_strripos(mb_substr($text, 0, $maxlen), ' ') : $maxlen;
    $cutStr = mb_substr($text, 0, $len);
    $temp = (mb_strlen($text) > $maxlen)? $cutStr. '...' : $cutStr;
    return $temp;
}
//функция обрезки текста по словам end

//функция установки не пустого заголовка begin
function yturbo_empty_title( $title ) {
    $yturbo_options = get_option('yturbo_options');

    if ( ! $title ) {
        $title = $yturbo_options['yttitle'];
    }

    return $title;
}
//функция установки не пустого заголовка end

//добавляем плагины в визуальный редактор begin
function yturbo_add_plugins_tinymce( $plugins ) {
    $yturbo_options = get_option('yturbo_options');
    $purl = plugins_url('', __FILE__);
    $plugins['yablocks'] = $purl . '/inc/yablocks.js?ver=' . $yturbo_options['version'];
    $plugins['table'] = $purl . '/inc/table.js?ver=' . $yturbo_options['version'];
    return $plugins;
}
add_filter( 'mce_external_plugins', 'yturbo_add_plugins_tinymce' );
//добавляем плагины в визуальный редактор end

//замена протокола в ссылках при отключении турбо-страниц begin
function yturbo_filter_permalink_rss( $url ) {
    $yturbo_options = get_option('yturbo_options');

    if ( ! is_feed($yturbo_options['ytrssname']) )
        return $url;

    if ( $yturbo_options['ytremoveturbo'] != 'enabled' )
        return $url;

    if ( $yturbo_options['ytprotokol'] == 'asis' )
        return $url;

    if ( $yturbo_options['ytprotokol'] == 'http' ) {
        $url = str_replace('https://', 'http://', $url);
    }

    if ( $yturbo_options['ytprotokol'] == 'https' ) {
        $url = str_replace('http://', 'https://', $url);
    }

    return $url;
}
add_filter( 'the_permalink_rss', 'yturbo_filter_permalink_rss' );
//замена протокола в ссылках при отключении турбо-страниц end

//добавляем колонку "Турбо" в админке на странице списка записей begin
function yturbo_add_column_name( $defaults ) {
    $purl = plugins_url('', __FILE__);
    $defaults['yturbo'] = '<span class="screen-reader-text">Яндекс.Турбо</span><img title="Яндекс.Турбо" style="width: 20px;height: 20px;vertical-align: bottom;" src="' . $purl . '/img/yablocks.png" />';
    return $defaults;
}
function yturbo_css_for_column_yturbo() {
    echo '<style>.column-yturbo{width: 3.0em;}</style>';
}
function yturbo_add_column_content( $column_name, $post_id ) {
    if ($column_name === 'yturbo') {

        $yturbo_options = get_option('yturbo_options');

        $ytrssenabled = get_post_meta( $post_id, 'ytrssenabled_meta_value', true );
        $ytremove = get_post_meta( $post_id, 'ytremove_meta_value', true );

        $content = '';
        if ( $ytrssenabled == 'yes' ) { $content = '<span title="Запись исключена из RSS-ленты (вручную)" style="vertical-align: middle;color:#72777c;" class="dashicons dashicons-no-alt"></span>'; }
        if ( $ytremove == 'yes' ) { $content =  '<span title="Турбо-страница на удалении" style="vertical-align: middle;color:#df2424;" class="dashicons dashicons-no-alt"></span>'; }
        if ( $ytremove != 'yes' && $ytrssenabled != 'yes' ) { $content =  '<span title="Запись есть в RSS-ленте" style="vertical-align: middle;color:#0a8f0a;" class="dashicons dashicons-yes"></span>'; }

        $ytqueryselect = $yturbo_options['ytqueryselect'];
        $yttaxlist = $yturbo_options['yttaxlist'];
        $ytaddtaxlist = $yturbo_options['ytaddtaxlist'];

        if ($ytqueryselect=='Все таксономии, кроме исключенных' && $yttaxlist) {
            $textAr = explode("\n", trim($yttaxlist));
            $textAr = array_filter($textAr, 'trim');
            foreach ($textAr as $line) {
                $tax = explode(":", $line);
                $taxterm = explode(",", $tax[1]);
                $taxterm = array_map('intval', $taxterm);
                if ( has_term($taxterm, $tax[0]) ) {
                    $content = '<span title="Запись исключена из RSS-ленты (фильтр по таксономии)" style="vertical-align: middle;color:#72777c;" class="dashicons dashicons-no-alt"></span>';
                    break;
                }
            }
        }
        if (!$ytaddtaxlist) {$ytaddtaxlist = 'category:10000000';}
        if ($ytqueryselect=='Только указанные таксономии' && $ytaddtaxlist) {
            $textAr = explode("\n", trim($ytaddtaxlist));
            $textAr = array_filter($textAr, 'trim');
            foreach ($textAr as $line) {
                $tax = explode(":", $line);
                $taxterm = explode(",", $tax[1]);
                $taxterm = array_map('intval', $taxterm);
                if ( has_term($taxterm, $tax[0]) ) {
                    $content =  '<span title="Запись есть в RSS-ленте" style="vertical-align: middle;color:#0a8f0a;" class="dashicons dashicons-yes"></span>';
                    break;
                } else {
                    $content = '<span title="Запись исключена из RSS-ленты (фильтр по таксономии)" style="vertical-align: middle;color:#72777c;" class="dashicons dashicons-no-alt"></span>';
                }
            }
        }

        if ( get_post_status($post_id) != 'publish' ) {
            $content = '<span title="Записи нет в RSS-ленте (запись не опубликована)" style="vertical-align: middle;color:#72777c;" class="dashicons dashicons-no-alt"></span>';
        }

        echo $content;
    }
}
function yturbo_add_columns() {
    $yturbo_options = get_option('yturbo_options');

    if ( $yturbo_options['ytturbocolumn'] == 'disabled' )
        return;

    $yttype = explode( ",", $yturbo_options['yttype'] );
    $yttype = array_diff( $yttype, array('') );

    foreach ( $yttype as $post_type ) {
        if ( 'page' === $post_type ) continue;
        add_filter( "manage_{$post_type}_posts_columns", "yturbo_add_column_name", 5 );
        add_action( "manage_{$post_type}_posts_custom_column", "yturbo_add_column_content", 5, 2 );
    }

    if ( in_array('page', $yttype) ) {
        add_filter( 'manage_pages_columns', 'yturbo_add_column_name', 5 );
        add_action( 'manage_pages_custom_column', 'yturbo_add_column_content', 5, 2 );
    }

    add_action( 'admin_head', 'yturbo_css_for_column_yturbo' );
}
add_action( 'wp_loaded', 'yturbo_add_columns' );
//добавляем колонку "Турбо" в админке на странице списка записей end

//шорткод вывода ссылки на запись begin
function yt_permalink_func( $atts ) {
    return esc_url( apply_filters( 'the_permalink_rss', get_permalink() ) );
}
add_shortcode( 'yt-permalink', 'yt_permalink_func' );
//шорткод вывода ссылки на запись end

//шорткод вывода заголовка записи begin
function yt_title_func( $atts ) {
    return get_the_title_rss();
}
add_shortcode( 'yt-title', 'yt_title_func' );
//шорткод вывода заголовка записи end

//функция проверки наличия плагина "WPCase: Turbo Ads" begin
function yturbo_check_ads() {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if ( is_plugin_active( 'wpcase-turbo-ads/wpcase-turbo-ads.php' ) ) {
        return true;
    } else {
        return false;
    }
}
//функция проверки наличия плагина "WPCase: Turbo Ads" end

//скрываем произвольные поля плагина begin
function yturbo_hide_custom_fields( $protected, $meta_key ){
    $hide_meta_keys = array( 
        'ytad1meta', 
        'ytad2meta',
        'ytad3meta',
        'ytad4meta',
        'ytad5meta',
        'ytremove_meta_value',
        'ytrssenabled_meta_value',
        'template_meta',
        'custom_template',
    );
    if ( in_array($meta_key, $hide_meta_keys) ) {
        return true;
    }
    return $protected;
}
add_filter( 'is_protected_meta', 'yturbo_hide_custom_fields', 10, 2 );
//скрываем произвольные поля плагина end

//функция определения доступных для удаления тегов begin
function yturbo_tags_list() {

    $tags_list = 'abbr,acronym,address,applet,area,article,aside,audio,base,basefont,bb,bdo,big,body,button,canvas,caption,center,cite,code,col,colgroup,command,datagrid,datalist,dd,del,details,dfn,dialog,dir,div,dl,dt,embed,eventsource,fieldset,font,footer,form,frame,frameset,head,header,hgroup,html,ins,isindex,kbd,keygen,label,legend,main,map,mark,menu,meter,nav,noframes,noscript,object,optgroup,option,output,param,pre,progress,q,rp,rt,ruby,samp,script,section,svg,select,small,span,style,time,title,tt,var,wbr,sidebar';
    $tags_list = apply_filters( 'yturbo_tags_list', $tags_list );

    return $tags_list;
}
//функция определения доступных для удаления тегов end

//функция вывода мусорной ленты begin
function yturbo_lenta_trash() {
$yturbo_options = get_option('yturbo_options');

header('Content-Type: ' . feed_content_type('rss2') . '; charset=' . get_option('blog_charset'), true);
echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>'.PHP_EOL;
?>
<rss
    xmlns:yandex="http://news.yandex.ru"
    xmlns:media="http://search.yahoo.com/mrss/"
    xmlns:turbo="http://turbo.yandex.ru"
    version="2.0">
<channel>
    <turbo:cms_plugin>C125AEEC6018B4A0EF9BF40E6615DD17</turbo:cms_plugin>
    <title><?php echo stripslashes($yturbo_options['yttitle']); ?></title>
    <link><?php echo esc_html($yturbo_options['ytlink']); ?></link>
    <description><?php echo stripslashes($yturbo_options['ytdescription']); ?></description>
    <language><?php echo $yturbo_options['ytlanguage']; ?></language>
    <generator>RSS for Yandex Turbo v<?php echo $yturbo_options['version']; ?> (https://wordpress.org/plugins/rss-for-yandex-turbo/)</generator>
    <?php if ( $yturbo_options['ytexcludeurlslist'] ) {
            $textAr = explode("\n", str_replace(array("\r\n", "\r"), "\n", $yturbo_options['ytexcludeurlslist']));
            $i = 0;
            foreach ($textAr as $line) {
                $line = stripcslashes($line);
                $line = '<item turbo="false"><link>' . $line . '</link></item>' . PHP_EOL;
                if ($i > 0) echo '    ';
                echo $line;
                $i++;
            }
        } else {
            //чтобы яндекс не ругался на пустую ленту, если на удалении нет записей
            echo '<item turbo="false"><link>' . get_bloginfo_rss('url') . '/musor-page/</link></item>' . PHP_EOL;
        }
    ?>
</channel>
</rss>
<?php }
//функция вывода мусорной ленты end

//функция отслеживания урлов удаляемых записей begin
function yturbo_trash_tracking( $post_id ) {

    $yturbo_options = get_option('yturbo_options');

    if ( $yturbo_options['ytexcludeurls'] == 'disabled' )
        return;

    if ( $yturbo_options['ytdeltracking'] == 'disabled' )
        return;

    $yttype = explode(",", $yturbo_options['yttype']);
    $yttype = array_diff($yttype, array(''));

    if ( ! in_array(get_post_type($post_id), $yttype) )
        return;

    $delpermalink = PHP_EOL . esc_url( apply_filters( 'the_permalink_rss', get_permalink($post_id) ) );
    $yturbo_options['ytexcludeurlslist'] .= $delpermalink;
    $lines = array_filter(explode("\n", trim($yturbo_options['ytexcludeurlslist'])));
    $yturbo_options['ytexcludeurlslist'] = implode("\n", $lines);

    update_option('yturbo_options', $yturbo_options);
}
add_action( 'wp_trash_post', 'yturbo_trash_tracking' );
//функция отслеживания урлов удаляемых записей end

//функция отслеживания урлов восстанавливаемых записей begin
function yturbo_untrash_tracking( $post_id ) {

    $yturbo_options = get_option('yturbo_options');

    if ( $yturbo_options['ytexcludeurls'] == 'disabled' )
        return;

    if ( $yturbo_options['ytdeltracking'] == 'disabled' )
        return;

    $yttype = explode(",", $yturbo_options['yttype']);
    $yttype = array_diff($yttype, array(''));

    if ( ! in_array(get_post_type($post_id), $yttype) )
        return;

    $restorepermalink = esc_url( apply_filters( 'the_permalink_rss', get_permalink($post_id) ) );
    $yturbo_options['ytexcludeurlslist'] = str_replace($restorepermalink, '', $yturbo_options['ytexcludeurlslist']);
    $lines = array_filter(explode("\n", trim($yturbo_options['ytexcludeurlslist'])));
    $yturbo_options['ytexcludeurlslist'] = implode("\n", $lines);

    update_option('yturbo_options', $yturbo_options);
}
add_action( 'untrashed_post', 'yturbo_untrash_tracking' );
//функция отслеживания урлов восстанавливаемых записей end



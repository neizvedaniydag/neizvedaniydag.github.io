<table>
<form method=post>
<tr><td>Имя:</td><td><input type=text name=name></td></tr>
<tr><td>Пароль:</td><td><input type=password name=pass></td></tr>
<tr><td>Пароль:</td><td><input type=password name=pass_again></td></tr>
<tr><td>e-mail:</td><td><input type=text name=email></td></tr>
<tr><td>URL:</td><td><input type=text name=url></td></tr>
<tr><td></td><td><input type=submit value='Зарегистрировать'></td></tr>
</form>
</table>
<?php
  // Обработчик HTML-формы

  /////////////////////////////////////////////////
  // 1. Блок проверки правильности данных
  /////////////////////////////////////////////////
  // Удаляем лишние пробелы
  $_POST['name'] = trim($_POST['name']);
  $_POST['pass'] = trim($_POST['pass']);
  $_POST['pass_again'] = trim($_POST['pass_again']);
  // Проверяем не пустой ли суперглобальный массив $_POST
  if(empty($_POST['name'])) exit();
  // Проверяем правильно ли заполнены обязательные поля
  if(empty($_POST['name'])) exit('Поле "Имя" не заполнено');
  if(empty($_POST['pass'])) exit('Одно из полей "Пароль" не заполнено');
  if(empty($_POST['pass_again'])) exit('Одно из полей "Пароль" не заполнено');
  if($_POST['pass'] != $_POST['pass_again']) exit('Пароли не совпадают');
  // Если введён e-mail проверяем его на соответсвие
  if(!empty($_POST['email']))
  {
    if(!preg_match("|^[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,6}$|i", $_POST['email']))
    {
      exit('Поле "E-mail" должно соответствовать формату somebody@somewhere.ru');
    }
  }

  /////////////////////////////////////////////////
  // 2. Блок проверки имени на уникальность
  /////////////////////////////////////////////////
  // Имя файла данных
  $filename = "text.txt"; 
  // Проверяем не было ли переданное имя
  // зарегистрировано ранее
  $arr = file($filename);
  foreach($arr as $line)
  {
    // Разбиваем строку по разделителю ::
    $data = explode("::",$line);
    // В массив $temp помещаем имена уже зарегистрированных
    // посетителей
    $temp[] = $data[0];
  }
  // Проверяем не содержится ли текущее имя
  // в массиве имён $temp
  if(in_array($_POST['name'], $temp))
  {
    exit("Данное имя уже зарегистрировано, пожалуйста, выберите другое");
  }

  /////////////////////////////////////////////////
  // 3. Блок регистрации пользователя
  /////////////////////////////////////////////////
  // Помещаем данные в текстовый файл
  $fd = fopen($filename, "a");
  if(!$fd) exit("Ошибка при открытии файла данных");
  $str = $_POST['name']."::".
         $_POST['pass']."::".
         $_POST['email']."::".
         $_POST['url']."\r\n";
  fwrite($fd,$str);
  fclose($fd);
  // Осуществляем перезагрузку страницы,
  // чтобы сбросить POST-данные
  echo "<HTML><HEAD>
         <META HTTP-EQUIV='Refresh' CONTENT='0; URL=$_SERVER[PHP_SELF]'>
        </HEAD></HTML>";
?>
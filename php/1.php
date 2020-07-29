<?php
  // Имя файла данных
  $filename = "text.txt"; 
  // Определяем константу FIRST для
  // того, чтобы точно определить 
  // был ли выполнен файл 1.php
  define("FIRST",1);
  // Проверяем не пусто ли содержимое
  // массива $_POST - если это так, 
  // выводим форму для авторизации
  if(empty($_POST))
  {
    ?>
    <table>
      <form method=post>
      <tr>
        <td>Имя:</td>
        <td><input type=text name=name></td>
      </tr>
      <tr>
        <td>Пароль:</td>
        <td><input type=password name=pass></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type=submit value='Войти'></td>
      </tr>
      </form>
   </table>
   <?php
  }
  // В противном случае, если POST-данные
  // переданы - обрабатываем их
  else
  {
    // Проверяем корректность введённого имени
    // и пароля
    $arr = file($filename);
    $i = 0;
    $temp = array();
    foreach($arr as $line)
    {
      // Разбиваем строку по разделителю ::
      $data = explode("::",$line);
      // В массив $temp помещаем имена и пароли
      // зарегистрированных посетителей
      $temp['name'][$i]     = $data[0];
      $temp['password'][$i] = $data[1];
      $temp['email'][$i]    = $data[2];
      $temp['url'][$i]      = trim($data[3]);
      // Увеличиваем счётчик
      $i++;
    }
    // Если в массиве $temp['name'] нет введённого
    // логина - останавливаем работу скрипта
    if(!in_array($_POST['name'],$temp['name']))
    {
      exit("Пользователь с таким именем не зарегистрирован");
    }
    // Если пользователь с именем $_POST['name'] обнаружен
    // проверяем правильность введённого пароля
    $index = array_search($_POST['name'],$temp['name']);
    if($_POST['pass'] != $temp['password'][$index])
    {
      exit("Пароль не соответствует логину");
    }
    // Если переданный пароль соответсвует паролю из
    // файла text.txt выводим форму для редактирования
    // данных
    include "2.php"; // Обработчик второй HTML-формы
    ?>
    <table>
      <form method=post>
        <input type=hidden name=name
         value='<?= htmlspecialchars($temp['name'][$index]); ?>'>
        <input type=hidden name=pass
         value='<?= htmlspecialchars($temp['password'][$index]); ?>'>
        <input type=hidden name=edit value=edit>
      <tr>
        <td>Пароль:</td>
        <td><input type=password name=passw
         value='<?= htmlspecialchars($temp['password'][$index]); ?>'>
        </td>
      </tr>
      <tr>
        <td>Пароль:</td>
        <td><input type=password name=pass_again
         value='<?= htmlspecialchars($temp['password'][$index]); ?>'>
        </td>
      </tr>
      <tr>
        <td>E-mail:</td>
        <td><input type=text name=email
             value=<?= htmlspecialchars($temp['email'][$index]); ?>></td>
      </tr>
      <tr>
        <td>URL:</td>
        <td><input type=text name=url
             value=<?= htmlspecialchars($temp['url'][$index]); ?>></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type=submit value='Редактировать'></td>
      </tr>
      </form>
    </table>
<?php
  }
?>
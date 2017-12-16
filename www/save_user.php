<?php
    if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
    if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
    //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
	if (isset($_POST['mail'])) { $mail=$_POST['mail']; if ($mail =='') { unset($mail);} }
 if (empty($login) or empty($password) or empty($mail)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    }
    //если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
	$password = stripslashes($password);
    $password = htmlspecialchars($password);
	$mail = stripslashes($mail);
    $mail = htmlspecialchars($mail);
 //удаляем лишние пробелы
    $login = trim($login);
    $password = trim($password);
    $mail = trim($mail);
 // подключаемся к базе
    include ("bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
 // проверка на существование пользователя с таким же логином
    $result = mysql_query("SELECT id FROM users WHERE user_login='$login'",$db);
    $result_mail = mysql_query("SELECT id FROM users WHERE user_mail='$mail'",$db);
    $myrow = mysql_fetch_array($result);
    $myrow_mail = mysql_fetch_array($result_mail);
    if (!empty($myrow['id'])) {
    exit ("Извините, введённый вами логин уже зарегистрирован. Введите другой логин.");
    }
	if (!empty($myrow['id'])) {
    exit ("Извините, введённая вами электронная почта уже зарегистрирована. Введите другую почту.");
    }
 // если такого нет, то сохраняем данные
    $result2 = mysql_query ("INSERT INTO users (user_login,user_password,user_mail) VALUES('$login','$password','$mail')");
    // Проверяем, есть ли ошибки
    if ($result2=='TRUE')
    {
    echo "Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. <a href='index.php'>Главная страница</a>";
    }
 else {
    echo "Ошибка! Вы не зарегистрированы.";
    }
    ?>
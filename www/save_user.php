<?php
    if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //������� ��������� ������������� ����� � ���������� $login, ���� �� ������, �� ���������� ����������
    if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
    //������� ��������� ������������� ������ � ���������� $password, ���� �� ������, �� ���������� ����������
	if (isset($_POST['mail'])) { $mail=$_POST['mail']; if ($mail =='') { unset($mail);} }
 if (empty($login) or empty($password) or empty($mail)) //���� ������������ �� ���� ����� ��� ������, �� ������ ������ � ������������� ������
    {
    exit ("�� ����� �� ��� ����������, ��������� ����� � ��������� ��� ����!");
    }
    //���� ����� � ������ �������, �� ������������ ��, ����� ���� � ������� �� ��������, ���� �� ��� ���� ����� ������
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
	$password = stripslashes($password);
    $password = htmlspecialchars($password);
	$mail = stripslashes($mail);
    $mail = htmlspecialchars($mail);
 //������� ������ �������
    $login = trim($login);
    $password = trim($password);
    $mail = trim($mail);
 // ������������ � ����
    include ("bd.php");// ���� bd.php ������ ���� � ��� �� �����, ��� � ��� ���������, ���� ��� �� ���, �� ������ �������� ���� 
 // �������� �� ������������� ������������ � ����� �� �������
    $result = mysql_query("SELECT id FROM users WHERE user_login='$login'",$db);
    $result_mail = mysql_query("SELECT id FROM users WHERE user_mail='$mail'",$db);
    $myrow = mysql_fetch_array($result);
    $myrow_mail = mysql_fetch_array($result_mail);
    if (!empty($myrow['id'])) {
    exit ("��������, �������� ���� ����� ��� ���������������. ������� ������ �����.");
    }
	if (!empty($myrow['id'])) {
    exit ("��������, �������� ���� ����������� ����� ��� ����������������. ������� ������ �����.");
    }
 // ���� ������ ���, �� ��������� ������
    $result2 = mysql_query ("INSERT INTO users (user_login,user_password,user_mail) VALUES('$login','$password','$mail')");
    // ���������, ���� �� ������
    if ($result2=='TRUE')
    {
    echo "�� ������� ����������������! ������ �� ������ ����� �� ����. <a href='index.php'>������� ��������</a>";
    }
 else {
    echo "������! �� �� ����������������.";
    }
    ?>
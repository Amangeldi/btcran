<?php
session_start();// ��� ��������� �������� �� �������. ������ � ��� �������� ������ ������������, ���� �� ��������� �� �����. ����� ����� ��������� �� � ����� ������ ���������!!!

if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //������� ��������� ������������� ����� � ���������� $login, ���� �� ������, �� ���������� ����������
if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
//������� ��������� ������������� ������ � ���������� $password, ���� �� ������, �� ���������� ����������

if (empty($login) or empty($password)) //���� ������������ �� ���� ����� ��� ������, �� ������ ������ � ������������� ������
{
exit ("�� ����� �� ��� ����������, �������� ����� � ��������� ��� ����!");
}
//���� ����� � ������ �������,�� ������������ ��, ����� ���� � ������� �� ��������, ���� �� ��� ���� ����� ������
$login = stripslashes($login);
$login = htmlspecialchars($login);

$password = stripslashes($password);
$password = htmlspecialchars($password);

//������� ������ �������
$login = trim($login);
$password = trim($password);


// ������������ � ����
include ("bd.php");// ���� bd.php ������ ���� � ��� �� �����, ��� � ��� ���������, ���� ��� �� ���, �� ������ �������� ���� 



$result = mysql_query("SELECT * FROM users WHERE user_login='$login'",$db); //��������� �� ���� ��� ������ � ������������ � ��������� �������
$myrow = mysql_fetch_array($result);
if (empty($myrow['user_password']))
{
//���� ������������ � ��������� ������� �� ����������
exit ("��������, �������� ���� ����� ��� ������ ��������.");
}
else {
//���� ����������, �� ������� ������
          if ($myrow['user_password']==$password) {
          //���� ������ ���������, �� ��������� ������������ ������! ������ ��� ����������, �� �����!
          $_SESSION['login']=$myrow['_user_login']; 
          $_SESSION['id']=$myrow['user_id'];//��� ������ ����� ����� ������������, ��� �� � ����� "������ � �����" �������� ������������
		  echo '<script>location.replace("index.php");</script>'; exit;
          }

       else {
       //���� ������ �� �������
       exit ("��������, �������� ���� ����� ��� ������ ��������.");
	   }
}
?>
<?php
session_start();
include "homepage.php";
if (empty($_SESSION['login']) or empty($_SESSION['id']))
{
	echo '<script>location.replace("login.php");</script>'; exit;
}
echo $STR;
?>
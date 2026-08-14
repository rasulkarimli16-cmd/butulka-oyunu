<?php
$host="localhost";
$db="meyhanem";
$user="meyhaneci";
$pass="senveben33**";
$conn=@mysql_connect($host,$user,$pass) or die("Mysql Baglanamadi");
 
mysql_select_db($db,$conn) or die("Veritabanina Baglanilamadi");
mysql_query("SET NAMES UTF8");
ob_start();
session_start();
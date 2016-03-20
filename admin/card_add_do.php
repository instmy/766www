<?php
//引入配置文件
require_once '../lib/config.php';
require_once '_check.php';
$sub  = $_POST['card_sub'];
$money = (int)$_POST['card_money'];
$num  = (int)$_POST['card_num'];

for($a=0;$a<$num;$a++){
	$x = md5(rand(10, 1000)).md5(rand(10, 1000));
	$x = base64_encode($x);
	$card = $sub.substr($x, rand(1, 13), 24);
	$db->insert("card",[
		"cardno" => $card,
		"transfer" => $money,
		"useuid" => 0
	]);
	echo $card.'<br>';
}
die;
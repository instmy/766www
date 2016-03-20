<?php
require_once '../lib/config.php';
require_once '_check.php';
if(isset($_POST['num'])){
	$num = (int)$_POST['num'];
	if($num < 1 || $num > 1000){
		echo 'Error';
		die;
	}else{
		$price = 0.5 * $num;
	}
}else{
	die;
}
$uid = $U -> uid;
$orderid = time().mt_rand(1000,9999);
$db -> insert('order',[
	"uid"=>$uid,
	"orderid"=>$orderid,
	"num"=>$num,
	"money"=>$price,
	"paid"=>0
]);

$html_text = '订单已生成:订单号:'.$orderid.'<br>';
$html_text .= "<form action='https://shenghuo.alipay.com/send/payment/fill.htm' method='post' name='form1' accept-charset='gb2312' onsubmit=\"document.charset='gb2312'\">";
$html_text.= "<input name='optEmail' value='alipay@alipay.com' type='hidden'>";
$html_text.= "<input name='payAmount' type='hidden' value='$price'>";
$html_text.= "<input name='title' type='hidden' value='$orderid' />";
$html_text.= "<input name='memo' type='hidden' value='请勿修改付款说明，付款后系统将自动到账' />";
$html_text.= "<input type='image' src='../asset/img/alipay.gif' /></form>";

echo $html_text;
die;
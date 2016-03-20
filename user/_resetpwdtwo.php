<?php
//设置编码
header("content-type:text/html;charset=utf-8");
require_once '../lib/config.php';

$mg = new Ss\Etc\MailSmtp();
if($mail_smtp_Connection == 1){
	$mg->setServer($mail_smtp_Server,$mail_smtp_Account,$mail_smtp_password,$mail_smtp_Port,true);
}else{
	$mg->setServer($mail_smtp_Server,$mail_smtp_Account,$mail_smtp_password,$mail_smtp_Port,false);
}
$mg->setFrom($mail_smtp_Account);

//
$code     = $_POST['code'];
$email    = $_POST['email'];
$uid      = $_POST['uid'];
$password = $_POST['password'];
$repasswd = $_POST['repasswd'];
//
$ur = new \Ss\User\UserInfo($uid);
if($ur->GetEmail() == $email){
    $rs = '1';
}else{
    $rs = '0';
}
if(!$rs){
    $a['code'] = '0';
    $a['msg']  =  "邮箱错误";
}elseif($repasswd != $password){
    $a['code'] = '0';
    $a['msg'] = "两次密码输入不符";
}elseif(strlen($password)<8){
    $a['code'] = '0';
    $a['msg'] = "密码太短";
}else{
    $rst = new \Ss\User\ResetPwd($uid);
    $u   = new \Ss\User\User($uid);
    if($rst->IsCharOK($code,$uid)){
        $NewPwd = $password;
		$mg->setReceiver($email);
		$mg->setMail($site_name." 提示：您的新密码重置成功！","您在 ".date("Y-m-d H:i:s")." 重置了密码。");
		$mg->sendMail();
        $u->UpdatePWd($NewPwd);
        $rst->Del($code,$uid);
        $a['code'] = '1';
        $a['ok'] = '1';
        $a['msg']  =  "您的新密码重置成功！";
    }else{
        $a['code'] = '0';
        $a['msg']  =  "链接无效";
    }
}
echo json_encode($a);

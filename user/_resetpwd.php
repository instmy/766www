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

$email    = $_GET['email'];
$c = new \Ss\User\UserCheck();
$q = new \Ss\User\Query();
$a = [];
if($c->IsEmailUsed($email)){
    $uid = $q->GetUidByEmail($email);
    $rst = new \Ss\User\ResetPwd($uid);
    if($rst->IsAbleToReset()){
        $code = $rst->NewLog();
        //send
        # Now, compose and send your message.
		$mg->setReceiver($email);
		$mg->setMail('重置密码','请访问此链接申请重置密码'.$site_url."/user/resetpwd_do.php?code=".$code."&uid=".$uid);
		$mg->sendMail();
        $a['code'] = '1';
        $a['ok'] = '1';
        $a['msg']  =  "已经发送到邮箱";
    }else{
        $a['code'] = '1';
        $a['msg']  =  "24小时内申请超过上限";
    }
}else{
    $a['code'] = '0';
    $a['msg']  =  "邮箱不存在";
}
echo json_encode($a);


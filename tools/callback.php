<?php
require_once '../lib/config.php';

if(isset($_GET['orderid']) && isset($_GET['money']) && isset($_GET['key'])){
	if($_GET['key'] == '123456'){
		$oid = $_GET['orderid'];
		$money = $_GET['money'];
		$info = $db -> select('order',"*",[
			"AND"=>[
				'orderid'=>$oid,
				'money'=>$money,
				"paid"=>0
			]
		]);
		if($info){
			$uid = $info[0]['uid'];
			$num = $info[0]['num']*1024*1024*1024;
			$uinfo = $db -> select('user',"*",[
				"uid"=>$uid
			])[0];
			if($uinfo['plan'] == 'pro'){
				$db -> update('user',[
					"transfer_enable[+]"=>$num
				],[
					"uid"=>$uid
				]);
			}else{
				$db -> update('user',[
					"u"=>0,
					"d"=>0,
					"plan"=>'pro',
					"transfer_enable"=>$num
				],[
					"uid"=>$uid
				]);
			}
			$db -> update('order',[
				"paid"=>1
			],[
				"orderid"=>$oid
			]);
			echo 'success';
			die;
		}
	}else{
		echo 'Auth fail';
		die;
	}
}
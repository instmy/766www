<?php
require_once '../lib/config.php';

$info = $db -> select('user',"*",[
	"plan" => 'pro'
]);

for($i=0;$i<count($info);$i++){
	if($info[$i]['u'] + $info[$i]['d'] >= $info[$i]['transfer_enable']){
		$db -> update('user',[
			"u"=>0,
			"d"=>0,
			"transfer_enable"=>1073741824,
			"plan"=>'free'
		]);
	}
}
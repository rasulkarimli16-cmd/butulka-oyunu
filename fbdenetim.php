<?php
include("baglan.php");

function GetIP(){
	if(getenv("HTTP_CLIENT_IP")) {
 		$ip = getenv("HTTP_CLIENT_IP");
 	} elseif(getenv("HTTP_X_FORWARDED_FOR")) {
 		$ip = getenv("HTTP_X_FORWARDED_FOR");
 		if (strstr($ip, ',')) {
 			$tmp = explode (',', $ip);
 			$ip = trim($tmp[0]);
 		}
 	} else {
 	$ip = getenv("REMOTE_ADDR");
 	}
	return $ip;
}

if(isset($_POST)){
    if($_POST["id"] && $_POST["name"]){
        
        $uid    =   $_POST["id"];
        $uname  =   $_POST["name"];
        $ucins  =   $_POST["gender"];
        $ip_adresi = GetIP();
        
        $sql= mysql_query("SELECT * FROM oyuncular where fbid='".$uid."'");
        if(mysql_num_rows($sql)!=0){
            $cek= mysql_fetch_array($sql);
            if($cek["bandurumu"]==1){
                echo 'ban';
                return;
            }else{
                $_SESSION["USERKEYZ"]=$cek["serial"];
                echo 'ok';
                return;
            }
        }else{
            $kayit = mysql_query(" INSERT oyuncular SET fbid='".$uid."',adsoyad = '".$uname."',cinsiyet = '".$ucins."',ipno = '".$ip_adresi."'");
            if($kayit){
                $id     = mysql_insert_id();
                $tok   = $id."m".substr(str_shuffle('abcdefghklmnoprstuvyzqxw1234567890ABCDEFRGTOPKLMNHUYVZPM'), 0, 60);
                $tafaf=mysql_query(" UPDATE oyuncular SET serial = '".$tok."' WHERE id ='".$id."'");
                $_SESSION["USERKEYZ"]=$tok;
                echo 'ok';
                return;
            }else{
                echo 'no';
            }
       }
    }else{
        echo 'no';
    }
}else{
    echo 'no';
}
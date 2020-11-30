<?php
#乐心
function http_post_json()
{
	$jsonStr = array('loginName'=>$_POST['tel'], 'password'=>md5($_POST['psw']),//
                'clientId'=>'8e844e28db7245eb81823132464835eb', 'roleType'=> 0, 'appType'=> 6);
	$url = 'https://sports.lifesense.com/sessions_service/login?version=4.5&systemType=2';
	$cookie_file='';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsonStr));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_COOKIEJAR,  $cookie_file);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
        "User-Agent: Dalvik/2.1.0 (Linux; U; Android 9; SM-G9500 Build/PPR1.180610.011)"
        )
    );
    $response = curl_exec($ch);
    //$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
 
    echo $cookie_file;
    return $response;
}


function update_step(){
	$step=$_POST['step'];//;
	$information=http_post_json();
	$url="https://sports.lifesense.com/sport_service/sport/sport/uploadMobileStepV2?version=4.5&systemType=2";
    $accessToken=json_decode($information,true)["data"]["accessToken"];
    $userId=json_decode($information,true)["data"]["userId"];
    $timeStamp=time();
    $localTime = localtime($timeStamp);
    $strTime = date("Y-m-d H:i:s",$timeStamp);
    $measureTime=$strTime.",".$timeStamp;
    $header = array(
    'Cookie: accessToken='.$accessToken,
    'Content-Type: application/json; charset=utf-8',
    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 9; SM-G9500 Build/PPR1.180610.011)"
    );
    $sport_datas = '{"list":[{
    			"DataSource":2,
				"calories":'.(int)($step/4).',
				"deviceId":"M_NULL",
                 "distance":'.(int)($step/3).',
                 "exerciseTime":0,
                 "isUpload":1,
                 "measurementTime":"'.$measureTime.'",
                 "step":'. $step.',
                 "type":2,
                 "updated":'.getMillisecond().',
                 "userId":'.$userId.'}]
    	}';
    	//var_dump($sport_datas);
     //echo $sport_datas;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $sport_datas);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    $response = curl_exec($ch);
    //$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
 
    echo $response;
    //bind($information);
	
}

function bind($information){
	 $qrcodelist = array('http://we.qq.com/d/AQC7PnaOelOaCg9Ux8c9Ew95yumTVfMcFuGCHMY-', 'http://we.qq.com/d/AQC7PnaOysMBFUhD6sByjYwH2MT12Jf2rqr2kFKm', 'http://we.qq.com/d/AQC7PnaOEcpmVUpHtrZBmRUVq4wOOgKw-gfh6wPj', 'http://we.qq.com/d/AQC7PnaOuG5SHierDiEH2AdZLzMt3W__GL8E1MJj', 'http://we.qq.com/d/AQC7PnaOC0S07XFU-c_R1cpxY1mtf8oiXiDrXET7', 'http://we.qq.com/d/AQC7PnaOoraxuZEdkFyVSO6gaTvMjzEzhEfLRXbE', 'http://we.qq.com/d/AQC7PnaOhQxO8K2EuU44QBZ8cRzB2ofP-oFJSU_6', 'http://we.qq.com/d/AQC7PnaOmwgxedHWCLVr-ZyeoLxHtRrHBGDuyH9E', 'http://we.qq.com/d/AQC7PnaO4am4196RIo98NYn_vPfHN-Y5j-w9FmSN', 'http://we.qq.com/d/AQC7PnaO2WczbXNLV7PzC7V60i7-iOgLha5Bg4cV', 'http://we.qq.com/d/AQC7PnaOZAUJTMxJ6-gbdrWV6y-jHHofCYFl-Jv0',"http://we.qq.com/d/AQC7PnaOelOaCg9Ux8c9Ew95yumTVfMcFuGCHMY-",
                         "http://we.qq.com/d/AQC7PnaOi9BLVrfJIiVTU8ENIbv_9Lmlqia1ToGc",
                         "http://we.qq.com/d/AQC7PnaOXQhy3VvzFeP5bZMKmAQrGE6NJWdK3Xnk",
                         "http://we.qq.com/d/AQC7PnaOaEXBdhkdXQvTRE1CO1fIqBuitbSSGt2r",
                         "http://we.qq.com/d/AQC7PnaOdI9h0tfCr0KRlb78ISAE9qcaZ3btHrJE",
                         "http://we.qq.com/d/AQC7PnaOsThRYksmQcvpa0klKFrupqaqKyEPm8nj",
                         "http://we.qq.com/d/AQC7PnaOk8V-FV7R4ix61GToC5fh5I151hvlsNf5",);
	 $accessToken=json_decode($information,true)["data"]["accessToken"];
     $userId=json_decode($information,true)["data"]["userId"];
	 $header = array(
    'Cookie: accessToken='.$accessToken,
    'Content-Type: application/json; charset=utf-8',
    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 9; SM-G9500 Build/PPR1.180610.011)"
    );
	 foreach ($qrcodelist as $i){
	 	$datas = '{
            "qrcode": "'.$i.'",  
            "userId": "'.$userId.'"
        }';
        $url = 'https://sports.lifesense.com/device_service/device_user/bind';
        $ch = curl_init();
    	curl_setopt($ch, CURLOPT_POST, 1);
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    	$response = curl_exec($ch);
    	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    	curl_close($ch);
    	echo $response;
		$response=json_decode($response,true);
		echo'</br>';
		
		if($response['msg'] == '成功'){
                echo('绑定成功，即将开刷');
                return;}
        else{
                echo('此设备绑定失败,尝试下一个。');
        	echo'</br>';
        }
    
	 }
	 echo('所有设备均无法绑定，请自己寻找可用的qrcode，将连接加入列表qr中进行尝试。');
	 

}
?>

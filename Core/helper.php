<?php

function check_email($data){
	if(preg_match('/^[a-zA-Z0-9\.\-_]+\@[a-zA-Z0-9\.\-_]+\.[a-z]{2,6}$/D',$data)){$result = 1;}else{$result = 0;}
	return $result;
	}
	
function check_integer($data,$param){
	if($param==0){ //only +
		if (preg_match ('/^[0-9]+$/', $data)){$result = 1;}else{$result = 0;}
	}
	elseif($param==1){ //with sub
		if (preg_match ('/^-?[0-9]+$/', $data)){$result = 1;}else{$result = 0;}
	}
	return $result;
}	

function secure_input($data){
	$data = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $data);
	$data = strip_tags($data);
	$data = htmlspecialchars($data);
	return $data;
}

function redirect($data){
	header('Location: '.$data);
	exit;
}

function encrypt($key,$value){
    $mopen = mcrypt_module_open('rijndael-256', '', 'ecb', '');
    $iv_size = mcrypt_enc_get_iv_size($mopen);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);  
    mcrypt_generic_init($mopen, $key, $iv);
    
    return base64_encode(mcrypt_generic($mopen, $value));
}

function decrypt($key,$value){
    $mopen = mcrypt_module_open('rijndael-256', '', 'ecb', '');
    $iv_size = mcrypt_enc_get_iv_size($mopen);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);  
    mcrypt_generic_init($mopen, $key, $iv);
    
    return mdecrypt_generic($mopen, base64_decode($value));
}

function curl_get($url)
{
    $c = curl_init();  
    curl_setopt($c,CURLOPT_URL,$url);
    curl_setopt($c,CURLOPT_RETURNTRANSFER,true);
    $output=curl_exec($c);
    curl_close($c);
   
    return $output;
}
 
function curl_post($url,$params=array())
{
  $postData = '';
   foreach($params as $k => $v) 
   { 
      $postData .= $k . '='.$v.'&'; 
   }
   rtrim($postData, '&');
    $c = curl_init();  
    curl_setopt($c,CURLOPT_URL,$url);
    curl_setopt($c,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($c,CURLOPT_HEADER, false); 
    curl_setopt($c, CURLOPT_POST, count($postData));
    curl_setopt($c, CURLOPT_POSTFIELDS, $postData);    
    $output=curl_exec($c);
    curl_close($c);
    
	return $output;
}

function getIP(){
    return $_SERVER['REMOTE_ADDR'];
}

function genHoursOptionsList(){
    $i=0;
    $result='';
    while($i<25){
        if($i<10){$i='0'.$i;}
        $result .= '<option value="'.$i.'">'.$i.'</option>';
        $i++;
    }
    return $result;
}

function genMinutesOptionsList(){
    $i=0;
    $result='';
    while($i<60){
        if($i<10){$i='0'.$i;}
        $result .= '<option value="'.$i.'">'.$i.'</option>';
        $i++;
    }
    return $result;
}


?>
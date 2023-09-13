<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

	
function encrypt_url($string)
{
	$output = false;
	$secret_key = "pr1m@4ul1@Sumb4r";
	$secret_v = "2303199392301297";
	$encrypt_method = "aes-256-cbc";

	$key = hash("sha256", $secret_key);

	$v = substr(hash("sha256", $secret_v), 0, 16);

	$result = openssl_encrypt($string, $encrypt_method, $key, 0, $v);
	$output = base64_encode($result);
	return $output;

}

function decrypt_url($string)
{
	$output = false;
	$secret_key = "pr1m@4ul1@Sumb4r";
	$secret_v = "2303199392301297";
	$encrypt_method = "aes-256-cbc";

	$key = hash("sha256", $secret_key);

	$v = substr(hash("sha256", $secret_v), 0, 16);

	$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $v);
	return $output;
}
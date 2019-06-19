<?php
/**
 * Created by PhpStorm.
 * User: jlee
 * Date: 3/28/2019
 * Time: 9:43 AM
 */

class Session
{
	public static function createSession() {
		$crypto_strong = null;
		//128 bytes = 1,024 bits of entropy
		$hash = hash("sha256",openssl_random_pseudo_bytes(128,$crypto_strong) );
		if(TRUE !== $crypto_strong){
			throw new Exception("Secure Random Session Data Could Not be Generated!");
		}
		return $hash;
	}
}
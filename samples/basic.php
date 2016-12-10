<?php
require_once __DIR__ . '/../vendor/autoload.php';

$key = 'my secret key';

$valueToSecure = 'test';
$aesKeyGenerator = new \EduSalguero\Zifratu\SecretGenerator\Md5Surrounder();

$encrypter = new \EduSalguero\Zifratu\Encrypter($aesKeyGenerator, $key);
$decrypter = new \EduSalguero\Zifratu\Decrypter($aesKeyGenerator, $key);

$encryptedValue = $encrypter->encrypt($valueToSecure);
$decryptedValue = $decrypter->decrypt($encryptedValue);
$aesKey = $aesKeyGenerator->build($key);
printf('Secret: %s' . PHP_EOL, $key);
printf('Secret hash: %s'.PHP_EOL, $aesKey);
printf('Value to secure: %s' . PHP_EOL, $valueToSecure);
printf('Encrypted value: %s' . PHP_EOL, $encryptedValue);
printf('Decrypted value: %s' . PHP_EOL, $decryptedValue);

/*
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-128'));
$encrypted = openssl_encrypt($valueToSecure, 'AES-128', $aesKey, 0, $iv);

print_r($encrypted);*/
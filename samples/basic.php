<?php
require_once __DIR__ . '/../vendor/autoload.php';

$key = 'my secret key';
$valueToSecure = 'test';
$aesKeyGenerator = new \EduSalguero\Zifratu\KeyGenerator\MySQLSurrounder();

$encrypter = new \EduSalguero\Zifratu\Encrypter($aesKeyGenerator, $key);
$decrypter = new \EduSalguero\Zifratu\Decrypter($aesKeyGenerator, $key);

$encryptedValue = $encrypter->encrypt($valueToSecure);
$decryptedValue = $decrypter->decrypt($encryptedValue);

printf('Secret: %s' . PHP_EOL, $key);
printf('Value to secure: %s' . PHP_EOL, $valueToSecure);
printf('Encrypted value: %s' . PHP_EOL, $encryptedValue);
printf('Decrypted value: %s' . PHP_EOL, $decryptedValue);

[![Build Status](https://travis-ci.org/edusalguero/zifratu.svg?branch=master)](https://travis-ci.org/edusalguero/zifratu)

# Zifratu

Zifratu is a simple PHP library to encrypt and decrypt using AES in a MySQL compatible way

## Usage
```php
<?php

$secret = 'my secret key';
$valueToSecure = 'test';
$zifratu = new \EduSalguero\Zifratu\ZifratuFacade($secret);

$encryptedValue = $zifratu->encrypt($valueToSecure);
$decryptedValue = $zifratu->decrypt($encryptedValue);

printf('Secret: %s' . PHP_EOL, $secret);
printf('Value to secure: %s' . PHP_EOL, $valueToSecure);
printf('Encrypted value: %s' . PHP_EOL, $encryptedValue);
printf('Decrypted value: %s' . PHP_EOL, $decryptedValue);

```

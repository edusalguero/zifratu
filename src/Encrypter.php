<?php


namespace EduSalguero\Zifratu;

use EduSalguero\Zifratu\SecretGenerator\SecretGeneratorInterface;


/**
 * Class Encrypter
 * @package EduSalguero\Zifratu
 */
class Encrypter
{
    /**
     * @var string
     */
    protected $secret;


    /**
     * Encrypter constructor.
     *
     * @param SecretGeneratorInterface $secretGenerator
     * @param string $secret
     */
    public function __construct(SecretGeneratorInterface $secretGenerator, $secret)
    {
        $this->secret = $secretGenerator->build($secret);
    }

    /**
     * Encrypt a string and returns the encripted value in base64
     *
     * @param string $value The value to encrypt
     *
     * @return string
     */
    public function encrypt($value)
    {
        $key = $this->secret;
        $iv = substr($key, 0, 16);

        return base64_encode(openssl_encrypt($value, 'AES128', $key, 0, $iv));
    }


}
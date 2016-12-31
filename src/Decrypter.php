<?php


namespace EduSalguero\Zifratu;

use EduSalguero\Zifratu\SecretGenerator\SecretGeneratorInterface;


/**
 * Class Decrypter
 * @package EduSalguero\Zifratu
 */
class Decrypter
{

    /**
     * @var string
     */
    protected $secret;


    /**
     * Decrypter constructor.
     *
     * @param SecretGeneratorInterface $secretGenerator
     * @param string $secret
     */
    public function __construct(SecretGeneratorInterface $secretGenerator, $secret)
    {
        $this->secret = $secretGenerator->build($secret);
    }

    /**
     * @param string $value Base64 string to decode
     *
     * @return string
     */
    public function decrypt($value)
    {
        $value = base64_decode($value);
        $key = $this->secret;
        $iv = substr($key, 0, 16);

        return openssl_decrypt($value, 'AES128', $key, 0, $iv);
    }

}
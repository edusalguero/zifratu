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
        $value = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $value, MCRYPT_MODE_ECB,
                              mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128,
                                                                  MCRYPT_MODE_ECB),
                                               MCRYPT_DEV_URANDOM));

        return rtrim($value, "\0..\16");
    }

}
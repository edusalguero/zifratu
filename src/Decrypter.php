<?php


namespace EduSalguero\Zifratu;

use EduSalguero\Zifratu\KeyGenerator\AesKeyGeneratorInterface;


/**
 * Class Decrypter
 * @package EduSalguero\Zifratu
 */
class Decrypter
{

    /**
     * @var string
     */
    protected $aesKey;


    /**
     * Decrypter constructor.
     *
     * @param AesKeyGeneratorInterface $aesKeyGenerator
     * @param string $secret
     */
    public function __construct(AesKeyGeneratorInterface $aesKeyGenerator, $secret)
    {
        $this->aesKey = $aesKeyGenerator->build($secret);
    }

    /**
     * @param string $value Base64 string to decode
     *
     * @return string
     */
    public function decrypt($value)
    {
        $value = base64_decode($value);
        $key = $this->aesKey;
        $value = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $value, MCRYPT_MODE_ECB,
                              mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128,
                                                                  MCRYPT_MODE_ECB),
                                               MCRYPT_DEV_URANDOM));

        return rtrim($value, "\0..\16");
    }

}
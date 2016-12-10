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
     * @param string $value The value to encrypt
     *
     * @return string
     */
    public function encrypt($value)
    {
        $key = $this->secret;
        $pad_value = 16 - (strlen($value) % 16);
        $value = str_pad($value, (16 * (floor(strlen($value) / 16) + 1)), chr($pad_value));
        $encryptVal = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $value, MCRYPT_MODE_ECB,
                                     mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128,
                                                                         MCRYPT_MODE_ECB),
                                                      MCRYPT_DEV_URANDOM));

        return base64_encode($encryptVal);
        
    }
    


}
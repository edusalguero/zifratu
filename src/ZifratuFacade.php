<?php


namespace EduSalguero\Zifratu;


/**
 * Class ZifratuFacade
 * @package EduSalguero\Zifratu
 */
class ZifratuFacade
{

    /**
     * @var SecretGenerator\Md5Surrounder
     */
    protected $secretKeyGenerator;
    /**
     * @var string
     */
    private $secret;

    /**
     * ZifratuFacade constructor.
     *
     * @param $secret
     */
    public function __construct($secret)
    {
        $this->secretKeyGenerator = new SecretGenerator\Md5Surrounder();
        $this->secret = $secret;
    }

    /**
     * Encrypt a value with a given secret using AES
     *
     * @param string $value
     *
     * @return string
     */
    public function encrypt($value)
    {
        $decripter = new Encrypter($this->secretKeyGenerator, $this->secret);

        return $decripter->encrypt($value);
    }

    /**
     * Decrypt a value with a given secret using AES
     * @param string $value
     *
     * @return string
     */
    public function decrypt($value)
    {
        $decripter = new Decrypter($this->secretKeyGenerator, $this->secret);

        return $decripter->decrypt($value);
    }
}
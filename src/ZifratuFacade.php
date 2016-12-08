<?php


namespace EduSalguero\Zifratu;


/**
 * Class ZifratuFacade
 * @package EduSalguero\Zifratu
 */
class ZifratuFacade
{

    /**
     * @var KeyGenerator\MySQLSurrounder
     */
    protected $aesKeyGenerator;
    /**
     * @var string
     */
    private $secret;

    /**
     * ZifratuFacade constructor.
     */
    public function __construct($secret)
    {
        $this->aesKeyGenerator = new KeyGenerator\MySQLSurrounder();
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
        $decripter = new Encrypter($this->aesKeyGenerator, $this->secret);

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
        $decripter = new Decrypter($this->aesKeyGenerator, $this->secret);

        return $decripter->decrypt($value);
    }
}
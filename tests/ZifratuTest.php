<?php


namespace EduSalguero\Zifratu\Test;


use EduSalguero\Zifratu\Decrypter;
use EduSalguero\Zifratu\Encrypter;
use EduSalguero\Zifratu\SecretGenerator\Md5Surrounder;
use EduSalguero\Zifratu\ZifratuFacade;
use PHPUnit\Framework\TestCase;

/**
 * Class ZifratuTest
 * @package EduSalguero\Zifratu\Test
 */
class ZifratuTest extends TestCase
{
    /**
     * @return array
     */
    public function configSuccessProvider()
    {
        return [
            ['my secret key', 'test', 'b2pEcFJpdGFIMTJXZVYvM1pINE5Vdz09'],
            ['my aes secret key', 'test', 'WDZPcmtaN1E1cW92Qms5eUxyS0lIQT09'],
            ['mysecretseedingkey', 'foobar', 'YjJXOW8rQU9adkVtRjVBTmJqOXN2Zz09']
        ];
    }

    /**
     * @return array
     */
    public function configFailProvider()
    {
        return [
            ['my secret key', 'test', 'test']
        ];
    }

    /**
     * @dataProvider configSuccessProvider
     *
     * @param $secret
     * @param $decrypted
     * @param $encrypted
     */
    public function test_decrypt_success($secret, $decrypted, $encrypted)
    {
        $aesKey = new  Md5Surrounder();
        $decrypter = new Decrypter($aesKey, $secret);
        $this->assertEquals($decrypted, $decrypter->decrypt($encrypted));

    }

    /**
     * @dataProvider configSuccessProvider
     *
     * @param $secret
     * @param $decrypted
     * @param $encrypted
     */
    public function test_encrypt_success($secret, $decrypted, $encrypted)
    {
        $aesKey = new  Md5Surrounder();
        $encrypter = new Encrypter($aesKey, $secret);
        $this->assertEquals($encrypted, $encrypter->encrypt($decrypted));
    }

    /**
     * @dataProvider configFailProvider
     *
     * @param $secret
     * @param $decrypted
     * @param $encrypted
     */
    public function test_decrypt_fail($secret, $decrypted, $encrypted)
    {
        $aesKey = new  Md5Surrounder();
        $decrypter = new Decrypter($aesKey, $secret);
        $this->assertNotEquals($decrypted, $decrypter->decrypt($encrypted));

    }

    /**
     * @dataProvider configFailProvider
     *
     * @param $secret
     * @param $decrypted
     * @param $encrypted
     */
    public function test_encrypt_fail($secret, $decrypted, $encrypted)
    {
        $aesKey = new  Md5Surrounder();
        $encrypter = new Encrypter($aesKey, $secret);
        $this->assertNotEquals($encrypted, $encrypter->encrypt($decrypted));
    }

    /**
     * @dataProvider configSuccessProvider
     *
     * @param $secret
     * @param $decrypted
     * @param $encrypted
     */
    public function test_facade_sucess($secret, $decrypted, $encrypted)
    {
        $facade = ZifratuFacade::create($secret);
        $this->assertEquals($encrypted,$facade->encrypt($decrypted));
        $this->assertEquals($decrypted,$facade->decrypt($encrypted));
    }

    /**
     * @dataProvider configFailProvider
     *
     * @param $secret
     * @param $decrypted
     * @param $encrypted
     */
    public function test_facade_fail($secret, $decrypted, $encrypted)
    {
        $facade = ZifratuFacade::create($secret);
        $this->assertNotEquals($encrypted,$facade->encrypt($decrypted));
        $this->assertNotEquals($decrypted,$facade->decrypt($encrypted));
    }
}

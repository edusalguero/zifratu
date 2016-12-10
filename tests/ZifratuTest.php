<?php


namespace EduSalguero\Zifratu\Test;


use EduSalguero\Zifratu\Decrypter;
use EduSalguero\Zifratu\Encrypter;
use EduSalguero\Zifratu\SecretGenerator\Md5Surrounder;
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
            ['my secret key', 'test', 'G+/dWZ00ZZxWuT8h1mqJ2g=='],
            ['my aes secret key', 'test', 'xJHq1/OpPxUj7y1sgR0ycA=='],
            ['mysecretseedingkey', 'foobar', 'n93BGuQ3eQTCqiMvcfRoLg==']
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
}

<?php


namespace EduSalguero\Zifratu\Test;


use EduSalguero\Zifratu\Decrypter;
use EduSalguero\Zifratu\Encrypter;
use EduSalguero\Zifratu\KeyGenerator\MySQLSurrounder;
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
            ['my secret key', 'test', 'WqD/0kC6CZTBFxngSaJ5Og=='],
            ['my aes secret key', 'test', 'EYyFji7J7njhKCZH78VbzA=='],
            ['mysecretseedingkey', 'foobar', 'iWSjHbqpoNOPS6p1FsyyZw==']
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
        $aesKey = new  MySQLSurrounder();
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
        $aesKey = new  MySQLSurrounder();
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
        $aesKey = new  MySQLSurrounder();
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
        $aesKey = new  MySQLSurrounder();
        $encrypter = new Encrypter($aesKey, $secret);
        $this->assertNotEquals($encrypted, $encrypter->encrypt($decrypted));
    }
}

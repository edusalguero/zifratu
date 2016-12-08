<?php


namespace EduSalguero\Zifratu\Test;


use EduSalguero\Zifratu\KeyGenerator\MySQLSurrounder;
use PHPUnit\Framework\TestCase;

class AesKeyMySQLStyleGeneratorTest extends TestCase
{

    public function aesProvider()
    {
        return [
           // ['my secure key', 'my secure key'],
            ['Ralf_S_Engelschall__trainofthoughts', 'Vy@9+!>,']
        ];
    }
    /**
     * @expectedException \EduSalguero\Zifratu\Exceptions\EmptyKeyException
     */
    public function test_empty_key_throwsEmptyKeyException()
    {
        $aesKey = new MySQLSurrounder();
        $aesKey->build(null);

    }

    /**
     * @dataProvider aesProvider
     */
    public function test_build_valid_aeskey($originalKey, $aesKey)
    {
        $aesKeyGenerator = new MySQLSurrounder();
        $key = $aesKeyGenerator->build($originalKey);
        // trim the ASCII control characters at the end
        $key = rtrim($key, "\x00..\x1F");
        $aesKey = rtrim($aesKey, "\x00..\x1F");
        $this->assertEquals($aesKey,$key);
    }

    /**
     * @dataProvider aesProvider
     */
    public function test_build_invalid_aeskey()
    {
        $originalKey='originalKey';
        $aesKey='aesKey';
        $aesKeyGenerator = new MySQLSurrounder();
        $key = $aesKeyGenerator->build($originalKey);
        // trim the ASCII control characters at the end
        $key = rtrim($key, "\x00..\x1F");
        $aesKey = rtrim($aesKey, "\x00..\x1F");
        $this->assertNotEquals($aesKey,$key);
    }
}

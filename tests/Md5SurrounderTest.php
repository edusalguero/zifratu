<?php


namespace EduSalguero\Zifratu\Test;


use EduSalguero\Zifratu\SecretGenerator\Md5Surrounder;
use PHPUnit\Framework\TestCase;

class Md5SurrounderTest extends TestCase
{

    public function aesProvider()
    {
        return [
            ['my secure key', '07277b1fcf587cf9a2e8f79b6153dcd3'],
            ['Ralf_S_Engelschall__trainofthoughts', 'e38b2f84981fccddd8cd282c9592f11a']
        ];
    }
    /**
     * @expectedException \EduSalguero\Zifratu\Exceptions\EmptyKeyException
     */
    public function test_empty_key_throwsEmptyKeyException()
    {
        $aesKey = new Md5Surrounder();
        $aesKey->build(null);

    }

    /**
     * @dataProvider aesProvider
     */
    public function test_build_valid_aeskey($originalKey, $md5Key)
    {
        $keyGenerator = new Md5Surrounder();
        $key = $keyGenerator->build($originalKey);
        $this->assertEquals($md5Key,$key);
    }

    /**
     * @dataProvider aesProvider
     */
    public function test_build_invalid_aeskey()
    {
        $originalKey='originalKey';
        $md5Key='hashedKey';
        $keyGenerator = new Md5Surrounder();
        $key = $keyGenerator->build($originalKey);
        $this->assertNotEquals($md5Key,$key);
    }
}

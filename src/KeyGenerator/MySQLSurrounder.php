<?php


namespace EduSalguero\Zifratu\KeyGenerator;

use EduSalguero\Zifratu\Exceptions\EmptyKeyException;


/**
 * Class AesKeyKeyGenerator
 * @package EduSalguero\Zifratu
 */
class MySQLSurrounder implements AesKeyGeneratorInterface
{

    /**
     * @param $originalKey
     *
     * @return string
     * @throws EmptyKeyException
     */
    public function build($originalKey)
    {
        if(empty($originalKey))
        {
            throw  new EmptyKeyException();
        }
        $aesStyleKey = str_repeat(chr(0), 16);
        for($i = 0, $len = strlen($originalKey); $i < $len; $i++)
        {
            $aesStyleKey[$i % 16] = $aesStyleKey[$i % 16] ^ $originalKey[$i];
        }

        return $aesStyleKey; // trim the ASCII control characters at the end
    }

}
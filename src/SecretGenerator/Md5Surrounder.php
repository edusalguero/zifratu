<?php


namespace EduSalguero\Zifratu\SecretGenerator;

use EduSalguero\Zifratu\Exceptions\EmptyKeyException;


/**
 * Class AesKeyKeyGenerator
 * @package EduSalguero\Zifratu
 */
class Md5Surrounder implements SecretGeneratorInterface
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
        return hash('md5', $originalKey);
    }

}
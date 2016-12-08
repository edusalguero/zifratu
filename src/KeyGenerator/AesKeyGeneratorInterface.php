<?php


namespace EduSalguero\Zifratu\KeyGenerator;


/**
 * Interface AesKeyGeneratorInterface
 * @package EduSalguero\Zifratu
 */
interface AesKeyGeneratorInterface
{

    function build($originalKey);
}
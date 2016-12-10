<?php


namespace EduSalguero\Zifratu\SecretGenerator;


/**
 * Interface SecretGeneratorInterface
 * @package EduSalguero\Zifratu
 */
interface SecretGeneratorInterface
{

    function build($originalKey);
}
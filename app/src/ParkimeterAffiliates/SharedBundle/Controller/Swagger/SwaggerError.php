<?php


namespace Bandit\UserBundle\Controller\User\Employer\Swagger;

/**
 * @Swagger\Annotations\Definition(type="object")
 */
class SwaggerError
{
    /**
     * @Swagger\Annotations\Property(format="string", property="message")
     * @var string
     */
    private $message;

    /**
     * @Swagger\Annotations\Property(format="string", property="path")
     * @var string
     */
    private $path;

    public function __construct()
    {
        throw new \Exception("This is Swagger documentation");
    }
}

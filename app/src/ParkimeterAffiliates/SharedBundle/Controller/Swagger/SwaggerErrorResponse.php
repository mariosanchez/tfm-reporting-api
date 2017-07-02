<?php


namespace Bandit\UserBundle\Controller\User\Employer\Swagger;

/**
 * @Swagger\Annotations\Definition(type="object")
 */
class SwaggerErrorResponse
{
    /**
     * @Swagger\Annotations\Property(format="int", property="total")
     * @var int
     */
    private $total;

    /**
     * @Swagger\Annotations\Property(ref="#/definitions/SwaggerErrors", property="_embedded")
     */
    private $embedded;

    public function __construct()
    {
        throw new \Exception("This is Swagger documentation");
    }
}

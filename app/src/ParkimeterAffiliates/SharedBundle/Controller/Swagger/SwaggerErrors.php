<?php


namespace ParkimeterAffiliates\SharedBundle\Controller\Swagger;

/**
 * @Swagger\Annotations\Definition(type="object")
 */
class SwaggerErrors
{
    /**
     * @Swagger\Annotations\Property(ref="#/definitions/SwaggerError", property="errors")
     */
    private $errors;

    public function __construct()
    {
        throw new \Exception("This is Swagger documentation");
    }
}

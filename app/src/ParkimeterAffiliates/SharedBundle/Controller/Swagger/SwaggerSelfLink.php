<?php


namespace ParkimeterAffiliates\SharedBundle\Controller\Swagger;

/**
 * @Swagger\Annotations\Definition
 */
class SwaggerSelfLink
{
    /**
     * @Swagger\Annotations\Property(ref="#/definitions/SwaggerLink", property="self")
     * @var string
     */
    private $self;

    public function __construct()
    {
        throw new \Exception("This is Swagger documentation");
    }
}

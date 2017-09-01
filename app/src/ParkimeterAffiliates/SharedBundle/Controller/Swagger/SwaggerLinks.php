<?php


namespace ParkimeterAffiliates\SharedBundle\Controller\Swagger;

/**
 * @Swagger\Annotations\Definition
 */
class SwaggerLinks
{
    /**
     * @Swagger\Annotations\Property(ref="#/definitions/SwaggerLink", property="self")
     */
    private $self;

    /**
     * @Swagger\Annotations\Property(ref="#/definitions/SwaggerLink", property="first")
     */
    private $first;

    /**
     * @Swagger\Annotations\Property(ref="#/definitions/SwaggerLink", property="prev")
     */
    private $prev;

    /**
     * @Swagger\Annotations\Property(ref="#/definitions/SwaggerLink", property="next")
     */
    private $next;

    /**
     * @Swagger\Annotations\Property(ref="#/definitions/SwaggerLink", property="last")
     */
    private $last;

    public function __construct()
    {
        throw new \Exception("This is Swagger documentation");
    }
}

<?php


namespace ParkimeterAffiliates\AffiliateBundle\Controller\Swagger;

/**
 * @Swagger\Annotations\Definition(type="object")
 */
abstract class SwaggerGetAffiliateSuccessResponse
{
    /**
     * @Swagger\Annotations\Property(format="string", property="id")
     * @var string
     */
    protected $id;

    /**
     * @Swagger\Annotations\Property(format="string", property="name")
     * @var string
     */
    protected $name;

    /**
     * @Swagger\Annotations\Property(format="string", property="last_name")
     * @var string
     */
    protected $lastName;

    /**
     * @Swagger\Annotations\Property(format="string", property="email")
     * @var string
     */
    protected $email;

    /**
     * @Swagger\Annotations\Property(ref="#/definitions/SwaggerSelfLink", property="_links")
     */
    protected $links = [];

    public function __construct()
    {
        throw new \Exception("This is Swagger documentation");
    }
}

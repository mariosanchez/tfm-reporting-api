<?php

namespace ParkimeterAffiliates\AffiliateBundle\Controller\Swagger;

/**
 * @Swagger\Annotations\Definition
 */
class PostAffiliateControllerInputSwagger
{
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
     * PutAffiliateControllerInputSwagger constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        throw new \Exception("This is Swagger documentation");
    }
}

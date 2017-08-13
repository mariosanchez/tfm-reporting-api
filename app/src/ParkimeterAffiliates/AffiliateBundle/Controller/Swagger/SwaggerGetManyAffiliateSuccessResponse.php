<?php

namespace ParkimeterAffiliates\AffiliateBundle\Controller\Swagger;

/**
 * @Swagger\Annotations\Definition(type="object")
 */
class SwaggerGetManyAffiliateSuccessResponse
{
    /**
     * @Swagger\Annotations\Property(format="int", property="count")
     * @var int
     */
    private $count;

    /**
     * @Swagger\Annotations\Property(format="int", property="total")
     * @var int
     */
    private $total;

    /**
     * @Swagger\Annotations\Property(
     *     type="array",
     *     property="_embedded",
     *     @Swagger\Annotations\Items(ref="#/definitions/SwaggerGetAffiliateSuccessResponse")
     * )
     */
    private $embedded = [];

    /**
     * @Swagger\Annotations\Property(
     *     type="array", property="_links",
     *     @Swagger\Annotations\Items(ref="#/definitions/SwaggerLinks")
     * )
     */
    private $links = [];

    public function __construct()
    {
        throw new \Exception("This is Swagger documentation");
    }
}

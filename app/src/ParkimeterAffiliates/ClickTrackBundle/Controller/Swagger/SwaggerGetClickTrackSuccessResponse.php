<?php

namespace ParkimeterAffiliates\AffiliateBundle\Controller\Swagger;

/**
 * @Swagger\Annotations\Definition(type="object")
 */
abstract class SwaggerGetClickTrackSuccessResponse
{
    /**
     * @Swagger\Annotations\Property(format="string", property="id")
     * @var string
     */
    protected $id;

    /**
     * @Swagger\Annotations\Property(format="int", property="affiliate_id")
     * @var int
     */
    protected $affiliateId;

    /**
     * @Swagger\Annotations\Property(format="string", property="affiliate_key")
     * @var string
     */
    protected $affiliateKey;

    /**
     * @Swagger\Annotations\Property(format="string", property="click_id")
     * @var string
     */
    protected $clickId;

    /**
     * @Swagger\Annotations\Property(format="date", property="created_at")
     * @var string
     */
    protected $createdAt;

    /**
     * @Swagger\Annotations\Property(ref="#/definitions/SwaggerSelfLink", property="_links")
     */
    protected $links = [];

    public function __construct()
    {
        throw new \Exception("This is Swagger documentation");
    }
}

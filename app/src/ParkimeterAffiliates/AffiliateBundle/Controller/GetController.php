<?php

namespace ParkimeterAffiliates\AffiliateBundle\Controller;

use ParkimeterAffiliates\Application\Service\Api\Affiliate\GetAffiliate\GetAffiliateRequest;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\GetAffiliate\GetAffiliateService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use NilPortugues\Symfony\HalJsonBundle\Serializer\HalJsonResponseTrait;
use NilPortugues\Symfony\HalJsonBundle\Serializer\HalJsonSerializer as Serializer;

/**
 * Beer controller.
 */
class GetController extends Controller
{
    use HalJsonResponseTrait;

    /**
     * @var GetAffiliateService
     */
    private $service;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * GetAllController constructor.
     * @param ContainerInterface $container
     * @param GetAffiliateService $service
     * @param Serializer $serializer
     */
    public function __construct(
        ContainerInterface $container,
        GetAffiliateService $service,
        Serializer $serializer
    ) {
        $this->service = $service;
        $this->container = $container;
        $this->serializer = $serializer;
    }

    /**
     * @Swagger\Annotations\Get(
     *  path="/affiliates/{id}",
     *  summary="Finds an affiliate by affiliateId.",
     *  operationId="getAffiliate",
     *  produces={"application/json"},
     *  tags={"Affiliates"},
     *  @Swagger\Annotations\Parameter(
     *      name="id",
     *      in="path",
     *      description="Affiliate Id",
     *      required=true,
     *      type="string"
     *  ),
     *
     *  @Swagger\Annotations\Response(
     *     response=200,
     *     description="Success",
     *     @Swagger\Annotations\Schema(ref="#/definitions/SwaggerGetAffiliateSuccessResponse"),
     *  ),
     *  @Swagger\Annotations\Response(
     *     response="400",
     *     description="Bad Request",
     *     @Swagger\Annotations\Schema(ref="#/definitions/SwaggerErrorResponse"),
     *  ),
     *  @Swagger\Annotations\Response(
     *     response="404",
     *     description="Not Found",
     *     @Swagger\Annotations\Schema(ref="#/definitions/SwaggerErrorResponse"),
     *  ),
     *  @Swagger\Annotations\Response(
     *     response="500",
     *     description="Service Unavailable",
     *     @Swagger\Annotations\Schema(ref="#/definitions/SwaggerErrorResponse"),
     *  )
     * )
     *
     * @param $request Request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Request $request)
    {
        $affiliateId = $request->attributes->get('id');
        $dto = new GetAffiliateRequest($affiliateId);

        $affiliate = ($this->service)($dto);

        return $this->response($this->serializer->serialize($affiliate));
    }
}

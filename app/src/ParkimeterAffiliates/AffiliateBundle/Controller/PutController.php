<?php

namespace ParkimeterAffiliates\AffiliateBundle\Controller;

use ParkimeterAffiliates\Application\Service\Api\Affiliate\AffiliateApiException;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\PutAffiliate\PutAffiliateRequest;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\PutAffiliate\PutAffiliateService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use NilPortugues\Symfony\HalJsonBundle\Serializer\HalJsonResponseTrait;
use NilPortugues\Symfony\HalJsonBundle\Serializer\HalJsonSerializer as Serializer;
use ParkimeterAffiliates\Infrastructure\Serializers\JsonVndErrorSerializer as ErrorSerializer;

/**
 * Beer controller.
 */
class PutController extends Controller
{
    use HalJsonResponseTrait;

    /**
     * @var PutAffiliateService
     */
    private $service;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var ErrorSerializer
     */
    private $errorSerializer;

    /**
     * PutController constructor.
     * @param ContainerInterface $container
     * @param PutAffiliateService $service
     * @param Serializer $serializer
     * @param ErrorSerializer $errorSerializer
     */
    public function __construct(
        ContainerInterface $container,
        PutAffiliateService $service,
        Serializer $serializer,
        ErrorSerializer $errorSerializer
    ) {
        $this->service = $service;
        $this->container = $container;
        $this->serializer = $serializer;
        $this->errorSerializer = $errorSerializer;
    }

    /**
     * @Swagger\Annotations\Put(
     *  path="/affiliates/{id}",
     *  summary="Modify all of a affiliate's fields.",
     *  operationId="putAffiliate",
     *  produces={"application/json"},
     *  tags={"Affiliates"},
     *  @Swagger\Annotations\Parameter(
     *      name="id",
     *      in="path",
     *      description="Affiliate Id",
     *      required=true,
     *      type="string"
     *  ),
     *  @Swagger\Annotations\Parameter(
     *      name="body",
     *      in="body",
     *      description="Affiliate object",
     *      required=true,
     *      type="string",
     *      @Swagger\Annotations\Schema(ref="#/definitions/PutAffiliateControllerInputSwagger"),
     *  ),
     *  @Swagger\Annotations\Response(
     *     response=200,
     *     description="Success",
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
    public function putAction(Request $request)
    {
        try {
            $data = json_decode($request->getContent());

            $dto = new PutAffiliateRequest(
                $request->get('id'),
                (property_exists($data, 'name')) ? $data->name : null,
                (property_exists($data, 'last_name')) ? $data->last_name : null,
                (property_exists($data, 'email')) ? $data->email : null
            );

            ($this->service)($dto);
        } catch (AffiliateApiException $e) {
            $output = $this->errorSerializer->serialize($e->errorBag());
            return new Response($output, $e->getCode(), ['Content-type' => 'application/vnd.error+json']);
        }

        return $this->resourceUpdatedResponse('');
    }
}

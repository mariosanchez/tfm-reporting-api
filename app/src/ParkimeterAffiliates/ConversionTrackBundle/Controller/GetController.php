<?php

namespace ParkimeterAffiliates\ConversionTrackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ParkimeterAffiliates\Application\Service\Api\ConversionTrack\GetConversionTrack\GetConversionTrackService;
use ParkimeterAffiliates\Application\Service\Api\ConversionTrack\GetConversionTrack\GetConversionTrackRequest;
use ParkimeterAffiliates\Application\Service\Api\ConversionTrack\ConversionTrackApiException;
use NilPortugues\Symfony\HalJsonBundle\Serializer\HalJsonResponseTrait;
use NilPortugues\Symfony\HalJsonBundle\Serializer\HalJsonSerializer as Serializer;
use ParkimeterAffiliates\Infrastructure\Serializers\JsonVndErrorSerializer as ErrorSerializer;

/**
 * Beer controller.
 */
class GetController extends Controller
{
    use HalJsonResponseTrait;

    /**
     * @var GetConversionTrackService
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
     * GetController constructor.
     * @param ContainerInterface $container
     * @param GetConversionTrackService $service
     * @param Serializer $serializer
     * @param ErrorSerializer $errorSerializer
     */
    public function __construct(
        ContainerInterface $container,
        GetConversionTrackService $service,
        Serializer $serializer,
        ErrorSerializer $errorSerializer
    ) {
        $this->service = $service;
        $this->container = $container;
        $this->serializer = $serializer;
        $this->errorSerializer = $errorSerializer;
    }

    /**
     * @Swagger\Annotations\Get(
     *  path="/conversion-tracks/{id}",
     *  summary="Finds a conversionTrack by conversionTrackId.",
     *  operationId="getConversionTrack",
     *  produces={"application/json"},
     *  tags={"Conversion Tracks"},
     *  @Swagger\Annotations\Parameter(
     *      name="id",
     *      in="path",
     *      description="Conversion Track Id",
     *      required=true,
     *      type="string"
     *  ),
     *
     *  @Swagger\Annotations\Response(
     *     response=200,
     *     description="Success",
     *     @Swagger\Annotations\Schema(ref="#/definitions/SwaggerGetConversionTrackSuccessResponse"),
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
     * @param Request $request
     * @return Response
     */
    public function getAction(Request $request)
    {
        try {
            $affiliateId = $request->attributes->get('id');
            $dto = new GetConversionTrackRequest($affiliateId);

            $affiliate = ($this->service)($dto);
            $output = $this->serializer->serialize($affiliate);
        } catch (ConversionTrackApiException $e) {
            $output = $this->errorSerializer->serialize($e->errorBag());
            return new Response($output, $e->getCode(), ['Content-type' => 'application/vnd.error+json']);
        }

        return $this->response($output);
    }
}

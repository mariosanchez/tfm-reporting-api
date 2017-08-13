<?php

namespace ParkimeterAffiliates\ClickTrackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ParkimeterAffiliates\Application\Service\Api\ClickTrack\GetClickTrack\GetClickTrackService;
use ParkimeterAffiliates\Application\Service\Api\ClickTrack\GetClickTrack\GetClickTrackRequest;
use ParkimeterAffiliates\Application\Service\Api\ClickTrack\ClickTrackApiException;
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
     * @var GetClickTrackService
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
     * @param GetClickTrackService $service
     * @param Serializer $serializer
     * @param ErrorSerializer $errorSerializer
     */
    public function __construct(
        ContainerInterface $container,
        GetClickTrackService $service,
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
     *  path="/click-tracks/{id}",
     *  summary="Finds a clickTrack by clickTrackId.",
     *  operationId="getClickTrack",
     *  produces={"application/json"},
     *  tags={"Click Tracks"},
     *  @Swagger\Annotations\Parameter(
     *      name="id",
     *      in="path",
     *      description="Click Track Id",
     *      required=true,
     *      type="string"
     *  ),
     *
     *  @Swagger\Annotations\Response(
     *     response=200,
     *     description="Success",
     *     @Swagger\Annotations\Schema(ref="#/definitions/SwaggerGetClickTrackSuccessResponse"),
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
            $dto = new GetClickTrackRequest($affiliateId);

            $affiliate = ($this->service)($dto);
            $output = $this->serializer->serialize($affiliate);
        } catch (ClickTrackApiException $e) {
            $output = $this->errorSerializer->serialize($e->errorBag());
            return new Response($output, $e->getCode(), ['Content-type' => 'application/vnd.error+json']);
        }

        return $this->response($output);
    }
}

<?php

namespace ParkimeterAffiliates\ClickTrackBundle\Controller;

use ParkimeterAffiliates\Application\Service\Api\ClickTrack\ClickTrackApiException;
use ParkimeterAffiliates\Application\Service\Api\ClickTrack\GetManyClickTrack\GetManyClickTrackRequest;
use ParkimeterAffiliates\Application\Service\Api\ClickTrack\GetManyClickTrack\GetManyClickTrackResponse;
use ParkimeterAffiliates\Application\Service\Api\ClickTrack\GetManyClickTrack\GetManyClickTrackService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use NilPortugues\Api\Hal\HalPagination;
use NilPortugues\Symfony\HalJsonBundle\Serializer\HalJsonResponseTrait;
use NilPortugues\Symfony\HalJsonBundle\Serializer\HalJsonSerializer as Serializer;
use ParkimeterAffiliates\Infrastructure\Serializers\JsonVndErrorSerializer as ErrorSerializer;

/**
 * Beer controller.
 */
class GetManyController extends Controller
{
    use HalJsonResponseTrait;

    /**
     * @var GetManyClickTrackService
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
     * GetManyController constructor.
     * @param ContainerInterface $container
     * @param GetManyClickTrackService $service
     * @param Serializer $serializer
     * @param ErrorSerializer $errorSerializer
     */
    public function __construct(
        ContainerInterface $container,
        GetManyClickTrackService $service,
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
     *  path="/click-tracks/",
     *  summary="Returns a paginated list of click tracks.",
     *  operationId="getManyClickTrack",
     *  produces={"application/json"},
     *  tags={"Click Tracks"},
     *
     *  @Swagger\Annotations\Parameter(
     *      name="page",
     *      in="query",
     *      description="Page number",
     *      required=true,
     *      type="integer"
     *  ),
     *
     *  @Swagger\Annotations\Parameter(
     *      name="per-page",
     *      in="query",
     *      description="Number of results per page",
     *      required=true,
     *      type="integer"
     *  ),
     *
     *  @Swagger\Annotations\Parameter(
     *      name="affiliate-id",
     *      in="query",
     *      description="Filter by affiliate-id",
     *      required=false,
     *      type="string"
     *  ),
     *
     *  @Swagger\Annotations\Parameter(
     *      name="from-date",
     *      in="query",
     *      description="Filter by a date of being",
     *      required=false,
     *      type="string"
     *  ),
     *
     *  @Swagger\Annotations\Parameter(
     *      name="to-date",
     *      in="query",
     *      description="Filter by a date of end",
     *      required=false,
     *      type="string"
     *  ),
     *
     *  @Swagger\Annotations\Response(
     *     response=200,
     *     description="Success",
     *     @Swagger\Annotations\Schema(ref="#/definitions/SwaggerGetManyClickTrackSuccessResponse"),
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
    public function getManyAction(Request $request)
    {
        try {
            $dto = new GetManyClickTrackRequest(
                $request->get('page', 1),
                $request->get('per-page', 10),
                $request->get('affiliate-id', null),
                $request->get('from-date', null),
                $request->get('to-date', null)
            );

            $response = ($this->service)($dto);

            $page = $this->buildPaginatedResponse($request, $response, 'click_track_get_many');

            $output = $this->serializer->serialize($page);
        } catch (ClickTrackApiException $e) {
            $output = $this->errorSerializer->serialize($e->errorBag());
            return new Response($output, $e->getCode(), ['Content-type' => 'application/vnd.error+json']);
        }

        return $this->response($output);
    }

    /**
     * @param Request $request
     * @param GetManyClickTrackResponse $response
     * @param string $resourceRoute
     * @return HalPagination
     */
    private function buildPaginatedResponse(
        Request $request,
        GetManyClickTrackResponse $response,
        string $resourceRoute
    ): HalPagination {
        $page = new HalPagination();
        $page->setEmbedded($response->content());
        $page->setTotal($response->totalElements());
        $page->setCount(count($response->content()));
        $page->setFirst($this->buildPageUrl($request, $resourceRoute, $response->firstPage()));
        $page->setSelf($this->buildPageUrl($request, $resourceRoute, $response->page()));
        $page->setPrev($this->buildPageUrl($request, $resourceRoute, $response->previousPage()));
        $page->setNext($this->buildPageUrl($request, $resourceRoute, $response->nextPage()));
        $page->setLast($this->buildPageUrl($request, $resourceRoute, $response->totalPages()));

        return $page;
    }

    /**
     * @param Request $request
     * @param string $resourceRoute
     * @param int $pageNumber
     * @return string
     */
    private function buildPageUrl(Request $request, string $resourceRoute, int $pageNumber): string
    {
        parse_str($request->getQueryString(), $queryParams);

        return $this->generateUrl($resourceRoute, array_merge($queryParams, ['page' => $pageNumber]), true);
    }
}

<?php

namespace ParkimeterAffiliates\AffiliateBundle\Controller;

use NilPortugues\Api\Hal\HalPagination;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\AffiliateApiException;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\GetManyAffiliate\GetManyAffiliateRequest;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\GetManyAffiliate\GetManyAffiliateResponse;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\GetManyAffiliate\GetManyAffiliateService;
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
class GetManyController extends Controller
{
    use HalJsonResponseTrait;

    /**
     * @var GetManyAffiliateService
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
     * @param GetManyAffiliateService $service
     * @param Serializer $serializer
     * @param ErrorSerializer $errorSerializer
     */
    public function __construct(
        ContainerInterface $container,
        GetManyAffiliateService $service,
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
     *  path="/affiliates/",
     *  summary="Returns a paginated list of affiliates.",
     *  operationId="getManyAffiliate",
     *  produces={"application/json"},
     *  tags={"Affiliates"},
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
     *  @Swagger\Annotations\Response(
     *     response=200,
     *     description="Success",
     *     @Swagger\Annotations\Schema(ref="#/definitions/SwaggerGetManySuccessResponse"),
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
            $dto = new GetManyAffiliateRequest(
                $request->get('page', 1),
                $request->get('per-page', 10)
            );

            $response = ($this->service)($dto);

            $page = $this->buildPaginatedResponse($request, $response, 'affiliate_get_many');

            $output = $this->serializer->serialize($page);
        } catch (AffiliateApiException $e) {
            $output = $this->errorSerializer->serialize($e->errorBag());
            return new Response($output, $e->getCode(), ['Content-type' => 'application/vnd.error+json']);
        }

        return $this->response($output);
    }

    /**
     * @param Request $request
     * @param GetManyAffiliateResponse $response
     * @param string $resourceRoute
     * @return HalPagination
     */
    private function buildPaginatedResponse(
        Request $request,
        GetManyAffiliateResponse $response,
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

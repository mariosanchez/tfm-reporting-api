<?php

namespace ParkimeterAffiliates\AffiliateBundle\Controller;

use ParkimeterAffiliates\Application\Service\Api\Affiliate\AffiliateApiException;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\PostAffiliate\PostAffiliateService;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\PostAffiliate\PostAffiliateRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use NilPortugues\Symfony\HalJsonBundle\Serializer\HalJsonResponseTrait;
use NilPortugues\Symfony\HalJsonBundle\Serializer\HalJsonSerializer as Serializer;
use ParkimeterAffiliates\Infrastructure\Serializers\JsonVndErrorSerializer as ErrorSerializer;

class PostController extends Controller
{
    use HalJsonResponseTrait;

    /**
     * @var PostAffiliateService
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
     * PostController constructor.
     * @param ContainerInterface $container
     * @param PostAffiliateService $service
     * @param Serializer $serializer
     * @param ErrorSerializer $errorSerializer
     */
    public function __construct(
        ContainerInterface $container,
        PostAffiliateService $service,
        Serializer $serializer,
        ErrorSerializer $errorSerializer
    ) {
        $this->service = $service;
        $this->container = $container;
        $this->serializer = $serializer;
        $this->errorSerializer = $errorSerializer;
    }

    /**
     * @Swagger\Annotations\Post(
     *  path="/affiliates/",
     *  summary="Creates an affiliate",
     *  operationId="postAffiliate",
     *  produces={"application/json"},
     *  tags={"Affiliates"},
     *  @Swagger\Annotations\Parameter(
     *      name="body",
     *      in="body",
     *      description="Affiliate object",
     *      required=true,
     *      type="string",
     *      @Swagger\Annotations\Schema(ref="#/definitions/PostAffiliateControllerInputSwagger"),
     *  ),
     *  @Swagger\Annotations\Response(
     *     response=201,
     *     description="Created",
     *  ),
     *  @Swagger\Annotations\Response(
     *     response="400",
     *     description="Bad Request",
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
    public function postAction(Request $request)
    {
        try {
            $data = json_decode($request->getContent());

            $dto = new PostAffiliateRequest(
                (property_exists($data, 'name')) ? $data->name : null,
                (property_exists($data, 'last_name')) ? $data->last_name : null,
                (property_exists($data, 'email')) ? $data->email : null
            );

            ($this->service)($dto);
        } catch (AffiliateApiException $e) {
            $output = $this->errorSerializer->serialize($e->errorBag());
            return new Response($output, $e->getCode(), ['Content-type' => 'application/vnd.error+json']);
        }

        return $this->resourceCreatedResponse('');
    }
}

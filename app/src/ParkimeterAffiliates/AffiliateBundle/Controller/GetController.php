<?php

namespace ParkimeterAffiliates\AffiliateBundle\Controller;

use ParkimeterAffiliates\Affiliate\Application\Service\Api\Affiliate\GetAffiliate\GetAffiliateRequest;
use ParkimeterAffiliates\Affiliate\Application\Service\Api\Affiliate\GetAffiliate\GetAffiliateService;
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
     * Finds and displays an affiliate entity.
     *
     * @param $request Request
     *
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

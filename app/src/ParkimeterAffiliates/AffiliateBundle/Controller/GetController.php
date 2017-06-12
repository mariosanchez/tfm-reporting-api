<?php

namespace ParkimeterAffiliates\AffiliateBundle\Controller;

use ParkimeterAffiliates\Affiliate\Application\Service\Api\Affiliate\GetAffiliate\GetAffiliateRequest;
use ParkimeterAffiliates\Affiliate\Application\Service\Api\Affiliate\GetAffiliate\GetAffiliateService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Beer controller.
 */
class GetController extends Controller
{

    /**
     * @var GetAffiliateService
     */
    private $service;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * GetAllController constructor.
     * @param ContainerInterface $container
     * @param GetAffiliateService $service
     */
    public function __construct(
        ContainerInterface $container,
        GetAffiliateService $service
    ) {
        $this->service = $service;
        $this->container = $container;
    }

    /**
     * Finds and displays a beer entity.
     *
     * @param $request Request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Request $request)
    {
        $dto = new GetAffiliateRequest($request->attributes->get('id'));

        $result = ($this->service)($dto);

        $response = new Response();
        $response->setContent(json_encode((array)$result));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}

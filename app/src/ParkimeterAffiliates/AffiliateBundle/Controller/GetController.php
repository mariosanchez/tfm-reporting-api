<?php

namespace ParkimeterAffiliates\AffiliateBundle\Controller;

use ParkimeterAffiliates\Affiliate\Application\Service\GetAffiliateService;
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
        $affiliate = ($this->service)([
            'id' => $request->attributes->get('id'),
        ]);

        $response = new Response();
        $response->setContent(json_encode( (array)$affiliate ));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}

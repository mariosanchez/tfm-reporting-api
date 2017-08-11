<?php

namespace ParkimeterAffiliates\Application\Service\Api\Affiliate\GetManyAffiliate;

use Doctrine\ORM\Tools\Pagination\Paginator;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\AffiliateApiException;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\GetAffiliate\GetAffiliateResponse;
use ParkimeterAffiliates\Domain\Model\AffiliateRepository;
use ParkimeterAffiliates\Infrastructure\Persistance\Repository\Doctrine\Utils\PaginatorOffsetCalculator;

final class GetManyAffiliateService
{
    /**
     * @var AffiliateRepository
     */
    private $repository;

    /**
     * @var PaginatorOffsetCalculator
     */
    private $offsetCalculator;

    /**
     * GetManyAffiliateService constructor.
     * @param AffiliateRepository $repository
     * @param PaginatorOffsetCalculator $offsetCalculator
     */
    public function __construct(
        AffiliateRepository $repository,
        PaginatorOffsetCalculator $offsetCalculator
    ) {
        $this->repository = $repository;
        $this->offsetCalculator = $offsetCalculator;
    }

    /**
     * Returns a affiliate by given data
     *
     * @param GetManyAffiliateRequest $request
     * @return GetManyAffiliateResponse
     * @throws AffiliateApiException
     */
    public function __invoke(GetManyAffiliateRequest $request): GetManyAffiliateResponse
    {
        try {
            $offset = ($this->offsetCalculator)($request->page(), $request->perPage());
            $paginator = $this->repository->findAllPaginated(
                $offset,
                $request->perPage()
            );

            return new GetManyAffiliateResponse(
                $this->serializePaginatedResults($paginator),
                $request->page(),
                $request->perPage(),
                $this->calculateTotalPages($paginator, $request->perPage()),
                $this->calculateTotalElements($paginator)
            );
        } catch (\Exception $e) {
            throw AffiliateApiException::fromException($e);
        }
    }

    /**
     * @param Paginator $paginator
     * @return array
     */
    private function serializePaginatedResults(Paginator $paginator): array
    {
        $content = [];
        foreach ($paginator as $affiliate) {
            $content[] = new GetAffiliateResponse(
                $affiliate->getId(),
                $affiliate->getStatusId(),
                $affiliate->getAffiliateKey(),
                $affiliate->getName(),
                $affiliate->getLastName(),
                $affiliate->getEmail()
            );
        }

        return $content;
    }

    /**
     * @param Paginator $paginator
     * @param int $perPage
     * @return int
     */
    private function calculateTotalPages(Paginator $paginator, int $perPage): int
    {
        return count($paginator) / $perPage;
    }

    /**
     * @param Paginator $paginator
     * @return int
     */
    private function calculateTotalElements(Paginator $paginator): int
    {
        return count($paginator);
    }
}

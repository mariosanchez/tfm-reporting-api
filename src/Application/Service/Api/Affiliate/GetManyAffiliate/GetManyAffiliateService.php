<?php

namespace ParkimeterAffiliates\Application\Service\Api\Affiliate\GetManyAffiliate;

use ParkimeterAffiliates\Application\Service\Api\Affiliate\AffiliateApiException;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\GetAffiliate\GetAffiliateResponse;
use ParkimeterAffiliates\Domain\Model\Affiliate\AffiliateRepository;
use ParkimeterAffiliates\Infrastructure\Persistence\Repository\Doctrine\Utils\AffiliateFilterListBuilder;
use ParkimeterAffiliates\Infrastructure\Persistence\Repository\Doctrine\Utils\PaginatorOffsetCalculator;

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
     * @var AffiliateFilterListBuilder
     */
    private $filterListBuilder;

    /**
     * GetManyAffiliateService constructor.
     * @param AffiliateRepository $repository
     * @param PaginatorOffsetCalculator $offsetCalculator
     * @param AffiliateFilterListBuilder $filterListBuilder
     */
    public function __construct(
        AffiliateRepository $repository,
        PaginatorOffsetCalculator $offsetCalculator,
        AffiliateFilterListBuilder $filterListBuilder
    ) {
        $this->repository = $repository;
        $this->offsetCalculator = $offsetCalculator;
        $this->filterListBuilder = $filterListBuilder;
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
            $filters = ($this->filterListBuilder)($request);
            $paginator = $this->repository->findAllPaginated(
                $offset,
                $request->perPage(),
                $filters
            );

            $totalElements = count($paginator);

            return new GetManyAffiliateResponse(
                $this->serializePaginatedResults($paginator),
                $request->page(),
                $request->perPage(),
                $totalElements
            );
        } catch (\Exception $e) {
            throw AffiliateApiException::fromException($e);
        }
    }

    /**
     * @param \Traversable $paginator
     * @return array
     */
    private function serializePaginatedResults(\Traversable $paginator): array
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
}

<?php

namespace ParkimeterAffiliates\Application\Service\Api\ConversionTrack\GetManyConversionTrack;

use Doctrine\ORM\Tools\Pagination\Paginator;
use ParkimeterAffiliates\Application\Service\Api\ConversionTrack\ConversionTrackApiException;
use ParkimeterAffiliates\Application\Service\Api\ConversionTrack\GetConversionTrack\GetConversionTrackResponse;
use ParkimeterAffiliates\Domain\Model\ConversionTrack\ConversionTrackRepository;
use ParkimeterAffiliates\Infrastructure\Persistence\Repository\Doctrine\Utils\PaginatorOffsetCalculator;
use ParkimeterAffiliates\Infrastructure\Persistence\Repository\Doctrine\Utils\TrackFilterListBuilder;

final class GetManyConversionTrackService
{
    /**
     * @var ConversionTrackRepository
     */
    private $repository;

    /**
     * @var PaginatorOffsetCalculator
     */
    private $offsetCalculator;

    /**
     * @var TrackFilterListBuilder
     */
    private $filterListBuilder;

    /**
     * GetManyConversionTrackService constructor.
     * @param ConversionTrackRepository $repository
     * @param PaginatorOffsetCalculator $offsetCalculator
     * @param TrackFilterListBuilder $filterListBuilder
     */
    public function __construct(
        ConversionTrackRepository $repository,
        PaginatorOffsetCalculator $offsetCalculator,
        TrackFilterListBuilder $filterListBuilder
    ) {
        $this->repository = $repository;
        $this->offsetCalculator = $offsetCalculator;
        $this->filterListBuilder = $filterListBuilder;
    }

    /**
     * Returns a affiliate by given data
     *
     * @param GetManyConversionTrackRequest $request
     * @return GetManyConversionTrackResponse
     * @throws ConversionTrackApiException
     */
    public function __invoke(GetManyConversionTrackRequest $request): GetManyConversionTrackResponse
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

            return new GetManyConversionTrackResponse(
                $this->serializePaginatedResults($paginator),
                $request->page(),
                $request->perPage(),
                $totalElements
            );
        } catch (\Exception $e) {
            throw ConversionTrackApiException::fromException($e);
        }
    }

    /**
     * @param Paginator $paginator
     * @return array
     */
    private function serializePaginatedResults(Paginator $paginator): array
    {
        $content = [];
        foreach ($paginator as $conversionTrack) {
            $content[] = new GetConversionTrackResponse(
                $conversionTrack->getId(),
                $conversionTrack->getAffiliateId(),
                $conversionTrack->getAffiliateKey(),
                $conversionTrack->getConversionId(),
                $conversionTrack->getCreatedAt()
            );
        }

        return $content;
    }
}

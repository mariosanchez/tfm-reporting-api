<?php

namespace ParkimeterAffiliates\Application\Service\Api\ClickTrack\GetManyClickTrack;

use Doctrine\ORM\Tools\Pagination\Paginator;
use ParkimeterAffiliates\Application\Service\Api\ClickTrack\ClickTrackApiException;
use ParkimeterAffiliates\Application\Service\Api\ClickTrack\GetClickTrack\GetClickTrackResponse;
use ParkimeterAffiliates\Domain\Model\ClickTrack\ClickTrackRepository;
use ParkimeterAffiliates\Infrastructure\Persistance\Repository\Doctrine\Utils\PaginatorOffsetCalculator;
use ParkimeterAffiliates\Infrastructure\Persistance\Repository\Doctrine\Utils\TrackFilterListBuilder;

final class GetManyClickTrackService
{
    /**
     * @var ClickTrackRepository
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
     * GetManyClickTrackService constructor.
     * @param ClickTrackRepository $repository
     * @param PaginatorOffsetCalculator $offsetCalculator
     * @param TrackFilterListBuilder $filterListBuilder
     */
    public function __construct(
        ClickTrackRepository $repository,
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
     * @param GetManyClickTrackRequest $request
     * @return GetManyClickTrackResponse
     * @throws ClickTrackApiException
     */
    public function __invoke(GetManyClickTrackRequest $request): GetManyClickTrackResponse
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

            return new GetManyClickTrackResponse(
                $this->serializePaginatedResults($paginator),
                $request->page(),
                $request->perPage(),
                $totalElements
            );
        } catch (\Exception $e) {
            throw ClickTrackApiException::fromException($e);
        }
    }

    /**
     * @param Paginator $paginator
     * @return array
     */
    private function serializePaginatedResults(Paginator $paginator): array
    {
        $content = [];
        foreach ($paginator as $clickTrack) {
            $content[] = new GetClickTrackResponse(
                $clickTrack->getId(),
                $clickTrack->getAffiliateId(),
                $clickTrack->getAffiliateKey(),
                $clickTrack->getClickId(),
                $clickTrack->getCreatedAt()
            );
        }

        return $content;
    }
}

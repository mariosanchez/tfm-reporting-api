<?php

namespace ParkimeterAffiliates\Application\Service\Api\CancellationTrack\GetManyCancellationTrack;

use ParkimeterAffiliates\Application\Service\Api\CancellationTrack\CancellationTrackApiException;
use ParkimeterAffiliates\Application\Service\Api\CancellationTrack\GetCancellationTrack\GetCancellationTrackResponse;
use ParkimeterAffiliates\Domain\Model\CancellationTrack\CancellationTrackRepository;
use ParkimeterAffiliates\Infrastructure\Persistence\Repository\Doctrine\Utils\PaginatorOffsetCalculator;
use ParkimeterAffiliates\Infrastructure\Persistence\Repository\Doctrine\Utils\TrackFilterListBuilder;

final class GetManyCancellationTrackService
{
    /**
     * @var CancellationTrackRepository
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
     * GetManyCancellationTrackService constructor.
     * @param CancellationTrackRepository $repository
     * @param PaginatorOffsetCalculator $offsetCalculator
     * @param TrackFilterListBuilder $filterListBuilder
     */
    public function __construct(
        CancellationTrackRepository $repository,
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
     * @param GetManyCancellationTrackRequest $request
     * @return GetManyCancellationTrackResponse
     * @throws CancellationTrackApiException
     */
    public function __invoke(GetManyCancellationTrackRequest $request): GetManyCancellationTrackResponse
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

            return new GetManyCancellationTrackResponse(
                $this->serializePaginatedResults($paginator),
                $request->page(),
                $request->perPage(),
                $totalElements
            );
        } catch (\Exception $e) {
            throw CancellationTrackApiException::fromException($e);
        }
    }

    /**
     * @param \Traversable $paginator
     * @return array
     */
    private function serializePaginatedResults(\Traversable $paginator): array
    {
        $content = [];
        foreach ($paginator as $cancellationTrack) {
            $content[] = new GetCancellationTrackResponse(
                $cancellationTrack->getId(),
                $cancellationTrack->getAffiliateId(),
                $cancellationTrack->getAffiliateKey(),
                $cancellationTrack->getCancellationId(),
                $cancellationTrack->getCreatedAt()
            );
        }

        return $content;
    }
}

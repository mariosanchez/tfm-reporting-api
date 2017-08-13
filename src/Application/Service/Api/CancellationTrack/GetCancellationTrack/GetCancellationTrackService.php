<?php

namespace ParkimeterAffiliates\Application\Service\Api\CancellationTrack\GetCancellationTrack;

use ParkimeterAffiliates\Application\Service\Api\CancellationTrack\CancellationTrackApiException;
use ParkimeterAffiliates\Application\Service\Api\CancellationTrack\GuardCancellationTrackNotFound;
use ParkimeterAffiliates\Domain\Model\CancellationTrack\CancellationTrack;
use ParkimeterAffiliates\Domain\Model\CancellationTrack\CancellationTrackRepository;

final class GetCancellationTrackService
{
    /**
     * @var CancellationTrackRepository
     */
    private $repository;

    /**
     * GetCancellationTrackService constructor.
     * @param CancellationTrackRepository $repository
     */
    public function __construct(
        CancellationTrackRepository $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Returns a cancellation track by given data
     *
     * @param GetCancellationTrackRequest $request
     * @return GetCancellationTrackResponse
     * @throws CancellationTrackApiException
     */
    public function __invoke(GetCancellationTrackRequest $request): GetCancellationTrackResponse
    {
        try {
            $cancellationTrack = $this->repository->findById($request->cancellationTrackId());

            $this->getGuard($request->cancellationTrackId(), $cancellationTrack);

            return new GetCancellationTrackResponse(
                $cancellationTrack->getId(),
                $cancellationTrack->getAffiliateId(),
                $cancellationTrack->getAffiliateKey(),
                $cancellationTrack->getCancellationId(),
                $cancellationTrack->getCreatedAt()
            );
        } catch (\Exception $e) {
            throw CancellationTrackApiException::fromException($e);
        }
    }

    /**
     * @param int $id
     * @param null|CancellationTrack $cancellationTrack
     */
    private function getGuard(int $id, ?CancellationTrack $cancellationTrack):void
    {
        GuardCancellationTrackNotFound::guard($cancellationTrack, $id);
    }
}

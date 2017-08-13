<?php

namespace ParkimeterAffiliates\Application\Service\Api\ClickTrack\GetClickTrack;

use ParkimeterAffiliates\Application\Service\Api\ClickTrack\ClickTrackApiException;
use ParkimeterAffiliates\Application\Service\Api\ClickTrack\GuardClickTrackNotFound;
use ParkimeterAffiliates\Domain\Model\ClickTrack\ClickTrack;
use ParkimeterAffiliates\Domain\Model\ClickTrack\ClickTrackRepository;

final class GetClickTrackService
{
    /**
     * @var ClickTrackRepository
     */
    private $repository;

    /**
     * GetClickTrackService constructor.
     * @param ClickTrackRepository $repository
     */
    public function __construct(
        ClickTrackRepository $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Returns a click track by given data
     *
     * @param GetClickTrackRequest $request
     * @return GetClickTrackResponse
     * @throws ClickTrackApiException
     */
    public function __invoke(GetClickTrackRequest $request): GetClickTrackResponse
    {
        try {
            $clickTrack = $this->repository->findById($request->clickTrackId());

            $this->getGuard($request->clickTrackId(), $clickTrack);

            return new GetClickTrackResponse(
                $clickTrack->getId(),
                $clickTrack->getAffiliateId(),
                $clickTrack->getAffiliateKey(),
                $clickTrack->getClickId(),
                $clickTrack->getCreatedAt()
            );
        } catch (\Exception $e) {
            throw ClickTrackApiException::fromException($e);
        }
    }

    /**
     * @param int $id
     * @param null|ClickTrack $clickTrack
     */
    private function getGuard(int $id, ?ClickTrack $clickTrack):void
    {
        GuardClickTrackNotFound::guard($clickTrack, $id);
    }
}

<?php

namespace ParkimeterAffiliates\Application\Service\Api\ConversionTrack\GetConversionTrack;

use ParkimeterAffiliates\Application\Service\Api\ConversionTrack\ConversionTrackApiException;
use ParkimeterAffiliates\Application\Service\Api\ConversionTrack\GuardConversionTrackNotFound;
use ParkimeterAffiliates\Domain\Model\ConversionTrack\ConversionTrack;
use ParkimeterAffiliates\Domain\Model\ConversionTrack\ConversionTrackRepository;

final class GetConversionTrackService
{
    /**
     * @var ConversionTrackRepository
     */
    private $repository;

    /**
     * GetConversionTrackService constructor.
     * @param ConversionTrackRepository $repository
     */
    public function __construct(
        ConversionTrackRepository $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Returns a conversion track by given data
     *
     * @param GetConversionTrackRequest $request
     * @return GetConversionTrackResponse
     * @throws ConversionTrackApiException
     */
    public function __invoke(GetConversionTrackRequest $request): GetConversionTrackResponse
    {
        try {
            $conversionTrack = $this->repository->findById($request->conversionTrackId());

            $this->getGuard($request->conversionTrackId(), $conversionTrack);

            return new GetConversionTrackResponse(
                $conversionTrack->getId(),
                $conversionTrack->getAffiliateId(),
                $conversionTrack->getAffiliateKey(),
                $conversionTrack->getConversionId(),
                $conversionTrack->getCreatedAt()
            );
        } catch (\Exception $e) {
            throw ConversionTrackApiException::fromException($e);
        }
    }

    /**
     * @param int $id
     * @param null|ConversionTrack $conversionTrack
     */
    private function getGuard(int $id, ?ConversionTrack $conversionTrack):void
    {
        GuardConversionTrackNotFound::guard($conversionTrack, $id);
    }
}

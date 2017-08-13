<?php

namespace ParkimeterAffiliates\Domain\Model\ConversionTrack;

use ParkimeterAffiliates\Domain\DomainException;
use ParkimeterAffiliates\Domain\Model\ErrorBag;

class ConversionTrackException extends DomainException
{
    public const VALIDATOR_ERROR = "Value objects validation failed.";
    public const VALIDATION_ERROR_CODE = 400;

    public const NOT_FOUND_CONVERSION_TRACK_ID_MESSAGE = "Could not find conversion track with id '%s'.";
    public const NOT_FOUND_CONVERSION_TRACK_ID_CODE = 404;

    /** @var ErrorBag */
    private static $errorBag;

    /**
     * @param $attribute
     * @param $message
     * @param $code
     * @return ConversionTrackException
     */
    private static function buildException($attribute, $message, $code): ConversionTrackException
    {
        self::$errorBag = new ErrorBag($message, $code);
        self::$errorBag->add($attribute, $message);

        return new self($message, $code);
    }

    /**
     * @param $id
     * @return ConversionTrackException
     */
    public static function notFound($id)
    {
        $message = sprintf(self::NOT_FOUND_CONVERSION_TRACK_ID_MESSAGE, $id);
        $code = self::NOT_FOUND_CONVERSION_TRACK_ID_CODE;

        return self::buildException('/id', $message, $code);
    }

    /**
     * @param ErrorBag $errorBag
     * @return ConversionTrackException
     */
    public static function errorBagException(ErrorBag $errorBag): ConversionTrackException
    {
        self::$errorBag = $errorBag;

        return new self(self::VALIDATOR_ERROR, self::VALIDATION_ERROR_CODE);
    }

    /**
     * Returns the ErrorBag.
     *
     * @return ErrorBag
     */
    public function errorBag(): ErrorBag
    {
        return self::$errorBag;
    }
}

<?php


namespace ParkimeterAffiliates\Application\Service\Api\ClickTrack;

use ParkimeterAffiliates\Domain\Model\ClickTrack\ClickTrackException;
use ParkimeterAffiliates\Domain\Model\ErrorBag;
use Exception;

final class ClickTrackApiException extends Exception
{
    public const INTERNAL_SERVER_ERROR = 500;
    public const INTERNAL_SERVER_ERROR_MESSAGE = "We cannot resolve your request right now. Please try again later.";

    private $errorBag;

    /**
     * @param Exception $e
     * @return ClickTrackApiException
     * @throws Exception
     */
    public static function fromException(Exception $e): ClickTrackApiException
    {

        if (self::unknownException($e)) {
            $message = self::INTERNAL_SERVER_ERROR_MESSAGE;
            $code = self::INTERNAL_SERVER_ERROR;

            $exception = new self($message, $code);
            $exception->errorBag = new ErrorBag($message, $code);
            $exception->errorBag->add(null, $message);

            return $exception;
        }

        $message = $e->getMessage();
        switch ($e->getCode()) {
            case ClickTrackException::IMMUTABLE_ID_CODE:
            case ClickTrackException::VALIDATION_ERROR_CODE:
                $code = 400;
                break;

            case ClickTrackException::NOT_FOUND_CLICK_TRACK_ID_CODE:
                $code = 404;
                break;
            default:
                $code = 500;
        }

        /** @var ClickTrackException $e */
        $exception = new self($message, $code);
        $exception->errorBag = $e->errorBag();
        return $exception;
    }

    /**
     * @param Exception $e
     * @return bool
     */
    private static function unknownException(Exception $e): bool
    {
        return get_class($e) !== ClickTrackException::class;
    }

    /**
     * @return ErrorBag
     */
    public function errorBag(): ErrorBag
    {
        return ($this->errorBag) ? $this->errorBag : null;
    }
}

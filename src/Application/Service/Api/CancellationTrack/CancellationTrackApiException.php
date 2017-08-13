<?php


namespace ParkimeterAffiliates\Application\Service\Api\CancellationTrack;

use ParkimeterAffiliates\Domain\Model\CancellationTrack\CancellationTrackException;
use ParkimeterAffiliates\Domain\Model\ErrorBag;
use Exception;

final class CancellationTrackApiException extends Exception
{
    public const INTERNAL_SERVER_ERROR = 500;
    public const INTERNAL_SERVER_ERROR_MESSAGE = "We cannot resolve your request right now. Please try again later.";

    private $errorBag;

    /**
     * @param Exception $e
     * @return CancellationTrackApiException
     * @throws Exception
     */
    public static function fromException(Exception $e): CancellationTrackApiException
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
            case CancellationTrackException::VALIDATION_ERROR_CODE:
                $code = 400;
                break;
            case CancellationTrackException::NOT_FOUND_CANCELLATION_TRACK_ID_CODE:
                $code = 404;
                break;
            default:
                $code = 500;
        }

        /** @var CancellationTrackException $e */
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
        return get_class($e) !== CancellationTrackException::class;
    }

    /**
     * @return ErrorBag
     */
    public function errorBag(): ErrorBag
    {
        return ($this->errorBag) ? $this->errorBag : null;
    }
}

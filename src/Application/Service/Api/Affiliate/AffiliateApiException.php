<?php


namespace ParkimeterAffiliates\Application\Service\Api\Affiliate;

use ParkimeterAffiliates\Domain\Model\AffiliateException;
use ParkimeterAffiliates\Domain\Model\ErrorBag;
use Exception;

final class AffiliateApiException extends Exception
{
    public const INTERNAL_SERVER_ERROR = 500;
    public const INTERNAL_SERVER_ERROR_MESSAGE = "We cannot resolve your request right now. Please try again later.";

    private $errorBag;

    /**
     * @param Exception $e
     * @return AffiliateApiException
     * @throws Exception
     */
    public static function fromException(Exception $e): AffiliateApiException
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
            case AffiliateException::INVALID_FIELD1_CODE:
            case AffiliateException::INVALID_FIELD2_CODE:
            case AffiliateException::INVALID_FIELD3_CODE:
            case AffiliateException::IMMUTABLE_ID_CODE:
            case AffiliateException::VALIDATION_ERROR_CODE:
                $code = 400;
                break;

            case AffiliateException::NOT_FOUND_AFFILIATE_ID_CODE:
                $code = 404;
                break;
            default:
                $code = 500;
        }

        /** @var AffiliateException $e */
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
        return get_class($e) !== AffiliateException::class;
    }

    /**
     * @return ErrorBag
     */
    public function errorBag(): ErrorBag
    {
        return ($this->errorBag) ? $this->errorBag : null;
    }
}

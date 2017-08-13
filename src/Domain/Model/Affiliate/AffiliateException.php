<?php

namespace ParkimeterAffiliates\Domain\Model\Affiliate;

use ParkimeterAffiliates\Domain\DomainException;
use ParkimeterAffiliates\Domain\Model\ErrorBag;

class AffiliateException extends DomainException
{
    public const VALIDATOR_ERROR = "Value objects validation failed.";
    public const VALIDATION_ERROR_CODE = 400;

    public const INVALID_NAME_MESSAGE = "Provided value '%s' is considered an empty value or invalid.";
    public const INVALID_NAME_CODE = 1001;

    public const INVALID_LAST_NAME_MESSAGE = "Provided value '%s' is considered an empty value or invalid.";
    public const INVALID_LAST_NAME_CODE = 1002;

    public const INVALID_EMAIL_MESSAGE = "Provided value '%s' is considered an empty value or invalid.";
    public const INVALID_EMAIL_CODE = 1003;

    public const IMMUTABLE_ID_MESSAGE = "Identity value cannot be changed.";
    public const IMMUTABLE_ID_CODE = 1000;

    public const NOT_FOUND_AFFILIATE_ID_MESSAGE = "Could not find affiliate with id '%s'.";
    public const NOT_FOUND_AFFILIATE_ID_CODE = 404;

    public const NOT_RESTORE_AFFILIATE_ID_MESSAGE = "Could not restore affiliate with id '%s'.";
    public const NOT_RESTORE_AFFILIATE_ID_CODE = 404;

    public const OUT_OF_RANGE_MESSAGE = "Out of bounds. Page number '%s' could not be found.";
    public const OUT_OF_RANGE_CODE = 1005;


    /** @var ErrorBag */
    private static $errorBag;

    /**
     * @param $attribute
     * @param $message
     * @param $code
     * @return AffiliateException
     */
    private static function buildException($attribute, $message, $code): AffiliateException
    {
        self::$errorBag = new ErrorBag($message, $code);
        self::$errorBag->add($attribute, $message);

        return new self($message, $code);
    }

    /**
     * @param $value
     * @return AffiliateException
     */
    public static function immutableAffiliateId($value)
    {
        $message = sprintf(self::IMMUTABLE_ID_MESSAGE, $value);
        $code = self::IMMUTABLE_ID_CODE;

        return self::buildException('/id', $message, $code);
    }

    /**
     * @param $id
     * @return AffiliateException
     */
    public static function notFound($id)
    {
        $message = sprintf(self::NOT_FOUND_AFFILIATE_ID_MESSAGE, $id);
        $code = self::NOT_FOUND_AFFILIATE_ID_CODE;

        return self::buildException('/id', $message, $code);
    }

    /**
     * @param $id
     * @return AffiliateException
     */
    public static function notRestore($id)
    {
        $message = sprintf(self::NOT_RESTORE_AFFILIATE_ID_MESSAGE, $id);
        $code = self::NOT_RESTORE_AFFILIATE_ID_CODE;

        return self::buildException('/id', $message, $code);
    }

    /**
     * @param ErrorBag $errorBag
     * @return AffiliateException
     */
    public static function errorBagException(ErrorBag $errorBag): AffiliateException
    {
        self::$errorBag = $errorBag;

        return new self(self::VALIDATOR_ERROR, self::VALIDATION_ERROR_CODE);
    }

    /**
     * @param $value
     * @return AffiliateException
     */
    public static function nameIsInvalid($value): AffiliateException
    {
        $message = sprintf(self::INVALID_NAME_MESSAGE, $value);
        $code = self::INVALID_NAME_CODE;

        return self::buildException('/name', $message, $code);
    }

    /**
     * @param $value
     * @return AffiliateException
     */
    public static function lastNameIsInvalid($value): AffiliateException
    {
        $message = sprintf(self::INVALID_LAST_NAME_MESSAGE, $value);
        $code = self::INVALID_LAST_NAME_CODE;

        return self::buildException('/last_name', $message, $code);
    }

    /**
     * @param $value
     * @return AffiliateException
     */
    public static function emailIsInvalid($value): AffiliateException
    {
        $message = sprintf(self::INVALID_EMAIL_MESSAGE, $value);
        $code = self::INVALID_EMAIL_CODE;

        return self::buildException('/email', $message, $code);
    }

    public static function outOfRangeException($pageNumber)
    {
        $message = sprintf(self::OUT_OF_RANGE_MESSAGE, $pageNumber);
        $code = self::OUT_OF_RANGE_CODE;

        return self::buildException('?page', $message, $code);
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

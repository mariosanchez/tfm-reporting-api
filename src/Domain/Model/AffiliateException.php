<?php

namespace ParkimeterAffiliates\Domain\Model;

use ParkimeterAffiliates\Domain\AffiliateDomainException;

class AffiliateException extends AffiliateDomainException
{
    public const VALIDATOR_ERROR = "Value objects validation failed.";
    public const VALIDATION_ERROR_CODE = 400;

    public const INVALID_FIELD1_MESSAGE = "Provided value '%s' is considered an empty value.";
    public const INVALID_FIELD1_CODE = 1001;

    public const INVALID_FIELD2_MESSAGE = "Provided value '%s' is considered an empty value.";
    public const INVALID_FIELD2_CODE = 1002;

    public const INVALID_FIELD3_MESSAGE = "Provided value '%s' is considered an empty value.";
    public const INVALID_FIELD3_CODE = 1003;

    public const IMMUTABLE_ID_MESSAGE = "Identity value cannot be changed.";
    public const IMMUTABLE_ID_CODE = 1000;

    public const INVALID_AFFILIATE_ID_MESSAGE = "Provided identifier '%s' is not valid.";
    public const INVALID_AFFILIATE_ID_MESSAGE_CODE = 1004;

    public const NOT_FOUND_AFFILIATE_ID_MESSAGE = "Could not find affiliate with id '%s'.";
    public const NOT_FOUND_AFFILIATE_ID_CODE = 404;

    public const NOT_RESTORE_AFFILIATE_ID_MESSAGE = "Could not restore affiliate with id '%s'.";
    public const NOT_RESTORE_AFFILIATE_ID_CODE = 404;

    public const OUT_OF_RANGE_MESSAGE = "Out of bounds. Page number '%s' could not be found.";
    public const OUT_OF_RANGE_CODE = 1005;


    /** @var ErrorBag */
    private static $errorBag;

    /**
     * @param $value
     * @return AffiliateException
     */
    public static function invalidAffiliateId($value)
    {
        $message = sprintf(self::INVALID_AFFILIATE_ID_MESSAGE, $value);
        $code = self::INVALID_FIELD1_CODE;
        return self::buildException('/id', $message, $code);
    }

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
    public static function fieldOneIsEmpty($value): AffiliateException
    {
        $message = sprintf(self::INVALID_FIELD1_MESSAGE, $value);
        $code = self::INVALID_FIELD1_CODE;

        return self::buildException('/field1', $message, $code);
    }

    /**
     * @param $value
     * @return AffiliateException
     */
    public static function fieldTwoIsEmpty($value): AffiliateException
    {
        $message = sprintf(self::INVALID_FIELD2_MESSAGE, $value);
        $code = self::INVALID_FIELD2_CODE;

        return self::buildException('/field2', $message, $code);
    }

    /**
     * @param $value
     * @return AffiliateException
     */
    public static function fieldThreeIsEmpty($value): AffiliateException
    {
        $message = sprintf(self::INVALID_FIELD3_MESSAGE, $value);
        $code = self::INVALID_FIELD3_CODE;

        return self::buildException('/field3', $message, $code);
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

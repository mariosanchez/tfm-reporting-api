<?php

namespace ParkimeterAffiliates\Infrastructure\Serializers;

use ParkimeterAffiliates\Domain\Model\Error;
use ParkimeterAffiliates\Domain\Model\ErrorBag;

final class JsonVndErrorSerializer
{
    public function serialize(ErrorBag $errorCollection): string
    {
        $errors = array_map(
            [$this, 'serializeError'],
            $errorCollection->errors()
        );

        $vndError = [
            'total' => count($errorCollection->errors()),
            '_embedded' => ['errors' => $errors]
        ];

        return json_encode($vndError);
    }

    private function serializeError(Error $error): array
    {
        $serializedError = [
            'message' => $error->value()
        ];

        if (null != $error->key()) {
            $serializedError['path'] = $this->prepend($this->camelCaseToUnderscore($error->key()));
        }

        return $serializedError;
    }

    private function camelCaseToUnderscore($camel, $splitter = '_'): string
    {
        $camel = \preg_replace(
            '/(?!^)[[:upper:]][[:lower:]]/',
            '$0',
            \preg_replace('/(?!^)[[:upper:]]+/', $splitter.'$0', $camel)
        );

        return \strtolower($camel);
    }

    private function prepend($value): string
    {
        if ($value[0] == '?') {
            return $value;
        }

        if ($value[0] == '/') {
            return $value;
        }

        return '/'.$value;
    }
}

<?php

namespace HomeeApi\Entity;

use DateTime;
use DateTimeInterface;
use Exception;
use ReflectionException;
use ReflectionProperty;

trait PropertyFactoryTrait
{

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    protected static function setProperty(object $node, string $property, $value): void
    {
        /** @noinspection DuplicatedCode */
        $reflectionProperty = new ReflectionProperty($node, $property);
        $propertyType = $reflectionProperty->getType()->getName();
        if ($propertyType == DateTimeInterface::class) {
            if (is_numeric($value)) {
                $node->$property = new DateTime();
                $node->$property->setTimestamp($value);
            } else {
                $node->$property = new DateTime($value);
            }
        } elseif ($propertyType == 'int') {
            $node->$property = (int)$value;
        } elseif ($propertyType == 'float') {
            $node->$property = (float)$value;
        } elseif ($propertyType == 'string') {
            $node->$property = urldecode((string) $value);
        } else {
            $node->$property = $value;
        }
    }
}

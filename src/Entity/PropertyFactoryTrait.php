<?php

namespace HomeeApi\Entity;

use DateTime;
use DateTimeInterface;
use ReflectionException;

trait PropertyFactoryTrait
{

    /**
     * @throws ReflectionException
     */
    protected static function setProperty(object &$node, string $property, $value): void
    {
        /** @noinspection DuplicatedCode */
        $reflectionProperty = new \ReflectionProperty($node, $property);
        $propertyType = $reflectionProperty->getType()->getName();
        if ($propertyType == DateTimeInterface::class) {
            $node->$property = new DateTime();
            $node->$property->setTimestamp($value);
        } elseif ($propertyType == 'int') {
            $node->$property = (int)$value;
        } elseif ($propertyType == 'float') {
            $node->$property = (float)$value;
        } elseif ($propertyType == 'string') {
            $node->$property = urldecode($value);
        } else {
            $node->$property = $value;
        }
    }

}

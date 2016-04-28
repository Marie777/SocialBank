<?php

namespace AppBundle\DBAL;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class MaritalStatus extends Type {
    const ENUM_MARITAL_STATUS = "enummaritalstatus";
    const MARRIED = "married";
    const SINGLE = "single";
    const DIVORCED = "divorced";

    /**
     * Gets the SQL declaration snippet for a field of this type.
     *
     * @param array $fieldDeclaration The field declaration.
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform The currently used database platform.
     *
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return "ENUM('married', 'single', 'divorced') COMMENT '(DC2Type:enummaritalstatus)'";
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!in_array($value, array(static::MARRIED, static::SINGLE, static::DIVORCED))) {
            throw new \InvalidArgumentException("Invalid status");
        }
        return $value;
    }

    /**
     * Gets the name of this type.
     *
     * @return string
     */
    public function getName()
    {
        return static::ENUM_MARITAL_STATUS;
    }
}
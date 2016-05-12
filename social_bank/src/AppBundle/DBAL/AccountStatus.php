<?php

namespace AppBundle\DBAL;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class AccountStatus extends Type {
    const ENUM_ACCOUNT_STATUS = "enum_account_status";
    const ENABLED = "enabled";
    const DISABLED = "disabled";
    const PENDING = "pending";
    const PENDING_DISABLE = "pending_disable";

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
        return "ENUM('enabled', 'disabled', 'pending', 'pending_disable') COMMENT '(DC2Type:enum_account_status)'";
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!in_array($value, array(static::ENABLED, static::DISABLED, static::PENDING, static::PENDING_DISABLE))) {
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
        return static::ENUM_ACCOUNT_STATUS;
    }
}
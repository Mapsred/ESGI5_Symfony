<?php

namespace App\Configuration;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationAnnotation;

/**
 * @Annotation
 */
class CharacterRequired extends ConfigurationAnnotation
{
    /**
     * Returns the annotation alias name.
     *
     * @return string
     *
     * @see ConfigurationInterface
     */
    public function getAliasName(): string
    {
        return 'character';
    }

    /**
     * Multiple ParamConverters are allowed.
     *
     * @return bool
     *
     * @see ConfigurationInterface
     */
    public function allowArray(): bool
    {
        return false;
    }
}

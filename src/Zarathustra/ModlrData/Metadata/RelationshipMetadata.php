<?php

namespace Zarathustra\ModlrData\Metadata;

use Zarathustra\ModlrData\Exception\MetadataException;

/**
 * Defines metadata for a relationship field.
 * Should be loaded using the MetadataFactory, not instantiated directly.
 *
 * @author Jacob Bare <jbare@southcomm.com>
 */
class RelationshipMetadata extends FieldMetadata
{
    /**
     * The entity type this is related to.
     *
     * @var string
     */
    public $entityType;

    /**
     * The relationship type: one or many
     *
     * @var string
     */
    public $relType;

    /**
     * Determines if this is an inverse (non-owning) relationship.
     *
     * @var bool
     */
    public $isInverse = false;

    /**
     * Constructor.
     *
     * @param   string  $relType   The relationship type.
     */
    public function __construct($key, $relType, $entityType)
    {
        parent::__construct($key);
        $this->setRelType($relType);
        $this->entityType = $entityType;
    }

    /**
     * Gets the entity type that this field is related to.
     *
     * @return  string
     */
    public function getEntityType()
    {
        return $this->entityType;
    }

    /**
     * Gets the relationship type.
     *
     * @return  string
     */
    public function getRelType()
    {
        return $this->relType;
    }

    /**
     * Determines if this is a one (single) relationship.
     *
     * @return  bool
     */
    public function isOne()
    {
        return 'one' === $this->getRelType();
    }

    /**
     * Determines if this is a many relationship.
     *
     * @return bool
     */
    public function isMany()
    {
        return 'many' === $this->getRelType();
    }

    /**
     * Sets the relationship type: one or many.
     *
     * @param   string  $relType
     * @return  self
     */
    public function setRelType($relType)
    {
        $this->validateType($relType);
        $this->relType = $relType;
        return $this;
    }

    /**
     * Validates the relationship type.
     *
     * @param   string  $type
     * @return  bool
     * @throws  MetadataException
     */
    protected function validateType($relType)
    {
        $valid = ['one', 'many'];
        if (!in_array($relType, $valid)) {
            throw MetadataException::invalidRelType($relType, $valid);
        }
        return true;
    }
}

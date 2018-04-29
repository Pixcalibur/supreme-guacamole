<?php

namespace Hero\Entity\EntityStat;

class FixedStrategy implements GeneratorStartegyInterface
{
    /**
     * @var integer
     */
    private $value;
    
    /**
     * @param int $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }
    
    /**
     * @inheritdoc
     */
    public function getValue(): int
    {
        return $this->value;
    }
}

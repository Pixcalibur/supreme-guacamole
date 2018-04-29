<?php

namespace Hero\Entity\EntityStat;

class RandomRangeStartegy implements GeneratorStartegyInterface
{
    /**
     * @var int 
     */
    private $from;
    
    /**
     * @var int 
     */
    private $to;
    
    /**
     * @param int $from
     * @param to  $to
     */
    public function __construct($from, $to) 
    {
        $this->from = $from;
        $this->to = $to;
    }
    
    /**
     * @return int
     */
    public function getValue(): int 
    {
        return rand($this->from, $this->to);
    }

}

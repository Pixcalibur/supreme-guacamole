<?php

namespace Hero\DamageCalculator;

class DamageCalculatorRule
{
    const OPERAND_ADD = '+';
    const OPERAND_SUB = '-';
    const OPERAND_MUL = '*';
    const OPERAND_DIV = '/';
    
    /**
     * @var string 
     */
    private $operand;
    
    /**
     * @var int
     */
    private $value;
    
    public function __construct($operand, $value)
    {
        $this->operand = $operand;
        $this->value = $value;
        
        $this->validate();
    }
    
    /**
     * @throws \Exception
     */
    public function validate()
    {
        $reflectionClass = new \ReflectionClass($this);
        $allowedOperands = $reflectionClass->getConstants();
        
        if(!in_array($this->operand, $allowedOperands)) {
            throw new \Exception(sprintf('Illegal operand: %s', $this->operand));
        }
        
        if (self::OPERAND_DIV === $this->operand && 0 === $this->value) {
            throw new \Exception(sprintf('Illegal value (%d) for operand: %s', $this->value, $this->operand));
        } 
    }
    
    /**
     * @param integer $value
     * 
     * @return integer
     */
    public function apply($value) 
    {
        switch ($this->operand) {
            case DamageCalculatorRule::OPERAND_ADD:
                return $value + $this->value;
            case DamageCalculatorRule::OPERAND_SUB:
                return $value - $this->value;
            case DamageCalculatorRule::OPERAND_MUL:
                return $value * $this->value;
            case DamageCalculatorRule::OPERAND_DIV:
                return $value / $this->value;
        }
    }
}

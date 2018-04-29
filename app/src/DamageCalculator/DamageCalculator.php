<?php

namespace Hero\DamageCalculator;

use \Hero\DamageCalculator\DamageCalculatorRule;

class DamageCalculator
{        
    /**
     * @var DamageCalculatorRule[]
     */
    private $rules = [];
        
    /**
     * 
     * @param DamageCalculatorRule $rule
     */
    public function addRule(DamageCalculatorRule $rule)
    {
        $this->rules[] = $rule;
    }
    
    /**
     * @param DamageCalculatorRule[] $rules
     */
    public function addRules($rules)
    {
        foreach($rules as $rule) {
            $this->addRule($rule);
        }
    }
    
    /**
     * @return int
     */
    public function calculateValue()
    {
        $value = 0;
        foreach ($this->rules as $rule) {
            $value = $rule->apply($value);
        }
        
        return intVal($value);
    }
    
    /**
     * @return void
     */
    public function reset()
    {
        $this->rules = [];
    }
    
}

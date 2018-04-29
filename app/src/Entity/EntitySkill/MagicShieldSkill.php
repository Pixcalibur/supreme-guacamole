<?php

namespace Hero\Entity\EntitySkill;

use Hero\DamageCalculator\DamageCalculatorRule;

class MagicShieldSkill extends DamageModifierSkill
{
    
    const NAME = 'Magic Shield';
    
    /**
     * @var bool 
     */
    private $active = false;
    
    /**
     * @var int 
     */
    private $activationChance = 20;
        
    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive();
    }
    
    /**
     * @return string
     */
    public function getSkillName(): string
    {
        return self::NAME;
    }
    
    /**
     * @return bool
     */
    public function canActivate(): bool
    {
        return $this->activationChance >= mt_rand(0, 100);
    }

    public function getDamageCalculatorRules() 
    {
        return [
            new DamageCalculatorRule(DamageCalculatorRule::OPERAND_MUL, 0.5)
        ];
    }

}

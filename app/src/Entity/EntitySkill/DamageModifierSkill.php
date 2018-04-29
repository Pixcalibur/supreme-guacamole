<?php

namespace Hero\Entity\EntitySkill;

use \Hero\DamageCalculator\DamageCalculatorRule;

abstract class DamageModifierSkill implements EntitySkillInterface
{
    /**
     * @return DamageCalculatorRule[]
     */
    abstract public function getDamageCalculatorRules();
}

<?php

namespace Hero\Action;

use Hero\Service\BattleLogger;
use Hero\DamageCalculator\DamageCalculator;
use Hero\DamageCalculator\DamageCalculatorRule;
use Hero\Entity\Entity;

class AttackAction implements ActionInterface
{
    /**
     * @inheritdocs
     */
    public function resolve(Entity $origin, Entity $target)
    {
        BattleLogger::log(
            '%s attacks %s!',
            $origin->getName(),
            $target->getName()
        );
        
        $damageCalculator = new DamageCalculator();
        $damageCalculator->addRules(
            [
            new DamageCalculatorRule(DamageCalculatorRule::OPERAND_ADD, $origin->getStrenght()),
            new DamageCalculatorRule(DamageCalculatorRule::OPERAND_SUB, $target->getDefence()),
            ]
        );
        
        if (mt_rand(0, 100) >= $target->getLuck()) {
            $target->defend($damageCalculator);
        } else {
            BattleLogger::log(
                '%s dodges the blow! (%d health left)',
                $target->getName(),
                $target->getHealth()
            );
        }
    }
}

<?php

namespace Hero\Combat;

use Hero\Action\ActionQueue;
use Hero\Action\AttackAction;
use Hero\Entity\Entity;
use Hero\Entity\EntitySkill\AddActionSkill;
use Hero\Entity\EntitySkill\EntitySkillInterface;
use Hero\Service\BattleLogger;
use InvalidArgumentException;

final class Combat
{
    const EXPECTED_ENTITIES_NUM = 2;
    const MAX_TURNS = 20;
    
    /**
     * @var int
     */
    private $turnNumber = 0;
        
    /**
     * @var Entity
     */
    private $attacker;
    
    /**
     * @var Entity
     */
    private $defender;
    
    /**
     * @param Entity[] $entities
     */
    public function __construct($entities)
    {
        if (count($entities) !== self::EXPECTED_ENTITIES_NUM) {
            throw new InvalidArgumentException(
                sprintf('Illegal number of entities passed: $d', count($entities))
            );
        }
        
        $this->resolveStartingRoles(array_shift($entities), array_shift($entities));
    }
    
    /**
     * @return Entity
     */
    public function getAttacker(): Entity
    {
        return $this->attacker;
    }
    
    /**
     * @return Entity
     */
    public function getDefender(): Entity
    {
        return $this->defender;
    }
        
    /**
     * @param Entity $first
     * @param Entity $second
     *
     * @return void
     */
    private function resolveStartingRoles($first, $second)
    {
        $speedComparisonResult = $first->getSpeed() <=> $second->getSpeed();
        
        if (0 === $speedComparisonResult) {
            $luckComparisonResult = $first->getLuck() <=> $second->getLuck();
            if (0 === $luckComparisonResult) {
                $this->assignRoles($first, $second);
            } elseif (-1 === $luckComparisonResult) {
                $this->assignRoles($second, $first);
            } else {
                $this->assignRoles($first, $second);
            }
        } elseif (-1 === $speedComparisonResult) {
            $this->assignRoles($second, $first);
        } else {
            $this->assignRoles($first, $second);
        }

        BattleLogger::log(
            "\n%s--VS--\n%s",
            $this->attacker,
            $this->defender
        );
        
        BattleLogger::log(
            '%s is the first to act.',
            $this->attacker->getName()
        );
    }
    
    /**
     * @param Entity $attacker
     * @param Entity $defender
     */
    private function assignRoles(Entity $attacker, Entity $defender)
    {
        $this->attacker = $attacker;
        $this->defender = $defender;
    }
    
    /**
     * @return void
     */
    private function switchRoles()
    {
        $temp = clone $this->attacker;
        $this->attacker = $this->defender;
        $this->defender = $temp;
    }
    
    /**
     * @return void
     */
    public function resolveCombat()
    {
        while (!$this->isGameOver()) {
            $this->resolveTurn();
        }
    }
    
    /**
     * @return void
     */
    private function resolveTurn()
    {
        BattleLogger::log("\n-- Turn %d --\n", $this->turnNumber + 1);
        
        $actionQueue = new ActionQueue();
        $actionQueue->addAction(
            new AttackAction()
        );
        
        foreach ($this->attacker->getSkills() as $skill) {
            if (EntitySkillInterface::TRIGGER_ON_ATTACK === $skill->triggerOn()
                && $skill instanceof AddActionSkill
                && $skill->canActivate()
            ) {
                BattleLogger::log(
                    '%s activates %s!',
                    $this->attacker->getName(),
                    $skill->getSkillName()
                );
                $actionQueue->addAction($skill->getAction());
            }
        }
                
        $actionQueue->resolveQueue($this->attacker, $this->defender);
        
        $this->endTurn();
    }
    
    /**
     * @return void
     */
    private function endTurn()
    {
        $this->turnNumber++;
        $this->switchRoles();
    }
    
    /**
     * @return boolean
     */
    private function isGameOver()
    {
        if (self::MAX_TURNS <= $this->turnNumber) {
            BattleLogger::log('The battle is over!');
            return true;
        }
        
        if (!$this->attacker->isAlive()) {
            BattleLogger::log(
                '%s won the battle!',
                $this->defender->getName()
            );
            return true;
        }
        
        if (!$this->defender->isAlive()) {
            BattleLogger::log(
                '%s won the battle!',
                $this->attacker->getName()
            );
            return true;
        }
        
        return false;
    }
}

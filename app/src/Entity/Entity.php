<?php

namespace Hero\Entity;

use Hero\DamageCalculator\DamageCalculator;
use Hero\Entity\EntitySkill\DamageModifierSkill;
use Hero\Entity\EntitySkill\EntitySkillInterface;
use Hero\Service\BattleLogger;

class Entity
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $health;
    
    /**
     * @var int
     */
    private $strenght;
    
    /**
     * @var int
     */
    private $defence;
    
    /**
     * @var int
     */
    private $speed;
    
    /**
     * @var int
     */
    private $luck;
    
    /**
     * @var EntitySkillInterface[]
     */
    private $skills;
    
    /**
     * @param string                 $name
     * @param int                    $health
     * @param int                    $strength
     * @param int                    $defence
     * @param int                    $speed
     * @param int                    $luck
     * @param EntitySkillInterface[] $skills
     */
    public function __construct(
        $name,
        $health,
        $strength,
        $defence,
        $speed,
        $luck,
        $skills = []
    ) {
        $this->name = $name;
        $this->health = $health;
        $this->strenght = $strength;
        $this->defence = $defence;
        $this->speed = $speed;
        $this->luck = $luck;
        
        $this->skills = $skills;
    }
    
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    
    /**
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * @return int
     */
    public function getStrenght(): int
    {
        return $this->strenght;
    }

    /**
     * @return int
     */
    public function getDefence(): int
    {
        return $this->defence;
    }

    /**
     * @return int
     */
    public function getSpeed(): int
    {
        return $this->speed;
    }

    /**
     * @return int
     */
    public function getLuck(): int
    {
        return $this->luck;
    }

    /**
     * @param int $health
     */
    public function setHealth($health)
    {
        $this->health = $health;
    }

    /**
     * @param int $strenght
     */
    public function setStrenght($strenght)
    {
        $this->strenght = $strenght;
    }
    
    /**
     * @param int $defence
     */
    public function setDefence($defence)
    {
        $this->defence = $defence;
    }
    
    /**
     * @param int $speed
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;
    }
    
    /**
     * @param int $luck
     */
    public function setLuck($luck)
    {
        $this->luck = $luck;
    }
    
    /**
     * @return EntitySkillInterface[]
     */
    public function getSkills()
    {
        return $this->skills;
    }
    
    /**
     * @return bool
     */
    public function isAlive(): bool
    {
        return $this->getHealth() > 0;
    }
        
    /**
     * @param DamageCalculator $damageCalculator
     */
    public function defend(DamageCalculator $damageCalculator)
    {
        foreach ($this->getSkills() as $skill) {
            if (EntitySkillInterface::TRIGGER_ON_DEFEND === $skill->triggerOn()
                && $skill instanceof DamageModifierSkill
                && $skill->canActivate()
            ) {
                BattleLogger::log(
                    '%s activates %s!',
                    $this->getName(),
                    $skill->getSkillName()
                );
                $damageCalculator->addRules($skill->getDamageCalculatorRules());
            }
        }
        
        $damage = $damageCalculator->calculateValue();
        $this->setHealth($this->getHealth() - $damage);
        
        BattleLogger::log(
            '%s received %d damage! (%d health left)',
            $this->getName(),
            $damage,
            $this->getHealth()
        );
    }
    
    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            "%s\nHP: %d\nSTR: %d\nDEF: %d\nSPD: %d\nLCK: %d%%\n",
            $this->getName(),
            $this->getHealth(),
            $this->getStrenght(),
            $this->getDefence(),
            $this->getSpeed(),
            $this->getLuck()
        );
    }
}

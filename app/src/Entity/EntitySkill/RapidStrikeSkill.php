<?php

namespace Hero\Entity\EntitySkill;

use Hero\Action\ActionInterface;
use Hero\Action\AttackAction;

class RapidStrikeSkill extends AddActionSkill
{
    const NAME = 'Rapid Strike';
        
    /**
     * @var int
     */
    private $activationChance = 10;
    
    /**
     * @inheritdoc
     */
    public function triggerOn(): string
    {
        return EntitySkillInterface::TRIGGER_ON_ATTACK;
    }
    
    /**
     * @inheritdoc
     */
    public function canActivate(): bool
    {
        return $this->activationChance >= mt_rand(0, 100);
    }

    /**
     * @inheritdoc
     */
    public function getAction(): ActionInterface
    {
        return new AttackAction();
    }

    /**
     * @inheritdoc
     */
    public function getSkillName(): string
    {
        return self::NAME;
    }
}

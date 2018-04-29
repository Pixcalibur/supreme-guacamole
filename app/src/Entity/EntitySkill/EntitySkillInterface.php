<?php

namespace Hero\Entity\EntitySkill;

interface EntitySkillInterface
{
     
    // TODO move
    const TRIGGER_ON_DEFEND = 'on_defend';
    const TRIGGER_ON_ATTACK = 'on_attack';
    
    /**
     * @return string
     */
    public function triggerOn(): string;
    
    /**
     * @return string
     */
    public function getSkillName(): string;
    
    /**
     * @return bool
     */
    public function canActivate(): bool;
}

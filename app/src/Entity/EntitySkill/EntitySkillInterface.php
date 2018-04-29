<?php

namespace Hero\Entity\EntitySkill;

interface EntitySkillInterface
{        
    /**
     * @return string
     */
    public function getSkillName(): string;
    
    /**
     * @return bool
     */
    public function canActivate(): bool;
    
}


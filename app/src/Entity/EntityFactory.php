<?php

namespace Hero\Entity;

use Hero\Entity\EntityStat\GeneratorStartegyInterface;
use Hero\Entity\EntitySkill\EntitySkillInterface;
use Hero\Entity\Entity;

class EntityFactory 
{
    
/**
 * 
 * @param string                        $name
 * @param GeneratorStartegyInterface    $health
 * @param GeneratorStartegyInterface    $strength
 * @param GeneratorStartegyInterface    $defence
 * @param GeneratorStartegyInterface    $speed
 * @param GeneratorStartegyInterface    $luck
 * @param EntitySkillInterface[]|null   $skills
 * 
 * @return Entity
 */
    public static function createEntity(
        $name,
        GeneratorStartegyInterface $health,
        GeneratorStartegyInterface $strength,
        GeneratorStartegyInterface $defence,
        GeneratorStartegyInterface $speed,
        GeneratorStartegyInterface $luck,
        $skills = []
    ) {
        $entity = new Entity(
            $name,
            $health->getValue(),
            $strength->getValue(),
            $defence->getValue(),
            $speed->getValue(),
            $luck->getValue(),
            $skills
        );
        
        return $entity;
    }
}

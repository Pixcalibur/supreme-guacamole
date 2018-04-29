<?php

namespace Hero\Entity\EntitySkill;

use Hero\Action\ActionInterface;

abstract class AddActionSkill implements EntitySkillInterface
{
    /**
     * @return ActionInterface
     */
    abstract function getAction();
}

<?php

namespace Hero\Action;

use Hero\Entity\Entity;

interface ActionInterface
{
    public function resolve(Entity $origin, Entity $target);
}

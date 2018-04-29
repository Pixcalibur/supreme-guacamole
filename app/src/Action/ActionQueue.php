<?php

namespace Hero\Action;

use Hero\Action\ActionInterface;
use Hero\Entity\Entity;

class ActionQueue
{
    /**
     * @var ActionInterface[]
     */
    private $actions;
    
    /**
     * @var integer 
     */
    private $currentActionIndex = 0;
    
    public function __construct()
    {
        $this->actions = [];
    }
    
    /**
     * @param ActionInterface $action
     */
    public function addAction(ActionInterface $action)
    {
        $this->actions[] = $action;
    }
       
    /**
     * @return bool
     */
    public function isQueueResolved(): bool
    {
        return true === empty($this->actions);
    }
    
    /**
     * @param Entity $origin
     * @param Entity $target
     * 
     * @return type
     */
    public function resolveQueue(Entity $origin, Entity $target)
    {
        while(!$this->isQueueResolved()) {
            $this->resolveQueueAction($origin, $target);
        }
    }
    
    /**
     * @param Entity $origin
     * @param Entity $target
     * 
     * @return type
     */
    private function resolveQueueAction(Entity $origin, Entity $target)
    {
        $action = array_shift($this->actions);
        $action->resolve($origin, $target);
    }
}

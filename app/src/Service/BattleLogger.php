<?php

namespace Hero\Service;

class BattleLogger
{
    public static function log()
    {
        if (!LOG) {
            return;
        }
        
        $args = func_get_args();
        $message = array_shift($args);
        
        echo vsprintf($message, $args). PHP_EOL;
    }
}

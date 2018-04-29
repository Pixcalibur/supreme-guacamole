<?php

namespace Hero;

use Hero\Combat\Combat;
use Hero\Entity\EntitySkill\MagicShieldSkill;
use Hero\Entity\EntitySkill\RapidStrikeSkill;
use Hero\Entity\EntityStat\RandomRangeStartegy;
use Hero\Factory\EntityFactory;

class App
{
    public function run()
    {
        $hero = EntityFactory::createEntity(
            'Orderus',
            new RandomRangeStartegy(70, 100),
            new RandomRangeStartegy(70, 80),
            new RandomRangeStartegy(45, 55),
            new RandomRangeStartegy(40, 50),
            new RandomRangeStartegy(10, 30),
            [
                new MagicShieldSkill(),
                new RapidStrikeSkill()
            ]
        );

        $enemy = EntityFactory::createEntity(
            'Wild Beast',
            new RandomRangeStartegy(60, 90),
            new RandomRangeStartegy(60, 90),
            new RandomRangeStartegy(40, 60),
            new RandomRangeStartegy(40, 60),
            new RandomRangeStartegy(25, 40)
        );

        $combat = new Combat([$hero, $enemy]);
        $combat->resolveCombat();
    }
}

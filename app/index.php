<?php

error_reporting(E_ALL);

require_once '__bootstrap.php';

$hero = Hero\Entity\EntityFactory::createEntity(
    'Orderus', 
    new Hero\Entity\EntityStat\RandomRangeStartegy(70, 100),
    new Hero\Entity\EntityStat\RandomRangeStartegy(70, 80),
    new Hero\Entity\EntityStat\RandomRangeStartegy(45, 55),
    new Hero\Entity\EntityStat\RandomRangeStartegy(40, 50),
    new Hero\Entity\EntityStat\RandomRangeStartegy(10, 30),
    [
        new Hero\Entity\EntitySkill\MagicShieldSkill(),
        new \Hero\Entity\EntitySkill\RapidStrikeSkill()
    ]
);

$enemy = Hero\Entity\EntityFactory::createEntity(
    'Wild Beast', 
    new Hero\Entity\EntityStat\RandomRangeStartegy(60, 90),
    new Hero\Entity\EntityStat\RandomRangeStartegy(60, 90),
    new Hero\Entity\EntityStat\RandomRangeStartegy(40, 60),
    new Hero\Entity\EntityStat\RandomRangeStartegy(40, 60),
    new Hero\Entity\EntityStat\RandomRangeStartegy(25, 40)
);

$combat = new Hero\Combat\Combat([$hero, $enemy]);
$combat->resolveCombat();
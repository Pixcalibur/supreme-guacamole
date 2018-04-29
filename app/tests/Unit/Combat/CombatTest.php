<?php

use Hero\Entity\Entity;
use PHPUnit\Framework\TestCase;

final class CombatTest extends TestCase 
{
    
    public function testNoEntities()
    {
        $this->expectException(InvalidArgumentException::class);
        new Hero\Combat\Combat([]);
    }
    
    public function testInvalidNumberOfEntities()
    {
        $this->expectException(InvalidArgumentException::class);
        new Hero\Combat\Combat([1, 2, 3]);
    }
    
    /**
     * @dataProvider resolveStartingRolesProvider
     */
    public function testResolveStartingRoles(
        Entity $first, 
        Entity $second,
        string $startingEntityName
    ) {
        $combat = new Hero\Combat\Combat([$first, $second]);
        $this->assertEquals($startingEntityName, $combat->getAttacker()->getName());
    }
    
    public function resolveStartingRolesProvider()
    {
        return [
            [
                new Entity('1', 0, 0, 0, 100, 0),
                new Entity('2', 0, 0, 0, 1, 0),
                '1'
            ],
            [
                new Entity('1', 0, 0, 0, 1, 0),
                new Entity('2', 0, 0, 0, 100, 0),
                '2'
            ],
            [
                new Entity('1', 0, 0, 0, 1, 100),
                new Entity('2', 0, 0, 0, 1, 1),
                '1'
            ],
            [
                new Entity('1', 0, 0, 0, 1, 1),
                new Entity('2', 0, 0, 0, 1, 100),
                '2'
            ],
            [
                new Entity('1', 0, 0, 0, 1, 1),
                new Entity('2', 0, 0, 0, 1, 1),
                '1'
            ],
        ];
    }
    
}

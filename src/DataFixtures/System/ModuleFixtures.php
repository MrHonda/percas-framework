<?php

namespace Percas\DataFixtures\System;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Percas\Entity\System\Module;

class ModuleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            $module = new Module();
            $module
                ->setName('Module ' . $i)
                ->setLink('/module-' . $i);

            $manager->persist($module);
        }

        $manager->flush();
    }
}

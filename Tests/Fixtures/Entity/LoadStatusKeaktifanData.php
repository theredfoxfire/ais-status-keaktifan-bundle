<?php

namespace Ais\StatusKeaktifanBundle\Tests\Fixtures\Entity;

use Ais\StatusKeaktifanBundle\Entity\StatusKeaktifan;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadStatusKeaktifanData implements FixtureInterface
{
    static public $status_keaktifans = array();

    public function load(ObjectManager $manager)
    {
        $status_keaktifan = new StatusKeaktifan();
        $status_keaktifan->setTitle('title');
        $status_keaktifan->setBody('body');

        $manager->persist($status_keaktifan);
        $manager->flush();

        self::$status_keaktifans[] = $status_keaktifan;
    }
}

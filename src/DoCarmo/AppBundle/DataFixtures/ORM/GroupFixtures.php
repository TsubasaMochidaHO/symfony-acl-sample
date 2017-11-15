<?php
namespace DoCarmo\AppBundle\DataFixtures\ORM;

use DoCarmo\AppBundle\Entity\Group;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class GroupFixtures
 */
class GroupFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $groups = [
            "group-tesseract" => "tesseract",
            "group-eigen" => "eigen"
        ];

        foreach ($groups as $ref => $name) {
            $group = new Group();
            $group->setName($name);

            $manager->persist($group);
            $manager->flush();

            $this->addReference($ref, $group);
        }
    }
}

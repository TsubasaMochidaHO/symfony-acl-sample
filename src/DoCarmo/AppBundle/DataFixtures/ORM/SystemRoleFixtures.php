<?php

namespace DoCarmo\AppBundle\DataFixtures\ORM;

use DoCarmo\AppBundle\Entity\SystemRole;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class SystemRoleFixtures
 * @author yourname
 */
class SystemRoleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $roles = [
            "role-admin" => "ROLE_ADMIN",
            "role-user" => "ROLE_USER"
        ];

        foreach ($roles as $reference => $role) {
            $systemRole = new SystemRole();
            $systemRole->setName($role);

            $manager->persist($systemRole);
            $manager->flush();

            $this->addReference($reference, $systemRole);
        }
    }
}

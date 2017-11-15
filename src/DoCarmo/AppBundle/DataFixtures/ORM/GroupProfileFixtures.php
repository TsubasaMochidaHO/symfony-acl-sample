<?php
namespace DoCarmo\AppBundle\DataFixtures\ORM;

use DoCarmo\AppBundle\Entity\GroupProfile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class GroupProfileFixtures
 */
class GroupProfileFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $groupRole = $this->getReference("group-role-tesseract-owner");
        $tesseractOwner = new GroupProfile();
        $tesseractOwner->setProfile($this->getReference("profile-tesseract-owner"))
            ->setGroupRole($groupRole)
            ->setGroup($groupRole->getGroup());
        $manager->persist($tesseractOwner);

        $groupRole = $this->getReference("group-role-tesseract-user");
        $tesseractUser = new GroupProfile();
        $tesseractUser->setProfile($this->getReference("profile-tesseract-user"))
            ->setGroupRole($groupRole)
            ->setGroup($groupRole->getGroup());
        $manager->persist($tesseractUser);

        $groupRole = $this->getReference("group-role-eigen-owner");
        $eigenOwner = new GroupProfile();
        $eigenOwner->setProfile($this->getReference("profile-eigen-owner"))
            ->setGroupRole($groupRole)
            ->setGroup($groupRole->getGroup());
        $manager->persist($eigenOwner);

        $groupRole = $this->getReference("group-role-eigen-user");
        $eigenUser = new GroupProfile();
        $eigenUser->setProfile($this->getReference("profile-eigen-user"))
            ->setGroupRole($groupRole)
            ->setGroup($groupRole->getGroup());
        $manager->persist($eigenUser);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProfileFixtures::class,
            GroupRoleFixtures::class
        ];
    }
}

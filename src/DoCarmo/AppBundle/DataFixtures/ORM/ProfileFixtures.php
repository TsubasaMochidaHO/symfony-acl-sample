<?php
namespace DoCarmo\AppBundle\DataFixtures\ORM;

use DoCarmo\AppBundle\Entity\Profile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class ProfileFixtures
 */
class ProfileFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $profile = new Profile();
        $profile->setUser($this->getReference("user-admin"));
        $profile->setSystemRole($this->getReference("role-admin"));
        $manager->persist($profile);
        $manager->flush();

        $profile = new Profile();
        $profile->setUser($this->getReference("user-tesseract"));
        $profile->setSystemRole($this->getReference("role-user"));
        $manager->persist($profile);
        $manager->flush();
        $this->addReference("profile-tesseract-owner", $profile);

        $profile = new Profile();
        $profile->setUser($this->getReference("user-foo"));
        $profile->setSystemRole($this->getReference("role-user"));
        $manager->persist($profile);
        $manager->flush();
        $this->addReference("profile-tesseract-user", $profile);

        $profile = new Profile();
        $profile->setUser($this->getReference("user-eigen"));
        $profile->setSystemRole($this->getReference("role-user"));
        $manager->persist($profile);
        $manager->flush();
        $this->addReference("profile-eigen-owner", $profile);

        $profile = new Profile();
        $profile->setUser($this->getReference("user-bar"));
        $profile->setSystemRole($this->getReference("role-user"));
        $manager->persist($profile);
        $manager->flush();
        $this->addReference("profile-eigen-user", $profile);
    }

    public function getDependencies()
    {
        return [
            SystemRoleFixtures::class,
            UserFixtures::class
        ];
    }
}

<?php

namespace DoCarmo\AppBundle\DataFixtures\ORM;

use DoCarmo\AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class UserFixtures
 * @author yourname
 */
class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $encoder = $this->container->get("security.password_encoder");

        $adminUser = new User();
        $adminUser->setUsername("admin")
            ->setEmail("admin@example.com")
            ->setIsActive(true)
            ->setSalt(md5(uniqid("")))
            ->setPassword(
                $encoder->encodePassword($adminUser, "admin")
            );
        $manager->persist($adminUser);

        $tesseractUser = new User();
        $tesseractUser->setUsername("tesseract")
            ->setEmail("tesseract@example.com")
            ->setIsActive(true)
            ->setSalt(md5(uniqid("")))
            ->setPassword(
                $encoder->encodePassword($tesseractUser, "tesseract")
            );
        $manager->persist($tesseractUser);

        $fooUser = new User();
        $fooUser->setUsername("foo")
            ->setEmail("foo@example.com")
            ->setIsActive(true)
            ->setSalt(md5(uniqid("")))
            ->setPassword(
                $encoder->encodePassword($fooUser, "foo")
            );
        $manager->persist($fooUser);

        $eigenUser = new User();
        $eigenUser->setUsername("eigen")
            ->setEmail("eigen@example.com")
            ->setIsActive(true)
            ->setSalt(md5(uniqid("")))
            ->setPassword(
                $encoder->encodePassword($eigenUser, "eigen")
            );
        $manager->persist($eigenUser);

        $barUser = new User();
        $barUser->setUsername("bar")
            ->setEmail("bar@example.com")
            ->setIsActive(true)
            ->setSalt(md5(uniqid("")))
            ->setPassword(
                $encoder->encodePassword($barUser, "bar")
            );
        $manager->persist($barUser);

        $manager->flush();
        $this->addReference('user-admin', $adminUser);
        $this->addReference('user-tesseract', $tesseractUser);
        $this->addReference('user-foo', $fooUser);
        $this->addReference('user-eigen', $eigenUser);
        $this->addReference('user-bar', $barUser);
    }
}

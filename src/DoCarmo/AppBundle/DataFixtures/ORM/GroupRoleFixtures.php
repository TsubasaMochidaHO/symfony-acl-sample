<?php
namespace DoCarmo\AppBundle\DataFixtures\ORM;

use DoCarmo\AppBundle\Entity\GroupRole;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;

/**
 * Class GroupRoleFixtures
 */
class GroupRoleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $groupRoles = [
            "group-tesseract" => [
                "group-role-tesseract-owner" => "role_tesseract_owner",
                "group-role-tesseract-user" => "role_tesseract_user"
            ],
            "group-eigen" => [
                "group-role-eigen-owner" => "role_eigen_owner",
                "group-role-eigen-user" => "role_eigen_user"
            ]
        ];

        foreach ($groupRoles as $groupRef => $roles) {
            foreach ($roles as $ref => $role) {
                $groupRole = new GroupRole();
                $groupRole->setGroup($this->getReference($groupRef));
                $groupRole->setName($role);

                $manager->persist($groupRole);
                $manager->flush();

                $this->addReference($ref, $groupRole);
            }
        };

        $maskBuilder = new MaskBuilder();
        $ownerMask = $maskBuilder->add('owner')->get();
        $maskBuilder->reset();
        $userMask = $maskBuilder->add('view')->get();

        $group = $this->getReference("group-tesseract");
        $ownerRole = $this->getReference("group-role-tesseract-owner");
        $userRole = $this->getReference("group-role-tesseract-user");

        $acl = $this->createAcl($group);
        $this->updateAcl($acl, $ownerRole, $ownerMask);
        $this->updateAcl($acl, $userRole, $userMask);

        $group = $this->getReference("group-eigen");
        $ownerRole = $this->getReference("group-role-eigen-owner");
        $userRole = $this->getReference("group-role-eigen-user");

        $acl = $this->createAcl($group);
        $this->updateAcl($acl, $ownerRole, $ownerMask);
        $this->updateAcl($acl, $userRole, $userMask);
    }

    /**
     * Create an ACL
     *
     * @return Acl
     */
    protected function createAcl($object)
    {
        $aclProvider = $this->container->get("security.acl.provider");

        $objectIdentity = ObjectIdentity::fromDomainObject($object);
        $acl = $aclProvider->createAcl($objectIdentity);

        return $acl;
    }

    /**
     * Create an ACL
     *
     * @return GroupRoleFixtures
     */
    protected function updateAcl($acl, $identity, $mask)
    {
        $aclProvider = $this->container->get("security.acl.provider");
        $securityIdentity = new RoleSecurityIdentity($identity);
        $acl->insertObjectAce($securityIdentity, $mask);
        $aclProvider->updateAcl($acl);

        return $this;
    }

    public function getDependencies()
    {
        return [
            GroupFixtures::class
        ];
    }
}

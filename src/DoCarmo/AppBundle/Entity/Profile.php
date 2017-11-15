<?php

namespace DoCarmo\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="profile")
 * @ORM\Entity(repositoryClass="DoCarmo\AppBundle\Repository\ProfileRepository")
 *
 * Profile
 */
class Profile
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="profile")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     * @var User
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="SystemRole", inversedBy="profiles")
     * @ORM\JoinColumn(name="system_role_id", referencedColumnName="id")
     *
     * @var SystemRole
     */
    protected $systemRole;

    /**
     * @ORM\OneToMany(targetEntity="GroupProfile", mappedBy="profile")
     *
     * @var Doctrine\Common\Collections\ArrayCollection
     */
    protected $groupProfiles;

    /**
     * @ORM\OneToOne(targetEntity="GroupProfile")
     * @ORM\JoinColumn(name="group_profile_in_use", referencedColumnName="id")
     *
     * @var GroupProfile
     */
    protected $groupProfile;

    /**
     * Profile ctor
     */
    public function __construct()
    {
        $this->groupProfiles = new ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Profile
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param User $user The profile owner
     *
     * @return Profile
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get groupProfiles
     *
     * @return ArrayCollection
     */
    public function getGroupProfiles()
    {
        return $this->groupProfiles;
    }

    /**
     * Get groupProfile
     *
     * @return GroupProfile
     */
    public function getGroupProfile()
    {
        return $this->groupProfile;
    }

    /**
     * Set systemRole
     *
     * @param SystemRole $systemRole The profile role
     *
     * @return void
     */
    public function setSystemRole(SystemRole $systemRole = null)
    {
        $this->systemRole = $systemRole;

        return $this;
    }

    /**
     * Get systemRole
     *
     * @return SystemRole
     */
    public function getSystemRole()
    {
        return $this->systemRole;
    }
}

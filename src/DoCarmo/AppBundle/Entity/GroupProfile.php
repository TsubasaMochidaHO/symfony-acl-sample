<?php

namespace DoCarmo\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="group_profile")
 * @ORM\Entity(repositoryClass="DoCarmo\AppBundle\Repository\GroupProfileRepository")
 *
 * GroupProfile
 */
class GroupProfile implements \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="GroupRole", inversedBy="groupProfile")
     *
     * @var GroupRole
     */
    protected $groupRole;

    /**
     * @ORM\ManyToOne(targetEntity="Profile", inversedBy="groupProfiles")
     * @ORM\JoinColumn(name="profile_id", referencedColumnName="id")
     *
     * @var Profile
     */
    protected $profile;

    /**
     * @ORM\ManyToOne(targetEntity="Group", inversedBy="groupProfiles")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     *
     * @var Group
     */
    protected $group;

    /**
     * GroupProfile ctor
     */
    public function __contruct()
    {
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
     * Set profile
     *
     * @param Profile $profile The User Profile that will be linked to the
     *                         Group Profile
     *
     * @return GroupProfile
     */
    public function setProfile(Profile $profile)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Set group
     *
     * @return Group $group The group that this profile belongs to
     *
     * @return GroupProfile
     */
    public function setGroup(Group $group)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get groupRole
     *
     * @return GroupRole
     */
    public function getGroupRole()
    {
        return $this->groupRole;
    }

    /**
     * Set groupRole
     *
     * @param GroupRole $groupRole The group role of the GroupProfile
     *
     * @return GroupProfile
     */
    public function setGroupRole(GroupRole $groupRole)
    {
        $this->groupRole = $groupRole;

        return $this;
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(
            [
                $this->id
            ]
        );
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list(
            $this->id
        ) = unserialize($serialized);
    }
}

<?php

namespace DoCarmo\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="group_role")
 * @ORM\Entity(repositoryClass="DoCarmo\AppBundle\Repository\GroupRoleRepository")
 *
 * GroupRole
 */
class GroupRole implements \Serializable
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
     * @ORM\ManyToOne(targetEntity="Group", inversedBy="groupRoles")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     *
     * @var Group
     */
    protected $group;

    /**
     * @ORM\OneToOne(targetEntity="GroupProfile", mappedBy="groupRole")
     *
     * @var GroupProfile
     */
    protected $groupProfile;

    /**
     * @ORM\Column(type="string", length=128, unique=true, nullable=false)
     *
     * @var string
     */
    protected $name;

    /**
     * GroupRole ctor
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
     * Set name
     *
     * @param string $name The group role name
     *
     * @return GroupRole
     */
    public function setName($name)
    {
        $this->name = strtoupper($name);

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set group
     *
     * @param Group $group The group that owns the role
     *
     * @return GroupRole
     */
    public function setGroup(Group $group)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return Group
     */
    public function getGroup()
    {
        return $this->group;
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

    /**
     * GroupRole to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}

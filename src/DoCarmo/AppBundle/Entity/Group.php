<?php

namespace DoCarmo\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="`group`")
 * @ORM\Entity(repositoryClass="DoCarmo\AppBundle\Repository\GroupRepository")
 *
 * Group
 */
class Group implements \Serializable
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
     * @ORM\OneToMany(targetEntity="GroupRole", mappedBy="group")
     *
     * @var Doctrine\Common\Collections\ArrayCollection
     */
    private $groupRoles;

    /**
     * @ORM\OneToMany(targetEntity="GroupProfile", mappedBy="group")
     *
     * @var Doctrine\Common\Collections\ArrayCollection
     */
    protected $groupProfiles;

    /**
     * @ORM\Column(type="string", length=128, unique=true, nullable=false)
     *
     * @var string
     */
    protected $name;

    /**
     * Group ctor
     */
    public function __contruct()
    {
        $this->groupRoles = new ArrayCollection();
        $this->groupProfiles = new ArrayCollection();
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
     * @return Group
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
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(
            [
                $this->id,
                $this->name
            ]
        );
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->name
        ) = unserialize($serialized);
    }
}

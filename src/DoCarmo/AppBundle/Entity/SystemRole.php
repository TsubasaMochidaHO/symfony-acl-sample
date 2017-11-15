<?php

namespace DoCarmo\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="system_role")
 * @ORM\Entity(repositoryClass="DoCarmo\AppBundle\Repository\SystemRoleRepository")
 *
 * SystemRole
 */
class SystemRole
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
     * @ORM\Column(type="string", length=128, unique=true)
     *
     * @var string
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Profile", mappedBy="systemRole")
     *
     * @var Doctrine\Common\Collections\ArrayCollection
     */
    protected $profiles;

    /**
     * SystemRole ctor
     */
    public function __construct()
    {
        $this->profiles = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name The role name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * Get profiles
     *
     * @return Doctrine\Common\Collections\ArrayCollection
     */
    public function getProfile()
    {
        return $this->profiles;
    }

    /**
     * SystemRole to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}

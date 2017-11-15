<?php

namespace DoCarmo\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="DoCarmo\AppBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 *
 * User
 */
class User implements AdvancedUserInterface, \Serializable
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
     * @ORM\OneToOne(targetEntity="Profile", mappedBy="user")
     *
     * @var Profile
     */
    protected $profile;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     *
     * @var string
     */
    protected $username;

    /**
     * @ORM\Column(type="string", length=64)
     *
     * @var string
     */
    protected $password;

    /**
     * @ORM\Column(type="string", length=32)
     *
     * @var string
     */
    protected $salt;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     *
     * @var string
     */
    protected $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     *
     * @var boolean
     */
    protected $isActive;

    public function __contruct()
    {
        $this->isActive = true;
        $this->salt = md5(uniqid("", true));
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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        //return $this->salt;
        return null;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set profile
     *
     * @param Profile $profile
     *
     * @return User
     */
    public function setProfile(Profile $profile = null)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile
     *
     * @return Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function getRoles()
    {
        if (!$this->profile) {
            return [];
        }

        $roles = [
            (string) $this->profile->getSystemRole()
        ];

        $groupProfile = $this->profile->getGroupProfile();

        if ($groupProfile) {
            array_unshift($roles, (string) $groupProfile->getGroupRole());
        }

        return $roles;
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function eraseCredentials()
    {
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function isAccountNonExpired()
    {
        return true;
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function isAccountNonLocked()
    {
        return true;
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function isCredentialsNonExpired()
    {
        return true;
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function isEnabled()
    {
        return $this->isActive;
    }

    /**
     * User to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->username;
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        serialize([
            $this->id,
            $this->username,
            $this->password,
            $this->salt,
            $this->isActive
        ]);
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password,
            $this->salt,
            $this->isActive
        ) = unserialize($serialized);
    }
}

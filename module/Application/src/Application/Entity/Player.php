<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Application\Service\ServiceLocatorAwareEntity as ServiceLocatorAwareEntity;

/**
 * Player
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Application\Repository\PlayerRepository") 
 * @ORM\Table(name="player", options={"engine" = "InnoDB" })
 */
class Player extends ServiceLocatorAwareEntity
{

    const GENDER_MALE       = 1;
    const GENDER_FEMALE     = 2;

    public $genderOptions = array(
                    self::GENDER_MALE    => "Male",
                    self::GENDER_FEMALE  => "Female"
                );


    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $age;

    /**
     * @var integer
     */
    private $gender;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * Magic getter to expose protected properties.
     *
     * @param string $property
     * @return mixed
     */
    public function __get($property)
    {
        return $this->$property;
    }


    /**
     * Magic setter to save protected properties.
     *
     * @param string $property
     * @param mixed $value
     */
    public function __set($property, $value)
    {
        $this->$property = $value;
    }


    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }


    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function populate($data = array())
    {
        $this->id        = (isset($data['id']))       ? $data['id']       : null;
        $this->name      = (isset($data['name']))     ? $data['name']     : null;
        $this->surname   = (isset($data['surname']))  ? $data['surname']  : null;
        $this->username  = (isset($data['username'])) ? $data['username'] : null;
        $this->email     = (isset($data['email']))    ? $data['email']    : null;
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
     * @return Player
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
     * @return Player
     */
    public function setPassword($password)
    {
        $this->password = md5($password);

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
     * Set name
     *
     * @param string $name
     * @return Player
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


    public function getFullName() 
    {
        return $this->name .' '.$this->surname; 
    }


    /**
     * Set age
     *
     * @param integer $age
     * @return Player
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer 
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set gender
     *
     * @param integer $gender
     * @return Player
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return integer 
     */
    public function getGender()
    {
        return $this->gender;
    }



    public function getGenderName() 
    {
        if( isset($this->gender ) ) 
        {
            return self::$genderOptions[$this->gender];
        }

        throw new Exception("Gender Exception", 1);
    }


    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Player
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Player
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $wallets;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->wallets = new \Doctrine\Common\Collections\ArrayCollection();
        $this->created_at = new \DateTime(); 
    }

    /**
     * Add wallets
     *
     * @param \Application\Entity\Wallet $wallet
     * @return Player
     */
    public function addWallet(\Application\Entity\Wallet $wallet)
    {
        $this->wallets[] = $wallet;

        return $this;
    }


    /**
     * Has Wallet
     */
    public function hasWallet() 
    {
        return (!empty($this->wallets)) ? true : true;
    }


    /**
     * Remove wallets
     *
     * @param \Application\Entity\Wallet $wallet
     */
    public function removeWallet(\Application\Entity\Wallet $wallet)
    {
        $this->wallets->removeElement($wallet);
    }

    /**
     * Get wallets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWallets()
    {
        return $this->wallets;
    }
    /**
     * @var string
     */
    private $surname;


    /**
     * Set surname
     *
     * @param string $surname
     * @return Player
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }
    /**
     * @var string
     */
    private $email;


    /**
     * Set email
     *
     * @param string $email
     * @return Player
     */
    public function setEmail($email)
    {
        $this->email = strtolower($email);

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
     * Returns the total balance EUR + BNS
     * 
     * @param \Application\Entity\Currency $currency
     * @return double $balance
     */
    public function getBalance(\Application\Entity\Currency $currency = null) 
    {
        $balance = 0;

        foreach ($this->wallets as $wallet) 
        {
            if( isset($currency) and $currency != $wallet->getCurrency() ) continue;
            
            $transactions = $wallet->getTransactions();

            foreach ($transactions as $transaction) 
            {
                $balance += $transaction->getAmount();
            }
        }

        return $balance;
    }

}

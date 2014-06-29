<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Wallet
 */
class Wallet
{

    const UNIT_CURRENCY         = 1;
    const UNIT_PERCENTAGE       = 2;


    public $unitOptions = array(
                    self::UNIT_CURRENCY      =>  "Currency",
                    self::UNIT_PERCENTAGE    =>  "Percentage",
                );


    const STATUS_ACTIVE         = 1;
    const STATUS_WAGERED        = 2;
    const STATUS_DEPLETED       = 3;

    public $statusOptions = array(
                    self::STATUS_ACTIVE     =>  "Active",
                    self::STATUS_DEPLETED   =>  "Depleted"
                );


    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var \Application\Entity\Player
     */
    private $player;


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
     * Set currency
     *
     * @param string $currency
     * @return Wallet
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string 
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Wallet
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
     * @return Wallet
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
     * Set player
     *
     * @param \Application\Entity\Player $player
     * @return Wallet
     */
    public function setPlayer(\Application\Entity\Player $player = null)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * Get player
     *
     * @return \Application\Entity\Player 
     */
    public function getPlayer()
    {
        return $this->player;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $transactions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->transactions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add transactions
     *
     * @param \Application\Entity\Transactions $transactions
     * @return Wallet
     */
    public function addTransaction(\Application\Entity\Transactions $transactions)
    {
        $this->transactions[] = $transactions;

        return $this;
    }

    /**
     * Remove transactions
     *
     * @param \Application\Entity\Transactions $transactions
     */
    public function removeTransaction(\Application\Entity\Transactions $transactions)
    {
        $this->transactions->removeElement($transactions);
    }

    /**
     * Get transactions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTransactions()
    {
        return $this->transactions;
    }
    /**
     * @var string
     */
    private $name;


    /**
     * Set name
     *
     * @param string $name
     * @return Wallet
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
     * @var string
     */
    private $amount;


    /**
     * Set amount
     *
     * @param string $amount
     * @return Wallet
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string 
     */
    public function getAmount()
    {
        return $this->amount;
    }
    /**
     * @var integer
     */
    private $status;


    /**
     * Set status
     *
     * @param integer $status
     * @return Wallet
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }
}

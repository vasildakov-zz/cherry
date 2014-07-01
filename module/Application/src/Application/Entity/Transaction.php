<?php

namespace Application\Entity;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping as ORM;

/**
 * Transaction
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\EntityListeners({"Application\Listener\TransactionListener"})
 * @ORM\Entity(repositoryClass="Application\Repository\TransactionRepository") 
 * @ORM\Table(name="transaction")
 */
class Transaction
{

    /**
     * Transaction types
     */
    const TYPE_DEPOSIT   = 1;

    const TYPE_WITHDRAW  = 2;

    const TYPE_BONUS     = 3;

    public $typeOptions = array(
                    self::TYPE_DEPOSIT      =>  "Deposit",
                    self::TYPE_WITHDRAW     =>  "Withdraw",
                    self::TYPE_BONUS        =>  "Bonus",
                );

    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $type;

    /**
     * @var integer
     */
    private $amount;

    /**
     * @var \DateTime
     */
    private $created_at;


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
     * Set type
     *
     * @param integer $type
     * @return Transaction
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     * @return Transaction
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Transaction
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
     * @var \Application\Entity\Wallet
     */
    private $wallet;


    /**
     * Set wallet
     *
     * @param \Application\Entity\Wallet $wallet
     * @return Transaction
     */
    public function setWallet(\Application\Entity\Wallet $wallet = null)
    {
        $this->wallet = $wallet;

        return $this;
    }

    /**
     * Get wallet
     *
     * @return \Application\Entity\Wallet 
     */
    public function getWallet()
    {
        return $this->wallet;
    }
    /**
     * @var string
     */
    private $comment;


    /**
     * Set comment
     *
     * @param string $comment
     * @return Transaction
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }


}

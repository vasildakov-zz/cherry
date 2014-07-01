<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bonus
 */
class Bonus
{
    /**
     * The bonus reward could be set as money or percentage
     */
    const UNIT_CURRENCY         = 1;
    const UNIT_PERCENTAGE       = 2;

    public $unitOptions = array(
                    self::UNIT_CURRENCY    => "Currency",
                    self::UNIT_PERCENTAGE  => "Percentage",
                );

    /**
     * Bonus status 
     */
    const STATUS_ACTIVE         = 1;
    const STATUS_WAGERED        = 2;
    const STATUS_DEPLETED       = 3;


    public $statusOptions = array(
                    self::STATUS_ACTIVE    => "Active",
                    self::STATUS_WAGERED   => "Wagered",
                    self::STATUS_DEPLETED  => "Depleted",
                );

    /**
     * Bonus triggers
     */
    const TRIGGER_LOGIN         = 1;
    const TRIGGER_DEPOSIT       = 2;

    public $triggerOptions = array(
                    self::TRIGGER_LOGIN    => "Login",
                    self::TRIGGER_DEPOSIT  => "Deposit"
                );


    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $reward;

    /**
     * @var integer
     */
    private $event_trigger;
    
    /**
     * @var integer
     */
    private $multiplier;

    /**
     * @var integer
     */
    private $status;


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
     * @param string $name
     * @return Bonus
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
     * Set reward
     *
     * @param string $reward
     * @return Bonus
     */
    public function setReward($reward)
    {
        $this->reward = $reward;

        return $this;
    }

    /**
     * Get reward
     *
     * @return string 
     */
    public function getReward()
    {
        return $this->reward;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Bonus
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
    /**
     * @var integer
     */
    private $unit;


    /**
     * Set unit
     *
     * @param integer $unit
     * @return Bonus
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return integer 
     */
    public function getUnit()
    {
        return $this->unit;
    }



    /**
     * Set multiplier
     *
     * @param integer $multiplier
     * @return Bonus
     */
    public function setMultiplier($multiplier)
    {
        $this->multiplier = $multiplier;

        return $this;
    }

    /**
     * Get multiplier
     *
     * @return integer 
     */
    public function getMultiplier()
    {
        return $this->multiplier;
    }


    /**
     * Set event_trigger
     *
     * @param integer $eventTrigger
     * @return Bonus
     */
    public function setEventTrigger($eventTrigger)
    {
        $this->event_trigger = $eventTrigger;

        return $this;
    }

    /**
     * Get event_trigger
     *
     * @return integer 
     */
    public function getEventTrigger()
    {
        return $this->event_trigger;
    }


    /**
     * Returns wagering requirements
     * cache-in wagering requirment = wagering requirement x bonus amount
     * 
     * @return double
     */ 
    public function getWageringRequirement() 
    {
        return $this->multiplier * $this->reward;
    }


    /**
     * @return boolean 
     */
    public function isApplicable(\Application\Entity\Transaction $transaction) 
    {
        return ($transaction->getAmount() >= $this->getWageringRequirement() ) ? true : false;
    }
}

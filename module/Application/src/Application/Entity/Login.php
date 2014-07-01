<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Login
 */
class Login
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $created_at;

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
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Login
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
     * Set player
     *
     * @param \Application\Entity\Player $player
     * @return Login
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
     * @var \Application\Entity\Login
     */
    private $logins;


    /**
     * Set logins
     *
     * @param \Application\Entity\Login $logins
     * @return Login
     */
    public function setLogins(\Application\Entity\Login $logins = null)
    {
        $this->logins = $logins;

        return $this;
    }


}

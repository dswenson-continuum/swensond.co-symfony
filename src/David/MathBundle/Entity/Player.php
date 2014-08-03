<?php

namespace David\MathBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Player
 *
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="David\MathBundle\Entity\PlayerRepository")
 */
class Player extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CreationDate", type="datetime")
     */
    protected $creationDate;

    /**
     * @var array
     *
     * @ORM\Column(name="Stocks", type="array")
     */
    protected $stocks;

    /**
     * @var array
     *
     * @ORM\Column(name="Deck", type="array")
     */
    protected $deck;

    /**
     * @ORM\PrePersist
     */
    public function __setDate(){
        $this->setCreationDate(new \Datetime());
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
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return Player
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime 
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set stocks
     *
     * @param array $stocks
     * @return Player
     */
    public function setStocks($stocks)
    {
        $this->stocks = $stocks;

        return $this;
    }

    /**
     * Get stocks
     *
     * @return array 
     */
    public function getStocks()
    {
        return $this->stocks;
    }

    /**
     * Set deck
     *
     * @param array $deck
     * @return Player
     */
    public function setDeck($deck)
    {
        $this->deck = $deck;

        return $this;
    }

    /**
     * Get deck
     *
     * @return array 
     */
    public function getDeck()
    {
        return $this->deck;
    }
}

<?php

namespace David\MathBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Player
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="David\MathBundle\Entity\PlayerRepository")
 */
class Player
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CreationDate", type="datetime")
     */
    private $creationDate;

    /**
     * @var array
     *
     * @ORM\Column(name="Stocks", type="array")
     */
    private $stocks;

    /**
     * @var array
     *
     * @ORM\Column(name="Deck", type="array")
     */
    private $deck;


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

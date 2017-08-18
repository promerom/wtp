<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Travels
 *
 * @ORM\Table(name="travels")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TravelsRepository")
 */
class Travels
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumn(name="city1_id", referencedColumnName="id", nullable=false)
     */
    private $city1;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumn(name="city2_id", referencedColumnName="id", nullable=false)
     */
    private $city2;

    /**
     * @var int
     *
     * @ORM\Column(name="cost", type="integer")
     */
    private $cost;


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
     * Set city1
     *
     * @param integer $city1
     *
     * @return Travels
     */
    public function setCity1($city1)
    {
        $this->city1 = $city1;

        return $this;
    }

    /**
     * Get city1
     *
     * @return int
     */
    public function getCity1()
    {
        return $this->city1;
    }

    /**
     * Set city2
     *
     * @param integer $city2
     *
     * @return Travels
     */
    public function setCity2($city2)
    {
        $this->city2 = $city2;

        return $this;
    }

    /**
     * Get city2
     *
     * @return int
     */
    public function getCity2()
    {
        return $this->city2;
    }

    /**
     * Set cost
     *
     * @param integer $cost
     *
     * @return Travels
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return int
     */
    public function getCost()
    {
        return $this->cost;
    }
}

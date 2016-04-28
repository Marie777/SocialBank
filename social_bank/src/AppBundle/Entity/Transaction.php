<?php
/**
 * Created by PhpStorm.
 * User: Mmarie
 * Date: 4/28/2016
 * Time: 7:56 AM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */

class Transaction
{
    /**
     * @ORM\Column
     * @var string
     */
    protected $type;

    /**
     * @ORM\Column(type="integer")
     * @var integer
     */
    protected $amount;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    protected $dueDate;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    protected $requestDate;

    /**
     * @ORM\ManyToOne(targetEntity="Account", inversedBy="expense")
     * @var Account
     */
    protected $source;

    /**
     * @ORM\ManyToOne(targetEntity="Account", inversedBy="income")
     * @var Account
     */
    protected $destination;

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     */
    protected $isApproved;

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return \DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param \DateTime $dueDate
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
    }

    /**
     * @return \DateTime
     */
    public function getRequestDate()
    {
        return $this->requestDate;
    }

    /**
     * @param \DateTime $requestDate
     */
    public function setRequestDate($requestDate)
    {
        $this->requestDate = $requestDate;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param string $destination
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
    }

    /**
     * @return boolean
     */
    public function isIsApproved()
    {
        return $this->isApproved;
    }

    /**
     * @param boolean $isApproved
     */
    public function setIsApproved($isApproved)
    {
        $this->isApproved = $isApproved;
    }


}